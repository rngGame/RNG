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
World Of RNG
</header>
<?php
$User = $_SESSION["User"];

include_once 'PHP/db.php';
include_once 'PHP/function.php';

$MLVL = $_SESSION["MonsLVL"];
$Drop = $_SESSION["MonsDrop"];
$Money = $_SESSION["Money"];
	
//some extra flavor
$MLVL = $MLVL + 500;

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
$WEP = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$ACC[1]' ");
$WEP = mysqli_fetch_row($WEP);

list($HASH, $name, $typeName, $iLVL, $weaponPhysMin, $weaponPhysMax, $weaponCrit, $weaponMagMin, $weaponMagMax, $weaponHit, $weaponSkill, $Effect, $EffectChance)=itemDrop($db, $User, "weapon", $MLVL);

$worth = $iLVL + $weaponPhysMax + $weaponMagMax + $weaponHit;

$_SESSION["REWARDTYPE"] = "WEP";

$enchantplus = rand(15,25);
	
//insert into db

$order = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, hitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', '$name', '$typeName', '$iLVL', '$weaponPhysMin', '$weaponPhysMax', '$weaponCrit', '$weaponMagMin', '$weaponMagMax', '$weaponHit', '$weaponSkill', '$Effect', '$EffectChance', '$enchantplus', '$worth')";
	   


$result = mysqli_query($db, $order);

$MoneyRew = ($ACC[3] + $MLVL) * 10; //gold for mob
$_SESSION["GoldRew"] = $MoneyRew;

$MoneySel = ($ACC[3] + $LVL) * 10; //gold for wep
$_SESSION["Gold"] = $MoneySel;

if ($EffectChance <> 0){
		if ($Effect == "LL"){
	$efftype = "Life Leach";
	}
		if ($Effect == "BL"){
	$efftype = "Bleed Chanse";
	}
		if ($Effect == "BR"){
	$efftype = "Burn Chanse";
	}
		if ($Effect == "FR"){
	$efftype = "Freez Chanse";
	}
		if ($Effect == "ST"){
	$efftype = "Stun Chanse";
	}
		if ($Effect == "SH"){
	$efftype = "Shock Chanse";
	}
		if ($Effect == "BK"){
	$efftype = "Block Chanse";
	}
		if ($Effect == "SM"){
	$efftype = "Summon increase";
	}
		if ($Effect == "PS"){
	$efftype = "Poision increase";
	}
		if ($Effect == "CF"){
	$efftype = "Confusion chanse";
	}
		if ($Effect == "CS"){
	$efftype = "Cursed Soul";
	}
		if ($Effect == "WK"){
	$efftype = "Weaken monster";
	}
		if ($Effect == "NS"){
	$efftype = "Nerve Shock";
	}
	
	$eft = "Effect: $efftype <b>$EffectChance %</b><br>";}
	
if ($weaponSkill >= 1){
	$SKILL = mysqli_query($db,"SELECT * FROM iskills where ID = '$weaponSkill' ");
	$SKILLS = mysqli_fetch_assoc($SKILL);
	$img = "<img src='IMG/$SKILLS[pic]' style='width:33px'><br>";}
	
	
$reward = "<b><font color='red'>-WEAPON !-</font><br><br>DROP:</b><br><br>Name: $name<br>
LVL: <b><span class='$compareLVL'>$iLVL</span></b><br>
Physical Dmg: <b><span class='$comparePHYS1'>$weaponPhysMin</span> ~ <span class='$comparePHYS2'>$weaponPhysMax</span> <font size='2'>(Avg. <span class='$comparePHYS'>$phyAVG1</span>)</font></b><br>
Magickal Dmg: <b><span class='$compareMAG1'>$weaponMagMin</span> ~ <span class='$compareMAG2'>$weaponMagMax</span> <font size='2'>(Avg. <span class='$compareMAG'>$magAVG1</span>)</font></b><br>
Cryt chanse: <span class='$compareCRYT'>$weaponCrit %</span><br>
Hit chanse: <span class='$compareHIT'>$weaponHit %</span><br>
Plus: <span class='$compareHIT'>+$enchantplus</span><br>
$eft $img";	

$_SESSION["WepName"] = $reward;

$_SESSION["Reward"] = "$reward";
$_SESSION["HASH"] = "$HASH";

$MHP = $_SESSION["MonsHP"];
$ID = $_SESSION["IDB"];
$MHP2 = $_SESSION["MonsHP2"];


$order3 = "UPDATE wboss
SET `HASH` = '$HASH'
WHERE `ID` = '$ID'";
$result = mysqli_query($db, $order3);	



$BOS = mysqli_query($db,"SELECT * FROM wboss where ID = '$ID' ");
$BOS = mysqli_fetch_row($BOS);

$dmg = $MHP2 - $MHP;
$HPL = $MHP2 - $dmg;

$kills = $ACC[6] +1;

$DMTB = mysqli_query($db,"SELECT * FROM dboss where MonsID = '$ID' AND ACC = '$ACC[0]'");
$DMTB = mysqli_fetch_row($DMTB);
if($DMTB[0] == 0) {
	$order2 = "INSERT INTO dboss
	   (MonsID, ACC, DMG)
	  VALUES	
	   ('$ID', '$ACC[0]', '$dmg')";
	   $result = mysqli_query($db, $order2);
	}
else{
	$dmg = $DMTB[2] + $dmg;
	$order5 = "UPDATE dboss
	SET DMG = '$dmg'
	WHERE `MonsID` = '$ID' AND `ACC` = '$ACC[0]'";
	$result = mysqli_query($db, $order5);
	}

$BOS = mysqli_query($db,"SELECT * FROM wboss ORDER BY ID DESC LIMIT 1 ");
$BOS = mysqli_fetch_row($BOS);

if ($BOS[6] != ""){
		
	$order5 = "UPDATE wboss
	SET `HP` = '0'
	WHERE `ID` = '$ID'";
	$result = mysqli_query($db, $order5);
	
	echo "<b>Boss Already dead</b>";
	echo '
<section class="container">
    <div class="Back">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
';}
else{
	
	$order4 = "UPDATE wboss
	SET `Killer` = '$User'
	WHERE `ID` = '$ID'";
	$result = mysqli_query($db, $order4);	


$a = 0;

$List = mysqli_query($db,"SELECT * FROM dboss where MonsID = '$BOS[0]' order by DMG desc ");
while ($List1 = mysqli_fetch_array($List)){
	if ($a == 0) {
	$order2 = "INSERT INTO Equiped
	(User, Part, HASH, Equiped)
	VALUES
	('$List1[1]', 'WEP', '$HASH', '0')";	  
	$result = mysqli_query($db, $order2);
	$a = $a +1;};
echo "<b>$List1[1]</b> - $List1[2] Dmg.<br>";
$ACC2 = mysqli_query($db,"SELECT * FROM characters where user = '$List1[1]' ");
$ACC2 = mysqli_fetch_row($ACC2);
$PAS = mysqli_query($db,"SELECT * FROM passive where USER = '$List1[1]' ");
$PAS = mysqli_fetch_row($PAS);

$cash = $List1[2] / 1500;
if ($cash > 200000){
	$cash = 200000;}
$cash = round($ACC2[4] + $cash);
$XP = $ACC2[5] + ($List1[2] * 0.5);
$XP = round($XP);
$XPP = $List1[2]/3500;
$XPP = $XPP + $PAS[10];
$XPP = round($XPP);

$order1 = "UPDATE characters
SET Cash = '$cash'
WHERE `User` = '$List1[1]'"	;

$order2 = "UPDATE characters
SET XP = '$XP'
WHERE `User` = '$List1[1]'"	;

$order3 = "UPDATE passive
SET xp4= '$XPP'
WHERE `USER` = '$List1[1]'";

$result = mysqli_query($db, $order1);
$result = mysqli_query($db, $order2);
$result = mysqli_query($db, $order3);
}
}




$order3 = "UPDATE characters
SET Kills = '$kills'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order3);	

$IDB = $_SESSION["IDB"];

$order3 = "UPDATE wboss
SET HP = '0'
WHERE `ID` = '$IDB'";

$result = mysqli_query($db, $order3);	


mysqli_close($db);
header("location:show.php");

?>