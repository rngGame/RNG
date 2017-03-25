<?php
session_start();
ob_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);


if (isset($_POST['Eqip'])) {
    
	
	$new = $_POST['Eqip'];
	$old = $ACC[1];
	
	$order = "UPDATE characters
	SET Wep_h = '$new'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order);	
	
	$order2 = "UPDATE inventor
	SET Hash = '$old'
	WHERE `Hash` = '$new'";
	$result = mysqli_query($db, $order2);	
	
} else if (isset($_POST['Sell'])) {
	$new = $_POST['Sell'];
	
	$WEP = mysqli_query($db,"SELECT * FROM weapondrops where HASH = '$new' ");
	$WEP = mysqli_fetch_row($WEP);
	
	$sell = ($WEP[4] + $ACC[3]) *10;
	$sell = round($ACC[4] + $sell);
	
	$order = "UPDATE characters
	SET Cash = '$sell'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order);
	
$sql="DELETE FROM inventor WHERE hash='$new'";
mysqli_query($db,$sql);
$sql2="DELETE FROM dropweapons WHERE HASH='$new'";
mysqli_query($db,$sql2);

} else {
    //no button pressed
}

header("location:sync.php");
?>