<?php
session_start();
ob_start();
include_once 'PHP/db.php';

$rel = 0;

while ($rel == 0){

$dbs = rand(0,100);
if ($dbs < 25){
	$dbs = "monster10";}
	else if  ($dbs < 50){
	$dbs = "monster50";}
		else if ($dbs < 75){
		$dbs = "monster10";}
			else {
			$dbs = "monster100";}
	
$N1 = "";	
$N2 = "";	
$N3 = "";
$N4 = "";
$N5 = "";
$NE = "";
$Class = "";	
$ILVL = 0;
$Dmg = 0;
$Drop = 0;
$elvl = 0;

$Base[0] = "";
$Base[1] = "";
$Base[2] = "";
$Base[3] = "";
$Base[4] = "";


$Base = mysqli_query($db,"SELECT * FROM $dbs Order by RAND() Limit 	1");
$Base = mysqli_fetch_row($Base);

$Pref = mysqli_query($db,"SELECT * FROM monspre Order by RAND() Limit 	1");
$Pref = mysqli_fetch_row($Pref);

$Sub = mysqli_query($db,"SELECT * FROM monssub Order by RAND() Limit 	1");
$Sub = mysqli_fetch_row($Sub);

$ench = mysqli_query($db,"SELECT * FROM monsenchant Order by RAND() Limit 	1");
$ench = mysqli_fetch_row($ench);




$c1 = rand(1,100);
$c2 = rand(1,100);
$c3 = rand(1,100);
$c4 = rand(1,100);
$c5 = rand(1,200);

if ($c1 <> 0){
$Name = $Base[0];
$HP = $Base[1];
$LVL = $Base[2];
$DMG = $Base[3];}

if ($c2 < 80){
$N2 = $Pref[0];
$HP = $HP * $Pref[2];
$DMG = $DMG * $Pref[3];
$LVL = $LVL + $Pref[4];}

if ($c3 < 70){
$N3 = $Sub[0];
$HP = $HP * $Sub[2];
$LVL = $LVL + $Sub[4];
$DMG = $DMG * $Sub[3];}

if ($c4 < 60){
$N4 = $ench[0];
$HP = $HP * $ench[2];
$LVL = $LVL + $ench[1];
$DMG = $DMG * $ench[2];}

$HP = $HP * 100;
$LVL = $LVL * 2;
$DMG = $DMG * 2.2;
$LVL = round($LVL);

if ($LVL > 120){
	$rel = 1;}


}

$N1 = $Base[0];
echo "Monster Name: <b>$N4 $N2 $Name $N3</b><br>";
echo " HP: $HP, DMG: $DMG, Lvl: $LVL";
$Name2 = "$N4 $N2 $Name $N3";
$_SESSION["MonsHP"] = $HP;
$_SESSION["MonsDMG"] = $DMG;
$_SESSION["MonsLVL"] = $LVL;

$order2 = "INSERT INTO wboss
	   (Name, LVL, DMG, HP)
	  VALUES	
	   ('$Name2', '$LVL', '$DMG', '$HP')";
	   $result = mysqli_query($db, $order2);
	   

	   mysqli_close($db);	
	   header("location:wBoss.php");
?>