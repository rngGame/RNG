<?php


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
	
	if ($corupt == 1){
		$effect2 = "Physical Coruption";
		$efstat2 = rand(0.95,1.2);
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
		$efstat2 = rand(0.95,1.2);
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
	if ($corupt == 6){
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
	if ($corupt == 7){
		$effect2 = "Effect coruption";
		$efstat2 = rand(0.7,1.8);
		$Name = "Powered";
		
		$st1 = round($ITM[efstat] * $efstat2);
		$_SESSION[info] = "Effect: $ITM[efstat] -> $st1";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsWep
			SET efstat = '$st1', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);	
	}
}
	
//armors
if ($TYPE == "ARM"){
	$corupt = rand(1,5);
	
	if ($corupt == 1){
		$effect2 = "Physical Coruption";
		$efstat2 = rand(0.9,1.3);
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
		$efstat2 = rand(0.9,1.3);
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
	if ($corupt == 5){
		$effect2 = "Effect coruption";
		$efstat2 = rand(0.8,1.5);
		$Name = "Powered";
		
		$st1 = round($ITM[efstat] * $efstat2);	
		$_SESSION[info] = "Effect: $ITM[efstat] -> $st1";	
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsArm
			SET efstat = '$st1', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);
	}


}

//accsesorys

if ($TYPE == "ACS"){
	$corupt = rand(1,5);
	
	if ($corupt == 1){
		$effect2 = "Health Coruption";
		$efstat2 = rand(0.8,1.5);
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
		$efstat2 = rand(-10,50);
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
		$efstat2 = rand(0.8,2);
		$Name = "Shiny";
		
		$st1 = round($ITM[xpBonus] * $efstat2);
		$_SESSION[info] = "XP Bonus: $ITM[xpBonus] -> $st1";
		$NewName = "$Name $ITM[Name]";
		
			$order = "UPDATE DropsAcs
			SET xpBonus = '$st1', Name = '$NewName', effect2 = '1'
			WHERE `HASH` = '$ITM[HASH]'";
			$result = mysqli_query($db, $order);
	}


}


//skills

if ($TYPE == "SKL"){
	$corupt = rand(1,3);
	
	if ($corupt == 1){
		$effect2 = "Bonus Coruption";
		$efstat2 = rand(0.5,1.5);
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
		
		$SKKL = mysqli_query($db,"SELECT * FROM BaseSkil where ID = '$ITM[Skill]' ");
		$SKL = mysqli_fetch_assoc($SKKL);
		
		$SKKL2 = mysqli_query($db,"SELECT * FROM BaseSkil where ID = '$efstat2' ");
		$SKL2 = mysqli_fetch_assoc($SKKL2);
		
		$_SESSION[info] = "Skill: $SKL[Name] -> $SKL2[Name]";
		
			$order = "UPDATE DropsSkl
			SET Skill = '$efstat2', Name = '$NewName', effect2 = '1'
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


?>