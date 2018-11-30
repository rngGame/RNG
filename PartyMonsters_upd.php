<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
session_start();

include_once 'PHP/db.php';



$User = $_SESSION["User"]; //user

$Player1 = mysqli_query($db,"SELECT * FROM Party where PL1 = '$User' ");
$Player = mysqli_fetch_assoc($Player1); //GLOVES by colum name


//ID
$PartyS = mysqli_query($db,"SELECT * FROM Party where PL1 = '$User' or PL2 = '$User' or PL3 = '$User' or PL4 = '$User'  ");
$Party = mysqli_fetch_assoc($PartyS); //Party

$PLS= mysqli_query($db,"SELECT * FROM Party where PL1 = '$User'");
$PL = mysqli_fetch_assoc($PLS);

if ($PL["PL1"] == $User){
	$PLnr = "PL1";}
if ($PL["PL2"] == $User){
	$PLnr = "PL2";}
if ($PL["PL3"] == $User){
	$PLnr = "PL3";}
if ($PL["PL4"] == $User){
	$PLnr = "PL4";}
	
		$plCount = 0;
	if ($Party["PL1"] <> ""){
		$plCount += 1 ;}
	if ($Party["PL2"] <> ""){
		$plCount += 1 ;}
	if ($Party["PL3"] <> ""){
		$plCount += 1 ;}
	if ($Party["PL4"] <> ""){
		$plCount += 1 ;}


//average dmg recalculate
$avgP = round(($minPdmg + $maxPdmg) / 2);
$avgM = round(($minMdmg + $maxMdmg) / 2);
$avgD = round(($avgP + $avgM) / 2);


$Monster = mysqli_query($db,"SELECT * FROM PartyMonsters where PartyID = '$Party[ID]' ");
$MonsterS = mysqli_fetch_assoc($Monster); //GLOVES by colum name
include 'PHP/rounding.php';
if ($MonsterS["PL1"] > 0){ //plasyer 1
	$PL1 = mysqli_query($db,"SELECT * FROM Party where ID = '$Party[ID]' ");
	$PL1s = mysqli_fetch_assoc($PL1); //GLOVES by colum name

	$playersDMG .= "$PL1s[PL1] did $MonsterS[PL1] dmg. ";
	;}
	
if ($MonsterS["PL2"] > 0){ //player 2
	$PL2 = mysqli_query($db,"SELECT * FROM Party where ID = '$Party[ID]' ");
	$PL2s = mysqli_fetch_assoc($PL2); //GLOVES by colum name
	$playersDMG .= "/ $PL2s[PL2] did $MonsterS[PL2] dmg. ";
	;}
	
if ($MonsterS["PL3"] > 0){ //player 3
	$PL3 = mysqli_query($db,"SELECT * FROM Party where ID = '$Party[ID]' ");
	$PL3s = mysqli_fetch_assoc($PL3); //GLOVES by colum name
	$playersDMG .= "/ $PL3s[PL3] did $MonsterS[PL3] dmg. ";
	;}
	
if ($MonsterS["PL4"] > 0){ //player 4
	$PL4 = mysqli_query($db,"SELECT * FROM  Party where ID = '$Party[ID]' ");
	$PL4s = mysqli_fetch_assoc($PL4); //GLOVES by colum name
	$playersDMG .= "/ $PL4s[PL4] did $MonsterS[PL4] dmg. ";
	;}
	
// mob have def
$DEF = $MonsterS["MonsterLVL"]/2;
$DEF = round($DEF + ($DEF * ($plCount * 30)));
$defMon = " Armor:<font color='#FF804C'> $DEF</font>, ";

//k,kk,kkk
	$mHPN = $MonsterS[MonsterHP];
	$mHPN = "$MonsterS[MonsterHP]";
if ($MonsterS[MonsterHP] > 1000){
	$mHPN = round($MonsterS[MonsterHP]/1000,1);
	$mHPN = "$mHPN k.";
}
if ($MonsterS[MonsterHP] > 1000000){
	$mHPN = round($MonsterS[MonsterHP]/1000000,1);
	$mHPN = "$mHPN kk.";
}
if ($MonsterS[MonsterHP] > 10000000000){
	$mHPN = round($MonsterS[MonsterHP]/1000000000,1);
	$mHPN = "$mHPN kkk.";
}


$Chat = "<img src='IMG/Mon/2.jpg' width='60' height='60'><br>Monster Name: <b>$MonsterS[MonsterName]</b><br>HP: $mHPN, DMG: <font color='red'>~$MonsterS[MonsterPhyDMG]</font>/<font color='0066ff'>~$MonsterS[MonsterMagDMG]</font>,$defMon XP: $MonsterS[MonsterRew], Lvl: $MonsterS[MonsterLVL]<br><br>$playersDMG";



echo "data: $Chat\n\n";
echo "retry: 100\n\n";
flush();
?>