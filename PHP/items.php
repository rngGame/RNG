<?php
//ITEM DROPS

$HitChanse = 0;
$HASH = rand(-90000000,900000000);
$HASH = $HASH + rand(-1000,1000);
$HASHIT = "$HASH ITM"; 

$base = array("Potion", "Bag");
$baseN = array_rand($base,1);

//potions
if ($base[$baseN] == "Potion"){
	$icon = "Icon.1_69";
	$sub = array("Health", "Energie", "Damage", "Defence", "Hurting", "Luck");
	$subn = array_rand($sub,1);
	if ($sub[$subn] == "Health"){
		$Name = "$base[$baseN] of $sub[$subn]";
		$EFT = "HEAL";
		$value = rand(10,100);
	}
	if ($sub[$subn] == "Energie"){
		$Name = "$base[$baseN] of $sub[$subn]";
		$EFT = "ENER";
		$value = rand(10,100);
	}
	if ($sub[$subn] == "Damage"){
		$Name = "$base[$baseN] of $sub[$subn]";
		$EFT = "DMG";
		$value = rand(5,35);
	}
	if ($sub[$subn] == "Defence"){
		$Name = "$base[$baseN] of $sub[$subn]";
		$EFT = "DEF";
		$value = rand(5,35);
	}
	if ($sub[$subn] == "Hurting"){
		$Name = "$base[$baseN] of $sub[$subn]";
		$EFT = "HURT";
		$value = rand(5,30);
	}
	if ($sub[$subn] == "Luck"){
		$Name = "$base[$baseN] of $sub[$subn]";
		$EFT = "LUCK";
		$value = rand(10,50);
	}
}



//bags
if ($base[$baseN] == "Bag"){
$icon = "Icon.6_37";
	$sub = array("Gold", "Shards", "XP", "Mod");
	$subn = array_rand($sub,1);
	if ($sub[$subn] == "Gold"){
		$Name = "$base[$baseN] of $sub[$subn]";
		$EFT = "GOLD";
		$value = rand(10,1000);
	}
	if ($sub[$subn] == "Shards"){
		$Name = "$base[$baseN] of $sub[$subn]";
		$EFT = "SHRD";
		$value = rand(10,90);
	}
	if ($sub[$subn] == "XP"){
		$Name = "$base[$baseN] of $sub[$subn]";
		$EFT = "XP";
		$value = rand(5,15);
	}
	if ($sub[$subn] == "Mod"){
		$Name = "$base[$baseN] of $sub[$subn]";
		$EFT = "DEF";
		$value = rand(15,50);}
}


?>