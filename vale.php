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

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);


$MOD = mysqli_query($db,"SELECT * FROM modlist where User = '$User' ");
$MOD = mysqli_fetch_row($MOD);

if ($MOD[0] == ""){
	echo "";
	}
else {
	$MODN = array();
	$MODE = array();
	$MODT = array();
	$modc = 1;
	$mc = 1;
	while ($modc <= 4){
		$MDC = mysqli_query($db,"SELECT * FROM mods where ID = '$MOD[$mc]' ");
		$MDC = mysqli_fetch_row($MDC);	
		if ($MDC[1] != ""){
			$MODN[$mc] = $MDC[1];
			$MODT[$mc] = $MDC[2];
			$MODE[$mc] = $MOD[$mc+1];	
			$mc = $mc + 2;
			$modc = $modc + 1;		
		}
		else{
			$modc = 5;
		}	
}
}

echo "<div id='wrapperv'>";
if(isset($mc)){
$img = $mc - 2;}
else{
	$img = 1;}
if ($img < 1){
	$img = 1;}


echo "<div id='miniv'><img src='IMG/$img.png'></div>";

echo "<div id='veilvl2'>$MOD[9]</div>";

echo "<div id='veil2'>";
if(isset($MODN[1])){

if(isset($MODN[1])){
	$n1 = $MODN[1];
	$e1 = $MODE[1];
	echo "$e1% $n1<br>";
}
if(isset($MODN[3])){
	$n2 = $MODN[3];
	$e2 = $MODE[3];
	echo "$e2% $n2<br>";
}
if(isset($MODN[5])){
	$n3 = $MODN[5];
	$e3 = $MODE[5];
	echo "$e3% $n3<br>";
}
if(isset($MODN[7])){
	$n4 = $MODN[7];
	$e4 = $MODE[7];
	echo "$e4% $n4<br>";
}
echo "</div>";
}
else {
	echo "No mod equiped</div>";
}

$r = 1;
if(isset($mc)){
	while ($mc >= 1){
		$r = ($r + 1) * $mc;
		$mc = $mc - 2;
	}
}

$MODK = $MOD[9] * $r ;


echo"<div id='textv'>";
echo "You have: <b>$ACC[4]</b><br>";
echo "Cost to reroll: <b>$MODK</b></div>";

$_SESSION["MODP"] = $MODK;






  mysqli_close($db);
    ?>
<div id="buttonv">
<section class="container3">
    <div class="31-50">
	      <form method="post" action="reroll.php">
        <p class="submit"><input type="submit" name="commit" value="Reroll"></p>
      </form>
    </div>
  </section>
  <br>
	  <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
  </div>
    </div>