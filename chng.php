<?php
session_start();
ob_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"];
$Account = $_SESSION["Account"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);


if (isset($_POST['change'])) {
    
	$new = $_POST['change'];

	$order = "UPDATE characters
	SET `Title` = '$new'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order);	}
	
	
	//get achievment
$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$Account' and Name = 'CHACH'");
	$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$Account', 'CHACH', '1')";
	$result = mysqli_query($db, $order);}
	

header("location:sync.php");
?>