<?php
//ITEM DROPS

$HitChanse = 0;
$HASH = rand(-90000000,900000000);
$HASH = $HASH + rand(-1000,1000);
$HASHIT = "$HASH ITM"; 

$base = array("Potion", "Bag");
$baseN = array_rand($base,1);

//if corupted guareantee
if (isset($CI)){
	$base[$baseN] = "Bag";
}

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
	$sub = array("Gold", "Shards", "XP", "Mod", "Enchant", "Joker", "Corupt");
	$subn = array_rand($sub,1);
	
	//if corupted guareantee
	if (isset($CI)){
		$sub[$subn] = "Corupt";
	}
	
	if ($sub[$subn] == "Corupt"){
		$Name = "Coruption stone";
		$icon = "Icon.4_86";
		$EFT = "COR";
		$value = 1;
		$sub[$subn] ="";
	}
	
	if ($sub[$subn] == "Gold"){
		$Name = "$base[$baseN] of $sub[$subn]";
		$EFT = "GOLD";
		$value = rand(100,1000);
	}
	if ($sub[$subn] == "Shards"){
		$Name = "$base[$baseN] of $sub[$subn]";
		$EFT = "SHRD";
		$value = rand(10,30);
	}
	if ($sub[$subn] == "XP"){
		$Name = "$base[$baseN] of $sub[$subn]";
		$EFT = "XP";
		$value = rand(5,15);
	}
	if ($sub[$subn] == "Mod"){
		$icon = "Icon.1_48";
		$Name = "Draw of $sub[$subn]";
		$EFT = "MOD";
		$value = rand(15,50);}
	if ($sub[$subn] == "Enchant"){
		$icon = "Icon.7_82";
		$Name = "Powder of random $sub[$subn]";
		$EFT = "ENC";
		$value = 1;}
	if ($sub[$subn] == "Joker"){
		$icon = "Icon.3_39";
		$Name = "Joker chanse";
		$EFT = "JOKE";
		$value = 1;}
}


?>