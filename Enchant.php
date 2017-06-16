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
include_once 'PHP/db.php';

$User = $_SESSION["User"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);


if (isset($_POST["HASH"])){
$HASH = $_POST["HASH"];
$TYPE = $_POST["TYPE"];
$_SESSION["HASH"] = $HASH;
$_SESSION["TYPE"] = $TYPE;}

$HASH = $_SESSION["HASH"];
$TYPE = $_SESSION["TYPE"];

//stuff for enchant dust
if (isset($_SESSION["ENCt"])){

$ts1 = array("WEP", "SKL", "ARM", "ACS");
$ts2 = array_rand($ts1,1);
$TYPE = $ts1[$ts2];

$HASH == "";

$l = 1;

while ($HASH == "" and $l <> 100){
	
	$l += 1;

if ($TYPE == "WEP"){
	$HASH = $_SESSION["CURRENTWHASH"];
}
if ($TYPE == "SKL"){
	$HASH = $_SESSION["CURRENTSKLHASH"];
}
if ($TYPE == "ARM"){
	$so = rand (1,3);
	if ($so == 1){
		$HASH = $_SESSION["CURRENTARMBODY"];
	}
	if ($so == 2){
		$HASH = $_SESSION["CURRENTARMGLOVES"];
	}
	if ($so == 3){
		$HASH = $_SESSION["CURRENTARMBOOTS"];
	}
}
if ($TYPE == "ACS"){
	$so = rand (1,2);
	if ($so == 1){
		$HASH = $_SESSION["CURRENTACSRING"];
	}
	if ($so == 2){
		$HASH = $_SESSION["CURRENTACSAMULET"];
	}
}
}

$_SESSION["HASH"] = $HASH;
$_SESSION["TYPE"] = $TYPE;

}

if ($TYPE == "WEP"){
$WEP = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$HASH' ");
$ITM = mysqli_fetch_assoc($WEP);
}
if ($TYPE == "ARM"){
$WEP = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$HASH' ");
$ITM = mysqli_fetch_assoc($WEP);
}
if ($TYPE == "ACS"){
$WEP = mysqli_query($db,"SELECT * FROM DropsAcs where HASH = '$HASH' ");
$ITM = mysqli_fetch_assoc($WEP);
}
if ($TYPE == "SKL"){
$WEP = mysqli_query($db,"SELECT * FROM DropsSkl where HASH = '$HASH' ");
$ITM = mysqli_fetch_assoc($WEP);
}

$wenc = $ITM["plus"];
$ilvl = $ITM["ilvl"];


$ENC = mysqli_query($db,"SELECT * FROM enchantdrop where Enchant = '$wenc' ");
$ENC = mysqli_fetch_row($ENC);

$wenc2 = $ENC[0] +1;

$IDM = mysqli_query($db,"SELECT EXISTS(SELECT * FROM enchantdrop WHERE Enchant = '$wenc2')");
$IDM = mysqli_fetch_row($IDM);
if ($IDM[0] ==1){
}
else{
	echo" <div id='fightNewBut'>
	<section class='actionButtons2'>
	      <form method='post' action='sync.php'> 
        <p class='submit'><input type='submit' name='commit' value='Max Upgrade (Back)'></p>
      </form>
  </section></div>";
	exit;
}


$ENC2 = mysqli_query($db,"SELECT * FROM enchantdrop where Enchant = '$wenc2' ");
$ENC2 = mysqli_fetch_row($ENC2);

$bonuss = $ITM["ilvl"] * $ENC2[1];
$bonuss = round($bonuss,0);

echo "Item: $ITM[Name]<br>";
echo "Current plus - <b style='color:red'>$ITM[plus]</b><br>";
echo "Chanse: $ENC2[1] %";

$price = $ITM["ilvl"] * $ENC2[2];
 $_SESSION["Price"]= $price;
 $_SESSION["Name"]= $ENC2[0];
 $_SESSION["Bonus"]= $ENC2[2];
 $_SESSION["Chanse"]= $ENC2[1];	
 
 if (isset($_SESSION["ENCt"])){
	header("location:Enchant2.php");
	die(); 
 }
 

 echo" <div id='fightNewBut'>
 	<section class='actionButtons2'>
	      <form method='post' action='Bypass2.php'> 
        <p class='submit'><input type='submit' name='commit' value='Upgrade for $price g.'></p>
      </form>
  	</section>";
	
echo "</div>";	
	
    echo "<br><br><br><div id='mini2'>Items:";
  
//ITEMS
echo "<section class='container2'>";

$List = mysqli_query($db,"SELECT * FROM Equiped WHERE User = '$User' AND Part = 'ITM'");
while ($List1 = mysqli_fetch_array($List)){	

	$ITMs = mysqli_query($db,"SELECT * FROM DropsItm WHERE HASH = '$List1[2]'");
	$ITMn = mysqli_fetch_assoc($ITMs);
	
	
	if ($ITMn["EFT"] == "COR"){
echo "
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='Enchant2.php'>
		  <input type='hidden' name='COR' value='1'>
          <input type='hidden' name='ITM' value='$ITMn[HASH]'>
        <p class='submit' onclick='myfunc(this)'><input  img src='IMG/pack/$ITMn[Icon].png' style='width:45px;height:45px;' type='image' name='commit' value='(30)DMG Skill'><span class='tooltiptext'>$ITMn[Name]<br>Can only use once/item</span></p> 
      </form>
    </div>&nbsp;&nbsp;";
	}

}

  
  echo "</div>";


  mysqli_close($db);
    ?>
	  <section class="actionButtons2">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
  </section>
	</div>