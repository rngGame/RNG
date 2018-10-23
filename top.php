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
World of RNG
</header>
<?php
session_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"]; //user

$NR1 = 0;
$NR2 = 0;
$NR3 = 0;

//hardcore
echo "<div class='HARD'><b>Hardcore:</b><br>";

$hardcoreCHAR = mysqli_query($db,"SELECT * FROM characters WHERE Hardcore = '1' ORDER BY ILVL DESC");
while ($hardcoreCHARlist = mysqli_fetch_array($hardcoreCHAR) and $NR1 <> 10){	

$NR1 += 1;

if ($hardcoreCHARlist[7] >= 1){
	$deadalive = "<font color='red'>(Dead)</font>";
}
else{
	$deadalive = "<font color='green'>(Alive)</font>";
}

	//class icon...
if ($hardcoreCHARlist[10] < 10){
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$hardcoreCHARlist[10]' ");
$CLS = mysqli_fetch_row($CLS);
}
if ($hardcoreCHARlist[10] > 10){
$SUB = mysqli_query($db,"SELECT * FROM Subclass where ID = '$hardcoreCHARlist[10]' ");
$SUB = mysqli_fetch_row($SUB);
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$SUB[2]' ");
$CLS = mysqli_fetch_row($CLS);
}
echo "<div class='tooltip'>TOP $NR1 - <font color='$hardcoreCHARlist[12]'>$hardcoreCHARlist[0]</font>, ILVL: $hardcoreCHARlist[9]$deadalive<span class='tooltiptext'><img src='IMG/av/$CLS[10].jpg' style='width:50px;height:50px;'><br>$hardcoreCHARlist[13]</span></div> <br>";
}
echo "</div>";
	
	
//speedrun
echo "<div class='SPED'><b>Speed Run:</b><br>";

$SPEEDCHAR = mysqli_query($db,"SELECT * FROM characters WHERE Hardcore = '2' ORDER BY ILVL DESC");
while ($SPEEDCHARlist = mysqli_fetch_array($SPEEDCHAR) and $NR3 <> 10){	

$NR3 += 1;
	
	//class icon...
if ($SPEEDCHARlist[10] < 10){
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$SPEEDCHARlist[10]' ");
$CLS = mysqli_fetch_row($CLS);
}
if ($SPEEDCHARlist[10] > 10){
$SUB = mysqli_query($db,"SELECT * FROM Subclass where ID = '$SPEEDCHARlist[10]' ");
$SUB = mysqli_fetch_row($SUB);
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$SUB[2]' ");
$CLS = mysqli_fetch_row($CLS);
}


echo "<div class='tooltip'>TOP $NR3 - <font color='$SPEEDCHARlist[12]'>$SPEEDCHARlist[0]</font>, ILVL: $SPEEDCHARlist[9]<span class='tooltiptext'><img src='IMG/av/$CLS[10].jpg' style='width:50px;height:50px;'><br>$SPEEDCHARlist[13]</span></div> <br>";
}
echo "</div>";	
	
	
	
	

//softcore
echo "<div class='SOFT'><b>Softcore:</b><br>";

$hardcoreCHAR = mysqli_query($db,"SELECT * FROM characters WHERE Hardcore is null ORDER BY ILVL DESC");
while ($hardcoreCHARlist = mysqli_fetch_array($hardcoreCHAR) and $NR2 <> 10){	

$NR2 += 1;
	
	//class icon...
if ($hardcoreCHARlist[10] < 10){
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$hardcoreCHARlist[10]' ");
$CLS = mysqli_fetch_row($CLS);
}
if ($hardcoreCHARlist[10] > 10){
$SUB = mysqli_query($db,"SELECT * FROM Subclass where ID = '$hardcoreCHARlist[10]' ");
$SUB = mysqli_fetch_row($SUB);
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$SUB[2]' ");
$CLS = mysqli_fetch_row($CLS);
}


echo "<div class='tooltip'>TOP $NR2 - <font color='$hardcoreCHARlist[12]'>$hardcoreCHARlist[0]</font>, ILVL: $hardcoreCHARlist[9]<span class='tooltiptext'><img src='IMG/av/$CLS[10].jpg' style='width:50px;height:50px;'><br>$hardcoreCHARlist[13]</span></div> <br>";
}
echo "</div>";
	
	

?>
<div class="floating2">
  <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
  </div>

