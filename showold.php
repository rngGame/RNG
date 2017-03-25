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



$BOS = mysqli_query($db,"SELECT * FROM wboss ORDER BY ID DESC LIMIT 1 ");
$BOS = mysqli_fetch_row($BOS);
$HIS = $BOS[0] -1;
$BOS2 = mysqli_query($db,"SELECT * FROM wboss where ID = '$HIS'");
$BOS2 = mysqli_fetch_row($BOS2);

$a = 0;
$top = array();
$top[0] = "No Info";

echo "$BOS2[1] were killed by $BOS2[6]<br><br>";
echo "Damage delt:<br>";
$List = mysqli_query($db,"SELECT * FROM dboss where MonsID = '$HIS' order by DMG desc ");
$listC = mysqli_query($db,"SELECT * FROM dboss where MonsID = '$HIS'");
$list2 = mysqli_fetch_row($listC);
if ($list2[0] !== 0){
	
while ($List1 = mysqli_fetch_array($List)){
	$top[$a] = $List1[1];
	$a = $a +1;
echo "<b>$List1[1]</b> - $List1[2] dmg.<br>";}
echo "<br>Most damage delt by - $top[0]<br>";
}
else {
	echo "No Info";}

$WEP = mysqli_query($db,"SELECT * FROM drops where HASH = '$BOS2[5]' ");
$WEP = mysqli_fetch_row($WEP);


echo "<br>Droped: ";
if (!$WEP[2] == ""){
	echo "<b style='color:#$WEP[5]'>$WEP[1] ($WEP[2])</b>";}
	else{
		echo "$WEP[1]";}



?>
  <section class="container3">
    <div class="31-50">
	      <form method="post" action="sync.php">
        <p class="submit"><input type="submit" name="commit" value="Back"></p>
      </form>
    </div>
  </section>