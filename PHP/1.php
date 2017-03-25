
<?php
if ($_SESSION['Online'] == 1){
	echo "<li><a href='profile.php'>Profilis</a></li>";
	echo"<li><a href='sar.php'>Sarašas</a></li>";
	echo"<li><a href='file.php'>Siūntimai</a></li>";
	echo"<li><a href='upload.php'>Ikelti faila</a></li>";
	if ($_SESSION['Admin']==1){
		echo"<li><a href='Admin.php'>Admin</a></li>";}
}
else{
	echo "<li><a href='reg.php'>Registruotis</a></li>";
}
?>