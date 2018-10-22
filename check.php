<?php
session_start();
ob_start();

$User = $_POST["login"];
$Psw = $_POST["password"];

if ($Psw == ""){
	header("location:index.php");
	die();}
	

include_once 'PHP/db.php';

//for older php
if(!function_exists('hash_equals'))
{
    function hash_equals($str1, $str2)
    {
        if(strlen($str1) != strlen($str2))
        {
            return false;
        }
        else
        {
            $res = $str1 ^ $str2;
            $ret = 0;
            for($i = strlen($res) - 1; $i >= 0; $i--)
            {
                $ret |= ord($res[$i]);
            }
            return !$ret;
        }
    }
}

$login = mysqli_query($db,"SELECT * FROM account WHERE user = '$User'");
$login = mysqli_fetch_row($login);

if (hash_equals($login[2], crypt($Psw, $login[2]))) {
	
	
   echo "Password verified! $hashed_password";
   $_SESSION["User"] = "$login[4]";
   $_SESSION["Account"] = "$login[1]";

	mysqli_close($db);
	header("location:sync.php");
	die();
}

else {
echo "Wrong Username or Password";
	header("location:index.php");
	die();
}




?>