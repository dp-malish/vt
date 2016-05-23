<?php
class Validator {
	
	
	//Первым делом применять к входящим данным
	public static function html_cod($str){
	$res=htmlspecialchars($str, ENT_QUOTES);
	$res=trim($res);
	return $res;	
	}
	//**************************	
	
	//Длинна строки. Параметр: текст, заданная длинна
	//Если $dlina=0 возвращает длинну строки иначе
	//проверка на пустую строку(0) или превышающую $dlina (2)
	//Если стр в допуске возвращает (1)
	public static function LengthStr($str,$dlina){
	if($str==''){$res=0;}else{
		$res=mb_strlen($str,'UTF-8');
		if($dlina>0){$res <= $dlina ? $res=1 : $res=2;}
	}//Если стр пуста
	return $res;
	}
	//**************************
	

	
/*	
	$index=str_replace("/","",$index);

$index=str_replace(".","",$index);

$index=str_replace(":","",$index);

$index=str_replace("'","",$index);


function no_injection($str='') { 
    $str = stripslashes($str); 
    $str = mysql_real_escape_string($str); 
    $str = trim($str); 
    $str = htmlspecialchars($str); 
    return $str; 
} 

	*/
	
	
}
















?>