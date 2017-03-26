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

//creates armor function
list($iLVL, $name, $new, $nameType, $armor) = itemDrop($db,"armor",$MLVL);
//get User and current Armor
$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
$ARM = mysqli_query($db,"SELECT * FROM drops where HASH = '$ACC[7]' ");
$ARM = mysqli_fetch_row($ARM);
//color current Armor
if (!$ARM[2] == ""){
	$Current = "<b class='#$ARM[5]'>$ARM[1] ($ARM[2])</b>";
}
else{
	$Current = "$ARM[1]";
}
//money calculates
$moneyRew = ($ACC[3] + $MLVL) * 10; //gold for mob
$_SESSION["GoldRew"] = $moneyRew;

$moneySel = ($ACC[3] + $iLVL) * 10; //gold for wep
$_SESSION["Gold"] = $moneySel;

//Compare Armor
$compareLVL=$compareARM = "less";
if($iLVL>=$ARM[3]){
	$compareLVL="more";
	if($iLVL==$ARM[3]){
		$compareLVL="same";
	}
}
if($armor>=$ARM[4]){
	$compareARM="more";
	if($armor==$ARM[4]){
		$compareARM="same";
	}
}
//create Reward Template
$reward = "<b><font class='gold'><br> -ARMOR !- </font><br><br>DROP:</b><br><br>Name: $new<br>
Item lvl: <b><span class='$compareLVL'>$iLVL</span></b><br>
Item Armor: <b><span class='$compareARM'>$armor</span></b><br>
Item worth: $moneySel Gold<br>
<br><b>Current item:</b><br>
Name: $Current <br>
Item lvl: <b>$ARM[3]</b><br>
Item Armor: <b>$ARM[4]</b><br>";
//save in session
$_SESSION["WepName"] = "$name";
$_SESSION["Type"] = "$nameType";
$_SESSION["ilvl"] = "$iLVL";
$_SESSION["DMG"] = "$armor";
$_SESSION["Color"] = "$color";
$_SESSION["Reward"] = "$reward";
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
$rngShardsAmmount = rand(1,15);

if ($rngShardsChance <  10){
$Shards = $ACC[15] + $rngShardsAmmount;
$orderChar = "UPDATE characters
SET Shards= '$Shards', XP = '$xpTotal', Kills = '$kills', Cash = '$cash'
WHERE `USER` = '$User'";
$result = mysqli_query($db, $orderChar);
$_SESSION["SHD"] = $rngShardsAmmount;
}

mysqli_close($db);
header("location:rewardA.php");

?>