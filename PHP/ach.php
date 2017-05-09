<?php

$HASH = $_SESSION["CURRENTWHASH"];

//10 kills for achievemnt
if ($ACC[6] > 9){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Beginer'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
		$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Killed 10 Monsters', 'Beginer', '$User')";
		$result = mysqli_query($db, $order);}}
		
//100 kills for achievemnt	
if ($ACC[6] > 99){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Warming Up'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Killed 100 Monsters', 'Warming Up', '$User')";
		$result = mysqli_query($db, $order);}}
		
	//1000 kills for achievemnt	
if ($ACC[6] > 999){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Numbers mean nothing'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Killed 1000 Monsters', 'Numbers mean nothing', '$User')";
		$result = mysqli_query($db, $order);}}

	//Reach LVL 20
if ($ACC[3] > 19){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Classy~'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Take your new class', 'Classy~', '$User')";
		$result = mysqli_query($db, $order);}}

	//Reach LVL 50
if ($ACC[3] == 50){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Get On My Level'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Reach Maximum level', 'Get On My Level', '$User')";
		$result = mysqli_query($db, $order);}}

	//Get 1000000 gold
if ($ACC[4] > 1000000){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Doll$ Doll$'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Collect 1mil. gold', 'Doll$ Doll$', '$User')";
		$result = mysqli_query($db, $order);}}
		
		//Get 1000000000 gold
if ($ACC[4] > 1000000000){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = '$$$$$$'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Collect 1bil. gold', '$$$$$$', '$User')";
		$result = mysqli_query($db, $order);}}

	//Reach 2000 ranking in pvp
if ($ACC[11] > 1999){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = '1v1 me!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Pass 2000 Rank', '1v1 me!', '$User')";
		$result = mysqli_query($db, $order);}}

	//iLVL > 100
if ($ACC[9] > 100){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Not bad'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Get ilvl over 100', 'Not bad', '$User')";
		$result = mysqli_query($db, $order);}}
		
	//iLVL 420/1420/2420 (10achv)
if ($ACC[9] == 420 or $ACC[9] == 1420 or $ACC[9] == 2420 or $ACC[4] == 420 or $ACC[2] == 420){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Blaze it!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('420 \o/', 'Blaze it!', '$User')";
		$result = mysqli_query($db, $order);}}

	//iLVL > 500
if ($ACC[9] > 500){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Look at all this'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Get ilvl over 500', 'Look at all this', '$User')";
		$result = mysqli_query($db, $order);}}

	//iLVL > 1000
if ($ACC[9] > 1000){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Who is Boss Now!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Get ilvl over 1000', 'Who is Boss Now!', '$User')";
		$result = mysqli_query($db, $order);}}

	//Keep Primed weapon
	$WEPa = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$HASH'");
	$WEPa = mysqli_fetch_row($WEPa);
if ($WEPa[2] == "Primed"){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Whoaaa...'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Keep primed weapon', 'Whoaaa...', '$User')";
		$result = mysqli_query($db, $order);}}

	//Keep World weapon
	$WEPa = mysqli_query($db,"SELECT * FROM drops DropsWep HASH = '$HASH'");
	$WEPa = mysqli_fetch_row($WEPa);
if ($WEPa[2] == "World"){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'The World is mine!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Keep world weapon', 'The World is mine!', '$User')";
		$result = mysqli_query($db, $order);}}

	//Reach Maximum Enchant
	$WEPa = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$HASH'");
	$WEPa = mysqli_fetch_row($WEPa);
if ($WEPa[11] == 30){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Maximum!!!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Enchant weapon to +30', 'Maximum!!!', '$User')";
		$result = mysqli_query($db, $order);}}

	//Kill World boss
	$wbos = mysqli_query($db,"SELECT * FROM wboss where Killer = '$User'");
	$wbos = mysqli_fetch_row($wbos);
if ($wbos[6] == "$User"){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Git Gud'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Kill World boss', 'Git Gud', '$User')";
		$result = mysqli_query($db, $order);}}
		
	//Roll 4 stat. mod.
	$modl = mysqli_query($db,"SELECT * FROM modlist where User = '$User'");
	$modl = mysqli_fetch_row($modl);
if ($modl[7] != ""){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Keep rolling~'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Roll 4 stat. mod.', 'Keep rolling~', '$User')";
		$result = mysqli_query($db, $order);}}

	//Kill Rare Monster.
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$User' and Name = 'RARE' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] == 1){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Found it!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Kill RARE monster', 'Found it!', '$User')";
		$result = mysqli_query($db, $order);}}
		
		//Write 10 mesaages
	$cht = mysqli_query($db,"SELECT COUNT(*) FROM Chat WHERE User = '$User' ");
	$cht = mysqli_fetch_row($cht);
if ($cht[0] > 9){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Hear me out!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Write 10 chat messages', 'Hear me out!', '$User')";
		$result = mysqli_query($db, $order);}}	
		
	//Deal 200 cryt Hits (20ach)
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$User' and Name = 'CRYT' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] > 199){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'EXPLOSIONS!!!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Make 200 cryt. attacks', 'EXPLOSIONS!!!', '$User')";
		$result = mysqli_query($db, $order);}}		
		
	//Absorb 50k dmg
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$User' and Name = 'APS' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] > 49999){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Just a flesh wound!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Absorb 50k dmg', 'Just a flesh wound!', '$User')";
		$result = mysqli_query($db, $order);}}			
		
	//Roll Perfect mod
	$modli = mysqli_query($db,"SELECT * FROM modlist where User = '$User'");
	$modli = mysqli_fetch_row($modli);
if ($modli[9] > 59){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'One of the kind'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Roll perfect mod', 'One of the kind', '$User')";
		$result = mysqli_query($db, $order);}}

	//Poison for 500k dmg
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$User' and Name = 'POS' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] > 499999){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'I am on drugs...'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Poison for 500k dmg', 'I am on drugs...', '$User')";
		$result = mysqli_query($db, $order);}}	


//Reflect 100k dmg
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$User' and Name = 'POS' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] > 99999){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Well, atleast not me!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Reflect 100k dmg', 'Well, atleast not me!', '$User')";
		$result = mysqli_query($db, $order);}}	
		
//Do 1000 combos
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$User' and Name = 'COM' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] > 999){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'C-C-C-Combo Breaker!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Do 1000 combos', 'C-C-C-Combo Breaker!', '$User')";
		$result = mysqli_query($db, $order);}}	

//Lose 10 times
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$User' and Name = 'LOS' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] > 9){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'I be back!'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Lose 10 Times', 'I be back!', '$User')";
		$result = mysqli_query($db, $order);}}	
		
//Full equipment
	$rar = mysqli_query($db,"SELECT count(*) from Equiped WHERE User = '$User' and Equiped = '1'");
	$rar = mysqli_fetch_row($rar);
if ($rar[0] == 6){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'On the house'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Have fully equiped item set', 'On the house', '$User')";
		$result = mysqli_query($db, $order);}}	
		
//Deal over 100k DMG
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$User' and Name = '100K' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] == 1){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Monster Hunter'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Deal over 100k dmg in single turn', 'Monster Hunter', '$User')";
		$result = mysqli_query($db, $order);}}	
		
//Keep Unique wep
	$WEPa = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$HASH'");
	$WEPa = mysqli_fetch_row($WEPa);
if ($WEPa[2] == "Unique"){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Whole new level'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Keep Unique weapon', 'Whole new level', '$User')";
		$result = mysqli_query($db, $order);}}
		
//Extra point (30ach)
	$ran = mysqli_query($db,"SELECT * FROM Points where User = '$User'");
	$ran = mysqli_fetch_row($ran);
	$ranTotal = $ran[2] + $ran[3];
if ($ranTotal >= 50){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Extra One'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Get ant Extra stat point', 'Extra One', '$User')";
		$result = mysqli_query($db, $order);}}
		
//Keep 200 Shards
	$ran = mysqli_query($db,"SELECT * FROM characters where User = '$User'");
	$ran = mysqli_fetch_row($ran);
if ($ran[15] >= 200){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'Shardeded'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Keep 200 shards without spending', 'Shardeded', '$User')";
		$result = mysqli_query($db, $order);}}
		
//iLVL > 2000
if ($ACC[9] >= 2000){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'MLG PRO'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Get ilvl over 2000', 'MLG PRO', '$User')";
		$result = mysqli_query($db, $order);}}
		
//Change title fr first time

	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$User' and Name = 'CHACH' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] == 1){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'First time'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Change tittle for the first time', 'First time', '$User')";
		$result = mysqli_query($db, $order);}}	

//100 Hadcore kills
if ($ACC[6] > 99 and $ACC[6] == 1){
	$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'The Hard Way'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Killed 100 Monsters playng in Hardcore', 'The Hard Way', '$User')";
		$result = mysqli_query($db, $order);}}
		
//Make 10x combo
	$rar = mysqli_query($db,"SELECT * FROM aStatus where User = '$User' and Name = '10x' ");
	$rar = mysqli_fetch_row($rar);
if ($rar[2] == 1){
		$ACH = mysqli_query($db,"SELECT * FROM Achievments where user = '$User' and Title = 'CooO0o0oobmO'");
	$ACH = mysqli_fetch_row($ACH);
	if ($ACH[1]==""){
				$newP = $PNT[1] + 1;
		
			$order3 = "UPDATE Points
			SET Free = '$newP'
			WHERE `User` = '$User'";
			
			$result = mysqli_query($db, $order3);
		
		$order = "INSERT INTO Achievments (Name, Title, User)
		VALUES ('Reach 10 x combo', 'CooO0o0oobmO', '$User')";
		$result = mysqli_query($db, $order);}}	
?>