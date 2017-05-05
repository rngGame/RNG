<?php
session_start();
ob_start();
$User = $_SESSION["User"];

include_once 'PHP/db.php';
include_once 'PHP/function.php';
$MLVL = $_SESSION["MonsLVL"];
$sell = $_SESSION["Sell"];
$Drop = $_SESSION["MonsDrop"]; //DB drop value of monster
$FightFee = $_SESSION["Money"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

//creates armor function
list($HASH, $iLVL, $name, $typeName, $valueArmorP, $valueArmorM, $part, $apsorb, $Effect, $EffectChance) = itemDrop($db,$User,"armor",$MLVL);

$worth = $iLVL + $weaponPhysMax + $weaponMagMax + $weaponHit;
//insert into db

$order = "INSERT INTO DropsArm
	   (HASH, Name, Rarity, ilvl, pDEF, mDEF, Apsorb, Part, effect, efstat, plus)
	  VALUES
	   ('$HASH', '$name', '$typeName', '$iLVL', '$valueArmorP', '$valueArmorM', '$apsorb', '$part', '$Effect', '$EffectChance' ,'0')";
	   
$order2 = "INSERT INTO Equiped
(User, Part, HASH, Equiped)
VALUES
('$User', 'ARM', '$HASH', '0')";	   

$result = mysqli_query($db, $order);
$result = mysqli_query($db, $order2);

$_SESSION["REWARDTYPE"] = "ARM";

//curent amrmor
if ($part == "BODY"){
$currentHASH = $_SESSION["CURRENTARMBODY"];
}

if ($part == "GLOVES"){
$currentHASH = $_SESSION["CURRENTARMGLOVES"];
}

if ($part == "LEGS"){
$currentHASH = $_SESSION["CURRENTARMBOOTS"];
}

$ACS = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$currentHASH' ");
$ACSi = mysqli_fetch_assoc($ACS);

	if ($ACSi["effect"] == "HP"){
		$eftCur = "Bonus HP: <b>$ACSi[efstat] </b>";
	}
	if ($ACSi["effect"] == "EN"){
		$eftCur = "Bonus EN: <b>$ACSi[efstat] </b>";
	}
	if ($ACSi["effect"] == "HL"){
		$eftCur = "Helth per turn <b>$ACSi[efstat] </b>";
	}
	if ($ACSi["effect"] == "NO"){
		$eftCur = "Chanse not die: <b>$ACSi[efstat] % </b>";
	}
	if ($ACSi["effect"] == "TR"){
		$eftCur = "Thorns damage: <b>$ACSi[efstat] </b>";
	}


//money calculates
$moneyRew = ($ACC[3] + $MLVL) * 10; //gold for mob
$_SESSION["GoldRew"] = $moneyRew;

$moneySel = ($ACC[3] + $iLVL) * 10; //gold for wep
$_SESSION["Gold"] = $moneySel;


if ($EffectChance <> 0){
		if ($Effect == "HP"){
	$efftype = "Bonus HP";
	}
		if ($Effect == "EN"){
	$efftype = "Bonus EN";
	}
		if ($Effect == "HL"){
	$efftype = "Helth per turn";
	}
		if ($Effect == "NO"){
	$efftype = "Chanse not to die";
	}
		if ($Effect == "TR"){
	$efftype = "Thorns damage";
	}
	$eft = "Effect: $efftype <b>$EffectChance </b> <span><br>";}

//Compare Armor
$compareLVL = $comparePDEF = $compareMDEF = $compareAPS = "less";
if($iLVL>=$ACSi["ilvl"]){
	$compareLVL="more";
	if($iLVL==$ACSi["ilvl"]){
		$compareLVL="same";
	}
}
if($valueArmorP>=$ACSi["pDEF"]){
	$comparePDEF="more";
	if($iLVL==$ACSi["pDEF"]){
		$compareLVL="same";
	}
}
if($valueArmorM>=$ACSi["mDEF"]){
	$compareMDEF="more";
	if($iLVL==$ACSi["mDEF"]){
		$comparePDEF="same";
	}
}
if($apsorb>=$ACSi["Apsorb"]){
	$compareAPS="more";
	if($armor==$ACSi["Apsorb"]){
		$compareAPS="same";
	}
}
//create Reward Template
$reward = "<b><font class='gold'><br> -ARMOR !- </font><br><br>DROP:</b><br><br>Name: $name<br>
Item lvl: <b><span class='$compareLVL'>$iLVL</span></b><br>
Item Part: $part<br>
Item P.def: <b><span class='$comparePDEF'>$valueArmorP</span></b><br>
Item M.def: <b><span class='$compareMDEF'>$valueArmorM</span></b><br>
Item Apsorb: <b><span class='$compareAPS'>$apsorb %</span></b><br>
$eft
Item worth: $moneySel Gold<br>
<br><b>Current item:</b><br>
Item Name: $ACSi[Name]<br>
Item lvl: <b>$ACSi[ilvl]</span></b><br>
Item Part: $part<br>
Item P.def: <b>$ACSi[pDEF]</span></b><br>
Item M.def: <b>$ACSi[mDEF]</span></b><br>
Item Apsorb: <b>$ACSi[Apsorb] %</span></b><br>
$eftCur
<br>";


$_SESSION["Reward"] = "$reward";
$_SESSION["HASH"] = "$HASH";

//check talisman xp bonus
$xpTalismanMulti = $_SESSION["XPT"];
$xpNew  = $Drop * $xpTalismanMulti;
$_SESSION["XPS"] = $xpNew;
//update user stats
$xpTotal = $ACC[5] + $xpNew;
$kills = $ACC[6] +1;
$cash = ($ACC[4] - $FightFee) + $moneyRew;
     

//update passives
$Passive = mysqli_query($db,"SELECT * FROM passive where USER = '$User' ");
$Passive = mysqli_fetch_row($Passive);

$passiveXP = round($MLVL * $xpTalismanMulti);
$_SESSION["XPPA"] = $passiveXP;
$passiveXPTotal=round($passiveXP + $Passive[4]);

$orderPassive = "UPDATE passive
SET xp2= '$passiveXPTotal'
WHERE `User` = '$User'";

$result = mysqli_query($db, $orderPassive);

$rngShardsChance = rand(1,100);
$Shards = $ACC[15];

if ($rngShardsChance <  10){
  $rngShardsAmmount = rand(1,15);
  $Shards += $rngShardsAmmount;
  $_SESSION["SHD"] = $rngShardsAmmount;
}
$orderChar = "UPDATE characters
SET Shards= '".$Shards."', XP = '".$xpTotal."', Kills = '".$kills."', Cash = '".$cash."'
WHERE `USER` = '$User'";
$result = mysqli_query($db, $orderChar);

mysqli_close($db);
header("location:reward.php");

?>