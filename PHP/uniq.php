<?php

//select uniq weapon
$uniqRO = rand(1,10);

//hash
$HC = 0;
$HASH = rand(-90000000,900000000);
$HASH = $HASH + rand(-1000,1000);
$HASH = "$HASH UNI"; 

//Lapiukas uniq
if ($uniqRO == 1){
	$order2 = "INSERT INTO weapondrops
	   (HASH, Name, Type, Color, ilvl, pmin, pmax, cryt, ats, mmin, mmax, hc, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'The legendary destruction Scythe of the Deathgod Kiro', 'Unique', 'ff6633', '300', '200', '300', '1', '1', '200', '300', '95', '', 'LL', '30', '0', '200')";
}

if ($uniqRO == 2){
	$order2 = "INSERT INTO weapondrops
	   (HASH, Name, Type, Color, ilvl, pmin, pmax, cryt, ats, mmin, mmax, hc, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Shame of Discord', 'Unique', 'ff6633', '1', '1', '1', '100', '1', '1', '1', '100', '9', 'BK', '10', '0', '200')";
}

if ($uniqRO == 3){
	$order2 = "INSERT INTO weapondrops
	   (HASH, Name, Type, Color, ilvl, pmin, pmax, cryt, ats, mmin, mmax, hc, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Gamblers draw', 'Unique', 'ff6633', '300', '1', '1300', '1', '1', '1', '1300', '50', '', '', '', '0', '200')";
}

if ($uniqRO == 4){
	$order2 = "INSERT INTO weapondrops
	   (HASH, Name, Type, Color, ilvl, pmin, pmax, cryt, ats, mmin, mmax, hc, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Lord of Magick wand', 'Unique', 'ff6633', '100', '1', '1', '1', '1', '700', '900', '1', '', '', '', '0', '200')";
}

if ($uniqRO == 5){
	$order2 = "INSERT INTO weapondrops
	   (HASH, Name, Type, Color, ilvl, pmin, pmax, cryt, ats, mmin, mmax, hc, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Ringed Warrior Great Sword', 'Unique', 'ff6633', '100', '300', '500', '10', '1', '1', '1', '100', '10', 'LL', '5', '0', '200')";
}

//Kompas uniq
if ($uniqRO == 6){
	$order2 = "INSERT INTO weapondrops
	   (HASH, Name, Type, Color, ilvl, pmin, pmax, cryt, ats, mmin, mmax, hc, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Freezing touch of Kompas', 'Unique', 'ff6633', '200', '1', '1', '1', '1', '1', '1', '50', '', 'FR', '50', '0', '200')";
}

if ($uniqRO == 7){
	$order2 = "INSERT INTO weapondrops
	   (HASH, Name, Type, Color, ilvl, pmin, pmax, cryt, ats, mmin, mmax, hc, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'One with Everyone', 'Unique', 'ff6633', '1', '99999', '99999', '100', '1', '1', '1', '1', '', '', '', '0', '200')";
}

if ($uniqRO == 8){
	$order2 = "INSERT INTO weapondrops
	   (HASH, Name, Type, Color, ilvl, pmin, pmax, cryt, ats, mmin, mmax, hc, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Health over matter', 'Unique', 'ff6633', '75', '85', '105', '5', '1', '105', '205', '95', '9', 'HT', '15', '0', '150')";
}

if ($uniqRO == 9){
	$order2 = "INSERT INTO weapondrops
	   (HASH, Name, Type, Color, ilvl, pmin, pmax, cryt, ats, mmin, mmax, hc, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Sleeping beauty', 'Unique', 'ff6633', '105', '250', '450', '10', '1', '75', '200', '92', '2', 'WK', '50', '0', '450')";
}

if ($uniqRO == 10){
	$order2 = "INSERT INTO weapondrops
	   (HASH, Name, Type, Color, ilvl, pmin, pmax, cryt, ats, mmin, mmax, hc, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', 'Shiny coin picker', 'Unique', 'ff6633', '100', '90', '110', '15', '1', '65', '130', '86', '', '', '', '30', '550')";
}


?>