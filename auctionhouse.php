<?php
session_start();
ob_start();

include_once 'PHP/db.php';
$User = $_SESSION["User"];

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
<header>
World Of RNG
</header>
<body>


<?php

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

//check if creating listening
if (isset($_POST["HASH"])){
	$price = $_POST["price"];
	
	$TYPE = $_POST["TYPE"];
	$HASH = $_POST["HASH"];
	$listening = 1;}
	
//list item
if ($listening == 1){
	
	if ($price <= 0){
			header("location:sync.php");
			die();
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

	
	$order = "INSERT INTO Trade
	   (Hash, Seller, Price, ilvl, Worth, Type)
	  VALUES
	   ('$HASH', '$User', '$price', '$ITM[ilvl]', '$ITM[Worth]', '$TYPE')";
	$result = mysqli_query($db, $order);
	
	$sql="DELETE FROM Equiped where  HASH='$HASH'";
	mysqli_query($db,$sql);	
	

	
	header("location:sync.php");
	die();
}


echo "</div><br><b>Auction House:</b><table border='0' class='solid'>
<tr>
<td>Name</td>

</tr>";

echo "<tr>";
$List = mysqli_query($db,"SELECT * FROM Trade ORDER BY Worth DESC");
while ($List1 = mysqli_fetch_array($List)){	

if ($List1[5] == "WEP"){
$WEP = mysqli_query($db,"SELECT * FROM DropsWep where HASH = '$List1[0]' ");
$ITM = mysqli_fetch_assoc($WEP);


$eft = 1 + $eft;

if ($ITM["efstat"]<>0){
		if ($ITM["effect"] == "LL"){
	$effapras[$eft] = "Life Leach";
	}
		if ($ITM["effect"] == "BL"){
	$effapras[$eft] = "Bleed Chanse";
	}
		if ($ITM["effect"] == "BR"){
	$effapras[$eft] = "Burn Chanse";
	}
		if ($ITM["effect"] == "FR"){
	$effapras[$eft] = "Freez Chanse";
	}
		if ($ITM["effect"] == "ST"){
	$effapras[$eft] = "Stun Chanse";
	}
		if ($ITM["effect"] == "SH"){
	$effapras[$eft] = "Shock Chanse";
	}
		if ($ITM["effect"] == "BK"){
	$effapras[$eft] = "Block Chanse";
	}
		if ($ITM["effect"] == "SM"){
	$effapras[$eft] = "Summon increase";
	}
		if ($ITM["effect"] == "PS"){
	$effapras[$eft] = "Poision increase";
	}
		if ($ITM["effect"] == "CF"){
	$effapras[$eft] = "Confusion chanse";
	}
		if ($ITM["effect"] == "CS"){
	$effapras[$eft] = "Cursed Soul";
	}
		if ($ITM["effect"] == "HT"){
	$effapras[$eft] = "Health per turn";
	}	
		if ($ITM["effect"] == "WK"){
	$effapras[$eft] = "Weaken monster";
	}	
	
	$efto[$eft] = "$effapras[$eft] $ITM[efstat] %<br>";}

if ($ITM["skill"] <> 0){
	$sklu[$eft] = "Has Skill!<br>";}
	
		
		$List1[2] = $List1[2] + ($List1[2] * 2 / 100);
		
echo "<td>";	
echo "<div class='tooltip'><img src='IMG/pack/Icon.4_79.png' width='45px' height='45px' class='item".$ITM['Rarity']."'><span class='tooltiptext'><b $unEf[$eft] class='$ITM[Rarity]'>$ITM[Name] + $ITM[plus]</b>Lvl:$ITM[ilvl] <br>P. dmg:$ITM[pmin] ~ $ITM[pmax]<br>M. dmg:$ITM[mmin] ~ $ITM[mmax]<br>Cryt chanse: $ITM[cryt]<br>Hit Chanse: $ITM[HitChanse]<br>$efto[$eft] $sklu[$eft]</span></div><br>";
 
echo "<div class='submit'><td     display: inline-flex;>
Price: $List1[2]g.
	      <form method='post' class='inventor' action='buy.php'>
          <input style='display:none' type='submit' name='Buy' value='$ITM[HASH]' placeholder='lvl'>
        <a class='submit' onclick='myfunc(this)'><button class='showButon' type='submit' name='Buy' value='$ITM[HASH]'><div class='tooltip'>Buy<span class='tooltiptext'> Seller - $List1[1].</span></div></button>
        </a>
      </form>";
	  if ($User == $List1[1]){
		    echo " <form method='post' class='inventor' action='buy.php'>
        <a class='submit'><button type='submit' class='showButon' name='Remove' value='$ITM[HASH]' onclick='myfunc(this)'><div class='tooltip'>Remove</div></button>
        </a>
      </form>";}

echo "</div></td></td></tr>";
}
if ($List1[5] == "ARM"){
$WEP = mysqli_query($db,"SELECT * FROM DropsArm where HASH = '$List1[0]' ");
$ITM = mysqli_fetch_assoc($WEP);

$List1[2] = $List1[2] + ($List1[2] * 2 / 100);

if ($ITM["Part"] == "BODY"){
$icon = "IMG/pack/Icon.5_67.png";
}
if ($ITM["Part"] == "GLOVES"){
$icon = "IMG/pack/Icon.2_24.png";
}
if ($ITM["Part"] == "LEGS"){
$icon = "IMG/pack/Icon.3_84.png";
}
	
	if ($ITM["effect"] == "HP"){
		$eftchk[$eft] = "Bonus HP: $ITM[efstat]<br>";
	}
	if ($ITM["effect"] == "EN"){
		$eftchk[$eft] = "Helth per turn $ITM[efstat]<br>";
	}
	if ($ITM["effect"] == "HL"){
		$eftchk[$eft] = "Helth per turn $ITM[efstat]<br>";
	}
	if ($ITM["effect"] == "NO"){
		$eftchk[$eft] = "Chanse not die: $ITM[efstat] %<br>";
	}
	if ($ITM["effect"] == "TR"){
		$eftchk[$eft] = "Thorns Damage: $ITM[efstat]<br>";
	}
	if ($ITM["effect"] == "ES"){
		$eftchk[$eft] = "Energie Shield: $ITM[efstat]<br>";
	}
	if ($ITM["effect"] == ""){
		$eftchk[$eft] ="";
	}
		
echo "<td>";	
echo "<div class='tooltip'><img src='$icon' width='45px' height='45px' class='item".$ITM['Rarity']."'><span class='tooltiptext'><b class='$ITM[Rarty]'>$ITM[Name]</b>Lvl: $ITM[ilvl]<br>P.def - $ITM[pDEF]<br>M.def - $ITM[mDEF]<br>Apsorb: $ITM[Apsorb]%<br>$eftchk[$eft] Enchant +$ITM[plus]<br></span></div><br>";
 
echo "<div class='submit'><td     display: inline-flex;>
Price: $List1[2]g.
	      <form method='post' class='inventor' action='buy.php'>
          <input style='display:none' type='submit' name='Buy' value='$ITM[HASH]' placeholder='lvl'>
        <a class='submit' onclick='myfunc(this)'><button class='showButon' type='submit' name='Buy' value='$ITM[HASH]'><div class='tooltip'>Buy<span class='tooltiptext'> Seller - $List1[1].</span></div></button>
        </a>
      </form>";
	  if ($User == $List1[1]){
		    echo " <form method='post' class='inventor' action='buy.php'>
        <a class='submit'><button type='submit' class='showButon' name='Remove' value='$ITM[HASH]' onclick='myfunc(this)'><div class='tooltip'>Remove</div></button>
        </a>
      </form>";}

echo "</div></td></td></tr>";

}
if ($List1[5] == "ACS"){
$WEP = mysqli_query($db,"SELECT * FROM DropsAcs where HASH = '$List1[0]' ");
$ITM = mysqli_fetch_assoc($WEP);
$List1[2] = $List1[2] + ($List1[2] * 2 / 100);

if ($ITM["Part"] == "RING"){
$icon = "IMG/pack/Icon.6_75.png";
}
if ($ITM["Part"] == "AMUL"){
$icon = "IMG/pack/Icon.6_53.png";
}
		
echo "<td>";	
echo "<div class='tooltip'><img src='$icon' width='45px' height='45px' class='item".$ITM['Rarity']."'><span class='tooltiptext'><b class='$ITM[Rarty]'>$ITM[Name]</b>Lvl: $ITM[ilvl]<br>Apsorb: $ITM[Apsorb]%<br>HP Bonus:  $ITM[hpBonus]%<br>XP Bonus: $ITM[xpBonus]%<br>Dmg. Bonus: $ITM[dmgBonus]%<br>Enchant +$ITM[plus]<br></span></div><br>";
 
echo "<div class='submit'><td     display: inline-flex;>
Price: $List1[2]g.
	      <form method='post' class='inventor' action='buy.php'>
          <input style='display:none' type='submit' name='Buy' value='$ITM[HASH]' placeholder='lvl'>
        <a class='submit' onclick='myfunc(this)'><button class='showButon' type='submit' name='Buy' value='$ITM[HASH]'><div class='tooltip'>Buy<span class='tooltiptext'> Seller - $List1[1].</span></div></button>
        </a>
      </form>";
	  if ($User == $List1[1]){
		    echo " <form method='post' class='inventor' action='buy.php'>
        <a class='submit'><button type='submit' class='showButon' name='Remove' value='$ITM[HASH]' onclick='myfunc(this)'><div class='tooltip'>Remove</div></button>
        </a>
      </form>";}

echo "</div></td></td></tr>";
}
} //while end
?>
</table>
<br><br><br><br><br>
<div class="floating">
  <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
  </div>
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