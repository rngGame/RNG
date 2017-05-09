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

$_SESSION["PAGE2"] = "location:FightTB.php";
$_SESSION["LOSE"] = "location:loseB.php";

//set what type reward to get
$type = rand(1,100);
if ($type > 1){
	$_SESSION["PAGE"] = "location:rewBoss.php";} 

$HPin = $_SESSION["HP"];
$Armor = $_SESSION["ARM"];

$minPdmg = $_SESSION["DMGPmin"];
$maxPdmg = $_SESSION["DMGPmax"];
$minMdmg = $_SESSION["DMGMmin"];
$maxMdmg = $_SESSION["DMGMmax"];

$User = $_SESSION["User"];

$mName = $_SESSION["MonsName"];
$mHP = $_SESSION["MonsHP"];
$mDMG = $_SESSION["MonsDMG"];
$mLVL = $_SESSION["MonsLVL"];

$SKL = $_SESSION["ENERGY"];
$SKLm = $_SESSION["ENERGYM"];

if (!isset($_SESSION["HPO"])){
	$_SESSION["HPO"]=$HPin;
}
if (!isset($_SESSION["LOG"])){
	$LOG = $_SESSION["LOG"];
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

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
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
echo "<font size='-1'><p align='left'>HP: <font size='3' color='Green'>$HPin  </font>";
echo "DMG: <font size='3' color='red'>~$avgP</font>/<font size='3' color='#0066ff'>~$avgM  </font>";
echo "ARMOR: <font size='3' color='gold'>$Armor  </font>";
echo "ENERGY: <font size='3' color='#0066ff'>$SKL / $SKLm  </font>$ESStext</p></font>";


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

//k,kk,kkk
	$mHPN = $mHP;
	$mHPN = "$mHP";
if ($mHP > 1000){
	$mHPN = round($mHP/1000,1);
	$mHPN = "$mHPN k.";
}
if ($mHP > 1000000){
	$mHPN = round($mHP/1000000,1);
	$mHPN = "$mHPN kk.";
}
if ($mHP > 10000000000){
	$mHPN = round($mHP/1000000000,1);
	$mHPN = "$mHPN kkk.";
}

echo " <div class='$panel'>";
echo $_SESSION["LOG"];
echo '</div>';
echo "<img src='IMG/Mon/boss.jpg' width='60' height='60'><br>";
echo "Monster Name: <b>$mName</b><br>";
echo " HP: $mHPN, DMG: <font color='#992966'>$mDMG</font>, $defMon Lvl: $mLVL";


	
$_SESSION["MonsHP"] = $mHP;
$_SESSION["MonsDMG"] = $mDMG;

echo
  "<section class='container2'>
    <div class='11-30'>
	      <form id='yourFormId' method='post' action='FCAL.php'>
		  <input type='hidden' name='skl' value='1111'>
           <button name='Attack' type='submit' class='showButon' value='' onclick='myfunc(this)'>Attack</button>
      </form>
    </div>
  </section>";
  
  
 echo "<div id='mini2'>Skills:";


 if ($ACC[3] >= 10 and $SKL > 30){
 echo
  "<section class='container2'>
    <div class='tooltip'>
	      <form method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='1' placeholder='lvl'>
       <p class='submit' onclick='myfunc(this)'><input img $c1 src='IMG/pack/Icon.6_98.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>30En.<br>$t1 to single attack</span></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}
  else{
	   echo
  "<section class='container2'>
    <div class='tooltip'>
	      <form method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='1' placeholder='lvl'>
        <p class='submit'><img class='blur' src='IMG/pack/Icon.6_98.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}
  $pois = 0;
  if (isset($_SESSION["pois"])){
	  $pois = 1;}
  if ($ACC[3] >= 15 and $SKL > 35 and $pois == 0){
 echo
  "
    <div class='tooltip'>
	      <form method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='7' placeholder='lvl'>
        <p class='submit' onclick='myfunc(this)'><input img $c2 src='IMG/pack/Icon.1_19.png' style='width:45px;height:45px;' type='image' name='commit' value='(40)Heal'><span class='tooltiptext'>35En.<br>Poison enemy $t2</span></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  else{
	   echo
  "
    <div class='tooltip'>
	      <form method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='7' placeholder='lvl'>
        <p class='submit'><img class='blur' src='IMG/pack/Icon.1_19.png' style='width:45px;height:45px;' type='image' name='commit' value='(40)Heal'></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  
  
     if ($ACC[3] >= 25 and $SKL > 30){
 echo
  "
    <div class='tooltip'>
	      <form method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='5' placeholder='lvl'>
        <p class='submit' onclick='myfunc(this)'><input img $c4 src='IMG/pack/Icon.3_17.png' style='width:45px;height:45px;' type='image' name='commit' value='(40)Heal'><span class='tooltiptext'>30En.<br>Reflect $t4 dmg. back to monster and + player DEF</span></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  else{
	   echo
  "
    <div class='tooltip'>
	      <form method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='5' placeholder='lvl'>
        <p class='submit'><img class='blur' src='IMG/pack/Icon.3_17.png' style='width:45px;height:45px;' type='image' name='commit' value='(40)Heal'></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  
   if ($ACC[3] >= 30 and $SKL > 50){
 echo
  "
    <div class='tooltip'>
	      <form method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='3' placeholder='lvl'>
        <p class='submit' onclick='myfunc(this)'><input img $c5 src='IMG/pack/Icon.6_05.png' style='width:45px;height:45px;' type='image' name='commit' value='(50)Dmg Boost'><span class='tooltiptext'>50En.<br>Atack and increase DMG for fight<br>$t5</span></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  else{
	   echo
  "
    <div class='tooltip'>
	      <form method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='3' placeholder='lvl'>
        <p class='submit'><img class='blur' src='IMG/pack/Icon.6_05.png' style='width:45px;height:45px;' type='image' name='commit' value='(50)Dmg Boost'></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  
   if ($ACC[3] >= 35 and $SKL > 60){
 echo
  "
    <div class='tooltip'>
	      <form method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='4' placeholder='lvl'>
        <p class='submit' onclick='myfunc(this)'><input img $c6 src='IMG/pack/Icon.1_42.png' style='width:45px;height:45px;' type='image' name='commit' value='(50)Dmg Boost'><span class='tooltiptext'>60En.<br>Atack 5 times in a row<br>5 x 40% dmg. $t6</span></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  else{
	   echo
	  "
    <div class='tooltip'>
	      <form method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='4' placeholder='lvl'>
        <p class='submit'><img class='blur' src='IMG/pack/Icon.1_42.png' style='width:45px;height:45px;' type='image' name='commit' value='(50)Dmg Boost'></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";
  }
  
    if ($ACC[3] >= 40 and $SKL > 70){
 echo
  "
    <div class='tooltip'>
	      <form method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='6' placeholder='lvl'>
        <p class='submit' onclick='myfunc(this)'><input img $c7 src='IMG/pack/Icons8_40.png' style='width:45px;height:45px;' type='image' name='commit' value='(50)Dmg Boost'><span class='tooltiptext'>70En.<br>Increase cryt dmg $t7.</span></p> 
      </form>
    </div>
  </section>";}
  else{
	   echo
	    "
    <div class='tooltip'>
	      <form method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='6' placeholder='lvl'>
        <p class='submit'><img class='blur' src='IMG/pack/Icons8_40.png' style='width:45px;height:45px;' type='image' name='commit' value='(50)Dmg Boost'></p> 
      </form>
    </div>
  </section>";}
  
  echo "</div>";
   echo "<div id='mini2'>Magick Skills:";
  
//skills
include 'PHP/SkillsM.php';

  
  echo "</div>";
  mysqli_close($db);
  ?>
  <section class="container3">
    <div class="31-50">
	      <form method="post" action="loseB.php">
          <input type="hidden" name="FLEE" value="1">
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