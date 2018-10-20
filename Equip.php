<?php
session_start();
ob_start();
include_once 'PHP/db.php';
include_once 'PHP/function.php';


$User = $_SESSION["User"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
	


//selling all
if (isset($_POST['bagsell'])) {
	$part = $_POST['bagsell'];
	
	$List = mysqli_query($db,"SELECT * FROM Equiped WHERE User = '$User' AND Part = '$part' AND Equiped = '0'");
	while ($ListS = mysqli_fetch_array($List)){	
	
	$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
	$ACC = mysqli_fetch_row($ACC);
	
	if ($ListS[1] == "WEP"){
	$ITM = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$ListS[2]'"); //Item Usega
	$ITMs = mysqli_fetch_assoc($ITM);}
	if ($ListS[1] == "ARM"){
	$ITM = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$ListS[2]'"); //Item Usega
	$ITMs = mysqli_fetch_assoc($ITM);}
	if ($ListS[1] == "ACS"){
	$ITM = mysqli_query($db,"SELECT * FROM DropsAcs where HASH = '$ListS[2]'"); //Item Usega
	$ITMs = mysqli_fetch_assoc($ITM);}
	if ($ListS[1] == "ITM"){
	$ITM = mysqli_query($db,"SELECT * FROM DropsItm where HASH = '$ListS[2]'"); //Item Usega
	$ITMs = mysqli_fetch_assoc($ITM);}	
	if ($ListS[1] == "SKL"){
	$ITM = mysqli_query($db,"SELECT * FROM DropsSkl where HASH = '$ListS[2]'"); //Item Usega
	$ITMs = mysqli_fetch_assoc($ITM);}	
	
	if ($ITMs["Rarity"] == "Unique"){
		$shards = 30;
		$shards = $ACC[15] + $shards;
		$order0 = "UPDATE characters
		SET Shards = '$shards'
		WHERE `User` = '$User'";
		$result = mysqli_query($db, $order0);
	}
		
	if ($ITMs["ilvl"] > 1){

	$gold = ($ITMs["ilvl"] + $ACC[3]) * 10;
	$tottalGold = $gold + $ACC[4];
	
	$order = "UPDATE characters
	SET Cash = '$tottalGold'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order);
	}
	else if ($ITMs["Value"] >= 1){
	$gold = ($ITMs["Value"] * $ACC[3]) * 5;
	$tottalGold = $gold + $ACC[4];
	
	$order = "UPDATE characters
	SET Cash = '$tottalGold'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order);
	}
	
	$sql="DELETE FROM Equiped WHERE HASH='$ListS[2]'";
	mysqli_query($db,$sql);
	
	if ($ListS[1] == "WEP"){
	$sql2="DELETE FROM DropsWep WHERE HASH='$ListS[2]'";
	mysqli_query($db,$sql2);}
	if ($ListS[1] == "ARM"){
	$sql2="DELETE FROM DropsArm WHERE HASH='$ListS[2]'";
	mysqli_query($db,$sql2);}
	if ($ListS[1] == "ACS"){
	$sql2="DELETE FROM DropsAcs WHERE HASH='$ListS[2]'";
	mysqli_query($db,$sql2);}
	if ($ListS[1] == "ITM"){
	$sql2="DELETE FROM DropsItm WHERE HASH='$ListS[2]'";
	mysqli_query($db,$sql2);}
	if ($ListS[1] == "SKL"){
	$sql2="DELETE FROM DropsSkl WHERE HASH='$ListS[2]'";
	mysqli_query($db,$sql2);}

	} //while endas !

	header("location:sync.php");
	die();
}


if (isset($_POST['ITMS'])) {
	
	
	$newU = $_POST['ITMS'];
	$ITM = mysqli_query($db,"SELECT * FROM DropsItm where HASH = '$newU'"); //Item Usega
	$ITM = mysqli_fetch_row($ITM);
	
	if ($ITM[2] == "XP"){
		$XPS = $ACC[5] + ($ACC[5]  *  $ITM[3] / (10 * $ACC[3]));
			$order = "UPDATE characters
			SET XP = '$XPS'
			WHERE `User` = '$User'";
			$result = mysqli_query($db, $order);
	}
	if ($ITM[2] == "GOLD"){
		$XPS = $ACC[4] + ($ITM[3] * $ACC[3]);
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
		

		if (rand(1,1000) <= 200){ //create monster
		
				$iLVL = $_SESSION["ILVL"];
				$iLvL = $iLVL + rand(200,400);
				
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
		$result = mysqli_query($db, $order2);	
		
		echo "You got: <br><div class='tooltip'><input $c1 src='IMG/pack/$icon.png' style='width:45px;height:45px;' type='image' name='commit'><span class='tooltiptext'>$Name - $value</span><br>by using joker</div>";
		
		$sql="DELETE FROM Equiped WHERE HASH='$newU'";
		mysqli_query($db,$sql);
		$sql2="DELETE FROM DropsItm WHERE HASH='$newU'";
		mysqli_query($db,$sql2);
		
		echo " <section class='container3'>
    <div class='31-50'>
	      <form method='post' action='sync.php'>
        <p class='submit'><input type='submit' name='commit' value='Back'></p>
      </form>
    </div>
  </section>";
		
		die();
		
		}

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
if ($Type == "SKL"){
	$EQP = mysqli_query($db,"SELECT * FROM DropsSkl where HASH = '$new'"); //select new Accsesories item
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
	
	if ($Type == "SKL" and !isset($CURR)){
	$CURR = mysqli_query($db,"SELECT * FROM DropsSkl where HASH = '$EQPs[2]'");
	$CURR = mysqli_fetch_row($CURR);
	}
	
	}

    
	
	$order = "UPDATE Equiped
	SET Equiped = '0'
	WHERE `HASH` = '$CURR[0]' and User='$User'";
	$result = mysqli_query($db, $order);	
	
   $order2 = "UPDATE Equiped
	SET Equiped = '1'
	WHERE `HASH` = '$new' and User='$User'";
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
	if ($Type == "SKL"){
	$WEP = mysqli_query($db,"SELECT * FROM DropsSkl where HASH = '$new' ");
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
		$sell = ($WEPn["Value"] * $ACC[3]);
	}
	
	$sell = round($ACC[4] + $sell);
	
	$order = "UPDATE characters
	SET Cash = '$sell'
	WHERE `User` = '$User'";
	$result = mysqli_query($db, $order);
	
	

$sql="DELETE FROM Equiped WHERE hash='$new' and User='$User'";
mysqli_query($db,$sql);

if ($Type == "WEP"){
	if ($new == "0001"){
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

if ($Type == "SKL"){
$sql2="DELETE FROM DropsSkl WHERE HASH='$new'";
mysqli_query($db,$sql2);}

} else {
    //no button pressed
}
	
	
header("location:sync.php");
?>