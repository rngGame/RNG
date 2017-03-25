<?php
session_start();
ob_start();
include_once 'PHP/db.php';
$User = $_SESSION["User"];
$text = $_GET["chat"];
$datetime = date_create()->format('Y-m-d H:i:s');

$order = "INSERT INTO Chat
	   (User, Date, Text)
	  VALUES
	   ('$User','$datetime','$text')";

$result = mysqli_query($db, $order);	
mysqli_close($db);
/*    echo "<!DOCTYPE html>";
    echo "<head>";
    echo "<title>Form submitted</title>";
    echo "<script type='text/javascript'>window.parent.location.reload()</script>";
    echo "</head>";
    echo "<body></body></html>";
	*/
header("location:message.php");

?>