<?php
session_start();
ob_start();

include_once 'PHP/db.php';

$User = $_SESSION["User"];

$Stat = $_POST['STAT'];

if ($Stat == "STR"){
	$ST = 2;}
if ($Stat == "INTE"){
	$ST = 3;} 

$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$User' ");
$PNT = mysqli_fetch_row($PNT);

if ($PNT[1] <= 0){
	header("location:sync.php");
	die();
	}

$current = $PNT[$ST];
$New = 1 + $current;

$remo = $PNT[1] - 1;

$order = "UPDATE Points
			SET $Stat = '$New'
			WHERE `User` = '$User'";
			$result = mysqli_query($db, $order);
			
$order = "UPDATE Points
			SET Free = '$remo'
			WHERE `User` = '$User'";
			$result = mysqli_query($db, $order);
			
 mysqli_close($db);
header("location:sync.php");
die();
?>
