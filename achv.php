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
$Account = $_SESSION["Account"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);


$MOD = mysqli_query($db,"SELECT * FROM modlist where User = '$User' ");
$MOD = mysqli_fetch_row($MOD);

//make "seen"
$Lists = mysqli_query($db,"SELECT * FROM Achievments where User = '$Account' and Seen is null ");
while ($ListA = mysqli_fetch_array($Lists)){	
	
	$order1 = "UPDATE Achievments
	SET Seen = '1'
	WHERE `USER` = '$Account' and Seen is null";   

	$result = mysqli_query($db, $order1);

}


$List = mysqli_query($db,"SELECT * FROM Achievments where User = '$Account' ");
while ($List1 = mysqli_fetch_array($List)){	
echo "  <form method='post' action='chng.php'>$List1[1] - $List1[2] - 
          <input style='display:none' type='submit' name='change' value='$List1[2]' placeholder='title'>
        <a class='submit'><button type='submit' name='change' value='$List1[2]'>Use it.</button> 
        </a> </form><br>";
		



;}





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