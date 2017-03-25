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
<?php
include_once 'PHP/db.php';

$User = $_SESSION["User"];

$HPin = $_SESSION["HP"];
$DMGin = $_SESSION["DMGPL"];
$Armor = $_SESSION["ARM"];
$eng = $_SESSION["ENG"];
$ILVL = $_SESSION["ILVL"];

echo "World Of RNG";
echo "</header>";
echo "<p align='left'>HP: <font size='3' color='Green'>$HPin  </font>";
echo "DMG: <font size='3' color='red'>$DMGin  </font>";
echo "ARMOR: <font size='3' color='gold'>$Armor  </font></p>";

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$SKL = ($ACC[3]*3)+$eng;
$_SESSION["ENERGY"] = $SKL;
$_SESSION["ENERGYM"] = $SKL;

$ILVLmin = $ILVL - 100;
if ($ILVLmin <= 0){
	$ILVLmin = 1;}

$ILVLmax = $ILVL + 100;

$Rmin = $ACC[11] - 500;
if ($Rmin <= 0){
	$Rmin = 1;}
$Rmax = $ACC[11] + 1000;


$i = 0;

 $List = mysqli_query($db,"SELECT * FROM characters order by Rank desc ");
while ($CHR = mysqli_fetch_array($List) and $i != 10){
	
	if ($CHR[11] > $Rmin and $CHR[11] < $Rmax){
	if ($CHR[9] > $ILVLmin and $CHR[9] < $ILVLmax){
		if ($CHR[0] == $ACC[0]){
		}
		else{
		
		 echo
  		"<section class='container2'>
	      <form method='post' action='CheckP.php'>
          <input hidden='' type='text' name='chr' value='$CHR[0]' placeholder='lvl'>
		  
        <p class='submit'><b>$CHR[0]</b> - Rank - $CHR[11] &nbsp;<input type='submit' name='commit' value='Fight'></p> 
      </form>
    ";
		
		

	$i = $i + 1;
	
		}
	}
  }
}




  ?>
  <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>