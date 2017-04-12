<?php
session_start();
ob_start();

include_once 'PHP/db.php';
$User = $_SESSION["User"];
$IDP = $_SESSION["PartyID"];
$PTS = $_SESSION["PartySpot"];

//leave party
if(isset($_POST["LP"])){
	
$PT = "PL$PTS";

$orderChar = "UPDATE Party
SET $PT= null
WHERE `ID` = '$IDP'";
$result = mysqli_query($db, $orderChar);
	
}


//disamble party
if(isset($_POST["PD"])){

	$sql2="DELETE FROM Party WHERE ID='$IDP'";
mysqli_query($db,$sql2);
	
	
header("location:sync.php");
die();
	
}


$Slot = $_POST["Slot"] + 1;
$Party = $_POST["Party"];
echo $PT = "PL$Slot";

$PLS= mysqli_query($db,"SELECT * FROM Party where PL1 = '$Party'");
$PL = mysqli_fetch_assoc($PLS);

$orderChar = "UPDATE Party
SET $PT= '$User'
WHERE `ID` = '$PL[ID]'";
$result = mysqli_query($db, $orderChar);


header("location:sync.php");
die();


?>