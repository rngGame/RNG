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

$PartID = $_SESSION["Party2"];


$PartyS = mysqli_query($db,"SELECT * FROM PartyMonsters where PartyID = '$PartID' ");
$Party = mysqli_fetch_assoc($PartyS); //Party

//if dead
if ($Party["ID"] == 0){
	echo $PartID;
	header("location:sync.php");  
	die();
}

$UserWin = "";
$log .= "<br>";

$FreeParty = mysqli_query($db,"SELECT * FROM Party where ID =  '$PartID'  ");
$FreeParty = mysqli_fetch_row($FreeParty);


	
		$PlayerNR = 0;
	if ($FreeParty[1] <> ""){
		$PlayerNR += 1 ;}
	if ($FreeParty[2] <> ""){
		$PlayerNR += 1 ;}
	if ($FreeParty[3] <> ""){
		$PlayerNR += 1 ;}
	if ($FreeParty[4] <> ""){
		$PlayerNR += 1 ;}


if ( $PlayerNR == 1){
	//vieno playerio negali but
}
if ( $PlayerNR == 2){
	$PL1 = $Party["PL1"] / $Party["StartingHP"];
	$PL2 = $Party["PL2"] / $Party["StartingHP"];
	$PL[1] = round($PL1,2);
	$PL[2] = round($PL2,2);
	$RewardPL = rand(1,2);
	if ($RewardPL <= 2){
		$UserWin = $FreeParty[$RewardPL];
	}
}
if ( $PlayerNR == 3){
	$PL1 = $Party["PL1"] / $Party["StartingHP"];
	$PL2 = $Party["PL2"] / $Party["StartingHP"];
	$PL3 = $Party["PL3"] / $Party["StartingHP"];
	$PL[1] = round($PL1,2);
	$PL[2] = round($PL2,2);
	$PL[3] = round($PL3,2);
	$RewardPL = rand(1,3);
	if ($RewardPL <= 3){
		$UserWin = $FreeParty[$RewardPL];
	}
}
if ( $PlayerNR == 4){
	$PL1 = $Party["PL1"] / $Party["StartingHP"];
	$PL2 = $Party["PL2"] / $Party["StartingHP"];
	$PL3 = $Party["PL3"] / $Party["StartingHP"];
	$PL4 = $Party["PL4"] / $Party["StartingHP"];
	$PL[1] = round($PL1,2);
	$PL[2] = round($PL2,2);
	$PL[3] = round($PL3,2);
	$PL[4] = round($PL4,2);
	$RewardPL = rand(1,4);
	if ($RewardPL <= 4){
		$UserWin = $FreeParty[$RewardPL];
	}
}




//give reward to players
$i = 0;


while ($i < $PlayerNR and $i <> 100){
	
	$i = $i + 1;	
	
	 $PLS = "PL$i";
	 
	 
	$chk1 = mysqli_query($db,"SELECT * FROM Party where ID = '$PartID' ");
	$chk = mysqli_fetch_assoc($chk1); //Party
	
	
	$UserC = mysqli_query($db,"SELECT * FROM characters where User = '$chk[$PLS]' ");
	$UserC = mysqli_fetch_row($UserC);
	
	
	 $PL[$i];
	 
	 
	if (rand(1,1000) > 800){
	include 'PHP/items.php';
	
	$order7 = "INSERT INTO DropsItm
	(HASH, Name, EFT, Value, Icon )
	VALUES
	('$HASHIT', '$Name', '$EFT', '$value', '$icon')";
	   
	$order8 = "INSERT INTO Equiped
	(User, Part, HASH, Equiped)
	VALUES
	('$UserC[0]', 'ITM', '$HASHIT', '0')";	   

	$result = mysqli_query($db, $order7);
	$result = mysqli_query($db, $order8);	
	
	$log .= "<b>$UserC[0]</b> recived $Name<br>";
	
	}
	
	 
	
	
	$Drop = $Party["MonsterRew"] * $PL[$i];
	
	$Bonussrew = $PL[$i] * 10;
	if ($Bonussrew >= 10){
		$Bonussrew = 9;}
	
	$xpTalismanMulti = $_SESSION["XPT"];
	$xpNew  = $Drop * $xpTalismanMulti;
	$_SESSION["XPS"] = $xpNew;
	
	//update user stats
	$xpTotal = $UserC[5] + $xpNew;
	$kills = $UserC[6] +1;
	$cash = round($UserC[4]  + ((($MLVL * $UserC[3])/(10-$Bonussrew)) * 1.8));
	
	$Passive = mysqli_query($db,"SELECT * FROM passive where USER = '$UserC[0]' ");
	$Passive = mysqli_fetch_row($Passive);

	$passiveXP = round(($MLVL * $xpTalismanMulti)/10);
	$_SESSION["XPPA"] = $passiveXP;
	$passiveXPTotal=round($passiveXP + $Passive[10]);
	
	$orderPassive = "UPDATE passive
	SET xp4= '$passiveXPTotal'
	WHERE `User` = '$UserC[0]'";

	$result = mysqli_query($db, $orderPassive);
	
	
	$rngShardsChance = rand(1,100);
	$Shards = $UserC[15];

	if ($rngShardsChance <  10){
	  $rngShardsAmmount = rand(1,15);
	  $Shards += $rngShardsAmmount;
	  $log .= "<b>$UserC[0]</b> recived <font class='shards'>$rngShardsAmmount</font> shards.<br>";
	}
	$orderChar = "UPDATE characters
	SET Shards= '".$Shards."', XP = '".$xpTotal."', Kills = '".$kills."', Cash = '".$cash."'
	WHERE `USER` = '$UserC[0]'";
	$result = mysqli_query($db, $orderChar);
	


}



$sql2="DELETE FROM PartyMonsters WHERE PartyID='$PartID'";
mysqli_query($db,$sql2);

$Killsu = $FreeParty[5] +1;

	$killcount = "UPDATE Party
	SET MobsKilled= '$Killsu'
	WHERE `ID` = '$PartID'";
	$result = mysqli_query($db, $killcount);




if ($UserWin <> ""){
$selectpart = rand(1,3);

if ($selectpart == 1){
list($HASH, $name, $typeName, $iLVL, $weaponPhysMin, $weaponPhysMax, $weaponCrit, $weaponMagMin, $weaponMagMax, $weaponHit, $weaponSkill,  $Effect, $EffectChance)=itemDrop($db, $UserWin, "weapon", $MLVL);

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
('$UserWin', 'WEP', '$HASH', '0')";	   

$result = mysqli_query($db, $order);
$result = mysqli_query($db, $order2);

$moneyRew = ($ACC[3] + $MLVL) * 10; //gold for mob
$_SESSION["GoldRew"] = $moneyRew;

$moneySel = ($ACC[3] + $iLVL) * 10; //gold for wep
$_SESSION["Gold"] = $moneySel;

if ($weaponEffectChance <> 0){
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
	$eft = "$efftype $EffectChance %<br>";}
	
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

$log .="<br><b>$UserWin</b> Recived equipment - $name<br>";
} //Weapon

if ($selectpart == 2){
list($HASH, $iLVL, $name, $typeName, $valueArmorP, $valueArmorM, $part, $apsorb, $Effect, $EffectChance) = itemDrop($db,$UserWin,"armor",$MLVL);

$worth = $iLVL + $valueArmorP + $valueArmorM + $apsorb;
//insert into db

$order = "INSERT INTO DropsArm
	   (HASH, Name, Rarity, ilvl, pDEF, mDEF, Apsorb, Part, plus, effect, efstat)
	  VALUES
	   ('$HASH', '$name', '$typeName', '$iLVL', '$valueArmorP', '$valueArmorM', '$apsorb', '$part', '$Effect', '$EffectChance' ,'0')";
	   
$order2 = "INSERT INTO Equiped
(User, Part, HASH, Equiped)
VALUES
('$UserWin', 'ARM', '$HASH', '0')";	   

$result = mysqli_query($db, $order);
$result = mysqli_query($db, $order2);

$log .="<br><b>$UserWin</b> Recived equipment - $name<br>";

} //Armor 

if ($selectpart == 3){
	list($HASH, $part, $name, $typeName, $iLVL, $apsorb, $hpBonus, $xpBonus, $dmgBonus) = itemDrop($db,$UserWin,"talisman",$MLVL);
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
('$UserWin', 'ACS', '$HASH', '0')";	   

$result = mysqli_query($db, $order);
$result = mysqli_query($db, $order2);

$log .="<br><b>$UserWin</b> Recived equipment - $name<br>";
} //Acsesory
}

$_SESSION["NewMob"] = 1;
$_SESSION["TEST"] = 1;


mysqli_close($db);



$_SESSION["LOGPARTY"] = "$log";

header("location:reward.php");  

die();


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