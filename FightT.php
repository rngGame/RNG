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
	
	//if dungeon run
	if (isset($_SESSION["RAIDKILLS"])){
		$_SESSION["LOSE"] = "location:dungdone.php";
	}
	
$_SESSION["ITEM"] = 1; //set for reward item

$User = $_SESSION["User"]; //user

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
	
//set what type reward to get
$type = rand(1,200);
if ($type > 180 and $ACC[3] > 19){
	$_SESSION["PAGE"] = "location:rewskl.php";}
else if ($type > 140){
	$_SESSION["PAGE"] = "location:newi.php";}
else if ($type > 60){
	$_SESSION["PAGE"] = "location:rewarm.php";} 
	else if ($type > 1){
		$_SESSION["PAGE"] = "location:rewtali.php";} 
		
//check for uniq drop
if ($type == 69 and $ACC[3] > 19){ 
	$_SESSION["UNQ"] = 1;
	$_SESSION["NOSHARDS"] = 1;
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

//player straing  HP
if (!isset($_SESSION["HPO"])){
	$_SESSION["HPO"]=$HPin;
}

//monster starting HP
if (!isset($_SESSION["HPM"])){
	$_SESSION["HPM"]=$mHP;
}

if (!isset($_SESSION["LOG"])){
	$LOG = $_SESSION["LOG"];
}

if ($SKL >= $SKLm){
	$SKL = $SKLm;
	$_SESSION["ENERGY"] = $SKL;
}

//energie Shield
if (isset($_SESSION["ESshield"])){
	$ESSO = round($_SESSION["ESshieldO"]);
	$ESS = round($_SESSION["ESshield"]);
	$ESR = round($_SESSION["ESregen"]);
	$ESStext = "ES Shield:<font color='lightblue'>$ESS / $ESSO <font size='-2'>($ESR/t)</font> </font>";
}


//if mob have def
if (isset($_SESSION["MonsDEF"])){
	$mobDef = $_SESSION["MonsDEF"];
	$defMon = " Armor:<font color='#FF804C'> $mobDef</font>, ";
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

//saving values
$HPintx = $HPin;
$avgPtx = $avgP;
$avgMtx = $avgM;
$Armortx = $Armor;
$ArmorMtx = $ArmorM;
	
//rounding
include 'PHP/rounding.php';


echo "World Of RNG";
echo "</header>";
echo "<div align='left'><font size='-1'>HP: <font size='3' color='Green'>$HPintx  </font>";
echo "DMG: <font size='3' color='red'>~$avgPtx</font>/<font size='3' color='#0066ff'>~$avgMtx  </font>";
echo "ARMOR: <font size='3' color='gold'>$Armortx</font> / <font size='3' color='#DF01D7'>$ArmorMtx </font> ";
echo "ENERGY: <font size='3' color='#0066ff'>$SKL / $SKLm  </font>";
echo "$ESStext </font>";

if (isset($_SESSION["ISKILL"])){
	echo " &nbsp &nbsp<div class='tooltip'  style='position: absolute';>
	$_SESSION[ISKILL]
	</div>";
}

echo "</div>";

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
	

//saving values
$mHPNtx = $mHP;
$mDMGtx = $mDMG;
$mDMGmtx = $mDMGm;
$mDRPtx = $mDRP;
	
//rounding
include 'PHP/rounding.php';
	
echo "<img src='IMG/Mon/$imgm.jpg' width='60' height='60'><br>";
	if (isset($_SESSION["MonsBOS"])){
		echo "<div class='Boss1'>BOSS !</div>";
	}
echo "Monster Name: <b>$mName</b>";
echo "<br>";
echo " HP: $mHPNtx, DMG: <font color='red'>~$mDMGtx</font>/<font color='0066ff'>~$mDMGmtx</font>,$defMon XP: $mDRPtx, Lvl: $mLVL";


	
//combo showing
$combo = $_SESSION["Combo"];
if ($combo >= 1){
	$combtest = "<div class='Combo1'>$combo x Combo !</div>";}
if ($combo >= 3){
	$combtest = "<div class='Combo2'>$combo x Combo !</div>";}
if ($combo >= 5){
	$combtest = "<div class='Combo3'>$combo x Combo !</div>";}
if ($combo >= 10){
	$combtest = "<div class='Combo4'>$combo x Combo !</div>";}
if ($combo < 1){
	$combtest = "";}
	


	
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
  
  echo $combtest;

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
include 'PHP/ItemsFight.php';

  
  echo "</div>";
  

	
if (isset($_SESSION["RAIDKILLS"])){	
	echo "&nbsp;
  <section class='container3'>
    <div class='31-50'>
	      <form method='post' action='dungdone.php'>
        <p class='submit'><input type='submit' name='commit' value='Finish Run'></p>
      </form>
    </div>
  </section>";
}
else{	
echo "&nbsp;
  <section class='container3'>
    <div class='31-50'>
	      <form method='post' action='sync.php'>
        <p class='submit'><input type='submit' name='commit' value='Flee'></p>
      </form>
    </div>
  </section>";
}
	
include 'PHP/CardSelect.php';
echo $Cards;
  mysqli_close($db);
  ?>

  
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