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

$WEPhash = $_SESSION["CURRENTWHASH"]; //current
$WEP = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$WEPhash' ");
$WEPi = mysqli_fetch_assoc($WEP);


list($HASH, $name, $typeName, $iLVL, $weaponPhysMin, $weaponPhysMax, $weaponCrit, $weaponMagMin, $weaponMagMax, $weaponHit, $weaponSkill, $Effect, $EffectChance)=itemDrop($db, $User, "weapon", $MLVL);

$worth = $iLVL + $weaponPhysMax + $weaponMagMax + $weaponHit;

$_SESSION["REWARDTYPE"] = "WEP";

//insert into db

$order = "INSERT INTO DropsWep
	   (HASH, Name, Rarity, ilvl, pmin, pmax, cryt, mmin, mmax, hitChanse, skill, effect, efstat, plus, Worth)
	  VALUES
	   ('$HASH', '$name', '$typeName', '$iLVL', '$weaponPhysMin', '$weaponPhysMax', '$weaponCrit', '$weaponMagMin', '$weaponMagMax', '$weaponHit', '$weaponSkill', '$Effect', '$EffectChance', '0', '$worth')";
	   
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

//for new weapon
if ($EffectChance <> 0){
		if ($Effect == "LL"){
	$efftype = "Life Leach";
	}
		if ($Effect == "BL"){
	$efftype = "Bleed Chanse";
	}
		if ($Effect == "BR"){
	$efftype = "Burn Chanse";
	}
		if ($Effect == "FR"){
	$efftype = "Freez Chanse";
	}
		if ($Effect == "ST"){
	$efftype = "Stun Chanse";
	}
		if ($Effect == "SH"){
	$efftype = "Shock Chanse";
	}
		if ($Effect == "BK"){
	$efftype = "Block Chanse";
	}
		if ($Effect == "SM"){
	$efftype = "Summon increase";
	}
		if ($Effect == "PS"){
	$efftype = "Poision increase";
	}
		if ($Effect == "CF"){
	$efftype = "Confusion chanse";
	}
		if ($Effect == "CS"){
	$efftype = "Cursed Soul";
	}
		if ($Effect == "WK"){
	$efftype = "Weaken monster";
	}
		if ($Effect == "NS"){
	$efftype = "Nerve Shock";
	}
	
	$eft = "Effect: $efftype <b>$EffectChance %</b><br>";}
	
//for old 
if ($WEPi["efstat"]<>0){
		if ($WEPi["effect"] == "LL"){
	$efftype = "Life Leach";
	}
		if ($WEPi["effect"] == "BL"){
	$efftype = "Bleed Chanse";
	}
		if ($WEPi["effect"] == "BR"){
	$efftype = "Burn Chanse";
	}
		if ($WEPi["effect"] == "FR"){
	$efftype = "Freez Chanse";
	}
		if ($WEPi["effect"] == "ST"){
	$efftype = "Stun Chanse";
	}
		if ($WEPi["effect"] == "SH"){
	$efftype = "Shock Chanse";
	}
		if ($WEPi["effect"] == "BK"){
	$efftype = "Block Chanse";
	}
		if ($WEPi["effect"] == "SM"){
	$efftype = "Summon increase";
	}
		if ($WEPi["effect"] == "PS"){
	$efftype = "Poision increase";
	}
		if ($WEPi["effect"] == "CF"){
	$efftype = "Confusion chanse";
	}
		if ($WEPi["effect"] == "CS"){
	$efftype = "Cursed soul";
	}
		if ($WEPi["effect"] == "WK"){
	$efftype = "Weaken monster";
	}
		if ($WEPi["effect"] == "NS"){
	$efftype = "Nerve Shock";
	}
	$eft2 = "Effect: $efftype $WEPi[efstat] %<br>";}
	
	//check for uniq
	if ($WEPn["Rarity"] == "Unique"){
		$unEf = "class='awesome'";
	}
	
if (!$WEPi["Name"] == ""){
	$Current = "<b class='$WEPi[Rarity]'>$WEPi[Name] ($WEPi[Rarity])</b>";}
	else{
	$Current = "$WEPi[Name]";}
	
if ($WEPi["skill"] <> ""){
	$Skl2 = "Has Skill";}

//CAlculate AVG
$phyAVG1= round(($weaponPhysMin+$weaponPhysMax)/2);
$phyAVG2= round(($WEPi["pmin"]+$WEPi["pmax"])/2);
$magAVG1= round(($weaponMagMin+$weaponMagMax)/2);
$magAVG2= round(($WEPi["mmin"]+$WEPi["mmax"])/2);

//Changes in COLOR--MORE OR LESS then current weapon
$compareLVL=$comparePHYS1=$comparePHYS2=$comparePHYS=$compareMAG1=$compareMAG=$compareMAG2=$compareCRYT=$compareHIT="more";
if($iLVL<=$WEPi["ilvl"]){
	$compareLVL="less";
}
if($weaponPhysMin<=$WEPi["pmin"]){
	$comparePHYS1="less";
}
if($weaponPhysMax<=$WEPi["pmax"]){
	$comparePHYS2="less";
}
if($weaponMagMin<=$WEPi["mmin"]){
	$compareMAG1="less";
}
if($weaponMagMax<=$WEPi["mmax"]){
	$compareMAG2="less";
}
if($weaponCrit<=$WEPi["cryt"]){
	$compareCRYT="less";
}
if($weaponHit<=$WEPi["HitChanse"]){
	$compareHIT="less";
}
if($phyAVG1<=$phyAVG2){
	$comparePHYS="less";
}
if($magAVG1<=$magAVG2){
	$compareMAG="less";
}

//skill for new
if ($weaponSkill >= 1){
	$SKILL = mysqli_query($db,"SELECT * FROM iskills where ID = '$weaponSkill' ");
	$SKILLS = mysqli_fetch_assoc($SKILL);
	$img = "<img src='IMG/$SKILLS[pic]' style='width:33px'><br>";}
//skill for old
if ($WEPi["skill"] >= 1){
	$SKILL = mysqli_query($db,"SELECT * FROM iskills where ID = '$WEPi[skill]' ");
	$SKILLS = mysqli_fetch_assoc($SKILL);
	$img2 = "<img src='IMG/$SKILLS[pic]' style='width:33px'>";}


$reward = "<b><font color='red'>-WEAPON !-</font><br><br>DROP:</b><br><br>Name: $name<br>
LVL: <b><span class='$compareLVL'>$iLVL</span></b><br>
Physical Dmg: <b><span class='$comparePHYS1'>$weaponPhysMin</span> ~ <span class='$comparePHYS2'>$weaponPhysMax</span> <font size='2'>(Avg. <span class='$comparePHYS'>$phyAVG1</span>)</font></b><br>
Magickal Dmg: <b><span class='$compareMAG1'>$weaponMagMin</span> ~ <span class='$compareMAG2'>$weaponMagMax</span> <font size='2'>(Avg. <span class='$compareMAG'>$magAVG1</span>)</font></b><br>
Cryt chanse: <span class='$compareCRYT'>$weaponCrit %</span><br>
Hit chanse: <span class='$compareHIT'>$weaponHit %</span><br>
$eft $img
Worth: $moneySel gold<br>
<br><b>Current item:</b><br><br>
Name: $Current <br>
Item lvl: <b>$WEPi[ilvl]</b><br>
Physical Dmg: <b>$WEPi[pmin] ~ $WEPi[pmax] <font size='2'>(Avg. $phyAVG2)</font></b><br>
Magickal Dmg: <b>$WEPi[mmin] ~ $WEPi[mmax] <font size='2'>(Avg. $magAVG2)</font></b><br>
Cryt chanse: $WEPi[cryt] %<br>
Hit chanse: $WEPi[HitChanse] %<br>
$eft2 $img2 <br>";

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
$passiveXPTotal=round($passiveXP + $Passive[1]);

$orderPassive = "UPDATE passive
SET xp1= '$passiveXPTotal'
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
<td colspan='2'>$EffectChance</td>
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