<?php
//skill 1
if ($SKL ==1){
	if ($CLS[6] == "PALA"){
	$physDMG = $physDMG * 1.50;}
	else{
	$physDMG = $physDMG * 1.25;}
	$ene = $ene - 30;
	$_SESSION["ENERGY"] = $ene;
};

//skill 2
$hpT = "";
if ($SKL ==2){
	$perc = 10;
	if ($CLS[6] == "HEAL"){
	$perc = 8;}
	$HPi = $HPin;
	$HPin = $HPin + ($HPO/$perc);
	$HPi = $HPin - $HPi;
	$HPi = round($HPi,0);
	$hpT = "Increased helth by <font color='#e6e600'>$HPi</font><br>";
	$ene = $ene - 40;
	$_SESSION["ENERGY"] = $ene;
};

//skill 3
if ($SKL ==3){
	$s = rand(5,20);
	if ($CLS[6] == "DMGB"){
		$s = rand(10,25);}
	$minPdmg = $minPdmg +($minPdmg * $s/100);
	$maxPdmg = $maxPdmg +($maxPdmg * $s/100);
	$minPdmg = round($minPdmg);
	$maxPdmg = round($maxPdmg);
	$ene = $ene - 50;
	$_SESSION["ENERGY"] = $ene;
	$_SESSION["DMGPmin"] = $minPdmg;
	$_SESSION["DMGPmax"] = $maxPdmg;
	$physDMG = rand($minPdmg,$maxPdmg);
};

//skill 4
if ($SKL ==4){
	$r1 = rand(1,100);
	$r2 = rand(1,100);
	$r3 = rand(1,100);
	$r4 = rand(1,100);
	$r5 = rand(1,100);

	$ene = $ene - 60;
	$_SESSION["ENERGY"] = $ene;

	$physDMGc = round($physDMG*60/100);
	$physDMG = 0;
	
if ($CLS[6] == "COMB"){
	$r1 = rand(1,75);
	$r2 = rand(1,80);
	$r3 = rand(1,85);
	$r4 = rand(1,90);
	$r5 = rand(1,95);}
	
	if ( $r1 < 75){
		$skr =  1;
		$physDMG = $physDMGc;}
	if ( $r2 < 75){
		$skr = $skr + 1;
		$physDMG = $physDMG + $physDMGc;}
	if ( $r3 < 75){
		$skr = $skr + 1;
		$physDMG = $physDMG + $physDMGc;}
	if ( $r4 < 75){
		$skr = $skr + 1;
		$physDMG = $physDMG + $physDMGc;}
	if ( $r5 < 75){
		$skr = $skr + 1;
		$physDMG = $physDMG + $physDMGc;}
		
		
	$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$User' and Name = 'COM'");
	$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$User', 'COM', '$skr')";
	$result = mysqli_query($db, $order);}
		else{
			$CCount = $ACH[2] + $skr;
			$order = "UPDATE aStatus
			SET Status = '$CCount'
			WHERE `User` = '$User' and `Name` = 'COM'";
			$result = mysqli_query($db, $order);
		}
}

//skill 5
if ($SKL ==5){
	$mref = rand(30,60);
	
	if ($CLS[6] == "TANK"){
		$mref = rand(50,80);}
		
 	$monsRef = ($monDMG * $mref / 100) + $Armor;
	$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$User' and Name = 'REF'");
	$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$User', 'REF', '$monsRef')";
	$result = mysqli_query($db, $order);}
		else{
			$CCount = $ACH[2] + $monsRef;
			$order = "UPDATE aStatus
			SET Status = '$CCount'
			WHERE `User` = '$User' and `Name` = 'REF'";
			$result = mysqli_query($db, $order);
		}
	$ene = $ene - 30;
	$_SESSION["ENERGY"] = $ene;
};

//skill 6 
if ($SKL ==6){
	$CRYT = $CRYT * 2;
	$CRYTD = $CRYTD + 100;
	if ($CLS[6] == "ASSA"){
	$CRYT = $CRYT * 1.2;
	$CRYTD = $CRYTD + 20;}
	$ene = $ene - 70;
	$_SESSION["ENERGY"] = $ene;
	}

//MAGICK//

//skill 31
if ($SKL ==31){
	$fB = 60;
		if ($CLS[6] == "FIRE"){
		$fB = 120;}
	$fball = round($magDMG + ($magDMG *  $fB /100));
		$ene = $ene - 30;
	$_SESSION["ENERGY"] = $ene;
};

//skill 31
if ($SKL ==32){
	$comb = round($magDMG + $physDMG);
		$ene = $ene - 50;
	$_SESSION["ENERGY"] = $ene;
};

//skill 33
if ($SKL ==33){
	$IC = 1;
	$xtim = 0;
	while ($IC <> 100){
		if (rand(0,100)> 50){
			$xtim = $xtim + 1;
		}
		$IC = $IC + 1;
	}
		$ene = $ene - 330;
	$_SESSION["ENERGY"] = $ene;
	$finallICE = $xtim * ($magDMG - ($magDMG * 85 /100));
	$finallICT = "<font color='lightblue'>Hit by $xtim ICE commets!</font><br>";
};

$magick = $fball + $comb + $finallICE;
$magickText = $finallICT;
?>