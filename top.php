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
World of RNG
</header>
<?php
session_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"]; //user

$NR1 = 0;
$NR2 = 0;

//hardcore
echo "<div class='HARD'><b>Hardcore:</b><br>";

$hardcoreCHAR = mysqli_query($db,"SELECT * FROM characters WHERE Hardcore = '1' ORDER BY ILVL DESC");
while ($hardcoreCHARlist = mysqli_fetch_array($hardcoreCHAR) and $NR1 <> 10){	

$NR1 += 1;

if ($hardcoreCHARlist[7] >= 1){
	$deadalive = "<font color='red'>(Dead)</font>";
}
else{
	$deadalive = "<font color='green'>(Alive)</font>";
}

echo "TOP $NR1 - <font color='$hardcoreCHARlist[12]'>$hardcoreCHARlist[0]</font>, ILVL: $hardcoreCHARlist[9]$deadalive <br>";
}
echo "</div>";

//softcore
echo "<div class='SOFT'><b>Softcore:</b><br>";

$hardcoreCHAR = mysqli_query($db,"SELECT * FROM characters WHERE Hardcore = '0' ORDER BY ILVL DESC");
while ($hardcoreCHARlist = mysqli_fetch_array($hardcoreCHAR) and $NR2 <> 10){	

$NR2 += 1;


echo "TOP $NR2 - <font color='$hardcoreCHARlist[12]'>$hardcoreCHARlist[0]</font>, ILVL: $hardcoreCHARlist[9] <br>";
}
echo "</div>";

?>
<div class="floating">
  <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
  </div>

