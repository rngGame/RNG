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

$HASH = $_SESSION["HASH"];
$TYPE = $_SESSION["TYPE"];

$c1 = rand(1,100);

//stuff for enchant dust
if (isset($_SESSION["ENCt"])){
	$c1 = 1;
}

//stuff for coruption stone

if (isset($_POST[COR])){
	$new = $_POST[ITM];
		
	include 'PHP/coruption.php';
	
	$_SESSION["rezult2"] = "<br>$effect2</br>";
	
	$sql="DELETE FROM Equiped WHERE hash='$new' and User='$User'";
	mysqli_query($db,$sql);
	$sql2="DELETE FROM DropsItm WHERE HASH='$new'";
	mysqli_query($db,$sql2);
	
	mysqli_close($db);
	header("location:rez.php");	

}
	

if ($TYPE == "WEP"){
$WEP = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$HASH' ");
$ITM = mysqli_fetch_assoc($WEP);
}
if ($TYPE == "ARM"){
$WEP = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$HASH' ");
$ITM = mysqli_fetch_assoc($WEP);
}
if ($TYPE == "ACS"){
$WEP = mysqli_query($db,"SELECT * FROM DropsAcs where HASH = '$HASH' ");
$ITM = mysqli_fetch_assoc($WEP);
}
if ($TYPE == "SKL"){
$WEP = mysqli_query($db,"SELECT * FROM DropsSkl where HASH = '$HASH' ");
$ITM = mysqli_fetch_assoc($WEP);
}

if (isset($_SESSION["ENCt"])){
$_SESSION["ENname"] = $ITM["Name"];
unset($_SESSION["ENCt"]);
}
 
if ( $c1 <= $Chanse){
	
$enc = $ITM["plus"] + 1;
	
if ($TYPE == "WEP"){
$order2 = "UPDATE DropsWep
SET plus = '$enc'
WHERE `HASH` = '$HASH'";
}
if ($TYPE == "ARM"){
$order2 = "UPDATE DropsArm
SET plus = '$enc'
WHERE `HASH` = '$HASH'";
}
if ($TYPE == "ACS"){
$order2 = "UPDATE DropsAcs
SET plus = '$enc'
WHERE `HASH` = '$HASH'";
}
if ($TYPE == "SKL"){
$order2 = "UPDATE DropsSkl
SET plus = '$enc'
WHERE `HASH` = '$HASH'";
}



$result = mysqli_query($db, $order2);	


mysqli_close($db);
$_SESSION["rezult"] = 1;
header("location:rez.php");	
}

else{
	$_SESSION["rezult"] = 0;
	header("location:rez.php");

}
?>