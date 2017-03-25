<?php
session_start();
ob_start();

$User = $_SESSION["User"];

include_once 'PHP/db.php';


if(isset($_GET['formTheme'])){
	$val = $_GET['formTheme'];
	if ( $val ==  "LIG"){
		
	$order = "UPDATE account
	SET Theme = 'meniu'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order);	
	}
	
	if ( $val == "DAR"){
	$order2 = "UPDATE account
	SET `Theme` = 'meniu_dark'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order2);	

	}
	

}
header("location:sync.php");


?>