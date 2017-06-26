<?php
session_start();
ob_start();
$User = $_SESSION["User"];

include_once 'PHP/db.php';
include_once 'PHP/function.php';
$MLVL = $_SESSION["MonsLVL"];
$sell = $_SESSION["Sell"];
$Drop = $_SESSION["MonsDrop"]; //DB drop value of monster
$FightFee = $_SESSION["Money"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

//creates armor function
list($HASH, $name, $typeName, $iLVL, $Bonus, $SkillID) = itemDrop($db,$User,"skill",$MLVL);

$name .= " fragment";

//find icon for fragment
$Icon = $SkillID;



//insert into db

$order = "INSERT INTO DropsSkl
	   (HASH, Name, Rarity, ilvl, Bonus, Skill, IMG, plus)
	  VALUES
	   ('$HASH', '$name', '$typeName', '$iLVL', '$Bonus','$SkillID','$Icon', '0')";
	   
$order2 = "INSERT INTO Equiped
(User, Part, HASH, Equiped)
VALUES
('$User', 'SKL', '$HASH', '0')";	   

$result = mysqli_query($db, $order);
$result = mysqli_query($db, $order2);

$_SESSION["REWARDTYPE"] = "SKL";


//money calculates
$moneyRew = ($ACC[3] + $MLVL) * 10; //gold for mob
$_SESSION["GoldRew"] = $moneyRew;

$moneySel = ($ACC[3] + $iLVL) * 10; //gold for wep
$_SESSION["Gold"] = $moneySel;

//current
if (isset($_SESSION["CURRENTSKLHASH"])){
$CurrentHASH = $_SESSION["CURRENTSKLHASH"];

$ACS = mysqli_query($db,"SELECT * FROM DropsSkl where HASH = '$CurrentHASH' ");
$ACSi = mysqli_fetch_assoc($ACS);

$text = "<br><img src='IMG/SKILL/$ACSi[Skill].png' height='45px'><br>Name: $ACSi[Name]<br>
Item lvl: <b><span class='$compareLVL'>$ACSi[ilvl]</span></b><br>
Item Bonus: $ACSi[Bonus]<br>
<br>";
}

//create Reward Template
$reward = "<b><font color='lightblue'><br> -SKILL FRAGMENT !- </font><br><br>DROP:</b><br><img src='IMG/SKILL/$Icon.png' height='45px'><br>Name: $name<br>
Item lvl: <b><span class='$compareLVL'>$iLVL</span></b><br>
Item Bonus: $Bonus<br>
Item worth: $moneySel Gold<br>
<br><b>Current item:</b><br>
$text
";


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

?>