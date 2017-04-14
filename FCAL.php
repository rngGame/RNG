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

$SKL = $_POST["skl"]; //skill ID

$wepHASH = $_SESSION["CURRENTWHASH"]; //get weapon hash

$CRT= rand(1,100); //cryt ccalc




	
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

//GEM dmg (mag)
if ($GEM[1] <> ""){
	$gemDMG = ($magDMG * $GEM[5]/100);
	$gemDMG  = round($gemDMG,0);
	$tST = "$User did $xt <font color='#$GEM[3]'>$gemDMG $GEM[2] dmg.</font><br>";}

//skills
if ($SKL <> "" or $_SESSION["PET"] == 1){
		include 'PHP/skills.php';
}



//cryt calc
if ($CRT <= $CRYT+$WEPn["Cryt"] and $magick == 0){
	$citP = 1;
	$CRYTD = $physDMG*$CRYTD/100;
	$CRYTD = round($CRYTD);
	$physDMG = ($physDMG*2)+$CRYTD;

	
	if ($SKL == 4){ //cryt if combo
	$CRYTD = $physDMGc*$CRYTD/100;
	$CRYTD = round($CRYTD);
	$physDMGc = ($physDMGc*2)+$CRYTD;
}
	
	$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$User' and Name = 'CRYT'");
	$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$User', 'CRYT', '1')";
	$result = mysqli_query($db, $order);}
		else{
			$CCount = $ACH[2] + 1;
			$order = "UPDATE aStatus
			SET Status = '$CCount'
			WHERE `User` = '$User' and `Name` = 'CRYT'";
			$result = mysqli_query($db, $order);
		}
}

//Effects
if ($WEPn["efstat"] <> 0 or $SUB[7] <> 0){
		include 'PHP/effect.php';
}


//monster cryt	
$CRT2= rand(1,100);	
if ($CRT2 < 10){
	$citM = 1;
$monDMG = $monDMG*2;}

//monster dmg to playerr
$monDMG = ($monDMG - $Armor);
$monDMGmag = ($monDMGmag - $ArmorM);
if ($monDMG < 0){
	$monDMG = 1;}
	
	
//apsorb
$apsv = ($monDMG*$APS/100);
$apsv = round($apsv,0);
$monDMG = $monDMG - $apsv;
$apsvM = ($monDMGmag*$APS/100);
$apsvM = round($apsvM,0);
$monDMGmag = $monDMGmag - $apsv;

	$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$User' and Name = 'APS'");
	$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$User', 'APS', '$apsv')";
	$result = mysqli_query($db, $order);}
		else{
			$CCount = $ACH[2] + $apsv + $apsvM;
			$order = "UPDATE aStatus
			SET Status = '$CCount'
			WHERE `User` = '$User' and `Name` = 'APS'";
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
		if ($poison >= 10000){
			$poison = 10000;}
	}
	else if ($poison >= 3000){
			$poison = 3000;}
	$poison = round($poison,0);
	$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$User' and Name = 'POS'");
	$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$User', 'POS', '$poison')";
	$result = mysqli_query($db, $order);}
		else{
			$CCount = $ACH[2] + $poison;
			$order = "UPDATE aStatus
			SET Status = '$CCount'
			WHERE `User` = '$User' and `Name` = 'POS'";
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


//calculation dmg to mons
if ($SKL == 1111 or $SKL == 7 or $SKL ==1 or $SKL ==3 or $SKL ==4 or $SKL ==5 or $SKL ==6 ){ //check for physical dmg
if (rand(0,100) <= $WEPn["HitChanse"] ){
$finalPlayerDMG = ($physDMG-$MonDEF) + ($gemDMG-$MonDEF) + ($monsRef-$MonDEF) + ($effect-$MonDEF);
if ($ddam == 1){
	$finalPlayerDMG = $finalPlayerDMG * 2;}
$finalMonsHP = $monHP - $finalPlayerDMG;
	}
else{
	$miss = "Missed<br>";
	$mis = 1;
	$finalMonsHP = $monHP;
}}

//let use phsy dmg when pet summoned
if ($_SESSION["PET"] == 1){
	$finalPlayerDMGandPET = $finalPlayerDMG;
	$petsum = 1;}

 //magick
if ($SKL == 31 or $SKL == 32 or $SKL == 33 or $SKL == 36 or $SKL == 2 or $SKL ==34 or $SKL ==35 or $petsum == 1){ //check for magick dmg
$finalPlayerDMG = ($magick-$MonDEF) + ($effect-$MonDEF) + ($gemDMG-$MonDEF) + ($finalPlayerDMGandPET -$MonDEF);
if ($ddam == 1){
	$finalPlayerDMG = $finalPlayerDMG * 2;}
$finalMonsHP = $monHP - $finalPlayerDMG;
}

//poision
$finalMonsHP = $finalMonsHP - $poison;
$finalPlayerDMG = $finalPlayerDMG + $poison;

//dmg to player----------------------------------

if ($stun <> 1 and $Block <> 1 and $Dodge <> 1){

//monster skill
if (rand(1,100) >= 75){
	$monDMGmag = round($monDMGmag * rand(110,150) /100);
	if ($monDMGmag <= 0){
		$monDMGmag = 0;}
	$finalPlayerHP = $HPin - $monDMGmag;
	$tM = $monDMGmag ;
	$mobmagskill="<b>Monster used Magick Missile for $monDMGmag dmg.</b><br>";
}
// if no skill used by mob
else{
$finalPlayerHP = $HPin - $monDMG;
$BasicAtackByMob = "Monster did $monDMG dmg.<br>";
}

$monSkillText="$mobmagskill $BasicAtackByMob" ;

}

//if monster coulcn't atack
else{
	$finalPlayerHP = $HPin ;
}

$finalPlayerDMG= round($finalPlayerDMG,0);
$finalPlayerHP= round($finalPlayerHP,0);
$monsRef= round($monsRef,0);
$tP = "tottal of $finalPlayerDMG";



//logas
if (!isset($_SESSION["LOG"])){
$_SESSION["LOG"] = "";
}
	if ($stun <> 1 and $Block <> 1 and $Dodge <> 1){
		$mont = "$monSkillText";
	}
	else{
		if ($stun == 1){
		$mont = "Monster got sttuned !<br>";}
		if ($Block == 1){
		$mont = "Monster got blocked !<br>";}
		if ($Dodge == 1){
		$mont = "Dodged Monster !<br>";}
	}
	if ($mis <> 1);{
		
	if ($SKL ==5){
		$refT = "$User reflected <font color='#cc6600'>$monsRef dmg. ($mref %)</font><br>";}
	if ($SKL ==4){
		$tP = "$xt <font color='#3366ff'>$skr x $physDMGc</font>";}
	if ($citP == 1){
		$tP = "$xt <font color='red'>$tP cryt.</font>";}
	if ($citM == 1){
		$tM = "$xt <font color='red'>$tM cryt.</font>";}
	$LOG = $_SESSION["LOG"];
	$_SESSION["LOG"] = "$magickText $efftext $att $tST $hpT $poisT $refT $User did  $xt $tP  dmg. <br><br>$mont<br><hr> $LOG<br>";
	}
	if ($mis == 1){
		$_SESSION["LOG"] = "$poisT $magickText $User <b>Missed</b> <br><br>$mont<br><br><hr> $LOG<br>";
	}




	$finalMonsHP = round($finalMonsHP,0);
	$finalPlayerHP = round($finalPlayerHP,0);

$ene = $_SESSION["ENERGY"];
$reg = $_SESSION["ENREGEN"];
if ($ene < $SKLm){
	$enr = $reg;
$ene = $ene + $enr;}
$ene = round($ene,0);
$_SESSION["ENERGY"] = $ene;

$_SESSION["MonsHP"] = $finalMonsHP;	
$_SESSION["HP"] = $finalPlayerHP;


//???????????????????????????????
if (isset($_SESSION["Party2"])){
	
	$PartyNRSK = $_SESSION["PartySK"];
	

	$PartyID  = $_SESSION["Party2"]; //Party ID
	$PLnr = $_SESSION["PlayerNR"]; //Player ID
	
	
	$PL = mysqli_query($db,"SELECT * FROM PartyMonsters where PartyID = '$PartyID' ");
	$PLs = mysqli_fetch_assoc($PL);
	
	$PartyMobHP = $PLs["MonsterHP"] - $finalPlayerDMG;
	
	if ($PartyMobHP <= 0){
		$PartyMobHP =0;
	}
	
	$dmgddone =	$PLs["$PLnr"] + $finalPlayerDMG + $petDMG;
	
	$op1 = "UPDATE PartyMonsters
	SET MonsterHP= '$PartyMobHP'
	WHERE `PartyID` = '$PartyID'";
	
	$op2 = "UPDATE PartyMonsters
	SET $PLnr= '$dmgddone'
	WHERE `PartyID` = '$PartyID'";
	
$result = mysqli_query($db, $op1);
$result = mysqli_query($db, $op2);
}

//mons has <0hp
if ($finalMonsHP <= 0){	
	if (isset($_SESSION["MonsR"])){
		$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$User' and Name = 'RARE'");
		$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$User', 'RARE', '1')";
	$result = mysqli_query($db, $order);}}
	header($page); //reward
	die();

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