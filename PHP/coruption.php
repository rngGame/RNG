<?php

if ($_POST[COR] == 3){
	
$E1 = $MOD1[0];
$S1 = $E1r;

$E2 = $MOD2[0];
$S2 = $E2r;

$E3 = $MOD3[0];
$S3 = $E3r;

$E4 = $MOD4[0];
$S4 = $E4r;

	
	$MDL = mysqli_query($db,"SELECT * FROM modlist where User = '$User' ");
	$ITM = mysqli_fetch_assoc($MDL);
	
	
	if ($ITM[E1] > 1){$modNR = 2;}
	if ($ITM[E2] > 1){$modNR = 3;}
	if ($ITM[E3] > 1){$modNR = 4;}
	if ($ITM[E4] > 1){$modNR = 5;}
	$modNR = rand(1,$modNR);
	
	if ($modNR == 1){
		
		$MDC1 = mysqli_query($db,"SELECT * FROM mods where ID = '$ITM[E1]' ");
		$MDC1 = mysqli_fetch_row($MDC1);	
		
		$MDC2 = mysqli_query($db,"SELECT * FROM mods where ID = '$E1' ");
		$MDC2 = mysqli_fetch_row($MDC2);
		
		$_SESSION[info] = "Changed: $MDC1[1] $ITM[S1] -> $MDC2[1] $S1 %";
		
		$order = "UPDATE modlist
	  	SET S1 = '$S1', E1 = '$E1', COR = '1'
	  	WHERE `User` = '$User'";
		$result = mysqli_query($db, $order);
		
	}
	if ($modNR == 2){

		$MDC1 = mysqli_query($db,"SELECT * FROM mods where ID = '$ITM[E2]' ");
		$MDC1 = mysqli_fetch_row($MDC1);	
		
		$MDC2 = mysqli_query($db,"SELECT * FROM mods where ID = '$E2' ");
		$MDC2 = mysqli_fetch_row($MDC2);
		
		$_SESSION[info] = "Changed: $MDC1[1] $ITM[S2] -> $MDC2[1] $S2 %";
		
		$order = "UPDATE modlist
	  	SET S2 = '$S2', E2 = '$E2', COR = '1'
	  	WHERE `User` = '$User'";
		$result = mysqli_query($db, $order);
		
	}
	if ($modNR == 3){
		
		$MDC1 = mysqli_query($db,"SELECT * FROM mods where ID = '$ITM[E3]' ");
		$MDC1 = mysqli_fetch_row($MDC1);	
		
		$MDC2 = mysqli_query($db,"SELECT * FROM mods where ID = '$E3' ");
		$MDC2 = mysqli_fetch_row($MDC2);
		
		$_SESSION[info] = "Changed: $MDC1[1] $ITM[S3] -> $MDC2[1] $S3 %";
		
		$order = "UPDATE modlist
	  	SET S3 = '$S3', E3 = '$E3', COR = '1'
	  	WHERE `User` = '$User'";
		$result = mysqli_query($db, $order);
		
	}
	if ($modNR == 4){
		
		$MDC1 = mysqli_query($db,"SELECT * FROM mods where ID = '$ITM[E4]' ");
		$MDC1 = mysqli_fetch_row($MDC1);	
		
		$MDC2 = mysqli_query($db,"SELECT * FROM mods where ID = '$E4' ");
		$MDC2 = mysqli_fetch_row($MDC2);
		
		$_SESSION[info] = "Changed: $MDC1[1] $ITM[S4] -> $MDC2[1] $S4 %";
		
		$order = "UPDATE modlist
	  	SET S4 = '$S4', E4 = '$E4', COR = '1'
	  	WHERE `User` = '$User'";
		$result = mysqli_query($db, $order);
		
	}
	if ($modNR == 5){
		
		$nrm = rand(1,4);
		$exm[1] = $S1;
		$exm[2] = $S2;
		$exm[3] = $S3;
		$exm[4] = $S4;
		
		$exmn[1] = $E1;
		$exmn[2] = $E2;
		$exmn[3] = $E3;
		$exmn[4] = $E4;
		
		$MDC1 = mysqli_query($db,"SELECT * FROM mods where ID = '$exmn[$nrm]' ");
		$MDC1 = mysqli_fetch_row($MDC1);	
		

		$_SESSION[info] = "Added 5th mod: $MDC1[1] $exm[$nrm] %";
		
		$order = "UPDATE modlist
	  	SET CE2 = '$exm[$nrm]', CE1 = '$exmn[$nrm]', COR = '1'
	  	WHERE `User` = '$User'";
		$result = mysqli_query($db, $order);
		
	}
	
	
}

//if item corupt
else{


if ($TYPE == "WEP"){
$WEP = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$HASH' ");
$ITM = mysqli_fetch_assoc($WEP);
}
if ($TYPE == "ARM"){
$WEP = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$HASH' ");
$ITM = mysqli_fetch_assoc($WEP);
}
if ($TYPE == "ACS"){
$WEP = mysqli_query($db,"SELECT * FROM DropsAcs where HASH = '$HASH' ");
$ITM = mysqli_fetch_assoc($WEP);
}
if ($TYPE == "SKL"){
$WEP = mysqli_query($db,"SELECT * FROM DropsSkl where HASH = '$HASH' ");
$ITM = mysqli_fetch_assoc($WEP);
}

//weapons
if ($TYPE == "WEP"){
	$corupt = rand(1,7);
	
	if ($corupt == 7 and $ITM[efstat] <> 0){
		$effect2 = "Effect coruption";
		$efstat2 = rand(7,18)/10;
		$Name = "Powered";
		
		$st1 = round($ITM[efstat] * $efstat2);
		$_SESSION[info] = "Effect: $ITM[efstat] -> $st1";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsWep
			SET efstat = '$st1', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);	
	}
	else {$corupt = rand (1,6);}
	
		if ($corupt == 6 and $ITM[skill] <> ""){
		$effect2 = "Skill coruption";
		$efstat2 = rand(1,17);
		$Name = "Changed";
		
		
		$SKKL = mysqli_query($db,"SELECT * FROM iskills where ID = '$ITM[skill]' ");
		$SKL = mysqli_fetch_assoc($SKKL);
		
		$SKKL2 = mysqli_query($db,"SELECT * FROM iskills where ID = '$efstat2' ");
		$SKL2 = mysqli_fetch_assoc($SKKL2);
		
		$_SESSION[info] = "Skill: $SKL[Name] -> $SKL2[Name]";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsWep
			SET skill = '$efstat2', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);	
	}
	else {$corupt = rand (1,5);}

	
	
	
	
	if ($corupt == 1){
		$effect2 = "Physical Coruption";
		$efstat2 = rand(9,12)/10;
		$Name = "Rought";
		
		$st1 = round($ITM[pmin] * $efstat2);
		$st2 = round($ITM[pmax] * $efstat2);
		$_SESSION[info] = "Min P-Dmg: $ITM[pmin] -> $st1<br>Max P-Dmg: $ITM[pmax] -> $st2";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsWep
			SET pmin = '$st1', pmax = '$st2', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);	
	}
	if ($corupt == 2){
		$effect2 = "Magickal coruption";
		$efstat2 = rand(9,12)/10;
		$Name = "Magick";
		
		$st1 = round($ITM[mmin] * $efstat2);
		$st2 = round($ITM[mmax] * $efstat2);
		$_SESSION[info] = "Min M-Dmg: $ITM[mmin] -> $st1<br>Max M-Dmg: $ITM[mmax] -> $st2";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsWep
			SET mmin = '$st1', mmax = '$st2', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);	
	}
	if ($corupt == 3){
		$effect2 = "Crit chanse coruption";
		$efstat2 = rand(0,50);
		$Name = "Pointy";
		$_SESSION[info] = "Cryt: $ITM[cryt] -> $efstat2";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsWep
			SET cryt = '$efstat2', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);	
	}
	if ($corupt == 4){
		$effect2 = "Hit chanse coruption";
		$efstat2 = rand(95,100);
		$Name = "Marked";
		$_SESSION[info] = "Hit Chance: $ITM[HitChanse] -> $efstat2";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsWep
			SET HitChanse = '$efstat2', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);	
	}
	if ($corupt == 5){
		$effect2 = "Enchant coruption";
		$efstat2 = rand(0,29);
		$Name = "Enchanted";
		$_SESSION[info] = "Enchant: $ITM[plus] -> $efstat2";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsWep
			SET plus = '$efstat2', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);	
	}


}
	
//armors
if ($TYPE == "ARM"){
	$corupt = rand(1,5);
	
	if ($corupt == 5 and $ITM[efstat] <> 0){
		$effect2 = "Effect coruption";
		$efstat2 = rand(8,15)/10;
		$Name = "Powered";
		
		$st1 = round($ITM[efstat] * $efstat2);	
		$_SESSION[info] = "Effect: $ITM[efstat] -> $st1";	
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsArm
			SET efstat = '$st1', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);
	}
	else {$corupt = rand (1,4);}
	
	if ($corupt == 1){
		$effect2 = "Physical Coruption";
		$efstat2 = rand(9,13)/10;
		$Name = "Rought";	
		
		$st1 = round($ITM[pDEF] * $efstat2);
		$_SESSION[info] = "P-Def: $ITM[pDEF] -> $st1";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsArm
			SET pDEF = '$st1', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);	
	}
	if ($corupt == 2){
		$effect2 = "Magickal coruption";
		$efstat2 = rand(9,13)/10;
		$Name = "Magick";	
		
		$st1 = round($ITM[mDEF] * $efstat2);
		$_SESSION[info] = "M-Def: $ITM[mDEF] -> $st1";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsArm
			SET mDEF = '$st1', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);	
	}
	if ($corupt == 3){
		$effect2 = "Absorb coruption";
		$efstat2 = rand(0,15);
		$Name = "Fluffy";	
		$_SESSION[info] = "Apsorb: $ITM[Apsorb] -> $efstat2";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsArm
			SET Apsorb = '$efstat2', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);
	}
	if ($corupt == 4){
		$effect2 = "Enchant coruption";
		$efstat2 = rand(0,29);
		$Name = "Enchanted";
		$_SESSION[info] = "Enchant: $ITM[plus] -> $efstat2";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsArm
			SET plus = '$efstat2', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);
	}



}

//accsesorys

if ($TYPE == "ACS"){
	$corupt = rand(1,6);
	
	if ($corupt == 1){
		$effect2 = "Health Coruption";
		$efstat2 = rand(8,15)/10;
		$Name = "Healthy";	
		
		$st1 = round($ITM[hpBonus] * $efstat2);
		$_SESSION[info] = "HP Bonus: $ITM[hpBonus] -> $st1";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsAcs
			SET hpBonus = '$st1', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);
	}
	if ($corupt == 2){
		$effect2 = "Damage coruption";
		$efstat2 = rand(9,13)/10;
		$Name = "Mighty";	
		
		$st1 = round($ITM[dmgBonus] * $efstat2);
		$_SESSION[info] = "DMG Bonus: $ITM[dmgBonus] -> $st1";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsAcs
			SET dmgBonus = '$st1', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);
	}
	if ($corupt == 3){
		$effect2 = "Absorb coruption";
		$efstat2 = rand(0,15);
		$Name = "Fluffy";
		
		$NewName = "$Name $ITM[Name]";
		$_SESSION[info] = "Apsorb: $ITM[Apsorb] -> $efstat2";
		
			$order = "UPDATE DropsAcs
			SET Apsorb = '$efstat2', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);
	}
	if ($corupt == 4){
		$effect2 = "Enchant coruption";
		$efstat2 = rand(0,29);
		$Name = "Enchanted";
		
		$NewName = "$Name $ITM[Name]";
		$_SESSION[info] = "Enchant: $ITM[plus] -> $efstat2";
		
			$order = "UPDATE DropsAcs
			SET plus = '$efstat2', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);
	}
	if ($corupt == 5){
		$effect2 = "Experiance coruption";
		$efstat2 = rand(8,20)/10;
		$Name = "Shiny";
		
		$st1 = round($ITM[xpBonus] * $efstat2);
		$_SESSION[info] = "XP Bonus: $ITM[xpBonus] -> $st1";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsAcs
			SET xpBonus = '$st1', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);
	}
	if ($corupt == 6){
		$effect2 = "Resist coruption";
		$efstat2 = rand(8,20)/10;
		$Name = "Resisting";
		
		if (rand(0,100) > 80){
			$efstat2 = $efstat2 * -1;}
		
		$st1 = round($ITM[efstat] * $efstat2);
		$_SESSION[info] = "Resist: $ITM[efstat] -> $st1";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsAcs
			SET efstat = '$st1', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);
	}


}


//skills

if ($TYPE == "SKL"){
	$corupt = rand(1,3);
	
	if ($corupt == 1){
		$effect2 = "Bonus Coruption";
		$efstat2 = rand(5,15)/10;
		$Name = "Effected";	
		
		$st1 = round($ITM[Bonus] * $efstat2);
		$_SESSION[info] = "Bonus: $ITM[Bonus] -> $st1";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsSkl
			SET Bonus = '$st1', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);
	}
	if ($corupt == 2){
		$effect2 = "Skill coruption";
		$efstat2 = rand(1,13);
		$Name = "Changed";
		
		$NewName = "$Name $ITM[Name]";
		
		$SKKL = mysqli_query($db,"SELECT * FROM DropsSkl where HASH = '$ITM[HASH]' ");
		$SKL = mysqli_fetch_assoc($SKKL);
		
		$SKKL2 = mysqli_query($db,"SELECT * FROM BaseSkil where ID = '$efstat2' ");
		$SKL2 = mysqli_fetch_assoc($SKKL2);
		
		$_SESSION[info] = "Skill: <img src='IMG/SKILL/$SKL[Skill].png' height='45px'> -> <img src='IMG/SKILL/$SKL2[Skill].png' height='45px'>";
		
			$order = "UPDATE DropsSkl
			SET Skill = '$SKL2[Skill]', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);
	}
	if ($corupt == 3){
		$effect2 = "Enchant coruption";
		$efstat2 = rand(0,29);
		$Name = "Enchanted";
			
		$NewName = "$Name $ITM[Name]";
		$_SESSION[info] = "Enchant: $ITM[plus] -> $efstat2";
		
			$order = "UPDATE DropsSkl
			SET plus = '$efstat2', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);	

	}



}
}


?>