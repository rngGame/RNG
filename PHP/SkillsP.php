<?php
if ($ACC[3] >= 10 and $SKL > 30){
 echo
  "<section class='container2'>
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='FCAL.php'>
          <input type='hidden' name='skl' value='1'>
        <p class='submit' onclick='myfunc(this)'><input  img $c1 src='IMG/pack/Icon.6_98.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>30En.<br>$t1 to single attack</span></p> 
      </form>
    </div>&nbsp;&nbsp;"
  ;}
  else{
	   echo
  "<section class='container2'>
    <div class='tooltip'>
	      <form id='yourFormId'  method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='1' placeholder='lvl'>
        <p class='submit' ><img class='blur' src='IMG/pack/Icon.6_98.png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'></p> 
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
	      <form id='yourFormId' method='post' action='FCAL.php'>
		  		  <select hidden='' name='skl'>
		  <option value='7' selected>7/option>
		  </select>
          <input hidden='' type='text' name='skl' value='7' placeholder='lvl'>
        <p class='submit' onclick='myfunc(this)'><input img $c2 src='IMG/pack/Icon.1_19.png' style='width:45px;height:45px;' type='image' name='commit' value='(40)Heal'><span class='tooltiptext'>35En.<br>Poison enemy $t2</span></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  else{
	   echo
  "
    <div class='tooltip'>
	      <form id='yourFormId' method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='7' placeholder='lvl'>
        <p class='submit'><img class='blur' src='IMG/pack/Icon.1_19.png' style='width:45px;height:45px;' type='image' name='commit' value='(40)Heal'></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  
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
  
     if ($ACC[3] >= 25 and $SKL > 30){
 echo
  "
    <div class='tooltip'>
	      <form id='yourFormId' method='post' action='FCAL.php'>
		  		  <select hidden='' name='skl'>
		  <option value='5' selected>5/option>
		  </select>
          <input hidden='' type='text' name='skl' value='5' placeholder='lvl'>
        <p class='submit' onclick='myfunc(this)'><input img $c4 src='IMG/pack/Icon.3_17.png' style='width:45px;height:45px;' type='image' name='commit' value='(40)Heal'><span class='tooltiptext'>30En.<br>Reflect $t4 dmg. back to monster and + player DEF</span></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  else{
	   echo
  "
    <div class='tooltip'>
	      <form id='yourFormId' method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='5' placeholder='lvl'>
        <p class='submit'><img class='blur' src='IMG/pack/Icon.3_17.png' style='width:45px;height:45px;' type='image' name='commit' value='(40)Heal'></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  
   if ($ACC[3] >= 30 and $SKL > 50){

 echo
  "
    <div class='tooltip'>
	      <form id='yourFormId' method='post' action='FCAL.php'>
		  		  <select hidden='' name='skl'>
		  <option value='3' selected>3/option>
		  </select>
          <input hidden='' type='text' name='skl' value='3' placeholder='lvl'>
        <p class='submit' onclick='myfunc(this)'><input img $c5 src='IMG/pack/Icon.6_05.png' style='width:45px;height:45px;' type='image' name='commit' value='(50)Dmg Boost'><span class='tooltiptext'>50En.<br>Atack and increase physical DMG for fight<br>$t5</span></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  else{
	   echo
  "
    <div class='tooltip'>
	      <form id='yourFormId' method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='3' placeholder='lvl'>
        <p class='submit'><img class='blur' src='IMG/pack/Icon.6_05.png' style='width:45px;height:45px;' type='image' name='commit' value='(50)Dmg Boost'></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  
   if ($ACC[3] >= 35 and $SKL > 60){
 echo
  "
    <div class='tooltip'>
	      <form id='yourFormId'method='post' action='FCAL.php'>
		  		  <select hidden='' name='skl'>
		  <option value='4' selected>4/option>
		  </select>
          <input hidden='' type='text' name='skl' value='4' placeholder='lvl'>
       <p class='submit' onclick='myfunc(this)'><input img $c6 src='IMG/pack/Icon.1_42.png' style='width:45px;height:45px;' type='image' name='commit' value='(50)Dmg Boost'><span class='tooltiptext'>60En.<br>Atack 5 times in a row<br>5 x 60% dmg. $t6</span></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  else{
	   echo
	 "
    <div class='tooltip'>
	      <form id='yourFormId' method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='4' placeholder='lvl'>
        <p class='submit'><img class='blur' src='IMG/pack/Icon.1_42.png' style='width:45px;height:45px;' type='image' name='commit' value='(50)Dmg Boost'></p> 
      </form>
    </div>&nbsp;&nbsp;
  ";}
  
    if ($ACC[3] >= 40 and $SKL > 70){
 echo
  "
    <div class='tooltip'>
	      <form id='yourFormId'method='post' action='FCAL.php'>
		  		  <select hidden='' name='skl'>
		  <option value='6' selected>6/option>
		  </select>
          <input hidden='' type='text' name='skl' value='6' placeholder='lvl'>
       <p class='submit' onclick='myfunc(this)'><input img $c7 src='IMG/pack/Icons8_40.png' style='width:45px;height:45px;' type='image' name='commit' value='(50)Dmg Boost'><span class='tooltiptext'>70En.<br>Increase cryt dmg $t7.</span></p> 
      </form>
    </div>
  </section>";}
  else{
	   echo
	    "
    <div class='tooltip'>
	      <form id='yourFormId' method='post' action='FCAL.php'>
          <input hidden='' type='text' name='skl' value='6' placeholder='lvl'>
        <p class='submit'><img class='blur' src='IMG/pack/Icons8_40.png' style='width:45px;height:45px;' type='image' name='commit' value='(50)Dmg Boost'></p> 
      </form>
    </div>
  </section>";}
?>