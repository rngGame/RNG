
<?php
error_reporting(0);
if ($_SESSION['Online'] == 1){
	
	$var = $_SESSION['Vardas'];
	$pav = $_SESSION['Pavarde'];
	$vp = $_SESSION['Vardas']." ".$_SESSION['Pavarde'];
	$IPA = $_SERVER['REMOTE_ADDR'];
	
		$onch ="INSERT INTO Online (User, IP) VALUES ('$vp', '$IPA') ON DUPLICATE KEY UPDATE User='$vp', IP='$IPA'";
$result = mysqli_query($db, $onch);


	echo ("<div id='login1'>Vartotojas -  <b>$var $pav</b></div>");
	echo ("<div id='login2'><a href=end.php>Atsijungti</a></div>");}
	else {
		include_once 'login.php';}
?>