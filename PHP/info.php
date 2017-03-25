<?php
// Klientu kiekis
$kiekis = mysqli_query($db,"SELECT * FROM klientai");
$kiek=mysqli_num_rows($kiekis);
//

// Siuntimu Kiekis
$kiekis2 = mysqli_query($db,"SELECT * FROM download");
$kiek2=mysqli_num_rows($kiekis2);
//

// Žinučių Kiekis
$kiekis3 = mysqli_query($db,"SELECT * FROM Chat");
$kiek3=mysqli_num_rows($kiekis3);
//

//Failu nuskaitimas
$dir = ($_SERVER['DOCUMENT_ROOT'].'/failai/');
$fil = scandir($dir);
$filc = count($fil) - '2';
//

//Leidžamu naujienu kiekis
$result = mysqli_query($db,"SELECT MAX(Nr) FROM Info");
$row = mysqli_fetch_row($result);
$maxn = $row[0];
$r = '0';
//

//Chatas
$result7 = mysqli_query($db,"SELECT MAX(Nmr) FROM Chat");
$chatx = mysqli_fetch_row($result7);
$maFn = $chatx[0];
$f = '0';
//


?>