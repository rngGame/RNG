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

$rez = $_SESSION["rezult"];


if(isset($_SESSION["ENname"])){
	$Name = $_SESSION["ENname"];
	$Name = "$Name <br>";
	
}


//coruption
if (isset($_SESSION["rezult2"])){
	
	$rez2 = $_SESSION["rezult2"];
	
	
	echo "<b style='color:red'><h2>$rez2</h2></b>";
	echo "<br><b>$_SESSION[info]</b><br>";
	
	echo "<section class='actionButtons2'>
	      <form method='post' action='sync.php'>
        <p class='submit'><input type='submit' name='commit' value='Back'></p>
      </form>
  </section>
  </div>";
  die();
	
}


if ($rez == 1){
	echo $Name;
	echo "<b style='color:red'>! Upgrade Succses !</b>";
	
}
else{
	echo $Name;
	echo "<b>Upgrade Failed</b>";
	
}
if(isset($_SESSION["ENname"])){
	unset($_SESSION["ENname"]);
	echo "<div id='fightNewBut'>";
}
else{
	echo " <div id='fightNewBut'>
		<section class='actionButtons2'>
	      <form method='post' action='Enchant.php'>
        <p class='submit'><input type='submit' name='commit' value='Enchant Again'></p>
      </form>
  </section>";
}
  
echo "<section class='actionButtons2'>
	      <form method='post' action='sync.php'>
        <p class='submit'><input type='submit' name='commit' value='Back'></p>
      </form>
  </section>
  </div>";
  
?>