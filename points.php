<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

session_start();
ob_start();

include_once 'PHP/db.php';

$User = $_SESSION["User"];


$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$User' ");
$PNT = mysqli_fetch_row($PNT);

$ST = "LAbas $User";

$Button = " ";

$Point = "$PNT[1]";

echo "data: $Point \n\n";
echo "retry: 1000\n\n";
flush();

?>