<?php
session_start();
$User = $_SESSION["User"];

include_once 'PHP/db.php';
$MLVL = $_SESSION["MonsLVL"];
$sell = $_SESSION["Sell"];
$Drop = $_SESSION["MonsDrop"];
$Money = $_SESSION["Money"];

$Base = mysqli_query($db,"SELECT * FROM BaseWep Order by RAND() Limit 	1");
$Base = mysqli_fetch_row($Base);
$Pre = mysqli_query($db,"SELECT * FROM PrefixWep Order by RAND() Limit 	1");
$Pre = mysqli_fetch_row($Pre);
$Sub = mysqli_query($db,"SELECT * FROM SubfixWep Order by RAND() Limit 	1");
$Sub = mysqli_fetch_row($Sub);
$Sub2 = mysqli_query($db,"SELECT * FROM SubfixWep Order by RAND() Limit 	1");
$Sub2 = mysqli_fetch_row($Sub2);
$Type = mysqli_query($db,"SELECT * FROM Types Order by RAND() Limit 	1");
$Type = mysqli_fetch_row($Type);
$Type2 = mysqli_query($db,"SELECT * FROM Types Order by RAND() Limit 	1");
$Type2 = mysqli_fetch_row($Type2);
$Skill = mysqli_query($db,"SELECT * FROM iSkills Order by RAND() Limit 	1");
$Skill = mysqli_fetch_row($Skill);

$Enchant = mysqli_query($db,"SELECT * FROM EnchantDrop");

$Class = "";	
$ILVL = 0;
$Dmg = 0;
$Sk = 0;
$elvl = 0;

$n1 = $MLVL/1;
$n2 = $MLVL/1.4;
$n3 = $MLVL/1.9;
$n4 = $MLVL/2.4;
$r = $n1 * 2.5;

$c2 = rand(1,99-$n2);
$c3 = rand(1,99-$n3);
$c4 = rand(1,150-$n4);
$Title = rand(0,500-$r);
$Skill2 = rand(0,400-$n3);

$N1 = $Base[1];
$Dmg = $Base[3];
$ILVL = $Base[2];
if ($c2 < 50){
$N2 = $Pre[1];
$Dmg = $Dmg + $Pre[3];
$ILVL = $ILVL + $Pre[2];}
if ($c3 < 20){	
$N3 ="of $Sub[1]";
$Dmg = $Dmg + $Sub[3];
$ILVL = $ILVL + $Sub[2];
if ($c4 < 30){
$N4 ="and $Sub2[1]";
$Dmg = $Dmg + $Sub2[3];
$ILVL = $ILVL + $Sub2[2];}}
if ($Title < $Type[2]){
$Class ="$Type[1]";
$Color = "$Type[4]";
$Sk = $Dmg * $Type[3] / 100;
$Dmg = $Dmg + $Sk;
$Sk = $ILVL * $Type[3] / 100;
$ILVL = $ILVL + $Sk;}
else if ($Title < $Type2[2]){
$Class ="$Type2[1]";
$Color = "$Type2[4]";
$Sk = $Dmg * $Type2[3] / 100;
$Dmg = $Dmg + $Sk;
$Sk = $ILVL * $Type2[3] / 100;
$ILVL = $ILVL + $Sk;}



while ($Ench = mysqli_fetch_array($Enchant)) {
	if ($Ench[1] > rand(-200,400-$n1)){
		$elvl = $elvl +1;
		}
	else{break;}
}

if ($elvl > 0){
$Plius = mysqli_query($db,"SELECT * FROM EnchantDrop WHERE `Enchant Lvl` = '$elvl'");
$Plius = mysqli_fetch_row($Plius);
$NE = "+ $elvl";
$Sk = $Dmg * $Plius[2] / 100;
$Dmg = $Dmg + $Sk;
$Sk = $ILVL * $Plius[2] / 100;
$ILVL = $ILVL + $Sk;
}

if ($Skill2 < 25){
	$ILVL = $ILVL + $Skill[7];
	$_SESSION["iSkill"] = $Skill[0];
	$Skil = $Skill[1];
}
else{
	$Skil = "None";};

$ILVL = round($ILVL, 0);
$Dmg = round($Dmg, 0);

if($Dmg < 0){
	$Dmg = 1;}

$Name="$N2 $N1 $N3 $N4 $NE";
$NameO="$N2 $N1 $N3 $N4 $NE";

if (!$Class == ""){
	$Name="<b style='color:#$Color'>$Name</b>";}
	else{
		$Name="<b>$Name</b>";
		$Color = '000000';}

$cash = $ILVL*$sell;

$ACC = mysqli_query($db,"SELECT * FROM Characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$WEP = mysqli_query($db,"SELECT * FROM Drops where HASH = '$ACC[1]' ");
$WEP = mysqli_fetch_row($WEP);

if ($WEP[8] == 0){
	$Skl2 = "None";
}
else{
	$SKL = mysqli_query($db,"SELECT * FROM iSkills where ID = '$WEP[8]' ");
	$SKL = mysqli_fetch_row($SKL);
	$Skl2 = $SKL[1];
};

if (!$Class == ""){
	$new = "<b>$Name <b style='color:#$Color'>($Class)</b></b>";}
	else{
	$new = "<b>$Name</b>";}

if (!$WEP[2] == ""){
	$Current = "<b style='color:#$WEP[5]'>$WEP[1] ($WEP[2])</b>";}
	else{
	$Current = "$WEP[1]";}

$time = $_SESSION["times"];

$RMG = $MLVL*2.5;
$RMGmin = $MLVL/3;

if ($time == 15){
	header("location:fleed.php");
}
else if ($ILVL > $RMG or $ILVL < $RMGmin){
	$time = $time + 1;
	$_SESSION["times"] = "$time";
	mysqli_close($db);
	header("location:rewcalc.php");}
	
else{


$Dmg1 = $Dmg * 1.05 * 1.05 * 1.05 * 1.1 * 1.1 * 1.1 * 1.1 * 1.15 * 1.15 * 1.15 * 1.2 * 1.2 * 1.2 * 1.3 * 1.3;
$Dmg1 = round($Dmg1);

//$Dmg2 = $WEP[4] * 1.05 * 1.05 * 1.05 * 1.1 * 1.1 * 1.1 * 1.1 * 1.15 * 1.15 * 1.15 * 1.2 * 1.2 * 1.2 * 1.3 * 1.3;
//$Dmg2 = round($Dmg2);

$reward = "<b><font color='red'><br> -WEAPON !-</font><br><br>DROP:</b><br><br>Name: $new<br>
Item lvl: <b>$ILVL</b><br>
Item Dmg: <b>$Dmg</b> <font size='1'><div class='tooltip'>($Dmg1)<span class='tooltiptext'>Max damage after enchant</span></div></font><br>
Item Skill: <b>$Skil</b><br>
Item worth: $cash Gold<br>
<br><b>Current item:</b><br>
Name: $Current <br>
Item lvl: <b>$WEP[3]</b><br>
Item Dmg: <b>$WEP[4]</b><br>
Item Skill: <b>$Skl2</b><br>";

$_SESSION["WepName"] = "$NameO";
$_SESSION["Type"] = "$Class";
$_SESSION["ilvl"] = "$ILVL";
$_SESSION["DMG"] = "$Dmg";
$_SESSION["Color"] = "$Color";
$_SESSION["Reward"] = "$reward";

$XPT = $_SESSION["XPT"];
$XPS  = $Drop * $XPT;
$_SESSION["XPS"] = $XPS;
$xp = $ACC[5] +  $XPT * $Drop;
	   
$order2 = "UPDATE characters
SET XP = '$xp'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order2);	

$kills = $ACC[6] +1;

$cash = $ACC[4] - $Money;
	   
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
$XPP=($MLVL * $XPT) + $PAS[1];
$XPP=round($XPP);

$order5 = "UPDATE passive
SET xp1= '$XPP'
WHERE `USER` = '$User'";


$result = mysqli_query($db, $order5);

mysqli_close($db);
header("location:reward.php");};
?>