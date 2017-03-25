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

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$WEP = mysqli_query($db,"SELECT * FROM weapondrops where HASH = '$ACC[1]' ");
$WEP = mysqli_fetch_row($WEP);

$wenc = $WEP[15];
$ilvl = $WEP[4];

if (!$WEP[2] == ""){
	$Current = "<b style='color:#$WEP[5]'>$WEP[1] ($WEP[2])</b>";}
	else{
	$Current = "$WEP[1]";}

$ENC = mysqli_query($db,"SELECT * FROM enchantdrop where Enchant = '$wenc' ");
$ENC = mysqli_fetch_row($ENC);

$wenc2 = $ENC[0] +1;

$IDM = mysqli_query($db,"SELECT EXISTS(SELECT * FROM enchantdrop WHERE Enchant = '$wenc2')");
$IDM = mysqli_fetch_row($IDM);
if ($IDM[0] ==1){
}
else{
	echo" <section class='container3'>
    <div class='Enhcant'>
	      <form method='post' action='sync.php'> 
        <p class='submit'><input type='submit' name='commit' value='Max Upgrade (Back)'></p>
      </form>
    </div>
  </section>";
	exit;
}


$ENC2 = mysqli_query($db,"SELECT * FROM enchantdrop where Enchant = '$wenc2' ");
$ENC2 = mysqli_fetch_row($ENC2);

$bonuss = $WEP[4] * $ENC2[1];
$bonuss = round($bonuss,0);

echo "Current Weapon: $Current<br>";
echo "Current plus - <b style='color:red'>$WEP[15]</b><br>";
echo "Chanse: $ENC2[1] %";

$price = $WEP[4] * $ENC2[2];
 $_SESSION["Price"]= $price;
 $_SESSION["Name"]= $ENC2[0];
 $_SESSION["Bonus"]= $ENC2[2];
 $_SESSION["Chanse"]= $ENC2[1];	
 

 echo" <section class='container3'>
    <div class='Enhcant'>
	      <form method='post' action='Bypass2.php'> 
        <p class='submit'><input type='submit' name='commit' value='Upgrade for $price g.'></p>
      </form>
    </div>
  </section>";
  mysqli_close($db);
    ?>
	  <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>