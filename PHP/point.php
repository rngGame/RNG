<?php
session_start();
ob_start();

include_once 'PHP/db.php';

$User = $_SESSION["User"];

$Stat = $_POST['STAT'];

$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$User' ");
$PNT = mysqli_fetch_row($PNT);

$current = $PNT[$Stat];
$New = 1 + 1;


$order = "UPDATE Points
			SET $Stat = '$New'
			WHERE `User` = '$User'";
			$result = mysqli_query($db, $order);

?>
