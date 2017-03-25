<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>World of RNG</title>
<link rel="stylesheet" type="text/css" href="CSS/meniu.css">
</head>
<body>
<header>
World Of RNG
</header>
<?php
session_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"];
$sell = $_SESSION["Sell"];
$Name = $_SESSION["MonsName"];
$HP = $_SESSION["MonsHP"];
$DMG = $_SESSION["MonsDMG"];
$Drop = $_SESSION["MonsDrop"];
$LVL = $_SESSION["MonsLVL"];
$Money = $_SESSION["Money"];

$ACC = mysqli_query($db,"SELECT * FROM Characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$WEP = mysqli_query($db,"SELECT * FROM Drops where HASH = '$ACC[1]' ");
$WEP = mysqli_fetch_row($WEP);


if ($ACC[2] >= $DMG){
	if ($HP <= $WEP[4]){
		
$xp = $ACC[5] + $Drop;
	   
$order2 = "UPDATE characters
SET XP = '$xp'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order2);	

$kills = $ACC[6] +1;

$cash = $ACC[4] - $Money;
	   
$order3 = "UPDATE characters
SET Kills = '$kills'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order3);	

$order4 = "UPDATE characters
SET Cash = '$cash'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order4);	

		
		
		header("location:rewcalc.php");
	}
	
}
else {
	

$cash = $ACC[4] - $Money;
	   
$order3 = "UPDATE characters
SET Cash = '$cash'
WHERE `User` = '$User'";


$result = mysqli_query($db, $order3);	
	
echo 'Lose
<section class="container">
    <div class="Back">
	      <form method="post" action="Sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
';}

?>
