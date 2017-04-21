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

<?php
include_once 'PHP/db.php';

$User = $_SESSION["User"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$BOS = mysqli_query($db,"SELECT * FROM wboss ORDER BY ID DESC LIMIT 1 ");
$BOS = mysqli_fetch_row($BOS);

$HPin = $_SESSION["HP"];
$DMGp = $_SESSION["DMGPAVE"];
$DMGm = $_SESSION["DMGMAVE"];
$Armor = $_SESSION["ARM"];
$skl = $_SESSION["ENG"];


$eng = $_SESSION["ENG"];

echo "</header>";
echo "<p align='left'>HP: <font size='3' color='Green'>$HPin  </font>";
echo "DMG: <font size='3' color='red'>~$DMGp</font>/<font size='3' color='#0066ff'>~$DMGm  </font>";
echo "ARMOR: <font size='3' color='gold'>$Armor  </font></p>";


 echo ' <div class="right-panel">';
 $List = mysqli_query($db,"SELECT * FROM dboss where MonsID = '$BOS[0]' order by DMG desc ");
while ($List1 = mysqli_fetch_array($List)){
echo "<b>$List1[1]</b> - $List1[2] Dmg.<br>";	
}
	
		
  echo '</div>';
 
if (!$BOS[4] <= 0){
	echo "<font size='4' color='#ff0055'>WORLD BOSS</font><br>";
	echo "<img src='IMG/Mon/boss.jpg' width='80' height='80'><br>";
	echo "Monster Name: <b>$BOS[1]</b><br>";
	echo " HP: $BOS[4], DMG: $BOS[3], Lvl: $BOS[2]";
	$_SESSION["MonsName"] = $BOS[1];
	$_SESSION["MonsHP"] = $BOS[4];
	$_SESSION["MonsHP2"] = $BOS[4];
$_SESSION["MonsDMG"] = $BOS[3];
$_SESSION["MonsLVL"] = $BOS[2];
$_SESSION["IDB"] = $BOS[0];


echo
  "<section class='container2'>
    <div class='11-30'>
	      <form method='post' action='FightTB.php'>
          <input hidden='' type='text' name='lvl' value='30' placeholder='lvl'>
        <p class='submit'><input type='submit' name='commit' value='Fight'></p> 
      </form>
    </div>
  </section>";
  


	
	
  mysqli_close($db);
 

	
	
	
	
	
	
	
	
	
	
	
	
	
}
	else{
		header("location:cBoss.php");
		die();
	}
 ?>

  <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
    <section class="container3">
    <div class="31-50">
	      <form method="post" action="showold.php">
        <p class="submit"><input type="submit" name="commit" value="History"></p>
      </form>
    </div>
  </section>