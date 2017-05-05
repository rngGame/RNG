<?php


//life leach
if ($WEPn["effect"] == "LL"  or $SUB[6] == "LL"){
	if ($WEPn["effect"] == "LL"){
		$bleds = $WEPn["efstat"];}
	if ($SUB[6] == "LL"){
		$bleds = $SUB[7] + $bleds;}
	
	$leach = round($physDMG * $bleds / 200);
	$HPin = $HPin + $leach;
	$leach = "$leach Health restored<br>";
}

//blead
if ($WEPn["effect"] == "BL" or isset($_SESSION["bleed"]) or $SUB[6] == "BL"){
	if (($WEPn["efstat"] >= rand(0,100) and $WEPn["effect"] == "BL") or isset($_SESSION["bleed"]) or ($SUB[7] >= rand(0,100) and $SUB[6] == "BL")){
	$bl = rand(3,8);
	$blee = ($monHP * $bl / 100); 
	if ($blee > (300*$mLVL)){
		$blee = 300*$mLVL;}
	$blee = round($blee,0);
	$bleed = "Monster bleeds for <font color='#e60000'>$blee</font> dmg.<br>";
	$_SESSION["bleed"] = 1;
}
}

//burn
if ($WEPn["effect"] == "BR" or $SUB[6] == "BR"){
	if (($WEPn["efstat"] >= rand(0,100) and $WEPn["effect"] == "BR") or ($SUB[7] >= rand(0,100) and $SUB[6] == "BR")){
	$burn = round(($mLVL + $WEPn["ilvl"]) * 10);
	$brn = "Monster burned for $burn dmg.<br>";
}
}

//freeze
if ($WEPn["effect"] == "FR" or $SUB[6] == "FR"){
	if (($WEPn["efstat"] >= rand(0,100) and $WEPn["effect"] == "FR") or ($SUB[7] >= rand(0,100) and $SUB[6] == "FR")){
	$freez = rand(3,5);
	$frz = $_SESSION["freez"];
	if ($frz == 0){
		$frz = 1;}
	$freez = $freez * $frz;
	if ($freez > (2000*$mLVL)){
		$freez = (2000*$mLVL);}
	$_SESSION["freez"] = $freez;
	$fre = "Monster freezed for $freez dmg.<br>";
}
}

//Stun
if ($WEPn["effect"] == "ST" or $SUB[6] == "ST"){
	if (($WEPn["efstat"] >= rand(0,100) and $WEPn["effect"] == "ST") or ($SUB[7] >= rand(0,100) and $SUB[6] == "ST")){
		$stun = 1;	
}
}

//Shock
if ($WEPn["effect"] == "SH" or $SUB[6] == "SH"){
	if (($WEPn["efstat"] >= rand(0,100) and $WEPn["effect"] == "SH") or ($SUB[7] >= rand(0,100) and $SUB[6] == "SH")){
		$sht = 1;
	
	while( $sht <> 10){
		if (10 >= rand(0,100)){
		$shDplus = ($minMdmg * rand(7,30) /100) + ($minPdmg * rand(7,30) /100);
		if ($shDplus > (220*$mLVL)){
			$shDplus = (220*$mLVL);}
		$shD += round($shDplus);
		$shDT = $shDT + 1;
		}
		$sht = $sht + 1;
	}
	if ($shDT >= 1){
	$shTE = "Monster shocked <b>$shDT</b> time(s) for <font color='#8134ED'>$shD</font> dmg.<br>";
	}
}
}

//Block WEP
if ($WEPn["effect"] == "BK"){
	if (($WEPn["efstat"] >= rand(0,100) and $WEPn["effect"] == "BK") or ($SUB[7] >= rand(0,100) and $SUB[6] == "BK")){
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
if ($SUB[6] == "HT" or $WEPn["effect"] == "HT"){
	if ($SUB[6] == "HT"){
	$helsP = round(($HPin * $SUB[7]  / 100));}
	if ($WEPn["effect"] == "HT"){
	$helsP = round(($HPin * $WEPn["efstat"]  / 100));}
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
if ($SUB[6] == "WK" or $WEPn["effect"] == "WK"){
	if ($SUB[6] == "WK"){
	$weak = round($monDMG * $SUB[7] / 100);}
	if ($WEPn["effect"] == "WK"){
	$weak = round($monDMG * $WEPn["efstat"] / 100);}
	$monDMG = round($monDMG - $weak);
	$weakt= "Monsted damage decreased by $weak damage !<br>";

}

//Soul leach
if ($WEPn["effect"] == "SL"  or $SUB[6] == "SL"){
	if ($WEPn["effect"] == "SL"){
		$soull = $WEPn["efstat"];}
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
	$bdm = rand(1,50	);
	$bdam = round($physDMG * $bdm / 100);
	if ($bdam > (1000*$mLVL)){
		$bdam = (1000*$mLVL);
	}
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

//summon buff
if ($WEPn["effect"] == "SM" and $_SESSION["PET"] == 1){
	$_SESSION["PET"] = 2;
	
	$_SESSION["PETHP"] += round($_SESSION["PETHP"]  * $WEPn["efstat"] / 100);
	$_SESSION["PETMINDMG"] += round($_SESSION["PETMINDMG"]  * $WEPn["efstat"]  / 100);
	$_SESSION["PETMAXDMG"] += round($_SESSION["PETMAXDMG"]  * $WEPn["efstat"]  / 100);
}

//Confusion
if ($WEPn["effect"] == "CF"){
	if ($WEPn["efstat"] >= rand(0,100)){
		$Confusion = 1;	
		$CFdmg = $monDMG; 
}
}

//Damage and text

$effect = $blee + $burn + $freez + $shD + $refcl + $bdam;
$efftext = "$brn $bleed $leach $fre $shTE $hptex $double $refct $weakt $sleacht $bdamt $berst $doubart";

?>