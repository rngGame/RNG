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
session_start();
include_once 'PHP/db.php';

$User = $_SESSION["User"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);


$MOD = mysqli_query($db,"SELECT * FROM modlist where User = '$User' ");
$MOD = mysqli_fetch_row($MOD);

//coruption
if (isset($_SESSION["rezult2"])){
	
	$rez2 = $_SESSION["rezult2"];
	
	
	echo "<b style='color:red'><h2>$rez2</h2></b>";
	echo "<br><b>$_SESSION[info]</b><br>";
	
	echo "<section class='actionButtons2'>
	      <form method='post' action='sync.php'>
        <p class='submit'><input type='submit' name='commit' value='Back'></p>
      </form>
  </section>
  </div>";
  die();
	
}

if ($MOD[0] == ""){
	echo "";
	}
else {
	$MODN = array();
	$MODE = array();
	$MODT = array();
	$modc = 1;
	$mc = 1;
	while ($modc <= 4){
		$MDC = mysqli_query($db,"SELECT * FROM mods where ID = '$MOD[$mc]' ");
		$MDC = mysqli_fetch_row($MDC);	
		if ($MDC[1] != ""){
			$MODN[$mc] = $MDC[1];
			$MODT[$mc] = $MDC[2];
			$MODE[$mc] = $MOD[$mc+1];	
			$mc = $mc + 2;
			$modc = $modc + 1;		
		}
		else{
			$modc = 5;
		}	
}
}

echo "<div id='wrapperv'>";
if(isset($mc)){
$img = $mc - 2;}
else{
	$img = 1;}
if ($img < 1){
	$img = 1;}


echo "<div id='miniv'><img src='IMG/$img.png'></div>";

echo "<div id='veilvl2'>$MOD[9]</div>";

echo "<div id='veil2'>";
if(isset($MODN[1])){

if(isset($MODN[1])){
	$n1 = $MODN[1];
	$e1 = $MODE[1];
	echo "$e1% $n1<br>";
}
if(isset($MODN[3])){
	$n2 = $MODN[3];
	$e2 = $MODE[3];
	echo "$e2% $n2<br>";
}
if(isset($MODN[5])){
	$n3 = $MODN[5];
	$e3 = $MODE[5];
	echo "$e3% $n3<br>";
}
if(isset($MODN[7])){
	$n4 = $MODN[7];
	$e4 = $MODE[7];
	echo "$e4% $n4<br>";
}
echo "</div>";
}
else {
	echo "No mod equiped</div>";
}

$r = 1;
if(isset($mc)){
	while ($mc >= 1){
		$r = ($r + 1) * $mc;
		$mc = $mc - 2;
	}
}

$MODK = $MOD[9] * $r ;


echo"<div id='textv'>";
echo "You have: <b>$ACC[4]</b><br>";
echo "Cost to reroll: <b>$MODK</b></div>";

$_SESSION["MODP"] = $MODK;


if($MOD[12] == 1){}
else{
	
    echo "<br><div id='mini4'>Items:";
  
//ITEMS
echo "<section class='container2'>";

$List = mysqli_query($db,"SELECT * FROM Equiped WHERE User = '$User' AND Part = 'ITM'");
while ($List1 = mysqli_fetch_array($List)){	

	$ITMs = mysqli_query($db,"SELECT * FROM DropsItm WHERE HASH = '$List1[2]'");
	$ITMn = mysqli_fetch_assoc($ITMs);
	
	
	if ($ITMn["EFT"] == "COR"){
echo "
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='reroll.php'>
		  <input type='hidden' name='COR' value='3'>
          <input type='hidden' name='ITM' value='$User'>
        <p class='submit' onclick='myfunc(this)'><input  img src='IMG/pack/$ITMn[Icon].png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>$ITMn[Name]<br>Can only use once/item</span></p> 
      </form>
    </div>&nbsp;&nbsp;";
	}

}

  
  echo "</div>";

}



  mysqli_close($db);
    ?>
<div id="buttonv">
<section class="container3">
    <div class="31-50">
	      <form method="post" action="reroll.php">
        <p class="submit"><input type="submit" name="commit" value="Reroll"></p>
      </form>
    </div>
  </section>
  <br>
	  <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
  </div>
    </div>