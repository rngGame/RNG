<?php

//life leach
if ($WEP[13] == "LL"){
	$leach = round($physDMG * $WEP[14] / 100);
	$HPin = $HPin + $leach;
	$leach = "$leach Health restored<br>";
}

//blead
if ($WEP[13] == "BL" or isset($_SESSION["bleed"])){
	if ($WEP[14] >= rand(0,100) or isset($_SESSION["bleed"])){
	$bl = rand(5,10);
	$blee = ($monHP * $bl / 100); 
	if ($blee > 2000){
		$blee = 2000;}
	$blee = round($blee,0);
	$bleed = "Monster bleeds for $blee dmg.<br>";
	$_SESSION["bleed"] = 1;
}
}

//burn
if ($WEP[13] == "BR"){
	if ($WEP[14] >= rand(0,100)){
	$burn = round($mLVL * 10);
	$brn = "Monster burned for $burn dmg.<br>";
}
}

//freeze
if ($WEP[13] == "FR"){
	if ($WEP[14] >= rand(0,100)){
	$freez = rand(3,5);
	$frz = $_SESSION["freez"];
	if ($frz == 0){
		$frz = 1;}
	$freez = $freez * $frz;
	$_SESSION["freez"] = $freez;
	$fre = "Monster freezed for $freez dmg.<br>";
}
}

//Stun
if ($WEP[13] == "ST"){
	if ($WEP[14] >= rand(0,100)){
		$stun = 1;	
}
}

//Shock
if ($WEP[13] == "SH"){
	if ($WEP[14] >= rand(0,100)){
		$sht = 1;
	while( $sht <> 10){
		if (10 >= rand(0,100)){
		$shD = round($shD + ($minMdmg * 10 /100));
		$shDT = $shDT + 1;
		}
		$sht = $sht + 1;
	}
	if ($shDT >= 1){
	$shTE = "Monster shocked $shDT time(s) fot a tottal $shD dmg.<br>";
	}
}
}

//Block
if ($WEP[13] == "BK"){
	if ($WEP[14] >= rand(0,100)){
		$Block = 1;	
}
}

$effect = $blee + $burn + $freez + $shD;
$efftext = "$brn $bleed $leach $fre $shTE";
?>