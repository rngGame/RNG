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
$minMondmg = $monDMG - ($monDMG * 20 / 100);
$maxMondmg = $monDMG + ($monDMG * 20 / 100);

$monDMG = rand($minMondmg,$maxMondmg);

$monHP = $_SESSION["MonsHP"]; //monster hp
$mLVL = $_SESSION["MonsLVL"]; //monster lvl

$HPin = $_SESSION["HP"]; //player hp
$plvl = $_SESSION["plvl"]; //player lvl
$Armor = $_SESSION["ARM"]; //player armor
$ene = $_SESSION["ENERGY"]; //player energy
$SKLm = $_SESSION["ENERGYM"]; //current player energy
$CRYT = $_SESSION["CRYT"]; // cryt  chanse
$CRYTD = $_SESSION["CRYTD"]; //cryt dmg
$APS = $_SESSION["APS"]; //apsorb
$ENG2 = $_SESSION["ENG2"]; //energy regen bonus
$HPO = $_SESSION["HPO"]; //base hp of player

$SKL = $_POST["skl"]; //skill ID

$CRT= rand(1,100); //cryt ccalc




	
//DB
$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
$WEP = mysqli_query($db,"SELECT * FROM weapondrops where HASH = '$ACC[1]' ");
$WEP = mysqli_fetch_row($WEP);
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$ACC[10]' ");
$CLS = mysqli_fetch_row($CLS);
$GEM = mysqli_query($db,"SELECT * FROM Gems where HASH = '$ACC[14]' ");
$GEM = mysqli_fetch_row($GEM);

if ($ACC[10] > 10){
	$SUB = mysqli_query($db,"SELECT * FROM Subclass where ID = '$ACC[10]' ");
	$SUB = mysqli_fetch_row($SUB);
};

//GEM dmg (mag)
if ($GEM[0] != "None"){
	$gemDMG = ($magDMG * $GEM[5]/100);
	$gemDMG  = round($gemDMG,0);
	$tST = "$User did $xt <font color='#$GEM[3]'>$gemDMG $GEM[2] dmg.</font><br>";}

//skills
if ($SKL <> "" and $SKL <> 1111){
		include 'PHP/skills.php';
}



//cryt calc
if ($CRT <= $CRYT+$WEP[7] and $magick == 0){
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

//skills
if ($WEP[14] <> 0){
		include 'PHP/effect.php';
}


//monster cryt	
$CRT2= rand(1,100);	
if ($CRT2 < 10){
	$citM = 1;
$monDMG = $monDMG*2;}

//monster dmg to playerr
$monDMG = ($monDMG - $Armor);
if ($monDMG < 0){
	$monDMG = 1;}
	
	
//apsorb
$apsv = ($monDMG*$APS/100);
$apsv = round($apsv,0);
$monDMG = $monDMG - $apsv;
	$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$User' and Name = 'APS'");
	$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$User', 'APS', '$apsv')";
	$result = mysqli_query($db, $order);}
		else{
			$CCount = $ACH[2] + $apsv;
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
	$pois = rand(1,5);
	if ($CLS[6] == "POIS"){
	$pois = rand(3,8);}
	$poison = ($monHP*$pois/100); 
	if ($poison >= 3000){
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



//calculation dmg to mons
$finalMonsHP = $monHP;

if ($SKL == 1111 or $SKL == 7 or $SKL ==1 or $SKL ==2 or $SKL ==3 or $SKL ==4 or $SKL ==5 or $SKL ==6){ //check for basic attack
if (rand(0,100) <= $WEP[11]){
$finalPlayerDMG = $poison + $physDMG + $gemDMG + $monsRef + $effect;
if ($ddam == 1){
	$finalPlayerDMG = $finalPlayerDMG * 2;}
$finalMonsHP = $monHP - $finalPlayerDMG;
	}
else{
	$miss = "Missed<br>";
	$mis = 1;
	$finalMonsHP = $monHP;
}}
 $magick;
if ($SKL == 31 or $SKL == 32 or $SKL == 33){
$finalPlayerDMG = $magick + $effect + $gemDMG +  $poison;
if ($ddam == 1){
	$finalPlayerDMG = $finalPlayerDMG * 2;}
$finalMonsHP = $monHP - $finalPlayerDMG;
}




	$xDMG = $mHP - $DMGin - $monsRef   - $DMGinS;



//dmg to player

if ($stun <> 1 and $Block <> 1 and $Dodge <> 1){
$finalPlayerHP = $HPin - $monDMG;
}
else{
	$finalPlayerHP = $HPin ;
}

$finalPlayerDMG= round($finalPlayerDMG,0);
$finalPlayerHP= round($finalPlayerHP,0);
$monsRef= round($monsRef,0);
$tP = "tottal of $finalPlayerDMG";
$tM = $monDMG;


//logas
if (!isset($_SESSION["LOG"])){
$_SESSION["LOG"] = "";
}
	if ($stun <> 1 and $Block <> 1 and $Dodge <> 1){
		$mont = "Monster did $tM dmg.<br>";
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
		$_SESSION["LOG"] = " $User <b>Missed</b> <br><br>Monster did $tM dmg.<br><br><hr> $LOG<br>";
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
decreaseddecreased