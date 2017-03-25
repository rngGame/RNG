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

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$Money = $ACC[4];
$price = $_SESSION["Price"];

if ($Money > $price and $ACC[1] != '0001'){
	$cash = $Money - $price;
	   
$order3 = "UPDATE characters
SET Cash = '$cash'
WHERE `User` = '$User'";


$result = mysqli_query($db, $order3);
mysqli_close($db);
header("location:Enchant2.php")
;}
else{
	session_destroy();
	session_start();
	$_SESSION["User"] = $User;
	echo "<b>Not Enought Money or you can't enchant this weapon</b>";
	echo"<section class='container3'>
    <div class='31-50'>
	      <form method='post' action='sync.php'>
        <p class='submit'><input type='submit' name='commit' value='Back'></p>
      </form>
    </div>
  </section>";}
?>