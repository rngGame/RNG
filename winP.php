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
$User2 = $_SESSION["Name"];



$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$ACC2 = mysqli_query($db,"SELECT * FROM characters where user = '$User2' ");
$ACC2 = mysqli_fetch_row($ACC2);

$ELO = 0;

if ($ACC[11] >= $ACC2[11]){
	$elo = $ACC[11] - $ACC2[11];
	$ELO = (($elo + ($elo*$elo/100))/20)+10;
		$ELO = (2000 - $ELO)/100;
		$r = $ELO;
}
else if ($ACC[11] < $ACC2[11]){
	$elo = $ACC2[11] - $ACC[11];
	$ELO = (($elo*$elo/100)/20)+10;
		$ELO = (4000 - $ELO)/100;
		$r = $ELO;

}

$ELO = round($ELO,0);
$ELO2 = round($ELO2,0);
$r = round($r,0);

$ELO2 = $ELO / 2;

$ELO = ($ACC[11] + $ELO);
$ELO2 = ($ACC2[11] - $ELO2);
if ($ELO2 < 0){
	$ELO2 = 0;} 
	

   
$order = "UPDATE characters
SET Rank = '$ELO'
WHERE `User` = '$User'";
	

$order2 = "UPDATE characters
SET Rank = '$ELO2'
WHERE `User` = '$User2'";

$result = mysqli_query($db, $order);
$result = mysqli_query($db, $order2);	
	
echo "You Won ! Gained $r points.";
echo '<section class="container">
    <div class="Back">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
';

?>
