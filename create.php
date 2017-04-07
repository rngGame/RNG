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
		
$hashed_password = crypt($password); // let the salt be automatically generated
		
$result = mysqli_query($db,"SELECT * FROM account WHERE user = '$username'");
$count = mysqli_num_rows($result);
$result2 = mysqli_query($db,"SELECT * FROM drops WHERE HASH = '0001'");
$count2 = mysqli_num_rows($result2);	
$result3 = mysqli_query($db,"SELECT * FROM dropst WHERE LVL = '0'");
$count3 = mysqli_num_rows($result3);	
$result4 = mysqli_query($db,"SELECT * FROM Gems WHERE Type = 'None'");
$count4 = mysqli_num_rows($result4);
if(!$count==1){
	
    if (isset($_POST['username']) && isset($_POST['password'])){
        $query = "INSERT INTO account (User, Psw, Theme) VALUES ('$username', '$hashed_password', 'meniu_dark')";
        $result = mysqli_query($db,$query);}
		$query2 = "INSERT INTO Points (User, Free, STR, INTE) VALUES ('$username', '1', '0', '0')";
        $result = mysqli_query($db,$query2);
        if($result){
            $msg = "User Created Successfully.";
		}


if ($count2 == 1){
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
('$username', 'WEP', '0001', '1')";	

$result = mysqli_query($db, $order3);	


$order2 = "INSERT INTO characters
	   (User, wep_h, HP, LVL, Cash, XP, Arm_h, Tali_h, Class, Rank, Gem_h, Shards, Speed)
	  VALUES
	   ('$username','','5','1', '100', '1', '', '', '0', '1000', '0004', '0', '100')";
	   
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
