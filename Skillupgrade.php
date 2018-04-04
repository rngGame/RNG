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

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
	

$TRE = mysqli_query($db,"SELECT * FROM passiveTree where Name = '$User' ");
$TRE = mysqli_fetch_row($TRE);	
	
//make every string individual
$array = str_split($TRE[1]);
	
// $array[0]; - first and so on//
	
	
	
 echo
  "LVL 5:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icons8_61.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+5 STR and INT</span></p> 
      </form>
    </div>&nbsp;&nbsp
	
  <br><br>LVL 10:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.7_11.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+10% HP</span></p> 
      </form>
	  </div>
  <section class='container2'>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icons8_03.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+20% MP</span></p> 
      </form>
    </div>&nbsp;&nbsp;
	 
	  <br><br>LVL 15:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.4_09.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>30% of pdmg to mdmg</span></p> 
      </form>
	  </div>
  <section class='container2'>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.4_11.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>10% of mdmg to pdmg</span></p> 
      </form>
	  </div>
  <section class='container2'>
  	<div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'> 
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.7_06.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>10% to dodge attack</span></p> 
      </form>
    </div>&nbsp;&nbsp;
	
	  <br><br>LVL 20:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icons8_77.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>5% to deal 2x dmg</span></p> 
      </form>
	  </div>
  <section class='container2'>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icons8_53.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>Restore 2% HP/turn</span></p> 
      </form>
	  </div>
  <section class='container2'>
  	<div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'> 
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icons8_23.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>15% to all resistances</span></p> 
      </form>
    </div>
	
	<br><br>LVL 23:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.6_68.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+7 STR and INT</span></p> 
      </form>
    </div>
	
	<br><br>LVL 25:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.2_80.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>15% of damage delt as extra CHAOS dmg</span></p> 
      </form>
	  </div>
  <section class='container2'>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.2_68.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>First turn monster deal no damage</span></p> 
      </form>
	  </div>
  <section class='container2'>
  	<div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'> 
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.6_62.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>Start fight with a summon</span></p> 
      </form>
    </div>
	<section class='container2'>
	  	<div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'> 
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.1_75.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>10 enr/turn</span></p> 
      </form>
    </div>
	
	
	<br><br>LVL 30:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.1_05.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+2000 HP and PDMG </span></p> 
      </form>
	  </div>
  <section class='container2'>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.1_22.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+200 HP, ENR, MDMG and DEF </span></p> 
      </form>
	  </div>
	  
		<br><br>LVL 30:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.1_33.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+50% crit dmg, +10% mdmg</span></p> 
      </form>
	  </div>
  <section class='container2'>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.3_91.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+20 crit chanse, +30% ES</span></p> 
      </form>
	  </div>
	
		<br><br>LVL 35:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.5_88.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>Monsters deals 10% more dmg, you deal 20% more dmg.</span></p> 
      </form>
	  </div>
  <section class='container2'>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.6_22.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+10 STR and INT, restores 2% hp/turn </span></p> 
      </form>
	  </div>
  <section class='container2'>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.6_86.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>10% chanse to restore 20% of HP</span></p> 
      </form>
	  </div>	


		<br><br>LVL 40:<br>
  <section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icons8_32.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>Monsters can't deal cryt dmg.</span></p> 
      </form>
	  </div>
  <section class='container2'>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icons8_38.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>Skills cost 0 ENR</span></p> 
      </form>
	  </div>
  <section class='container2'>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icons8_70.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>Monsters can't heal</span></p> 
      </form>
	  </div>	
  <section class='container2'>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.7_12.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>Monsters can't deal more then 30% of your HP</span></p> 
      </form>
	  </div>
 <section class='container2'>
  <div class='tooltip'>
	      <form method='post' id='yourFormId' action='changePassive.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.3_77.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>+20 STR and INT, +10% dmg, +10% HP and ENR</span></p> 
      </form>
	  </div>
  ";

	
	
?>