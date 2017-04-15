<?php
//button


//test functions
function testItemDrop($db){
	for($mlvl=1;$mlvl <=5000;$mlvl++){
		list($HASH, $weaponName, $weaponType, $weaponLVL, $weaponPhysMin, $weaponPhysMax, $weaponCrit, $weaponMagMin, $weaponMagMax, $weaponHit, $weaponSkill, $weaponEffect, $weaponEffectChance) = itemDrop($db,,"weapon",$MLVL, "LVL DESC", "Bonus DESC" );
		list($HASH, $armorLVL, $armorName, $armorType, $valueArmorP, $valueArmorM, $armorPart, $armorAbsorb) = itemDrop($db,,"armor",$MLVL, "LVL DESC", "Bonus DESC" );
		list($HASH, $accesoryPart, $accesoryName, $accesoryType, $accesoryLVL, $accesoryAbsorb, $hpBonus, $xpBonus, $dmgBonus) = itemDrop($db,,"talisman",$MLVL, "LVL DESC", "Bonus DESC" );
		echo "_______________________<br>
		Items for Monster LVL $mlvl <br>
		Weapon: $weaponLVL $weaponName ($weaponType) $weaponPhysMin ~ $weaponPhysMax, $weaponCrit%, $weaponMagMin ~ $weaponMagMax, $weaponHit% | $weaponSkill, $weaponEffect, $weaponEffectChance %<br>
		Armor: $armorLVL $armorName ($armorType) valueArmorP / $valueArmorM , $armorPart , $armorAbsorb %<br>
		Accesorry: $accesoryLVL $accesoryName ($accesoryType) $accesoryPart $accesoryAbsorb%, $hpBonus%, $xpBonus%, $dmgBonus%<br>
		________________";
	}
}