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
include_once 'PHP/function.php';

$MLVL = $_SESSION["MonsLVL"];
$Drop = $_SESSION["MonsDrop"];
$FightFee = $_SESSION["Money"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);
$WEP = mysqli_query($db,"SELECT * FROM weapondrops where HASH = '$ACC[1]' ");
$WEP = mysqli_fetch_row($WEP);

list($HASH, $name, $typeName, $iLVL, $weaponPhysMin, $weaponPhysMax, $weaponCrit, $weaponMagMin, $weaponMagMax, $weaponHit, $weaponSkill, $weaponEffect, $weaponEffectChance)=itemDrop($db, $User, "weapon", $MLVL);

$worth = $iLVL + $weaponPhysMax + $weaponMagMax + $weaponHit;
//insert into db

$order = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, hitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', '$name', '$typeName', '$iLVL', '$weaponPhysMin', '$weaponPhysMax', '$weaponCrit', '$weaponMagMin', '$weaponMagMax', '$weaponHit', '$weaponSkill', '$weaponEffect', '$weaponEffectChance', '0', '$worth')";
	   
$order2 = "INSERT INTO Equiped
(User, Part, HASH, Equiped)
VALUES
('$User', 'WEP', '$HASH', '0')";	   

$result = mysqli_query($db, $order);
$result = mysqli_query($db, $order2);

$moneyRew = ($ACC[3] + $MLVL) * 10; //gold for mob
$_SESSION["GoldRew"] = $moneyRew;

$moneySel = ($ACC[3] + $iLVL) * 10; //gold for wep
$_SESSION["Gold"] = $moneySel;

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
$phyAVG1= round(($weaponPhysMin+$weaponPhysMax)/2);
$phyAVG2= round(($WEP[5]+$WEP[6])/2);
$magAVG1= round(($weaponMagMin+$weaponMagMax)/2);
$magAVG2= round(($WEP[9]+$WEP[10])/2);

//Changes in COLOR--MORE OR LESS then current weapon
$compareLVL=$comparePHYS1=$comparePHYS2=$comparePHYS=$compareMAG1=$compareMAG=$compareMAG2=$compareCRYT=$compareHIT="more";
if($iLVL<=$WEP[4]){
	$compareLVL="less";
}
if($weaponPhysMin<=$WEP[5]){
	$comparePHYS1="less";
}
if($weaponPhysMax<=$WEP[6]){
	$comparePHYS2="less";
}
if($weaponMagMin<=$WEP[9]){
	$compareMAG1="less";
}
if($weaponMagMax<=$WEP[10]){
	$compareMAG2="less";
}
if($weaponCrit<=$WEP[7]){
	$compareCRYT="less";
}
if($weaponHit<=$WEP[11]){
	$compareHIT="less";
}
if($phyAVG1<=$phyAVG2){
	$comparePHYS="less";
}
if($magAVG1<=$magAVG2){
	$compareMAG="less";
}



$reward = "<b><font color='red'><br> -WEAPON !-</font><br><br>DROP:</b><br><br>Name: $weaponName<br>
LVL: <b><span class='$compareLVL'>$iLVL</span></b><br>
Physical Dmg: <b><span class='$comparePHYS1'>$weaponPhysMin</span> ~ <span class='$comparePHYS2'>$weaponPhysMax</span> <font size='2'>(Avg. <span class='$comparePHYS'>$phyAVG1</span>)</font></b><br>
Magickal Dmg: <b><span class='$compareMAG1'>$weaponMagMin</span> ~ <span class='$compareMAG2'>$weaponMagMax</span> <font size='2'>(Avg. <span class='$compareMAG'>$magAVG1</span>)</font></b><br>
Cryt chanse: <span class='$compareCRYT'>$weaponCrit %</span><br>
Hit chanse: <span class='$compareHIT'>$weaponHit %</span><br>
$weaponEffect $weaponSkillText
Worth: $moneySel gold<br>
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

//check talisman xp bonus
$xpTalismanMulti = $_SESSION["XPT"];
$xpNew  = $Drop * $xpTalismanMulti;
$_SESSION["XPS"] = $xpNew;
//update user stats
$xpTotal = $ACC[5] + $xpNew;
$kills = $ACC[6] +1;
$cash = ($ACC[4] - $FightFee) + $moneyRew;
     

//update passives
$Passive = mysqli_query($db,"SELECT * FROM passive where USER = '$User' ");
$Passive = mysqli_fetch_row($Passive);

$passiveXP = round($MLVL * $xpTalismanMulti);
$_SESSION["XPPA"] = $passiveXP;
$passiveXPTotal=round($passiveXP + $Passive[4]);

$orderPassive = "UPDATE passive
SET xp2= '$passiveXPTotal'
WHERE `User` = '$User'";

$result = mysqli_query($db, $orderPassive);

$rngShardsChance = rand(1,100);
$Shards = $ACC[15];

if ($rngShardsChance <  10){
  $rngShardsAmmount = rand(1,15);
  $Shards += $rngShardsAmmount;
  $_SESSION["SHD"] = $rngShardsAmmount;
}
$orderChar = "UPDATE characters
SET Shards= '".$Shards."', XP = '".$xpTotal."', Kills = '".$kills."', Cash = '".$cash."'
WHERE `USER` = '$User'";
$result = mysqli_query($db, $orderChar);

mysqli_close($db);
header("location:reward.php");
//TABLE
/*echo"
    <table>
  <tr>
    <th colspan='3'>$weaponName</th>
  </tr>
  <tr>
   <td colspan='2'>$typeName</td>  
    <td>LVL: $iLVL</td>
  </tr>
  <tr>
    <td>Physical DMG:</td>
    <td>$weaponPhysMin</td>
    <td>$weaponPhysMax</td>
  </tr>
  <tr>
    <td>CRYT Chanse:</td>
 <td colspan='2'>$weaponCrit</td>  
 </tr>
  <tr>
    <td>Atack Speed:</td>
 <td colspan='2'>$weaponSpeed</td>
  </tr>
    <tr>
    <td>Magick DMG:</td>
    <td>$weaponMagMin</td>
    <td>$weaponMagMax</td>
  </tr>
  <tr>
    <td>Hit chanse:</td>
 <td colspan='2'>$weaponHit</td>
  </tr>
  <tr>
    <td>Skill</td>
<td colspan='2'>$SKL</td>
  </tr>
  <tr>
    <td>$EFNAME</td>
<td colspan='2'>$weaponEffectChance</td>
  </tr>

</table>";*/
    
	
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