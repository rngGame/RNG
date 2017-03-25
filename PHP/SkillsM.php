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
        <p class='submit' onclick='myfunc(this)'><input  img $c9 src='IMG/pack/Icon.7_59.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>50En.<br>Combine Magickal and Physical for a single attack</span></p> 
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
  
  
 //combine
if ($ACC[3] >= 30 and $SKL > 330){
 echo"
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='FCAL.php'>
          <input type='hidden' name='skl' value='33'>
        <p class='submit' onclick='myfunc(this)'><input  img $c9 src='IMG/pack/Icon.5_95.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>300En.<br>Launch vally of ice commets on targer</span></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}
  else{
	   echo"
    <div class='tooltip'>
	      <form id='yourFormId'  method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='32' placeholder='lvl'>
        <p class='submit' ><img class='blur' src='IMG/pack/Icon.5_95.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}  

?>