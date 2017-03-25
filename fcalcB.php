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
World Of RNG
</header>
<?php
include_once 'PHP/db.php';
$User = $_SESSION["User"];

$mName = $_SESSION["MonsName"];
$myfile = fopen("Logs/$User.txt", "x+");
$myfile = fopen("Logs/$User.txt", "a+") or die("Unable to open file!");

$HPin = $_SESSION["HP"];
$DMGin = $_SESSION["DMGPL"];
$plvl = $_SESSION["plvl"];
$Armor = $_SESSION["ARM"];

$mDMG = $_SESSION["MonsDMG"];
$mHP = $_SESSION["MonsHP"];

$ene = $_SESSION["ENERGY"];
$SKLm = $_SESSION["ENERGYM"];

$SKL = $_POST["skl"];

$CRYT = $_SESSION["CRYT"];
$CRYTD = $_SESSION["CRYTD"];
$APS = $_SESSION["APS"];
$ENG2 = $_SESSION["ENG2"];

$HPO = $_SESSION["HPO"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$ACC[10]' ");
$CLS = mysqli_fetch_row($CLS);

$GEM = mysqli_query($db,"SELECT * FROM Gems where HASH = '$ACC[14]' ");
$GEM = mysqli_fetch_row($GEM);

$DMGinS = 0;
if ($GEM[0] != "None"){
	$DMGinS = ($DMGin * $GEM[5]/100);
	$DMGinS  = round($DMGinS,0);
	$tST = "$User did <font color='#$GEM[3]'>$DMGinS $GEM[2] dmg.</font><br>";}

$type = rand(1,99);
if ($type > 0){
	$page = "location:rewBoss.php";}


if ($SKL ==1){
	if ($CLS[6] == "PALA"){
	$DMGin = $DMGin * 1.50;}
	else{
	$DMGin = $DMGin * 1.25;}
	$ene = $ene - 30;
	$_SESSION["ENERGY"] = $ene;
};

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
if ($SKL ==3){
	$s = rand(5,20);
		if ($CLS[6] == "DMGB"){
		$s = rand(10,25);}
	$DMGin = $DMGin +($DMGin * $s/100);
	$DMGin = round($DMGin);
	$ene = $ene - 50;
	$_SESSION["ENERGY"] = $ene;
	$_SESSION["DMGPL"] = $DMGin;
};

if ($SKL ==4){
	$r1 = rand(1,100);
	$r2 = rand(1,100);
	$r3 = rand(1,100);
	$r4 = rand(1,100);
	$r5 = rand(1,100);

	$ene = $ene - 60;
	$_SESSION["ENERGY"] = $ene;

};






$CRT= rand(1,100);
if ($SKL ==6){
	$CRYT = $CRYT * 2;
	$CRYTD = $CRYTD + 100;
		if ($CLS[6] == "ASSA"){
	$CRYT = $CRYT * 1.2;
	$CRYTD = $CRYTD + 20;}
	$ene = $ene - 70;
	$_SESSION["ENERGY"] = $ene;
	}
if ($CRT <= $CRYT){
	$citP = 1;
	$CRYTD = $DMGin*$CRYTD/100;
	$CRYTD = round($CRYTD);
	$DMGin = ($DMGin*2)+$CRYTD;
	
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
	
$CRT2= rand(1,100);	
if ($CRT2 < 10){
	$citM = 1;
$mDMG = $mDMG*2;}

$xDMG = $mHP - $DMGin;

if ($SKL ==4){
	$skr = 0;
	$DMGin2 = $DMGin*40/100;
	$DMGin = 0;
	if ($CLS[6] == "COMB"){
	$r1 = rand(1,75);
	$r2 = rand(1,80);
	$r3 = rand(1,85);
	$r4 = rand(1,90);
	$r5 = rand(1,95);}
	if ( $r1 < 75){
		$skr = $skr + 1;
		$DMGin = $DMGin2;}
	if ( $r2 < 75){
		$skr = $skr + 1;
		$DMGin = $DMGin + $DMGin2;}
	if ( $r3 < 75){
		$skr = $skr + 1;
		$DMGin = $DMGin + $DMGin2;}
	if ( $r4 < 75){
		$skr = $skr + 1;
		$DMGin = $DMGin + $DMGin2;}
	if ( $r5 < 75){
		$skr = $skr + 1;
		$DMGin = $DMGin + $DMGin2;}
		
		$DMGin2 = round($DMGin2,0);
}



$sDMG = ($mDMG - $Armor);


if ($sDMG < 0){
	$sDMG = 1;}
	
$apsv = ($sDMG*$APS/100);
$apsv = round($apsv,0);
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
		
$monsRef = 0;
$poison = 0;
if ($SKL ==5){
	$mref = rand(30,60);
		if ($CLS[6] == "TANK"){
		$mref = rand(50,80);}
 	$monsRef = ($mDMG*$mref/100)+$Armor;
	$ene = $ene - 30;
	$_SESSION["ENERGY"] = $ene;
};

if (!isset($_SESSION["pois"])){
}
else{
	$pos = 1;
}

if ($SKL ==7 or $pos == 1){
	$pois = rand(1,5);
		if ($CLS[6] == "POIS"){
	$pois = rand(3,8);}
	$poison = ($mHP*$pois/10000); 
	$poison = round($poison,0);
	$_SESSION["pois"] = 1;
	$poisT = "$User did <font color='#008000'>$poison Poison dmg.</font><br>";
	
	if ($SKL ==7){
	$ene = $ene - 35;
	$_SESSION["ENERGY"] = $ene;}
};
	
	
$xDMG = $mHP - $DMGin - $monsRef - $poison - $DMGinS;	
$sDMG = $sDMG - $apsv;
$yDMG = $HPin - $sDMG;

$DMGin= round($DMGin,0);
$sDMG= round($sDMG,0);
$monsRef= round($monsRef,0);
$tP = $DMGin;
$tM = $sDMG;


//logas
if (!isset($_SESSION["LOG"])){
$_SESSION["LOG"] = "";
}
	$refT = "";
	if ($SKL ==5){
		$refT = "$User reflected <font color='#cc6600'>$monsRef dmg. ($mref %)</font><br>";
	}
	if ($SKL ==4){
		$tP = "<font color='#3366ff'>$skr x $DMGin2</font>";}
	if ($citP == 1){
		$tP = "<font color='red'>$tP cryt.</font>";}
	if ($citM == 1){
		$tM = "<font color='red'>$tM cryt.</font>";}
	$LOG = $_SESSION["LOG"];
	$_SESSION["LOG"] = "$tST $hpT $poisT $refT $User did $tP dmg. <br>Monster did $tM dmg.<br><br> <hr>$LOG<br>";

	


	$xDMG = round($xDMG,0);
	$yDMG = round($yDMG,0);

$ene = $_SESSION["ENERGY"];
if ($ene < $SKLm){
	$enr= 5+(5*$ENG2/100);
$ene = $ene + $enr;};
$_SESSION["ENERGY"] = $ene;

$txtf = $_SESSION["LOG"];
$txt = "$txtf \r\n";
fwrite($myfile, $txt);



mysqli_close($db);
if ($xDMG <= 0){
	$_SESSION["times"] = 0;
	$_SESSION["MonsHP"] = $xDMG;
	$txt = "$User killed $mName\r\n";
	fwrite($myfile, $txt);
	$txt = "<>\r\n";
	fwrite($myfile, $txt);
	fclose($myfile);
	header($page);
	echo "$DMGin";
	}
	
else if ($yDMG < 0){
	$txt = "$User lost to $mName\r\n";
	fwrite($myfile, $txt);
	$txt = "<>\r\n";
	fwrite($myfile, $txt);
	fclose($myfile);
	$_SESSION["MonsHP"] = $xDMG;
	header("location:loseB.php");
	echo "$DMGin";
	}
	else{
	$txt = "\r\n";
	fwrite($myfile, $txt);
	fclose($myfile);
	
	
	$_SESSION["MonsHP"] = $xDMG;	
	$_SESSION["HP"] = $yDMG;
	echo "$DMGin";
	header("location:FightTB.php");
	};
	

?>
