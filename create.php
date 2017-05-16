<?php
session_start();
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>World of RNG</title>
<link rel="stylesheet" type="text/css" href="css/meniu.css">
</head>
<body>
<header>
World Of RNG
</header>
<?php
include_once 'PHP/db.php';

    // If the values are posted, insert them into the database.
	    $username = $_POST['username'];
        $password = $_POST['password'];
		$char = $_POST['char'];
		
		
	//hardcore char
	$hc = 0;
	if(isset($_POST['Hardcore'])){
		$hc = 1;
	}
		
//ONLY CHAR CREATE
if(isset($_SESSION["HAVE"])){	

$results = mysqli_query($db,"SELECT * FROM characters WHERE User = '$char'"); //character check
$countCH = mysqli_num_rows($results);

if(!$countCH ==1){

$Account = $_SESSION["Account"];

$result = mysqli_query($db, "SELECT * FROM Achievments where User = '$Account'");
$points = mysqli_num_rows($result);

$query2 = "INSERT INTO Points (User, Free, STR, INTE) VALUES ('$char', '$points', '0', '0')";
$result = mysqli_query($db,$query2);

$order3 = "INSERT INTO Equiped
(User, Part, HASH, Equiped)
VALUES
('$char', 'WEP', '0001', '1')";	

$result = mysqli_query($db, $order3);	


$order2 = "INSERT INTO characters
	   (User, Hardcore, HP, LVL, Cash, XP, Deaths, Account, Class, Rank, Gem_h, Shards )
	  VALUES
	   ('$char','$hc','5','1', '100', '1', '', '$Account', '0', '1000', '0004', '0')";
	   
$result = mysqli_query($db, $order2);		
			
			
			$_SESSION["User"] = $char;
			
			header("location:sync.php");
			die();
        


}
else{
				header("location:sync.php");
			die();}
}

//NEW ACCOUNT AND CHAR
$hashed_password = crypt($password); // let the salt be automatically generated
		
$result = mysqli_query($db,"SELECT * FROM account WHERE user = '$username'"); //account check
$count = mysqli_num_rows($result);
$results = mysqli_query($db,"SELECT * FROM characters WHERE User = '$char'"); //character check
$countCH = mysqli_num_rows($results);
$result2 = mysqli_query($db,"SELECT * FROM DropsWep WHERE HASH = '0001'");
$count2 = mysqli_num_rows($result2);	
$result4 = mysqli_query($db,"SELECT * FROM Gems WHERE Type = 'None'");
$count4 = mysqli_num_rows($result4);
if(!$count==1 and !$countCH ==1){
	
    if (isset($_POST['username']) && isset($_POST['password'])){
        $query = "INSERT INTO account (User, Psw, Theme, last_char) VALUES ('$username', '$hashed_password', 'meniu_dark', '$char')";
        $result = mysqli_query($db,$query);}
		$query2 = "INSERT INTO Points (User, Free, STR, INTE) VALUES ('$char', '1', '0', '0')";
        $result = mysqli_query($db,$query2);
        if($result){
            $msg = "User Created Successfully.";
		}


if ($count2 >= 1){
	 }
else {
$order2 = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus)
	  VALUES
	   ('0001', 'Wooden Sword', '', '1', '1', '5', '1', '1', '5', '90', '', '', '', '0')";
	   $result = mysqli_query($db, $order2);
	   }   
	   
$order3 = "INSERT INTO Equiped
(User, Part, HASH, Equiped)
VALUES
('$char', 'WEP', '0001', '1')";	

$result = mysqli_query($db, $order3);	


$order2 = "INSERT INTO characters
	   (User, Hardcore, HP, LVL, Cash, XP, Deaths, Account, Class, Rank, Gem_h, Shards )
	  VALUES
	   ('$char','$hc','5','1', '100', '1', '', '$username', '0', '1000', '0004', '0')";
	   
$result = mysqli_query($db, $order2);		
			
			
			
			header("location:index.php");
			die();
        }
else{
		echo "Acount already created";
		echo '<section class="container">
    <div class="logout">
	      <form method="post" action="index.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>';}
    ?>
