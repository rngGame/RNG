<?php
session_start();
ob_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"];  
$hash = $_SESSION["HASH"];


$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$LOOT = mysqli_query($db,"SELECT * FROM Gems where HASH = '$hash' ");
$LOOT = mysqli_fetch_row($LOOT);


	$order = "UPDATE characters
	SET Gem_h = '$hash'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order);	




mysqli_close($db);
header("location:sync.php");
die();

?>