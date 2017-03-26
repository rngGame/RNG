<?php


//life leach
if ($WEP[13] == "LL"  or $SUB[6] == "LL"){
	if ($WEP[13] == "LL"){
		$bleds = $WEP[14];}
	if ($SUB[6] == "LL"){
		$bleds = $SUB[7] + $bleds;}
	
	$leach = round($physDMG * $bleds / 100);
	$HPin = $HPin + $leach;
	$leach = "$leach Health restored<br>";
}

//blead
if ($WEP[13] == "BL" or isset($_SESSION["bleed"]) or $SUB[6] == "BL"){
	if ($WEP[14] >= rand(0,100) or isset($_SESSION["bleed"]) or $SUB[7] >= rand(0,100)){
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
if ($WEP[13] == "BR" or $SUB[6] == "BR"){
	if ($WEP[14] >= rand(0,100) or $SUB[7] >= rand(0,100)){
	$burn = round($mLVL * 10);
	$brn = "Monster burned for $burn dmg.<br>";
}
}

//freeze
if ($WEP[13] == "FR" or $SUB[6] == "FR"){
	if ($WEP[14] >= rand(0,100) or $SUB[7] >= rand(0,100)){
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
if ($WEP[13] == "ST" or $SUB[6] == "ST"){
	if ($WEP[14] >= rand(0,100) or $SUB[7] >= rand(0,100)){
		$stun = 1;	
}
}

//Shock
if ($WEP[13] == "SH" or $SUB[6] == "SH"){
	if ($WEP[14] >= rand(0,100) or $SUB[7] >= rand(0,100)){
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
if ($WEP[13] == "BK" or $SUB[6] == "BK"){
	if ($WEP[14] >= rand(0,100) or $SUB[7] >= rand(0,100)){
		$Block = 1;	
}
}

//Dodge
if ($SUB[6] == "DG"){
	if ($SUB[7] >= rand(0,100)){
		$Dodge = 1;	
}
}

//health per turn
if ($SUB[6] == "HT" or $WEP[13] == "HT"){
	if ($SUB[6] == "HT"){
	$helsP = round(($HPin * $SUB[7]  / 100));}
	if ($WEP[13] == "HT"){
	$helsP = round(($HPin * $WEP[14]  / 100));}
	$HPin = $HPin + $helsP;
	$hptex= "$helsP Health restored<br>";
}

//Double Damage
if ($SUB[6] == "DD"){
if ($SUB[7] >= rand(0,100)){
	$ddam = 1;
	$double= "<font color='red'><b>You did double damage !</b></font><br>";
}
}

//Reflect
if ($SUB[6] == "RF"){
	$refcl = round($monDMG * $SUB[7] / 100);
	$refct= "You reflected $refcl damage !<br>";

}

//Weakness
if ($SUB[6] == "WK" or $WEP[13] == "WK"){
	if ($SUB[6] == "WK"){
	$weak = round($monDMG * $SUB[7] / 100);}
	if ($WEP[13] == "WK"){
	$weak = round($monDMG * $WEP[14] / 100);}
	$monDMG = round($monDMG - $weak);
	$weakt= "Monsted damage decreased by $weak damage !<br>";

}

//Soul leach
if ($WEP[13] == "SL"  or $SUB[6] == "SL"){
	if ($WEP[13] == "SL"){
		$soull = $WEP[14];}
	if ($SUB[6] == "SL"){
		$soull = $SUB[7] + $soull;}
	
	$sleach = round($magDMG * $soull / 2000);
	$ene = $ene + $sleach;
	$_SESSION["ENERGY"] = $ene;
	$sleacht = "$sleach Energy restored<br>";
}

//Bonus dmg
if ($SUB[6] == "BD"){
if ($SUB[7] >= rand(0,100)){
	$bdm = rand(1,200);
	$bdam = round($physDMG * $bdm / 100);
	$bdamt= "You did $bdam bonus damage.<br>";
}
}

//berserk rage
if ($SUB[6] == "RG"){
	$tresh = round($HPO * $SUB[7] /100);
	$currh = $HPin;
		if ($currh < $tresh){
			$physDMG = $physDMG*1.5;
			$magDMG = $magDMG*1.5;
			$berst = "<font color='red'><b>BERSERK !!!</b></font><br>";
		}
}

//double defence 
if ($SUB[6] == "CD"){
	$tresh = round($HPO * $SUB[7] /100);
	if ($SUB[7] >= rand(0,100)){
			$Armor = $Armor *2;
			$doubart = "<font color='gold'>Double Armor !</font><br>";
}

}

$effect = $blee + $burn + $freez + $shD + $refcl + $bdam;
$efftext = "$brn $bleed $leach $fre $shTE $hptex $double $refct $weakt $sleacht $bdamt $berst $doubart";
?>