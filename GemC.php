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
session_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"];
$MODP = $_SESSION["MODP"];
$ShardsP = $_SESSION["ShardsP"];

if ($ShardsP >= 100){
	
	if (rand(0,100) > 70){
		$_SESSION["UNQ"] = 1;
		$_SESSION["SHARDREW"] = 1;
		header("location:uniqR.php");
		die();}
		
$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

if ($ACC[4] > $MODP){
	



$rel = 0;
while ($rel == 0){


$MOD1 = mysqli_query($db,"SELECT * FROM GemT Order by RAND() Limit 	1");
$MOD1 = mysqli_fetch_row($MOD1);
$MOD2 = mysqli_query($db,"SELECT * FROM GemB Order by RAND() Limit 	1");
$MOD2 = mysqli_fetch_row($MOD2);
$MOD3 = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit 	1");
$MOD3 = mysqli_fetch_row($MOD3);
$MOD4 = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit 	1");
$MOD4 = mysqli_fetch_row($MOD4);


$LVL = 0;

$M1 = rand(1,99);
$M2 = rand(0,100);
$M3 = rand(0,100);
$M4 = rand(0,100);


$E2 = "";
$S2 = "";
$E3 = "";
$S3 = "";
$E4 = "";
$S4 = "";

$c = 0;

$Type = "$MOD1[0]";
$Color = "$MOD1[1]";


while ($c == 0){
	if ($MOD2[3] > $M1){
		$Name = "$MOD2[0]";
		$Value = rand($MOD2[1],$MOD2[2]);
		$LVL = $Value;
		$c = 1;}
	else {
			echo "$MOD2[0]";
	$M1 = rand(1,99);
	$MOD2 = mysqli_query($db,"SELECT * FROM GemB Order by RAND() Limit 	1");
	$MOD2 = mysqli_fetch_row($MOD2);}

}

$sub=0;
if ($M3 >= 50){
	$sub=1;
$Name = "$Name of $MOD3[1]";
$Value = $Value + ($MOD3[3]/3);
$LVL = $LVL + $MOD3[2];

}
if ($M4 >= 75 and $sub==1){
$Name = "$Name and $MOD4[1]";
$Value = $Value + ($MOD4[3]/3);
$LVL = $LVL + $MOD4[2];
}

$LVL = round($LVL,0);
$Value = round($Value,0);

if ($LVL >= 1 ){
	$rel = 1;}
}

$hash1 = rand(1,999999999999999);
$hash2 = rand(-999,9999);
$hash= $hash1 * $hash2 *-1;
$_SESSION["HASH"] = $hash;

	
$order = "INSERT INTO Gems
	   (Name, HASH, Type, Color, lvl, Stat1)
	  VALUES
	   ('$Name','$hash','$Type','$Color', '$LVL', '$Value')";
$result = mysqli_query($db, $order);

$Shard = $ACC[15] - 100;
	$order2 = "UPDATE characters
	SET Shards = '$Shard'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order2);	


header("location:RewardG.php");

}
}
?>
<b>Not Enought Shards</b><br>
	  <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
<?php

?>