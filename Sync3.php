<?php
session_start();
ob_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"];

$mName = $_SESSION["MonsName"];
$myfile = fopen("Logs/$User.txt", "x+");
$myfile = fopen("Logs/$User.txt", "a+") or die("Unable to open file!");
$txt = "$User Fleed from $mName\r\n";
fwrite($myfile, $txt);
$txt = "<>\r\n";
fwrite($myfile, $txt);
fclose($myfile);

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$lvlx = $ACC[3] + 1;

$XPLc = mysqli_query($db,"SELECT EXISTS(SELECT * FROM levels WHERE LVL = '$lvlx')");
$XPLc = mysqli_fetch_row($XPLc);
if ($XPLc[0] ==1){

$XP = mysqli_query($db,"SELECT * FROM levels where LVL = '$lvlx' ");
$XP = mysqli_fetch_row($XP);

if ($ACC[5] > $XP[1]) {
	
	$order1 = "UPDATE characters
	SET LVL = '$XP[0]'
	WHERE `User` = '$User'";
	
	$order2 = "UPDATE characters
	SET HP = '$XP[2]'
	WHERE `User` = '$User'";

$result = mysqli_query($db, $order1);
$result = mysqli_query($db, $order2);
	
	;}}
	
	session_destroy();
	session_start();
	$_SESSION["User"] = $User;
	
			mysqli_close($db);
header("location:sync.php");
?>