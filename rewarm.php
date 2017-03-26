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
/*
$rel = 0;

while ($rel == 0){

$Base = mysqli_query($db,"SELECT * FROM basearmor Order by RAND() Limit 	1");
$Base = mysqli_fetch_row($Base);
$Sub = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit 	1");
$Sub = mysqli_fetch_row($Sub);
$Sub2 = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit 	1");
$Sub2 = mysqli_fetch_row($Sub2);
$Type = mysqli_query($db,"SELECT * FROM types Order by RAND() Limit 	1");
$Type = mysqli_fetch_row($Type);
$Type2 = mysqli_query($db,"SELECT * FROM types Order by RAND() Limit 	1");
$Type2 = mysqli_fetch_row($Type2);

$Enchant = mysqli_query($db,"SELECT * FROM enchantdrop");

$Class = "";	
$ILVL = 0;
$Dmg = 0;
$Sk = 0;
$elvl = 0;

$n1 = $MLVL/1;
$n3 = $MLVL/1.9;
$n4 = $MLVL/2.4;
$r = $n1 *2.5;

$c3 = rand(1,99-$n3);
$c4 = rand(1,150-$n4);
$Title = rand(0,500-$r);


$N1 = $Base[1];
$Dmg = $Base[3];
$ILVL = $Base[2];
if ($c3 < 20){	
$N3 ="of $Sub[1]";
$Dmg = $Dmg + ($Sub[3])/2;
$ILVL = $ILVL + $Sub[2];
if ($c4 < 30){
$N4 ="and $Sub2[1]";
$Dmg = $Dmg + ($Sub2[3])/2;
$ILVL = $ILVL + $Sub2[2];}}
if ($Title < $Type[2]){
$Class ="$Type[1]";
$Color = "$Type[4]";
$Sk = $Dmg * $Type[3] / 100;
$Dmg = $Dmg + ($Sk)/2;
$Sk = $ILVL * $Type[3] / 100;
$ILVL = $ILVL + $Sk;}
else if ($Title < $Type2[2]){
$Class ="$Type2[1]";
$Color = "$Type2[4]";
$Sk = $Dmg * $Type2[3] / 100;
$Dmg = $Dmg + ($Sk)/2;
$Sk = $ILVL * $Type2[3] / 100;
$ILVL = $ILVL + $Sk;}

while ($Ench = mysqli_fetch_array($Enchant)) {
	if ($Ench[1] > rand(-200,400-$n1)){
		$elvl = $elvl +1;
		}
	else{break;}
}

if ($elvl > 0){
$Plius = mysqli_query($db,"SELECT * FROM enchantdrop WHERE `Enchant Lvl` = '$elvl'");
$Plius = mysqli_fetch_row($Plius);
$NE = "+ $elvl";
$Sk = $Dmg * $Plius[2] / 100;
$Dmg = $Dmg + $Sk;
$Sk = $ILVL * $Plius[2] / 100;
$ILVL = $ILVL + $Sk;
}

$ILVL = round($ILVL, 0);
$Dmg = round($Dmg, 0);

if($Dmg < 0){
	$Dmg = 1;}

$Name="$N1 $N3 $N4 $NE";
$NameO="$N1 $N3 $N4 $NE";


if (!$Class == ""){
	$new = "<b class='$Color'>$Name ($Class)</b>";}
	else{
	$new = "<b>$Name</b>";}


$RMG = $MLVL*1.2;
$RMGmin = $MLVL/1.5;

if ($ILVL < $RMG and $ILVL > $RMGmin){
	$rel = 1;}


}*/
//creates armor function
list($iLVL, $armor, $name, $new, $nameType) = itemDrop("armor",$MLVL);
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