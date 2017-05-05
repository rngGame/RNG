<?php
session_start();
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>World of RNG</title>
<?php
echo "<link rel='stylesheet' type='text/css' href='css/$_COOKIE[Theme].css'>";
?>
<link rel="icon" href="favicon.png">
</head>
<body>
<header>
World Of RNG
</header>
<?php
include_once 'PHP/db.php';

$User = $_SESSION["User"];
$sell = $_SESSION["Sell"];
$Money = $_SESSION["Money"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);


$result = mysqli_query($db, $order3);	

	$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$User' and Name = 'LOS'");
	$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$User', 'LOS', '1')";
	$result = mysqli_query($db, $order);}
		else{
			$CCount = $ACH[2] + 1;
			$order = "UPDATE aStatus
			SET Status = '$CCount'
			WHERE `User` = '$User' and `Name` = 'LOS'";
			$result = mysqli_query($db, $order);
		}
	
$panel = "right-panel"; //set panel for log
	
	echo " <br><br><br><div class='$panel'>";
echo $_SESSION["LOG"];
echo '</div>';
	
echo 'Lose
<section class="container">
    <div class="Back">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
';

?>
