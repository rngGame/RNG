<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

include_once 'PHP/db.php';

$datemin = strtotime(date_create()->format('Y-m-d'));
$Event = mysqli_query($db,"SELECT * FROM Events order by Nr DESC LIMIT 1");
$Event = mysqli_fetch_row($Event);
$datemin2 = strtotime(date($Event[4]));
if ($datemin2 > $datemin){
	$Chat = "<b><font size='2' color='red'><center>EVENT! - $Event[1]</center></font></b>";
}

$Chat = "<hr>";

$i = 1;

$datetime = strtotime(date_create()->format('Y-m-d H:i:s'));

$List = mysqli_query($db,"SELECT * FROM Chat order by Date desc ");
while ( $TEXT = mysqli_fetch_array($List) and $i != 9	){
	$datetime2 = strtotime(date($TEXT[1]));
	$datetime3 = $datetime -$datetime2;
$typ = "sek.";
if ($datetime3 > 60){
	$typ = "min.";
$datetime3 = $datetime3 / 60;}
if ($datetime3 > 60 and $typ == "min." ){
	$typ = "h.";
$datetime3 = $datetime3 / 60;}
if ($datetime3 > 24 and $typ == "h."){
	$typ = "d.";
$datetime3 = $datetime3 / 24;}
if ($datetime3 > 365 and $typ == "d."){
	$typ = "y.";
$datetime3 = $datetime3 / 365;}

$datetime3 = round($datetime3,0);

$USR = mysqli_query($db,"SELECT * FROM characters where user = '$TEXT[0]' ");
$USR = mysqli_fetch_row($USR);
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$USR[10]' ");
$CLS = mysqli_fetch_row($CLS);


if ($i % 2 == 0) {
	$Chat = "$Chat <div id='chatbox'><div class='tooltip'><font color='$USR[12]'><b>$TEXT[0]:<span class='tooltiptext'><img src='IMG/av/$CLS[10].jpg' style='width:50px;height:50px;'><br>$USR[13]</span></div> </b></font>$TEXT[2] <font size='1'> <br>$datetime3 $typ ago.</font></div> ";
	}
	else{
		$Chat = "$Chat <div id='chatbox2'><div class='tooltip'><font color='$USR[12]'><b>$TEXT[0]:<span class='tooltiptext'><img src='IMG/av/$CLS[10].jpg' style='width:50px;height:50px;'><br>$USR[13]</span></div> </b></font>$TEXT[2] <font size='1'> <br>$datetime3 $typ ago.</font></div> ";
	}
	$i++;
}



echo "data: $Chat \n\n";
flush();

?>