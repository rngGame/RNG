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
$User = $_SESSION["User"];

include_once 'PHP/db.php';

$MLVL = $_SESSION["MonsLVL"];
$Drop = $_SESSION["MonsDrop"];
$Money = $_SESSION["Money"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
$WEP = mysqli_query($db,"SELECT * FROM weapondrops where HASH = '$ACC[1]' ");
$WEP = mysqli_fetch_row($WEP);

//check for lvl
$rel = 0;
while($rel == 0){
	
$Base = mysqli_query($db,"SELECT * FROM basewep Order by RAND() Limit 	1");
$Base = mysqli_fetch_row($Base);
$Pre = mysqli_query($db,"SELECT * FROM prefixwep Order by RAND() Limit 	1");
$Pre = mysqli_fetch_row($Pre);
$Sub = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit 	1");
$Sub = mysqli_fetch_row($Sub);
$Sub2 = mysqli_query($db,"SELECT * FROM subfixwep Order by RAND() Limit 1");
$Sub2 = mysqli_fetch_row($Sub2);
$Type = mysqli_query($db,"SELECT * FROM types Order by RAND() Limit 	1");
$Type = mysqli_fetch_row($Type);
$Type2 = mysqli_query($db,"SELECT * FROM types Order by RAND() Limit 	1");
$Type2 = mysqli_fetch_row($Type2);
$Skill = mysqli_query($db,"SELECT * FROM iskills Order by RAND() Limit 	1");
$Skill = mysqli_fetch_row($Skill);

$Enchant = mysqli_query($db,"SELECT * FROM enchantdrop");

$rand = 0;
$rand2 = 0;
$rand3 = 0;
$rand4 = 0;

$rand = rand(0,100);
$rand2 = rand(0,100);
$rand3 = rand(0,500);
$rand4 = rand(0,600);


// Beisis
$Name = $Base[1];
$bDMG = $Base[3];
$lvl = $Base[2];

//1st modif
if ($rand > 30){
	$Name = "$Pre[1] $Name";
	$bDMG = $bDMG + $Pre[3];
	$lvl = $lvl + $Pre[2];
}

//2nd modif
if ($rand2 > 50){
	$Name = "$Name of $Sub[1]";
	$bDMG = $bDMG + $Sub[3];
	$lvl = $lvl + $Sub[2];
//3rd modif inside
	if ($rand2 > 70){
		$Name = "$Name and $Sub2[1]";
		$bDMG = $bDMG + $Sub2[3];
		$lvl = $lvl + $Sub2[2];
	}}
	
//Type

	$TYPE = "World";
	$Bonus = 250 / 100;
	$Color = "e67300";
	$bDMG = $bDMG * $Bonus;
	$lvl = $lvl + $Bonus;
	
//skill

if ($rand4 < 20){
	$lvl = $lvl + $Skill[7];
	$SKL = $Skill[1];
	$Skil = $Skill[0];
	$skiln = "Skill : $Skill[1]<br>";
	}

	
//Tottal dmg




//min-max
$dMIN = round($bDMG - ($bDMG*rand(1,20)/100));
$dMAX = round($bDMG + ($bDMG*rand(1,30)/100));
$CRIT = round((100 + 1000*$Bonus) / 100);
$AS = round(rand(80,150)/100,1);
$maMIN = round($bDMG - ($bDMG*rand(1,50)/100));
$maMAX = round($bDMG + ($bDMG*rand(1,150)/100));  
$HIT = rand(85,100);
$LVL = round($lvl);
$NAME = "<b style='color:#$Color'>$Name</b>";

//hash
$HC = 0;
$Base = mysqli_query($db,"SELECT * FROM basewep Order by RAND() Limit 	1");
$Base = mysqli_fetch_row($Base);
$HASH = rand(-90000000,900000000);
$HASH = $HASH * $LVL;
$HASH = $HASH + rand(-1000,1000);
$result = mysqli_query($db,"SELECT * FROM DropsWep WHERE HASH = '$HASH'");
$count = mysqli_num_rows($result);
if($count==1){
	$HC = 1;
}


//Bonus stat

if (rand(0,100) < 55){
                $rngEffect = rand(1,10);
                if ($rngEffect == 1){
                    $effectName = "Life Leach";
                    $weaponEffect = "LL";
                    $weaponEffectChance = rand(1,7);
                }
                if ($rngEffect == 2){
                    $weaponEffect = "Bleed";
                    $effectShort = "BL";
                    $weaponEffectChance = rand(10,30);
                }
                if ($rngEffect == 3){
                    $effectName = "Burn";
                    $weaponEffect = "BR";
                    $weaponEffectChance = rand(1,20);
                }
                if ($rngEffect == 4){
                    $effectName = "Freez";
                    $weaponEffect = "FR";
                    $weaponEffectChance = rand(10,20);
                    
                }
                if ($rngEffect == 5){
                    $effectName = "Stun";
                    $weaponEffect = "ST";
                    $weaponEffectChance = rand(5,30);
                }
                if ($rngEffect == 6){
                    $effectName = "Shock";
                    $weaponEffect = "SH";
                    $weaponEffectChance = rand(20,50);
                    
                }
                if ($rngEffect == 7){
                    $effectName = "Block";
                    $weaponEffect = "BK";
                    $weaponEffectChance = rand(5,20);
                    
                }
                 if ($rngEffect == 8){
                    $effectName = "Summon";
                    $weaponEffect = "SM";
                    $weaponEffectChance = rand(25,70);
                    
                }
                if ($rngEffect == 9){
					 $effectName = "Poision buff";
                    $weaponEffect = "PS";
                    $weaponEffectChance = rand(5,45);
                    
                }
                
                if ($rngEffect == 10){
					$effectName = "Confusion chanse";
                    $weaponEffect = "CF";
                    $weaponEffectChance = rand(5,15);                 
                }
	$ef = "Effect: $EFNAME $EFC %<br>";
}

$RMG = $MLVL*2.5;
$RMGmin = $MLVL/2.5;

if ($lvl < $RMG and $lvl > $RMGmin and $bDMG > 0 and $CRIT >0 and $HC <> 1){
	$rel = 1;}
}

$wor = $LVL + $dMAX + $maMAX + $HIT;

//insert into db

$order = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, HitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', '$Name', 'World', '$LVL', '$dMIN', '$dMAX', '$CRIT', '$maMIN', '$maMAX', '$HIT', '$Skil', '$EFT', '$EFC', '0', '$wor')";
	   


$result = mysqli_query($db, $order);


$MoneyRew = ($ACC[3] + $MLVL) * 10; //gold for mob
$_SESSION["GoldRew"] = $MoneyRew;

$MoneySel = ($ACC[3] + $LVL) * 10; //gold for wep
$_SESSION["Gold"] = $MoneySel;

$reward = "<b><font color='red'><br> -WEAPON !-</font><br><br>DROP:</b><br><br>Name: $NAME<br>
LVL: <b>$LVL</b><br>
Physical Dmg: <b>$dMIN ~ $dMAX</b><br>
Magickal Dmg: <b>$maMIN ~ $maMAX</b><br>
Cryt chanse: $CRIT %<br>
Hit chanse: $HIT %<br>
$ef $skiln
Worth: $MoneySel gold<br>";

$_SESSION["WepName"] = $NAME;

$_SESSION["Reward"] = "$reward";
$_SESSION["HASH"] = "$HASH";

$MHP = $_SESSION["MonsHP"];
$ID = $_SESSION["IDB"];
$MHP2 = $_SESSION["MonsHP2"];


$order3 = "UPDATE wboss
SET `HASH` = '$HASH'
WHERE `ID` = '$ID'";
$result = mysqli_query($db, $order3);	



$BOS = mysqli_query($db,"SELECT * FROM wboss where ID = '$ID' ");
$BOS = mysqli_fetch_row($BOS);

$dmg = $MHP2 - $MHP;
$HPL = $MHP2 - $dmg;

$kills = $ACC[6] +1;

$DMTB = mysqli_query($db,"SELECT * FROM dboss where MonsID = '$ID' AND ACC = '$ACC[0]'");
$DMTB = mysqli_fetch_row($DMTB);
if($DMTB[0] == 0) {
	$order2 = "INSERT INTO dboss
	   (MonsID, ACC, DMG)
	  VALUES	
	   ('$ID', '$ACC[0]', '$dmg')";
	   $result = mysqli_query($db, $order2);
	}
else{
	$dmg = $DMTB[2] + $dmg;
	$order5 = "UPDATE dboss
	SET DMG = '$dmg'
	WHERE `MonsID` = '$ID' AND `ACC` = '$ACC[0]'";
	$result = mysqli_query($db, $order5);
	}

$BOS = mysqli_query($db,"SELECT * FROM wboss ORDER BY ID DESC LIMIT 1 ");
$BOS = mysqli_fetch_row($BOS);

if ($BOS[6] != ""){
		
	$order5 = "UPDATE wboss
	SET `HP` = '0'
	WHERE `ID` = '$ID'";
	$result = mysqli_query($db, $order5);
	
	echo "<b>Boss Already dead</b>";
	echo '
<section class="container">
    <div class="Back">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
';}
else{
	
	$order4 = "UPDATE wboss
	SET `Killer` = '$User'
	WHERE `ID` = '$IDB'";
	$result = mysqli_query($db, $order4);	


$a = 0;

 $List = mysqli_query($db,"SELECT * FROM dboss where MonsID = '$BOS[0]' order by DMG desc ");
while ($List1 = mysqli_fetch_array($List)){
	if ($a == 0) {
	$order2 = "INSERT INTO inventor
	(User, Hash)
	VALUES
	('$User','$HASH')";	   
	$result = mysqli_query($db, $order2);
	$a = $a +1;};
echo "<b>$List1[1]</b> - $List1[2] Dmg.<br>";
$ACC2 = mysqli_query($db,"SELECT * FROM characters where user = '$List1[1]' ");
$ACC2 = mysqli_fetch_row($ACC2);
$PAS = mysqli_query($db,"SELECT * FROM passive where USER = '$List1[1]' ");
$PAS = mysqli_fetch_row($PAS);

$cash = $List1[2] / 1500;
if ($cash > 200000){
	$cash = 200000;}
$cash = round($ACC2[4] + $cash);
$XP = $ACC2[5] + ($List1[2] * 0.5);
$XP = round($XP);
$XPP = $List1[2]/3500;
$XPP = $XPP + $PAS[10];
$XPP = round($XPP);

$order1 = "UPDATE characters
SET Cash = '$cash'
WHERE `User` = '$List1[1]'"	;

$order2 = "UPDATE characters
SET XP = '$XP'
WHERE `User` = '$List1[1]'"	;

$order3 = "UPDATE passive
SET xp4= '$XPP'
WHERE `USER` = '$List1[1]'";

$result = mysqli_query($db, $order1);
$result = mysqli_query($db, $order2);
$result = mysqli_query($db, $order3);
}
}




$order3 = "UPDATE characters
SET Kills = '$kills'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order3);	

$IDB = $_SESSION["IDB"];

$order3 = "UPDATE wboss
SET HP = '0'
WHERE `ID` = '$IDB'";

$result = mysqli_query($db, $order3);	


mysqli_close($db);
header("location:show.php");

?>