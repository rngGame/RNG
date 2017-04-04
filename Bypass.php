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

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$Money = $ACC[4];
$BLVL = $_POST["lvl"];
$_SESSION["BOSS"] = 1;

if ($BLVL == 10){
	$gold = "10 g";
	$gl = 1;
	$glf = 10;
	$glm = 5;
	$FGT=10;}
	
if ($BLVL == 30){
	$gold = "100 g";
	$gl = 10;
	$glf = 100;
	$glm = 20;
	$FGT=30;
	$bs = 1.5;
	$_SESSION["BOSS"] = $bs;}
	
if ($BLVL == 50){
	$gold = "1000 g";
	$gl = 50;
	$glf = 500;
	$glm = 250;
	$FGT=50;
	$bs = 2;
	$_SESSION["BOSS"] = $bs;}
	
if ($BLVL == 100){
	$gold = "1000 g";
	$gl = 200;
	$glf = 1000;
	$glm = 1000;
	$FGT=100;
	$bs = 10;
	$_SESSION["BOSS"] = $bs;}

$_SESSION["Money"] = $glf;
$_SESSION["Sell"] = $glm;
$_SESSION["fLVL"] = $FGT;
$_SESSION["Gold1"] = $gold;
$_SESSION["Gold2"] = $gl;

if ($Money > $glf){
	mysqli_close($db);
	
	header("location:fight.php");
}
else{
	session_destroy();
	session_start();
	$_SESSION["User"] = $User;
	echo "<b>Not Enought Money</b>";
	echo"<section class='container3'>
    <div class='31-50'>
	      <form method='post' action='sync.php'>
        <p class='submit'><input type='submit' name='commit' value='Back'></p>
      </form>
    </div>
  </section>";}
?>