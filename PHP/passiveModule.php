<?php

//add efect from passive skill tree and make it somehow to work with every posible effect

//main stuff
$TRE = mysqli_query($db,"SELECT * FROM passiveTree where Name = '$User' ");
$TRE = mysqli_fetch_row($TRE);	

$arrayP = str_split($TRE[1]);

//insert if there is no tree-------------------------
if ($arrayP[0] == ""){
	$order = "INSERT INTO passiveTree (Name, Passive)
	VALUES ('$User', '00000000000')";
	$result = mysqli_query($db, $order);
}
//----------------------------------------------------	


//new Skill Points
if ($ACC[3] >= 5 and $arrayP[0] == "0"){
	$pasNR += 1;
	$NEWPASSIVE = "<div class='newpassive'>Unspend $pasNR Skill Points</div>";
}
if ($ACC[3] >= 10 and $arrayP[1] == "0"){
	$pasNR += 1;
	$NEWPASSIVE = "<div class='newpassive'>Unspend $pasNR Skill Points</div>";
}
if ($ACC[3] >= 15 and $arrayP[2] == "0"){
	$pasNR += 1;
	$NEWPASSIVE = "<div class='newpassive'>Unspend $pasNR Skill Points</div>";
}
if ($ACC[3] >= 20 and $arrayP[3] == "0"){
	$pasNR += 1;
	$NEWPASSIVE = "<div class='newpassive'>Unspend $pasNR Skill Points</div>";
}
if ($ACC[3] >= 23 and $arrayP[4] == "0"){
	$pasNR += 1;
	$NEWPASSIVE = "<div class='newpassive'>Unspend $pasNR Skill Points</div>";
}
if ($ACC[3] >= 25 and $arrayP[5] == "0"){
	$pasNR += 1;
	$NEWPASSIVE = "<div class='newpassive'>Unspend $pasNR Skill Points</div>";
}
if ($ACC[3] >= 30 and $arrayP[6] == "0"){
	$pasNR += 1;
	$NEWPASSIVE = "<div class='newpassive'>Unspend $pasNR Skill Points</div>";
}
if ($ACC[3] >= 35 and $arrayP[7] == "0"){
	$pasNR += 1;
	$NEWPASSIVE = "<div class='newpassive'>Unspend $pasNR Skill Points</div>";
}
if ($ACC[3] >= 40 and $arrayP[8] == "0"){
	$pasNR += 1;
	$NEWPASSIVE = "<div class='newpassive'>Unspend $pasNR Skill Points</div>";
}
if ($ACC[3] >= 43 and $arrayP[9] == "0"){
	$pasNR += 1;
	$NEWPASSIVE = "<div class='newpassive'>Unspend $pasNR Skill Points</div>";
}
if ($ACC[3] >= 45 and $arrayP[10] == "0"){
	$pasNR += 1;
	$NEWPASSIVE = "<div class='newpassive'>Unspend $pasNR Skill Points</div>";
}

//Skill stuff-----------------------------------------


// 1 STR-INT
if ($arrayP[0] == "a"){
	$STRex = $STRex + 5;
	$INTex = $INTex + 5;
}

// 2 HP and MP
if ($arrayP[1] == "a"){
	$HPex = 1.1;
}
if ($arrayP[1] == "b"){
	$MPex = 1.2;
}

//3 DMG convertation / dodge
if ($arrayP[2] == "a"){
   $PtoM = 0.3;
}
if ($arrayP[2] == "b"){
   $MtoP = 0.1;
}
if ($arrayP[2] == "c"){
   $DodgePS = 10;
}

// lvl 20 shaningans
if ($arrayP[3] == "a"){
	$PSdmg = 5;
}
if ($arrayP[3] == "b"){
	$HPpasRES = $HPpasRES + 0.02;
}
if ($arrayP[3] == "c"){
	$pasResist = 15;
}

// 23 lvl STR-INT
if ($arrayP[4] == "a"){
	$STRex = $STRex + 7;
	$INTex = $INTex + 7;
}

// 25lvl
if ($arrayP[5] == "a"){
	$CHAOS = 0.15;
}
if ($arrayP[5] == "b"){
	$firstPSV = 1;
}
if ($arrayP[5] == "c"){
	$pasSummon = 1;
}
if ($arrayP[5] == "d"){
	$pasENRregen = 10;
}
if ($arrayP[5] == "e"){
	$ENRtoHP = 1;
}

//lvl 30
if ($arrayP[6] == "a"){
	$HPpasive = 2000;
	$pdmgPAS = 2000;
}
if ($arrayP[6] == "b"){
	$HPpasive = 200;
	$MPpasive = 200;
	$passiveDEF = 200;
	$mdmgPAS = 200;
}

//lvl 35
if ($arrayP[7] == "a"){
	$CritDMGpas = 50;
	$mdmgPASmulti = 1.1;
}
if ($arrayP[7] == "b"){
	$CritCHpas = 20;
	$bonusESpas = 1.3;
}

//lvl 40
if ($arrayP[8] == "a"){
	$passiveMOB = 1.1;
	$passivePLY = 1.2;
}
if ($arrayP[8] == "b"){
	$HPpasRES = $HPpasRES + 0.02;
	$STRex = $STRex + 10;
	$INTex = $INTex + 10;
}
if ($arrayP[8] == "c"){
	$HPpasCH = 10;
	$HPpasRESch = 0.2;

}
if ($arrayP[8] == "e"){
	$curseCH = 15;
	$curseEF = 0.5;

}

//lvl 45 
if ($arrayP[9] == "a"){
	$cantCryt = 1;
}
if ($arrayP[9] == "b"){
	$energyMore = 2;
}
if ($arrayP[9] == "c"){
	$cantheal = 1;
}
if ($arrayP[9] == "d"){
	$monsoverdmg = 0.15;
}
if ($arrayP[9] == "e"){
	$STRex = $STRex + 20;
	$INTex = $INTex + 20;
	$pdmgPASmulti = 1.1;
	$mdmgPASmulti = 1.1;
	$HPex = 1.1;
	$MPex = 1.1;
}
if ($arrayP[9] == "f"){
	$PETMore = 10.0;
}

//lvl 47
if ($arrayP[10] == "a"){
	$HP1 = 1;
}
if ($arrayP[10] == "b"){
	$HPandThorns = 1;
}
if ($arrayP[10] == "c"){
	$passivePOIS = 1;
	$passivePOISdmg = 1.3;
}
?>