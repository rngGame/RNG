<?php
session_start();
ob_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);


if (isset($_POST['Buy'])) {
	$hash = $_POST["Buy"];
	$ITEM = mysqli_query($db,"SELECT * FROM Trade where Hash = '$hash' ");
	$ITEM = mysqli_fetch_row($ITEM);
		$recived = $ITEM[2];
		$ITEM[2] = $ITEM[2] + ($ITEM[2] * 2 / 100);
	if ($ITEM[2] <= $ACC[4]){
		
		//give to new player
		$order = "INSERT INTO inventor 
		(User, Hash)
		VALUES
		('$User','$hash')";	 
		$result = mysqli_query($db, $order);
		
		$sell = $ACC[4] - $ITEM[2];
		
		//remove cash from buying player
		$order2 = "UPDATE characters
		SET Cash = '$sell'
		WHERE `User` = '$User'";
		$result = mysqli_query($db, $order2);
		
		//give cash to sellign player
		$ACC2 = mysqli_query($db,"SELECT * FROM characters where user = '$ITEM[1]' ");
		$ACC2 = mysqli_fetch_row($ACC2);
		
		$recived = $ACC2[4] + $recived;
		
		$order3 = "UPDATE characters
		SET Cash = '$recived'
		WHERE `User` = '$ITEM[1]'";
		$result = mysqli_query($db, $order3);
		
		
		$sql="DELETE FROM Trade WHERE Hash='$hash'";
		mysqli_query($db,$sql);	
		
		
		
		
	}
}

//remove listening
if (isset($_POST['Remove'])) {
		$hash = $_POST["Remove"];
	$order = "INSERT INTO inventor 
		(User, Hash)
		VALUES
		('$User','$hash')";	 
		$result = mysqli_query($db, $order);
		
		$sql="DELETE FROM Trade WHERE Hash='$hash'";
		mysqli_query($db,$sql);	}
	
header("location:sync.php");