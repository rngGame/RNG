<?php
//DMG ROUNDING

if ($monsRefTX >= 1000000000){
$monsRefTX = round($monsRefTX/1000000000,1);
$monsRefTX .= "kkk.";}
else if ($monsRefTX >= 1000000){
$monsRefTX = round($monsRefTX/1000000,1);
$monsRefTX .= "kk.";}
else if ($monsRefTX >= 1000){
$monsRefTX = round($monsRefTX/1000,1);
$monsRefTX .= "k.";}
else if ($monsRefTX < 1000){
$monsRefTX = round($monsRefTX);
}

if ($dmgPL >= 1000000000){
$dmgPL = round($dmgPL/1000000000,1);
$dmgPL .= "kkk.";}
else if ($dmgPL >= 1000000){
$dmgPL = round($dmgPL/1000000,1);
$dmgPL .= "kk.";}
else if ($dmgPL >= 1000){
$dmgPL = round($dmgPL/1000,1);
$dmgPL .= "k.";}
else if ($dmgPL < 1000){
$dmgPL = round($dmgPL);
}

if ($physDMGcTX >= 1000000000){
$physDMGcTX = round($physDMGcTX/1000000000,1);
$physDMGcTX .= "kkk.";}
else if ($physDMGcTX >= 1000000){
$physDMGcTX = round($physDMGcTX/1000000,1);
$physDMGcTX .= "kk.";}
else if ($physDMGcTX >= 1000){
$physDMGcTX = round($physDMGcTX/1000,1);
$physDMGcTX .= "k.";}
else if ($physDMGcTX < 1000){
$physDMGcTX = round($physDMGcTX);
}

if ($THval >= 1000000000){
$THval = round($THval/1000000000,1);
$THval .= "kkk.";}
else if ($THval >= 1000000){
$THval = round($THval/1000000,1);
$THval .= "kk.";}
else if ($THval >= 1000){
$THval = round($THval/1000,1);
$THval .= "k.";}
else if ($THval < 1000){
$THval = round($THval);
}

if ($GMval >= 1000000000){
$GMval = round($GMval/1000000000,1);
$GMval .= "kkk.";}
else if ($GMval >= 1000000){
$GMval = round($GMval/1000000,1);
$GMval .= "kk.";}
else if ($GMval >= 1000){
$GMval = round($GMval/1000,1);
$GMval .= "k.";}
else if ($GMval < 1000){
$GMval = round($GMval);
}

if ($monDID >= 1000000000){
$monDID = round($monDID/1000000000,1);
$monDID .= "kkk.";}
else if ($monDID >= 1000000){
$monDID = round($monDID/1000000,1);
$monDID .= "kk.";}
else if ($monDID >= 1000){
$monDID = round($monDID/1000,1);
$monDID .= "k.";}
else if ($monDID < 1000){
$monDID = round($monDID);
}

if ($monDMGmagTXT >= 1000000000){
$monDMGmagTXT = round($monDMGmagTXT/1000000000,1);
$monDMGmagTXT .= "kkk.";}
else if ($monDMGmagTXT >= 1000000){
$monDMGmagTXT = round($monDMGmagTXT/1000000,1);
$monDMGmagTXT .= "kk.";}
else if ($monDMGmagTXT >= 1000){
$monDMGmagTXT = round($monDMGmagTXT/1000,1);
$monDMGmagTXT .= "k.";}
else if ($monDMGmagTXT < 1000){
$monDMGmagTXT = round($monDMGmagTXT);
}
	
if ($poisonTX >= 1000000000){
$poisonTX = round($poisonTX/1000000000,1);
$poisonTX .= "kkk.";}
else if ($poisonTX >= 1000000){
$poisonTX = round($poisonTX/1000000,1);
$poisonTX .= "kk.";}
else if ($poisonTX >= 1000){
$poisonTX = round($poisonTX/1000,1);
$poisonTX .= "k.";}
else if ($poisonTX < 1000){
$poisonTX = round($poisonTX);
}
?>