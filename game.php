<?php
session_start();
ob_start();

include_once 'PHP/db.php';
$User = $_SESSION["User"];

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
<header>
<?php


if ($User == ""){
	header("location:index.php");}


$ACC = mysqli_query($db,"SELECT * FROM characters where user = '$User' ");
$ACC = mysqli_fetch_row($ACC);

$PAS = mysqli_query($db,"SELECT * FROM passive where USER = '$User' ");
$PAS = mysqli_fetch_row($PAS);

$MOD = mysqli_query($db,"SELECT * FROM modlist where User = '$User' ");
$MOD = mysqli_fetch_row($MOD);

$GEM = mysqli_query($db,"SELECT * FROM Gems where HASH = '$ACC[14]' ");
$GEM = mysqli_fetch_row($GEM);

if ($MOD[0] == ""){
	echo "";
	}
else {
	$MODN = array();
	$MODE = array();
	$MODT = array();
	$modc = 1;
	$mc = 1;
	while ($modc <= 4){
		$MDC = mysqli_query($db,"SELECT * FROM mods where ID = '$MOD[$mc]' ");
		$MDC = mysqli_fetch_row($MDC);	
		if ($MDC[1] != ""){
			$MODN[$mc] = $MDC[1];
			$MODT[$mc] = $MDC[2];
			$MODE[$mc] = $MOD[$mc+1];	
			$mc = $mc + 2;
			$modc = $modc + 1;		
		}
		else{
			$modc = 5;
		}	
}
}

$pasl1 = $PAS[3] + 1;
$pasl2 = $PAS[6] + 1;
$pasl3 = $PAS[9] + 1;
$pasl4 = $PAS[12] + 1;

$PAS2 = mysqli_query($db,"SELECT * FROM skillxp where LVL = '$pasl1' ");
$plvl1 = mysqli_fetch_row($PAS2);
$PAS2 = mysqli_query($db,"SELECT * FROM skillxp where LVL = '$pasl2' ");
$plvl2 = mysqli_fetch_row($PAS2);
$PAS2 = mysqli_query($db,"SELECT * FROM skillxp where LVL = '$pasl3' ");
$plvl3 = mysqli_fetch_row($PAS2);
$PAS2 = mysqli_query($db,"SELECT * FROM skillxp where LVL = '$pasl4' ");
$plvl4 = mysqli_fetch_row($PAS2);

//classes and subclasses
if ($ACC[10] < 10){
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$ACC[10]' ");
$CLS = mysqli_fetch_row($CLS);
}
if ($ACC[10] > 10){
$SUB = mysqli_query($db,"SELECT * FROM Subclass where ID = '$ACC[10]' ");
$SUB = mysqli_fetch_row($SUB);
$CLS = mysqli_query($db,"SELECT * FROM class where ID = '$SUB[2]' ");
$CLS = mysqli_fetch_row($CLS);

//change from class ->> subclass
$CLS[1] = $SUB[1];
$CLS[9] = $SUB[8];

if ($SUB[3] == "HP"){
	$hpsub = $SUB[4];
	}
if ($SUB[3] == "DMG"){
	$dmgsub = $SUB[4];
	}
if ($SUB[3] == "DEF"){
	$defsub = $SUB[4];
	}
if ($SUB[3] == "CRD"){
	$crdsub = $SUB[4];
	}
if ($SUB[3] == "CRC"){
	$crcsub = $SUB[4];
	}
if ($SUB[3] == "ENR"){
	$enrsub = $SUB[4];
	}

}

$WEP = mysqli_query($db,"SELECT * FROM weapondrops where HASH = '$ACC[1]' ");
$WEP = mysqli_fetch_row($WEP);


$datetime = date_create()->format('Y-m-d H:i:s');
$ONL2 = mysqli_query($db,"SELECT * FROM Online where Time>'$datetime'");
$ONL = mysqli_num_rows($ONL2);




while($users2=mysqli_fetch_array($ONL2)){
	$USR2 = mysqli_query($db,"SELECT * FROM characters where user = '$users2[0]' ");
	$USR2 = mysqli_fetch_row($USR2);
	$CLS2 = mysqli_query($db,"SELECT * FROM class where ID = '$USR2[10]' ");
	$CLS2 = mysqli_fetch_row($CLS2);
          	$UsersO = "<b>$UsersO  <font color='$USR2[12]'>$users2[0]</font> </b><br>";
         }
if ($ONL == 0){
	$onlineText = " <div class='tooltip'>1 Player Online<span class='tooltiptext'<font color='$ACC[12]'>>$User</font></span></div>";}
if ($ONL == 1){
	$onlineText = " <div class='tooltip'>$ONL Player Online<span class='tooltiptext'>$UsersO</span></div>";}
if ($ONL > 1){
	$onlineText = " <div class='tooltip'>$ONL Players Online<span class='tooltiptext'>$UsersO</span></div>";}

if ($WEP[12] == 0){
}
else{
	$Skil = mysqli_query($db,"SELECT * FROM iskills where ID = '$WEP[12]' ");
	$Skil = mysqli_fetch_row($Skil);
};

$PNT = mysqli_query($db,"SELECT * FROM Points where User = '$User' ");
$PNT = mysqli_fetch_row($PNT); //pasive points


if ($PNT[1] >= 1){
	$poinT = "<b><font color='red'>You have $PNT[1] unspend points!</font></b>";
	$pasiveBut = " <div class='newt'>       <div class='tooltip'>
	      <form method='post' id='yourFormId' action='point.php'>
          <input type='hidden' name='STAT' value='STR'>
        <input style='width:45px;height:25px;' type='submit' name='commit' value='STR'><span class='tooltiptext'>Increase STR by 1<br>Increase Physical damage and health.</span>
      </form>
    </div>&nbsp;&nbsp;
    <div class='tooltip'>
	      <form method='post' id='yourFormId' action='point.php'>
          <input type='hidden' name='STAT' value='INTE'>
        <input style='width:45px;height:25px;' type='submit' name='commit' value='INT'><span class='tooltiptext'>Increase INT by 1<br>Increase Magick and Energie.</span>
      </form>
    </div></div>&nbsp;&nbsp;
";
}



$ARM = mysqli_query($db,"SELECT * FROM drops where HASH = '$ACC[7]' ");
$ARM = mysqli_fetch_row($ARM);

$TAL = mysqli_query($db,"SELECT * FROM dropst where HASH = '$ACC[8]' ");
$TAL = mysqli_fetch_row($TAL);

$lvl2 = $ACC[3] + 1;

$XPL = mysqli_query($db,"SELECT * FROM levels where LVL = '$lvl2' ");
$XPL = mysqli_fetch_row($XPL);

$XPL2 = ($XPL[1] - $ACC[5]);
$XPL2 = round($XPL2);


$XPLc = mysqli_query($db,"SELECT EXISTS(SELECT * FROM levels WHERE LVL = '$lvl2')");
$XPLc = mysqli_fetch_row($XPLc);
if ($XPLc[0] ==1){
	$leveltext = "<font size='1'><progress value='$ACC[5]' max='$XPL[1]'></progress>(XP to next LVL: $XPL2)</font>";
}
else{
	$leveltext = "<font size='1'><progress value='100' max='100'></progress>(Max level)</font>";
}

?>
World Of RNG
</header>
<body>


<div id="settings">
 <section class="container">
 <p class="submit">
    	<form method="post" action="settings.php">
          <input type="submit" name="commit3" value="Settings">
     	 </form></p></section>
         </div>

<div id="refresh">
	<section class="container">
    <p class="submit">
    	<form method="post" action="log.php">
          <input type="submit" name="commit3" value="Logout">
     	 </form></p></section></div>
        
   
<div id="refresh2">
	<section class="container">
    <p class="submit">    
	      <form method="post" action="sync.php">
          <input type="submit" name="commit4" value="Refresh">
          </form></p>
          
          </form>

  </section>
      </div>
<div id="wrapper">
<div id="first">
<?php

$lwa = $ACC[3] + $WEP[4] + $ARM[3] +$TAL[2] + $PAS[3] + $PAS[6] + $PAS[9] + $PAS[12] + $MOD[9] +$GEM[4];

$order = "UPDATE characters
SET ILVL = '$lwa'
WHERE `User` = '$User'";

$result = mysqli_query($db, $order);

$HP = $ACC[2] * $CLS[2] + ($HP * ($PNT[2])/100);
$HP = $HP + ($HP * ($PNT[2])/100);
$armor = ($ARM[4] + $TAL[5])*$CLS[4];

//enchant
$ENC = mysqli_query($db,"SELECT * FROM enchantdrop WHERE Enchant = '$WEP[15]'");
$ENC = mysqli_fetch_row($ENC);

if ($ENC[2] <> 0){
	$enchtex = "<font color='#F59100'>Ench. power: <b>$ENC[2] %</b></font>";}

// physical dmg
$minPdmg = round(($WEP[5] + $TAL[3])*$CLS[3]);
$minPdmg = $minPdmg + ($minPdmg * $ENC[2] / 100) + ($minPdmg * ($PNT[2]*2)/100);
if (isset($dmgsub)){
	$minPdmg = round(($minPdmg*$dmgsub),0);
}
$maxPdmg = round(($WEP[6] + $TAL[3])*$CLS[3]);
$maxPdmg = $maxPdmg + ($maxPdmg * $ENC[2] / 100) + ($maxPdmg * ($PNT[2]*2)/100);
if (isset($dmgsub)){
	$maxPdmg = round(($maxPdmg*$dmgsub),0);
}

// magical dmg
$minMdmg = round(($WEP[9] + $TAL[3])*$CLS[3]);
$minMdmg = $minMdmg + ($minMdmg * $ENC[2] / 100) + ($minMdmg * ($PNT[3]*3)/100);
if (isset($dmgsub)){
	$minMdmg = round(($minMdmg*$dmgsub),0);
}
$maxMdmg = round(($WEP[10] + $TAL[3])*$CLS[3]);
$maxMdmg = $maxMdmg + ($maxMdmg * $ENC[2] / 100) + ($maxMdmg * ($PNT[3]*3)/100);
if (isset($dmgsub)){
	$maxMdmg = round(($maxMdmg*$dmgsub),0);
}


$HP2 = $HP + $TAL[4];

if ($WEP[12] == 0){
}
else{
	if ($Skil[2] == "DMG"){
		$dmg = $dmg + ($dmg*$Skil[3]/100);}
	if ($Skil[2] == "ARM"){
		$armor = $armor + ($armor*$Skil[4]/100);}
	if ($Skil[2] == "HP"){
		$HP2 = $HP2 + ($HP2*$Skil[5]/100);}
}

//$Speed = $ACC[16]+ $ACC[3];
//$Speed = $Speed + ($Speed * $GEM[5] /100);

if(isset($MODE[1])){

	$mc2 = 1;
	while (isset($MODE[$mc2])){

	if($MODT[$mc2] == "DMG"){
		$minPdmg = $minPdmg+($minPdmg*$MODE[$mc2]/100);
		$maxPdmg = $maxPdmg+($maxPdmg*$MODE[$mc2]/100);
		$minMdmg = $minMdmg+($minMdmg*$MODE[$mc2]/100);
		$maxMdmg = $maxMdmg+($maxMdmg*$MODE[$mc2]/100);
	}
	if($MODT[$mc2] == "DEF"){
		$armor = $armor+($armor*$MODE[$mc2]/100);
	}
	if($MODT[$mc2] == "CRT"){
		$PAS[2] = $PAS[2]+($PAS[2]*$MODE[$mc2]/100);
		$PAS[2] = round($PAS[2],0);
	}
	if($MODT[$mc2] == "CRD"){
		$PAS[11] = $PAS[11]+($PAS[11]*$MODE[$mc2]/100);
		$PAS[11] = round($PAS[11],0);
	}	
	if($MODT[$mc2] == "ENG"){
		$CLS[5] = $CLS[5]+($CLS[5]*$MODE[$mc2]/100);
		$CLS[5] = round($CLS[5],0);
	}
	if($MODT[$mc2] == "ENR"){
		$PAS[8] = $PAS[8]+($PAS[8]*$MODE[$mc2]/100);
		$PAS[8] = round($PAS[8],0);
	}
	if($MODT[$mc2] == "HP"){
		$HP2 = $HP2+($HP2*$MODE[$mc2]/100);
	}
	if($MODT[$mc2] == "XP"){
		$TAL[6] = $TAL[6]+($TAL[6]*$MODE[$mc2]/100);
		$TAL[6] = round($TAL[6],2);
		
	}
	//if($MODT[$mc2] == "SPD"){
		//$Speed = $Speed+($Speed*$MODE[$mc2]/100);
		
	//}
	if($MODT[$mc2] == "ABS"){
		$PAS[5] = $PAS[5]+($PAS[5]*$MODE[$mc2]/100);	
		$PAS[5] = round($PAS[5],0);
	}
	$mc2 = $mc2 + 2;
}
}

// average dmg
$avgP = round(($minPdmg + $maxPdmg) / 2);
$avgM = round(($minMdmg + $maxMdmg) / 2);
$avgD = round(($avgP + $avgM) / 2);


$datemin = strtotime(date_create()->format('Y-m-d'));

$Event = mysqli_query($db,"SELECT * FROM Events order by Nr DESC LIMIT 1");
$Event = mysqli_fetch_row($Event);
$datemin2 = strtotime(date($Event[4]));
if ($datemin2 > $datemin){
	
		if($Event[2] == "XP"){
		$TAL[6] = $TAL[6] * $Event[3];
		$TAL[6] = round($TAL[6],2);
		
	}
}



$HP = round(($HP),0);
if (isset($hpsub)){
	$HP = round(($HP*$hpsub),0);
}
$armor = round(($armor),0);
if (isset($defsub)){
	$armor = round(($armor*$defsub),0);
}
$dmg = round($dmg,0);
$HP2 = round($HP2,0);


//$Speed = round($Speed,0);


$_SESSION["HP"] = $HP2;
$_SESSION["GOLD"] = $ACC[4];
//$_SESSION["SPEED"] = $Speed;

//dmg
$_SESSION["DMGPmin"] = $minPdmg;
$_SESSION["DMGPmax"] = $maxPdmg;
$_SESSION["DMGMmin"] = $minMdmg;
$_SESSION["DMGMmax"] = $maxMdmg;
$_SESSION["DMGPAVE"] =  $avgP;
$_SESSION["DMGMAVE"] =  $avgM;
$_SESSION["DMGAVE"] =  $avgD;


$_SESSION["plvl"] = $ACC[3];
$_SESSION["ARM"] = $armor;
$_SESSION["XPT"] = $TAL[6];
$_SESSION["ENG"] = $CLS[5];
$_SESSION["CRYT"] = $PAS[2];
if (isset($crcsub)){
$_SESSION["CRYT"] = $PAS[2]*$crcsub;
}
$_SESSION["CRYTD"] = $PAS[11];
if (isset($crdsub)){
$_SESSION["CRYTD"] = 1+$PAS[11]*$crdsub;
}
$_SESSION["APS"] = $PAS[5];
$_SESSION["ENG2"] = $PAS[8];
$_SESSION["ILVL"] = $lwa;
$_SESSION["crytext"] = 0;
$_SESSION["crytext2"] = 0;

$ENR = ($ACC[3]*3)+$CLS[5];
$ENR = $ENR + ($ENR * ($PNT[3]*2)/100);
$enr= 5+(5*$PAS[8]/100);
$enr= $enr + ($enr * ($PNT[3]*1)/100);
$enr=round($enr,0);
$ENR=round(($ENR),0);
if (isset($enrsub)){
	$ENR=round(($ENR*$enrsub),0);
}

//energy
$_SESSION["ENERGY"] = $ENR;
$_SESSION["ENERGYM"] = $ENR;
$_SESSION["ENREGEN"] = $enr;

echo "User: <div class='tooltip'><font color='$ACC[12]'><b>$User</b><span class='tooltiptext'>$ACC[13]</span></div></font> $poinT";
echo "<br>Class: <b><div class='tooltip'>$CLS[1]<span class='tooltiptext'>$CLS[9]</span></div></b><br>";
echo "<img src='IMG/av/$CLS[10].jpg' style='width:50px;height:50px;'> $pasiveBut<br>";
echo "LVL: <b>$ACC[3]</b> $leveltext<br>";
echo "Average DMG: <b><font class='physical'>~$avgP</font>/<font class='magic'>~$avgM</font></b><br>";
echo "HP: <b><font class='health'>$HP2</font></b><br>";
echo "ENR: <b><font class='energy'>$ENR<font size='1'>($enr per turn)</font></font></b><br>";
echo "DEF: <b><font class='defense'>$armor</font></b><br>";
//echo "SPD: <b><font class='speed'>$Speed</font></b><br>";
echo "Gold: <b><font class='gold'>$ACC[4]</font></b><br>";
echo "Shards: <b><font class='shards'>$ACC[15]</font></b><br>";
echo "Item LVL: <b>$lwa</b><br>";
echo "Points: <font class='physical'>$PNT[2] STR</font> - <font class='magic'>$PNT[3] INT</font><br>";
echo "</div>";
echo "<div id='second'>Weapon: ";

if ($WEP[14]<>0){
		if ($WEP[13] == "LL"){
	$efftype = "Life Leach";
	}
		if ($WEP[13] == "BL"){
	$efftype = "Bleed Chanse";
	}
		if ($WEP[13] == "BR"){
	$efftype = "Burn Chanse";
	}
		if ($WEP[13] == "FR"){
	$efftype = "Freez Chanse";
	}
		if ($WEP[13] == "ST"){
	$efftype = "Stun Chanse";
	}
		if ($WEP[13] == "SH"){
	$efftype = "Shock Chanse";
	}
		if ($WEP[13] == "BK"){
	$efftype = "Block Chanse";
	}
	$eft = "$efftype $WEP[14] %<br>";}
	
	if ($WEP[3] == "ff6633"){
		$unEf = "class='awesome'";}

if (!$WEP[2] == ""){
	echo "<div class='tooltip'><b $unEf class='$WEP[3]'>$WEP[1] + $WEP[15] ($WEP[2])</b>";}
	else{
		echo "<div class='tooltip'>$WEP[1] + $WEP[15]";}
echo "<br><span class='tooltiptext'><b>$WEP[4] lvl.</b><br><a class='physical'><b>P.dmg: $WEP[5] ~ $WEP[6]</b><br><a class='magic'><b>M.dmg: $WEP[9] ~ $WEP[10]</b></a><br>Cryt chanse: $WEP[7]<br>Hit Chanse: $WEP[11]<br> $eft$enchtex</span></div><br><br>Armor: ";

if (!$ARM[2] == ""){
	echo "<div class='tooltip'><b class='$ARM[5]'>$ARM[1] ($ARM[2])</b>";}
	else{
		echo "<div class='tooltip'>$ARM[1]";}
echo "<br><span class='tooltiptext'><a class='defense'><b>$ARM[4]</b> def. </a><br><b>$ARM[3] lvl.</b></span></div><br><br>Talisman: ";

if (!$TAL[8] == ""){
	echo "<div class='tooltip'><b class='$TAL[9]'>$TAL[1] ($TAL[8])</b>";}
	else{
		echo "<div class='tooltip'>$TAL[1]";}
echo "<br><span class='tooltiptext'><a class='physical'><b>$TAL[3]</b> dmg.</a> <a class='defense'><b>$TAL[5]</b> def. </a><a class='health'><b>$TAL[4]</b> HP. </a><a class='experience'><b>$TAL[6]</b> XP. </a><br><b>$TAL[2] lvl.</b></span></div><br><br>Gem: ";

if (!$GEM[3] == ""){
	echo "<div class='tooltip'><b style='color:#$GEM[3]'>$GEM[0]</b>";}
	else{
		echo "<div class='tooltip'>$GEM[0]";}
echo "<br><span class='tooltiptext'><a class='$GEM[3]'><b>$GEM[2]</b> Type. <br></a><b>Power $GEM[5] %</b><br><b>$GEM[4] lvl.</b></span></div>";

echo "</div>";

echo "<div id='mini'>Totall Kills<br>";
echo "<b>$ACC[6]</b><br><br>";
echo "<b>PVP Rank:</b><br>";
echo "<b><font class='$ACC[12]'>$ACC[11]</font></b>";
echo "<section class='container'>
    <p class='submit'>
    	<form method='post' action='achv.php'>
          <input type='submit' name='commit3' value='Achievments'>
     	 </form></p></section>";
echo "$onlineText";
echo"</div>";

//echo "<div id='minievent'><iframe height='570px' width='300px' scrolling='no' src='chat.php'></iframe></div>";
echo "<div id='minievent'><div id='sidbar'>";
?>
<div id="result"></div>
<?
echo "</div>";
echo "<div id='minichat'><iframe height='100px' width='300px' src='message.php'></iframe></div>";

?>
</div>
<div id="wrapper2">
  <div id="Style1"><strong>Choose ILVL class to fight: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Meniu:</strong></div>
<div id="box1">
<section class="container1">
    <div class="1-10">
	      <form method="post" action="Bypass.php">
          <input hidden="" type="text" name="lvl" value="10" placeholder="lvl">
        <p class="submit"><input type="submit" name="commit" value="1-50"> 
        10g.</p>
      </form>
    </div>
  </section>
  <section class="container2">
    <div class="11-30">
	      <form method="post" action="Bypass.php">
          <input hidden="" type="text" name="lvl" value="30" placeholder="lvl">
        <p class="submit"><input type="submit" name="commit" value="51-200"> 
        100g.</p>
      </form>
    </div>
  </section>
  <section class="container3">
    <div class="31-50">
	      <form method="post" action="Bypass.php">
         <input hidden="" type="text" name="lvl" value="50" placeholder="lvl">
        <p class="submit"><input type="submit" name="commit" value="201-500"> 
        500g.</p>
      </form>
    </div>
  </section>
</div>
<div id="box1">
<section class="container4">
<form method="post" action="Enchant.php">
<input hidden="" type="text" name="lvl2" value="Enchant" placeholder="Upgarde Weapon">
<p class="submit">
  <input type="submit" name="commit2" value="Upgrade Weapon">
  </form>
</p>
</section>
<section class="container4">
<form method="post" action="vale.php">
<input hidden="" type="text" name="lvl2" value="Upgrade" placeholder="Reroll Mod">
<p class="submit">
  <input type="submit" name="commit2" value="Reroll Mod">
  </form>
</p>
</section>
<section class="container4">
<form method="post" action="loot.php">
<input hidden="" type="text" name="lvl2" value="Upgrade" placeholder="Reroll Mod">
<p class="submit">
  <input type="submit" name="commit2" value="Loot Shards">
  </form>
</p>
</section>
</div>
<div id="box2">
  <section class="container5">
    <div class="31-50">
        <form method="post" action="Bypass.php">
         <input hidden="" type="text" name="lvl" value="100" placeholder="Fight Boss">
        <p class="submit">
          <input type="submit" name="commit" value="Badass">
1k g.</p>
      </form>
    </div>
  </section>
  <section class="container5">
    <div class="31-50">
        <form method="post" action="wBoss.php">
         <input hidden="" type="text" name="lvl" value="100" placeholder="Fight Boss">
        <p class="submit">
          <input type="submit" name="commit" value="World Boss">
Free.</p>
      </form>
        <form method="post" action="auctionhouse.php">
         <input hidden="" type="text" name="" value="" placeholder="Auction House">
        <p class="submit">
          <input type="submit" name="commit" value="Auction House"></p>
      </form>
    </div>
  </section>
  <!--<section class="container5">
    <div class="31-50">
        <form method="post" action="fightP.php">
         <input hidden="" type="text" name="lvl" value="100" placeholder="Fight Boss">
        <p class="submit">
          <input type="submit" name="commit" value="PVP"></p>
      </form>
    </div>
  </section>-->
</div></div>
<?php

$WPN = mysqli_query($db,"SELECT * from weapondrops ORDER BY Worth DESC LIMIT 1");
$WPN = mysqli_fetch_row($WPN);
$KIL = mysqli_query($db,"SELECT * from characters ORDER BY kills DESC LIMIT 1");
$KIL = mysqli_fetch_row($KIL);
$ILVL = mysqli_query($db,"SELECT * from characters ORDER BY ILVL DESC LIMIT 1");
$ILVL = mysqli_fetch_row($ILVL);
$RANK = mysqli_query($db,"SELECT * from characters ORDER BY Rank DESC LIMIT 1");
$RANK = mysqli_fetch_row($RANK);

?>
<div id="wrapper3">

<?php


echo "<div class='tooltip'><img src='IMG/cryt.jpg' style='width:45px;height:45px;'> <span class='tooltiptext'>LVL: $PAS[3]<br>XP:$PAS[1]/$plvl1[1]<br>$PAS[2]% Cryt chanse</span></div>";
echo "<div class='tooltip'><img src='IMG/crytd.jpg' style='width:45px;height:45px;'> <span class='tooltiptext'>LVL: $PAS[12]<br>XP:$PAS[10]/$plvl4[1]<br>$PAS[11]% Cryt damage increase</span></div>";
echo "<div class='tooltip'><img src='IMG/apsorb.jpg' style='width:45px;height:45px;'> <span class='tooltiptext'>LVL: $PAS[6]<br>XP:$PAS[4]/$plvl2[1]<br>$PAS[5]% Absorb</span></div>";
echo "<div class='tooltip'><img src='IMG/ener.jpg' style='width:45px;height:45px;'> <span class='tooltiptext'>LVL: $PAS[9]<br>XP:$PAS[7]/$plvl3[1]<br>$PAS[8]% Bonus energy regen</span></div>";

if ($WEP[12] == 0){
}
else{
	echo "&nbsp&nbsp";
	echo "<b>Wep. skill - </b>";
	echo "<div class='tooltip'><img src='IMG/$Skil[6]' style='width:45px'> <span class='tooltiptext'>$Skil[3]$Skil[4]$Skil[5]% $Skil[1]</span></div>";
};

echo "<div id='mini2'>";

	
	if ($WPN[3] == "ff6633"){
		$unEfs = "class='awesome'";}
		
echo "Strongest item: <b $unEfs class='$WPN[3]'>$WPN[1]</b><br>";
echo "Highest item lvl: <b>$ILVL[9] - by <font color='$ILVL[12]'>$ILVL[0]</font></b><br>";
echo "Most kills: <b>$KIL[6] - by <font color='$KIL[12]'>$KIL[0]</font></b><br>";
echo "Highest PVP Rank: <font color='$RANK[12]'><b>$RANK[11]</font> - by <font color='$RANK[12]'>$RANK[0]</font></b>";

echo "</div>";

if(isset($mc2)){
$img = $mc2 - 2;}
else{
	$img = 1;}
if ($img < 1){
	$img = 1;}


echo "<div id='mini3'><img src='IMG/$img.png'></div>";

echo "<div id='veilvl'>$MOD[9]</div>";

echo "<div id='veil'>";
if(isset($MODN[1])){

if(isset($MODN[1])){
	$n1 = $MODN[1];
	$e1 = $MODE[1];
	echo "$e1% $n1<br>";
}
if(isset($MODN[3])){
	$n2 = $MODN[3];
	$e2 = $MODE[3];
	echo "$e2% $n2<br>";
}
if(isset($MODN[5])){
	$n3 = $MODN[5];
	$e3 = $MODE[5];
	echo "$e3% $n3<br>";
}
if(isset($MODN[7])){
	$n4 = $MODN[7];
	$e4 = $MODE[7];
	echo "$e4% $n4<br>";
}
echo "</div>";
}
else {
	echo "No mod equiped</div>";
}


echo "</div><br><b>Inventory:</b><table border='0' class='solid'>
<tr>
<td>Name</td>

</tr>";

echo "<tr>";
$List = mysqli_query($db,"SELECT * FROM inventor WHERE User = '$User'");
while ($List1 = mysqli_fetch_array($List)){	

$WEPI = mysqli_query($db,"SELECT * FROM weapondrops where HASH = '$List1[1]' ");
$WEPI = mysqli_fetch_row($WEPI);
$sell = ($WEPI[4] + $ACC[3]) *10;

$eft = 1 + $eft;

if ($WEPI[14]<>0){
		if ($WEPI[13] == "LL"){
	$efftype[$eft] = "Life Leach";
	}
		if ($WEPI[13] == "BL"){
	$efftype[$eft] = "Bleed Chanse";
	}
		if ($WEPI[13] == "BR"){
	$efftype[$eft] = "Burn Chanse";
	}
		if ($WEPI[13] == "FR"){
	$efftype[$eft] = "Freez Chanse";
	}
		if ($WEPI[13] == "ST"){
	$efftype[$eft] = "Stun Chanse";
	}
			if ($WEPI[13] == "SH"){
	$efftype = "Shock Chanse";
	}
		if ($WEPI[13] == "BK"){
	$efftype = "Block Chanse";
	}
	$efto[$eft] = "$efftype[$eft] $WEPI[14] %<br>";}

if ($WEPI[12] <> 0){
	$sklu[$eft] = "Has Skill!<br>";}
	
	if ($WEPI[3] == "ff6633"){
		$unEf[$eft] = "class='awesome'";}

echo "<td>";
echo "<div class='tooltip'><b $unEf[$eft] class='$WEPI[3]'>$WEPI[1] + $WEPI[15]</b><span class='tooltiptext'>Lvl:$WEPI[4] <br>P. dmg:$WEPI[5] ~ $WEPI[6]<br>M. dmg:$WEPI[9] ~ $WEPI[10]<br>Cryt chanse: $WEPI[7]<br>Hit Chanse: $WEPI[11]<br>$efto[$eft] $sklu[$eft]</span></div></td>";
echo "<td     display: inline-flex;>
	      <form method='post' class='inventor' action='Equip.php'>
          <input style='display:none' type='submit' name='Eqip' value='$WEPI[0]' placeholder='lvl'>
        <a class='submit'><button type='submit' name='Eqip' value='$WEPI[0]'>Equip</button> 
        </a>
          <input style='display:none' type='submit' name='Sell' value='$WEPI[0]' placeholder='lvl'>
        <a class='submit'><button type='submit' name='Sell' value='$WEPI[0]'><div class='tooltip'>Sell<span class='tooltiptext'>$sell Gold.</span></div></button>
        </a>

      </form>
	  
		<button id ='button$eft' class='tradebutton' onclick='show($eft)'>Trade</button>
	  
<form id='asd$eft' style='display:none' method='post'  action='auctionhouse.php'>
<form >
Asking price: <input type='number' name='price' value='0'>
<input type='text' name='HASH' value='$WEPI[0]' style='display:none'>
 <input type='submit' value='Submit'>
</form></form>

</td>";
echo "</td></tr>";}

mysqli_close($db);
?>
</table>
<br>
<a href="https://docs.google.com/document/d/1-mFNUtG5JPODgaGGs804xrI9LU587AgsUCHiIXmBTkQ/edit?usp=sharing" target="_blank">Change log (0.9.4.1)</b></a><br>
<a href="https://github.com/rngGame/RNG/issues" target="_blank">BUGS? SUGGESTIONS?</a>
<script>
if(typeof(EventSource) !== "undefined") {
    var source = new EventSource("chat_upd.php");
    source.onmessage = function(event) {
        document.getElementById("result").innerHTML = event.data ;
    };
} else {
    document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
}

function hide(a)
{
	var id = a;
	var tf = "asd" + (id);
	var bt = "button" + (id);
	
    document.getElementById(tf).style.display="none";
	document.getElementById(bt).onclick=function () { show(a) };


}
function show(a)
{
	var id = a;
	var tf = "asd" + (id);
	var bt = "button" + (id);
	
    document.getElementById(tf).style.display="block";
	document.getElementById(bt).onclick=function () { hide(a) };

}

</script>
</body>
<font style="font-size:0px"> - By Kompas 2014-2017 </font>
</html>