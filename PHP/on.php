<?php
$online = mysqli_query($db,"SELECT * FROM Online");
$on=mysqli_num_rows($online);
echo "<footer class='Apat'>Online: <a class='font' href='us_on.php'><b>$on</b></a><br>
2014 by Paulius Ruplys</footer>"
?>