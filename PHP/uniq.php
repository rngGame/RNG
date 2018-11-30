<?php

//select uniq weapon
$uniqRO = rand(1,17);

//hash
$HitChanse = 0;
$HASH = rand(-90000000,900000000);
$HASH = $HASH + rand(-1000,1000);
$HASH = "$HASH UNI"; 

//Lapiukas uniq
if ($uniqRO == 1){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'The legendary destruction Scythe of the Deathgod Kiro', 'Unique', '350', '900', '1600', '1', '400', '500', '95', '', 'LL', '30', '0', '200')";
}

if ($uniqRO == 2){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity,ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Shame of Discord', 'Unique','1', '1', '100', '1', '1', '1', '100', '9', 'BK', '10', '0', '200')";
}

if ($uniqRO == 3){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity,ilvl, pmin, pmax, cryt,mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Gamblers draw', 'Unique','350', '1', '3300', '1','1', '3300', '50', '', '', '', '0', '200')";
}

if ($uniqRO == 4){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity,ilvl, pmin, pmax, cryt,mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Lord of Magick wand','Unique', '250', '1', '1','1', '1800', '2200', '1', '15', '', '', '0', '200')";
}

if ($uniqRO == 5){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity,ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Ringed Warrior Great Sword', 'Unique','250', '600', '1200', '10','1', '1', '100', '16', 'LL', '5', '0', '200')";
}

//Kompas uniq
if ($uniqRO == 6){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity,ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Freezing touch of Kompas', 'Unique', '305', '1', '1','1', '1', '1', '100', '', 'FR', '75', '0', '200')";
}

if ($uniqRO == 7){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity,ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'One with Everyone', 'Unique', '1', '99999', '99999', '150', '1', '1', '1', '', '', '', '0', '200')";
}

if ($uniqRO == 8){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Health over matter', 'Unique', '175', '185', '305', '5', '305', '505', '95', '9', 'HT', '5', '0', '150')";
}

if ($uniqRO == 9){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Sleeping beauty', 'Unique', '105', '250', '450', '10', '75', '200', '92', '2', 'WK', '50', '0', '450')";
}

if ($uniqRO == 10){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Shiny coin picker', 'Unique', '100', '90', '110', '15', '65', '130', '86', '', '', '', '29', '550')";
}

//arminas Uniq
if ($uniqRO == 11){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'French fries of power yet confusion', 'Unique', '69', '69', '169', '50', '69', '69', '95', '10', 'ST', '35', '0', '350')";
}


if ($uniqRO == 12){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Summoners Urgent Wish Stick', 'Unique','350', '1', '1', '1', '1300', '2000', '80', '', 'SM', '150', '0', '550')";
}

if ($uniqRO == 13){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Whip of the sick burn', 'Unique','250', '800', '1000', '25', '350', '500', '95', '1', 'BR', '90', '5', '550')";
}

if ($uniqRO == 14){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Sound blaster', 'Unique','200', '50', '150', '1', '900', '900', '95', '9', 'PS', '50', '0', '550')";
}

if ($uniqRO == 15){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', '/Shrug', 'Unique','100', '1', '10', '1', '1', '10', '100', '', 'CF', '50', '0', '550')";
}
if ($uniqRO == 16){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Blade of mad warrior', 'Unique','400', '800', '700', '10', '400', '600', '95', '10', 'CS', '100', '0', '550')";
}
if ($uniqRO == 17){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'End Game Madness', 'Unique','350', '3000', '3000', '20', '3000', '3000', '95', '10', 'CS', '250', '0', '800')";
}

?>