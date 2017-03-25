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
$TOP1 = $_SESSION["TOP"];

$WepName = $_SESSION["WepName"];
$Type = $_SESSION["Type"];
$ilvl = $_SESSION["ilvl"];
$DMG = $_SESSION["DMG"];
$Color = $_SESSION["Color"];
$Name = $_SESSION["NewN"];


$BOS = mysqli_query($db,"SELECT * FROM wboss ORDER BY ID DESC LIMIT 1 ");
$BOS = mysqli_fetch_row($BOS);

echo "$BOS[1] were killed by $User<br><br>";
echo "Most damage delt by - $TOP1<br><br>";
echo "Gold recived:<br>";
$List = mysqli_query($db,"SELECT * FROM dboss where MonsID = '$BOS[0]' order by DMG desc ");
while ($List1 = mysqli_fetch_array($List)){
	$XP = $List1[2]*1.2;
	$XP = round($XP);
echo "<b>$List1[1]</b> - $List1[2] Gold. and $XP XP<br>";}

echo "<br>$TOP1 recived - $WepName";



?>
  <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
