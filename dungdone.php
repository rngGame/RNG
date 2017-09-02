<?php
session_start();
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>World of RNG</title>
<?php
echo "<link rel='stylesheet' type='text/css' href='css/$_COOKIE[Theme].css'>";
?>
<link rel="icon" href="favicon.png">
</head>
<body>
<header>
World Of RNG
</header>
<?php
include_once 'PHP/db.php';

$User = $_SESSION["User"];
$Account = $_SESSION["Account"];
$sell = $_SESSION["Sell"];
$Money = $_SESSION["Money"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
	
//death count
$dedNr = $ACC[7] + 1;
	
$order2 = "UPDATE characters
		SET Deaths = '$dedNr'
		WHERE `User` = '$User'";
$result = mysqli_query($db, $order2);


	$ACH = mysqli_query($db,"SELECT * FROM aStatus where user = '$Account' and Name = 'LOS'");
	$ACH = mysqli_fetch_row($ACH);
		if ($ACH[1]==""){
	$order = "INSERT INTO aStatus (User, Name, Status)
	VALUES ('$Account', 'LOS', '1')";
	$result = mysqli_query($db, $order);}
		else{
			$CCount = $ACH[2] + 1;
			$order = "UPDATE aStatus
			SET Status = '$CCount'
			WHERE `User` = '$Account' and `Name` = 'LOS'";
			$result = mysqli_query($db, $order);
		}
	
$panel = "right-panel"; //set panel for log
	
$kills = $_SESSION["RAIDKILLS"];
	
//write how many dung kills player done
if ($kills > $ACC[17]){
	
$order3 = "UPDATE characters
SET Dungeon = '$kills'
WHERE `User` = '$Account'";
$result = mysqli_query($db, $order3);
	
}
	
//rewards... will be pain in the ass...
	
if(isset($_SESSION["REW"])){
	
}
else{
	$_SESSION["REW"] = 1;
	$xpDrop =  $_SESSION["MonsDropDung"];
	
	$xp = $ACC[5] + $xpDrop;
	
	$order3 = "UPDATE characters
	SET XP = '$xp'
	WHERE `User` = '$Account'";
	$result = mysqli_query($db, $order3);
	
	
	$a1 = 1;
/*	while ($kills > $a1){
		
	if (rand(1,1000) <  (100+$kills)){
  	$rngShardsAmmount += rand(1,5);
	$ShardText ="And $rngShardsAmmount shard(-s)<br>";}
		
	
	if (rand(1,1000) < (300+$kills)){
	include 'PHP/items.php';
	
	$order4 = "INSERT INTO DropsItm
	(HASH, Name, EFT, Value, Icon )
	VALUES
	('$HASHIT', '$Name', '$EFT', '$value', '$icon')";
	   
	$order5 = "INSERT INTO Equiped
	(User, Part, HASH, Equiped)
	VALUES
	('$User', 'ITM', '$HASHIT', '0')";	   

	$result = mysqli_query($db, $order4);
	$result = mysqli_query($db, $order5);	
	
	$text .="<b style='color:#00e600'>You recived extra: $Name !!!</b><br>";
	}	
		
	$a1 = $a1 + 1;
		
	}*/
}
	
echo 'Lose<br>';
	
echo "You killed: $kills <br>";
	
echo "And recived: $xpDrop XP<br>$text $ShardText"; //NOT DONE

echo " <br><br><div class='$panel'>";
echo $_SESSION["LOG"];
echo '</div>';

echo '<div id="fightNewBut">
	<section class="actionButtons2">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
  </section>
  </div>
';
?>
