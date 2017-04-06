<?php
session_start();
ob_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);


if (isset($_POST['Eqip'])) {
	
	$new = $_POST['Eqip'];
	$Type = $_POST['TYPE'];
	
if ($Type == "WEP"){
	$EQP = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$new'"); //select new wep item
	$EQP = mysqli_fetch_row($EQP);
}
if ($Type == "ARM"){
	$EQP = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$new'"); //select new armor item
	$EQP = mysqli_fetch_row($EQP);
}
if ($Type == "ACS"){
	$EQP = mysqli_query($db,"SELECT * FROM DropsAcs where HASH = '$new'"); //select new Accsesories item
	$EQP = mysqli_fetch_row($EQP);
}
	
	
	
	$EQP2 = mysqli_query($db,"SELECT * FROM Equiped where User = '$User' AND Part = '$Type' AND Equiped = '1'"); //select current item
	while ($EQPs = mysqli_fetch_array($EQP2)){	
	
	echo $EQPs[2];
	
	if ($Type == "WEP" and !isset($CURR)){
	$CURR = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$EQPs[2]'");
	$CURR = mysqli_fetch_row($CURR);
	}
	
	if ($Type == "ARM" and !isset($CURR)){
	$CURR = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$EQPs[2]' AND Part = '$EQP[1]' ");
	$CURR = mysqli_fetch_row($CURR);
	}
	
	if ($Type == "ACS" and !isset($CURR)){
	$CURR = mysqli_query($db,"SELECT * FROM DropsAcs where HASH = '$EQPs[2]' AND Part = '$EQP[1]' ");
	$CURR = mysqli_fetch_row($CURR);
	}
	
	}
	

    
	
	echo  $order = "UPDATE Equiped
	SET Equiped = '0'
	WHERE `HASH` = '$CURR[0]'";
	$result = mysqli_query($db, $order);	
	
   $order2 = "UPDATE Equiped
	SET Equiped = '1'
	WHERE `HASH` = '$new'";
	$result = mysqli_query($db, $order2);	
	
} else if (isset($_POST['Sell'])) {
	$new = $_POST['Sell'];
	$Type = $_POST['TYPE'];
	
	$WEP = mysqli_query($db,"SELECT * FROM weapondrops where HASH = '$new' ");
	$WEP = mysqli_fetch_row($WEP);
	
	if ($WEP[3] == "ff6633"){
		$shards = 30;
		$shards = $ACC[15] + $shards;
	$order0 = "UPDATE characters
	SET Shards = '$shards'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order0);}
	
	$sell = ($WEP[4] + $ACC[3]) *10;
	$sell = round($ACC[4] + $sell);
	
	$order = "UPDATE characters
	SET Cash = '$sell'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order);
	
$sql="DELETE FROM Equiped WHERE hash='$new'";
mysqli_query($db,$sql);

if ($Type == "WEP"){
$sql2="DELETE FROM DropsWep WHERE HASH='$new'";
mysqli_query($db,$sql2);}

if ($Type == "ARM"){
$sql2="DELETE FROM DropsArr WHERE HASH='$new'";
mysqli_query($db,$sql2);}

if ($Type == "ACS"){
$sql2="DELETE FROM DropsAcs WHERE HASH='$new'";
mysqli_query($db,$sql2);}

} else {
    //no button pressed
}

header("location:sync.php");
?>