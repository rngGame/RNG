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


$User = $_SESSION["User"];

$WepName = $_SESSION["WepName"];
$Type = $_SESSION["Type"];
$ilvl = $_SESSION["ilvl"];
$DMG = $_SESSION["DMG"];
$Color = $_SESSION["Color"];

$hash1 = rand(1,999999999999999);
$hash2 = rand(-999,9999);
$hash= $hash1 * $hash2 *-1;

$result = mysqli_query($db,"SELECT * FROM drops WHERE HASH = '$hash'");
$count = mysqli_num_rows($result);
if($count==1){echo 'ERROR';}
else {


$order = "INSERT INTO drops
	   (Name, Type, ilvl, dmg, color, HASH)
	  VALUES
	   ('$WepName','$Type','$ilvl','$DMG', '$Color', '$hash')";
	   
$order2 = "UPDATE characters
SET Arm_h = '$hash'
WHERE `User` = '$User'";

$myfile = fopen("Logs/Drops.txt", "x+");
$myfile = fopen("Logs/Drops.txt", "a+") or die("Unable to open file!");
$txt = "$User - $WepName ($Type)\r\n";
fwrite($myfile, $txt);
$txt = "<>\r\n";
fwrite($myfile, $txt);
fclose($myfile);


$result = mysqli_query($db, $order);	
$result = mysqli_query($db, $order2);	
mysqli_close($db);
header("location:sync.php");
;}
//header("location:keepA.php");
?>