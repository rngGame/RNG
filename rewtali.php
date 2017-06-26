<?php
session_start();
ob_start();
$User = $_SESSION["User"];

include_once 'PHP/db.php';
include_once 'PHP/function.php';
$MLVL = $_SESSION["MonsLVL"];
$sell = $_SESSION["Sell"];
$Drop = $_SESSION["MonsDrop"];
$FightFee = $_SESSION["Money"];

list($HASH, $part, $name, $typeName, $iLVL, $apsorb, $hpBonus, $xpBonus, $dmgBonus, $RESISTef, $RESISTst) = itemDrop($db,$User,"talisman",$MLVL);
$cash = $iLVL*$sell;

$_SESSION["REWARDTYPE"] = "TAL";

$worth = $iLVL + $weaponPhysMax + $weaponMagMax + $weaponHit;
//insert into db

$order = "INSERT INTO DropsAcs
	   (HASH, Part, Name, Rarity, ilvl, Apsorb, hpBonus, xpBonus, dmgBonus, plus, Worth, effect, efstat)
	  VALUES
	   ('$HASH', '$part', '$name', '$typeName', '$iLVL', '$apsorb', '$hpBonus', '$xpBonus', '$dmgBonus','0', '$worth','$RESISTef', '$RESISTst')";
	   
$order2 = "INSERT INTO Equiped
(User, Part, HASH, Equiped)
VALUES
('$User', 'ACS', '$HASH', '0')";	   

$result = mysqli_query($db, $order);
$result = mysqli_query($db, $order2);


$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);


if ($part == "AMUL"){
$currentHASH = $_SESSION["CURRENTACSAMULET"];
}

if ($part == "RING"){
$currentHASH = $_SESSION["CURRENTACSRING"];
}

$ACS = mysqli_query($db,"SELECT * FROM DropsAcs where HASH = '$currentHASH' ");
$ACSi = mysqli_fetch_assoc($ACS);

$moneyRew = ($ACC[3] + $MLVL) * 10; //gold for mob
$_SESSION["GoldRew"] = $moneyRew;

$moneySel = ($ACC[3] + $iLVL) * 10; //gold for wep
$_SESSION["Gold"] = $moneySel;

//Name Fixing


//Comparing
$compareLVL=$compareDMG=$compareHP=$compareARM=$compareXP=$compareAPS="less";
if($iLVL>=$ACSi["ilvl"]){
	$compareLVL="more";
	if($iLVL==$ACSi["ilvl"]){
		$compareLVL="same";
	}
}
if($dmgBonus>=$ACSi["dmgBonus"]){
	$compareDMG="more";
	if($iLVL==$ACSi["ilvl"]){
		$compareLVL="same";
	}
}
if($hpBonus>=$ACSi["hpBonus"]){
	$compareHP="more";
	if($iLVL==$ACSi["ilvl"]){
		$compareLVL="same";
	}
}
if($xpBonus>=$ACSi["xpBonus"]){
	$compareXP="more";
	if($iLVL==$ACSi["ilvl"]){
		$compareLVL="same";
	}
}
if($apsorb>=$ACSi["Apsorb"]){
	$compareAPS="more";
	if($x==$ACSi["ilvl"]){
		$compareLVL="same";
	}
}

$reward = "<b><font color='lightgreen'><br> -TALISMAN !- </font><br><br>DROP:</b><br><br>Name: $name<br>
Item lvl: <b><span class='$compareLVL'>$iLVL</span></b><br>
Item Part: $part<br>
Item Dmg. Bonus: <b><span class='$compareDMG'>$dmgBonus %</span></b><br>
Item HP Bonus <b><span class='$compareHP'>$hpBonus %</span></b><br>
Item XP Bonus: <b><span class='$compareXP'>$xpBonus %</span></b><br>
Item Apsorb: <b><span class='$compareAPS'>$apsorb %</span></b><br>
Resist: <b>$RESISTef - $RESISTst %</b><br>
Item worth: $moneySel Gold<br>
<br><b>Current item:</b><br><br>
Name: $ACSi[Name]<br>
Item lvl: <b>$ACSi[ilvl]</b><br>
Item Part: $part<br>
Item Dmg. Bonus: <b>$ACSi[dmgBonus] %</b><br>
Item HP bonuss: <b>$ACSi[hpBonus] %</b><br>
Item XP Bonus: <b>$ACSi[xpBonus] %</b><br>
Item Apsorb: <b>$ACSi[Apsorb] %</b><br>
Resist: $ACSi[effect] - $ACSi[effstat] % ";

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
$passiveXPTotal=round($passiveXP + $Passive[7]);

$orderPassive = "UPDATE passive
SET xp3= '$passiveXPTotal'
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