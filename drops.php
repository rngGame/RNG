<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Drops</title>
</head>

<body>
<?php
include_once 'PHP/db.php';
$Nmbr = mysqli_query($db,"SELECT Count(ID) FROM drops");
$Nmbr = mysqli_fetch_array($Nmbr);
echo "Total Number of Drops: ";
echo ("<b>$Nmbr[0]</b>");
echo "<br>";
echo "<br>";
?>

<table border="1">
<tr>
<td>Item LVL</td>
<td>Dmg</td>
<td>Name</td>
</tr>

<?php

echo "<tr>";
$List = mysqli_query($db,"SELECT * FROM drops order by dmg desc ");
while ($List1 = mysqli_fetch_array($List)){	
echo "<td>";
echo "$List1[3]</td><td>";
echo "$List1[4]</td><td>";
if (!$List1[2] == ""){
	echo "<b style='color:#$List1[5]'>$List1[1] </b>";}
	else{
		echo "$List1[1]";}
echo "<br></td></tr>";}
?>
</table>
</body>
</html>