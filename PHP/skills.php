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

//skill 32
if ($SKL ==32){

	$comb = round($magDMG + $physDMG);
		if ($SUB[5] = "SWRD" and $CRT <= $CRYT+$WEP[7]){
			$comb=$comb + ($comb*$CRYTD/100);
			$combtex="<b><font color='red'>Combined damage did crytical strike</font></b><br>";
		}
		$ene = $ene - 50;
	$_SESSION["ENERGY"] = $ene;
};

//skill 33
if ($SKL ==33){
	$IC = 1;
	$xtim = 0;
	$stic = 100;
	if ($SUB[5] = "PRG"){
		$stic = 150;
	}
	while ($IC <> 100){
		if (rand(0,$stic)> 50){
			$fmagDMG = (rand($minMdmg,$maxMdmg) * 0.15) + $fmagDMG;
			$xtim = $xtim + 1;
		}
		$IC = $IC + 1;
	}
		$ene = $ene - 330;
	$_SESSION["ENERGY"] = $ene;

	$finallICE = (($fmagDMG ));
	$finallICT = "<font color='lightblue'>Hit by $xtim ICE commets!</font><br>";
};

//skill 34
	if ($SKL ==34 or $_SESSION["PET"] == 1){
		if (!$_SESSION["PET"] == 1){ //sukuria nauja
			$petname = mysqli_query($db,"SELECT * FROM Pets where Class = '$ACC[10]' Order by RAND() Limit 	1");
			$petname = mysqli_fetch_row($petname);
			$_SESSION["PETNAME"] = $petname[0];
			$_SESSION["PETHP"] = $HPO * 20 / 100;
			$_SESSION["PETMINDMG"] = round($minMdmg * 15 / 100);
			$_SESSION["PETMAXDMG"] = round($maxMdmg * 20 / 100);
			$ene = $ene - 150;
			$_SESSION["ENERGY"] = $ene;
				if ($SUB[5] == "NECR"){ //if necromance
				$_SESSION["PETHP"] = $HPO * 60 / 100;
				$_SESSION["PETMINDMG"] = round($minMdmg * 60 / 100);
				$_SESSION["PETMAXDMG"] = round($maxMdmg * 120 / 100);
				}
				if ($SUB[5] == "TITA"){ //if Titan
				$_SESSION["PETHP"] = $HPO * 120 / 100;
				$_SESSION["PETMINDMG"] = round($minMdmg * 10 / 100);
				$_SESSION["PETMAXDMG"] = round($maxMdmg * 40 / 100);
				}
				if ($SUB[5] == "SPELC"){ //if Spelcaster
				$_SESSION["PETHP"] = $HPO * 30 / 100;
				$_SESSION["PETMINDMG"] = round($minMdmg * 90 / 100);
				$_SESSION["PETMAXDMG"] = round($maxMdmg * 150 / 100);
				}
			$pettext = "Pet summoned !<br>";
			$_SESSION["PET"] = 1;
		}
			//PET DMG CALC
			$petDMG = rand($_SESSION["PETMINDMG"], $_SESSION["PETMAXDMG"]);
			$pettdmgtext = "Pet did $petDMG dmg.<br>";
			$monHP = $monHP - $petDMG;
			$pettook = round($monDMG * 10 / 100);
				if ($SUB[5] == "NECR"){ //if necromance
				$pettook = round($monDMG * 35 / 100);
				}
				if ($SUB[5] == "TITA"){ //if Titan
				$pettook = round($monDMG * 50 / 100);
				}
				if ($SUB[5] == "SPELC"){ //if Titan
				$pettook = round($monDMG * 80 / 100);
				}
			$monDMG = $monDMG - $pettook; //reduct damage of mob
			$_SESSION["PETHP"] = $_SESSION["PETHP"] - $pettook;
			$petttanktext = "Pet tanked $pettook dmg.<br>";
			$petHP = $_SESSION["PETHP"];
			if ($petHP <= 0){
				unset($_SESSION["PET"]);
				unset($_SESSION["PETHP"]);
				unset($_SESSION["PETMINDMG"]);
				unset($_SESSION["PETMAXDMG"]);
				$pettext = "<b>Pet Died !</b><br>";
			}
		
		
}

$magick = $fball + $comb + $finallICE;
$magickText = "$finallICT $combtex $petsumtext $pettext $pettdmgtext $petttanktext"  ;
?>