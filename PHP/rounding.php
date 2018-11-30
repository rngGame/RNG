<?php
//BASIC STUFF

if ($mHPNtx >= 1000000000){
$mHPNtx = round($mHPNtx/1000000000,1);
$mHPNtx .= "kkk.";}
else if ($mHPNtx >= 1000000){
$mHPNtx = round($mHPNtx/1000000,1);
$mHPNtx .= "kk.";}
else if ($mHPNtx >= 1000){
$mHPNtx = round($mHPNtx/1000,1);
$mHPNtx .= "k.";}
else if ($mHPNtx < 1000){
$mHPNtx = round($mHPNtx);
}


if ($mDMGtx >= 1000000000){
$mDMGtx = round($mDMGtx/1000000000,1);
$mDMGtx .= "kkk.";}
else if ($mDMGtx >= 1000000){
$mDMGtx = round($mDMGtx/1000000,1);
$mDMGtx .= "kk.";}
else if ($mDMGtx >= 1000){
$mDMGtx = round($mDMGtx/1000,1);
$mDMGtx .= "k.";}
else if ($mDMGtx < 1000){
$mDMGtx = round($mDMGtx);
}


if ($mDMGmtx >= 1000000000){
$mDMGmtx = round($mDMGmtx/1000000000,1);
$mDMGmtx .= "kkk.";}
else if ($mDMGmtx >= 1000000){
$mDMGmtx = round($mDMGmtx/1000000,1);
$mDMGmtx .= "kk.";}
else if ($mDMGmtx >= 1000){
$mDMGmtx = round($mDMGmtx/1000,1);
$mDMGmtx .= "k.";}
else if ($mDMGmtx < 1000){
$mDMGmtx = round($mDMGmtx);
}

if ($mDRPtx >= 1000000000){
$mDRPtx = round($mDRPtx/1000000000,1);
$mDRPtx .= "kkk.";}
else if ($mDRPtx >= 1000000){
$mDRPtx = round($mDRPtx/1000000,1);
$mDRPtx .= "kk.";}
else if ($mDRPtx >= 1000){
$mDRPtx = round($mDRPtx/1000,1);
$mDRPtx .= "k.";}
else if ($mDRPtx < 1000){
$mDRPtx = round($mDRPtx);
}

if ($HPintx >= 1000000000){
$HPintx = round($HPintx/1000000000,1);
$HPintx .= "kkk.";}
else if ($HPintx >= 1000000){
$HPintx = round($HPintx/1000000,1);
$HPintx .= "kk.";}
else if ($HPintx >= 1000){
$HPintx = round($HPintx/1000,1);
$HPintx .= "k.";}
else if ($HPintx < 1000){
$HPintx = round($HPintx);
}

if ($avgPtx >= 1000000000){
$avgPtx = round($avgPtx/1000000000,1);
$avgPtx .= "kkk.";}
else if ($avgPtx >= 1000000){
$avgPtx = round($avgPtx/1000000,1);
$avgPtx .= "kk.";}
else if ($avgPtx >= 1000){
$avgPtx = round($avgPtx/1000,1);
$avgPtx .= "k.";}
else if ($avgPtx < 1000){
$avgPtx = round($avgPtx);
}

if ($avgMtx >= 1000000000){
$avgMtx = round($avgMtx/1000000000,1);
$avgMtx .= "kkk.";}
else if ($avgMtx >= 1000000){
$avgMtx = round($avgMtx/1000000,1);
$avgMtx .= "kk.";}
else if ($avgMtx >= 1000){
$avgMtx = round($avgMtx/1000,1);
$avgMtx .= "k.";}
else if ($avgMtx < 1000){
$avgMtx = round($avgMtx);
}

if ($Armortx >= 1000000000){
$Armortx = round($Armortx/1000000000,1);
$Armortx .= "kkk.";}
else if ($Armortx >= 1000000){
$Armortx = round($Armortx/1000000,1);
$Armortx .= "kk.";}
else if ($Armortx >= 1000){
$Armortx = round($Armortx/1000,1);
$Armortx .= "k.";}
else if ($Armortx < 1000){
$Armortx = round($Armortx);
}

if ($ArmorMtx >= 1000000000){
$ArmorMtx = round($ArmorMtx/1000000000,1);
$ArmorMtx .= "kkk.";}
else if ($ArmorMtx >= 1000000){
$ArmorMtx = round($ArmorMtx/1000000,1);
$ArmorMtx .= "kk.";}
else if ($ArmorMtx >= 1000){
$ArmorMtx = round($ArmorMtx/1000,1);
$ArmorMtx .= "k.";}
else if ($ArmorMtx < 1000){
$ArmorMtx = round($ArmorMtx);
}

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
	
if ($MonsterS[PL1] >= 1000000000){
$MonsterS[PL1] = round($MonsterS[PL1]/1000000000,1);
$MonsterS[PL1] .= "kkk.";}
else if ($MonsterS[PL1] >= 1000000){
$MonsterS[PL1] = round($MonsterS[PL1]/1000000,1);
$MonsterS[PL1] .= "kk.";}
else if ($MonsterS[PL1] >= 1000){
$MonsterS[PL1] = round($MonsterS[PL1]/1000,1);
$MonsterS[PL1] .= "k.";}
else if ($MonsterS[PL1] < 1000){
$MonsterS[PL1] = round($MonsterS[PL1]);
}

if ($MonsterS[PL2] >= 1000000000){
$MonsterS[PL2] = round($MonsterS[PL2]/1000000000,1);
$MonsterS[PL2] .= "kkk.";}
else if ($MonsterS[PL2] >= 1000000){
$MonsterS[PL2] = round($MonsterS[PL2]/1000000,1);
$MonsterS[PL2] .= "kk.";}
else if ($MonsterS[PL2] >= 1000){
$MonsterS[PL2] = round($MonsterS[PL2]/1000,1);
$MonsterS[PL2] .= "k.";}
else if ($MonsterS[PL2] < 1000){
$MonsterS[PL2] = round($MonsterS[PL2]);
}

if ($MonsterS[PL3] >= 1000000000){
$MonsterS[PL3] = round($MonsterS[PL3]/1000000000,1);
$MonsterS[PL3] .= "kkk.";}
else if ($MonsterS[PL3] >= 1000000){
$MonsterS[PL3] = round($MonsterS[PL3]/1000000,1);
$MonsterS[PL3] .= "kk.";}
else if ($MonsterS[PL3] >= 1000){
$MonsterS[PL3] = round($MonsterS[PL3]/1000,1);
$MonsterS[PL3] .= "k.";}
else if ($MonsterS[PL3] < 1000){
$MonsterS[PL3] = round($MonsterS[PL3]);
}

if ($MonsterS[PL4] >= 1000000000){
$MonsterS[PL4] = round($MonsterS[PL4]/1000000000,1);
$MonsterS[PL4] .= "kkk.";}
else if ($MonsterS[PL4] >= 1000000){
$MonsterS[PL4] = round($MonsterS[PL4]/1000000,1);
$MonsterS[PL4] .= "kk.";}
else if ($MonsterS[PL4] >= 1000){
$MonsterS[PL4] = round($MonsterS[PL4]/1000,1);
$MonsterS[PL4] .= "k.";}
else if ($MonsterS[PL4] < 1000){
$MonsterS[PL4] = round($MonsterS[PL4]);
}

if ($List1[2] >= 1000000000){
$List1[2] = round($List1[2]/1000000000,1);
$List1[2] .= "kkk.";}
else if ($List1[2] >= 1000000){
$List1[2] = round($List1[2]/1000000,1);
$List1[2] .= "kk.";}
else if ($List1[2] >= 1000){
$List1[2] = round($List1[2]/1000,1);
$List1[2] .= "k.";}
else if ($List1[2] < 1000){
$List1[2] = round($List1[2]);
}
?>