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
session_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"];

$Class = $_POST["cls"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);


$order3 = "UPDATE characters
SET Class = '$Class'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order3);
mysqli_close($db);
header("location:sync.php");	
?>