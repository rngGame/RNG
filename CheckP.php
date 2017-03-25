<?php
session_start();
ob_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"];
$Name = $_POST["chr"];

$PVP = mysqli_query($db,"SELECT * FROM characters where user = '$Name' ");
$PVP = mysqli_fetch_row($PVP);

$MOD = mysqli_query($db,"SELECT * FROM modlist where User = '$Name ' ");
$MOD = mysqli_fetch_row($MOD);

if ($MOD[0] == ""){
	echo "";
	}
else {
	$MODN = array();
	$MODE = array();
	$MODT = array();
	$modc = 1;
	$mc = 1;
	while ($modc <= 4){
		$MDC = mysqli_query($db,"SELECT * FROM mods where ID = '$MOD[$mc]' ");
		$MDC = mysqli_fetch_row($MDC);	
		if ($MDC[1] != ""){
			$MODN[$mc] = $MDC[1];
			$MODT[$mc] = $MDC[2];
			$MODE[$mc] = $MOD[$mc+1];	
			$mc = $mc + 2;
			$modc = $modc + 1;		
		}
		else{
			$modc = 5;
		}	
}
}


$PAS = mysqli_query($db,"SELECT * FROM passive where USER = '$Name' ");
$PAS = mysqli_fetch_row($PAS);

$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$PVP[10]' ");
$CLS = mysqli_fetch_row($CLS);

$WEP = mysqli_query($db,"SELECT * FROM drops where HASH = '$PVP[1]' ");
$WEP = mysqli_fetch_row($WEP);

if ($WEP[8] == 0){
}
else{
	$Skil = mysqli_query($db,"SELECT * FROM iskills where ID = '$WEP[8]' ");
	$Skil = mysqli_fetch_row($Skil);
};

$ARM = mysqli_query($db,"SELECT * FROM drops where HASH = '$PVP[7]' ");
$ARM = mysqli_fetch_row($ARM);

$TAL = mysqli_query($db,"SELECT * FROM dropst where HASH = '$PVP[8]' ");
$TAL = mysqli_fetch_row($TAL);

$HP = $PVP[2] * $CLS[2];
$HP = round($HP,0);

$armor = ($ARM[4] + $TAL[5])*$CLS[4];

$dmg = ($WEP[4] + $TAL[3])*$CLS[3];
$HP2 = $HP + $TAL[4];

if ($WEP[8] == 0){
}
else{
	if ($Skil[2] == "DMG"){
		$dmg = $dmg + ($dmg*$Skil[3]/100);}
	if ($Skil[2] == "ARM"){
		$armor = $armor + ($armor*$Skil[4]/100);}
	if ($Skil[2] == "HP"){
		$HP2 = $HP2 + ($HP2*$Skil[5]/100);}
}

$armor = $armor*2;
$HP2 = $HP2 *2;
$armor = $armor*1.1;
$HP2 = $HP2 *1.1;
$dmg = $dmg *1.1;

if(isset($MODE[1])){
	
	$mc2 = 1;
	while (isset($MODE[$mc2])){

	if($MODT[$mc2] == "DMG"){
		$dmg = $dmg+($dmg*$MODE[$mc2]/100);
	}
	if($MODT[$mc2] == "DEF"){
		$armor = $armor+($armor*$MODE[$mc2]/100);
	}
	if($MODT[$mc2] == "CRT"){
		$PAS[2] = $PAS[2]+($PAS[2]*$MODE[$mc2]/100);
		$PAS[2] = round($PAS[2],0);
	}
	if($MODT[$mc2] == "CRD"){
		$PAS[11] = $PAS[11]+($PAS[11]*$MODE[$mc2]/100);
		$PAS[11] = round($PAS[11],0);
	}	
	if($MODT[$mc2] == "ENG"){
		$CLS[5] = $CLS[5]+($CLS[5]*$MODE[$mc2]/100);
		$CLS[5] = round($CLS[5],0);
	}
	if($MODT[$mc2] == "ENR"){
		$PAS[8] = $PAS[8]+($PAS[8]*$MODE[$mc2]/100);
		$PAS[8] = round($PAS[8],0);
	}
	if($MODT[$mc2] == "HP"){
		$HP2 = $HP2+($HP2*$MODE[$mc2]/100);
	}
	if($MODT[$mc2] == "XP"){
		$TAL[6] = $TAL[6]+($TAL[6]*$MODE[$mc2]/100);
		$TAL[6] = round($TAL[6],0);
	}
	if($MODT[$mc2] == "ABS"){
		$PAS[5] = $PAS[5]+($PAS[5]*$MODE[$mc2]/100);	
		$PAS[5] = round($PAS[5],0);
	}
	$mc2 = $mc2 + 2;
}
}


$armor = round($armor,0);
$dmg = round($dmg,0);
$HP2 = round($HP2,0);


$_SESSION["Name"] = $Name;
$_SESSION["HP2"] = $HP2;
$_SESSION["DMG2"] = $dmg;
$_SESSION["ARM2"] = $armor;
$_SESSION["CRYT2"] = $PAS[2];
$_SESSION["CRYTD2"] = $PAS[11];
$_SESSION["APS2"] = $PAS[5];


$HPin = $_SESSION["HP"];
$ARMO = $_SESSION["ARM"];
$HPin = $HPin* 2;
$ARMO = $ARMO* 2;
$_SESSION["HP"]=$HPin;
$_SESSION["ARM"]=$ARMO;


echo "$HP2<br>";
echo "$dmg<br>";
echo "$armor<br>";
echo "$PAS[2]<br>";
echo "$PAS[11]<br>";
echo "$PAS[5]<br>";

mysqli_close($db);
header("location:fightTP.php");
?>