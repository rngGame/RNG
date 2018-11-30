<?php
include_once 'config.php';
 
function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id();    // regenerated the session, delete the old one. 
}

function itemDrop($db,$user,$drop,$MLVL){
    if(!$isTest){
        $orderBy="RAND()";
        $orderByType="RAND()";
    }
    else{
        $orderBy="LVL DESC";
        $orderByType="Bonus DESC";
    }
    
    if($drop=="all"){
        $check=rand(1,4);
        if($check==1){
            $drop ="talisman";
        }
        else if($check==2){
            $drop="armor";
        }
        else if($check==3){
            $drop="weapon";
        }
		 else if($check==4){
            $drop="skill";
        }
    }
    if($drop=="armor"||$drop=="talisman"||$drop=="weapon"||$drop=="skill"){

        $preTable="prefixwep";
        //check which item
        if($drop=="armor"){
            $baseTable="basearmor";

        }
        if($drop=="talisman"){
            $baseTable="basetalis";
            $preTable="pretalis";
			$part = "ACS";
        }
        if($drop=="weapon"){
            $baseTable="basewep";
			$preTable="prefixwep";
			$part = "WEP";
        }
		if($drop=="skill"){
            $baseTable="BaseSkil";
			$preTable="prefixwep";
			$part = "SKL";
        }
		
		//for faster calculation
		$LVL = round($MLVL / 20);


        $rel = 0;
		$times = 0;

        while ($rel == 0 and $times <> 600){
			
			if ($times == 10 and $MLVL <= 249){
				$times = 1;
			}
			
			$times += 1;
			
            //get info from db general
            $Base = mysqli_query($db,"SELECT * FROM $baseTable where LVL > $LVL Order by $orderBy Limit     1");
            $Base = mysqli_fetch_row($Base);
            $Pre = mysqli_query($db,"SELECT * FROM $preTable Order by $orderBy Limit   1");
            $Pre = mysqli_fetch_row($Pre);
            $Sub = mysqli_query($db,"SELECT * FROM subfixwep Order by $orderBy Limit  1");
            $Sub = mysqli_fetch_row($Sub);
            $Type = mysqli_query($db,"SELECT * FROM types Order by $orderByType Limit     1");
            $Type = mysqli_fetch_row($Type);
            $Type2 = mysqli_query($db,"SELECT * FROM types Order by $orderByType Limit    1");
            $Type2 = mysqli_fetch_row($Type2);
            $Sub2 = mysqli_query($db,"SELECT * FROM subfixwep Order by $orderBy Limit     1");
            $Sub2 = mysqli_fetch_row($Sub2);
            $Skill = mysqli_query($db,"SELECT * FROM iskills Order by $orderBy Limit  1");
            $Skill = mysqli_fetch_row($Skill);

            //Nulify vars
            $typeName = "";    
            $iLVL = 0;
            $valueDMG= $valueArmor= $valueHP= $valueXP= 0; //was dmg, delete comment before finnish
            $enchantLVL = 0; //give + to item
            $typeBonus=1;

            //rng stuff for 
            $rngPre = rand(1,10000);
            $rngSub = rand(1,10000);
            $rngSkill = rand(1,10000);
            $rngType = rand(1,10000);

            //bases set up
            $nameBase = $Base[1]; //takes the base name for the Armor
            if($drop=="armor"){
                $iLVL = $Base[3]; //base level
                $valueArmorP = $Base[2]; //base armor phys
				$valueArmorM = $Base[2]; //base armor mag
				$apsorb = rand(1,10);
				$part = rand(1,3);
				if ($part == 1) {
					$part = "BODY";}
				if ($part == 2) {
					$part = "GLOVES";}
				if ($part == 3) {
					$part = "LEGS";}
            }
            if($drop=="weapon"){
                $iLVL = $Base[2]; //base level
                $valueDMG = $Base[3]; //base dmg
            }
			if($drop=="skill"){
                $iLVL = round(rand($Base[2]*0.8,$Base[2]*1.2)); //base level
                $Buff = round(rand($Base[2]*0.8,$Base[2]*1.2)); //base buff
				$SkillID = $Base[3];
            }
            if($drop=="talisman"){
                $iLVL = $Base[2];//base lvl
                $valueDMG = $Base[3];//base dmg 
                $valueHP = $Base[5];//base HP
                $valueXP = $Base[6]; //base XP
				$apsorb = rand(1,10);
				$part = rand(1,2);
				if ($part == 1) {
					$part = "RING";}
				if ($part == 2) {
					$part = "AMUL";}

            }
			
			//resists
			 if($drop=="talisman"){
               $ef=rand(1,3);
			   if ($ef == 1){
				   $RESISTef = "Fire";}
			   if ($ef == 2){
				   $RESISTef = "Ice";}
			   if ($ef == 3){
				   $RESISTef = "Lightining";}
				 
				$RESISTst = round($MLVL/rand(8,15));

            }
			
			
            //Prefix for talismans
            if($rngPre>3000 && $drop=="talisman"){
                $namePre=$Pre[1];
                $valueDMG*=$Pre[2];
                $valueHP*=$Pre[2];
                $valueXP*=$Pre[2];
                $iLVL+=$Pre[3];

            }
            //Prefix for weapons
            if($rngPre>3000 && $drop=="weapon"){
                $namePre=$Pre[1];
                $Buff+=$Pre[2];
                $iLVL+=$Pre[2];
            }
			//Prefix for skill
            if($rngPre>3000 && $drop=="skill"){
                $namePre=$Pre[1];
                $Buff+=$Pre[3];
                $iLVL+=$Pre[2];
            }
            //Subfix for talismans
            if($rngSub>3000 && $drop=="talisman"){
                $nameSub = "and $Sub[1]";
                $valueDMG +=$Sub[3];
                $valueHP +=$valueHP*$Sub[3]/200;
                $valueXP *=1.2;
                $iLVL +=$Sub[2];
            }
			//Subfix for skill
            if($rngSub>3000 && $drop=="skill"){
                $nameSub = "of $Sub[1]";
                $Buff +=$Sub[2];
                $iLVL +=$Sub[2];
            }
            //Subfixes for armor
            if($rngSub > 2000 && $drop=="armor"){  //checks for first Sub rng
                $nameSub ="of $Sub[1]";
                $valueArmorP += $Sub[3]/2;
				$valueArmorM += $Sub[3]/2;
                $iLVL += $Sub[2];
				
                if($rngSub > 3000){ //checks for second Sub rng
                    $nameSub2 ="and $Sub2[1]";
                    $valueArmorP += $Sub2[3]/2;
					$valueArmorM += $Sub2[3]/2;
                    $iLVL += $Sub2[2];
                }
            }
            //Subfixes for weapon
            if($rngSub > 5000 && $drop=="weapon"){  //checks for first Sub rng
                $nameSub ="of $Sub[1]";
                $valueDMG += $Sub[3];
                $iLVL += $Sub[2];
                if($rngSub > 7000){ //checks for second Sub rng
                    $nameSub2 ="and $Sub2[1]";
                    $valueDMG += $Sub2[3];
                    $iLVL += $Sub2[2];
                }
            }
            //Types for drops x2
            if($rngType < $Type[2]*200){ //checks for Type rng first time
                $typeName ="$Type[1]";
                $typeBonus=$Type[3] / 100;
                $valueDMG += $valueDMG * $typeBonus;
                $valueArmorP += $valueArmorP * $typeBonus;
				$valueArmorM += $valueArmorM * $typeBonus;
                $valueHP += $valueHP * $typeBonus;
				$Buff += $typeBonus;
                $iLVL += $iLVL * $typeBonus;
            }
            else if($rngType < $Type2[2]*200){ //checks for Type rng second time
                $typeName ="$Type2[1]";
                $typeBonus=$Type[3] / 100;
                $valueDMG += $valueDMG * $typeBonus;
                $valueArmorP += $valueArmorP * $typeBonus;
				$valueArmorM += $valueArmorM * $typeBonus;
                $valueHP += $valueHP * $typeBonus;
				$Buff += $typeBonus;
                $iLVL += $iLVL * $typeBonus;
            }
            //Skill for Weapon
            if($rngSkill>7500){
                $iLVL+=$Skill[7];
                $skillName = $Skill[1];
                $weaponSkill = $Skill[0];
                $skillText = "Skill : $Skill[1]<br>";
            }
    

            //Creating weapon values
            $weaponPhysMin = round($valueDMG * rand(80,100)/100);
            $weaponPhysMax = round($valueDMG * rand(101,130)/100);
            $weaponCrit = round(1 + 10*$typeBonus);
            $weaponMagMin = round($valueDMG *rand(50,100)/100);
            $weaponMagMax = round($valueDMG *rand(150,200)/100);  
            $weaponHit = rand(85,100);

            //finnishing up values
            $dmgBonus = round($valueDMG/10);
            $valueArmorP = round($valueArmorP + ($valueArmorP * rand(-20,15) / 100));
			$valueArmorM = round($valueArmorM + ($valueArmorM * rand(-5,30) / 100));
            $hpBonus = round($valueHP/50);
            $xpBonus = round($valueXP*10);
			
			//armor-tali below 249lvl
			if($MLVL > 200 and $MLVL < 250 and ($drop=="armor" or $drop=="talisman")){ 
				$iLVL *= 1.3;
				$valueArmorP *= 1.3;
				$valueArmorM  *= 1.3;
				$dmgBonus *= 1.2;
				$hpBonus *= 1.2;
				$xpBonus *= 1.2;
			}
			
			//if don't find itm in 300 tries
			$max = round($ACC[3]*($ACC[3] / 4) + ($ACC[3] * 2)+($MLVL/2));
			$min = round($ACC[3]*($ACC[3] / 7) + ($ACC[3])+($MLVL/10));
			
			if ($times > 300 and $MLVL >= 250){
								
				$weaponPhysMin *= 2;
				$weaponPhysMax *= 2;
				$weaponMagMin *= 2;
				$weaponMagMax *= 2;
				$iLVL *= 1.5;
				$dmgBonus *= 1.2;
				$valueArmorP *= 1.5;
				$valueArmorM  *= 1.5;
				$hpBonus *= 1.3;
				$xpBonus *= 1.2;
				$Evol = "-Evolved-";
			
				if ($iLVL >= $min and $iLVL <= $max){
					$ev = 1;
				}
				else {$times = 301; $ev = 0;}
				}
				
			else{
				unset($Evol);
				}
			
			//ROUND
			$weaponPhysMin = round($weaponPhysMin);
            $weaponPhysMax = round($weaponPhysMax);
            $weaponMagMin = round($weaponMagMin);
            $weaponMagMax = round($weaponMagMax);  
			$iLVL = round($iLVL);
            $dmgBonus = round($dmgBonus);
            $valueArmorP = round($valueArmorP);
			$valueArmorM = round($valueArmorM);
            $hpBonus = round($hpBonus);
            $xpBonus = round($xpBonus);
			$Buff = round($Buff);
			
			
			

            if($valueDMG <= 0){
                $valueDMG = 1;
            }
            if($valueArmorP <= 0){
                $valueArmorP = 1;
            }
			if($valueArmorM <= 0){
                $valueArmorM = 1;
            }
            if($valueHP <= 0){
                $valueHP = 1;
            }
            if($valueXP <= 0){
                $valueXP = 1;
            }

            //hashing item
            $hashClaimed = 0;
            $HASH = rand(1,9999);
            $HASH = $HASH * $iLVL;
            $HASH = $HASH + rand(1,9999);
			$HASH = "$HASH $drop";
            $result = mysqli_query($db,"SELECT * FROM Equiped WHERE HASH = '$HASH'");
            $count = mysqli_num_rows($result);
            if($count==1){ //if hash claimed, we will redo this
                $hashClaimed = 1;
            }


            $name="$Evol $namePre $nameBase $nameSub $nameSub2 $nameEnchant";


            if(!$typeName == ""){ //coloring the name, if needed
                $itemName = "<b class='$color'>$name ($typeName)</b>";
            }
            else{
                $itemName = "<b>$name</b>";
            }
			
            //deciding on effect WEAPON
            if (rand(0,100) < 30 and $drop=="weapon"){
                $rngEffect = rand(1,12);
                if ($rngEffect == 1){
                    $effectName = "Life Leach";
                    $Effect = "LL";
                    $EffectChance = rand(1,7);
                }
                if ($rngEffect == 2){
                    $effectName = "Bleed";
                    $Effect = "BL";
                    $EffectChance = rand(10,30);
                }
                if ($rngEffect == 3){
                    $effectName = "Burn";
                    $Effect = "BR";
                    $EffectChance = rand(1,20);
                }
                if ($rngEffect == 4){
                    $effectName = "Freez";
                    $Effect = "FR";
                    $EffectChance = rand(10,20);
                    
                }
                if ($rngEffect == 5){
                    $effectName = "Stun";
                    $Effect = "ST";
                    $EffectChance = rand(5,30);
                }
                if ($rngEffect == 6){
                    $effectName = "Shock";
                    $Effect = "SH";
                    $EffectChance = rand(20,50);
                    
                }
                if ($rngEffect == 7){
                    $effectName = "Block";
                    $Effect = "BK";
                    $EffectChance = rand(5,20);
                    
                }
                 if ($rngEffect == 8){
                    $effectName = "Summon";
                    $Effect = "SM";
                    $EffectChance = rand(25,70);
                    
                }
                if ($rngEffect == 9){
					 $effectName = "Poision buff";
                    $Effect = "PS";
                    $EffectChance = rand(5,45);
                    
                }
                
                if ($rngEffect == 10){
					$effectName = "Confusion chanse";
                    $Effect = "CF";
                    $EffectChance = rand(5,15);

                }
				if ($rngEffect == 11){
					$effectName = "Cursed Soul";
                    $Effect = "CS";
                    $EffectChance = rand(10,50);

                }
				if ($rngEffect == 12){
					$effectName = "Nerve Shock";
                    $Effect = "NS";
                    $EffectChance = rand(5,20);

                }
                $effect = "Effect: $effectName $EffectChance %<br>";
            }
			
			
			//deciding on effect ARMOR
            if (rand(0,100) < 30 and $drop=="armor"){
                $rngEffect = rand(1,6);
                if ($rngEffect == 1){
                    $effectName = "HP Bonuss";
                    $Effect = "HP";
                    $EffectChance = round(rand($MLVL*2,($MLVL*4)));
					if ($EffectChance < 1){
						  $EffectChance = 1;}
                }
				if ($rngEffect == 2){
                    $effectName = "EN Bonuss";
                    $Effect = "EN";
                    $EffectChance = round(rand($MLVL/5,($MLVL/2)));
					if ($EffectChance < 1){
						  $EffectChance = 1;}
                }
				if ($rngEffect == 3){
                    $effectName = "Heal per turn";
                    $Effect = "HL";
                    $EffectChance = round(rand($MLVL/4,($MLVL)));
					if ($EffectChance < 1){
						  $EffectChance = 1;}
                }
				if ($rngEffect == 4){
                    $effectName = "Chanse not die";
                    $Effect = "NO";
                    $EffectChance = round(rand(2,7));
                }
				if ($rngEffect == 5){
                    $effectName = "Thorn DMG";
                    $Effect = "TR";
                    $EffectChance = round(rand($MLVL*1.5,($MLVL*4)));
                }
				if ($rngEffect == 6){
                    $effectName = "Energie Shield";
                    $Effect = "ES";
                    $EffectChance = round(rand($MLVL,($MLVL*2)));
                }
				$effect = "Effect: $effectName $EffectChance <br>";
			}

            //creating lowest weapon, best weapon acording to level
            $rngValueMin = $MLVL/1.5;
			$rngValueMax = $MLVL*1.3;
			
			//by player
			$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$user' ");
			$ACC = mysqli_fetch_row($ACC);
		
			$maxforPlayerLVL = round($ACC[3]*($ACC[3] / 5) + ($ACC[3] * 2)+($MLVL/5));
			$minforPlayerLVL = round($ACC[3]*($ACC[3] / 7) + ($ACC[3])+($MLVL/15));
			
 
			
			

        if($drop=="armor"){
            if($iLVL > $minforPlayerLVL  and $hashClaimed != 1 and $valueArmorP >= 1 and $valueArmorM >= 1 and $apsorb >= 1 and $maxforPlayerLVL >= $iLVL){
				 $rel = 1;
				 
			}
			else if($ev == 1 and $iLVL > $min  and $hashClaimed != 1 and $valueArmorP >= 1 and $valueArmorM >= 1 and $apsorb >= 1 and $max >= $iLVL){
				$rel = 1;
			}

        }
        if($drop=="talisman"){
			if($iLVL > $minforPlayerLVL  and $hashClaimed != 1 and $apsorb >= 1 and $hpBonus >= 1 and $xpBonus >= 1 and $dmgBonus >= 1 and $maxforPlayerLVL >= $iLVL){
				 $rel = 1;
			}
			else if($ev == 1 and $iLVL > $min  and $hashClaimed != 1 and $apsorb >= 1 and $hpBonus >= 1 and $xpBonus >= 1 and $dmgBonus >= 1 and $max >= $iLVL){
				$rel = 1;
			}

        }
        if($drop=="weapon"){
            if($iLVL > $minforPlayerLVL  and $hashClaimed != 1 and $weaponCrit >= 1 and $weaponPhysMin >= 1 and $weaponMagMin >=1 and $maxforPlayerLVL >= $iLVL){
				 $rel = 1;
			}
			else if($ev == 1 and $iLVL > $min  and $hashClaimed != 1 and $weaponCrit >= 1 and $weaponPhysMin >= 1 and $weaponMagMin >=1 and $max >= $iLVL){
				$rel = 1;
			}
		}
		 if($drop=="skill"){
            if($hashClaimed != 1 and $Buff >= 1 and $iLVL < $max){
				 $rel = 1;
			}
		 }
		



            
        }
		//select what aarray to transfer
		 if($drop=="armor"){
			  return array ($HASH, $iLVL, $name, $typeName, $valueArmorP, $valueArmorM, $part, $apsorb, $Effect, $EffectChance);}
		if($drop=="weapon"){
			  return array ($HASH, $name, $typeName, $iLVL, $weaponPhysMin, $weaponPhysMax, $weaponCrit, $weaponMagMin, $weaponMagMax, $weaponHit, $weaponSkill, $Effect, $EffectChance);}
		if($drop=="talisman"){ 
			 return array ($HASH, $part, $name, $typeName, $iLVL, $apsorb, $hpBonus, $xpBonus, $dmgBonus, $RESISTef, $RESISTst);}
		if($drop=="skill"){ 
			 return array ($HASH, $name, $typeName, $iLVL, $Buff, $SkillID);}
		
		
    }
}


//MONTERS!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
function createMonster($db,$iLVL){

    $creationDone=false;
    $timeCreated=0;
    $testMessage="Test Start run $timeCreated <br>";
    $equipableItems=5; //how many items give iLVL
	
	//limits by level:
	if ($iLVL <= 100){
	$equipableItems=6;
	$limitbonus = 10;}
	if ($iLVL <= 300){
	$equipableItems=6;
	$limitbonus = 20;}
	if ($iLVL <= 800){
	$equipableItems=6;		
	$limitbonus = 30;}
	if ($iLVL <= 1000){
	$equipableItems=6;	
	$limitbonus = 40;}
	if ($iLVL <= 1300){
	$equipableItems=6;
	$limitbonus = 50;}
	if ($iLVL <= 1500){
	$equipableItems=7;
	$limitbonus = 60;}
	if ($iLVL <= 1800){
	$equipableItems=7;
	$limitbonus = 70;}
	if ($iLVL <= 2000){
	$equipableItems=8;
	$limitbonus = 80;}
	if ($iLVL <= 2199){
	$equipableItems=8;
	$limitbonus = 85;}
	if ($iLVL >= 2200){
	$equipableItems=8;		
	$limitbonus = 90;}
	
	
	
	
	
	
    while(!$creationDone){
        //Nullify vars
        $timeCreated++;
        $N2 = "";   
        $N3 = "";
        $N4 = "";
        $N5 = "";
        $NE = "";
        $Class = "";    
        $mLVL = 0;
        $Dmg = 0;
        $Drop = 0;
        $elvl = 0;
        $baseName = "";
        $baseHP = "";
        $baseLVL = "";
        $baseDMG = "";
        $baseDrop = "";

        //base range
        $baseLow=round($iLVL/$equipableItems-(5*$timeCreated),0); //Four items give lvl so we devide by four, 0.6 is 60% of your that level, -20 is for low numbers
        $baseHigh=round($iLVL/$equipableItems+(5*$timeCreated),0);
        if($baseLow<1){
            $baseLow=1;
        }
        $testMessage.="Base low $baseLow and high $baseHigh <br>";
        $extraName="";
        //get all the db info
        $Base = mysqli_query($db,"SELECT * FROM monsters WHERE LVL>='$baseLow' AND LVL<='$baseHigh' Order by RAND() Limit  1");
        if(mysqli_num_rows($Base)==0 AND $timeCreated>40){
            $testMessage.="could not find correct".mysqli_num_rows($Base)." or $timeCreated times runned <br>";
            $Base = mysqli_query($db,"SELECT * FROM monsters Order by RAND() Limit  1");
            $extraName="3RR0R";
        }
        else if(mysqli_num_rows($Base)==0){
            continue;
        }
        list($baseName, $baseHP, $baseLVL, $baseDMG, $baseDrop) = mysqli_fetch_row($Base);
        $testMessage.="fetched bases $baseName | $baseHP | $baseLVL | $baseDMG | $baseDrop  <br>";

        $Pref = mysqli_query($db,"SELECT * FROM monspre Order by RAND() Limit   1");
        list($preName, $preDrop, $preHP, $preDMG, $preLVL) = mysqli_fetch_row($Pref);
        $testMessage.="fetched Pre ... <br>";

        $Sub = mysqli_query($db,"SELECT * FROM monssub Order by RAND() Limit    1");
        list($subName, $subDrop, $subHP, $subDMG, $subLVL) = mysqli_fetch_row($Sub);
        $testMessage.="fetched Sub ... <br>";

        $ench = mysqli_query($db,"SELECT * FROM monsenchant Order by RAND() Limit   1");
        list($enchantName, $enchantLVL, $enchantEff) = mysqli_fetch_row($ench);
        $testMessage.="fetched Ench ... <br>";

        //pick picture
        $monsterImageID=rand(1,21);
        //$_SESSION["MonsIMG"] = $monsterImageID;
        $testMessage.="Got image ID $monsterImageID <br>";
        //rng chances

        //base set up
        $nameBase = $baseName;
        $HP = $baseHP;
        $mLVL = $baseLVL;            
        $DMG = $baseDMG;
        $Drop = $baseDrop;
        $testMessage.="Current Stats $Name | $mLVL | $HP | $DMG | $Drop <br>";

        //Pre Set Up
        if (rand(1,100) <= 40){
            $testMessage.="Pre aprroved more than 40 <br>";
            $namePre = $preName;
            $HP *= $preHP;
            $DMG *= $preDMG;
            $mLVL += $preLVL;
            $Drop += $Drop * $preDrop /100;
            $testMessage.="Current Stats $Name | $mLVL | $HP | $DMG | $Drop <br>";
        }
        //Sub Set Up
        if (rand(1,100) <= 30){
            $testMessage.="Sub aprroved more than 30 with the Sub $subName <br>";
            $nameSub = $subName;
            $HP *= $subHP;
            $mLVL += $subLVL;
            $DMG *= $subDMG;
            $Drop += $Drop * $subDrop / 100;
            $testMessage.="Current Stats $Name | $mLVL | $HP | $DMG | $Drop <br>";
        }
        //Enchant Set Up
        if (rand(1,100) <= 20){
            $testMessage.="enchant approved more than 20 <br>";
            $nameEnchant = $enchantName;
            $HP *= $enchantEff;
            $mLVL *= $enchantEff; //$monsterLVL -> $enchantEff
            $DMG *= $enchantEff;
            $Drop *= $enchantEff;
            $testMessage.="Current Stats $Name | $mLVL | $HP | $DMG | $Drop <br>";
        }

        if (rand(1,300) == 100){
            $testMessage.="Rare approved exact at 100 <br>";
            $nameRare = "<b style='color:#ff0066'>! RARE !</b>";
            $HP *= 1.35;
            $mLVL *= 1.5;
            $DMG *= 1.2;
            $Drop *= 10;
            $_SESSION["MonsR"] = 1;
            $testMessage.="Current Stats $Name | $mLVL | $HP | $DMG | $Drop <br>";
        }
        //finnish up
        $name="$extraName $nameRare $nameEnchant $namePre $nameBase $nameSub";
        $HP = round($HP,0);
        $mLVL = round($mLVL,0);
        $PDMG = round($DMG*rand(80,120)/100,0);
		$MDMG = round($DMG*rand(60,150)/100,0);
        $Drop = round($Drop,0);
        
        //limits
        $limitMaxLVL=$iLVL/$equipableItems+$limitbonus;
        $limitMinLVL=$iLVL/$equipableItems-(10+$limitbonus/10);
        if($limitMinLVL<1){
            $limitMinLVL=1;
        }
        $testMessage.="limits are >$limitMinLVL <$limitMaxLVL <br>";
        //check if monster is good enough
        if(($mLVL<=$limitMaxLVL AND $mLVL>=$limitMinLVL) OR $timeCreated>100 OR $isTest){
            $testMessage.="Found Correct monsted or $timeCreated >100 <br>";
            $testMessage.="Monster: $name |LVL $mLVL |HP $HP |DMG $DMG |DROP $Drop <br>";
            $creationDone=true;
        }

    }
    return array ($name, $mLVL, $HP, $PDMG, $MDMG, $Drop, $monsterImageID, $testMessage);

}
