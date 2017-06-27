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
$Account = $_SESSION["Account"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);




echo"
<form action='sett.php'>
<p>
Select game theme
<select name='formTheme'>
  <option value=''>Select...</option>
  <option value='LIG'>Light</option>
  <option value='DAR'>Dark</option>
</select>
</p><input type='submit' value='Save'></form>";


$results = mysqli_query($db,"SELECT * FROM characters WHERE Account = '$Account'"); //character check
$countCH = mysqli_num_rows($results);


if($countCH >= 2){
	echo"
<form action='sett.php'>
<p>
Delete character:
<select name='formDelete'>
  <option value=''>Select...</option>";
  
  $chars = mysqli_query($db,"SELECT * FROM characters where Account = '$Account'");
while ($Chars = mysqli_fetch_array($chars)){
	if ($Chars[1] == 1 or  $Chars[1] == 2 ){}
	else{
		if ($Chars[0] == "$User"){}
		else{
echo"<option value='$Chars[0]'>$Chars[0]</option>";}
	}
}


echo"</select>
</p><input type='submit' value='Delete'></form>";
}



//admin stuff
/*	
echo "<div class='ADMIN'>";
	
echo "Weapon create:<br>";
echo "<table><td>";
	
echo "<tr><th>Prefix:</th><th>Base:</th><th>Subfix 1:</th><th>Subfix 2:</th><th>Rarity:</th><th>Plus:</th><th>Skill:</th></tr><tr>";
	
echo "<td><select>";
$base = mysqli_query($db,"SELECT * FROM prefixwep");
while ($base2 = mysqli_fetch_array($base)){
	echo "<option value='$base2[0]''>$base2[1]</option>";
}
	
echo "<td><select>";
$base = mysqli_query($db,"SELECT * FROM basewep");
while ($base2 = mysqli_fetch_array($base)){
	echo "<option value='$base2[0]''>$base2[1]</option>";
}
	
echo "</select></td>";
	
echo "<td><select>";
$base = mysqli_query($db,"SELECT * FROM subfixwep");
while ($base2 = mysqli_fetch_array($base)){
	echo "<option value='$base2[0]''>$base2[1]</option>";
}
	
echo "</select></td>";
	
echo "<td><select>";
$base = mysqli_query($db,"SELECT * FROM subfixwep");
while ($base2 = mysqli_fetch_array($base)){
	echo "<option value='$base2[0]''>$base2[1]</option>";
}
	
echo "</select></td>";
echo "<td><select>";
$base = mysqli_query($db,"SELECT * FROM types");
while ($base2 = mysqli_fetch_array($base)){
	echo "<option value='$base2[0]''>$base2[1]</option>";
}
	
echo "</select></td>";
	
echo "<td><select>";	
$base = mysqli_query($db,"SELECT * FROM enchantdrop");
while ($base2 = mysqli_fetch_array($base)){
	echo "<option value='$base2[0]''>$base2[0]</option>";}
echo "</select></td>";
	
echo "<td><select>";	
$base = mysqli_query($db,"SELECT * FROM iskills");
while ($base2 = mysqli_fetch_array($base)){
	echo "<option value='$base2[0]''>$base2[1]</option>";}
echo "</select></td>";
	
echo "</tr></table>";	
	
echo "</div>";
	
	*/
	
	
	
	
    ?>

	  <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>
  </div>
    </div>