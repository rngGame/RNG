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

$Shard = $ACC[15] + $LOOT[4];


	$order = "UPDATE characters
	SET Shards = '$Shard'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order);	

	$order2 = "DELETE FROM Gems
	WHERE `HASH` = '$hash'";
	$result = mysqli_query($db, $order2);


mysqli_close($db);
header("location:sync.php");







//header("location:keep.php");

?>