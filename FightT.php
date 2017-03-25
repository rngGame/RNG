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
session_start();
include_once 'PHP/db.php';

$_SESSION["PAGE2"] = "location:FightT.php";
$_SESSION["LOSE"] = "location:lose.php";

//set what type reward to get
$type = rand(1,200);
if ($type > 140){
	$_SESSION["PAGE"] = "location:newi.php";}
else if ($type > 60){
	$_SESSION["PAGE"] = "location:rewarm.php";} 
	else if ($type > 1){
		$_SESSION["PAGE"] = "location:rewtali.php";} 
			else{
			$_SESSION["UNQ"] = 1;
			$_SESSION["PAGE"] = "location:uniqR.php";}

$HPin = $_SESSION["HP"];
$Armor = $_SESSION["ARM"];

$minPdmg = $_SESSION["DMGPmin"];
$maxPdmg = $_SESSION["DMGPmax"];
$minMdmg = $_SESSION["DMGMmin"];
$maxMdmg = $_SESSION["DMGMmax"];

$User = $_SESSION["User"];
$gold = $_SESSION["Gold1"];
$gl = $_SESSION["Gold2"];
$BLVL = $_SESSION["fLVL"];

$mName = $_SESSION["MonsName"];
$mHP = $_SESSION["MonsHP"];
$mDMG = $_SESSION["MonsDMG"];
$mDRP = $_SESSION["MonsDrop"];
$mLVL = $_SESSION["MonsLVL"];

$SKL = $_SESSION["ENERGY"];
$SKLm = $_SESSION["ENERGYM"];

$imgm = $_SESSION["MonsIMG"];

if (!isset($_SESSION["HPO"])){
	$_SESSION["HPO"]=$HPin;
}
if (!isset($_SESSION["LOG"])){
	$LOG = $_SESSION["LOG"];
}

//average dmg recalculate
$avgP = round(($minPdmg + $maxPdmg) / 2);
$avgM = round(($minMdmg + $maxMdmg) / 2);
$avgD = round(($avgP + $avgM) / 2);

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$ACC[10]' ");
$CLS = mysqli_fetch_row($CLS);






if ($CLS[6] == "PALA"){
	$t1 = "+50%";
	$c1 = "class='invert submitBtn'";
	}
else { $t1 = "+25%";
$c1 = "class='submitBtn'";}


if ($CLS[6] == "POIS"){
	$t2 = "(Bonus)";
		$c2 = "class='invert submitBtn'";}
else { $t2 = "";
$c2 = "class='submitBtn'";}


if ($CLS[6] == "HEAL"){
	$t3 = "15%";
		$c3 = "class='invert submitBtn'";}
else { $t3 = "10%";
$c3 = "class='submitBtn'";}


if ($CLS[6] == "TANK"){
	$t4 = "50 - 80%";
		$c4 = "class='invert submitBtn'";}
else { $t4 = "30 - 60%";
$c4 = "class='submitBtn'";}


if ($CLS[6] == "DMGB"){
	$t5 = "10 - 25%";
		$c5 = "class='invert submitBtn'";}
else { $t5 = "5 - 20%";
$c5 = "class='submitBtn'";}


if ($CLS[6] == "COMB"){
	$t6 = "(Bonus)";
		$c6 = "class='invert submitBtn'";}
else { $t6 = "";
$c6 = "class='submitBtn'";}


if ($CLS[6] == "ASSA"){
	$t7 = "120% and chanse 70%";
		$c7 = "class='invert submitBtn'";}
else { $t7 = "100% and chanse 50%";
$c7 = "class='submitBtn'";}

if ($CLS[6] == "FIRE"){
	$t8 = "LVL 2";
		$c8 = "class='invert submitBtn'";}
else { $t8 = "LVL 1";
$c8 = "class='submitBtn'";}

if ($CLS[6] == "x"){
	$t9 = "LVL 2";
		$c9 = "class='invert submitBtn'";}
else { $t9 = "LVL 1";
$c9 = "class='submitBtn'";}



echo "World Of RNG";
echo "</header>";
echo "<p align='left'>HP: <font size='3' color='Green'>$HPin  </font>";
echo "DMG: <font size='3' color='red'>~$avgP</font>/<font size='3' color='#0066ff'>~$avgM  </font>";
echo "ARMOR: <font size='3' color='gold'>$Armor  </font>";
echo "ENERGY: <font size='3' color='#0066ff'>$SKL / $SKLm  </font></p>";



  $cryt = $_SESSION["crytext"];
  $cryt2 = $_SESSION["crytext2"];
echo ' <div class="right-panel">';
echo $_SESSION["LOG"];
echo '</div>';

echo "<img src='IMG/Mon/$imgm.jpg' width='60' height='60'><br>";
echo "Monster Name: <b>$mName</b><br>";
echo " HP: $mHP, DMG: ~$mDMG, XP: $mDRP, Lvl: $mLVL";

	
$_SESSION["MonsHP"] = $mHP;
$_SESSION["MonsDMG"] = $mDMG;

//basic attack
echo
  "<section class='container2'>
    <div class='11-30'>
	      <form id='yourFormId' method='post' action='FCAL.php'>
		   <input type='hidden' name='skl' value='1111'>
           <button name='Basic Attack' type='submit' class='showButon' value='11111' onclick='myfunc(this)'>Basic Attack</button>
      </form>
    </div>
  </section>";
  

  echo "<div id='mini2'>Physical Skills:";
  
//skills
include 'PHP/SkillsP.php';

  
  echo "</div>";
    echo "<div id='mini2'>Magick Skills:";
  
//skills
include 'PHP/SkillsM.php';

  
  echo "</div>";
  mysqli_close($db);
  ?>
&nbsp;
  <section class="container3">
    <div class="31-50">
	      <form method="post" action="Sync3.php">
        <p class="submit"><input type="submit" name="commit" value="Flee"></p>
      </form>
    </div>
  </section>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">  
</script>
<script type="text/javascript">

function myfunc(div) {
  var className = div.getAttribute("class");
  if(className=="submit") {
    div.className = "disabled";
  }
  if(className=="showButon") {
    div.className = "disabled";
  }
}

</script>
<!--script ends here-->

</body>
</html>