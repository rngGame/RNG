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


$XPS = $_SESSION["XPS"];
$XPP = $_SESSION["XPPA"];
$User = $_SESSION["User"];  
$Reward = $_SESSION["Reward"];
$sell = $_SESSION["Sell"];
$Gold = $_SESSION["GoldRew"];

$Unq = $_SESSION["UNQ"]; //check if uniq still valid

if (isset($_SESSION["SHD"])){
$Shards = $_SESSION["SHD"];
$Shards = ", also gained <b style='color:#00cc99'>$Shards</b> shards.";}

$XPS = round($XPS,0);
$XPP = round($XPP,0);

if ($Unq == 1){
include 'PHP/uniq.php';

$result = mysqli_query($db, $order2);

$order3 = "INSERT INTO inventor
(User, Hash)
VALUES
('$User','$HASH')";	   

$result = mysqli_query($db, $order3);
$_SESSION["UNQ"] = 1515615565465;
}

echo "You gained $XPS xp. and $Gold Gold<br>You gained $XPP xp for cryt. chanse pasive $Shards<br><br>";

echo ' <div class="right-panel">';
echo $_SESSION["LOG"];
echo '</div>';

echo "<b><font color='gold'>You recived UNIQUE WEAPON !!!</font><b>";



echo '<section class="container">
    <div class="Keep">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>';

?>
</div>
</body>
</html>