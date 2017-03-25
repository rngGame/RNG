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
$TOP1 = $_SESSION["TOP"];
$IDB = $_SESSION["IDB"];

if ($TOP1 == ""){
	$TOP1 = $User;}

$WepName = $_SESSION["WepName"];
$Type = $_SESSION["Type"];
$ilvl = $_SESSION["ilvl"];
$DMG = $_SESSION["DMG"];
$Color = $_SESSION["Color"];

if(isset($_SESSION["iSkill"])){
$skill = $_SESSION["iSkill"];}
else{
	$skill = 0;};

echo "$WepName $Type $ilvl $DMG $Color";
$hash1 = rand(1,999999999999999);
$hash2 = rand(-999,9999);
$hash= $hash1 * $hash2 *-1;

$result = mysqli_query($db,"SELECT * FROM drops WHERE HASH = '$hash'");
$count = mysqli_num_rows($result);
if($count==1){echo 'ERROR';}
else {


$order = "INSERT INTO drops
	   (Name, Type, ilvl, dmg, color, HASH, iSkill)
	  VALUES
	   ('$WepName','$Type','$ilvl','$DMG', '$Color', '$hash', '$skill')";
	   
$order2 = "INSERT INTO inventor
(User, Hash)
VALUES
('$TOP1','$hash')";	   

$order3 = "UPDATE wboss
SET `HASH` = '$hash'
WHERE `ID` = '$IDB'";
$result = mysqli_query($db, $order3);	

$order4 = "UPDATE wboss
SET `Killer` = '$User'
WHERE `ID` = '$IDB'";
$result = mysqli_query($db, $order4);	

$myfile = fopen("Logs/Drops.txt", "x+");
$myfile = fopen("Logs/Drops.txt", "a+") or die("Unable to open file!");
$txt = "$TOP1 - $WepName ($Type)\r\n";
fwrite($myfile, $txt);
$txt = "<>\r\n";
fwrite($myfile, $txt);
fclose($myfile);

$result = mysqli_query($db, $order);	
$result = mysqli_query($db, $order2);	

$_SESSION["HASH"] = $hash;



mysqli_close($db);
header("location:show.php");
;}






echo "$hash";

?>