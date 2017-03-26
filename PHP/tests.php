<?php
include_once 'config.php';
include_once 'PHP/db.php';
include_once 'PHP/function.php';

function globalTest(){
	if(!itemDropTest()){
		return false
	}
}
function itemDropTest(){
	if(!itemDropWithArmor()){
		return false;
	}
	if(!itemDropWithAny()){
		return false;
	}
	if(!itemDropWithWrong()){
		return false;
	}
}
function itemDropWithArmor(){
	list($iLVL, $armor, $name, $new, $nameType) = itemDrop("armor",150);
	if(!$iLVL OR !$armor OR !$name){
		return false;
	}
}
function itemDropWithAny(){
	list($iLVL, $armor, $name, $new, $nameType) = itemDrop("any",150);
	if(!$iLVL OR !$armor OR !$name){
		return false;
	}
}
function itemDropWithWrong(){
	list($iLVL, $armor, $name, $new, $nameType) = itemDrop("",150);
	if($iLVL OR $armor OR $name){
		return false;
	}
}
