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

echo "World Of RNG";
echo "</header>";
echo "<p align='left'>HP: <font size='3' color='Green'>$HPin  </font>";
echo "DMG: <font size='3' color='red'>~$DMGp</font>/<font size='3' color='#0066ff'>~$DMGm  </font>";
echo "ARMOR: <font size='3' color='gold'>$Armor</font> / <font size='3' color='#DF01D7'>$ArmorM </font> </p>";


$User = $_SESSION["User"];
$gold = $_SESSION["Gold1"];
$gl = $_SESSION["Gold2"];
$BLVL = $_SESSION["fLVL"];
$iLVL = $_SESSION["ILVL"];
$checkForParty = $_SESSION["PartCreatMOB"];

$bs = $_SESSION["BOSS"];
$shitwep = $_SESSION["CURRENTWHASH"];

//if basic wep
if ($shitwep == 0001){
	$iLVL = 1;}

list($name, $mLVL, $HP, $PDMG, $MDMG, $Drop, $monsterIMG, $testMessage)=createMonster($db,$iLVL);

//if monster P damage lower then player defence
if ($Armor > $PDMG){
	$PDMG = round($Armor + (($mLVL + $Armor) * rand(-10,30) / 100));}
	
//if monster M damage lower then player defence
if ($ArmorM > $MDMG){
	$MDMG = round($ArmorM + (($mLVL + $ArmorM) * rand(-10,50) / 100));}
	
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



if ($mLVL < 1 or $HP < 1 or $PDMG < 1 or $Drop < 1){
	//header("location:fightNew.php");
	echo "$name || MLVL: $mLVL || HP: $HP || DMG: $DMG || DROP: $Drop || iLVL: $iLVL";
	echo $testMessage;
  	die();
}
else {

    echo "<img src='IMG/Mon/$monsterIMG.jpg' width='60' height='60'><br>";
    echo "Monster Name: <b>$name</b><br>";
    echo " HP: $HP, DMG: <font color='red'>~$PDMG</font>/<font color='0066ff'>~$MDMG</font>, XP: $Drop, Lvl: $mLVL";
    $_SESSION["MonsName"] = "$name";
    $_SESSION["MonsHP"] = round($HP);
    $_SESSION["MonsDMG"] = round($PDMG);
	$_SESSION["MonsDMGm"] = round($MDMG);
    $_SESSION["MonsDrop"] = round($Drop);
    $_SESSION["MonsLVL"] = round($mLVL);
    $_SESSION["MonsIMG"] = $monsterIMG;
	
//create for party
if ($checkForParty == 1){
	
	$PartyID = $_SESSION["PartyID"];
	$plCount = $_SESSION["PLCount"];
	
	$DEF = $iLVL / 10;
	
	if ($plCount == 2){
	$MobHP= $HP + ($HP * (80) / 100);}
	if ($plCount == 3){
	$MobHP= $HP + ($HP * (150) / 100);}
	if ($plCount == 4){
	$MobHP= $HP + ($HP * (300) / 100);}
	
	$MobDrop = round($Drop + ($Drop * ($plCount * 50) / 100));
	$MobDMGP = round($PDMG + ($PDMG * ($plCount * 10) / 100));
	$MobDMGM = round($MDMG + ($MDMG * ($plCount * 10) / 100));
	$DEF = round($DEF + ($DEF * ($plCount * 30) / 100));
	
	$order = "INSERT INTO PartyMonsters
	(PartyID, MonsterLVL, MonsterName, MonsterHP, MonsterPhyDMG, MonsterMagDMG, MonsterDEF, MonsterRew, StartingHP)
	VALUES
	('$PartyID', '$mLVL', '$name', '$MobHP', '$PDMG', '$MDMG', '', '$MobDrop', '$MobHP')";	   



$result = mysqli_query($db, $order);
	header("location:sync.php");

die();
}

    echo
      "<div class='test'><section class='container2'>
        <div class='actionButtons'>
    	      <form method='post' action='FightT.php'>
              <input hidden='' type='text' name='lvl' value='30' placeholder='lvl'>
            <p class='submit'><input type='submit' name='commit' value='Fight'></p> 
          </form>
        </div>
      </section>
	  <br>
      


    <section class='container1'>
        <div class='actionButtons'>
    	      <form method='post' action='fightNew.php'>
              <input hidden='' type='text' name='lvl' value='$BLVL' placeholder='Try another Monster'>
            <p class='submit'><input type='submit' name='commit' value='Try another Monster'> </p>
          </form>
        </div>
      </section>
	  ";
	  
	  //Algio keistas stuff !!!!
	  if ($User == "Algraud"){ 
    echo $testMessage;}
	}

  ?>
  <section class="container3">
    <div class="actionButtons">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
  </div>