<?php
session_start();
ob_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);


if (isset($_POST['change'])) {
    
	$new = $_POST['change'];

	$order = "UPDATE characters
	SET `Title` = '$new'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order);	}
	

header("location:game.php");
?>