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

if ($rez == 1){
	echo "<b style='color:red'>! Upgrade Succses !</b>";
	
}
else{
	echo "<b>Upgrade Failed</b>";
	echo "<section class='container'>
    <div class='Back'>
	      <form method='post' action='Enchant.php'>
        <p class='submit'><input type='submit' name='commit' value='Try Again'></p>
      </form>
    </div>
  </section>";
}

echo "<section class='container'>
    <div class='Back'>
	      <form method='post' action='sync.php'>
        <p class='submit'><input type='submit' name='commit' value='Back'></p>
      </form>
    </div>
  </section>";
  
?>