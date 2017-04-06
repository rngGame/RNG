<?php
session_start();
ob_start();
?>

<?php

include_once 'PHP/db.php';

$User = $_SESSION["User"];

$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$row = mysqli_fetch_assoc($ACC);




if (!$row) {
        echo 'MySQL Error: ' . mysqli_error();
        exit;
    }

echo $row["HP"];




?>