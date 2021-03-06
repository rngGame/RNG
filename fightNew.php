<?php
session_start();
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>World of RNG</title>
<?php
echo "<link rel='stylesheet' type='text/css' href='css/$_COOKIE[Theme].css'>";
?>
<link rel="icon" href="favicon.png">
</head>
<body>
<header>
<?php
include_once 'PHP/db.php';
include_once 'PHP/function.php';

$HPin = $_SESSION["HP"];
$DMGp = $_SESSION["DMGPAVE"];
$DMGm = $_SESSION["DMGMAVE"];
$Armor = $_SESSION["ARM"];
$ArmorM = $_SESSION["MARM"];
$eng = $_SESSION["ENG"];

//energie Shield
if (isset($_SESSION["ESshield"])){
	$ESSO = round($_SESSION["ESshieldO"]);
	$ESS = round($_SESSION["ESshield"]);
	$ESR = round($_SESSION["ESregen"]);
	$ESStext = "ES Shield:<font color='lightblue'>$ESS / $ESSO <font size='-2'>($ESR/t)</font> </font>";
}
	
//saving values
$HPintx = $HPin;
$avgPtx = $DMGp;
$avgMtx = $DMGm;
$Armortx = $Armor;
$ArmorMtx = $ArmorM;
	
//rounding
include 'PHP/rounding.php';

echo "World Of RNG";
echo "</header>";
echo "<font size='-1'><p align='left'>HP: <font size='3' color='Green'>$HPintx  </font>";
echo "DMG: <font size='3' color='red'>~$avgPtx</font>/<font size='3' color='#0066ff'>~$avgMtx  </font>";
echo "ARMOR: <font size='3' color='gold'>$Armortx</font> / <font size='3' color='#DF01D7'>$ArmorMtx </font> $ESStext</p></font>";


$User = $_SESSION["User"];

$gold = $_SESSION["Gold1"];
$gl = $_SESSION["Gold2"];
$BLVL = $_SESSION["fLVL"];
$iLVL = $_SESSION["ILVL"];
$plLVL = $_SESSION["plvl"];
$checkForParty = $_SESSION["PartCreatMOB"];

$bs = $_SESSION["BOSS"];
$shitwep = $_SESSION["CURRENTWHASH"];
	
$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

//if basic wep
if ($shitwep == 0001){
	$iLVL = 1;}

list($name, $mLVL, $HP, $PDMG, $MDMG, $Drop, $monsterIMG, $testMessage)=createMonster($db,$iLVL);

//if monster P damage lower then player defence
if ($Armor > $PDMG){
	$PDMG = round($Armor + (($mLVL + $Armor) * rand(-10,$ACC[3]) / 100));}
	
//if monster M damage lower then player defence
if ($ArmorM > $MDMG){
	$MDMG = round($ArmorM + (($mLVL + $ArmorM) * rand(-10,($ACC[3]+5)) / 100));}
	
//if rare
if (rand(1,300) == 100){
       $testMessage.="Rare approved exact at 100 <br>";
       $name = "<b style='color:#ff0066'>! RARE </b>$name<b style='color:#ff0066'> RARE !</b>";
       $HP *= 1.45;
       $mLVL *= 1.5;
       $PDMG *= 1.2;
	   $MDMG *= 1.3;
       $Drop *= rand(5,15);
       $_SESSION["MonsR"] = 1;
}
	else{
		unset($_SESSION["MonsR"]);
	}
	
//for hardcore
if ($ACC[1] == 1){
	if ($mLVL > 10){
		$HP *= 1.1;
		$PDMG *= 1.1;
		$MDMG *= 1.1;}
	if ($mLVL > 50){
		$HP *= 1.1;
		$PDMG *= 1.1;
		$MDMG *= 1.1;}
	if ($mLVL > 100){
		$HP *= 1.1;
		$PDMG *= 1.1;
		$MDMG *= 1.1;}
	if ($mLVL > 200){
		$HP *= 1.1;
		$PDMG *= 1.1;
		$MDMG *= 1.1;}
	if ($mLVL > 400){
		$HP *= 1.1;
	  	$PDMG *= 1.1;
		$MDMG *= 1.1;}
	if($plLVL >= 20){
		$HP += $HP * $plLVL / 100;
		$_SESSION["MonsDEF"] = round($mLVL*(($plLVL/10)));}
	if($plLVL >= 40){
		$_SESSION["MonsDEF"] = round($mLVL*($plLVL/5));
		$PDMG += $PDMG * $plLVL / 100;
		$MDMG += $MDMG * $plLVL / 100;}
		
	
}
	
		$HP = round($HP);
	  	$PDMG = round($PDMG);
		$MDMG = round($MDMG);


// if fails generation go back to main page
if ($mLVL < 1 or $HP < 1 or $PDMG < 1 or $Drop < 1){
header("location:sync.php");
die();
}
else {
	
//saving values
$mHPNtx = $HP;
$mDMGtx = $PDMG;
$mDMGmtx = $MDMG;
$mDRPtx = $Drop;
	
//rounding
include 'PHP/rounding.php';

    echo "<img src='IMG/Mon/$monsterIMG.jpg' width='60' height='60'><br>";
    echo "Monster Name: <b>$name</b><br>";
    echo " HP: $mHPNtx, DMG: <font color='red'>~$mDMGtx</font>/<font color='0066ff'>~$mDMGmtx</font>, XP: $mDRPtx, Lvl: $mLVL";
    $_SESSION["MonsName"] = "$name";
    $_SESSION["MonsHP"] = round($HP);
    $_SESSION["MonsDMG"] = round($PDMG);
	$_SESSION["MonsDMGm"] = round($MDMG);
    $_SESSION["MonsDrop"] = round($Drop);
    $_SESSION["MonsLVL"] = round($mLVL);
    $_SESSION["MonsIMG"] = $monsterIMG;
	
	//monster type
	$sub = array("Fire", "Ice", "Lightning", "Light", "Dark", "Soul");
	$subn = array_rand($sub,1);
	$_SESSION["MonsTYP"] = $sub[$subn];
	
//create for party
if ($checkForParty == 1){
	
	$PartyID = $_SESSION["PartyID"];
	$plCount = $_SESSION["PLCount"];
	
	$DEF = $mLVL / 2;
	
	if ($plCount == 2){
	$MobHP= $HP * 20;}
	if ($plCount == 3){
	$MobHP= $HP * 50;}
	if ($plCount == 4){
	$MobHP= $HP * 200;}
	
	$MobDrop = round($Drop + ($Drop * ($plCount * 10) / 5000));
	$MobDMGP = round($PDMG + ($PDMG * ($plCount * 10) / 100));
	$MobDMGM = round($MDMG + ($MDMG * ($plCount * 10) / 100));
	$DEF = round($DEF + ($DEF * ($plCount * 30)));
	
	$order5 = "INSERT INTO PartyMonsters
	(PartyID, MonsterLVL, MonsterName, MonsterHP, MonsterPhyDMG, MonsterMagDMG, MonsterDEF, MonsterRew, StartingHP)
	VALUES
	('$PartyID', '$mLVL', '$name', '$MobHP', '$PDMG', '$MDMG', '', '$MobDrop', '$MobHP')";	  
	
	echo $result = mysqli_query($db, $order5);


	header("location:sync.php");

die();
}

    echo
      "<div id='fightNewBut'>
	  	<section class='actionButtons2'>
    	      <form method='post' action='FightT.php'>
              <input hidden='' type='text' name='lvl' value='30' placeholder='lvl'>
            <p class='submit'><input type='submit' name='commit' value='Fight'></p> 
          </form>
      </section>
      


    <section class='actionButtons2'>
    	      <form method='post' action='fightNew.php'>
              <input hidden='' type='text' name='lvl' value='$BLVL' placeholder='Try another Monster'>
            <p class='submit'><input type='submit' name='commit' value='Try another Monster'> </p>
          </form>
      </section>
	  ";

}
  ?>
  <section class="actionButtons2">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
  </section>
  </div>