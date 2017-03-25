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

echo "Shards has small chanse be droped by killed monster<br><br>";
echo "You have - <font color='#00cc99'>$ACC[15]</font> shards.<br>";


$_SESSION["ShardsP"] = $ACC[15];




  mysqli_close($db);
    ?>
<div id="buttonv2">
<section class="container3">
    <div class="31-50">
	      <form method="post" action="GemC.php">
        <p class="submit"><input type="submit" name="commit" value="Change 100 shards for loot"></p>
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