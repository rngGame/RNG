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

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$GOLD = $ACC[4];

if (isset($_SESSION["MODLVL"])){
	$GOLD = 100000000000000;}

if ($GOLD > $MODP){
	



$rel = 0;
while ($rel == 0){


$MOD1 = mysqli_query($db,"SELECT * FROM mods Order by RAND() Limit 	1");
$MOD1 = mysqli_fetch_row($MOD1);
$MOD2 = mysqli_query($db,"SELECT * FROM mods WHERE NOT Type = '$MOD1[2]' ORDER BY RAND() Limit 	1");
$MOD2 = mysqli_fetch_row($MOD2);
$MOD3 = mysqli_query($db,"SELECT * FROM mods WHERE NOT Type = '$MOD1[2]' AND NOT Type = '$MOD2[2]' ORDER BY RAND() Limit 	1");
$MOD3 = mysqli_fetch_row($MOD3);
$MOD4 = mysqli_query($db,"SELECT * FROM mods WHERE NOT Type = '$MOD1[2]' AND NOT Type = '$MOD2[2]' AND NOT Type = '$MOD3[2]' ORDER BY RAND() Limit 	1");
$MOD4 = mysqli_fetch_row($MOD4);

$LVL = 0;

$M1 = rand(0,100);
$M2 = rand(0,100);
$M3 = rand(0,100);
$M4 = rand(0,100);

$E1r = rand($MOD1[3],$MOD1[4]);
$E2r = rand($MOD2[3],$MOD2[4]);
$E3r = rand($MOD3[3],$MOD3[4]);
$E4r = rand($MOD4[3],$MOD4[4]);

$E2 = "";
$S2 = "";
$E3 = "";
$S3 = "";
$E4 = "";
$S4 = "";

$c = 0;

$E1 = $MOD1[0];
$S1 = $E1r;
$LVL = $LVL + ($E1r / $MOD1[5]);

if ($M2 >= 50){
$E2 = $MOD2[0];
$S2 = $E2r;
$LVL = $LVL + ($E2r / $MOD2[5]);
$c = 1;
}
if ($M3 >= 80 and $c == 1){
$E3 = $MOD3[0];
$S3 = $E3r;
$LVL = $LVL + ($E3r / $MOD3[5]);
$c = 2;
}
if ($M4 >= 90 and $c == 2){
$E4 = $MOD4[0];
$S4 = $E4r;
$LVL = $LVL + ($E4r / $MOD4[5]);
}

$LVL = round($LVL,0);

$minLVL = 1;

if(isset($_SESSION["MODLVL"])){
	$minLVL = $_SESSION["MODLVL"];
}

if ($LVL >= $minLVL ){
	$rel = 1;}
}

$MDL = mysqli_query($db,"SELECT * FROM modlist where User = '$User' ");
$MDL = mysqli_fetch_row($MDL);

if(isset($MDL[0])){
	
	
$order = "UPDATE modlist
	  SET E1 = '$E1',
	   S1 = '$S1',
	   E2 = '$E2',
	   S2 = '$S2',
	   E3 = '$E3',
	   S3 = '$S3',
	   E4 = '$E4',
	   S4 = '$S4',
	   LVL = '$LVL'
	  WHERE `User` = '$User'";
$result = mysqli_query($db, $order);}

else{

$order = "INSERT INTO modlist
	  (USER, E1, S1, E2, S2, E3, S3, E4, S4, LVL)
	  		VALUES
	   ('$User','$E1','$S1','$E2','$S2','$E3','$S3','$E4','$S4','$LVL')";
$result = mysqli_query($db, $order);
}


echo " $MOD1[2] , $MOD2[2] , $MOD3[2] , $MOD4[2]";

if (isset($_SESSION["MODLVL"])){
}
else{
$cash = $ACC[4] - $MODP;

$order1 = "UPDATE characters
SET Cash = '$cash'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order1);
}

header("location:vale.php");

}
else{
?>
<b>Not Enought Money</b><br>
	  <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
<?php
}
?>