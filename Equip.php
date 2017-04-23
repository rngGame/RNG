<?php
session_start();
ob_start();
include_once 'PHP/db.php';
include_once 'PHP/function.php';

$User = $_SESSION["User"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);


if (isset($_POST['ITMS'])) {
	
	
	$newU = $_POST['ITMS'];
	$ITM = mysqli_query($db,"SELECT * FROM DropsItm where HASH = '$newU'"); //Item Usega
	$ITM = mysqli_fetch_row($ITM);
	
	if ($ITM[2] == "XP"){
		$XPS = $ACC[5] + ($ACC[5]  *  ($ITM[3]/2) /100);
			$order = "UPDATE characters
			SET XP = '$XPS'
			WHERE `User` = '$User'";
			$result = mysqli_query($db, $order);
	}
	if ($ITM[2] == "GOLD"){
		$XPS = $ACC[4] + ($ITM[3] * $ACC[3]) * 5;
			$order = "UPDATE characters
			SET Cash = '$XPS'
			WHERE `User` = '$User'";
			$result = mysqli_query($db, $order);
	}
	if ($ITM[2] == "SHRD"){
		$XPS = $ACC[15] + $ITM[3];
			$order = "UPDATE characters
			SET Shards = '$XPS'
			WHERE `User` = '$User'";
			$result = mysqli_query($db, $order);
	}	
	if ($ITM[2] == "MOD"){
		$_SESSION["MODLVL"] = $ITM[3];
		$sql="DELETE FROM Equiped WHERE HASH='$newU'";
		mysqli_query($db,$sql);
		$sql2="DELETE FROM DropsItm WHERE HASH='$newU'";
		mysqli_query($db,$sql2);
		header("location:reroll.php");
		die();
		
	}
	if ($ITM[2] == "ENC"){
		$_SESSION["ENCt"] = $ITM[3];
		$sql="DELETE FROM Equiped WHERE HASH='$newU'";
		mysqli_query($db,$sql);
		$sql2="DELETE FROM DropsItm WHERE HASH='$newU'";
		mysqli_query($db,$sql2);
		header("location:Enchant.php");
		die();
	}
	//joker
	if ($ITM[2] == "JOKE"){
		

		if (rand(1,1000) >= 900){ //create mosnter
		
				$iLVL = $_SESSION["ILVL"];
				$iLvL = $iLVL + rand(150,300);
				
			list($name, $mLVL, $HP, $PDMG, $MDMG, $Drop, $monsterIMG, $testMessage)=createMonster($db,$iLVL);
			
	$_SESSION["MonsName"] = "$name";
   	$_SESSION["MonsHP"] = $HP;
    $_SESSION["MonsDMG"] = $PDMG;
	$_SESSION["MonsDMGm"] = $MDMG;
    $_SESSION["MonsDrop"] = round($Drop*3);
    $_SESSION["MonsLVL"] = round($mLVL*1.5);
    $_SESSION["MonsIMG"] = $monsterIMG;
	
		$sql="DELETE FROM Equiped WHERE HASH='$newU'";
		mysqli_query($db,$sql);
		$sql2="DELETE FROM DropsItm WHERE HASH='$newU'";
		mysqli_query($db,$sql2);
		
			header("location:FightT.php");
			die();
		}
		else{
		include 'PHP/items.php';
	
		$order = "INSERT INTO DropsItm
		(HASH, Name, EFT, Value, Icon )
		VALUES
		('$HASHIT', '$Name', '$EFT', '$value', '$icon')";
	   
		$order2 = "INSERT INTO Equiped
		(User, Part, HASH, Equiped)
		VALUES
		('$User', 'ITM', '$HASHIT', '0')";	   

		$result = mysqli_query($db, $order);
		$result = mysqli_query($db, $order2);	}

	}
	
		$sql="DELETE FROM Equiped WHERE HASH='$newU'";
		mysqli_query($db,$sql);
		$sql2="DELETE FROM DropsItm WHERE HASH='$newU'";
		mysqli_query($db,$sql2);
}


if (isset($_POST['Eqip'])) {
	

	$Type = $_POST['TYPE'];
	$new = $_POST['Eqip'];

	
if ($Type == "WEP"){
	$EQP = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$new'"); //select new wep item
	$EQP = mysqli_fetch_row($EQP);
}
if ($Type == "ARM"){
	$EQP = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$new'"); //select new armor item
	$EQP = mysqli_fetch_row($EQP);
}
if ($Type == "ACS"){
	$EQP = mysqli_query($db,"SELECT * FROM DropsAcs where HASH = '$new'"); //select new Accsesories item
	$EQP = mysqli_fetch_row($EQP);
}
	
	
	
	$EQP2 = mysqli_query($db,"SELECT * FROM Equiped where User = '$User' AND Part = '$Type' AND Equiped = '1'"); //select current item
	while ($EQPs = mysqli_fetch_array($EQP2)){	
	
	echo $EQPs[2];
	
	if ($Type == "WEP" and !isset($CURR)){
	$CURR = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$EQPs[2]'");
	$CURR = mysqli_fetch_row($CURR);
	}
	
	if ($Type == "ARM" and !isset($CURR)){
	$CURR = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$EQPs[2]' AND Part = '$EQP[1]' ");
	$CURR = mysqli_fetch_row($CURR);
	}
	
	if ($Type == "ACS" and !isset($CURR)){
	$CURR = mysqli_query($db,"SELECT * FROM DropsAcs where HASH = '$EQPs[2]' AND Part = '$EQP[1]' ");
	$CURR = mysqli_fetch_row($CURR);
	}
	
	}
	

    
	
	echo  $order = "UPDATE Equiped
	SET Equiped = '0'
	WHERE `HASH` = '$CURR[0]'";
	$result = mysqli_query($db, $order);	
	
   $order2 = "UPDATE Equiped
	SET Equiped = '1'
	WHERE `HASH` = '$new'";
	$result = mysqli_query($db, $order2);	
	
} else if (isset($_POST['Sell'])) {
	$new = $_POST['Sell'];
	$Type = $_POST['TYPE'];
	
	if ($Type == "WEP"){
	$WEP = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$new' ");
	$WEPn = mysqli_fetch_assoc($WEP);}
	if ($Type == "ARM"){
	$WEP = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$new' ");
	$WEPn = mysqli_fetch_assoc($WEP);}
	if ($Type == "ACS"){
	$WEP = mysqli_query($db,"SELECT * FROM DropsAcs where HASH = '$new' ");
	$WEPn = mysqli_fetch_assoc($WEP);}
	if ($Type == "ITM"){
	$WEP = mysqli_query($db,"SELECT * FROM DropsItm where HASH = '$new' ");
	$WEPn = mysqli_fetch_assoc($WEP);}
	
	if ($WEPn["Rarity"] == "Unique"){
		$shards = 30;
		$shards = $ACC[15] + $shards;
	$order0 = "UPDATE characters
	SET Shards = '$shards'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order0);}
	
	$sell = ($WEPn["ilvl"] + $ACC[3]) *10;

	if ($Type == "ITM"){
		$sell = ($WEPn["Value"] * $ACC[3]) * 5;
	}
	
	$sell = round($ACC[4] + $sell);
	
	$order = "UPDATE characters
	SET Cash = '$sell'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order);
	
$sql="DELETE FROM Equiped WHERE hash='$new'";
mysqli_query($db,$sql);

if ($Type == "WEP" and $new <> 0001){
	if ($new == 0001){
	}
	else{
$sql2="DELETE FROM DropsWep WHERE HASH='$new'";
mysqli_query($db,$sql2);}
}

if ($Type == "ARM"){
$sql2="DELETE FROM DropsArm WHERE HASH='$new'";
mysqli_query($db,$sql2);}

if ($Type == "ACS"){
$sql2="DELETE FROM DropsAcs WHERE HASH='$new'";
mysqli_query($db,$sql2);}

if ($Type == "ITM"){
$sql2="DELETE FROM DropsItm WHERE HASH='$new'";
mysqli_query($db,$sql2);}

} else {
    //no button pressed
}

header("location:sync.php");
?>