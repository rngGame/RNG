<?php
session_start();
ob_start();
$User = $_SESSION["User"];
include_once 'PHP/db.php';
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


$XPS = $_SESSION["XPS"];
$XPP = $_SESSION["XPPA"];
$User = $_SESSION["User"];  
$Reward = $_SESSION["Reward"];
$sell = $_SESSION["Sell"];
$Gold = $_SESSION["GoldRew"];

$rewType = $_SESSION["REWARDTYPE"];

$_SESSION["CURRENTWHASH"];

if (isset($_SESSION["SHD"])){
$Shards = $_SESSION["SHD"];
$Shards = ", also gained <b style='color:#00cc99'>$Shards</b> shards.";}


//item reward
if (rand(1,1000) > 700){
	if (isset($_SESSION["ITEM"])){
	unset($_SESSION["ITEM"]);
	include 'PHP/items.php';
	
	$order = "INSERT INTO DropsItm
	(HASH, Name, EFT, Value, Icon )
	VALUES
	('$HASHIT', '$Name', '$EFT', '$value', '$icon')";
	   
	$order2 = "INSERT INTO Equiped
	(User, Part, HASH, Equiped)
	VALUES
	('$User', 'ITM', '$HASHIT', '0')";	   

	$result = mysqli_query($db, $order);
	$result = mysqli_query($db, $order2);	
	
	$text ="<b>You recived extra: $Name !!!</b><br>";
}
else{
	unset($_SESSION["ITEM"]);
}
}

$XPS = round($XPS,0);
$XPP = round($XPP,0);

echo $text;
if($rewType == "WEP"){
echo "You gained $XPS xp. and $Gold Gold<br>You gained $XPP xp for cryt. chanse pasive $Shards<br><br>";
}
if($rewType == "ARM"){
echo "You gained $XPS xp. and $Gold Gold<br>You gained $XPP xp for apsorb pasive $Shards<br><br>";
}
if($rewType == "TAL"){
echo "You gained $XPS xp. and $Gold Gold<br>You gained $XPP xp for energie pasive $Shards<br><br>";
}



echo ' <div class="right-panel">';
echo $_SESSION["LOG"];
echo '</div>';

echo "$Reward";



echo '<section class="container">
    <div class="Keep">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>';

echo '<section class="container2">
    <div class="Sell">
	      <form method="post" action="Sell.php">
        <p class="submit"><input type="submit" name="commit" value="Sell"></p>
      </form>
    </div>
  </section>';

?>
</div>
</body>
</html>