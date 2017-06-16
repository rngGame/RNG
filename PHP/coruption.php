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
		$efstat2 = rand(-5,20);
		$Name = "Rought";	
	}
	if ($corupt == 2){
		$effect2 = "Magickal coruption";
		$efstat2 = rand(-5,20);
		$Name = "Magick";	
	}
	if ($corupt == 3){
		$effect2 = "Crit chanse coruption";
		$efstat2 = rand(0,50);
		$Name = "Pointy";	
	}
	if ($corupt == 4){
		$effect2 = "Hit chanse coruption";
		$efstat2 = rand(95,100);
		$Name = "Marked";	
	}
	if ($corupt == 5){
		$effect2 = "Enchant coruption";
		$efstat2 = rand(0,30);
		$Name = "Enchanted";
	}
	if ($corupt == 6){
		$effect2 = "Skill coruption";
		$efstat2 = rand(1,17);
		$Name = "Changed";
	}
	if ($corupt == 7){
		$effect2 = "Effect coruption";
		$efstat2 = rand(1,100);
		$Name = "Powered";
	}
}
	
//armors
if ($TYPE == "ARM"){
	$corupt = rand(1,7);
	
	if ($corupt == 1){
		$effect2 = "Physical Coruption";
		$efstat2 = rand(-5,20);
		$Name = "Rought";	
	}
	if ($corupt == 2){
		$effect2 = "Magickal coruption";
		$efstat2 = rand(-5,20);
		$Name = "Magick";	
	}
	if ($corupt == 3){
		$effect2 = "Absorb coruption";
		$efstat2 = rand(5,15);
		$Name = "Fluffy";	
	}
	if ($corupt == 4){
		$effect2 = "Enchant coruption";
		$efstat2 = rand(0,30);
		$Name = "Enchanted";
	}
	if ($corupt == 5){
		$effect2 = "Effect coruption";
		$efstat2 = rand(0.8,1.5);
		$Name = "Powered";
	}
	


}






?>