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
$MHP = $_SESSION["MonsHP"];
$ID = $_SESSION["IDB"];
$MHP2 = $_SESSION["MonsHP2"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$BOS = mysqli_query($db,"SELECT * FROM wboss where ID = '$ID' ");
$BOS = mysqli_fetch_row($BOS);

$cash = $ACC[4] - 0;
	   
$order3 = "UPDATE characters
SET Cash = '$cash'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order3);	

$dmg = $MHP2 - $MHP;
$HPL = $MHP2 - $dmg;
	
//death count
if(isset($_POST["FLEE"])){
}
else{
$dedNr = $ACC[7] + 1;
	
$order2 = "UPDATE characters
		SET Deaths = '$dedNr'
		WHERE `User` = '$User'";
$result = mysqli_query($db, $order2);
}
	
echo "You did <font color='#ff0000'>$dmg dmg. </font><br>";
echo '
<section class="container">
    <div class="Back">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
';

echo ' <div class="right-panel">';
echo $_SESSION["LOG"];
echo '</div>';

$order4 = "UPDATE wboss
SET HP = '$HPL'
WHERE `ID` = '$ID'";

$result = mysqli_query($db, $order4);	

$DMTB = mysqli_query($db,"SELECT * FROM dboss where MonsID = '$ID' AND ACC = '$ACC[0]'");
$DMTB = mysqli_fetch_row($DMTB);
if($DMTB[1] != $ACC[0]) {
	$order2 = "INSERT INTO dboss
	   (MonsID, ACC, DMG)
	  VALUES	
	   ('$ID', '$ACC[0]', '$dmg')";
	   $result = mysqli_query($db, $order2);
	}
else{
	$dmg = $DMTB[2] + $dmg;
	$order5 = "UPDATE dboss
	SET DMG = '$dmg'
	WHERE `MonsID` = '$ID' AND `ACC` = '$ACC[0]'";
	$result = mysqli_query($db, $order5);
	}
?>
