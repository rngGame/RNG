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
$_SESSION["ITEM"] = 1; //set for reward item

$User = $_SESSION["User"]; //user

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

//set what type reward to get
$type = rand(1,200);
if ($type > 140){
	$_SESSION["PAGE"] = "location:newi.php";}
else if ($type > 60){
	$_SESSION["PAGE"] = "location:rewarm.php";} 
	else if ($type > 1){
		$_SESSION["PAGE"] = "location:rewtali.php";} 
		
//check for uniq drop
if ($type == 69 and $ACC[3] > 19){ 
	$_SESSION["UNQ"] = 1;
	$_SESSION["PAGE"] = "location:uniqR.php";}

$HPin = $_SESSION["HP"];
$Armor = $_SESSION["ARM"];
$ArmorM = $_SESSION["MARM"];

$minPdmg = $_SESSION["DMGPmin"];
$maxPdmg = $_SESSION["DMGPmax"];
$minMdmg = $_SESSION["DMGMmin"];
$maxMdmg = $_SESSION["DMGMmax"];


$gold = $_SESSION["Gold1"];
$gl = $_SESSION["Gold2"];
$BLVL = $_SESSION["fLVL"];

$mName = $_SESSION["MonsName"];
$mHP = $_SESSION["MonsHP"];
$mDMG = $_SESSION["MonsDMG"];
$mDMGm = $_SESSION["MonsDMGm"];
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

if ($HPin > $_SESSION["HPO"]){
	$HPin = $_SESSION["HPO"];} 

//average dmg recalculate
$avgP = round(($minPdmg + $maxPdmg) / 2);
$avgM = round(($minMdmg + $maxMdmg) / 2);
$avgD = round(($avgP + $avgM) / 2);


if ($ACC[10] < 10){
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$ACC[10]' ");
$CLS = mysqli_fetch_row($CLS);
}
if ($ACC[10] > 10){
$SUB = mysqli_query($db,"SELECT * FROM Subclass where ID = '$ACC[10]' ");
$SUB = mysqli_fetch_row($SUB);
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$SUB[2]' ");
$CLS = mysqli_fetch_row($CLS);
}

//check what skill get bonusses
include 'PHP/skillclas.php';


echo "World Of RNG";
echo "</header>";
echo "<p align='left'>HP: <font size='3' color='Green'>$HPin  </font>";
echo "DMG: <font size='3' color='red'>~$avgP</font>/<font size='3' color='#0066ff'>~$avgM  </font>";
echo "ARMOR: <font size='3' color='gold'>$Armor</font> / <font size='3' color='#DF01D7'>$ArmorM </font> ";
echo "ENERGY: <font size='3' color='#0066ff'>$SKL / $SKLm  </font></p>";

$panel = "right-panel"; //set panel for log

// check for pet
if (isset($_SESSION["PET"])){
	$panel = "rightpanel2";
	$petname = $_SESSION["PETNAME"];
	$petHP = round($_SESSION["PETHP"]);
	$petminDMG = round ($_SESSION["PETMINDMG"]);
	$petmaxDMG = round ($_SESSION["PETMAXDMG"]);
	echo "<div>
	Pet Name: <b>$petname</b><br>Pet HP: <font color='Green'>$petHP</font> <br>Pet Dmg: <font size='3' color='#0066ff'>$petminDMG ~ $petmaxDMG</font><br><br>";
}


echo " <div class='$panel'>";
echo $_SESSION["LOG"];
echo '</div>';

echo "<img src='IMG/Mon/$imgm.jpg' width='60' height='60'><br>";
echo "Monster Name: <b>$mName</b><br>";
echo " HP: $mHP, DMG: <font color='red'>~$mDMG</font>/<font color='0066ff'>~$mDMGm</font>, XP: $mDRP, Lvl: $mLVL";

	
$_SESSION["MonsHP"] = $mHP;
$_SESSION["MonsDMG"] = $mDMG;

//basic attack
echo
  "<section class='container2'>
    <div class='11-30'>
	      <form id='yourFormId' method='post' action='FCAL.php'>
		   <input type='hidden' name='skl' value='11'>
           <button name='Basic Attack' type='submit' class='showButon' value='11' onclick='myfunc(this)'>Basic Attack</button>
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
  
  echo "</div>";
    echo "<div id='mini2'>Items:";
  
//ITEMS
//include 'PHP/SkillsM.php';
echo "WORKING ON!";
  
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