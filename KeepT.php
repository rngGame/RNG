<?php
session_start();
ob_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"];

$Name0 = $_SESSION["WepName"];
$Class = $_SESSION["Type"];
$ILVL = $_SESSION["ilvl"];
$DMG = $_SESSION["DMG"];
$ARMOR = $_SESSION["ARMOR"];
$HP = $_SESSION["HEALTH"];
$XP = $_SESSION["XP"];
$color = $_SESSION["Color"];



$hash1 = rand(1,999999999999999);
$hash2 = rand(-999,9999);
$hash= $hash1 * $hash2 *-1;

$result = mysqli_query($db,"SELECT * FROM dropst WHERE HASH = '$hash'");
$count = mysqli_num_rows($result);
if($count==1){echo 'ERROR';}
else {


$order = "INSERT INTO dropst
	   (NAME,LVL,DMG,HP, ARMOR, XP, HASH, Type, Color)
	  VALUES
	   ('$Name0','$ILVL','$DMG','$HP','$ARMOR','$XP','$hash','$Class','$color')";
	   
$order2 = "UPDATE characters
SET Tali_h = '$hash'
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
//header("location:keepT.php");


?>