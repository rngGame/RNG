<?php

$crdNR = 0;
$Cards ="<div class='CardFrame'>";

//card sellect
$CARD = mysqli_query($db,"SELECT * FROM PlayerCards where Player = '$User' ORDER BY RAND() LIMIT 4");
while ($CARDo = mysqli_fetch_array($CARD)){	  
	$crdNR += 1; 
	$CardInfo= mysqli_query($db,"SELECT * FROM Cards where Code = '$CARDo[1]'");
	$CardInfoP = mysqli_fetch_row($CardInfo);
	
	$Cards .="<form class='cardalign' id='yourFormId' method='post' action='FCAL.php'>
          <input type='hidden' name='skl' value='$CardInfoP[2]'>
		  <div class='submit' onclick='myfunc(this)'>";
	
	$Cards .= "<div class='1Card'><img class='Cards' src='/rng/IMG/Cards/$CARDo[1].png'><input  img src='/rng/IMG/Cards/PRESS.png' class='CardsTOP' type='image'>";
	$ST1 = $CardInfoP[4];
	$ST2 = $CardInfoP[5];
	$CardInfoP[3] = str_replace('$ST1',$ST1,$CardInfoP[3]);
	$CardInfoP[3] = str_replace('$ST2',$ST2,$CardInfoP[3]);
	$Cards .= "<div class='CardText1'>$CardInfoP[1]</div>";
	$Cards .= "<div class='CardText2'>$CardInfoP[3]</div>";	
	$Cards .="</div>";
	
	$Cards .="</div></form>";
}

$Cards .="</div>";
?>	  