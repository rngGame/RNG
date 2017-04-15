<?php
session_start();
ob_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"];

$AC = mysqli_query($db,"SELECT * FROM account where user = '$User' ");
$AC = mysqli_fetch_row($AC);


$value = "$AC[3]";
setcookie("Theme", $value);


if ($User == ""){
		session_destroy();
		echo "NX?";
 $send="location:index.php";
	}
else{
$send="location:game.php";
}


$insert = mysqli_query($db,"SELECT EXISTS(SELECT * FROM passive where USER = '$User') ");
$insert = mysqli_fetch_row($insert);

if ($insert[0] ==0){

	$order2 = "INSERT INTO passive
	   (USER, xp1, sp1, lvl1, xp2, sp2, lvl2, xp3, sp3, lvl3, xp4, sp4, lvl4)
	  VALUES
	   ('$User', '1','0','0', '1','0','0', '1','0','0', '1','0','0')";
	   $result = mysqli_query($db, $order2);	
 
};

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

//of shards 0
if ($ACC[15] < 0 ) {
	$shard = 0;	   
$checkmonSH = "UPDATE characters SET Shards = '$shard' WHERE `User` = '$User'";
$checkmonSH = mysqli_query($db, $checkmonSH);	
};



if ($ACC[4] < 10) {
	$cash = 20;	   
$checkmon = "UPDATE characters SET Cash = '$cash' WHERE `User` = '$User'";
$checkmon = mysqli_query($db, $checkmon);	
};


$PAS = mysqli_query($db,"SELECT * FROM passive where USER = '$User' ");
$PAS = mysqli_fetch_row($PAS);

$pasl1 = $PAS[3] + 1;
$pasl2 = $PAS[6] + 1;
$pasl3 = $PAS[9] + 1;
$pasl4 = $PAS[12] + 1;


$PAS2 = mysqli_query($db,"SELECT EXISTS(SELECT * FROM skillxp where LVL = '$pasl1') ");
$plvl1 = mysqli_fetch_row($PAS2);

if ($plvl1[0] ==1){
	$PAS2 = mysqli_query($db,"SELECT * FROM skillxp where LVL = '$pasl1'");
	$plvl1 = mysqli_fetch_row($PAS2);

if ($PAS[1] > $plvl1[1]) {
	echo"DARO";
	$order1 = "UPDATE passive
	SET lvl1 = '$plvl1[0]'
	WHERE `USER` = '$User'";
	
	$fas=$plvl1[0]*2;
	
	$order2 = "UPDATE passive
	SET sp1 = '$fas'
	WHERE `USER` = '$User'";
$result = mysqli_query($db, $order1);
$result = mysqli_query($db, $order2);
	
	;}}
	
$PAS2 = mysqli_query($db,"SELECT EXISTS(SELECT * FROM skillxp where LVL = '$pasl2') ");
$plvl2 = mysqli_fetch_row($PAS2);
if ($plvl2[0] ==1){
	$PAS2 = mysqli_query($db,"SELECT * FROM skillxp where LVL = '$pasl2'");
	$plvl2 = mysqli_fetch_row($PAS2);

if ($PAS[4] > $plvl2[1]) {
	
	$order1 = "UPDATE passive
	SET lvl2 = '$plvl2[0]'
	WHERE `USER` = '$User'";
	
	
	$order2 = "UPDATE passive
	SET sp2 = '$plvl2[0]'
	WHERE `USER` = '$User'";
$result = mysqli_query($db, $order1);
$result = mysqli_query($db, $order2);
	
	;}}
	
$PAS2 = mysqli_query($db,"SELECT EXISTS(SELECT * FROM skillxp where LVL = '$pasl3') ");
$plvl3 = mysqli_fetch_row($PAS2);

if ($plvl3[0] ==1){
	$PAS2 = mysqli_query($db,"SELECT * FROM skillxp where LVL = '$pasl3'");
	$plvl3 = mysqli_fetch_row($PAS2);

if ($PAS[7] > $plvl3[1]) {
	
	$order1 = "UPDATE passive
	SET lvl3 = '$plvl3[0]'
	WHERE `USER` = '$User'";
	
	$fas=$plvl3[0]*10;
	
	$order2 = "UPDATE passive
	SET sp3 = '$fas'
	WHERE `USER` = '$User'";
$result = mysqli_query($db, $order1);
$result = mysqli_query($db, $order2);
	
	;}}
	


$PAS2 = mysqli_query($db,"SELECT EXISTS(SELECT * FROM skillxp where LVL = '$pasl4') ");
$plvl4 = mysqli_fetch_row($PAS2);

if ($plvl4[0] ==1){
	$PAS2 = mysqli_query($db,"SELECT * FROM skillxp where LVL = '$pasl4'");
	$plvl4 = mysqli_fetch_row($PAS2);

if ($PAS[10] > $plvl4[1]) {
	
	$order1 = "UPDATE passive
	SET lvl4 = '$plvl4[0]'
	WHERE `USER` = '$User'";
	
	$fas=$plvl4[0]*2.5;
	$fas=round($fas);
	
	$order2 = "UPDATE passive
	SET sp4 = '$fas'
	WHERE `USER` = '$User'";
$result = mysqli_query($db, $order1);
$result = mysqli_query($db, $order2);
	
	;}}

$lvlc = 0;
while ($lvlc == 0){
$lvlc = 1;
$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
$lvlx = $ACC[3] + 1;

$XPLc = mysqli_query($db,"SELECT EXISTS(SELECT * FROM levels WHERE LVL = '$lvlx')");
$XPLc = mysqli_fetch_row($XPLc);
if ($XPLc[0] ==1){

$XP = mysqli_query($db,"SELECT * FROM levels where LVL = '$lvlx' ");
$XP = mysqli_fetch_row($XP);

$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$User' ");
$PNT = mysqli_fetch_row($PNT);

if ($ACC[5] > $XP[1]) {
	
	$newP = $PNT[1] + 1;
	
	
	$lvlc = 0;	
	$order1 = "UPDATE characters
	SET LVL = '$XP[0]'
	WHERE `User` = '$User'";
	
	
	$order2 = "UPDATE characters
	SET HP = '$XP[2]'
	WHERE `User` = '$User'";
	
	$order3 = "UPDATE Points
	SET Free = '$newP'
	WHERE `User` = '$User'";
	
	

$result = mysqli_query($db, $order1);
$result = mysqli_query($db, $order2);
$result = mysqli_query($db, $order3);

	;}
	;}
	;}


	include 'PHP/ach.php';



$RNK = mysqli_query($db,"SELECT * FROM Ranks order by Nr desc ");
while ( $RNKs = mysqli_fetch_array($RNK)){
	if ($RNKs[1] < $ACC[11] and $ACC[11] < $RNKs[2]){
		$order = "UPDATE characters
		SET Color = '$RNKs[3]'
		WHERE `User` = '$User'";
		$result = mysqli_query($db, $order);	
		}
}


$datetime = date_create()->format('Y-m-d H:i:s');
$datetime = strtotime($datetime);
$datetime = $datetime+300;
$datetime = date('Y-m-d H:i:s',$datetime);


$ONL = mysqli_query($db,"SELECT * FROM Online where user = '$User' Order by RAND() Limit 	1");
$ONL = mysqli_fetch_row($ONL);

if ($ONL[0] == "$User"){
	$order = "UPDATE Online
	SET Time = '$datetime'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order);	
}
else{
	
	$order = "INSERT INTO Online
	  (User, Time)
	 	VALUES
	   ('$User', '$datetime')";
	  	$result = mysqli_query($db, $order);	}
	
	session_destroy();
	session_start();
	$_SESSION["User"] = $User;
	
if ($ACC[3] > 19 and $ACC[10] == 0){
	header("location:class.php");
	die();}
if ($ACC[3] > 39 and $ACC[10] <> 0 and $ACC[10] < 11 ){
	header("location:class.php");
	die();}
else{
mysqli_close($db);			
header("$send");
die();
};
?>