<?php

$HASH = $_SESSION["CURRENTWHASH"];

//10 kills for achievemnt
if ($ACC[6] > 9){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Beginer'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
		
	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
		
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Killed 10 Monsters', 'Beginer', '$Account')";
		$result = mysqli_query($db, $order);}}
		
//100 kills for achievemnt	
if ($ACC[6] > 99){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Warming Up'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Killed 100 Monsters', 'Warming Up', '$Account')";
		$result = mysqli_query($db, $order);}}
		
	//1000 kills for achievemnt	
if ($ACC[6] > 999){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Numbers mean nothing'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Killed 1000 Monsters', 'Numbers mean nothing', '$Account')";
		$result = mysqli_query($db, $order);}}

	//Reach LVL 20
if ($ACC[3] > 19){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Classy~'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Take your new class', 'Classy~', '$Account')";
		$result = mysqli_query($db, $order);}}

	//Reach LVL 50
if ($ACC[3] == 50){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Get On My Level'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Reach Maximum level', 'Get On My Level', '$Account')";
		$result = mysqli_query($db, $order);}}

	//Get 1000000 gold
if ($ACC[4] > 1000000){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Doll$ Doll$'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Collect 1mil. gold', 'Doll$ Doll$', '$Account')";
		$result = mysqli_query($db, $order);}}
		
		//Get 1000000000 gold
if ($ACC[4] > 1000000000){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = '$$$$$$'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Collect 1bil. gold', '$$$$$$', '$Account')";
		$result = mysqli_query($db, $order);}}

	//Reach 2000 ranking in pvp
if ($ACC[11] > 1999){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = '1v1 me!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Pass 2000 Rank', '1v1 me!', '$Account')";
		$result = mysqli_query($db, $order);}}

	//iLVL > 100
if ($ACC[9] > 100){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Not bad'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Get ilvl over 100', 'Not bad', '$Account')";
		$result = mysqli_query($db, $order);}}
		
	//iLVL 420/1420/2420 (10achv)
if ($ACC[9] == 420 or $ACC[9] == 1420 or $ACC[9] == 2420 or $ACC[4] == 420 or $ACC[2] == 420){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Blaze it!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('420 \o/', 'Blaze it!', '$Account')";
		$result = mysqli_query($db, $order);}}

	//iLVL > 500
if ($ACC[9] > 500){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Look at all this'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Get ilvl over 500', 'Look at all this', '$Account')";
		$result = mysqli_query($db, $order);}}

	//iLVL > 1000
if ($ACC[9] > 1000){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Who is Boss Now!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Get ilvl over 1000', 'Who is Boss Now!', '$Account')";
		$result = mysqli_query($db, $order);}}

	//Keep Primed weapon
	$WEPa = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$HASH'");
	$WEPa = mysqli_fetch_row($WEPa);
if ($WEPa[2] == "Primed"){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Whoaaa...'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Keep primed weapon', 'Whoaaa...', '$Account')";
		$result = mysqli_query($db, $order);}}

	//Keep World weapon
	$WEPa = mysqli_query($db,"SELECT * FROM drops DropsWep HASH = '$HASH'");
	$WEPa = mysqli_fetch_row($WEPa);
if ($WEPa[2] == "World"){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'The World is mine!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Keep world weapon', 'The World is mine!', '$Account')";
		$result = mysqli_query($db, $order);}}

	//Reach Maximum Enchant
	$WEPa = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$HASH'");
	$WEPa = mysqli_fetch_row($WEPa);
if ($WEPa[11] == 30){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Maximum!!!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Enchant weapon to +30', 'Maximum!!!', '$Account')";
		$result = mysqli_query($db, $order);}}

	//Kill World boss
	$wbos = mysqli_query($db,"SELECT * FROM wboss where Killer = '$User'");
	$wbos = mysqli_fetch_row($wbos);
if ($wbos[6] == "$Account"){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Git Gud'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Kill World boss', 'Git Gud', '$Account')";
		$result = mysqli_query($db, $order);}}
		
	//Roll 4 stat. mod.
	$modl = mysqli_query($db,"SELECT * FROM modlist where User = '$User'");
	$modl = mysqli_fetch_row($modl);
if ($modl[7] != ""){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Keep rolling~'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Roll 4 stat. mod.', 'Keep rolling~', '$Account')";
		$result = mysqli_query($db, $order);}}

	//Kill Rare Monster.
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = 'RARE' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] == 1){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Found it!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Kill RARE monster', 'Found it!', '$Account')";
		$result = mysqli_query($db, $order);}}
		
		//Write 10 mesaages
	$cht = mysqli_query($db,"SELECT COUNT(*) FROM Chat WHERE User = '$User' "); //NEED MORE WORK
	$cht = mysqli_fetch_row($cht);
if ($cht[0] > 9){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Hear me out!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Write 10 chat messages', 'Hear me out!', '$Account')";
		$result = mysqli_query($db, $order);}}	
		
	//Deal 200 cryt Hits (20ach)
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = 'CRYT' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] > 199){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'EXPLOSIONS!!!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Make 200 cryt. attacks', 'EXPLOSIONS!!!', '$Account')";
		$result = mysqli_query($db, $order);}}		
		
	//Absorb 500k dmg
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = 'APS' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] >= 500000){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Just a flesh wound!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Absorb 500k dmg', 'Just a flesh wound!', '$Account')";
		$result = mysqli_query($db, $order);}}			
		
	//Roll Perfect mod
	$modli = mysqli_query($db,"SELECT * FROM modlist where User = '$User'");
	$modli = mysqli_fetch_row($modli);
if ($modli[9] > 59){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'One of the kind'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Roll perfect mod', 'One of the kind', '$Account')";
		$result = mysqli_query($db, $order);}}

	//Poison for 500k dmg
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = 'POS' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] > 499999){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'I am on drugs...'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Poison for 500k dmg', 'I am on drugs...', '$Account')";
		$result = mysqli_query($db, $order);}}	


//Reflect 100k dmg
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = 'POS' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] > 99999){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Well, atleast not me!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Reflect 100k dmg', 'Well, atleast not me!', '$Account')";
		$result = mysqli_query($db, $order);}}	
		
//Do 1000 combos
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = 'COM' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] > 999){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'C-C-C-Combo Breaker!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Do 1000 combos', 'C-C-C-Combo Breaker!', '$Account')";
		$result = mysqli_query($db, $order);}}	

//Lose 10 times
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = 'LOS' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] > 9){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'I be back!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Lose 10 Times', 'I be back!', '$Account')";
		$result = mysqli_query($db, $order);}}	
		
//Full equipment
	$rar = mysqli_query($db,"SELECT count(*) from Equiped WHERE User = '$User' and Equiped = '1'");
	$rar = mysqli_fetch_row($rar);
if ($rar[0] == 6){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'On the house'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Have fully equiped item set', 'On the house', '$Account')";
		$result = mysqli_query($db, $order);}}	
		
//Deal over 100k DMG
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = '100K' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] == 1){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Monster Hunter'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Deal over 100k dmg in single turn', 'Monster Hunter', '$Account')";
		$result = mysqli_query($db, $order);}}	
		
//Keep Unique wep
	$WEPa = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$HASH'");
	$WEPa = mysqli_fetch_row($WEPa);
if ($WEPa[2] == "Unique"){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Whole new level'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Keep Unique weapon', 'Whole new level', '$Account')";
		$result = mysqli_query($db, $order);}}
		
//Extra point (30ach)
	$ran = mysqli_query($db,"SELECT * FROM Points where User = '$User'");
	$ran = mysqli_fetch_row($ran);
	$ranTotal = $ran[2] + $ran[3];
if ($ranTotal >= 50){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Extra One'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Get ant Extra stat point', 'Extra One', '$Account')";
		$result = mysqli_query($db, $order);}}
		
//Keep 200 Shards
	$ran = mysqli_query($db,"SELECT * FROM characters where User = '$User'");
	$ran = mysqli_fetch_row($ran);
if ($ran[15] >= 200){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Shardeded'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Keep 200 shards without spending', 'Shardeded', '$Account')";
		$result = mysqli_query($db, $order);}}
		
//iLVL > 2000
if ($ACC[9] >= 2000){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'MLG PRO'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Get ilvl over 2000', 'MLG PRO', '$Account')";
		$result = mysqli_query($db, $order);}}
		
//Change title fr first time
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = 'CHACH' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] == 1){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'First time'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Change tittle for the first time', 'First time', '$Account')";
		$result = mysqli_query($db, $order);}}	

//100 Hadcore kills
if ($ACC[6] > 99 and $ACC[6] == 1){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'The Hard Way'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Killed 100 Monsters playng in Hardcore', 'The Hard Way', '$Account')";
		$result = mysqli_query($db, $order);}}
		
//Make 10x combo
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = '10x' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] == 1){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'CooO0o0oobmO'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Reach 10 x combo', 'CooO0o0oobmO', '$Account')";
		$result = mysqli_query($db, $order);}}	

//iLVL > 2000
if ($ACC[9] >= 3000){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'What now ?'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Get ilvl over 3000', 'What now ?', '$Account')";
		$result = mysqli_query($db, $order);}}

	//Reach LVL 40 in Hardcore (37)
if ($ACC[3] >= 40 and $ACC[6] == 1){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'HARDCORE!!!'");
		$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Reach 40lvl in Hardcore', 'HARDCORE!!!', '$Account')";
		$result = mysqli_query($db, $order);}}

	//Reach LVL 50 in Hardcore
if ($ACC[3] == 50 and $ACC[6] == 1){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Survived!'");
		$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Reach Maximum lvl in Hardcore', 'Survived!', '$Account')";
		$result = mysqli_query($db, $order);}}

//Thorns did +20kk
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = 'THOR' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] >= 20000000){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Cactus ?'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Deal 20mil Thorn dmg', 'Cactus ?', '$Account')";
		$result = mysqli_query($db, $order);}}	

//Have over 1k ES (39)
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = 'ESS' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] >= 1000){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'I am Blue");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Have over 1k ES', 'I am Blue', '$Account')";
		$result = mysqli_query($db, $order);}}	

	//Reach LVL 20 in SpeedRun
if ($ACC[3] >= 20 and $ACC[6] == 2){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'FAST!'");
		$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Reach 20 lvl in Speed run', 'FAST!', '$Account')";
		$result = mysqli_query($db, $order);}}

//Reach LVL 30 in SpeedRun
if ($ACC[3] >= 30 and $ACC[6] == 2){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Sonic?!'");
		$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Reach 30 lvl in Speed run', 'Sonic?!', '$Account')";
		$result = mysqli_query($db, $order);}}

//Reach LVL 40 in SpeedRun
if ($ACC[3] >= 40 and $ACC[6] == 2){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = '1000kw'");
		$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Reach 40 lvl in Speed run', '1000kw', '$Account')";
		$result = mysqli_query($db, $order);}}

//Die in speed run (43)
if ($ACC[7] >= 1 and $ACC[6] == 2){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'No time to explain !'");
		$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Die in Speed run', 'No time to explain !', '$Account')";
		$result = mysqli_query($db, $order);}}

//20 kills in dungeon
if ($ACC[17] >= 20){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'I could live here !'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Killed 20 monsters in dungeon', 'I could live here !', '$Account')";
		$result = mysqli_query($db, $order);}}

//50 kills in dungeon
if ($ACC[17] >= 50){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'WUT?'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Killed 50 monsters in dungeon', 'WUT?', '$Account')";
		$result = mysqli_query($db, $order);}}

//Corupt mod
	$cor = mysqli_query($db,"SELECT * FROM modlist where User = '$Account'");
	$cor = mysqli_fetch_row($cor);
if ($cor[12] == 1){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Corupted'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Corupt mod card', 'Corupted', '$Account')";
		$result = mysqli_query($db, $order);}}	

//Corupt mod for 5 stats (47)
	$cor5 = mysqli_query($db,"SELECT * FROM modlist where User = '$Account'");
	$cor5 = mysqli_fetch_row($cor5);
if ($cor5[10] >= 1){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = '5 is my lucky number!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Corupt mod for 5 stats on it', '5 is my lucky number!', '$Account')";
		$result = mysqli_query($db, $order);}}

//Have 150% resists
	$rarr = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = 'RESISTS' ");
	$rarr = mysqli_fetch_row($rarr);
if ($rarr[2] >= 150){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Resisting");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Have over 150% of total resists', 'Resisting', '$Account')";
		$result = mysqli_query($db, $order);}}	

//Have 200% resists
	$rarr = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = 'Elemental' ");
	$rarr = mysqli_fetch_row($rarr);
if ($rarr[2] >= 150){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Resisting");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Have over 200% of total resists', 'Elemental', '$Account')";
		$result = mysqli_query($db, $order);}}	

//Have 300% resists (50)
	$rarr = mysqli_query($db,"SELECT * FROM aStatus where User = '$Account' and Name = 'V O I D' ");
	$rarr = mysqli_fetch_row($rarr);
if ($rarr[2] >= 150){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$Account' and Title = 'Resisting");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){	$chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
	while ($Chars = mysqli_fetch_array($chars)){
		
		$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$Chars[0]' ");
		$PNT = mysqli_fetch_row($PNT);
		
		$newP = $PNT[1] + 1;
	
			$order = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$Chars[0]'";
			
			$result = mysqli_query($db, $order);
	}
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Have over 300% of total resists', 'V O I D', '$Account')";
		$result = mysqli_query($db, $order);}}	
?>