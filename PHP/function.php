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
        $check=rand(1,2);
        if($check==1){

        }
        if($check==2){
            $drop="armor";
        }
    }
    if($drop=="armor"||$drop=="talisman"){

        $rel = 0;

        while ($rel == 0){
            //get info from db general
            $Sub = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit  1");
            $Sub = mysqli_fetch_row($Sub);
            $Type = mysqli_query($db,"SELECT * FROM types Order by RAND() Limit     1");
            $Type = mysqli_fetch_row($Type);
            $Type2 = mysqli_query($db,"SELECT * FROM types Order by RAND() Limit    1");
            $Type2 = mysqli_fetch_row($Type2);
            $Enchant = mysqli_query($db,"SELECT * FROM enchantdrop");

            //talisman specific
            if($drop=="talisman"){
                $Base = mysqli_query($db,"SELECT * FROM basetalis Order by RAND() Limit     1");
                $Base = mysqli_fetch_row($Base);
                $Pre = mysqli_query($db,"SELECT * FROM pretalis Order by RAND() Limit   1");
                $Pre = mysqli_fetch_row($Pre);
            }

            //armor specific
            if($drop=="armor"){
                $Base = mysqli_query($db,"SELECT * FROM basearmor Order by RAND() Limit     1");
                $Base = mysqli_fetch_row($Base);
                $Sub2 = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit     1");
                $Sub2 = mysqli_fetch_row($Sub2);
            }

            //Nulify vars
            $nameType = "";    
            $iLVL = 0;
            $value= $value2= $value3= $value4= 0; //was dmg, delete comment before finnish
            $enchantLVL = 0; //give + to item

            //rng stuff for 
            $rngPre = rand(1,99-($MLVL/1.9));
            $rngSub = rand(1,99-($MLVL/1.9));
            $rngSub2 = rand(1,150-($MLVL/2.4));
            $rngType = rand(0,500-($MLVL*2.5));

            //bases
            $nameBase = $Base[1]; //takes the base name for the Armor
            if($drop=="armor"){
                $iLVL = $Base[3]; //base level
                $value = $Base[2]; //base armor
            }
            if($drop=="talisman"){
                $iLVL = $Base[2];
                $value = $Base[3];
                $value2 = $Base[4];
                $value3 = $Base[5];
                $value4 = $Base[6]; 
            }

            if($rngPre<30 && $drop=="talisman"){
                $namePre=$Pre[1];
                $value*=$Pre[2];
                $value2*=$Pre[2];
                $value3*=$Pre[2];
                $value4*=$Pre[2];
                $iLVL+=$Pre[3];

            }

            if($rngSub < 20 && $drop=="armor"){  //checks for first Sub rng
                $nameSub ="of $Sub[1]";
                $value += $Sub[3]/2;
                $value2
                $iLVL += $Sub[2];
                if($rngSub2 < 30){ //checks for second Sub rng
                    $nameSub2 ="and $Sub2[1]";
                    $value += $Sub2[3]/2;
                    $iLVL += $Sub2[2];
                }
            }
            if($rngType < $Type[2]){ //checks for Type rng first time
                $nameType ="$Type[1]";
                $color = "$Type[4]";
                $value += ($value * $Type[3] / 100)/2;
                $iLVL += $iLVL * $Type[3] / 100;
            }
            else if($rngType < $Type2[2]){ //checks for Type rng second time
                $nameType ="$Type2[1]";
                $color = "$Type2[4]";
                $value += ($value * $Type2[3] / 100)/2;
                $iLVL += $iLVL * $Type2[3] / 100;
            }

            //check how many enchants rng
            while($Ench = mysqli_fetch_array($Enchant)) {
                if($Ench[1] > rand(-200,400-$MLVL)){
                    $enchantLVL += 1;
                    }
                else{break;}
            }
            if($enchantLVL > 0){
                $Plius = mysqli_query($db,"SELECT * FROM enchantdrop WHERE `Enchant` = '$enchantLVL'");
                $Plius = mysqli_fetch_row($Plius);
                $nameEnchant = "+ $enchantLVL";
                $value += $value * $Plius[2] / 100;
                $iLVL += $iLVL * $Plius[2] / 100;
            }
            //finnishing up values
            $iLVL = round($iLVL, 0);
            $value = round($value, 0);

            if($value <= 0){
                $value = 1;
            }

            $name="$nameBase $nameSub $nameSub2 $nameEnchant";


            if(!$nameType == ""){ //coloring the name, if needed
                $new = "<b class='$color'>$name ($nameType)</b>";
            }
            else{
                $new = "<b>$name</b>";
            }

            //creating lowest weapon, best weapon acording to level
            $rngValueMax = $MLVL*1.2;
            $rngValueMin = $MLVL/1.5;

            if($iLVL < $rngValueMax and $iLVL > $rngValueMin){ //if weapon is okay acording to level, stop while
                $rel = 1;
            }
        }
        return array ($iLVL, $value, $name,$new,$nameType);
    }
}
