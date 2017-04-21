<?php

		echo
"<section class='container2'>";

$List = mysqli_query($db,"SELECT * FROM Equiped WHERE User = '$User' AND Part = 'ITM'");
while ($List1 = mysqli_fetch_array($List)){	

	$ITMs = mysqli_query($db,"SELECT * FROM DropsItm WHERE HASH = '$List1[2]'");
	$ITMn = mysqli_fetch_assoc($ITMs);
	
	
	if ($ITMn["EFT"] == "HEAL" or $ITMn["EFT"] == "LUCK" or $ITMn["EFT"] == "HURT" or $ITMn["EFT"] == "ENER" or $ITMn["EFT"] == "DEF" or $ITMn["EFT"] == "DMG"){
echo "
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='ItemPass.php'>
          <input type='hidden' name='ITM' value='$ITMn[HASH]'>
		  <input type='hidden' name='TYP' value='$ITMn[EFT]'>
		  <input type='hidden' name='VAL' value='$ITMn[Value]'>
        <p class='submit' onclick='myfunc(this)'><input  img src='IMG/pack/$ITMn[Icon].png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>$ITMn[Name] - $ITMn[Value]%</span></p> 
      </form>
    </div>&nbsp;&nbsp;";
	}

}

?>