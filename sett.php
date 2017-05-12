<?php
session_start();
ob_start();

$User = $_SESSION["User"];
$Account = $_SESSION["Account"];

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

//delete character
if(isset($_GET['formDelete'])){
	$char = $_GET['formDelete'];
	
	$sql2="DELETE FROM characters WHERE User ='$char' and Account = '$Account'";
	mysqli_query($db,$sql2);
	
	$sqldel="DELETE FROM Party WHERE PL1='$char'";
	mysqli_query($db,$sqldel);
	
	$sql1="DELETE FROM Equiped WHERE User ='$char'";
	mysqli_query($db,$sql1);
	
	
	

}

header("location:sync.php");
die();

?>