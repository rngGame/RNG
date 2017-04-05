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
function itemDrop($db,$drop,$MLVL){
    if($drop=="all"){
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
    }
    if($drop=="armor"||$drop=="talisman"||$drop=="weapon"){

        $preTable="prefixwep";
        //check which item
        if($drop=="armor"){
            $baseTable="basearmor";
        }
        else if($drop=="talisman"){
            $baseTable="basetalis";
            $preTable="pretalis";
        }
        else if($drop=="weapon"){
            $baseTable="basewep";
        }


        $rel = 0;

        while ($rel == 0){
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

            //bases set up
            $nameBase = $baseHP; //takes the base name for the Armor
            if($drop=="armor"){
                $iLVL = $baseDMG; //base level
                $valueArmor = $baseLVL; //base armor
            }
            if($drop=="weapon"){
                $iLVL = $baseDMG; //base level
                $valueDMG = $baseLVL; //base dmg
            }
            if($drop=="talisman"){
                $iLVL = $baseLVL;//base lvl
                $valueDMG = $baseDMG;//base dmg 
                $valueArmor = $baseDrop;//base armor
                $valueHP = $Base[5];//base HP
                $valueXP = $Base[6]; //base XP
            }
            //Prefix for talismans
            if($rngPre>3000 && $drop=="talisman"){
                $namePre=$Pre[1];
                $valueDMG*=$Pre[2];
                $valueArmor*=$Pre[2];
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
            //Subfix for talismans
            if($rngSub>3000 && $drop=="talisman"){
                $nameSub = "and $Sub[1]";
                $valueDMG +=$Sub[3];
                $valueArmor +=$Sub[3]/3;
                $valueHP +=$valueHP*$Sub[3]/200;
                $valueXP *=1.2;
                $iLVL +=$Sub[2];
            }
            //Subfixes for armor
            if($rngSub > 2000 && $drop=="armor"){  //checks for first Sub rng
                $nameSub ="of $Sub[1]";
                $valueArmor += $Sub[3]/2;
                $iLVL += $Sub[2];
                if($rngSub > 3000){ //checks for second Sub rng
                    $nameSub2 ="and $Sub2[1]";
                    $valueArmor += $Sub2[3]/2;
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
                $color = "$Type[4]";
                $typeBonus=$Type[3] / 100;
                $valueDMG += $valueDMG * $typeBonus;
                $valueArmor += $valueArmor * $$typeBonus;
                $valueHP += $valueHP * $typeBonus;
                $iLVL += $iLVL * $typeBonus;
            }
            else if($rngType < $Type2[2]*200){ //checks for Type rng second time
                $typeName ="$Type2[1]";
                $color = "$Type2[4]";
                $typeBonus=$Type[3] / 100;
                $valueDMG += $valueDMG * $typeBonus;
                $valueArmor += $valueArmor * $typeBonus;
                $valueHP += $valueHP * $typeBonus;
                $iLVL += $iLVL * $typeBonus;
            }
            //Skill for Weapon
            if($rngSkill>9600){
                $iLVL+=$Skill[7];
                $skillName = $Skill[1];
                $skillID = $Skill[0];
                $skillText = "Skill : $Skill[1]<br>";
            }

            //check how many enchants rng
            while($Ench = mysqli_fetch_array($Enchant and $drop!="weapon")) {
                if($Ench[1] > rand(-200,400-$MLVL)){
                    $enchantLVL += 1;
                    }
                else{break;}
            }
            if($enchantLVL > 0){
                $Plius = mysqli_query($db,"SELECT * FROM enchantdrop WHERE `Enchant` = '$enchantLVL'");
                $Plius = mysqli_fetch_row($Plius);
                $nameEnchant = "+ $enchantLVL";
                $valueDMG += $valueDMG * $Plius[2] / 100;
                $valueArmor += $valueArmor * $Plius[2] / 100;
                $valueHP += $valueHP * $Plius[2] / 100;
                $iLVL += $iLVL * $Plius[2] / 100;
            }

            //Creating weapon values
            $valuePhysMin = round($valueDMG * rand(80,100)/100);
            $valuePhysMax = round($valueDMG * rand(100,130)/100);
            $CRIT = round(1 + 10*$typeBonus);
            $AS = round(rand(80,150)/100,1);
            $valueMagMIN = round($valueDMG *rand(1,50)/100);
            $valueMagMAX = round($valueDMG *rand(1,150)/100);  
            $HIT = rand(85,100);

            //finnishing up values
            $iLVL = round($iLVL, 0);
            $valueDMG = round($value, 0);
            $valueArmor = round($valueArmor, 0);
            $valueHP = round($valueHP, 0);
            $valueXP = round($valueXP, 1);

            if($valueDMG <= 0){
                $valueDMG = 1;
            }
            if($valueArmor <= 0){
                $valueArmor = 1;
            }
            if($valueHP <= 0){
                $valueHP = 1;
            }
            if($valueXP <= 0){
                $valueXP = 1;
            }

            //hashing item
            $hashClaimed = 0;
            $HASH = rand(-90000000,900000000);
            $HASH = $HASH * $iLVL;
            $HASH = $HASH + rand(-1000,1000);
            $result = mysqli_query($db,"SELECT * FROM weapondrops WHERE HASH = '$HASH'");
            $count = mysqli_num_rows($result);
            if($count==1){ //if hash claimed, we will redo this
                $hashClaimed = 1;
            }


            $name="$namePre $nameBase $nameSub $nameSub2 $nameEnchant";


            if(!$typeName == ""){ //coloring the name, if needed
                $itemName = "<b class='$color'>$name ($typeName)</b>";
            }
            else{
                $itemName = "<b>$name</b>";
            }
            //deciding on effect
            if (rand(0,100) < 15){
                $rngEffect = rand(1,5);
                if ($rngEffect == 1){
                    $effectName = "Life Leach";
                    $effectShort = "LL";
                    $effectChance = rand(1,7);
                }
                if ($rngEffect == 2){
                    $effectName = "Bleed";
                    $effectShort = "BL";
                    $effectChance = rand(10,30);
                }
                if ($rngEffect == 3){
                    $effectName = "Burn";
                    $effectShort = "BR";
                    $effectChance = rand(1,20);
                }
                if ($rngEffect == 4){
                    $effectName = "Freez";
                    $effectShort = "FR";
                    $effectChance = rand(10,20);
                    
                }
                if ($rngEffect == 5){
                    $effectName = "Stun";
                    $effectShort = "ST";
                    $effectChance = rand(5,30);
                }
                if ($rngEffect == 6){
                    $effectName = "Shock";
                    $effectShort = "SH";
                    $effectChance = rand(20,50);
                    
                }
                if ($rngEffect == 7){
                    $effectName = "Block";
                    $effectShort = "BK";
                    $effectChance = rand(5,20);
                    
                }
                if ($rngEffect == 8){
                    
                }
                if ($rngEffect == 9){
                    
                }
                
                if ($rngEffect == 10){
                    
                }
                $effect = "Effect: $effectName $effectChance %<br>";
            }

            //creating lowest weapon, best weapon acording to level
            $rngValueMax = $MLVL*1.2;
            $rngValueMin = $MLVL/1.5;

            if($iLVL < $rngValueMax and $iLVL > $rngValueMin and ($drop!="weapon" or ($valueDMG > 0 and $CRIT >0 and $hashClaimed != 1))){ //if weapon is okay acording to level, stop while
                $rel = 1;
            }
        }
        return array ($iLVL, $HASH, $name, $color, $itemName, $typeName, $valueDMG, $valueArmor, $valueHP, $valueXP, $skillText, $skillID, $effect, $effectShort, $effectChance, $valuePhysMin, $valuePhysMax, $CRIT, $AS, $HIT, $maMIN, $maMAX);
    }
}

function createMonster($db,$iLVL){

    $creationDone=false;
    $timeCreated=0;
    $testMessage="Test Start run $timeCreated <br>";
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
        $baseLow=round($iLVL*0.6/4-(5*$timeCreated),0); //Four items give lvl so we devide by four, 0.6 is 60% of your that level, -20 is for low numbers
        $baseHigh=round($iLVL*1.4/4+(5*$timeCreated),0);
        if($baseLow<1){
            $baseLow=1;
        }
        $testMessage.="Base low $baseLow and high $baseHigh <br>";
        //get all the db info
        $Base = mysqli_query($db,"SELECT * FROM monsters WHERE LVL>='$baseLow' AND LVL<='$baseHigh' Order by RAND() Limit  1");
        if(mysqli_num_rows($Base)==0 OR $timeCreated==99){
            $testMessage.="could not find correct".mysqli_num_rows($Base)." or $timeCreated times runned <br>";
            $Base = mysqli_query($db,"SELECT * FROM monsters Order by RAND() Limit  1");
            $extraName="3RR0R";
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
        $DMG = round($DMG,0);
        $Drop = round($Drop,0);
        $timeCreated++;
        //limits
        $limitMaxLVL=$iLVL/4+30;
        $limitMinLVL=$iLVL/4-30;
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
    return array ($name, $mLVL, $HP, $DMG, $Drop, $monsterImageID, $testMessage);

}
