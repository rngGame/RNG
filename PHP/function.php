<?php
include_once 'config.php';
include_once 'PHP/db.php';
 
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
function itemDrop($drop){
    if($drop=="all"){
        //$check=rand(1,1);
        $check=2;
        if($check==2){
            $drop="armor"
        }
    }
    if($drop=="armor"){
        //get info from db
        $Base = mysqli_query($db,"SELECT * FROM basearmor Order by RAND() Limit     1");
        $Base = mysqli_fetch_row($Base);
        $Sub = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit  1");
        $Sub = mysqli_fetch_row($Sub);
        $Sub2 = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit     1");
        $Sub2 = mysqli_fetch_row($Sub2);
        $Type = mysqli_query($db,"SELECT * FROM types Order by RAND() Limit     1");
        $Type = mysqli_fetch_row($Type);
        $Type2 = mysqli_query($db,"SELECT * FROM types Order by RAND() Limit    1");
        $Type2 = mysqli_fetch_row($Type2);

        $Enchant = mysqli_query($db,"SELECT * FROM enchantdrop");

        //Nulify vars
        $nameType = "";    
        $iLVL = 0;
        $armor = 0; //was dmg, delete comment before finnish
        $typeMulti = 0; //procental upgrade
        $elvl = 0; //???

        /*
        $n1 = $MLVL/1;
        $n3 = $MLVL/1.9;
        $n4 = $MLVL/2.4;
        $r = $n1 *2.5;
        */
        //rng stuff for 
        $rngSub = rand(1,99-($MLVL/1.9));
        $rngSub2 = rand(1,150-($MLVL/2.4));
        $rngType = rand(0,500-($MLVL*2.5));


        $nameBase = $Base[1]; //takes the base name for the Armor
        $iLVL = $Base[3]; //base level
        $armor = $Base[2]; //base armor
        if ($rngSub < 20){  
            $nameSub ="of $Sub[1]";
            $armor += $Sub[3]/2;
            $iLVL += $Sub[2];
            if ($rngSub2 < 30){
                $nameSub2 ="and $Sub2[1]";
                $armor += $Sub2[3]/2;
                $ILVL += $Sub2[2];
            }
        }
        if ($rngType < $Type[2]){
            $nameType ="$Type[1]";
            $color = "$Type[4]";
            $typeMulti = $armor * $Type[3] / 100;
            $Armor += $typeMulti/2;
            $typeMulti = $iLVL * $Type[3] / 100;
            $iLVL += $typeMulti;
        }
        else if ($rngType < $Type2[2]){
            $nameType ="$Type2[1]";
            $color = "$Type2[4]";
            $typeMulti = $armor * $Type2[3] / 100;
            $armor += $typeMulti/2;
            $typeMulti = $iLVL * $Type2[3] / 100;
            $ILVL += $typeMulti;}


    }
}