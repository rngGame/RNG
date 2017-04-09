<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

include_once 'PHP/db.php';

//average dmg recalculate
$avgP = round(($minPdmg + $maxPdmg) / 2);
$avgM = round(($minMdmg + $maxMdmg) / 2);
$avgD = round(($avgP + $avgM) / 2);


$Monster = mysqli_query($db,"SELECT * FROM PartyMonsters where PartyID = '1' ");
$MonsterS = mysqli_fetch_assoc($Monster); //GLOVES by colum name

if ($MonsterS["PL1"] > 0){ //plasyer 1
	$PL1 = mysqli_query($db,"SELECT * FROM Party where ID = '1' ");
	$PL1s = mysqli_fetch_assoc($PL1); //GLOVES by colum name
	$playersDMG .= "$PL1s[Master] did $MonsterS[PL1] dmg. ";}
	
if ($MonsterS["PL2"] > 0){ //player 2
	$PL2 = mysqli_query($db,"SELECT * FROM Party where ID = '1' ");
	$PL2s = mysqli_fetch_assoc($PL2); //GLOVES by colum name
	$playersDMG .= "/ $PL2s[PL2] did $MonsterS[PL2] dmg. ";}
	
if ($MonsterS["PL3"] > 0){ //player 3
	$PL3 = mysqli_query($db,"SELECT * FROM Party where ID = '1' ");
	$PL3s = mysqli_fetch_assoc($PL3); //GLOVES by colum name
	$playersDMG .= "/ $PL3s[PL3] did $MonsterS[PL3] dmg. ";}
	
if ($MonsterS["PL4"] > 0){ //player 4
	$PL4 = mysqli_query($db,"SELECT * FROM  Party where ID = '1' ");
	$PL4s = mysqli_fetch_assoc($PL4); //GLOVES by colum name
	$playersDMG .= "/ $PL4s[Master] did $MonsterS[PL4] dmg. ";}

$Chat = "<img src='IMG/Mon/2.jpg' width='60' height='60'><br>Monster Name: <b>$MonsterS[MonsterName]</b><br>HP: $MonsterS[MonsterHP], DMG: <font color='red'>~$MonsterS[MonsterPhyDMG]</font>/<font color='0066ff'>~$MonsterS[MonsterMagDMG]</font>, XP: $MonsterS[MonsterRew], Lvl: $MonsterS[MonsterLVL]<br><br>$playersDMG";



echo "data: $Chat\n\n";
echo "retry: 1000\n\n";
flush();
?>