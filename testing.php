<?php
session_start();

set_time_limit(60);
error_reporting(0);

include_once 'PHP/db.php';
$User = $_SESSION["User"];
include_once 'PHP/function.php';
//button


//test functions
//function testItemDrop($db){
	
	$WEPminLVL=1000000000;
	$ARMminLVL=1000000000;
	$ACSminLVL=1000000000;
	
	$startTime=time();
	$i = 0;
	
	$MLVL = 325; //minimum lvl
	$MMAX = 330; //maximum lvl
	
	
	
	
	while($MLVL <=$MMAX){
		$MLVL++;
		list($HASH, $weaponName, $weaponType, $weaponLVL, $weaponPhysMin, $weaponPhysMax, $weaponCrit, $weaponMagMin, $weaponMagMax, $weaponHit, $weaponSkill, $weaponEffect, $weaponEffectChance) = itemDrop($db, $User, "weapon", $MLVL);
		list($HASH, $armorLVL, $armorName, $armorType, $valueArmorP, $valueArmorM, $armorPart, $armorAbsorb) = itemDrop($db, $User, "armor", $MLVL);
		list($HASH, $accesoryPart, $accesoryName, $accesoryType, $accesoryLVL, $accesoryAbsorb, $hpBonus, $xpBonus, $dmgBonus) = itemDrop($db, $User, "talisman", $MLVL);
		/*echo "_______________________<br>
		<b>Items for Monster LVL $MLVL</b> <br>
		Weapon: $weaponLVL $weaponName ($weaponType) PDMG - $weaponPhysMin ~ $weaponPhysMax, MDMG - $weaponMagMin ~ $weaponMagMax, CRIT - $weaponCrit%, HS - $weaponHit% BONUS - $weaponSkill, $weaponEffect, $weaponEffectChance %<br>
		Armor: $armorLVL $armorName ($armorType) $armorPart, DEF - $valueArmorP / $valueArmorM, APS - $armorAbsorb %<br>
		Accesorry: $accesoryLVL $accesoryName ($accesoryType) $accesoryPart APS - $accesoryAbsorb%, HP - $hpBonus%, XP - $xpBonus%, DMG -$dmgBonus%<br>
		________________";*/
		
		//MAX
		if ($WEPMAXLVL < $weaponLVL){
		$WEPMAXLVL = $weaponLVL;
		}
		if ($ARMMAXLVL < $armorLVL){
		$ARMMAXLVL = $armorLVL;
		}
		if ($ACSMAXLVL < $accesoryLVL){
		$ACSMAXLVL = $accesoryLVL;
		}
		
		//MIN
		if ($WEPminLVL > $weaponLVL){
		$WEPminLVL = $weaponLVL;
		}
		if ($ARMminLVL > $armorLVL){
		$ARMminLVL = $armorLVL;
		}
		if ($ACSminLVL > $accesoryLVL){
		$ACSminLVL = $accesoryLVL;
		}
		//if (time()-$startTime>5) break;
		$i += 1;
}
$MLVLS = $MLVL - $i;
$MLVL = $MLVL - 1;
$i -=  1;
echo"<br><br><br><b>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</b><br>
	Final Mob Raange: $MLVLS - $MLVL<br>
	How many lvl passed: $i <br>
	Weapon ILVL: $WEPminLVL - $WEPMAXLVL<br>
	Armor ILVL: $ARMminLVL - $ARMMAXLVL<br>
	Aacsesorys ILVL: $ACSminLVL - $ACSMAXLVL<br>
	<b>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</b><br>
	";
?>

