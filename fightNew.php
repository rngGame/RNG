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
<?php
include_once 'PHP/db.php';
include_once 'PHP/function.php';

$HPin = $_SESSION["HP"];
$DMGp = $_SESSION["DMGPAVE"];
$DMGm = $_SESSION["DMGMAVE"];
$Armor = $_SESSION["ARM"];
$ArmorM = $_SESSION["MARM"];
$eng = $_SESSION["ENG"];

echo "World Of RNG";
echo "</header>";
echo "<p align='left'>HP: <font size='3' color='Green'>$HPin  </font>";
echo "DMG: <font size='3' color='red'>~$DMGp</font>/<font size='3' color='#0066ff'>~$DMGm  </font>";
echo "ARMOR: <font size='3' color='gold'>$Armor</font> / <font size='3' color='#DF01D7'>$ArmorM </font> </p>";


$User = $_SESSION["User"];
$gold = $_SESSION["Gold1"];
$gl = $_SESSION["Gold2"];
$BLVL = $_SESSION["fLVL"];
$iLVL = $_SESSION["ILVL"];
$checkForParty = $_SESSION["PartCreatMOB"];

$bs = $_SESSION["BOSS"];

list($name, $mLVL, $HP, $PDMG, $MDMG, $Drop, $monsterIMG/*, $testMessage*/)=createMonster($db,$iLVL);

if ($mLVL < 1 or $HP < 1 or $PDMG < 1 or $Drop < 1){
	//header("location:fightNew.php");
	echo "$name || MLVL: $mLVL || HP: $HP || DMG: $DMG || DROP: $Drop || iLVL: $iLVL";
	echo $testMessage;
  	die();
}
else {

    echo "<img src='IMG/Mon/$monsterIMG.jpg' width='60' height='60'><br>";
    echo "Monster Name: <b>$name</b><br>";
    echo " HP: $HP, DMG: <font color='red'>~$PDMG</font>/<font color='0066ff'>~$MDMG</font>, XP: $Drop, Lvl: $mLVL";
    $_SESSION["MonsName"] = "$name";
    $_SESSION["MonsHP"] = $HP;
    $_SESSION["MonsDMG"] = $PDMG;
	$_SESSION["MonsDMGm"] = $MDMG;
    $_SESSION["MonsDrop"] = $Drop;
    $_SESSION["MonsLVL"] = $mLVL;
    $_SESSION["MonsIMG"] = $monsterIMG;
	
//create for party
if ($checkForParty == 1){
	
	$PartyID = $_SESSION["PartyID"];
	$plCount = $_SESSION["PLCount"];
	
	$DEF = $iLVL / 10;
	
	$MobHP= $HP + ($HP * ($plCount * 10) / 100);
	$MobDrop= $Drop + ($Drop * ($plCount * 10) / 100);
	
	$order = "INSERT INTO PartyMonsters
	(PartyID, MonsterLVL, MonsterName, MonsterHP, MonsterPhyDMG, MonsterMagDMG, MonsterDEF, MonsterRew, StartingHP)
	VALUES
	('$PartyID', '$mLVL', '$name', '$MobHP', '$PDMG', '$MDMG', '$DEF', '$MobDrop', '$MobHP')";	   



$result = mysqli_query($db, $order);
	header("location:sync.php");

die();
}

    echo
      "<section class='container2'>
        <div class='11-30'>
    	      <form method='post' action='FightT.php'>
              <input hidden='' type='text' name='lvl' value='30' placeholder='lvl'>
            <p class='submit'><input type='submit' name='commit' value='Fight'></p> 
          </form>
        </div>
      </section>
      


    <section class='container1'>
        <div class='1-10'>
    	      <form method='post' action='fightNew.php'>
              <input hidden='' type='text' name='lvl' value='$BLVL' placeholder='Try another Monster'>
            <p class='submit'><input type='submit' name='commit' value='Try another Monster'> </p>
          </form>
        </div>
      </section>";
    echo $testMessage;
	}

  ?>
  <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>