<?php
session_start();
ob_start();
include_once 'PHP/db.php';

$Base = mysqli_query($db,"SELECT * FROM basewep Order by RAND() Limit 	1");
$Base = mysqli_fetch_row($Base);
$Pre = mysqli_query($db,"SELECT * FROM prefixwep Order by RAND() Limit 	1");
$Pre = mysqli_fetch_row($Pre);
$Sub = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit 	1");
$Sub = mysqli_fetch_row($Sub);
$Sub2 = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit 	1");
$Sub2 = mysqli_fetch_row($Sub2);
$Type = mysqli_query($db,"SELECT * FROM types Order by RAND() Limit 	1");
$Type = mysqli_fetch_row($Type);

$Enchant = mysqli_query($db,"SELECT * FROM enchantdrop");

$User = $_SESSION["User"];

$WepName = $_SESSION["WepName"];
$Type = $_SESSION["Type"];
$ilvl = $_SESSION["ilvl"];
$DMG = $_SESSION["DMG"];
$Color = $_SESSION["Color"];


mysqli_close($db);
header("location:sync.php");









?>