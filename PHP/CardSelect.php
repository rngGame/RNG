<?php

$crdNR = 0;
$Cards ="<div class='CardFrame'>";

//card sellect
$CARD = mysqli_query($db,"SELECT * FROM PlayerCards where Player = '$User' ORDER BY RAND() LIMIT 2");
while ($CARDo = mysqli_fetch_array($CARD)){	  
	$crdNR += 1; 
	$Cards .= "<div class='1Card'><img class='Cards' src='/rng/IMG/Cards/$CARDo[1].png'>";
	$CardInfo= mysqli_query($db,"SELECT * FROM Cards where Code = '$CARDo[1]'");
	$CardInfoP = mysqli_fetch_row($CardInfo);
	$Cards .= "<div class='CardText'>$CardInfoP[1]</div></div>";
}

$Cards .="</div>";
?>	  