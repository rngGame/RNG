<?php
session_start();

error_reporting(0);

include_once 'PHP/db.php';
$User = $_SESSION["User"];
include_once 'PHP/function.php';
//button

echo $_SESSION["CURRENTWHASH"];


//test functions
//function testItemDrop($db){
	for($MLVL=400;$MLVL <=500;$MLVL++){
		list($HASH, $weaponName, $weaponType, $weaponLVL, $weaponPhysMin, $weaponPhysMax, $weaponCrit, $weaponMagMin, $weaponMagMax, $weaponHit, $weaponSkill, $weaponEffect, $weaponEffectChance) = itemDrop($db, $User, "weapon", $MLVL, "LVL DEC", "Bonus DEC", true);
		list($HASH, $armorLVL, $armorName, $armorType, $valueArmorP, $valueArmorM, $armorPart, $armorAbsorb) = itemDrop($db, $User, "armor", $MLVL, "LVL DEC", "Bonus DEC", true);
		list($HASH, $accesoryPart, $accesoryName, $accesoryType, $accesoryLVL, $accesoryAbsorb, $hpBonus, $xpBonus, $dmgBonus) = itemDrop($db, $User, "talisman", $MLVL, "LVL DEC", "Bonus DEC", true);
		echo "_______________________<br>
		<b>Items for Monster LVL $MLVL</b> <br>
		Weapon: $weaponLVL $weaponName ($weaponType) $weaponPhysMin ~ $weaponPhysMax, $weaponCrit%, $weaponMagMin ~ $weaponMagMax, $weaponHit% | $weaponSkill, $weaponEffect, $weaponEffectChance %<br>
		Armor: $armorLVL $armorName ($armorType) valueArmorP / $valueArmorM , $armorPart , $armorAbsorb %<br>
		Accesorry: $accesoryLVL $accesoryName ($accesoryType) $accesoryPart $accesoryAbsorb%, $hpBonus%, $xpBonus%, $dmgBonus%<br>
		________________";
	}

