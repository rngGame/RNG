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
$hash = $_SESSION["HASH"];


$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$GEM = mysqli_query($db,"SELECT * FROM Gems where HASH = '$ACC[14]' ");
$GEM = mysqli_fetch_row($GEM);

$LOOT = mysqli_query($db,"SELECT * FROM Gems where HASH = '$hash' ");
$LOOT = mysqli_fetch_row($LOOT);

echo "You recived gem - ";

if (!$LOOT[3] == ""){
	echo "<b style='color:#$LOOT[3]'>$LOOT[0]</b>";}
	else{
		echo "$LOOT[0]";}
echo "<br><a style='color:#$LOOT[3]'><b>$LOOT[2]</b> Type. <br></a><b>Power $LOOT[5] %</b><br><b>$LOOT[4] lvl.</b>";


echo "<br><hr><br>";
echo "You have gem - ";
if (!$GEM[3] == ""){
	echo "<div class='tooltip'><b style='color:#$GEM[3]'>$GEM[0]</b>";}
	else{
		echo "<div class='tooltip'>$GEM[0]";}
echo "<br><span class='tooltiptext'><a style='color:#$GEM[3]'><b>$GEM[2]</b> Type. <br></a><b>Power $GEM[5] %</b><br><b>$GEM[4] lvl.</b></span></div>";

echo '<section class="container">
    <div class="Keep">
	      <form method="post" action="KeepG.php">
        <p class="submit"><input type="submit" name="commit" value="Keep"></p>
      </form>
    </div>
  </section>';

echo '<section class="container2">
    <div class="Sell">
	      <form method="post" action="discard.php">
        <p class="submit"><input type="submit" name="commit" value="Sell for shards"></p>
      </form>
    </div>
  </section>';

?>
</div>
</body>
</html>