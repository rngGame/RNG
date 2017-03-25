<?php
session_start();
include_once 'PHP/db.php';

$User = $_GET["IDS"];

$ACC = mysqli_query($db,"SELECT * FROM Temp where ID = '$User' ");
$ACC = mysqli_fetch_row($ACC);
$Volt = $ACC[1];
echo "Prietaiso ID: $User<br>";
echo "Itampa: $Volt";	

?>