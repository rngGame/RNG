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

$PartID = $_SESSION["Party"];
$PlayerNR = $_SESSION["PlayerNR"];



$PartyS = mysqli_query($db,"SELECT * FROM PartyMonsters where PartyID = '$PartID' ");
$Party = mysqli_fetch_assoc($PartyS); //Party

if ( $PlayerNR == 1){
	//vieno playerio negali but
}
if ( $PlayerNR == 2){
	$PL1 = $Party["PL1"] / $Party["StartingHP"];
	$PL2 = $Party["PL2"] / $Party["StartingHP"];
	$PL1 *= 100;
	$PL2 *= 100;
}
if ( $PlayerNR == 3){
	$PL1 = $Party["PL1"] / $Party["StartingHP"];
	$PL2 = $Party["PL2"] / $Party["StartingHP"];
	$PL3 = $Party["PL3"] / $Party["StartingHP"];
	$PL1 *= 100;
	$PL2 *= 100;
	$PL3 *= 100;
}
if ( $PlayerNR == 4){
	$PL1 = $Party["PL1"] / $Party["StartingHP"];
	$PL2 = $Party["PL2"] / $Party["StartingHP"];
	$PL3 = $Party["PL3"] / $Party["StartingHP"];
	$PL4 = $Party["PL4"] / $Party["StartingHP"];
	$PL1 *= 100;
	$PL2 *= 100;
	$PL3 *= 100;
	$PL4 *= 100;
}

//give reward to players
$i = 0;
while ($i < $PlayerNR){
	
	$i = $i + 1;	
	
	$PL = "PL$i";
	
	$UserC = mysqli_query($db,"SELECT * FROM characters where User = '$Party[$PL]' ");
	$UserChar = mysqli_fetch_assoc($UserC); //Party
	
	echo "$UserChar[User]";
	

}


	die();





/*

$selectpart = rand(1,3);

if ($selectpart == 1){
list($HASH, $name, $typeName, $iLVL, $weaponPhysMin, $weaponPhysMax, $weaponCrit, $weaponMagMin, $weaponMagMax, $weaponHit, $weaponSkill, $weaponEffect, $weaponEffectChance)=itemDrop($db, $User, "weapon", $MLVL);

$worth = $iLVL + $weaponPhysMax + $weaponMagMax + $weaponHit;

$_SESSION["REWARDTYPE"] = "WEP";

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

if ($weaponEffectChance <> 0){
		if ($weaponEffect == "LL"){
	$efftype = "Life Leach";
	}
		if ($weaponEffect == "BL"){
	$efftype = "Bleed Chanse";
	}
		if ($weaponEffect == "BR"){
	$efftype = "Burn Chanse";
	}
		if ($weaponEffect == "FR"){
	$efftype = "Freez Chanse";
	}
		if ($weaponEffect == "ST"){
	$efftype = "Stun Chanse";
	}
		if ($weaponEffect == "SH"){
	$efftype = "Shock Chanse";
	}
		if ($weaponEffect == "BK"){
	$efftype = "Block Chanse";
	}
		if ($weaponEffect == "SM"){
	$efftype = "Summon increase";
	}
	$eft = "$efftype $weaponEffectChance %<br>";}
	
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
} //Weapon
if ($selectpart == 2){
list($HASH, $iLVL, $name, $typeName, $valueArmorP, $valueArmorM, $part, $apsorb) = itemDrop($db,$User,"armor",$MLVL);

$worth = $iLVL + $weaponPhysMax + $weaponMagMax + $weaponHit;
//insert into db

$order = "INSERT INTO DropsArm
	   (HASH, Name, Rarity, ilvl, pDEF, mDEF, Apsorb, Part, plus)
	  VALUES
	   ('$HASH', '$name', '$typeName', '$iLVL', '$valueArmorP', '$valueArmorM', '$apsorb', '$part' ,'0')";
	   
$order2 = "INSERT INTO Equiped
(User, Part, HASH, Equiped)
VALUES
('$User', 'ARM', '$HASH', '0')";	   

$result = mysqli_query($db, $order);
$result = mysqli_query($db, $order2);} //Armor 
if ($selectpart == 3){
	list($HASH, $part, $name, $typeName, $iLVL, $apsorb, $hpBonus, $xpBonus, $dmgBonus) = itemDrop($db,$User,"talisman",$MLVL);
$cash = $iLVL*$sell;

$_SESSION["REWARDTYPE"] = "TAL";

$worth = $iLVL + $weaponPhysMax + $weaponMagMax + $weaponHit;
//insert into db

$order = "INSERT INTO DropsAcs
	   (HASH, Part, Name, Rarity, ilvl, Apsorb, hpBonus, xpBonus, dmgBonus, plus, Worth)
	  VALUES
	   ('$HASH', '$part', '$name', '$typeName', '$iLVL', '$apsorb', '$hpBonus', '$xpBonus', '$dmgBonus','0', '$worth')";
	   
$order2 = "INSERT INTO Equiped
(User, Part, HASH, Equiped)
VALUES
('$User', 'ACS', '$HASH', '0')";	   

$result = mysqli_query($db, $order);
$result = mysqli_query($db, $order2);
} //Acsesory



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
header("location:reward.php");  */



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