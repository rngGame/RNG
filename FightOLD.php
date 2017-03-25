<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>World of RNG</title>
<link rel="stylesheet" type="text/css" href="CSS/meniu.css">
</head>
<body>
<header>
<?php
session_start();
include_once 'PHP/db.php';

$HPin = $_SESSION["HP"];
$GOLDin = $_SESSION["GOLD"];
$DMGin = $_SESSION["DMG"];

echo "World Of RNG";
echo "<p align='left'>HP: <font size='3' color='Green'>$HPin  </font>";
echo "DMG: <font size='3' color='red'>$DMGin  </font>";
echo "GOLD: <font size='3' color='gold'>$GOLDin  </font></p>";
echo "</header>";

$User = $_SESSION["User"];
$gold = $_SESSION["Gold1"];
$gl = $_SESSION["Gold2"];
$BLVL = $_SESSION["fLVL"];

$dbs = "Monster$BLVL";


$N1 = "";	
$N2 = "";	
$N3 = "";
$N4 = "";
$N5 = "";
$NE = "";
$Class = "";	
$ILVL = 0;
$Dmg = 0;
$Drop = 0;
$elvl = 0;

$Base[0] = "";
$Base[1] = "";
$Base[2] = "";
$Base[3] = "";
$Base[4] = "";


$Base = mysqli_query($db,"SELECT * FROM $dbs Order by RAND() Limit 	1");
$Base = mysqli_fetch_row($Base);

$Pref = mysqli_query($db,"SELECT * FROM MonsPre Order by RAND() Limit 	1");
$Pref = mysqli_fetch_row($Pref);

$Sub = mysqli_query($db,"SELECT * FROM MonsSub Order by RAND() Limit 	1");
$Sub = mysqli_fetch_row($Sub);

$ench = mysqli_query($db,"SELECT * FROM monsenchant Order by RAND() Limit 	1");
$ench = mysqli_fetch_row($ench);




$c1 = rand(1,100);
$c2 = rand(1,100);
$c3 = rand(1,100);
$c4 = rand(1,100);
$c5 = rand(1,200);

if ($c1 <> 0){
$Name = $Base[0];
$HP = $Base[1];
$LVL = $Base[2];
$DMG = $Base[3];
$Drop = $Base[4];}

if ($c2 < 40){
$N2 = $Pref[0];
$HP = $HP * $Pref[2];
$DMG = $DMG * $Pref[3];
$Drop = $Drop + $Pref[1];}

if ($c3 < 30){
$N3 = $Sub[0];
$HP = $HP * $Sub[2];
$LVL = $LVL + $Sub[4];
$DMG = $DMG * $Sub[3];
$Drop = $Drop + $Sub[1];}

if ($c4 < 20){
$N4 = $ench[0];
$HP = $HP * $ench[2];
$LVL = $LVL + $ench[1];
$DMG = $DMG * $ench[2];
$Drop = $Drop + $ench[2];}

if ($c4 < 1){
$N5 = "<b style='color:#ff0066'>! RARE !</b>";
$HP = $HP * 1.15;
$LVL = $LVL * 2.5;
$DMG = $DMG * 0.8;
$Drop = $Drop * 10;}

$N1 = $Base[0];
echo "Monster Name: <b>$N5 $N4 $N2 $Name $N3</b><br>";
echo " HP: $HP, DMG: $DMG, XP: $Drop, Lvl: $LVL";
$_SESSION["MonsName"] = "$N2 $Name $N3";
$_SESSION["MonsHP"] = $HP;
$_SESSION["MonsDMG"] = $DMG;
$_SESSION["MonsDrop"] = $Drop;
$_SESSION["MonsLVL"] = $LVL;

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$cash = $ACC[4] - $gl;
	   
$order2 = "UPDATE characters
SET Cash = '$cash'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order2);	


echo
  "<section class='container2'>
    <div class='11-30'>
	      <form method='post' action='Fight2.php'>
          <input hidden='' type='text' name='lvl' value='30' placeholder='lvl'>
        <p class='submit'><input type='submit' name='commit' value='Fight $gold'></p> 
      </form>
    </div>
  </section>
  


<section class='container1'>
    <div class='1-10'>
	      <form method='post' action='Fight.php'>
          <input hidden='' type='text' name='lvl' value='$BLVL' placeholder='Try another Monster'>
        <p class='submit'><input type='submit' name='commit' value='Try another Monster $gl g'> </p>
      </form>
    </div>
  </section>";
  
  ?>
  <section class="container3">
    <div class="31-50">
	      <form method="post" action="Sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>