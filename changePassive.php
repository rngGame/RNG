<?php
session_start();
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>World of RNG</title>
<?php
echo "<link rel='stylesheet' type='text/css' href='css/$_COOKIE[Theme].css'>";
?>
<link rel="icon" href="favicon.png">
</head>
<header>
<body>
<?php
session_start();
include_once 'PHP/db.php';
	
$User = $_SESSION["User"]; //user
	
	
$selected = $_POST[skl];
$skillP = str_split($selected);	

//skill
echo $skilNR = $skillP[1];
if ($skilNR == "a"){
	$skilNR = 10;
}
$skilNR = $skilNR - 1;	

	
//vesrion
$sklVR = $skillP[2];	
	

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
	

$TRE = mysqli_query($db,"SELECT * FROM passiveTree where Name = '$User' ");
$TRE = mysqli_fetch_row($TRE);	
	
//make every string individual
$arrayP = str_split($TRE[1]);
	
$arrayP[$skilNR] = $sklVR;	
	
$result = implode($arrayP);	
	
$order = "UPDATE passiveTree
SET Passive = '$result'
WHERE `Name` = '$User'";
$result = mysqli_query($db, $order);	
	

header("location:Skillupgrade.php");
die();

?>