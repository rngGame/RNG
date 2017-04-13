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

function login($vardas, $password, $db) {
    // Using prepared statements means that SQL injection is not possible. 
    if ($stmt = $db->prepare("SELECT id, username, password, salt 
        FROM members
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
 
        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
            if (checkbrute($user_id, $mysqli) == true) {
                // Account is locked 
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    }
}
function itemDrop($db,$user,$drop,$MLVL){
    $textMessage="Function Starts by $user at ".date('Y-m-d H:i:s')." \r\n";
    if($drop=="all"){
        $textMessage.="Drop not decided Choosing one at random \r\n";
        $check=rand(1,3);
        if($check==1){
            $drop ="talisman";
        }
        else if($check==2){
            $drop="armor";
        }
        else if($check==3){
            $drop="weapon";
        }
        $textMessage.="Chosen $drop \r\n";
    }
    if($drop=="armor"||$drop=="talisman"||$drop=="weapon"){
        $textMessage.="Starting Process \r\n";

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
        $textMessage.="Chosen Tables $baseTable and $preTable \r\n";


        $rel = 0;

        while ($rel == 0){
            $textMessage.="Starting While for Creation |<>|";
            //get info from db general
            $Base = mysqli_query($db,"SELECT * FROM $baseTable Order by RAND() Limit     1");
            $Base = mysqli_fetch_row($Base);
            $Pre = mysqli_query($db,"SELECT * FROM $preTable Order by RAND() Limit   1");
            $Pre = mysqli_fetch_row($Pre);
            $Sub = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit  1");
            $Sub = mysqli_fetch_row($Sub);
            $Type = mysqli_query($db,"SELECT * FROM types Order by RAND() Limit     1");
            $Type = mysqli_fetch_row($Type);
            $Type2 = mysqli_query($db,"SELECT * FROM types Order by RAND() Limit    1");
            $Type2 = mysqli_fetch_row($Type2);
            $Sub2 = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit     1");
            $Sub2 = mysqli_fetch_row($Sub2);
            $Skill = mysqli_query($db,"SELECT * FROM iskills Order by RAND() Limit  1");
            $Skill = mysqli_fetch_row($Skill);
            $Enchant = mysqli_query($db,"SELECT * FROM enchantdrop");

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
            $textMessage.="Deecided on RNG rolls: Pre $rngPre , Sub $rngSub , Skill $rngSkill , Type $rngType \r\n";

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
            $textMessage.="Bases done for $drop Bases: Name $nameBase >> LVL $iLVL >> DMG $valueDMG >> Armor $valueArmor >> HP $valueHP >> XP $valueXP \r\n";
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
                $valueDMG+=$Pre[3];
                $iLVL+=$Pre[2];
            }
            $textMessage.="Prefix done for $drop Prefixes: Name $namePre >> LVL $iLVL >> DMG $valueDMG >> Armor $valueArmor >> HP $valueHP >> XP $valueXP \r\n";
            //Subfix for talismans
            if($rngSub>3000 && $drop=="talisman"){
                $nameSub = "and $Sub[1]";
                $valueDMG +=$Sub[3];
                $valueHP +=$valueHP*$Sub[3]/200;
                $valueXP *=1.2;
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
            $textMessage.="Subfixes done for $drop Subfix: Name $nameSub >> LVL $iLVL >> DMG $valueDMG >> Armor $valueArmor >> HP $valueHP >> XP $valueXP \r\n";
            //Types for drops x2
            if($rngType < $Type[2]*200){ //checks for Type rng first time
                $typeName ="$Type[1]";
                $typeBonus=$Type[3] / 100;
                $valueDMG += $valueDMG * $typeBonus;
                $valueArmorP += $valueArmorP * $typeBonus;
				$valueArmorM += $valueArmorM * $typeBonus;
                $valueHP += $valueHP * $typeBonus;
                $iLVL += $iLVL * $typeBonus;
            }
            else if($rngType < $Type2[2]*200){ //checks for Type rng second time
                $typeName ="$Type2[1]";
                $typeBonus=$Type[3] / 100;
                $valueDMG += $valueDMG * $typeBonus;
                $valueArmorP += $valueArmorP * $typeBonus;
				$valueArmorM += $valueArmorM * $typeBonus;
                $valueHP += $valueHP * $typeBonus;
                $iLVL += $iLVL * $typeBonus;
            }
            $textMessage.="Types done for $drop Type: Name $typeName >> LVL $iLVL >> DMG $valueDMG >> Armor $valueArmor >> HP $valueHP >> XP $valueXP \r\n";
            //Skill for Weapon
            if($rngSkill>9600){
                $iLVL+=$Skill[7];
                $skillName = $Skill[1];
                $weaponSkill = $Skill[0];
                $skillText = "Skill : $Skill[1]<br>";
            }
            $textMessage.="Skills done for $drop $skillName Chosen \r\n";

            //check how many enchants rng
            /*while($Ench = mysqli_fetch_array($Enchant) and $drop!="weapon") {
                
                if($Ench[1] > rand(-200,400-$MLVL)){
                    $enchantLVL += 1;
                    }
                else{break;}
            }*/
            //$textMessage.="Enchanting $enchantLVL \r\n";
            /*if($enchantLVL > 0){
                $textMessage.="Doing Enchant";
                $Plius = mysqli_query($db,"SELECT * FROM enchantdrop WHERE `Enchant` = '$enchantLVL'");
                $Plius = mysqli_fetch_row($Plius);
                $nameEnchant = "+ $enchantLVL";
                $valueDMG += $valueDMG * $Plius[2] / 100;
                $valueArmor += $valueArmor * $Plius[2] / 100;
                $valueHP += $valueHP * $Plius[2] / 100;
                $iLVL += $iLVL * $Plius[2] / 100;
                $textMessage.="Result of enchant : Name $nameEnchant >> LVL $iLVL >> DMG $valueDMG >> Armor $valueArmor >> HP $valueHP >> XP $valueXP \r\n";
            }*/

            //Creating weapon values
            $weaponPhysMin = round($valueDMG * rand(80,100)/100);
            $weaponPhysMax = round($valueDMG * rand(101,130)/100);
            $weaponCrit = round(1 + 10*$typeBonus);
            $weaponMagMin = round($valueDMG *rand(50,100)/100);
            $weaponMagMax = round($valueDMG *rand(150,200)/100);  
            $weaponHit = rand(85,100);
            $textMessage.="Creating Weapon Stats Phys $valuePhysMin ~ $valuePhysMax >> Mag $valueMagMIN ~ $valueMagMAX >> Crit $CRIT >> Speed $AS >> Hit $HIT \r\n";

            //finnishing up values
            $iLVL = round($iLVL, 0);
            $dmgBonus = round($valueDMG/10);
            $valueArmorP = round($valueArmorP + ($valueArmorP * rand(-20,15) / 100));
			$valueArmorM = round($valueArmorM + ($valueArmorM * rand(-5,30) / 100));
            $hpBonus = round($valueHP/50);
            $xpBonus = round($valueXP*10);
			
			
			
            $textMessage.="Rounding Orrignal \r\n";

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
            $textMessage.="No 0 \r\n";

            //hashing item
            $hashClaimed = 0;
            $HASH = rand(-90000000,900000000);
            $HASH = $HASH * $iLVL;
            $HASH = $HASH + rand(-1000,1000);
            $result = mysqli_query($db,"SELECT * FROM weapondrops WHERE HASH = '$HASH'");
            $count = mysqli_num_rows($result);
            if($count==1){ //if hash claimed, we will redo this
                $hashClaimed = 1;
                $textMessage.="Hashing Failed \r\n";
            }
            $textMessage.="Hashing Complete \r\n";


            $name="$namePre $nameBase $nameSub $nameSub2 $nameEnchant";


            if(!$typeName == ""){ //coloring the name, if needed
                $itemName = "<b class='$color'>$name ($typeName)</b>";
            }
            else{
                $itemName = "<b>$name</b>";
            }
            //deciding on effect
            if (rand(0,100) < 15){
                $rngEffect = rand(1,8);
                if ($rngEffect == 1){
                    $effectName = "Life Leach";
                    $weaponEffect = "LL";
                    $weaponEffectChance = rand(1,7);
                }
                if ($rngEffect == 2){
                    $weaponEffect = "Bleed";
                    $effectShort = "BL";
                    $weaponEffectChance = rand(10,30);
                }
                if ($rngEffect == 3){
                    $effectName = "Burn";
                    $weaponEffect = "BR";
                    $weaponEffectChance = rand(1,20);
                }
                if ($rngEffect == 4){
                    $effectName = "Freez";
                    $weaponEffect = "FR";
                    $weaponEffectChance = rand(10,20);
                    
                }
                if ($rngEffect == 5){
                    $effectName = "Stun";
                    $weaponEffect = "ST";
                    $weaponEffectChance = rand(5,30);
                }
                if ($rngEffect == 6){
                    $effectName = "Shock";
                    $weaponEffect = "SH";
                    $weaponEffectChance = rand(20,50);
                    
                }
                if ($rngEffect == 7){
                    $effectName = "Block";
                    $weaponEffect = "BK";
                    $weaponEffectChance = rand(5,20);
                    
                }
                 if ($rngEffect == 8){
                    $effectName = "Summon";
                    $weaponEffect = "SM";
                    $weaponEffectChance = rand(25,70);
                    
                }
                if ($rngEffect == 9){
                    
                }
                
                if ($rngEffect == 10){
                    
                }
                $effect = "Effect: $effectName $effectChance %<br>";
                $textMessage.="Choose Effect $effectName $weaponEffectChance % \r\n";
            }

            //creating lowest weapon, best weapon acording to level
            $rngValueMax = $MLVL*1.2;
            $rngValueMin = $MLVL/1.5;
            $textMessage.="Limits are $rngValueMin - $rngValueMax \r\n";
			
			

        if($drop=="armor"){
            if($iLVL < $rngValueMax and $iLVL > $rngValueMin  and $hashClaimed != 1 and $valueArmorP >= 1 and $valueArmorM >= 1 and $apsorb >= 1){
				 $rel = 1;
			}

        }
        if($drop=="talisman"){
			if($iLVL < $rngValueMax and $iLVL > $rngValueMin  and $hashClaimed != 1 and $apsorb >= 1 and $hpBonus >= 1 and $xpBonus >= 1 and $dmgBonus >= 1){
				 $rel = 1;
			}

        }
        if($drop=="weapon"){
            if($iLVL < $rngValueMax and $iLVL > $rngValueMin  and $hashClaimed != 1 and $weaponCrit >= 1){
				 $rel = 1;
			}
        }
		



				$textMessage.="Function FINISHED by $user at ".date('Y-m-d H:i:s')." \r\n";
                $textMessage.="Succesfully completed item \r\n Name $name >> LVL $iLVL >> DMG $valueDMG >> Armor $valueArmor >> HP $valueHP >> XP $valueXP \r\n Phys $valuePhysMin ~ $valuePhysMax >> Mag $valueMagMIN ~ $valueMagMAX >> Crit $CRIT >> Hit $HIT \r\n _______________________________________ \r\n";
            
        }
        $myfile = fopen("Logs/Logs".date('Y-m-d').".txt", "x+");
        $myfile = fopen("Logs/Logs".date('Y-m-d').".txt", "a+") or die("Unable to open file!");
        fwrite($myfile, $textMessage);
        fclose($myfile);
		//select what aarray to transfer
		 if($drop=="armor"){
			  return array ($HASH, $iLVL, $name, $typeName, $valueArmorP, $valueArmorM, $part, $apsorb);}
		if($drop=="weapon"){
			  return array ($HASH, $name, $typeName, $iLVL, $weaponPhysMin, $weaponPhysMax, $weaponCrit, $weaponMagMin, $weaponMagMax, $weaponHit, $weaponSkill, $weaponEffect, $weaponEffectChance);}
		if($drop=="talisman"){ 
			 return array ($HASH, $part, $name, $typeName, $iLVL, $apsorb, $hpBonus, $xpBonus, $dmgBonus);}
		
		
    }
}

function createMonster($db,$iLVL){

    $creationDone=false;
    $timeCreated=0;
    $testMessage="Test Start run $timeCreated <br>";
    $equipableItems=7; //how many items give iLVL
    while(!$creationDone){
        //Nullify vars
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
        $baseLow=round($iLVL*0.6/$equipableItems-(5*$timeCreated),0); //Four items give lvl so we devide by four, 0.6 is 60% of your that level, -20 is for low numbers
        $baseHigh=round($iLVL*1.4/$equipableItems+(5*$timeCreated),0);
        if($baseLow<1){
            $baseLow=1;
        }
        $testMessage.="Base low $baseLow and high $baseHigh <br>";
        $extraName="";
        //get all the db info
        $Base = mysqli_query($db,"SELECT * FROM monsters WHERE LVL>='$baseLow' AND LVL<='$baseHigh' Order by RAND() Limit  1");
        if(mysqli_num_rows($Base)==0 AND $timeCreated>90){
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
            $Drop += $preDrop;
            $testMessage.="Current Stats $Name | $mLVL | $HP | $DMG | $Drop <br>";
        }
        //Sub Set Up
        if (rand(1,100) <= 30){
            $testMessage.="Sub aprroved more than 30 with the Sub $subName <br>";
            $nameSub = $subName;
            $HP *= $subHP;
            $mLVL += $subLVL;
            $DMG *= $subDMG;
            $Drop += $subDrop;
            $testMessage.="Current Stats $Name | $mLVL | $HP | $DMG | $Drop <br>";
        }
        //Enchant Set Up
        if (rand(1,100) <= 20){
            $testMessage.="enchant approved more than 20 <br>";
            $nameEnchant = $enchantName;
            $HP *= $enchantEff;
            $mLVL += $enchantLVL;
            $DMG *= $enchantEff;
            $Drop += $enchantEff;
            $testMessage.="Current Stats $Name | $mLVL | $HP | $DMG | $Drop <br>";
        }

        if (rand(1,300) == 100){
            $testMessage.="Rare approved exact at 100 <br>";
            $nameRare = "<b style='color:#ff0066'>! RARE !</b>";
            $HP *= 1.15;
            $mLVL *= 1.5;
            $DMG *= 0.8;
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
        $timeCreated++;
        //limits
        $limitMaxLVL=$iLVL/$equipableItems+30;
        $limitMinLVL=$iLVL/$equipableItems-30;
        if($limitMinLVL<1){
            $limitMinLVL=1;
        }
        $testMessage.="limits are >$limitMinLVL <$limitMaxLVL <br>";
        //check if monster is good enough
        if(($mLVL<=$limitMaxLVL AND $mLVL>=$limitMinLVL) OR $timeCreated>100){
            $testMessage.="Found Correct monsted or $timeCreated >100 <br>";
            $testMessage.="Monster: $name |LVL $mLVL |HP $HP |DMG $DMG |DROP $Drop <br>";
            $creationDone=true;
        }
    }
    return array ($name, $mLVL, $HP, $PDMG, $MDMG, $Drop, $monsterImageID, $testMessage);

}
