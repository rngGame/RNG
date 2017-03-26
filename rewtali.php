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

list($iLVL, $name, $new, $nameType, $dmg, $armor, $health, $xp) = itemDrop($db,"armor",$MLVL);
$cash = $ILVL*$sell;


$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$TAL = mysqli_query($db,"SELECT * FROM dropst where HASH = '$ACC[8]' ");
$TAL = mysqli_fetch_row($TAL);

if (!$TAL[8] == ""){
	$Current = "<b class='$TAL[9]'>$TAL[1] ($TAL[8])</b>";}
else{
	$Current = "$TAL[1]";}

$moneyRew = ($ACC[3] + $MLVL) * 10; //gold for mob
$_SESSION["GoldRew"] = $moneyRew;

$moneySel = ($ACC[3] + $iLVL) * 10; //gold for wep
$_SESSION["Gold"] = $moneySel;


//Comparing
$compareLVL=$compareDMG=$compareHP=$compareARM=$compareXP="less";
if($iLVL>=$TAL[2]){
	$compareLVL="more";
	if($iLVL==$TAL[2]){
		$compareLVL="same";
	}
}
if($dmg>=$TAL[3]){
	$compareDMG="more";
	if($iLVL==$TAL[2]){
		$compareLVL="same";
	}
}
if($health>=$TAL[4]){
	$compareHP="more";
	if($iLVL==$TAL[2]){
		$compareLVL="same";
	}
}
if($armor>=$TAL[5]){
	$compareARM="more";
	if($iLVL==$TAL[2]){
		$compareLVL="same";
	}
}
if($xp>=$TAL[6]){
	$compareXP="more";
	if($x==$TAL[2]){
		$compareLVL="same";
	}
}

$reward = "<b><font color='lightgreen'><br> -TALISMAN !- </font><br><br>DROP:</b><br><br>Name: $new<br>
Item lvl: <b><span class='$compareLVL'>$iLVL</span></b><br>
Item Damage: <b><span class='$compareDMG'>$dmg</span></b><br>
Item Health: <b><span class='$compareHP'>$health</span></b><br>
Item Armor: <b><span class='$compareARM'>$armor</span></b><br>
Item Xp bonuss: <b><span class='$compareXP'>$xp</span></b><br>
Item worth: $MoneySel Gold<br>
<br><b>Current item:</b><br><br>
Name: $Current <br>
Item lvl: <b>$TAL[2]</b><br>
Item Damage: <b>$TAL[3]</b><br>
Item Health: <b>$TAL[4]</b><br>
Item Armor: <b>$TAL[5]</b><br>
Item Xp bonuss: <b>$TAL[6]</b><br>";

$_SESSION["WepName"] = "$NameO";
$_SESSION["Type"] = "$Class";
$_SESSION["ilvl"] = "$ILVL";
$_SESSION["DMG"] = "$Dmg";
$_SESSION["ARMOR"] = "$Armor";
$_SESSION["HEALTH"] = "$Health";
$_SESSION["XP"] = "$xp";
$_SESSION["Color"] = "$Color";
$_SESSION["Reward"] = "$reward";

$xpTalismanMulti = $_SESSION["XPT"];
$xpNew  = $Drop * $xpTalismanMulti;
$_SESSION["XPS"] = $xpNew;

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
header("location:rewardt.php");

?>