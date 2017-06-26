<?php
session_start();
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>World of RNG</title>
<link rel="stylesheet" type="text/css" href="CSS/meniu.css">
</head>
<body>
<header>
</header>
<?php

include_once 'PHP/db.php';
$User = $_SESSION["User"];
$Account = $_SESSION["Account"];
$mName = $_SESSION["MonsName"];

//page name
$page = $_SESSION["PAGE"];
$page2 = $_SESSION["PAGE2"];
$lose = $_SESSION["LOSE"];

//player dmg
$minPdmg = $_SESSION["DMGPmin"];
$maxPdmg = $_SESSION["DMGPmax"];
$minMdmg = $_SESSION["DMGMmin"];
$maxMdmg = $_SESSION["DMGMmax"];

//set player dmg for turn
$physDMG = rand($minPdmg,$maxPdmg);
$magDMG = rand($minMdmg,$maxMdmg);

//set monster dmg for turn
$monDMG = $_SESSION["MonsDMG"]; 
$monDMGmagick = $_SESSION["MonsDMGm"]; 


$minMondmg = $monDMG - ($monDMG * 20 / 100);
$maxMondmg = $monDMG + ($monDMG * 20 / 100);

$minMagMondmg = $monDMGmagick - ($monDMGmagick * 20 / 100);
$maxMAgMondmg = $monDMGmagick + ($monDMGmagick * 20 / 100);

$monDMG = rand($minMondmg,$maxMondmg); //monster p dmg
$monDMGmag = rand($minMagMondmg,$maxMAgMondmg); //monter m dmg

$monHP = $_SESSION["MonsHP"]; //monster hp
$mLVL = $_SESSION["MonsLVL"]; //monster lvl
$mTYP = $_SESSION["MonsTYP"]; //monster type

$HPin = $_SESSION["HP"]; //player hp
$plvl = $_SESSION["plvl"]; //player lvl
$Armor = $_SESSION["ARM"]; //player armor
$ArmorM = $_SESSION["MARM"]; //magick player armor
$ene = $_SESSION["ENERGY"]; //player energy
$SKLm = $_SESSION["ENERGYM"]; //current player energy
$CRYT = $_SESSION["CRYT"]; // cryt  chanse
$CRYTD = $_SESSION["CRYTD"]; //cryt dmg
$APS = $_SESSION["APS"]; //apsorb
$ENG2 = $_SESSION["ENG2"]; //energy regen bonus
$HPO = $_SESSION["HPO"]; //base hp of player
$ESS = $_SESSION["ESshield"]; //ES shield
$ESR = $_SESSION["ESregen"]; // ES regen

$SKL = $_POST["skl"]; //skill ID

$wepHASH = $_SESSION["CURRENTWHASH"]; //get weapon hash
	
$finalPlayerDMG = 0;

//thorns
if (isset($_SESSION["Thorns"])){
	$Thorns = $_SESSION["Thorns"];
	$Thorns +=  $Thorns * ($Armor + $ArmorM + ($mLVL*15) + ($plvl*20)) /1000; //thorns scales with armor+lvl+monter lvl
	$Thorns = round(rand($Thorns*0.9,$Thorns*1.1));
	$ThorText = "Monster took <font color='#99cc00'>$Thorns </font>of Thorns dmg.<br>";
	//achievment
	$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$Account' and Name = 'THOR'");
	$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$Account', 'THOR', '1')";
	$result = mysqli_query($db, $order);}
		else{
			$CCount = $ACH[2] + $Thorns;
			$order = "UPDATE aStatus
			SET Status = '$CCount'
			WHERE `User` = '$Account' and `Name` = 'THOR'";
			$result = mysqli_query($db, $order);
		}
}

	
//DB
$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
$WEP = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$wepHASH' ");
$WEPn = mysqli_fetch_assoc($WEP);
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$ACC[10]' ");
$CLS = mysqli_fetch_row($CLS);
$GEM = mysqli_query($db,"SELECT * FROM Gems where HASH = '$ACC[14]' ");
$GEM = mysqli_fetch_row($GEM);

if ($ACC[10] > 10){
	$SUB = mysqli_query($db,"SELECT * FROM Subclass where ID = '$ACC[10]' ");
	$SUB = mysqli_fetch_row($SUB);
};


//overkill wepaon skill
if (isset($_SESSION["OVER"])){
	if (isset($_SESSION["OVERdmg"])){
		$overkillDamage = $_SESSION["OVERdmg"];
		$overkillText = "You did <font color='#F820D5'>$overkillDamage</font> overkill dmg.<br>";
		unset($_SESSION["OVERdmg"]);
	}
}

//GEM dmg (mag)
if ($GEM[1] <> ""){
	$gemDMG = ($magDMG * $GEM[5]/200) + ($physDMG * $GEM[5]/200);
	$gemDMG  = round($gemDMG,0);
	$tST = "$User did $xt <font color='#$GEM[3]'>$gemDMG $GEM[2] dmg.</font><br>";}
	
//GEM OTHER STUFF

if ($GEM[1] <> ""){
	$gemDMG = round($gemDMG);
	$tST = "$User did $xt <font color='#$GEM[3]'>$gemDMG $GEM[2] dmg.</font><br>";}


	


//add some bonus dmg to cryt skill
if ($SKL == 4){
	$physDMG += $physDMG * rand(10,30) / 100;
}

//skill 6 
if ($SKL == 6){
	$CRYT = $CRYT * 2;
	$CRYTD = $CRYTD + 100;
	if ($CLS[6] == "ASSA"){
	$CRYT = $CRYT * 1.2;
	$CRYTD = $CRYTD + 20;}
	if ($SUB[5] == "CRYTE"){
	$CRYTD = $CRYTD + 80;}
	
	if ($_SESSION["FRAGID"] == 6){
		$CRYTD +=  round($CRYTD * $_SESSION["FRAGPOWER"]);
		$CRYT +=  round($CRYT * $_SESSION["FRAGPOWER"]);
	}	
	
	$ene = $ene - 70;
	$_SESSION["ENERGY"] = $ene;
	}


//cryt calc
if (rand(1,100) <= $CRYT and $SKL < 20 and $SKL <> 2){
	$citP = 1;
	
	$CRYTD = round($physDMG*$CRYTD/100);
	$physDMG = ($physDMG*2)+$CRYTD;

	
	if ($SKL == 4){ //cryt if combo
	$CRYTD = round($physDMG*$CRYTD/100);
	$physDMGc = ($physDMGc*2)+$CRYTD;
}
	
	$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$Account' and Name = 'CRYT'");
	$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$Account', 'CRYT', '1')";
	$result = mysqli_query($db, $order);}
		else{
			$CCount = $ACH[2] + 1;
			$order = "UPDATE aStatus
			SET Status = '$CCount'
			WHERE `User` = '$Account' and `Name` = 'CRYT'";
			$result = mysqli_query($db, $order);
		}
}

//Cusrsed Soul
if ($WEPn["effect"] == "CS"){
	$pbon = round($physDMG * $WEPn["efstat"] /100);
	$mbon = round($magDMG * $WEPn["efstat"] /100);
	$hpdmg = round($HPO * ($WEPn["efstat"] / 10) /100);
	$physDMG += $pbon;
	$magDMG += $mbon;
	$HPin -= $hpdmg;
	$CursedText= "Dmg increased by <font color='red'>$pbon</font>/<font color='#0066ff'>$mbon</font><br>But cursed soul consumed <b><font color='darkred'>$hpdmg</font></b> your health<br>";
}


//skills
if ($SKL <> "" or $_SESSION["PET"] == 1){
		include 'PHP/skills.php';
}

//Effects
if ($WEPn["efstat"] <> 0 or $SUB[7] <> 0){
		include 'PHP/effect.php';
}
	
//healing from armor
if ($_SESSION["HealthTurn"] >= 1){
	$HPin += $_SESSION["HealthTurn"];
	$hresr = $_SESSION["HealthTurn"];
	$restoreFromArmor = "<b>Restored <font color='#ffcc00'>$hresr </font>health.</b><br>";
}


//monster cryt	
if (rand(1,100) < 10){
	$citM = 1;
$monDMG = $monDMG*2;}

//monster dmg to playerr
$monDMG = ($monDMG - $Armor);
$monDMGmag = ($monDMGmag - $ArmorM);
if ($monDMG < 0){
	$monDMG = 1;}
if ($monDMGmag < 0){
	$monDMGmag = 1;}
	
	
	
//apsorb
$apsv = ($monDMG*$APS/100);
$apsv = round($apsv,0);
$monDMG = $monDMG - $apsv;
$monDMGmag = $monDMGmag;
	
	$apsAround = ($apsv)/2;
	$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$Account' and Name = 'APS'");
	$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$Account', 'APS', '$apsAround')";
	$result = mysqli_query($db, $order);}
		else{
			$CCount = $ACH[2] + $apsAround;
			$order = "UPDATE aStatus
			SET Status = '$CCount'
			WHERE `User` = '$Account' and `Name` = 'APS'";
			$result = mysqli_query($db, $order);
		}
		


//skill 7 - posion
if (!isset($_SESSION["pois"])){
}
else{
	$pos = 1;
}
if ($SKL ==7 or $pos == 1){
	$cantmiss = 1;
	$pois = rand(1,5);
	
	if ($CLS[6] == "POIS"){
	$pois = rand(3,8);}
	
	if ($SUB[5] == "POIS"){
	$pois = rand(8,15);}
	
	$poison = ($monHP*$pois/100); 
	
	if ($SUB[5] == "POIS"){
		if ($poison > (400*$mLVL)){
			$poison = (400*$mLVL);
		}
	}
	else if ($poison > (100*$mLVL)){
			$poison = (100*$mLVL);
	}
	
	if ($WEPn["effect"] == "PS"){ //is stat buffs poision
		$poison += ($poison * $WEPn["efstat"] / 100);} 
		
	//if poison dmg <0
	if ($poison <= 0){
		$poison = 0;}
		
	if ($_SESSION["FRAGID"] == 7){
		$poison +=  round($poison * $_SESSION["FRAGPOWER"]);
	}	
		
	$poison = round($poison,0);
	$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$Account' and Name = 'POS'");
	$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$Account', 'POS', '$poison')";
	$result = mysqli_query($db, $order);}
		else{
			$CCount = $ACH[2] + $poison;
			$order = "UPDATE aStatus
			SET Status = '$CCount'
			WHERE `User` = '$Account' and `Name` = 'POS'";
			$result = mysqli_query($db, $order);
		}
	$_SESSION["pois"] = 1;
	$poisT = "$User did <font color='#008000'>$poison Poison dmg.</font><br>";
	
	if ($SKL ==7){
	$ene = $ene - 35;
	$_SESSION["ENERGY"] = $ene;}
}




$finalMonsHP = $monHP;

//if have armor
if (isset($_SESSION["MonsDEF"])){
	$MonDEF = $_SESSION["MonsDEF"];
}

//if explode
if (isset($_SESSION["BOOM"])){
	if ($_SESSION["BOOM"] >= rand(1,100)){
		$explode += $monHP * 0.05;
		$explode += ($physDMG + $magDMG) / 3;
			if ($explode > (500*$mLVL)){
			$explode = (500*$mLVL);
		}
		$seldEXP = round($explode/$mLVL);
		$HPin -= $seldEXP;
		if ($HPin <= ($plvl*10)){
			$HPin = ($plvl*10);}
		$explode = round($explode);
		$exptext = "Weapon <b>exploded</b> for <font color='#996600'>$explode</font> dmg.<br>Explode did <font color='red'>$seldEXP</font> dmg. to player<br>";
	}
	
}


//calculation dmg to mons
if ($SKL == 11 or $SKL == 7 or $SKL ==1 or $SKL ==3 or $SKL ==4 or $SKL ==5 or $SKL ==6 or isset($_SESSION["ATTACK"]) ){ //check for physical dmg
unset($_SESSION["ATTACK"]); 
if (rand(0,100) <= $WEPn["HitChanse"] ){
	
//PHY BONUS WEAPON
$phybonu = 1;
if(isset($_SESSION["PHY"])){
	$phybonu = 1.2;
}
	
$finalPlayerDMG = (($physDMG + $gemDMG + $monsRef + $effect)*$phybonu) - $MonDEF;
	if ($finalPlayerDMG < 1 ){
	$finalPlayerDMG = 1;}	
if ($ddam == 1){
	$finalPlayerDMG = $finalPlayerDMG * 2;}
	}
else{
	$miss = "Missed<br>";
	$mis = 1;
	$finalMonsHP = $monHP;
	$finalPlayerDMG = 0;
}}


 //magick
if ($SKL == 31 or $SKL == 32 or $SKL == 33 or $SKL == 36 or $SKL == 2 or $SKL ==34 or $SKL ==35){ //check for magick dmg
$finalPlayerDMG = ($magick + $effect + $gemDMG + $finalPlayerDMGandPET) - $MonDEF;
if ($finalPlayerDMG < 1 ){
	$finalPlayerDMG = 1;}	
if ($ddam == 1){
	$finalPlayerDMG = $finalPlayerDMG * 2;
	}
}

//poision + thorns + petdmg
$finalPlayerDMG = $finalPlayerDMG + $poison + $Thorns + $petDMG + $explode + $overkillDamage;

//Confusion
if ($Confusion == 1){
	$finalPlayerDMG = $finalPlayerDMG + $CFdmg;
}

//final dmg to monster
$finalMonsHP = $monHP - $finalPlayerDMG;

//combo calculation
if ($mis <> 1){
	if (!isset($_SESSION["Combo"])){
		
		$_SESSION["Combo"] = 1+($skr/10);
	}
	else{
		$com = $_SESSION["Combo"];
		$com += 0.2+($skr / 10);
		$_SESSION["Combo"] = $com;
		if ($com >= 10 ){
			//$_SESSION["Combo"] = 10;
			//achievment fox 10x combo
			$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$Account' and Name = '10x'");
			$ACH = mysqli_fetch_row($ACH);
			if ($ACH[1]==""){
				$order = "INSERT INTO aStatus (User, Name, Status)
				VALUES ('$Account', '10x', '1')";
				$result = mysqli_query($db, $order);}
		}
	}
}
else {
	if (isset($_SESSION["Combo"])){
		$comBR = $_SESSION["Combo"];
		if ($comBR > 1){
			unset($_SESSION["Combo"]);
		}
	}
}

//add combo dmg
if (!isset($_SESSION["Combo"])){
	$finalPlayerDMG += $finalPlayerDMG * ($_SESSION["Combo"] / 10);
}



//dmg to player----------------------------------

if ($stun <> 1 and $Block <> 1 and $Dodge <> 1 and $Confusion <> 1){

//monster skill

//health boost
if (rand(1,1000) >= 950){
	$finalMonsHPlaik = round($mLVL * $plvl);
	$finalMonsHP += $finalMonsHPlaik;
	$monsSkillHP = "Monster boosted its health by <font color='#E44C68'>$finalMonsHPlaik</font> hp. <br>";
}

//mons reflect
$monref = 0;
if (rand(1,1000) >= 950){
	$monref = round($finalPlayerDMG*0.05);
	if ($monref >= ($HPO/3)){
		$monref = round($HPO/3);}
	$finalMonsHP += $monref;
	$monsSkillREF = "Monster reflected back <font color='#A8181C'>$monref</font> dmg.<br>";
	
	
}



$sklc = 0;

//magick missile Fire
if (rand(1,1000) >= 800){
	$sklc = 1;
	$monDMGmag = round($monDMGmag * rand(120,190) /100);
	$monDMGmag = round($monDMGmag - ($monDMGmag *($_SESSION[RESF] / 100 )));
	$monDMG = 0; //not phyical
	$typeSKL = "<font color='red'>Fire</font>";
	if ($monDMGmag <= 0){
		$monDMGmag = 0;}
}
		
//magick missile Ligthinig
if (rand(1,1000) >= 800 and $sklc <> 1){
	$sklc = 1;
	$monDMGmag = round($monDMGmag * rand(120,190) /100);
	$monDMGmag = round($monDMGmag - ($monDMGmag *($_SESSION[RESL] / 100 )));
	$monDMG = 0; //not phyical
	$typeSKL = "<font color='Yellow'>Ligthining</font>";
	if ($monDMGmag <= 0){
		$monDMGmag = 0;}
}
		
//magick missile ICE
if (rand(1,1000) >= 800 and $sklc <> 1){
	$sklc = 1;
	$monDMGmag = round($monDMGmag * rand(120,190) /100);
	$monDMGmag = round($monDMGmag - ($monDMGmag *($_SESSION[RESI] / 100 )));
	$monDMG = 0; //not phyical
	$typeSKL = "<font color='lightblue'>Ice</font>";
	if ($monDMGmag <= 0){
		$monDMGmag = 0;}
}
		

//ES shield
if (isset($_SESSION["ESshield"])){
	
	if ($ESS >= 1){
		$ESStemp = $ESS;
		$ESS -= $monDMGmag;
		if ($ESS < 0){
			$ESStemp = $monDMGmag - ($ESS * -1);
			$shieldDMG ="Energie Shield absorbed: <font color='lightblue'>$ESStemp</font> dmg.<br>";
			$monDMGmag =$ESS * -1;}
		else{
			$ESdmg = $_SESSION["ESshield"] - $ESS;
			$shieldDMG ="Energie Shield absorbed: <font color='lightblue'>$ESdmg</font> dmg.<br>";
			$monDMGmag  = 0;}
	}
	
	

}

if ($sklc == 1){
	$mobmagskill="<b>Monster used $typeSKL Magick Missile for $monDMGmag</b>";}
	
// if no skill used by mob
if ($sklc == 0){
	$monDMGmag = 0; //if not magick
	
//ES shield
if (isset($_SESSION["ESshield"])){
	
	if ($ESS >= 1){
		$ESStemp = $ESS;
		$ESS -= $monDMG;
		if ($ESS < 0){
			$ESStemp = $monDMG - ($ESS * -1);
			$shieldDMG ="Energie Shield absorbed: <font color='lightblue'>$ESStemp</font> dmg.<br>";
			$monDMG =$ESS * -1;}
		else{
			$ESdmg = $_SESSION["ESshield"] - $ESS;
			$shieldDMG ="Energie Shield absorbed: <font color='lightblue'>$ESdmg</font> dmg.<br>";
			$monDMG  = 0;}
	}


}
	

}

$monDID = $monDMG + $monDMGmag + $monref;
$finalPlayerHP = $HPin - $monDID;
if (isset($mobmagskill)){} //if used skill, don't write basic stuff
else{
$BasicAtackByMob = "Monster did tottal of $monDID";
if ($citM == 1){
	$BasicAtackByMob = "Monster did tottal of <font color='red'><b> $monDID </font>cryt.</b>";}
}

$monSkillText="$monsSkillREF $monsSkillHP $mobmagskill $BasicAtackByMob" ;

}



//if monster couldn't atack
else{
	$finalPlayerHP = $HPin ;
}

//ES STUFF
if (isset($_SESSION["ESshield"])){
	if ($ESS <= 0){
		$ESS = 0;}
	$ESS += round($ESR); 
	if (isset($_SESSION["ESSteal"])){
		$EST = round($_SESSION["ESSteal"]);
		$ESS += $EST;
		$shieldREC = "Recovered extra <font color='lightblue'>$EST</font> ES<br>";
	}
	if ($ESS > $_SESSION["ESshieldO"]){
		$ESS = $_SESSION["ESshieldO"];}
	$_SESSION["ESshield"] = $ESS;
	
		//achievment
	if ($_SESSION["ESshield"] >= 1000){
	$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$Account' and Name = 'ESS'");
	$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$Account', 'ESS', '1')";
	$result = mysqli_query($db, $order);}}
	
}
	

$finalPlayerDMG= round($finalPlayerDMG,0);
$finalPlayerHP= round($finalPlayerHP,0);
$monsRef= round($monsRef,0);
$tP = "tottal of <b>$finalPlayerDMG </b>";



//logas
if (!isset($_SESSION["LOG"])){
$_SESSION["LOG"] = "";
}
	if ($stun <> 1 and $Block <> 1 and $Dodge <> 1 and $Confusion <> 1){
		$mont = "$monSkillText dmg.";
	}
	else{
		if ($stun == 1){
		$mont = "Monster got sttuned !<br>";}
		if ($Block == 1){
		$mont = "Monster got blocked !<br>";}
		if ($Dodge == 1){
		$mont = "Dodged Monster !<br>";}
		if ($Confusion == 1){
		$mont = "Monster confused and hitted it self for $CFdmg!<br>";}
	}
	if ($mis <> 1);{
		
	if ($SKL ==5){
		$refT = "$User reflected <font color='#cc6600'>$monsRef dmg. ($mref %)</font><br>";}
	if ($citP == 1){
		$tP = "$xt tottal of <font color='red'><b>$finalPlayerDMG cryt.</b></font> ";}
	if ($SKL ==4){
		$CT = "Combo skill did <font color='#3366ff'>$skr x $physDMGc</font> dmg.<br>";}
	$LOG = $_SESSION["LOG"];
	$_SESSION["LOG"] = "$gemtxt <br> $overkillText $exptext $shieldREC $ThorText $restoreFromArmor $CursedText $magickText $efftext $att $tST $hpT $poisT $refT $CT $User did  $xt $tP  dmg. <br><br>$shieldDMG $mont<br><hr> $LOG<br>";
	}
	if ($mis == 1){
		$_SESSION["LOG"] = "$gemtxt <br> $overkillText $exptext $shieldREC $ThorText $restoreFromArmor $poisT $CursedText $magickText $efftext $User <b>Missed</b> <br><br>$shieldDMG $mont<br><br><hr>$LOG<br>";
	}




	$finalMonsHP = round($finalMonsHP,0);
	$finalPlayerHP = round($finalPlayerHP,0);

$ene = $_SESSION["ENERGY"];
$reg = $_SESSION["ENREGEN"];
if ($ene < $SKLm){
	$enr = $reg;
	$ene = $ene + $enr;
	
	//ARM bonus WEP
	if(isset($_SESSION["PHY"])){
	$ene = round($ene * 1.2);}
}
$ene = round($ene,0);
$_SESSION["ENERGY"] = $ene;

$_SESSION["MonsHP"] = $finalMonsHP;	
$_SESSION["HP"] = $finalPlayerHP;


//party stuff
if (isset($_SESSION["Party2"])){
	
	$PartyNRSK = $_SESSION["PartySK"];
	

	$PartyID  = $_SESSION["Party2"]; //Party ID
	$PLnr = $_SESSION["PlayerNR"]; //Player ID
	
	
	$PL = mysqli_query($db,"SELECT * FROM PartyMonsters where PartyID = '$PartyID' ");
	$PLs = mysqli_fetch_assoc($PL);
	
	if (isset($_SESSION["PARTYPOTIONDMG"])){
		$potionDMG = $_SESSION["PARTYPOTIONDMG"];
	}
	
	$PartyMobHP = $PLs["MonsterHP"] - $finalPlayerDMG - $potionDMG;
	
	if ($PartyMobHP <= 0){
		$PartyMobHP =0;
	}
	
	$dmgddone =	$PLs["$PLnr"] + $finalPlayerDMG + $petDMG +$potionDMG;
	
	$op1 = "UPDATE PartyMonsters
	SET MonsterHP= '$PartyMobHP'
	WHERE `PartyID` = '$PartyID'";
	
	$op2 = "UPDATE PartyMonsters
	SET $PLnr= '$dmgddone'
	WHERE `PartyID` = '$PartyID'";
	
$result = mysqli_query($db, $op1);
$result = mysqli_query($db, $op2);
}

//for 100k dmg achiev
if ($finalPlayerDMG >= 100000){
$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$Account' and Name = '100K'");
$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$Account', '100K', '1')";
	$result = mysqli_query($db, $order);}
}

//mons has <0hp
if ($finalMonsHP <= 0){	
	if (isset($_SESSION["MonsR"])){
		$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$Account' and Name = 'RARE'");
		$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$Account', 'RARE', '1')";
	$result = mysqli_query($db, $order);}}
	if (isset($_SESSION["OVER"])){
	$_SESSION["OVERdmg"] = round(1.5*($finalMonsHP * -1));}
	if ($_SESSION["OVERdmg"] >= (5*$plvl*$mLVL)){
		$_SESSION["OVERdmg"] = 5*$plvl*$mLVL;}
	header($page); //reward
	die();

}
	
if ($finalPlayerHP <= 0 and rand(0,100) < $_SESSION["Undeadth"]){
	$_SESSION["HP"] = $finalPlayerHP = 1;
	$_SESSION["LOG"] .= "<b color='red'>SURVIVED A LETHAL HIT</b><hr><br>";
}
	
//player hp <0
if ($finalPlayerHP <= 0){
	header($lose);
	"$finalPlayerHP";
	die();
}


//continue fight	

header($page2);
die();


?>