<?php
$maxv = mysqli_query($db,"SELECT MAX(ID) FROM Votes");
$maxrow = mysqli_fetch_row($maxv);
$votenr = $maxrow[0];
$vote = mysqli_query($db,"SELECT * FROM Votes WHERE ID = '$votenr'");
$voterow = mysqli_fetch_row($vote);

$kl = '0';
$kll = '3';
$ats = '4';
$vt = '1';

$viso = ($voterow[4] + $voterow[6] + $voterow[8] + $voterow[10] + $voterow[12]);


?>