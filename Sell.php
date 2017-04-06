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
$sell = $_SESSION["Gold"];
$HASH = $_SESSION["HASH"];

$Base = mysqli_query($db,"SELECT * FROM baseWep Order by RAND() Limit 	1");
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

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$cash = $ACC[4] + $sell;
	   
$order2 = "UPDATE characters
SET Cash = '$cash'
WHERE `User` = '$User'";
$result = mysqli_query($db, $order2);	

$rewType = $_SESSION["REWARDTYPE"];

$sql="DELETE FROM Equiped WHERE hash='$HASH'";
mysqli_query($db,$sql);

if($rewType == "WEP"){
$sql2="DELETE FROM DropsWep WHERE HASH='$HASH'";
mysqli_query($db,$sql2);
}

if($rewType == "ARM"){
$sql2="DELETE FROM DropsArm WHERE HASH='$HASH'";
mysqli_query($db,$sql2);
}

if($rewType == "TAL"){
$sql2="DELETE FROM DropsAcs WHERE HASH='$HASH'";
mysqli_query($db,$sql2);
}



$_SESSION["Money"] = "";
header("location:sync.php");

?>