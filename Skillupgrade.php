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
<header>
<body>
<?php
session_start();
include_once 'PHP/db.php';
	
	
	
$User = $_SESSION["User"]; //user

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
	

$TRE = mysqli_query($db,"SELECT * FROM passiveTree where Name = '$User' ");
$TRE = mysqli_fetch_row($TRE);	
	
//make every string individual
$arrayP = str_split($TRE[1]);
	
// $array[0]; - first and so on//
	
//26 SKILLS
	
if ($arrayP[0] == 0){
	$c1a = "class='blur2'";
}
if ($arrayP[0] == "a"){
	$c1a = "class='test2'";	
}
if ($ACC[3]>= 5){
 echo
  "LVL 5:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c1a'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1a src='IMG/pack/Icons8_61.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+5 STR and INT</span></p> 
      </form>
    </div>
	</section>";
}
else{
echo "<h1>Check at lvl 5</h1>";
}

if ($arrayP[1] == 0){
	$c2a = "class='blur2'";
	$c2b = "class='blur2'";
}
if ($arrayP[1] == "a"){
	$c2a = "class='test2'";	
}
if ($arrayP[1] == "b"){
	$c2b = "class='test2'";	
}	
if ($ACC[3]>= 10){
echo	
  "<br>LVL 10:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c2a'>
        <p class='submit' onclick='myfunc(this)'><input  img $c2a src='IMG/pack/Icon.7_11.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+10% HP</span></p> 
      </form>
	  </div>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c2b'>
        <p class='submit' onclick='myfunc(this)'><input  img $c2b src='IMG/pack/Icons8_03.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+20% MP</span></p> 
      </form>
    </div>
	</section>";
}

if ($arrayP[2] == 0){
	$c3a = "class='blur2'";
	$c3b = "class='blur2'";
	$c3c = "class='blur2'";
}
if ($arrayP[2] == "a"){
	$c3a = "class='test2'";	
}
if ($arrayP[2] == "b"){
	$c3b = "class='test2'";	
}	
if ($arrayP[2] == "c"){
	$c3c = "class='test2'";	
}
	
if ($ACC[3]>= 15){
echo	
	 
	  "<br>LVL 15:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c3a'>
        <p class='submit' onclick='myfunc(this)'><input  img $c3a src='IMG/pack/Icon.4_09.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>30% of pdmg to mdmg</span></p> 
      </form>
	  </div>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c3b'>
        <p class='submit' onclick='myfunc(this)'><input  img $c3b src='IMG/pack/Icon.4_11.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>10% of mdmg to pdmg</span></p> 
      </form>
	  </div>
  	<div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'> 
          <input type='hidden' name='skl' value='c3c'>
        <p class='submit' onclick='myfunc(this)'><input  img $c3c src='IMG/pack/Icon.7_06.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>10% to dodge attack</span></p> 
      </form>
    </div>
	</section>";
}
	
if ($arrayP[3] == 0){
	$c4a = "class='blur2'";
	$c4b = "class='blur2'";
	$c4c = "class='blur2'";
}
if ($arrayP[3] == "a"){
	$c4a = "class='test2'";	
}
if ($arrayP[3] == "b"){
	$c4b = "class='test2'";	
}	
if ($arrayP[3] == "c"){
	$c4c = "class='test2'";	
}
if ($ACC[3]>= 20){
echo	
	
	  "<br>LVL 20:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c4a'>
        <p class='submit' onclick='myfunc(this)'><input  img $c4a src='IMG/pack/Icons8_77.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>5% to deal 2x dmg</span></p> 
      </form>
	  </div>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c4b'>
        <p class='submit' onclick='myfunc(this)'><input  img $c4b src='IMG/pack/Icons8_53.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>Restore 2% HP/turn</span></p> 
      </form>
	  </div>
  	<div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'> 
          <input type='hidden' name='skl' value='c4c'>
        <p class='submit' onclick='myfunc(this)'><input  img $c4c src='IMG/pack/Icons8_23.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>15% to all resistances</span></p> 
      </form>
    </div>
	</section>";
}

if ($arrayP[4] == 0){
	$c5a = "class='blur2'";

}
if ($arrayP[4] == "a"){
	$c5a = "class='test2'";	
}
if ($ACC[3]>= 23){
echo	
	"<br>LVL 23:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c5a'>
        <p class='submit' onclick='myfunc(this)'><input  img $c5a src='IMG/pack/Icon.6_68.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+7 STR and INT</span></p> 
      </form>
    </div>
	</section>";
}
	
if ($arrayP[5] == 0){
	$c6a = "class='blur2'";
	$c6b = "class='blur2'";
	$c6c = "class='blur2'";
	$c6d = "class='blur2'";
}
if ($arrayP[5] == "a"){
	$c6a = "class='test2'";	
}
if ($arrayP[5] == "b"){
	$c6b = "class='test2'";	
}	
if ($arrayP[5] == "c"){
	$c6c = "class='test2'";	
}
if ($arrayP[5] == "d"){
	$c6d = "class='test2'";	
}
if ($ACC[3]>= 25){
echo	
	
	"<br>LVL 25:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c6a'>
        <p class='submit' onclick='myfunc(this)'><input  img $c6a src='IMG/pack/Icon.2_80.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>15% of damage delt as extra CHAOS dmg</span></p> 
      </form>
	  </div>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c6b'>
        <p class='submit' onclick='myfunc(this)'><input  img $c6b src='IMG/pack/Icon.2_68.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>First turn monster deal no damage</span></p> 
      </form>
	  </div>
  	<div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'> 
          <input type='hidden' name='skl' value='c6c'>
        <p class='submit' onclick='myfunc(this)'><input  img $c6c src='IMG/pack/Icon.6_62.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>Auttomaticaly resummon summon</span></p> 
      </form>
    </div>
	  	<div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'> 
          <input type='hidden' name='skl' value='c6d'>
        <p class='submit' onclick='myfunc(this)'><input  img $c6d src='IMG/pack/Icon.1_75.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>10 enr/turn</span></p> 
      </form>
    </div>
	</section>";
}
	
if ($arrayP[6] == 0){
	$c7a = "class='blur2'";
	$c7b = "class='blur2'";

}
if ($arrayP[6] == "a"){
	$c7a = "class='test2'";	
}
if ($arrayP[6] == "b"){
	$c7b = "class='test2'";	
}	
if ($ACC[3]>= 30){
echo	

	"<br><br>LVL 30:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c7a'>
        <p class='submit' onclick='myfunc(this)'><input  img $c7a src='IMG/pack/Icon.1_05.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+2000 HP and PDMG </span></p> 
      </form>
	  </div>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c7b'>
        <p class='submit' onclick='myfunc(this)'><input  img $c7b src='IMG/pack/Icon.1_22.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+200 HP, ENR, MDMG and DEF </span></p> 
      </form>
	  </div>
	  </section>";
}
	
if ($arrayP[7] == 0){
	$c8a = "class='blur2'";
	$c8b = "class='blur2'";

}
if ($arrayP[7] == "a"){
	$c8a = "class='test2'";	
}
if ($arrayP[7] == "b"){
	$c8b = "class='test2'";	
}	

if ($ACC[3]>= 35){
echo	
	  
		"<br>LVL 35:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c8a'>
        <p class='submit' onclick='myfunc(this)'><input  img $c8a src='IMG/pack/Icon.1_33.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+50% crit dmg, +10% mdmg</span></p> 
      </form>
	  </div>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c8b'>
        <p class='submit' onclick='myfunc(this)'><input  img $c8b src='IMG/pack/Icon.3_91.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+20 crit chanse, +30% ES</span></p> 
      </form>
	  </div>
	  </section>";
}
	
if ($arrayP[8] == 0){
	$c9a = "class='blur2'";
	$c9b = "class='blur2'";
	$c9c = "class='blur2'";
	$c9d = "class='blur2'";
}
if ($arrayP[8] == "a"){
	$c9a = "class='test2'";	
}
if ($arrayP[8] == "b"){
	$c9b = "class='test2'";	
}	
if ($arrayP[8] == "c"){
	$c9c = "class='test2'";	
}
if ($arrayP[8] == "d"){
	$c9d = "class='test2'";	
}
if ($ACC[3]>= 40){
echo
	
		"<br>LVL 40:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c9a'>
        <p class='submit' onclick='myfunc(this)'><input  img $c9a src='IMG/pack/Icon.5_88.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>Monsters deals 10% more dmg, you deal 20% more dmg.</span></p> 
      </form>
	  </div>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c9b'>
        <p class='submit' onclick='myfunc(this)'><input  img $c9b src='IMG/pack/Icon.6_22.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+10 STR and INT, restores 2% hp/turn </span></p> 
      </form>
	  </div>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='c9c'>
        <p class='submit' onclick='myfunc(this)'><input  img $c9c src='IMG/pack/Icon.6_86.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>10% chanse to restore 20% of HP</span></p> 
      </form>
	  </div>
	  </section>";
}
	
if ($arrayP[9] == 0){
	$caa = "class='blur2'";
	$cab = "class='blur2'";
	$cac = "class='blur2'";
	$cad = "class='blur2'";
	$cae = "class='blur2'";
}
if ($arrayP[9] == "a"){
	$caa = "class='test2'";	
}
if ($arrayP[9] == "b"){
	$cab = "class='test2'";	
}	
if ($arrayP[9] == "c"){
	$cac = "class='test2'";	
}

if ($arrayP[9] == "d"){
	$cad = "class='test2'";	
}
if ($arrayP[9] == "e"){
	$cae = "class='test2'";	
}
if ($ACC[3]>= 45){
echo


		"<br>LVL 45:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='caa'>
        <p class='submit' onclick='myfunc(this)'><input  img $caa src='IMG/pack/Icons8_32.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>Monsters can't deal cryt dmg.</span></p> 
      </form>
	  </div>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='cab'>
        <p class='submit' onclick='myfunc(this)'><input  img $cab src='IMG/pack/Icons8_38.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>2x energy restore</span></p> 
      </form>
	  </div>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='cac'>
        <p class='submit' onclick='myfunc(this)'><input  img $cac src='IMG/pack/Icons8_70.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>Monsters can't heal</span></p> 
      </form>
	  </div>	
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='cad'>
        <p class='submit' onclick='myfunc(this)'><input  img $cad src='IMG/pack/Icon.7_12.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>Monsters can't deal more then 15% of your HP/hit</span></p> 
      </form>
	  </div>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='cae'>
        <p class='submit' onclick='myfunc(this)'><input  img $cae src='IMG/pack/Icon.3_77.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+20 STR and INT, +10% dmg, +10% HP and ENR</span></p> 
      </form>
	  </div>
	  </section>
  ";
}

echo"
<div class='skillback'><section class='actionButtons'>
	<form method='post' action='sync.php'>
		<input hidden='' type='text' name='lvl2' value='Back'>
		<input type='submit' name='commit2' value='Back'>

  	</form>
	</div>";
	
	
?>
	</body>