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


echo "Select Your Class:<br>";

$List = mysqli_query($db,"SELECT * FROM class order by ID asc ");
while ($List1 = mysqli_fetch_array($List)){
	if ($List1[0] == 0){
		}
	else{
echo "<br>$List1[9]:";
echo "<form method='post' action='Class2.php'>
          <input hidden='' type='text' name='cls' value='$List1[0]' placeholder='cls'>
        <p class='submit'><input type='submit' name='commit' value='$List1[1]'> 
      </form><hr>	"
	  ;
	  ;}
}
    mysqli_close($db);

?>