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
	$hash = $_POST["HASH"];
	$listening = 1;}
	
//list item
if ($listening == 1){
	
	if ($price <= 0){
			header("location:sync.php");
			die();
	}
	
	$order = "INSERT INTO Trade
	   (Hash, Seller, Price)
	  VALUES
	   ('$hash', '$User', '$price')";
	$result = mysqli_query($db, $order);
	
	$sql="DELETE FROM inventor WHERE hash='$hash'";
	mysqli_query($db,$sql);	
	

	
	header("location:sync.php");
	die();
}


echo "</div><br><b>Auction House:</b><table border='0' class='solid'>
<tr>
<td>Name</td>

</tr>";

echo "<tr>";
$List = mysqli_query($db,"SELECT * FROM Trade");
while ($List1 = mysqli_fetch_array($List)){	

$WEPI = mysqli_query($db,"SELECT * FROM weapondrops where HASH = '$List1[0]' ");
$WEPI = mysqli_fetch_row($WEPI);

$eft = 1 + $eft;

if ($WEPI[14]<>0){
		if ($WEPI[13] == "LL"){
	$efftype[$eft] = "Life Leach";
	}
		if ($WEPI[13] == "BL"){
	$efftype[$eft] = "Bleed Chanse";
	}
		if ($WEPI[13] == "BR"){
	$efftype[$eft] = "Burn Chanse";
	}
		if ($WEPI[13] == "FR"){
	$efftype[$eft] = "Freez Chanse";
	}
		if ($WEPI[13] == "ST"){
	$efftype[$eft] = "Stun Chanse";
	}
			if ($WEPI[13] == "SH"){
	$efftype = "Shock Chanse";
	}
		if ($WEPI[13] == "BK"){
	$efftype = "Block Chanse";
	}
	$efto[$eft] = "$efftype[$eft] $WEPI[14] %<br>";}

if ($WEPI[12] <> 0){
	$sklu[$eft] = "Has Skill!<br>";}
	
	if ($WEPI[3] == "ff6633"){
		$unEf[$eft] = "class='awesome'";}
		
		$List1[2] = $List1[2] + ($List1[2] * 2 / 100);
		
echo "<td>";	
echo "<div class='tooltip'><b $unEf[$eft] class='$WEPI[3]'>$WEPI[1] + $WEPI[15]</b><span class='tooltiptext'>Lvl:$WEPI[4] <br>P. dmg:$WEPI[5] ~ $WEPI[6]<br>M. dmg:$WEPI[9] ~ $WEPI[10]<br>Cryt chanse: $WEPI[7]<br>Hit Chanse: $WEPI[11]<br>$efto[$eft] $sklu[$eft]</span></div><br>";
 
echo "<div class='submit'><td     display: inline-flex;>
Price: $List1[2]g.
	      <form method='post' class='inventor' action='buy.php'>
          <input style='display:none' type='submit' name='Buy' value='$WEPI[0]' placeholder='lvl'>
        <a class='submit' onclick='myfunc(this)'><button class='showButon' type='submit' name='Buy' value='$WEPI[0]'><div class='tooltip'>Buy<span class='tooltiptext'> Seller - $List1[1].</span></div></button>
        </a>
      </form>";
	  if ($User == $List1[1]){
		    echo " <form method='post' class='inventor' action='buy.php'>
        <a class='submit'><button type='submit' class='showButon' name='Remove' value='$WEPI[0]' onclick='myfunc(this)'><div class='tooltip'>Remove</div></button>
        </a>
      </form>";}

echo "</div></td></td></tr>";}

?>
</table>
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