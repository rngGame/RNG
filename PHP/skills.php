<?php
//skill 1
if ($SKL ==1){
	$sk1v = 1.25;
	if ($CLS[6] == "PALA"){
		$sk1v = 1.50;}
	if ($SUB[5] == "GLAD"){
		$sk1v = rand(1.75,2.25);}
	$physDMG = $physDMG * $sk1v;
	$ene = $ene - 30;
	$_SESSION["ENERGY"] = $ene;
};

//skill 2
$hpT = "";
if ($SKL == 2){
	$perc = 10;
	if ($CLS[6] == "HEAL"){
	$perc = 15;}
	if ($SUB[5] == "HEAL"){
	$perc = 20;}
	$HPi = $HPin;
	$HPin = $HPin + ($HPO*$perc/100);
	$HPi = $HPin - $HPi;
	$HPi = round($HPi,0);
	$hpT = "Increased helth by <font color='#e6e600'>$HPi</font><br>";
	$ene = $ene - 40;
	$_SESSION["ENERGY"] = $ene;
	$healdmg = $magDMG;
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
	
if ($SUB[5] == "SLASH"){
	$r6 = rand(1,80);
	$r7 = rand(1,82);
	$r8 = rand(1,85);}
	
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
		
	if ($SUB[5] == "SLASH"){
	if ( $r6 < 75){
		$skr = $skr + 1;
		$physDMG = $physDMG + $physDMGc;}
	if ( $r7 < 75){
		$skr = $skr + 1;
		$physDMG = $physDMG + $physDMGc;}
	if ( $r8 < 75){
		$skr = $skr + 1;
		$physDMG = $physDMG + $physDMGc;}
	}
		
		
		
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
	if ($SUB[5] == "REFL"){
		$mref = rand(90,150);}
		
		
	$calcref = $mref;
 	$monsRef = ($monDMG * $calcref / 100) + $Armor;
	$dmgmitig = $calcref;
	if ($CLS[6] == "TANK"){
	$monsRef = ($monDMG * $calcref / 100) + ($Armor*1.2);
	$dmgmitig = $calcref;}
	if ($SUB[5] == "REFL"){
	$monsRef = ($monDMG * $calcref / 100) + ($Armor*1.5);
	$dmgmitig = $calcref;}
	
	$monDMG = round($monDMG - $dmgmitig);
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
	if ($SUB[5] == "CRYTE"){
	$CRYTD = $CRYTD + 80;}
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

	$comb = round(($magDMG*1.7) + ($physDMG*0.3));
	
		if ($SUB[5] == "SWRD" and $CRT <= $CRYT+$WEPn["Cryt"]){
			$comb = round(($magDMG*2.2) + ($physDMG*1.2));
			$comb +=($comb*$CRYTD/100);
			$combtex="<b><font color='red'>Combined damage did crytical strike</font></b><br>";
		}
		
		//if dmgg exceds 30k
		if ($comb > 30000){
			$comb = $comb * rand(1,10) /100;
			$combtex="<b>POWER WAS SO GREAT TO HANDLE !</font></b><br>";
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
			$fmagDMG = (rand($minMdmg,$maxMdmg) * 0.10) + $fmagDMG;
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
	if ($SKL ==34 or isset($_SESSION["PET"])){
		if (!isset($_SESSION["PET"])){ //sukuria nauja
			$petname = mysqli_query($db,"SELECT * FROM Pets where Class = '$ACC[10]' Order by RAND() Limit 	1");
			$petname = mysqli_fetch_row($petname);
			$_SESSION["PETNAME"] = $petname[0];
			$_SESSION["PETHP"] = $HPO * 20 / 100;
			$_SESSION["PETMINDMG"] = round((($minMdmg * 15 / 100)*0.7)+(($minPdmg * 20 / 100)*0.3));
			$_SESSION["PETMAXDMG"] = round((($maxMdmg * 20 / 100)*0.7)+(($maxPdmg * 25 / 100)*0.3));
			$ene = $ene - 100;
			$_SESSION["ENERGY"] = $ene;
				if ($SUB[5] == "NECR"){ //if necromance
				$_SESSION["PETHP"] = $HPO * 60 / 100;
				$_SESSION["PETMINDMG"] = round($minMdmg * 60 / 100);
				$_SESSION["PETMAXDMG"] = round($maxMdmg * 120 / 100);
				}
				if ($SUB[5] == "TITA"){ //if Titan
				$_SESSION["PETHP"] = $HPO * 220 / 100;
				$_SESSION["PETMINDMG"] = round($minMdmg * 10 / 100);
				$_SESSION["PETMAXDMG"] = round($maxMdmg * 40 / 100);
				}
				if ($SUB[5] == "SPELC"){ //if Spelcaster
				$_SESSION["PETHP"] = $HPO * 130 / 100;
				$_SESSION["PETMINDMG"] = round($minMdmg * 90 / 100);
				$_SESSION["PETMAXDMG"] = round($maxMdmg * 150 / 100);
				}
				if ($SUB[5] == "SMASH"){ //if smasher
				$_SESSION["PETHP"] = $HPO * 150 / 100;
				$_SESSION["PETMINDMG"] = round($minMdmg * 50 / 100);
				$_SESSION["PETMAXDMG"] = round($maxMdmg * 50 / 100);
				}
			$pettext = "Pet summoned !<br>";
			$_SESSION["PET"] = 1;
			$extra = $magDMG;
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
				if ($SUB[5] == "SPELC"){ //if Spelcaster
				$pettook = round($monDMG * 80 / 100);
				}
				if ($SUB[5] == "SMASH"){ //if Smasher
				$pettook = round($monDMG * 25 / 100);
				}
			$monDMG = $monDMG - $pettook; //reduct damage of mob
			$_SESSION["PETHP"] = $_SESSION["PETHP"] - $pettook;
			$petttanktext = "Pet tanked $pettook dmg.<br>";
			$petHP = $_SESSION["PETHP"];
			
			//pet skill 1
			if (rand(0,100) < 20 and $petskl <> 1){
				$petskl = 1;
				$petExtraDMG = round($petDMG + ($petDMG * rand(140,220) / 100));
				$petSkillText = "Pet Used <b>COOL SKILL</b> and delt extra $petExtraDMG dmg.<br>";
			}
			if (rand(0,100) < 15 and $petskl <> 1){
				$petskl = 1;
				$petheal = round($HPO * rand(3,8) / 100);
				$HPin = round($HPin + $petheal);
				$petSkillText = "Pet <b> Healed you </b>for $petheal health<br>";
			}
			if (rand(0,100) < 10 and $petskl <> 1){
				$petskl = 1;
				$ene = $_SESSION["ENERGY"];
				$ene = $ene + $plvl;
				$_SESSION["ENERGY"] = $ene;
				$petSkillText = "Pet <b> Restored you energie </b> by $plvl points<br>";
			}
			//if necromancer resumon pet
			if ($petHP <= 0 and $SUB[5] == "NECR" and $petskl <> 1){
				if (rand(0,100) < 85){
				$_SESSION["PETHP"] = round($HPO * 60 / 100);
				$petHP = $_SESSION["PETHP"];
				$_SESSION["PETMINDMG"] = round($minMdmg * 60 / 100);
				$_SESSION["PETMAXDMG"] = round($maxMdmg * 120 / 100);					
				$petSkillText = "<b>Pet resumoned after death</b><br>";		
				}
			}
			
			
			//when pet died
			if ($petHP <= 0){
				unset($_SESSION["PET"]);
				unset($_SESSION["PETHP"]);
				unset($_SESSION["PETMINDMG"]);
				unset($_SESSION["PETMAXDMG"]);
				$pettext = "<b>Pet Died !</b><br>";
			}
	}
			
//skill 35
if ($SKL == 35){
	$_SESSION["SKILL35"] = 1;
	$bonusspower = $Armor + $ArmorM;
	if ($SUB[5] == "BRSK"){
	$bonusspower =( $Armor + $ArmorM )* 2.5;
	}
	$_SESSION["ARM"] = 0;
	$_SESSION["MARM"] = 0;
	$minPdmg = $minPdmg + $bonusspower;
	$maxPdmg = $maxPdmg + $bonusspower;
	$minMdmg = $minMdmg + $bonusspower;
	$maxMdmg = $maxMdmg + $bonusspower;

	$_SESSION["DMGPmin"] = $minPdmg;
	$_SESSION["DMGPmax"] = $maxPdmg;
	$_SESSION["DMGMmin"] = $minMdmg;
	$_SESSION["DMGMmax"] = $maxMdmg;
	
	$Armortext = "<b>Armor breake !</b><br>";
	
	$ene = $ene - 100;
	$_SESSION["ENERGY"] = $ene;
	$extra = $magDMG;

}
		
//skill 36
if ($SKL == 36){	
	$dmgsacr= 5000;
	$sacrifrand = rand(150,200);
	if ($SUB[5] == "CHAM"){
		$sacrifrand = rand(200,250);
		$dmgsacr= 3000;}
	if ($SUB[5] == "HERO"){
		$sacrifrand = rand(180,220);
		$dmgsacr= 10000;}
	$HPin = $HPin - $dmgsacr;
	$finalsacriface = round(($physDMG + $magDMG + $dmgsacr) * $sacrifrand / 100);
	$finaltext = "<b>You sacrificed $dmgsacr and delt $finalsacriface damage !</b><br>";
}


$magick = round($fball + $comb + $finallICE + $finalsacriface + $healdmg + $petExtraDMG + $extra);
$magickText = "$finallICT $combtex $petsumtext $pettext $pettdmgtext $petttanktext $Armortext $finaltext $petSkillText"  ;
?>