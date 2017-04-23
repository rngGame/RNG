<?php
session_start();
ob_start();

include_once 'PHP/db.php';


$HASH = $_POST["ITM"];
$EFT = $_POST["TYP"];
$VALUE = $_POST["VAL"];


if ($EFT == "HEAL"){
	$HP = $_SESSION["HP"];
	$HPMAX = $_SESSION["HPO"];
	$RES = round($HPMAX * $VALUE /100);
	$HP += $RES;
	if($HP > $HPMAX){
		$HP = $HPMAX;}
	$_SESSION["HP"] = round($HP);	
	$text = "Potion restored $RES health<br>";
	
}
if ($EFT == "LUCK"){
	$CRYT = $_SESSION["CRYT"];
	$BN = round($CRYT * $VALUE /100);
	$CRYT +=  $BN;
	$_SESSION["CRYT"] = round($CRYT);
	$text = "Potion Increased Cryt by $BN %<br>";
}
if ($EFT == "HURT"){
	$MHP = $_SESSION["MonsHP"];
	$BN = round($MHP * $VALUE /100);
	if ($BN >= 100000){
		$BN = 100000;}
	$MHP -= $BN;
	$_SESSION["MonsHP"] = $MHP;
	$text = "Potion did $BN damage to monster<br>";
	$_SESSION["PARTYPOTIONDMG"] = $BN;
}
if ($EFT == "ENER"){
	$SKL = $_SESSION["ENERGY"];
	$SKLm = $_SESSION["ENERGYM"];
	$BN = round($SKLm * $VALUE / 100);
	$SKL += $BN;
	 if($SKL > $SKLm){
		$SKL = $SKLm;}
	$_SESSION["ENERGY"] = round($SKL);
	$text = "Potion restored $BN energie<br>";
	
}
if ($EFT == "DEF"){
	$Armor = $_SESSION["ARM"];
	$ArmorM = $_SESSION["MARM"];
	$Armor += $Armor * $VALUE /100; 
	$ArmorM += $ArmorM * $VALUE /100; 
	$_SESSION["ARM"] = round($Armor);
	$_SESSION["MARM"] = round($ArmorM);
	$text = "Potion increased armor by $VALUE % <br>";
	
}
if ($EFT == "DMG"){
	$minPdmg = $_SESSION["DMGPmin"];
	$maxPdmg = $_SESSION["DMGPmax"];
	$minMdmg = $_SESSION["DMGMmin"];
	$maxMdmg = $_SESSION["DMGMmax"];
	$minPdmg += $minPdmg * $VALUE /100; 
	$maxPdmg += $maxPdmg * $VALUE /100; 
	$maxMdmg += $maxMdmg * $VALUE /100; 
	$maxMdmg += $maxMdmg * $VALUE /100;
	$_SESSION["DMGPmin"] = round($minPdmg);
	$_SESSION["DMGPmax"] = round($maxPdmg);
	$_SESSION["DMGMmin"] = round($maxMdmg);
	$_SESSION["DMGMmax"] = round($maxMdmg);
	$text = "Potion increased damage by $VALUE % <br>";
	
}

$LOG = $_SESSION["LOG"] ;
$LOG = " <b>$text</b> <hr> <br>$LOG ";
$_SESSION["LOG"] = $LOG;
$_SESSION["ATTACK"] = 1;

$sql="DELETE FROM Equiped WHERE HASH='$HASH'";
mysqli_query($db,$sql);

$sql2="DELETE FROM DropsItm WHERE HASH='$HASH'";
mysqli_query($db,$sql2);

header('location:FCAL.php');
die();


?>