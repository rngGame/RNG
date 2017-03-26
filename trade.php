<?php
echo "Marketplace"
include_once 'PHP/db.php';
include_once 'PHP/function.php';
//if($_GET["trade"]=="ashes"){
	echo '<form method="get" action="trade.php">
	        <p class="submit">
	          <input type="submit" name="trade" value="magic">
	          <input type="submit" name="trade" value="physical">
	          <input type="submit" name="trade" value="price">
	          <input type="submit" name="trade" value="level">'
//}

//$trades = mysqli_query($db,"SELECT * FROM trades");
echo $_GET["trade"];