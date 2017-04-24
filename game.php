<?php
session_start();
ob_start();

include_once 'PHP/db.php';
$User = $_SESSION["User"];



if ($User == ""){
	header("location:index.php");}


$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$PAS = mysqli_query($db,"SELECT * FROM passive where USER = '$User' ");
$PAS = mysqli_fetch_row($PAS);

$MOD = mysqli_query($db,"SELECT * FROM modlist where User = '$User' ");
$MOD = mysqli_fetch_row($MOD);

$GEM = mysqli_query($db,"SELECT * FROM Gems where HASH = '$ACC[14]' ");
$GEM = mysqli_fetch_row($GEM);



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

$pasl1 = $PAS[3] + 1;
$pasl2 = $PAS[6] + 1;
$pasl3 = $PAS[9] + 1;
$pasl4 = $PAS[12] + 1;

$PAS2 = mysqli_query($db,"SELECT * FROM skillxp where LVL = '$pasl1' ");
$plvl1 = mysqli_fetch_row($PAS2);
$PAS2 = mysqli_query($db,"SELECT * FROM skillxp where LVL = '$pasl2' ");
$plvl2 = mysqli_fetch_row($PAS2);
$PAS2 = mysqli_query($db,"SELECT * FROM skillxp where LVL = '$pasl3' ");
$plvl3 = mysqli_fetch_row($PAS2);
$PAS2 = mysqli_query($db,"SELECT * FROM skillxp where LVL = '$pasl4' ");
$plvl4 = mysqli_fetch_row($PAS2);

//classes and subclasses
if ($ACC[10] < 10){
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$ACC[10]' ");
$CLS = mysqli_fetch_row($CLS);
}
if ($ACC[10] > 10){
$SUB = mysqli_query($db,"SELECT * FROM Subclass where ID = '$ACC[10]' ");
$SUB = mysqli_fetch_row($SUB);
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$SUB[2]' ");
$CLS = mysqli_fetch_row($CLS);

//change from class ->> subclass
$CLS[1] = $SUB[1];
$CLS[9] = $SUB[8];

if ($SUB[3] == "HP"){
	$hpsub = $SUB[4];
	}
if ($SUB[3] == "DMG"){
	$dmgsub = $SUB[4];
	}
if ($SUB[3] == "DEF"){
	$defsub = $SUB[4];
	}
if ($SUB[3] == "CRD"){
	$crdsub = $SUB[4];
	}
if ($SUB[3] == "CRC"){
	$crcsub = $SUB[4];
	}
if ($SUB[3] == "ENR"){
	$enrsub = $SUB[4];
	}

}


//new wep
$EQPW = mysqli_query($db,"SELECT * FROM Equiped where User = '$User' AND Part = 'WEP' AND Equiped = '1' ");
$EQPW = mysqli_fetch_row($EQPW);

$WEP = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$EQPW[2]' ");
$WEPn = mysqli_fetch_assoc($WEP); //by colum name
$WEP = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$EQPW[2]' ");
$WEP = mysqli_fetch_row($WEP); //by colum number

$_SESSION["CURRENTWHASH"] = $WEP[0];



//new Armor
$EQPar = mysqli_query($db,"SELECT * FROM Equiped where User = '$User' AND Part = 'ARM' AND Equiped = '1' ");
while ($EQPA = mysqli_fetch_array($EQPar)){	

if (!isset($ARMBODY)){
$ARMBODY = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$EQPA[2]' AND Part = 'BODY' ");
$ARMBODY = mysqli_fetch_assoc($ARMBODY); //BODY by colum name
$_SESSION["CURRENTARMBODY"] = $ARMBODY["HASH"];
}

if (!isset($ARMGLOVES)){
$ARMGLOVES = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$EQPA[2]' AND Part = 'GLOVES'");
$ARMGLOVES = mysqli_fetch_assoc($ARMGLOVES); //GLOVES by colum name
$_SESSION["CURRENTARMGLOVES"] = $ARMGLOVES["HASH"];
}

if (!isset($ARMBOOTS)){
$ARMBOOTS = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$EQPA[2]' AND Part = 'LEGS' ");
$ARMBOOTS = mysqli_fetch_assoc($ARMBOOTS); //BOOTS by colum name
$_SESSION["CURRENTARMBOOTS"] = $ARMBOOTS["HASH"];
}
}



//new  accesories
$EQPacs = mysqli_query($db,"SELECT * FROM Equiped where User = '$User' AND Part = 'ACS' AND Equiped = '1' ");
while ($EQPAC = mysqli_fetch_array($EQPacs)){	

if (!isset($ACSRING)){
$ACSRING = mysqli_query($db,"SELECT * FROM DropsAcs where HASH = '$EQPAC[2]' AND Part = 'RING' ");
$ACSRING = mysqli_fetch_assoc($ACSRING); //BODY by colum name
$_SESSION["CURRENTACSRING"] = $ACSRING["HASH"];
}

if (!isset($ACSAMULET)){
$ACSAMULET = mysqli_query($db,"SELECT * FROM DropsAcs where HASH = '$EQPAC[2]' AND Part = 'AMUL' ");
$ACSAMULET = mysqli_fetch_assoc($ACSAMULET); //BODY by colum name
$_SESSION["CURRENTACSAMULET"] = $ACSAMULET["HASH"];
}
}




//Laiko tikrinimas
$datetime = date_create()->format('Y-m-d H:i:s');
$ONL2 = mysqli_query($db,"SELECT * FROM Online where Time>'$datetime'");
$ONL = mysqli_num_rows($ONL2);




while($users2=mysqli_fetch_array($ONL2)){
	$USR2 = mysqli_query($db,"SELECT * FROM characters where user = '$users2[0]' ");
	$USR2 = mysqli_fetch_row($USR2);
	$CLS2 = mysqli_query($db,"SELECT * FROM class where ID = '$USR2[10]' ");
	$CLS2 = mysqli_fetch_row($CLS2);
          	$UsersO = "<b>$UsersO  <font color='$USR2[12]'>$users2[0]</font> </b><br>";
         }
if ($ONL == 0){
	$onlineText = " <div class='tooltip'>1 Player Online<span class='tooltiptext'<font color='$ACC[12]'>>$User</font></span></div>";}
if ($ONL == 1){
	$onlineText = " <div class='tooltip'>$ONL Player Online<span class='tooltiptext'>$UsersO</span></div>";}
if ($ONL > 1){
	$onlineText = " <div class='tooltip'>$ONL Players Online<span class='tooltiptext'>$UsersO</span></div>";}

if ($WEPn["skill"] == 0){
}
else{
	$Skil = mysqli_query($db,"SELECT * FROM iskills where ID = '$WEPn[skill]' ");
	$Skil = mysqli_fetch_row($Skil);
};

$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$User' ");
$PNT = mysqli_fetch_row($PNT); //pasive points


if ($PNT[1] >= 1){
	$pointsLvlUp = "<b><font color='red'>You have $PNT[1] unspend points!</font></b>";
	$pasiveBut = " <div class='newt'>       <div class='tooltip'>
	      <form method='post' id='yourFormId' action='point.php'>
          <input type='hidden' name='STAT' value='STR'>
        <input style='width:45px;height:25px;' type='submit' name='commit' value='STR'><span class='tooltiptext'>Increase STR by 1<br>Increase Physical damage and health.</span>
      </form>
    </div>&nbsp;&nbsp;
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='point.php'>
          <input type='hidden' name='STAT' value='INTE'>
        <input style='width:45px;height:25px;' type='submit' name='commit' value='INT'><span class='tooltiptext'>Increase INT by 1<br>Increase Magick and Energie.</span>
      </form>
    </div></div>&nbsp;&nbsp;
";
}



$lvl2 = $ACC[3] + 1;

//xp to next level
$XPL = mysqli_query($db,"SELECT * FROM levels where LVL = '$lvl2' ");
$XPL = mysqli_fetch_row($XPL);

//xp for current level
$XPP = mysqli_query($db,"SELECT * FROM levels where LVL = '$ACC[3]' ");
$XPP = mysqli_fetch_row($XPP);

$XPL0 = ($ACC[5] - $XPP[1]);
$XPL0 = round($XPL0);

$XPL1 = ($XPL[1] - $XPP[1]);
$XPL1 = round($XPL1);

$XPL2 = ($XPL[1] - $ACC[5]);
$XPL2 = round($XPL2);

//xp rounding
if ($XPL2 < 1000){
$XPL2r = round($XPL2);
}
if ($XPL2 >= 1000){
$XPL2r = round($XPL2/1000,1);
$XPL2r .= "k.";}
if ($XPL2 >= 1000000){
$XPL2r = round($XPL2/1000000,1);
$XPL2r .= "kk.";}
if ($XPL2 >= 1000000000){
$XPL2r = round($XPL2/1000000000,1);
$XPL2r .= "kkk.";}

$generatedXP = round(100*(1-(($XPL1-$XPL0)/$XPL1))) ;


$XPLc = mysqli_query($db,"SELECT EXISTS(SELECT * FROM levels WHERE LVL = '$lvl2')");
$XPLc = mysqli_fetch_row($XPLc);
if ($XPLc[0] ==1){
	$leveltext = "<font size='1'><progress value='$XPL0' max='$XPL1'></progress><div class='lvltext'>(Till next lvl: $XPL2r)</div></font>";
}
else{
	$leveltext = "<font size='1'><progress value='100' max='100'></progress><div class='lvltext'>(Max level)/div></font>";
}


//enchant
//weapon
$ENC = mysqli_query($db,"SELECT * FROM enchantdrop WHERE Enchant = '$WEPn[plus]'");
$ENC = mysqli_fetch_row($ENC);
if ($ENC[2] > 0){
$enchtex = "<font color='#F59100'>Ench. power: <b>$ENC[2] %</b></font>";
}

//body
$ENCAB = mysqli_query($db,"SELECT * FROM enchantdrop WHERE Enchant = '$ARMBODY[plus]'");
$ENCAB = mysqli_fetch_row($ENCAB);
if ($ENCAB[2] > 0){
$enchtexAB = "<font color='#F59100'>Ench. power: <b>$ENCAB[2] %</b></font>";
$ARMBODYlvl = round($ARMBODY["ilvl"]* $ENCAB[2]/100);
$ARMBODYp = round($ARMBODY["pDEF"]* $ENCAB[2]/100);
$ARMBODYm = round($ARMBODY["mDEF"]* $ENCAB[2]/100);
}

//Gloves
$ENCAG = mysqli_query($db,"SELECT * FROM enchantdrop WHERE Enchant = '$ARMGLOVES[plus]'");
$ENCAG = mysqli_fetch_row($ENCAG);
if ($ENCAG[2] > 0){
$enchtexAG = "<font color='#F59100'>Ench. power: <b>$ENCAG[2] %</b></font>";
$ARMGLOVESlvl = round($ARMGLOVES["ilvl"]* $ENCAG[2]/100);
$ARMGLOVESp = round($ARMGLOVES["pDEF"]* $ENCAG[2]/100);
$ARMGLOVESm = round($ARMGLOVES["mDEF"]* $ENCAG[2]/100);
}

//legs
$ENCAL = mysqli_query($db,"SELECT * FROM enchantdrop WHERE Enchant = '$ARMBOOTS[plus]'");
$ENCAL = mysqli_fetch_row($ENCAL);
if ($ENCAL[2] > 0){
$enchtexAL = "<font color='#F59100'>Ench. power: <b>$ENCAL[2] %</b></font>";
$ARMBOOTSlvl = round($ARMBOOTS["ilvl"]* $ENCAL[2]/100);
$ARMBOOTSp = round($ARMBOOTS["pDEF"]* $ENCAA[2]/100);
$ARMBOOTSm = round($ARMBOOTS["mDEF"]* $ENCAA[2]/100);
}

//amuLet
$ENCAA = mysqli_query($db,"SELECT * FROM enchantdrop WHERE Enchant = '$ACSAMULET[plus]'");
$ENCAA = mysqli_fetch_row($ENCAA);
if ($ENCAA[2] > 0){
$enchtexAA = "<font color='#F59100'>Ench. power: <b>$ENCAA[2] %</b></font>";
$ACSAMULETlvlEN = round($ACSAMULET["ilvl"]* $ENCAA[2]/100);
$ACSAMULEThpBN = round($ACSAMULET["hpBonus"]* $ENCAA[2]/100);
$ACSAMULETdmgBN = round($ACSAMULET["dmgBonus"]* $ENCAA[2]/100);
}

//RING
$ENCAR = mysqli_query($db,"SELECT * FROM enchantdrop WHERE Enchant = '$ACSRING[plus]'");
$ENCAR = mysqli_fetch_row($ENCAR);
if ($ENCAR[2] > 0){
$enchtexAR = "<font color='#F59100'>Ench. power: <b>$ENCAR[2] %</b></font>";
$ACSRINGlvlEN = round($ACSRING["ilvl"]* $ENCAR[2]/100);
$ACSRINGhpBN = round($ACSRING["hpBonus"]* $ENCAR[2]/100);
$ACSRINGdmgBN = round($ACSRING["dmgBonus"]* $ENCAR[2]/100);
}

//stats ACS/ARM
$armorlevel = $ARMBODY["ilvl"] + $ARMGLOVES["ilvl"] + $ARMBOOTS["ilvl"] + $ARMBODYlvl + $ARMBOOTSlvl + $ARMGLOVESlvl;
$tottalParmordef = round($ARMBODY["pDEF"] + $ARMGLOVES["pDEF"] + $ARMBOOTS["pDEF"]+ $ARMBODYp + $ARMBOOTSp + $ARMGLOVESp);
$tottalMarmordef = round($ARMBODY["mDEF"] + $ARMGLOVES["mDEF"] + $ARMBOOTS["mDEF"]+ $ARMBODYm + $ARMBOOTSm + $ARMGLOVESm);
$tottalarmorApsorb = round($ARMBODY["Apsorb"] + $ARMGLOVES["Apsorb"] + $ARMBOOTS["Apsorb"]);

$acclevel = $ACSRING["ilvl"] + $ACSAMULET["ilvl"] + $ACSRINGlvlEN + $ACSAMULETlvlEN;
$tottalACCApsorb = round($ACSRING["Apsorb"] + $ACSAMULET["Apsorb"]);
$tottalXPBonus = round($ACSRING["xpBonus"] + $ACSAMULET["xpBonus"]);
$tottalHPBonus = round($ACSRING["hpBonus"] + $ACSAMULET["hpBonus"]) + $ACSRINGhpBN + $ACSAMULEThpBN;
$tottalDMGBonus = round($ACSRING["dmgBonus"] + $ACSAMULET["dmgBonus"]) + $ACSRINGdmgBN + $ACSAMULETdmgBN;



// physical dmg
$minPdmg = round(($WEPn["pmin"] + ($WEPn["pmin"] * $tottalDMGBonus /100 ))*$CLS[3]);
$minPdmg = $minPdmg + ($minPdmg * $ENC[2] / 100) + ($minPdmg * ($PNT[2]*2)/100);
if (isset($dmgsub)){
	$minPdmg = round(($minPdmg*$dmgsub),0);
}
$maxPdmg = round(($WEPn["pmax"] + ($WEPn["pmax"] * $tottalDMGBonus /100 ))*$CLS[3]);
$maxPdmg = $maxPdmg + ($maxPdmg * $ENC[2] / 100) + ($maxPdmg * ($PNT[2]*2)/100);
if (isset($dmgsub)){
	$maxPdmg = round(($maxPdmg*$dmgsub),0);
}

// magical dmg
$minMdmg = round(($WEPn["mmin"] + ($WEPn["mmin"] * $tottalDMGBonus /100 ))*$CLS[3]);
$minMdmg = $minMdmg + ($minMdmg * $ENC[2] / 100) + ($minMdmg * ($PNT[3]*3)/100);
if (isset($dmgsub)){
	$minMdmg = round(($minMdmg*$dmgsub),0);
}
$maxMdmg = round(($WEPn["mmax"] + ($WEPn["mmax"] * $tottalDMGBonus /100 ))*$CLS[3]);
$maxMdmg = $maxMdmg + ($maxMdmg * $ENC[2] / 100) + ($maxMdmg * ($PNT[3]*3)/100);
if (isset($dmgsub)){
	$maxMdmg = round(($maxMdmg*$dmgsub),0);
}

$lwa = $ACC[3] + $WEPn["ilvl"] + $armorlevel + $acclevel + $PAS[3] + $PAS[6] + $PAS[9] + $PAS[12] + $MOD[9] +$GEM[4];

$order = "UPDATE characters
SET ILVL = '$lwa'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order);

$HP = $ACC[2] * $CLS[2] + ($HP * ($PNT[2])/100);
$HP = $HP + ($HP * ($PNT[2])/100);
$Parmor = round(($tottalParmordef )*$CLS[4]);
$Marmor = round(($tottalMarmordef)*$CLS[4]);



$HP2 = $HP + ($HP * $tottalHPBonus / 100);

if ($WEPn["skill"] == 0){
	$skillTemplate="";
}
else{
	$skillTemplate="<div class='tooltip'>
	<img src='IMG/$Skil[6]' style='width:45px'> 
	<span class='tooltiptext'>$Skil[3]$Skil[4]$Skil[5]% $Skil[1]</span>
</div>";
	if ($Skil[2] == "DMG"){
		$dmg = $dmg + ($dmg*$Skil[3]/100);}
	if ($Skil[2] == "ARM"){
		$Parmor = $Parmor + ($Parmor*$Skil[4]/100);
		$Marmor = $Marmor + ($Marmor*$Skil[4]/100);}
	if ($Skil[2] == "HP"){
		$HP2 = $HP2 + ($HP2*$Skil[5]/100);}
}


if(isset($MODE[1])){

	$mc2 = 1;
	while (isset($MODE[$mc2])){

	if($MODT[$mc2] == "DMG"){
		$minPdmg = $minPdmg+($minPdmg*$MODE[$mc2]/100);
		$maxPdmg = $maxPdmg+($maxPdmg*$MODE[$mc2]/100);
		$minMdmg = $minMdmg+($minMdmg*$MODE[$mc2]/100);
		$maxMdmg = $maxMdmg+($maxMdmg*$MODE[$mc2]/100);
	}
	if($MODT[$mc2] == "DEF"){
		$Parmor = $Parmor+($Parmor*$MODE[$mc2]/100);
		$Marmor = $Marmor+($Marmor*$MODE[$mc2]/100);
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
		$tottalXPBonus = $tottalXPBonus+($tottalXPBonus*$MODE[$mc2]/100);
		
	}
	if($MODT[$mc2] == "ABS"){
		$PAS[5] = $PAS[5]+($PAS[5]*$MODE[$mc2]/100);	
		$PAS[5] = round($PAS[5],0);
	}
	$mc2 = $mc2 + 2;
}
}

// average dmg
$avgP = round(($minPdmg + $maxPdmg) / 2);
$avgM = round(($minMdmg + $maxMdmg) / 2);
$avgD = round(($avgP + $avgM) / 2);


//event stuff
$EventBonus = 1;

$datemin = strtotime(date_create()->format('Y-m-d'));

$Event = mysqli_query($db,"SELECT * FROM Events order by Nr DESC LIMIT 1");
$Event = mysqli_fetch_row($Event);
$datemin2 = strtotime(date($Event[4]));
if ($datemin2 > $datemin){
	
		if($Event[2] == "XP"){
		$EventBonus = $Event[3];
		
		
	}
}



$HP = round(($HP),0);
if (isset($hpsub)){
	$HP = round(($HP*$hpsub),0);
}
$Parmor = round($Parmor);
$Marmor = round($Marmor);
if (isset($defsub)){
	$Parmor = round($Parmor*$defsub);
	$Marmor = round($Marmor*$defsub);
}
$dmg = round($dmg,0);
$HP2 = round($HP2,0);


$_SESSION["HP"] = $HP2;
$_SESSION["GOLD"] = $ACC[4];

//dmg
$_SESSION["DMGPmin"] = $minPdmg;
$_SESSION["DMGPmax"] = $maxPdmg;
$_SESSION["DMGMmin"] = $minMdmg;
$_SESSION["DMGMmax"] = $maxMdmg;
$_SESSION["DMGPAVE"] =  $avgP;
$_SESSION["DMGMAVE"] =  $avgM;
$_SESSION["DMGAVE"] =  $avgD;


$_SESSION["plvl"] = $ACC[3];
$_SESSION["ARM"] = $Parmor;
$_SESSION["MARM"] = $Marmor;
$_SESSION["XPT"] = (1 + (1 * $tottalXPBonus / 100)) * $EventBonus ; //xp bonus
$_SESSION["ENG"] = $CLS[5];
$_SESSION["CRYT"] = $PAS[2]+$WEPn["cryt"];
if (isset($crcsub)){
$_SESSION["CRYT"] = $PAS[2]*$crcsub;
}
$_SESSION["CRYTD"] = $PAS[11];
if (isset($crdsub)){
$_SESSION["CRYTD"] = 1+$PAS[11]*$crdsub;
}
$_SESSION["APS"] = $PAS[5] + $tottalarmorApsorb + $tottalACCApsorb;
$_SESSION["ENG2"] = $PAS[8];
$_SESSION["ILVL"] = $lwa;
$_SESSION["crytext"] = 0;
$_SESSION["crytext2"] = 0;

$ENR = ($ACC[3]*3)+$CLS[5];
$ENR = $ENR + ($ENR * ($PNT[3]*2)/100);
$enr= 5+(5*$PAS[8]/100);
$enr= $enr + ($enr * ($PNT[3]*1)/100);
$enr=round($enr,0);
$ENR=round(($ENR),0);
if (isset($enrsub)){
	$ENR=round(($ENR*$enrsub),0);
}

//energy
$_SESSION["ENERGY"] = $ENR;
$_SESSION["ENERGYM"] = $ENR;
$_SESSION["ENREGEN"] = $enr;

if ($WEPn["efstat"]<>0){
		if ($WEPn["effect"] == "LL"){
	$efftype = "Life Leach";
	}
		if ($WEPn["effect"] == "BL"){
	$efftype = "Bleed Chanse";
	}
		if ($WEPn["effect"] == "BR"){
	$efftype = "Burn Chanse";
	}
		if ($WEPn["effect"] == "FR"){
	$efftype = "Freez Chanse";
	}
		if ($WEPn["effect"] == "ST"){
	$efftype = "Stun Chanse";
	}
		if ($WEPn["effect"] == "SH"){
	$efftype = "Shock Chanse";
	}
		if ($WEPn["effect"] == "BK"){
	$efftype = "Block Chanse";
	}
		if ($WEPn["effect"] == "SM"){
	$efftype = "Summon increase";
	}
		if ($WEPn["effect"] == "PS"){
	$efftype = "Poision increase";
	}
		if ($WEPn["effect"] == "CF"){
	$efftype = "Confusion chanse";
	}
		if ($WEPn["effect"] == "CS"){
	$efftype = "Cursed Soul";
	}
	$eft = "$efftype $WEPn[efstat] %<br>";}
	
	//check for uniq
	if ($WEPn["Rarity"] == "Unique"){
		$unEf = "class='awesome'";
	}

if ($WEPn["Name"] != ""){
	$weaponTemplate="
	<form method='post' action='Enchant.php'>
		<input type='text' name='HASH' value='$WEPn[HASH]' style='display:none'>
		<input type='text' name='TYPE' value='WEP' style='display:none'>
	<b><input type='image' src='IMG/pack/Icon.4_79.png' width='45px' height='45px' class='item".$WEPn['Rarity']."'></b>
	<span class='tooltiptext'>
		<b $unEf class='$WEPn[Rarity]'>$WEPn[Name] + $WEPn[plus] ($WEPn[Rarity])</b>
		<br>
		<b>$WEPn[ilvl] lvl.</b>
		<br>
		<a class='physical'>
			<b>P.dmg: $WEPn[pmin] ~ $WEPn[pmax]</b>
		</a>
		<br>
		<a class='magic'>
			<b>M.dmg: $WEPn[mmin] ~ $WEPn[mmax]</b>
		</a>
		<br>
		Cryt chanse: $WEPn[cryt]
		<br>
		Hit Chanse: $WEPn[HitChanse]
		<br>
		$eft $enchtex
	</span></form>";}
	else{
		$weaponTemplate= "<img src='IMG/pack/none.png' width='45px' height='45px'><span class='tooltiptext'><b>Nothing</b></span>";}




//body
if($ARMBODY["Name"] <> ""){
	$bodyTemplate= "
	<form method='post' action='Enchant.php'>
		<input type='text' name='HASH' value='$ARMBODY[HASH]' style='display:none'>
		<input type='text' name='TYPE' value='ARM' style='display:none'>
	<input type='image' src='IMG/pack/Icon.5_67.png' width='45px' height='45px' class='item".$ARMBODY['Rarity']."'>
	<span class='tooltiptext'>
		<b class='$ARMBODY[Rarty]'>$ARMBODY[Name]</b>
		<br>
		Lvl: $ARMBODY[ilvl]
		<br>
		P.def - $ARMBODY[pDEF]
		<br>
		M.def - $ARMBODY[mDEF]
		<br>
		Apsorb: $ARMBODY[Apsorb]%
		<br>
		Enchant +$ARMBODY[plus]<br>
		$enchtexAB
	</span>
	</form>
	";
}
else{
	$bodyTemplate="<img src='IMG/pack/none.png' width='45px' height='45px'><span class='tooltiptext'><b>Nothing</b></span>";

}

if($ARMBOOTS["Name"] <> ""){
	$legsTemplate= "<form method='post' action='Enchant.php'>
		<input type='text' name='HASH' value='$ARMBOOTS[HASH]' style='display:none'>
		<input type='text' name='TYPE' value='ARM' style='display:none'>
	<input type='image' src='IMG/pack/Icon.3_84.png' width='45px' height='45px' class='item".$ARMBOOTS['Rarity']."'><span class='tooltiptext'><b class='$ARMBOOTS[Rarty]'>$ARMBOOTS[Name]</b><br>Lvl: $ARMBOOTS[ilvl]<br>P.def - $ARMBOOTS[pDEF]<br>M.def - $ARMBOOTS[mDEF]<br>Apsorb: $ARMBOOTS[Apsorb]%<br>Enchant +$ARMBOOTS[plus]<br>$enchtexAL</span>
	</form>
	";
}
else{
	$legsTemplate= "<img src='IMG/pack/none.png' width='45px' height='45px'><span class='tooltiptext'><b>Nothing</b></span>";

}

if($ARMGLOVES["Name"] <> ""){
	$armsTemplate= "<form method='post' action='Enchant.php'>
		<input type='text' name='HASH' value='$ARMGLOVES[HASH]' style='display:none'>
		<input type='text' name='TYPE' value='ARM' style='display:none'>
	<input type='image'  src='IMG/pack/Icon.2_24.png' width='45px' height='45px' class='item".$ARMGLOVES['Rarity']."'><span class='tooltiptext'><b class='$ARMGLOVES[Rarty]'>$ARMGLOVES[Name]</b><br> $ARMGLOVES[ilvl]<br>P.def - $ARMGLOVES[pDEF]<br>M.def - $ARMGLOVES[mDEF]<br>Apsorb: $ARMGLOVES[Apsorb]%<br>Enchant +$ARMGLOVES[plus]<br>$enchtexAG</span>
	</form>
	";
}
else{
	$armsTemplate= "<img src='IMG/pack/none.png' width='45px' height='45px'><span class='tooltiptext'><b>Nothing</b></span>";

}

//acsesories

if($ACSRING["Name"] <> ""){
	$ringTemplate= "<form method='post' action='Enchant.php'>
		<input type='text' name='HASH' value='$ACSRING[HASH]' style='display:none'>
		<input type='text' name='TYPE' value='ACS' style='display:none'>
	<input type='image'   src='IMG/pack/Icon.6_75.png' width='45px' height='45px' class='item".$ACSRING['Rarity']."'><span class='tooltiptext'><b class='$ACSRING[Rarty]'>$ACSRING[Name]</b><br>Lvl: $ACSRING[ilvl]<br>Apsorb: $ACSRING[Apsorb]%<br>HP Bonus:  $ACSRING[hpBonus]%<br>XP Bonus: $ACSRING[xpBonus]%<br>Dmg. Bonus: $ACSRING[dmgBonus]%<br>Enchant +$ACSRING[plus]<br>$enchtexAR</span>
	</form>
	";
}
else{
	$ringTemplate="<img src='IMG/pack/none.png' width='45px' height='45px'><span class='tooltiptext'><b>Nothing</b></span>";

}

if($ACSAMULET["Name"] <> ""){
	$amuletTemplate= "<form method='post' action='Enchant.php'>
		<input type='text' name='HASH' value='$ACSAMULET[HASH]' style='display:none'>
		<input type='text' name='TYPE' value='ACS' style='display:none'>
	<input type='image'   src='IMG/pack/Icon.6_53.png' width='45px' height='45px' class='item".$ACSAMULET['Rarity']."'><span class='tooltiptext'><b class='$ACSAMULET[Rarty]'>$ACSAMULET[Name]</b><br>Lvl: $ACSAMULET[ilvl]<br>Apsorb: $ACSAMULET[Apsorb]%<br>HP Bonus:  $ACSAMULET[hpBonus]%<br>XP Bonus: $ACSAMULET[xpBonus]%<br>Dmg. Bonus: $ACSAMULET[dmgBonus]%<br>Enchant +$ACSAMULET[plus]<br>$enchtexAA</span>
	</form>
	";
}
else{
	$amuletTemplate="<img src='IMG/pack/none.png' width='45px' height='45px'><span class='tooltiptext'><b>Nothing</b></span>";

}



if (!$GEM[3] == ""){
	$gemTemplate="<img src='IMG/pack/Icon.4_32.png' width='45px' height='45px' class='item".$GEM[3]."'>
		<span class='tooltiptext'>
			<b class='#$GEM[3]'>
				$GEM[0]
				<br>
				$GEM[2] Type.
				<br>
			</b>
			<b>Power $GEM[5] %</b>
			<br>
			<b>$GEM[4] lvl.</b>
		</span>

			";}
	else{
		$gemTemplate="<img src='IMG/pack/none.png' width='45px' height='45px'><span class='tooltiptext'><b>Nothing</b></span>";}



$WPN = mysqli_query($db,"SELECT * from DropsWep ORDER BY Worth DESC LIMIT 1");
$WPN = mysqli_fetch_row($WPN);
$KIL = mysqli_query($db,"SELECT * from characters ORDER BY kills DESC LIMIT 1");
$KIL = mysqli_fetch_row($KIL);
$ILVL = mysqli_query($db,"SELECT * from characters ORDER BY ILVL DESC LIMIT 1");
$ILVL = mysqli_fetch_row($ILVL);
$RANK = mysqli_query($db,"SELECT * from characters ORDER BY Rank DESC LIMIT 1");
$RANK = mysqli_fetch_row($RANK);

$apsorb = $tottalarmorApsorb + $PAS[5] + $tottalACCApsorb;





	
if ($WPN[3] == "ff6633"){
	$WPN[3] = "awesome";}


if(isset($mc2)){
$img = $mc2 - 2;}
else{
	$img = 1;}
if ($img < 1){
	$img = 1;}


$modTemplate= "<div id='mini3'><img src='IMG/$img.png'></div>";

$modTemplate.= "<div id='veilvl'>$MOD[9]</div>";


$modTemplate.=  "<div id='veil'>";
if(isset($MODN[1])){

if(isset($MODN[1])){
	$n1 = $MODN[1];
	$e1 = $MODE[1];
	$modTemplate.= "$e1% $n1<br>";
}
if(isset($MODN[3])){
	$n2 = $MODN[3];
	$e2 = $MODE[3];
	$modTemplate.= "$e2% $n2<br>";
}
if(isset($MODN[5])){
	$n3 = $MODN[5];
	$e3 = $MODE[5];
	$modTemplate.= "$e3% $n3<br>";
}
if(isset($MODN[7])){
	$n4 = $MODN[7];
	$e4 = $MODE[7];
	$modTemplate.= "$e4% $n4<br>";
}
$modTemplate.= "</div>";
}
else {
	$modTemplate.= "No mod equiped</div>";
}


$inventoryNumber=0;
$List = mysqli_query($db,"SELECT * FROM Equiped WHERE User = '$User' AND Equiped = '0'  AND Part ='WEP'");
while ($List1 = mysqli_fetch_array($List)){	
	/*if($inventoryNumber/12==floor($inventoryNumber/12)&&$inventoryNumber!=0){//every X make a new line
		$backpackTemplate.="<br>";
	}*/
	$inventoryNumber++;
	if ($List1[1] == "WEP"){
		$WEPI = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$List1[2]' ");
		$WEPIn = mysqli_fetch_assoc($WEPI); //wepaon by colum row
		$sell = ($WEPIn["ilvl"] + $ACC[3]) *10;
		if ($WEPIn["Rarity"] == "Unique"){
			$sellText="$sell Gold and 30 Shards.";
		}
		else{
			$sellText="$sell Gold.";
		}


		$eft = 1 + $eft;

		if ($WEPIn["efstat"]<>0){
				if ($WEPIn["effect"] == "LL"){
			$efftype[$eft] = "Life Leach";
			}
				if ($WEPIn["effect"] == "BL"){
			$efftype[$eft] = "Bleed Chanse";
			}
				if ($WEPIn["effect"] == "BR"){
			$efftype[$eft] = "Burn Chanse";
			}
				if ($WEPIn["effect"] == "FR"){
			$efftype[$eft] = "Freez Chanse";
			}
				if ($WEPIn["effect"] == "ST"){
			$efftype[$eft] = "Stun Chanse";
			}
				if ($WEPIn["effect"] == "SH"){
			$efftype = "Shock Chanse";
			}
				if ($WEPIn["effect"] == "BK"){
			$efftype = "Block Chanse";
			}
				if ($WEPIn["effect"] == "SM"){
			$efftype = "Summon increase";
			}
				if ($WEPIn["effect"] == "PS"){
			$efftype = "Poision increase";
			}
				if ($WEPIn["effect"] == "CF"){
			$efftype = "Confusion chanse";
			}
			if ($WEPIn["effect"] == "CS"){
			$efftype = "Cursed Soul";
			}
			$efto[$eft] = "$efftype[$eft] $WEPIn[efstat] %<br>";}

		if ($WEPIn["skill"] <> 0){
			$sklu[$eft] = "Has Skill!<br>";
		}
			
		if ($WEPIn["Rarity"] == "Unique"){
			$unEf[$eft] = "class='awesome'";
		}
		$wepCompLvl=$wepCompPhyMin=$wepCompPhyMax=$wepCompMagMin=$wepCompMagMax=$wepCompCryt=$wepCompHit="less";

		if($WEPIn[ilvl]>=$WEPn[ilvl]){
			$wepCompLvl="more";
			if($WEPIn[ilvl]==$WEPn[ilvl]){
				$wepCompLvl="same";
			}
		}
		if($WEPIn[pmin]>=$WEPn[pmin]){
			$wepCompPhyMin="more";
			if($WEPIn[pmin]==$WEPn[pmin]){
				$wepCompPhyMin="same";
			}
		}
		if($WEPIn[pmax]>=$WEPn[pmax]){
			$wepCompPhyMax="more";
			if($WEPIn[pmax]==$WEPn[pmax]){
				$wepCompPhyMax="same";
			}
		}
		if($WEPIn[mmin]>=$WEPn[mmin]){
			$wepCompMagMin="more";
			if($WEPIn[mmin]==$WEPn[mmin]){
				$wepCompMagMin="same";
			}
		}
		if($WEPIn[mmax]>=$WEPn[mmax]){
			$wepCompMagMax="more";
			if($WEPIn[mmax]==$WEPn[mmax]){
				$wepCompMagMax="same";
			}
		}
		if($WEPIn[cryt]>=$WEPn[cryt]){
			$wepCompCryt="more";
			if($WEPIn[cryt]==$WEPn[cryt]){
				$wepCompCryt="same";
			}
		}
		if($WEPIn[HitChanse]>=$WEPn[HitChanse]){
			$wepCompHit="more";
			if($WEPIn[HitChanse]==$WEPn[HitChanse]){
				$wepCompHit="same";
			}
		}
		$backpackTemplateWP.= "
		<div class='items'>
			<div id= 'inventoryIcons' class='tooltip'>
				<img src='IMG/pack/Icon.4_79.png' width='45px' height='45px' class='item".$WEPIn['Rarity']."'>
				<span class='tooltiptext'>
					<div class='inventoryStats'>
						<b $unEf[$eft] class='$WEPIn[Rarity]'>$WEPIn[Name] + $WEPIn[plus] ($WEPIn[Rarity])</b>
						<br>
						Lvl: <span class='$wepCompLvl'>$WEPIn[ilvl]</span>
						<br>
						P. dmg: <span class='$wepCompPhyMin'>$WEPIn[pmin]</span> ~ <span class='$wepCompPhyMax'>$WEPIn[pmax]</span>
						<br>
						M. dmg: <span class='$wepCompMagMin'>$WEPIn[mmin]</span> ~ <span class='$wepCompMagMax'>$WEPIn[mmax]</span>
						<br>
						Cryt chanse: <span class='$wepCompCryt'>$WEPIn[cryt]</span>
						<br>
						Hit Chanse: <span class='$wepCompHit'>$WEPIn[HitChanse]</span>
						<br>
						$efto[$eft] $sklu[$eft]
					</div>
					<div class='equipStats'>
						<b $unEf class='$WEPn[Rarity]'>$WEPn[Name] + $WEPn[plus] ($WEPn[Rarity])</b>
						<br>
						<b>$WEPn[ilvl] lvl.</b>
						<br>
						<a class='physical'>
							<b>P.dmg: $WEPn[pmin] ~ $WEPn[pmax]</b>
						</a>
						<br>
						<a class='magic'>
							<b>M.dmg: $WEPn[mmin] ~ $WEPn[mmax]</b>
						</a>
						<br>
						Cryt chanse: $WEPn[cryt]
						<br>
						Hit Chanse: $WEPn[HitChanse]
						<br>
						$eft $enchtex
					</div>
				</span>
			</div>
			<div class='inventoryActions'>
				<form method='post' class='inventor' action='Equip.php'>
					<input style='display:none' type='submit' name='Eqip' value='$WEPIn[HASH]' placeholder='lvl'>
					<input type='text' name='TYPE' value='WEP' style='display:none'>
		        	<input type='image' class='inventoryButton' src='IMG/pack/EQUIP.png' name='Eqip' value='$WEPIn[HASH]'>
					<input style='display:none' type='submit' name='Sell' value='$WEPIn[HASH]' placeholder='lvl'>
						<div class='tooltip'>
							<input type='image' class='inventoryButton' src='IMG/pack/SELL.png' name='Sell' value='$WEPIn[HASH]'>
							<span class='tooltiptext'>$sellText</span>
						</div>
				</form>
				<input id ='button$eft' type='image' class='inventoryButton' src='IMG/pack/TRADE.png' onclick='show($eft)'>			  
				<form id='asd$eft' style='display:none' method='post'  action='auctionhouse.php'>
					Asking price: <input type='number' name='price' value='0'>
					<input type='text' name='HASH' value='$WEPIn[HASH]' style='display:none'>
					<input type='text' name='TYPE' value='WEP' style='display:none'>
		 			<input type='submit' value='Submit'>
				</form>
			</div>
		</div>
					";
	}
}
//invetor ARMOR
$List = mysqli_query($db,"SELECT * FROM Equiped WHERE User = '$User' AND Equiped = '0'  AND Part ='ARM'");
while ($List1 = mysqli_fetch_array($List)){	
	if ($List1[1] == "ARM"){
		$ARMIr = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$List1[2]' ");
		$ARMIn = mysqli_fetch_assoc($ARMIr); //armor by colum row
		$sell = ($ARMIn["ilvl"] + $ACC[3]) *10;

		$eft = 1 + $eft;
			
		if ($ARMIn["Rarity"] == "Unique"){
			$unEf[$eft] = "class='awesome'";
			$sellText="$sell Gold and 30 Shards.";
		}
		else{
			$unEf[$eft] ="";
			$sellText="$sell Gold.";
		}
		if($ARMIn["Part"]=="BODY"){
			$ARMEQUIP=$ARMBODY;
			$armIcon="5_67";
		}
		else if($ARMIn["Part"]=="LEGS"){
			$ARMEQUIP=$ARMBOOTS;
			$armIcon="3_84";
		}
		else if($ARMIn["Part"]=="GLOVES"){
			$ARMEQUIP=$ARMGLOVES;
			$armIcon="2_24";
		}
		$armCompLvl=$armCompPhy=$armCompMag=$armCompAbs=$armCompEnch="less";

		if($ARMIn[ilvl]>=$ARMEQUIP[ilvl]){
			$armCompLvl="more";
			if($ARMIn[ilvl]==$ARMEQUIP[ilvl]){
				$armCompLvl="same";
			}
		}
		if($ARMIn[pDEF]>=$ARMEQUIP[pDEF]){
			$armCompPhy="more";
			if($ARMIn[pDEF]==$ARMEQUIP[pDEF]){
				$armCompPhy="same";
			}
		}
		if($ARMIn[mDEF]>=$ARMEQUIP[mDEF]){
			$armCompMag="more";
			if($ARMIn[mDEF]==$ARMEQUIP[mDEF]){
				$armCompMag="same";
			}
		}
		if($ARMIn[Apsorb]>=$ARMEQUIP[Apsorb]){
			$armCompArb="more";
			if($ARMIn[Apsorb]==$ARMEQUIP[Apsorb]){
				$armCompArb="same";
			}
		}
		if($ARMIn[plus]>=$ARMEQUIP[plus]){
			$armCompEnch="more";
			if($ARMIn[plus]==$ARMEQUIP[plus]){
				$armCompEnch="same";
			}
		}

		
		$backpackTemplateAR.= "
		<div class='items'>
			<div class='tooltip'>
				<img src='IMG/pack/Icon.".$armIcon.".png' width='45px' height='45px' class='item".$ARMIn['Rarity']."'>
				<span class='tooltiptext'>
					<div class='inventoryStats'>
						<b class='$ARMIn[Rarty]'>$ARMIn[Name]</b>
						<br>
						Lvl: <span class='$armCompLvl'>$ARMIn[ilvl]</span>
						<br>
						P.def - <span class='$armCompPhy'>$ARMIn[pDEF]</span>
						<br>
						M.def - <span class='$armCompMag'>$ARMIn[mDEF]</span>
						<br>
						Absorb: <span class='$armCompArb'>$ARMIn[Apsorb]%</span>
						<br>
						Enchant +<span class='$armCompEnch'>$ARMIn[plus]</span>
					</div>
					<div class='equipStats'>
						<b class='$ARMEQUIP[Rarty]'>$ARMEQUIP[Name]</b>
						<br>
						Lvl: $ARMEQUIP[ilvl]
						<br>
						P.def - $ARMEQUIP[pDEF]
						<br
						>M.def - $ARMEQUIP[mDEF]
						<br>
						Apsorb: $ARMEQUIP[Apsorb]%
						<br>
						Enchant +$ARMEQUIP[plus]
					</div>
				</span>
			</div>
			<div class='inventoryActions'>
				<form method='post' class='inventor' action='Equip.php'>
					<input style='display:none' type='submit' name='Eqip' value='$ARMIn[HASH]' placeholder='lvl'>
					<input type='text' name='TYPE' value='ARM' style='display:none'>
		        	<input type='image' class='inventoryButton' src='IMG/pack/EQUIP.png' name='Eqip' value='$ARMIn[HASH]'>
					<input style='display:none' type='submit' name='Sell' value='$ARMIn[HASH]' placeholder='lvl'>
						<div class='tooltip'>
							<input type='image' class='inventoryButton' src='IMG/pack/SELL.png' name='Sell' value='$ARMIn[HASH]'>
							<span class='tooltiptext'>$sellText</span>
						</div>
				</form>
				<input id ='button$eft' type='image' class='inventoryButton' src='IMG/pack/TRADE.png' onclick='show($eft)'>			  
				<form id='asd$eft' style='display:none' method='post'  action='auctionhouse.php'>
					Asking price: <input type='number' name='price' value='0'>
					<input type='text' name='HASH' value='$ARMIn[HASH]' style='display:none'>
					<input type='text' name='TYPE' value='ARM' style='display:none'>
		 			<input type='submit' value='Submit'>
				</form>
			</div>
		</div>";
	}

}
//ACSESORYS
$List = mysqli_query($db,"SELECT * FROM Equiped WHERE User = '$User' AND Equiped = '0'  AND Part ='ACS'");
while ($List1 = mysqli_fetch_array($List)){	
	if ($List1[1] == "ACS"){
		$ACSI = mysqli_query($db,"SELECT * FROM DropsAcs where HASH = '$List1[2]' ");
		$ACSIn = mysqli_fetch_assoc($ACSI); //armor by colum row
		$sell = ($ACSIn["ilvl"] + $ACC[3]) *10;

		$eft = 1 + $eft;
			
		if ($ACSIn["Rarity"] == "Unique"){
			$unEf[$eft] = "class='awesome'";
			$sellText="$sell Gold and 30 Shards.";
		}
		else{
			$unEf[$eft] ="";
			$sellText="$sell Gold.";
		}
		if ($ACSIn["Part"] == "AMUL"){
			$ACSEQUIP=$ACSAMULET;
			$acsIcon="6_53";
		}
		else if ($ACSIn["Part"] == "RING"){
			$ACSEQUIP=$ACSRING;
			$acsIcon="6_75";
		}
		$acsCompLvl=$acsCompHp=$acsCompXp=$acsCompAbs=$acsCompEnch=$acsCompDmg="less";

		if($ACSIn[ilvl]>=$ACSEQUIP[ilvl]){
			$acsCompLvl="more";
			if($ACSIn[ilvl]==$ACSEQUIP[ilvl]){
				$acsCompLvl="same";
			}
		}
		if($ACSIn[Apsorb]>=$ACSEQUIP[Apsorb]){
			$acsCompAbs="more";
			if($ACSIn[Apsorb]==$ACSEQUIP[Apsorb]){
				$acsCompAbs="same";
			}
		}
		if($ACSIn[hpBonus]>=$ACSEQUIP[hpBonus]){
			$acsCompHp="more";
			if($ACSIn[hpBonus]==$ACSEQUIP[hpBonus]){
				$acsCompHp="same";
			}
		}
		if($ACSIn[xpBonus]>=$ACSEQUIP[xpBonus]){
			$acsCompXp="more";
			if($ACSIn[xpBonus]==$ACSEQUIP[xpBonus]){
				$acsCompXp="same";
			}
		}
		if($ACSIn[dmgBonus]>=$ACSEQUIP[dmgBonus]){
			$acsCompDmg="more";
			if($ACSIn[dmgBonus]==$ACSEQUIP[dmgBonus]){
				$acsCompDmg="same";
			}
		}
		if($ACSIn[plus]>=$ACSEQUIP[plus]){
			$acsCompEnch="more";
			if($ACSIn[plus]==$ACSEQUIP[plus]){
				$acsCompEnch="same";
			}
		}

		$backpackTemplateAC.=  "
		<div class='items'>
		<div class='tooltip'>
			<img src='IMG/pack/Icon.".$acsIcon.".png' width='45px' height='45px' class='item".$ACSIn['Rarity']."'>
			<span class='tooltiptext'>
				<div class='inventoryStats'>
					<b class='$ACSIn[Rarty]'>$ACSIn[Name]</b>
					<br>
					Lvl: <span class='$acsCompLvl'>$ACSIn[ilvl]</span>
					<br>
					Apsorb: <span class='$acsCompAbs'>$ACSIn[Apsorb]%</span>
					<br>
					HP Bonus:  <span class='$acsCompHp'>$ACSIn[hpBonus]</span>
					<br>
					XP Bonus: <span class='$acsCompXp'>$ACSIn[xpBonus]%</span>
					<br>
					Dmg. Bonus: <span class='$acsCompDmg'>$ACSIn[dmgBonus]%</span>
					<br>
					Enchant +<span class='$acsCompEnch'>$ACSIn[plus]</span>
				</div>
				<div class='equipStats'>
					<b class='$ACSEQUIP[Rarty]'>$ACSEQUIP[Name]</b>
					<br>
					Lvl: $ACSEQUIP[ilvl]
					<br>
					Apsorb: $ACSEQUIP[Apsorb]%
					<br>
					HP Bonus:  $ACSEQUIP[hpBonus]
					<br>
					XP Bonus: $ACSEQUIP[xpBonus]%
					<br>
					Dmg. Bonus: $ACSEQUIP[dmgBonus]%
					<br>
					Enchant +$ACSEQUIP[plus]
				</div>
			</span>
		</div>
		<div class='inventoryActions'>
				<form method='post' class='inventor' action='Equip.php'>
					<input style='display:none' type='submit' name='Eqip' value='$ACSIn[HASH]' placeholder='lvl'>
					<input type='text' name='TYPE' value='ACS' style='display:none'>
		        	<input type='image' class='inventoryButton' src='IMG/pack/EQUIP.png' name='Eqip' value='$ACSIn[HASH]'>
					<input style='display:none' type='submit' name='Sell' value='$ACSIn[HASH]' placeholder='lvl'>
						<div class='tooltip'>
							<input type='image' class='inventoryButton' src='IMG/pack/SELL.png' name='Sell' value='$ACSIn[HASH]'>
							<span class='tooltiptext'>$sellText</span>
						</div>
				</form>
				<input id ='button$eft' type='image' class='inventoryButton' src='IMG/pack/TRADE.png' onclick='show($eft)'>			  
				<form id='asd$eft' style='display:none' method='post'  action='auctionhouse.php'>
					Asking price: <input type='number' name='price' value='0'>
					<input type='text' name='HASH' value='$ACSIn[HASH]' style='display:none'>
					<input type='text' name='TYPE' value='ACS' style='display:none'>
		 			<input type='submit' value='Submit'>
				</form>
			</div>
	</div>";
	}
	
}
$List = mysqli_query($db,"SELECT * FROM Equiped WHERE User = '$User' AND Equiped = '0'  AND Part ='ITM'");
while ($List1 = mysqli_fetch_array($List)){	
	if ($List1[1] == "ITM"){
		$ITM = mysqli_query($db,"SELECT * FROM DropsItm where HASH = '$List1[2]' ");
		$ITMn = mysqli_fetch_assoc($ITM); //item by colum row
		
		$sell = ($ITMn["Value"] * $ACC[3]) * 5;
		
		if ($ITMn["EFT"] == "XP" or $ITMn["EFT"] == "GOLD" or $ITMn["EFT"] == "SHRD" or $ITMn["EFT"] == "MOD" or $ITMn["EFT"] == "ENC" or $ITMn["EFT"] == "JOKE"){ //if usable item
		if ($ITMn["EFT"] == "MOD"){
			$extratxt = "min mod lvl";}
			
		$backpackTemplateIT.=  "<div class='items'>
		<div class='tooltip'>
			<img src='IMG/pack/".$ITMn[Icon].".png' width='45px' height='45px'>
			<span class='tooltiptext'>
				<div class='inventoryStats'>
					<b> $ITMn[Name] - $extratxt $ITMn[Value]</b>
					</div>
			</span>
		</div>
		<div class='inventoryActions'>
				<form method='post' class='inventor' action='Equip.php'>
					<input type='text' name='TYPE' value='ITM' style='display:none'>
					<input type='image' src='IMG/pack/USE.png' width='30px' height='15px' name='ITMS' value='$ITMn[HASH]' class='inventoryButton2'>
					<div class='tooltip'>
						<input type='text' name='TYPE' value='ITM' style='display:none'>
						<input type='image'  class='inventoryButton' src='IMG/pack/SELL.png' name='Sell' value='$ITMn[HASH]'>
						<span class='tooltiptext'>$sell</span>
					</div>
				</form>
			</div>
	</div>";}
	else{
		$backpackTemplateIT.=  "<div class='items'>
		<div class='tooltip'>
			<img src='IMG/pack/".$ITMn[Icon].".png' width='45px' height='45px'>
			<span class='tooltiptext'>
				<div class='inventoryStats'>
					<b> $ITMn[Name] - $ITMn[Value]%</b>
					</div>
			</span>
		</div>
		<div class='inventoryActions'>
				<form method='post' class='inventor' action='Equip.php'>
						<div class='tooltip'>
							<input type='text' name='TYPE' value='ITM' style='display:none'>
							<input type='image' class='inventoryButton' src='IMG/pack/SELL.png' name='Sell' value='$ITMn[HASH]'>
							<span class='tooltiptext'>$sell</span>
						</div>
				</form>
			</div>
	</div>";}
		
	}
	
}

 //Party
$PartyS = mysqli_query($db,"SELECT * FROM Party where PL1 = '$User' or PL2 = '$User' or PL3 = '$User' or PL4 = '$User'  ");
$Party = mysqli_fetch_assoc($PartyS);

$PartyMons = mysqli_query($db,"SELECT * FROM PartyMonsters where PartyID = '$Party[ID]' ");
$PartyMonsF = mysqli_fetch_assoc($PartyMons);

if ($Party["PL1"] == $User){
	$PLnr = "PL1";}
if ($Party["PL2"] == $User){
	$PLnr = "PL2";}
if ($Party["PL3"] == $User){
	$PLnr = "PL3";;}
if ($Party["PL4"] == $User){
	$PLnr = "PL4";}
		

		$countPL = 0;
	if ($Party["PL1"] <> ""){
		$countPL += 1 ;}
	if ($Party["PL2"] <> ""){
		$countPL += 1 ;}
	if ($Party["PL3"] <> ""){
		$countPL += 1 ;}
	if ($Party["PL4"] <> ""){
		$countPL += 1 ;}

	
	//Party Narei
if ( $PLnr == "PL1" or $PLnr == "PL2" or $PLnr == "PL3" or $PLnr == "PL4"){
	
	$inPArty = "In Party: $Party[PL1], $Party[PL2], $Party[PL3], $Party[PL4]<br>Killed: <b>$Party[MobsKilled] monsters.</b> <br>";}
else {
	$inPArty = "Not in party.";}
	
if ($inPArty == "Not in party."){
	
		$partyButtonC = "<section class='actionP'>
		<form method='post' action='test.php'>
			<input hidden='' type='text' name='CP' value='1' placeholder='Continue Fight'>
			<p class='submit'>
				<input type='submit' name='commit' value='Create Party'>
			</p>
		</form>
	</section>";
	
		$partyButtonJ = "<section class='actionP'>
		<form method='post' action='test.php'>
			<input hidden='' type='text' name='JP' value='1' placeholder='Continue Fight'>
			<p class='submit'>
				<input type='submit' name='commit' value='Join Party'>
			</p>
		</form>
	</section>";
}
	




//tikrina ar yra party mobas ir ar užtenka žmoniu 
else if ($PartyMonsF["ID"] <> 0 and $countPL >= 2){

	//FIGHT MOB
	$partyButton = "<section class='actionP'>
		<form method='post' action='test.php'>
			<input hidden='' type='text' name='lvl' value='100' placeholder='Continue Fight'>
			<p class='submit'>
				<input type='submit' name='commit' value='Continue Fight'>
			</p>
		</form>
	</section>";}
else if ($countPL >= 2){
	//CREATE MOB
	$partyButton = "<section class='actionP'>
		<form method='post' action='test.php'>
			<input hidden='' type='text' name='CRT' value='1' placeholder='Start Fight'>
			<p class='submit'>
				<input type='submit' name='commit' value='Start Fight'>
			</p>
		</form>
	</section>";}
else {
	$partyTEXT = "Need more people in party";
}

if ($countPL >=1){
	if ($Party["PL1"] != "$User"){
			$partyButtonL = "<section class='actionP'>
		<form method='post' action='party.php'>
			<input hidden='' type='text' name='LP' value='1' placeholder='Continue Fight'>
			<p class='submit'>
				<input type='submit' name='commit' value='Leave Party'>
			</p>
		</form>
	</section>";}
	
		else{
				$partyButtonL = "<section class='actionP'>
		<form method='post' action='party.php'>
			<input hidden='' type='text' name='PD' value='1' placeholder='Continue Fight'>
			<p class='submit'>
				<input type='submit' name='commit' value='Disasmble Party'>
			</p>
		</form>
	</section>";}
}
$_SESSION["PartySpot"] = $countPL;
$_SESSION["PartyID"] = $Party["ID"];
$PartyTemplate="
	$inPArty
	$partyTEXT
	$partyButton
	$partyButtonC
	$partyButtonJ
	$partyButtonL
";



//gold rounding
if ($ACC[4] < 1000){
$gold = round($ACC[4]);
}
if ($ACC[4] >= 1000){
$gold = round($ACC[4]/1000,1);
$gold .= "k.";}
if ($ACC[4] >= 1000000){
$gold = round($ACC[4]/1000000,1);
$gold .= "kk.";}
if ($ACC[4] >= 1000000000){
$gold = round($ACC[4]/1000000000,1);
$gold .= "kkk.";}

//check for uniq name
if ($ACC[12] == "itemUnique"){
	$uniqCLS = "awesome";
	$ACC[12] = "#33ccff";}


$statsTemplate = "
<font class='stats'>User:</font>
<div class='tooltip'>
	<font color='$ACC[12]'>
		<b class='$uniqCLS'>$User</b>
		<span class='tooltiptext'>$ACC[13]</span>
	</font>
</div> 
$pointsLvlUp
<br>
<font class='stats'>Class:</font>
<div class='tooltip'>
	<b>$CLS[1]</b>
	<span class='tooltiptext'>$CLS[9]</span>
</div>
<br>
<div id='picture'>
	<img src='IMG/av/$CLS[10].jpg' style='width:50px;height:50px;'>
	$pasiveBut
</div>
<br>
<font class='stats'>LVL:</font> 
<b>$ACC[3]</b>
$leveltext
<br>
<font class='stats'>Average DMG:</font>
<b>
	<font class='physical'>~$avgP</font>
	/
	<font class='magic'>~$avgM</font>
</b>
<br>
<font class='stats'>HP:</font> 
<font class='health'><b>$HP2</b></font>
<br>
<font class='stats'>ENR:</font> 
<b>
	<font class='energy'>
		$ENR
		<font size='1'>($enr per turn)</font>
	</font>
</b>
<br>
<font class='stats'>DEF:</font> 
<b>
	<font class='physicalArmor'>$Parmor</font>
	/
	<font class='magicArmor'>$Marmor</font>
</b>
<br>
<font class='stats'>Gold:</font> 
<b>
	<font class='gold'>$gold</font>
</b>
<br>
<font class='stats'>Shards:</font>
<b>
	<font class='shards'>$ACC[15]</font>
</b>
<br>
<font class='stats'>Item LVL:</font> 
<b>$lwa</b>
<br>
<b>
	<font class='stats'>Points:</font>
	<font class='physical'>$PNT[2] STR</font>
	- 
	<font class='magic'>$PNT[3] INT</font>
</b>
<br>

<div class='tooltip'>
	<img src='IMG/cryt.jpg' style='width:45px;height:45px;'> 
	<span class='tooltiptext'>
		LVL: $PAS[3]
		<br>
		XP: $PAS[1]/$plvl1[1]
		<br>
		$PAS[2]% Cryt chanse
	</span>
</div>
<div class='tooltip'>
	<img src='IMG/crytd.jpg' style='width:45px;height:45px;'>
	<span class='tooltiptext'>
		LVL: $PAS[12]
		<br>
		XP: $PAS[10]/$plvl4[1]
		<br>
		$PAS[11]% Cryt damage increase
	</span>
</div>
<div class='tooltip'>
	<img src='IMG/apsorb.jpg' style='width:45px;height:45px;'> 
	<span class='tooltiptext'>
		LVL: $PAS[6]
		<br>
		XP: $PAS[4]/$plvl2[1]
		<br>
		$apsorb% Absorb
	</span>
</div>
<div class='tooltip'>
	<img src='IMG/ener.jpg' style='width:45px;height:45px;'> 
	<span class='tooltiptext'>
		LVL: $PAS[9]
		<br>
		XP: $PAS[7]/$plvl3[1]
		<br>
		$PAS[8]% Bonus energy regen
	</span>
</div>
$skillTemplate
";
$equipTemplate ="
<img src='IMG/body.png' id='equipShadow'>
<div id='equipWeapon' class='tooltip'>
	$weaponTemplate
</div>
<div id='equipBody' class='tooltip'>
	$bodyTemplate
</div>
<div id='equipLegs' class='tooltip'>
	$legsTemplate
</div>
<div id='equipArms' class='tooltip'>
	$armsTemplate
</div>
<div id='equipAmulet' class='tooltip'>
	$amuletTemplate
</div>
<div id='equipRing' class='tooltip'>
	$ringTemplate
</div>
<div id='equipGem' class='tooltip'>
	$gemTemplate
</div>
<div id='equipMod'>
	$modTemplate
</div>
";


//old PVP rank
/*Highest PVP Rank: <font color='$RANK[12]'><b>$RANK[11]</font> - by <font color='$RANK[12]'>$RANK[0]</font></b>*/

$socialTemplate="
<div id='personal'>
Totall Kills
<br>
<b>$ACC[6]</b>
<br>
<br>
<b>PVP Rank:</b>
<br>
<b><font class='$ACC[12]'>$ACC[11]</font></b>
<section class='container'>
    <p class='submit'>
    	<form method='post' action='achv.php'>
          <input type='submit' name='commit3' value='Achievments'>
     	 </form></p></section>
$onlineText

</div>
<div id='leaderboard'>
	Highest item lvl: <b>$ILVL[9] - by <font color='$ILVL[12]'>$ILVL[0]</font></b>
	<br>
	Most kills: <b>$KIL[6] - by <font color='$KIL[12]'>$KIL[0]</font></b>
	<br>
	
</div>
<div id='chat'>
	<iframe height='45px' width='176px' src='message.php'></iframe>
</div>
<div id='party'>
	$PartyTemplate
</div>
";

$actionsTemplate="
<section class='actionButtons'>
	<form method='post' action='fightNew.php'>
		<input hidden='' type='text' name='lvl' value='100' placeholder='Fight Boss'>
		<input type='submit' name='commit' value='NewFight'>
	</form>
</section>
<section class='actionButtons'>
	<form method='post' action='wBoss.php'>
		<input hidden='' type='text' name='lvl' value='100' placeholder='Fight Boss'>
		<input type='submit' name='commit' value='World Boss'>
	</form>
</section>
<section class='actionButtons'>
	<form method='post' action='vale.php'>
		<input hidden='' type='text' name='lvl2' value='Upgrade' placeholder='Reroll Mod'>
		<input type='submit' name='commit2' value='Reroll Mod'>

  	</form>
</section>
<section class='actionButtons'>
	<form method='post' action='loot.php'>
		<input hidden='' type='text' name='lvl2' value='Upgrade' placeholder='Reroll Mod'>
		<input type='submit' name='commit2' value='Loot Shards'>

  	</form>
</section>
<section class='actionButtons'>
	<form method='post' action='auctionhouse.php'>
		<input hidden='' type='text' name='' value='' placeholder='Auction House'>
		<input type='submit' name='commit' value='Auction House'>
	</form>
</section>
";

//read last selected
if (isset($_COOKIE["backpack"])){
	$selected = $_COOKIE["backpack"];}

if ($selected == 0){
	$opt = "<option value='0'selected>No sorting</option>
<option value='1'>Weapons</option>
<option value='2'>Armors</option>
<option value='3'>Acsesories</option>
<option value='4'>Items</option>";}
if ($selected == 1){
	$opt = "<option value='0'>No sorting</option>
<option value='1' selected>Weapons</option>
<option value='2'>Armors</option>
<option value='3'>Acsesories</option>
<option value='4'>Items</option>";}
if ($selected == 2){
	$opt = "<option value='0'>No sorting</option>
<option value='1'>Weapons</option>
<option value='2' selected>Armors</option>
<option value='3'>Acsesories</option>
<option value='4'>Items</option>";}
if ($selected == 3){
	$opt = "<option value='0'>No sorting</option>
<option value='1'>Weapons</option>
<option value='2'>Armors</option>
<option value='3' selected>Acsesories</option>
<option value='4'>Items</option>";}
if ($selected == 4){
	$opt = "<option value='0'>No sorting</option>
<option value='1'>Weapons</option>
<option value='2'>Armors</option>
<option value='3'>Acsesories</option>
<option value='4' selected>Items</option>";}
	

$inventoryTemplate="
<div id='inventoryHead'>
<font class='sectionTitle'>Backpack: </font>

<select id='test' name='form_select' onchange='showDiv(this)' >
$opt
</select>


</div>
<div style='display:block;' id='backpackWP' >
	$backpackTemplateWP
</div>
<div id='backpackAR' style='display:block;'>
	$backpackTemplateAR
</div>
<div id='backpackAC' style='display:block;'>
	$backpackTemplateAC
</div>
<div id='backpackIT' style='display:block;'>
	$backpackTemplateIT
</div>	
";
mysqli_close($db);
include('template.php');
?>

