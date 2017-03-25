<?php
session_start();
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>World of RNG</title>
<link rel="stylesheet" type="text/css" href="css/meniu.css">
</head>
<body>
<header>
World Of RNG
</header>
<?php
include_once 'PHP/db.php';

$User = $_SESSION["User"];

$Name = $_SESSION["Name"];
$Bonus = $_SESSION["Bonus"];
$Chanse = $_SESSION["Chanse"];	

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$WEP = mysqli_query($db,"SELECT * FROM weapondrops where HASH = '$ACC[1]' ");
$WEP = mysqli_fetch_row($WEP);

$c1 = rand(1,100);
 
if ( $c1 <= $Chanse){
	
$enc = $WEP[15] + 1;
	
$order2 = "UPDATE weapondrops
SET plus = '$enc'
WHERE `HASH` = '$ACC[1]'";

$result = mysqli_query($db, $order2);	

$result = mysqli_query($db, $order3);	
mysqli_close($db);
$_SESSION["rezult"] = 1;
header("location:rez.php");	
}

else{
	$_SESSION["rezult"] = 0;
	header("location:rez.php");
}
?>