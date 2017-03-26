<?php
session_start();
ob_start();
$User = $_SESSION["User"];
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
if ($rand3 < $Type[2]){
	$TYPE = $Type[1];
	$Bonus = $Type[3] / 100;
	$Color = $Type[4];
	$bDMG = $bDMG * $Bonus;
	$lvl = $lvl + $Bonus;}
else if ($rand3 < $Type2[2]){
	$TYPE = $Type2[1];
	$Bonus = $Type2[3] / 100;
	$Color = $Type2[4];
	$bDMG = $bDMG * $Bonus;
	$lvl = $lvl + $Bonus;}
	
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
$NAME = "<b class='$Color'>$Name</b>";

//hash
$HC = 0;
$Base = mysqli_query($db,"SELECT * FROM basewep Order by RAND() Limit 	1");
$Base = mysqli_fetch_row($Base);
$HASH = rand(-90000000,900000000);
$HASH = $HASH * $LVL;
$HASH = $HASH + rand(-1000,1000);
$result = mysqli_query($db,"SELECT * FROM weapondrops WHERE HASH = '$HASH'");
$count = mysqli_num_rows($result);
if($count==1){
	$HC = 1;
}


//Bonus stat

if (rand(0,100) < 15){
	$efn = rand(1,5);
	if ($efn == 1){
		$EFNAME = "Life Leach";
		$EFT = "LL";
		$EFC = rand(1,7);
	}
	if ($efn == 2){
		$EFNAME = "Bleed";
		$EFT = "BL";
		$EFC = rand(10,30);
	}
	if ($efn == 3){
		$EFNAME = "Burn";
		$EFT = "BR";
		$EFC = rand(1,20);
	}
	if ($efn == 4){
		$EFNAME = "Freez";
		$EFT = "FR";
		$EFC = rand(10,20);
		
	}
	if ($efn == 5){
		$EFNAME = "Stun";
		$EFT = "ST";
		$EFC = rand(5,30);
	}
	if ($efn == 6){
		$EFNAME = "Shock";
		$EFT = "SH";
		$EFC = rand(20,50);
		
	}
	if ($efn == 7){
		$EFNAME = "Block";
		$EFT = "BK";
		$EFC = rand(5,20);
		
	}
	if ($efn == 8){
		
	}
	if ($efn == 9){
		
	}
	
	if ($efn == 10){
		
	}
	$ef = "Effect: $EFNAME $EFC %<br>";
}

$RMG = $MLVL*1.2;
$RMGmin = $MLVL/1.5;

if ($lvl < $RMG and $lvl > $RMGmin and $bDMG > 0 and $CRIT >0 and $HC <> 1){
	$rel = 1;}


}

$wor = $LVL + $dMAX + $maMAX + $HIT;
//insert into db

$order = "INSERT INTO weapondrops
	   (HASH, Name, Type, Color, ilvl, pmin, pmax, cryt, ats, mmin, mmax, hc, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', '$Name', '$TYPE', '$Color', '$LVL', '$dMIN', '$dMAX', '$CRIT', '$AS', '$maMIN', '$maMAX', '$HIT', '$Skil', '$EFT', '$EFC', '0', '$wor')";
	   
$order2 = "INSERT INTO inventor
(User, Hash)
VALUES
('$User','$HASH')";	   

$result = mysqli_query($db, $order);
$result = mysqli_query($db, $order2);

$MoneyRew = ($ACC[3] + $MLVL) * 10; //gold for mob
$_SESSION["GoldRew"] = $MoneyRew;

$MoneySel = ($ACC[3] + $LVL) * 10; //gold for wep
$_SESSION["Gold"] = $MoneySel;

if ($WEP[14]<>0){
		if ($WEP[13] == "LL"){
	$efftype = "Life Leach";
	}
		if ($WEP[13] == "BL"){
	$efftype = "Bleed Chanse";
	}
		if ($WEP[13] == "BR"){
	$efftype = "Burn Chanse";
	}
		if ($WEP[13] == "FR"){
	$efftype = "Freez Chanse";
	}
		if ($WEP[13] == "ST"){
	$efftype = "Stun Chanse";
	}
	$eft = "$efftype $WEP[14] %<br>";}
	
if (!$WEP[2] == ""){
	$Current = "<b style='color:#$WEP[3]'>$WEP[1] ($WEP[2])</b>";}
	else{
	$Current = "$WEP[1]";}
	
if ($WEP[12] <> ""){
	$Skl2 = "Has Skill";}

//CAlculate AVG
$phyAVG1= round(($dMIN+$dMAX)/2);
$phyAVG2= round(($WEP[5]+$WEP[6])/2);
$magAVG1= round(($maMIN+$maMAX)/2);
$magAVG2= round(($WEP[9]+$WEP[10])/2);

//Changes in COLOR--MORE OR LESS then current weapon
$compareLVL=$comparePHYS1=$comparePHYS2=$comparePHYS=$compareMAG1=$compareMAG=$compareMAG2=$compareCRYT=$compareHIT="more";
if($LVL<=$WEP[4]){
	$compareLVL="less";
}
if($dMIN<=$WEP[5]){
	$comparePHYS1="less";
}
if($dMAX<=$WEP[6]){
	$comparePHYS2="less";
}
if($maMIN<=$WEP[9]){
	$compareMAG1="less";
}
if($maMAX<=$WEP[10]){
	$compareMAG2="less";
}
if($CRIT<=$WEP[7]){
	$compareCRYT="less";
}
if($HIT<=$WEP[11]){
	$compareHIT="less";
}
if($phyAVG1<=$phyAVG2){
	$comparePHYS="less";
}
if($magAVG1<=$magAVG2){
	$compareMAG="less";
}


$reward = "<b><font color='red'><br> -WEAPON !-</font><br><br>DROP:</b><br><br>Name: $NAME<br>
LVL: <b><span class='$compareLVL'>$LVL</span></b><br>
Physical Dmg: <b><span class='$comparePHYS1'>$dMIN</span> ~ <span class='$comparePHYS2'>$dMAX</span> <font size='2'>(Avg. <span class='$comparePHYS'>$phyAVG1</span>)</font></b><br>
Magickal Dmg: <b><span class='$compareMAG1'>$maMIN</span> ~ <span class='$compareMAG2'>$maMAX</span> <font size='2'>(Avg. <span class='$compareMAG'>$magAVG1</span>)</font></b><br>
Cryt chanse: <span class='$compareCRYT'>$CRIT %</span><br>
Hit chanse: <span class='$compareHIT'>$HIT %</span><br>
$ef $skiln
Worth: $MoneySel gold<br>
<br><b>Current item:</b><br>
Name: $Current <br>
Item lvl: <b>$WEP[4]</b><br>
Physical Dmg: <b>$WEP[5] ~ $WEP[6] <font size='2'>(Avg. $phyAVG2)</font></b><br>
Magickal Dmg: <b>$WEP[9] ~ $WEP[10] <font size='2'>(Avg. $magAVG2)</font></b><br>
Cryt chanse: $WEP[7] %<br>
Hit chanse: $WEP[11] %<br>
Skill: $Skl2<br>
$eft<br>";

$_SESSION["Reward"] = "$reward";
$_SESSION["HASH"] = "$HASH";

$XPT = $_SESSION["XPT"];
$XPS  = $Drop * $XPT;
$_SESSION["XPS"] = $XPS;
$xp = $ACC[5] +  $XPT * $Drop;

$order3 = "UPDATE characters
SET XP = '$xp'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order3);	

$kills = $ACC[6] +1;
	   
$order3 = "UPDATE characters
SET Kills = '$kills'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order3);	

//gold for mob
$cash = ($ACC[4] - $Money) + $MoneyRew;

$order4 = "UPDATE characters
SET Cash = '$cash'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order4);

$PAS = mysqli_query($db,"SELECT * FROM passive where USER = '$User' ");
$PAS = mysqli_fetch_row($PAS);

$XPPA  = $MLVL * $XPT;
$XPPA=round($XPPA);
$_SESSION["XPPA"] = $XPPA;
$XPP=($MLVL * $XPT) + $PAS[1];
$XPP=round($XPP);

$order5 = "UPDATE passive
SET xp1= '$XPP'
WHERE `USER` = '$User'";

$result = mysqli_query($db, $order5);

$S1 = rand(1,100);
$S2 = rand(1,15);

if ($S1 <  10){
$Shards = $ACC[15] + $S2;
$order6 = "UPDATE characters
SET Shards= '$Shards'
WHERE `USER` = '$User'";
$result = mysqli_query($db, $order6);
$_SESSION["SHD"] = $S2;
}

mysqli_close($db);
header("location:reward.php");

//TABLE
echo"
    <table>
  <tr>
    <th colspan='3'>$NAME</th>
  </tr>
  <tr>
   <td colspan='2'>$TYPE</td>  
    <td>LVL: $LVL</td>
  </tr>
  <tr>
    <td>Physical DMG:</td>
    <td>$dMIN</td>
    <td>$dMAX</td>
  </tr>
  <tr>
    <td>CRYT Chanse:</td>
 <td colspan='2'>$CRIT</td>  
 </tr>
  <tr>
    <td>Atack Speed:</td>
 <td colspan='2'>$AS</td>
  </tr>
    <tr>
    <td>Magick DMG:</td>
    <td>$maMIN</td>
    <td>$maMAX</td>
  </tr>
  <tr>
    <td>Hit chanse:</td>
 <td colspan='2'>$HIT</td>
  </tr>
  <tr>
    <td>Skill</td>
<td colspan='2'>$SKL</td>
  </tr>
  <tr>
    <td>$EFNAME</td>
<td colspan='2'>$EFC</td>
  </tr>

</table>";
    
	
	?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">  
</script>
<script type="text/javascript">

function myfunc(div) {
  var className = div.getAttribute("class");
  if(className=="submit") {
    div.className = "disabled";
  }
  if(className=="showButon") {
    div.className = "disabled";
  }
}

</script>
<!--script ends here-->

</body>
</html>