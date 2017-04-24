<?php

//fireball
if ($ACC[3] >= 10 and $SKL > 30){
 echo
  "<section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='FCAL.php'>
          <input type='hidden' name='skl' value='31'>
        <p class='submit' onclick='myfunc(this)'><input  img $c8 src='IMG/pack/Icon.1_24.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>30En.<br>Fire Ball $t8</span></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}
  else{
	   echo
  "<section class='container2'>
    <div class='tooltip'>
	      <form id='yourFormId'  method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='31' placeholder='lvl'>
        <p class='submit' ><img class='blur' src='IMG/pack/Icon.1_24.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}
  
  //combine
if ($ACC[3] >= 20 and $SKL > 50){
 echo"
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='FCAL.php'>
          <input type='hidden' name='skl' value='32'>
        <p class='submit' onclick='myfunc(this)'><input  img $c13 src='IMG/pack/Icon.7_59.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>50En.<br>Combine Magickal and Physical for a single attack $t13</span></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}
  else{
	   echo"
    <div class='tooltip'>
	      <form id='yourFormId'  method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='32' placeholder='lvl'>
        <p class='submit' ><img class='blur' src='IMG/pack/Icon.7_59.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}
  
  if ($ACC[3] >= 20 and $SKL > 40){
 echo
  "
    <div class='tooltip'>
	      <form id='yourFormId' method='post' action='FCAL.php'>
		  		  <select hidden='' name='skl'>
		  <option value='2' selected>2/option>
		  </select>
          <input hidden='' type='text' name='skl' value='2' placeholder='lvl'>
        <p class='submit' onclick='myfunc(this)'><input img $c3 src='IMG/pack/Icon.6_02.png' style='width:45px;height:45px;' type='image' name='commit' value='(40)Heal'><span class='tooltiptext'>40En.<br>Atack and increase helth<br>by $t3</span></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  else{
	   echo
  "
    <div class='tooltip'>
	      <form id='yourFormId' method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='2' placeholder='lvl'>
        <p class='submit'><img class='blur' src='IMG/pack/Icon.6_02.png' style='width:45px;height:45px;' type='image' name='commit' value='(40)Heal'></p> 
      </form> 
    </div>&nbsp;&nbsp;
  ";}
  
    //Summon
   $summ = 0;
  if (isset($_SESSION["PET"])){
	  $summ = 1;}
if ($ACC[3] >= 25 and $SKL > 100 and $summ == 0){
 echo"
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='FCAL.php'>
          <input type='hidden' name='skl' value='34'>
        <p class='submit' onclick='myfunc(this)'><input  img $c14 src='IMG/pack/Icon.5_64.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>100En.<br>Summon kindred spirit $t14</span></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}
  else{
	   echo"
    <div class='tooltip'>
	      <form id='yourFormId'  method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='34' placeholder='lvl'>
        <p class='submit' ><img class='blur' src='IMG/pack/Icon.5_64.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;} 
  
 //combine
if ($ACC[3] >= 30 and $SKL > 330){
 echo"
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='FCAL.php'>
          <input type='hidden' name='skl' value='33'>
        <p class='submit' onclick='myfunc(this)'><input  img $c12 src='IMG/pack/Icon.5_95.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>330En.<br>Launch vally of ice commets on targer $t12</span></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}
  else{
	   echo"
    <div class='tooltip'>
	      <form id='yourFormId'  method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='33' placeholder='lvl'>
        <p class='submit' ><img class='blur' src='IMG/pack/Icon.5_95.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}   
  
  //Buff
   $armr = 0;
  if (isset($_SESSION["SKILL35"])){
	  $armr = 1;}
if ($ACC[3] >= 35 and $SKL > 100 and $armr == 0){
 echo"
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='FCAL.php'>
          <input type='hidden' name='skl' value='35'>
        <p class='submit' onclick='myfunc(this)'><input  img $c16 src='IMG/pack/Icon.1_35.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>150En.<br>Removes defence to increse damage $t16</span></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}
  else{
	   echo"
    <div class='tooltip'>
	      <form id='yourFormId'  method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='35' placeholder='lvl'>
        <p class='submit' ><img class='blur' src='IMG/pack/Icon.1_35.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}  
  
  //Suiced
   $helth = 5000;
  if ($SUB[5] == "HERO" ){
	  $helth = 10000;}
	if ($SUB[5] == "CHAM" ){
	  $helth = 3000;}
if ($ACC[3] >= 42 and $SKL > 200 and $HPin > $helth ){
	
 echo"
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='FCAL.php'>
          <input type='hidden' name='skl' value='36'>
        <p class='submit' onclick='myfunc(this)'><input  img $c17 src='IMG/pack/Icons8_30.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>200En.<br>Sacrifice portion of health and deal masive damage $t17</span></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}
  else{
	   echo"
    <div class='tooltip'>
	      <form id='yourFormId'  method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='36' placeholder='lvl'>
        <p class='submit' ><img class='blur' src='IMG/pack/Icons8_30.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}  

?>