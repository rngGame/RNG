<?php
session_start();
ob_start();
$User = $_SESSION["User"];

include_once 'PHP/db.php';
$MLVL = $_SESSION["MonsLVL"];
$sell = $_SESSION["Sell"];
$Drop = $_SESSION["MonsDrop"];
$Money = $_SESSION["Money"];

$rel = 0;

while ($rel == 0){

$Base = mysqli_query($db,"SELECT * FROM basetalis Order by RAND() Limit 	1");
$Base = mysqli_fetch_row($Base);
$Pre = mysqli_query($db,"SELECT * FROM pretalis Order by RAND() Limit 	1");
$Pre = mysqli_fetch_row($Pre);
$Sub = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit 	1");
$Sub = mysqli_fetch_row($Sub);
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


$c2 = rand(1,99-$n3);
$c3 = rand(1,99-$n3);
$c4 = rand(1,150-$n4);
$Title = rand(0,500-$r);


$N1 = $Base[1];
$ILVL = $Base[2];
$Dmg = $Base[3];
$Armor = $Base[4];
$Health = $Base[5];
$xp = $Base[6];


if ($c2 < 30){
$N2 = $Pre[1];
$Dmg = $Dmg * $Pre[2];
$Armor = $Armor * $Pre[2];
$Health = $Health * $Pre[2];
$xp = $xp * $Pre[2];
$ILVL = $ILVL + $Pre[3];}

if ($c3 < 30){	
$N3 ="and $Sub[1]";
$Dmg = $Dmg + abs($Sub[3]);
$Armor = $Armor + (abs($Sub[3])/3);
$Health2 = $Health * abs($Sub[3])/200;
$Health = $Health + $Health2;
$xp = $xp * 1.2;
$ILVL = $ILVL + $Sub[2];}

if ($Title < $Type[2]){
$Class ="$Type[1]";
$Color = "$Type[4]";
$Sk = $Dmg * $Type[3] / 100;
$Dmg = $Dmg + $Sk;
$Sk = $Health * $Type[3] / 100;
$Health = $Health + $Sk;
$Sk = $Armor * $Type[3] / 200;
$Armor = $Armor + $Sk;
$Sk = $ILVL * $Type[3] / 100;
$ILVL = $ILVL + $Sk;}
else if ($Title < $Type2[2]){
$Class ="$Type2[1]";
$Color = "$Type2[4]";
$Sk = $Dmg * $Type2[3] / 100;
$Dmg = $Dmg + $Sk;
$Sk = $Health * $Type2[3] / 100;
$Health = $Health + $Sk;
$Sk = $Armor * $Type2[3] / 200;
$Armor = $Armor + $Sk;
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
$Sk = $Health * $Plius[2] / 100;
$Health = $Health + $Sk;
$Sk = $Armor * $Plius[2] / 100;
$Armor = $Armor + $Sk;
}

$ILVL = round($ILVL, 0);
$Dmg = round($Dmg, 0);
$Health = round($Health, 0);
$Armor = round($Armor, 0);
$xp = round($xp, 1);

if($Dmg < 0){
	$Dmg = 1;}

$Name="$N2 $N1 $N3 $NE";
$NameO="$N2 $N1 $N3 $NE";

$cash = $ILVL*$sell;

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$TAL = mysqli_query($db,"SELECT * FROM dropst where HASH = '$ACC[8]' ");
$TAL = mysqli_fetch_row($TAL);

if (!$Class == ""){
	$new = "<b class='$Color'>$Name ($Class)</b>";}
	else{
	$new = "<b>$Name</b>";}

if (!$TAL[8] == ""){
	$Current = "<b class='$TAL[9]'>$TAL[1] ($TAL[8])</b>";}
	else{
	$Current = "$TAL[1]";}

$time = $_SESSION["times"];

$RMG = $MLVL*1.2;
$RMGmin = $MLVL/1.5;

if ($ILVL < $RMG and $ILVL > $RMGmin){
	$rel = 1;}


}

$MoneyRew = ($ACC[3] + $MLVL) * 10; //gold for mob
$_SESSION["GoldRew"] = $MoneyRew;

$MoneySel = ($ACC[3] + $ILVL) * 10; //gold for wep
$_SESSION["Gold"] = $MoneySel;


//Comparing
$compareLVL=$compareDMG=$compareHP=$compareARM=$compareXP="less";
if($ILVL>$TAL[2]){
	$compareLVL="more";
}
if($Dmg>$TAL[3]){
	$compareDMG="more";
}
if($Health>$TAL[4]){
	$compareHP="more";
}
if($Armor>$TAL[5]){
	$compareARM="more";
}
if($xp>$TAL[6]){
	$compareXP="more";
}

$reward = "<b><font color='lightgreen'><br> -TALISMAN !- </font><br><br>DROP:</b><br><br>Name: $new<br>
Item lvl: <b><span class='$compareLVL'>$ILVL</span></b><br>
Item Damage: <b><span class='$compareDMG'>$Dmg</span></b><br>
Item Health: <b><span class='$compareHP'>$Health</span></b><br>
Item Armor: <b><span class='$compareARM'>$Armor</span></b><br>
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

$XPT = $_SESSION["XPT"];
$XPS  = $Drop * $XPT;
$_SESSION["XPS"] = $XPS;
$xp = $ACC[5] + $Drop * $XPT;
	   
$order2 = "UPDATE characters
SET XP = '$xp'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order2);	

$kills = $ACC[6] +1;

$cash = ($ACC[4] - $Money) + $MoneyRew;
	   
$order3 = "UPDATE characters
SET Kills = '$kills'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order3);	

$order4 = "UPDATE characters
SET Cash = '$cash'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order4);

$PAS = mysqli_query($db,"SELECT * FROM passive where USER = '$User' ");
$PAS = mysqli_fetch_row($PAS);

$XPPA  = $MLVL * $XPT;
$XPPA=round($XPPA);
$_SESSION["XPPA"] = $XPPA;
$XPP=($MLVL * $XPT) + $PAS[7];
$XPP=round($XPP);

$order5 = "UPDATE passive
SET xp3= '$XPP'
WHERE `USER` = '$User'";

$result = mysqli_query($db, $order5);

$S1 = rand(1,100);
$S2 = rand(1,15);

if ($S1 <  10){
$Shards = $ACC[15] + $S2;
$order6 = "UPDATE characters
SET Shards= '$Shards'
WHERE `USER` = '$User'";
$result = mysqli_query($db, $order6);
$_SESSION["SHD"] = $S2;
}

mysqli_close($db);
header("location:rewardt.php");

?>