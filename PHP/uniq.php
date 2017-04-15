<?php

//select uniq weapon
$uniqRO = rand(1,13);

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
	   ('$HASH', 'The legendary destruction Scythe of the Deathgod Kiro', 'Unique', '150', '200', '300', '1', '200', '300', '95', '', 'LL', '30', '0', '200')";
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
	   ('$HASH', 'Gamblers draw', 'Unique','150', '1', '1300', '1','1', '1300', '50', '', '', '', '0', '200')";
}

if ($uniqRO == 4){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity,ilvl, pmin, pmax, cryt,mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Lord of Magick wand','ff6633', '100', '1', '1','1', '700', '900', '1', '', '', '', '0', '200')";
}

if ($uniqRO == 5){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity,ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Ringed Warrior Great Sword', 'Unique','100', '300', '500', '10','1', '1', '100', '10', 'LL', '5', '0', '200')";
}

//Kompas uniq
if ($uniqRO == 6){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity,ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Freezing touch of Kompas', 'Unique', '150', '1', '1','1', '1', '1', '100', '', 'FR', '50', '0', '200')";
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
	   ('$HASH', 'Health over matter', 'Unique', '75', '85', '105', '5', '105', '205', '95', '9', 'HT', '15', '0', '150')";
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
	   ('$HASH', 'Shiny coin picker', 'Unique', '100', '90', '110', '15', '65', '130', '86', '', '', '', '30', '550')";
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
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Summoners urgant wish stick', 'Unique','150', '1', '1', '1', '450', '850', '80', '', 'SM', '150', '0', '550')";
}

if ($uniqRO == 13){
	$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Whip of the sick burn', 'Unique','150', '300', '500', '25', '150', '300', '95', '1', 'BR', '90', '5', '550')";
}



?>