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

$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$ACC[10]' ");
$CLS = mysqli_fetch_row($CLS);

//check for class
if ($ACC[3] > 19 and $ACC[10] == 0){ 
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
}

//for subclass select
if ($ACC[3] > 39 and $ACC[10] <> 0 and $ACC[10] < 11 ){ 
echo "Select Your Class:<br>";

$List2 = mysqli_query($db,"SELECT * FROM Subclass where Prev = '$ACC[10]' ");
while ($List3 = mysqli_fetch_array($List2)){
if ($List3[0] == 0){
		}
	else{
echo "<br>$List3[8]:";
echo "<form method='post' action='Class2.php'>
          <input hidden='' type='text' name='cls' value='$List3[0]' placeholder='cls'>
        <p class='submit'><input type='submit' name='commit' value='$List3[1]'> 
      </form><hr>	"
	  ;
	  ;}
}
    mysqli_close($db);
}

?>