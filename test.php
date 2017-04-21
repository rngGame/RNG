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

$User = $_SESSION["User"]; //user

$_SESSION["PAGE2"] = "location:test.php";
$_SESSION["LOSE"] = "location:lose.php";

echo "World Of RNG";
echo "</header>";

//Party join list
if (isset($_POST["JP"])){
	$FreeParty = mysqli_query($db,"SELECT * FROM Party where PL2 IS NULL or PL3 IS NULL or PL4 IS NULL  ");
	while ($FreeParty1 = mysqli_fetch_array($FreeParty)){	
	
		$countPL = 0;
	if ($FreeParty1["1"] == ""){
		$countPL += 1 ;}
	if ($FreeParty1["2"] == ""){
		$countPL += 1 ;}
	if ($FreeParty1["3"] == ""){
		$countPL += 1 ;}
	if ($FreeParty1["4"] == ""){
		$countPL += 1 ;}
	$countPL = 4 - $countPL;
	
	
	
	echo "Party:<br>Master - $FreeParty1[1]<br>Players: $countPL/4 - Monsters killed:$FreeParty1[5] 
	<section class='action2'>
	<form method='post' action='party.php'>
		<input hidden='' type='text' name='Party' value='$FreeParty1[1]' placeholder='Reroll Mod'>
		<p class='submit'>
		<input hidden='' type='text' name='Slot' value='$countPL' placeholder='Reroll Mod'>
		<p class='submit'>
  			<input type='submit' name='commit2' value='Join Party'>
  		</p>
  	</form>
</section>
<hr width='100px' style='position:fixed' >
	
	<br><br>";
	
	
	
	}
	?>
      <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
  <?php
	
	
	die();
}

//Party create
if (isset($_POST["CP"])){
	
$order = "INSERT INTO Party
	(PL1, MobsKilled)
	VALUES
	('$User', '0')";	   

$result = mysqli_query($db, $order);

header("location:sync.php");
die();
	
}


//mob create
if (isset($_POST["CRT"]) or isset($_SESSION["NewMob"])){
	
	unset($_SESSION["NewMob"]);
	$_SESSION["PartCreatMOB"] = 1;
	
	$PartyS = mysqli_query($db,"SELECT * FROM Party where PL1 = '$User' or PL2 = '$User' or PL3 = '$User' or PL4 = '$User'  ");
	$Party = mysqli_fetch_assoc($PartyS); //Party
	
	//if exist already
	$PartyMons = mysqli_query($db,"SELECT * FROM PartyMonsters where PartyID = '$Party[ID]' ");
	$PartyMonsF = mysqli_fetch_assoc($PartyMons);
	
if ($PartyMonsF["ID"] == 0){
	

//get  lvl
if ( $Party["PL1"] <> ""){
	$Pl1= mysqli_query($db,"SELECT * FROM characters where User = '$Party[PL1]' ");
	$Pl1L = mysqli_fetch_assoc($Pl1);
	$plcount  = 1;
	
}
if ( $Party["PL2"] <> ""){
	$Pl2= mysqli_query($db,"SELECT * FROM characters where User = '$Party[PL2]' ");
	$Pl2L = mysqli_fetch_assoc($Pl2);
	$plcount  += 1;
	
}
if ( $Party["PL3"] <> ""){
	$Pl3= mysqli_query($db,"SELECT * FROM characters where User = '$Party[PL3]' ");
	$Pl3L = mysqli_fetch_assoc($Pl3);
	$plcount  += 1;
	
}
if ( $Party["PL4"] <> ""){
	$Pl4= mysqli_query($db,"SELECT * FROM characters where User = '$Party[PL4]' ");
	$Pl4L = mysqli_fetch_assoc($Pl4);
	$plcount  += 1;
}


$mobCount =  10  + $Party["MobsKilled"];
$mobLVL = round(($mobCount + $Pl1L["ILVL"] + $Pl2L["ILVL"] + $Pl3L["ILVL"] + $Pl4L["ILVL"]) / $plcount); 
	
	$_SESSION["ILVL"] = $mobLVL;
	$_SESSION["PartyID"] = $Party["ID"];
	$_SESSION["PLCount"] = $plcount;
	echo $mobLVL;
	header("location:fightNew.php");
	die();
}
else{
	header("location:sync.php");
	die();	
}
	
}

$PartyS = mysqli_query($db,"SELECT * FROM Party where PL1 = '$User' or PL2 = '$User' or PL3 = '$User' or PL4 = '$User'  ");
$Party = mysqli_fetch_assoc($PartyS); //Party

$PLS= mysqli_query($db,"SELECT * FROM Party where PL1 = '$User' or PL2 = '$User' or PL3 = '$User' or PL4 = '$User'  ");
$PL = mysqli_fetch_assoc($PLS);

if ($PL["PL1"] == $User){
	$PLnr = "PL1";}
if ($PL["PL2"] == $User){
	$PLnr = "PL2";}
if ($PL["PL3"] == $User){
	$PLnr = "PL3";}
if ($PL["PL4"] == $User){
	$PLnr = "PL4";}
	
	
$FreeParty = mysqli_query($db,"SELECT * FROM Party where ID =  '$Party[ID]'  ");
$FreeParty = mysqli_fetch_row($FreeParty);

	
		$PlayerNR = 0;
	if ($FreeParty[1] <> ""){
		$PlayerNR += 1 ;}
	if ($FreeParty[2] <> ""){
		$PlayerNR += 1 ;}
	if ($FreeParty[3] <> ""){
		$PlayerNR += 1 ;}
	if ($FreeParty[4] <> ""){
		$PlayerNR += 1 ;}

$_SESSION["Party2"] = $Party["ID"];
 $_SESSION["PlayerNR"] = $PLnr;
 $_SESSION["PartySK"] = $PlayerNR;

//set what type reward to get

$_SESSION["PAGE"] = "location:newiP.php";


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
	
	//mosnter stats
$Monster = mysqli_query($db,"SELECT * FROM PartyMonsters where PartyID = '$Party[ID]' ");
$MonsterS = mysqli_fetch_assoc($Monster); 
	
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

echo"<div id='result2'></div>";


$_SESSION["MonsHP"] = $MonsterS["MonsterHP"];
$_SESSION["MonsDMG"] = $MonsterS["MonsterPhyDMG"];
$_SESSION["MonsDMGm"] = $MonsterS["MonsterMagDMG"];
$_SESSION["MonsLVL"] = $MonsterS["MonsterLVL"];
$_SESSION["MonsDEF"] = $MonsterS["MonsterDEF"];
$_SESSION["Party"] = 1;

//check if still exist
$MobHP = $MonsterS["MonsterHP"];
if ($MobHP < 0 or !isset($MonsterS["MonsterHP"])){
	
	$sql2="DELETE FROM PartyMonsters WHERE PartyID='$Party[ID]'";
mysqli_query($db,$sql2);

	
	header("location:sync.php");  
	die();}

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
include 'PHP/ItemsFight.php';

  
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

if(typeof(EventSource) !== "undefined") {
    var source = new EventSource("PartyMonsters_upd.php");
    source.onmessage = function(event) {
        document.getElementById("result2").innerHTML = event.data ;
    };
} else {
    document.getElementById("result2").innerHTML = "Sorry, your browser does not support server-sent events...";
}
</script>
</header>
</body>
