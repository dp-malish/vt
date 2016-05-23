<?php
if (!defined('MAIN_FILE')){exit;}
//$jscript.='';
$uri_parts_2=urldecode($uri_parts[2]);
$uri_parts_second=explode('-',$uri_parts_2,2);
if(preg_match("/[^0-9]+/",$uri_parts_second[0])){$bad_link=1;}
else{
$sql='SELECT id,id_user,data,coordinats,adress,
	base_name,fish,bilet,glubina,boat,ploschad,contacts,road,full_text
	FROM base_fish WHERE id=\''.mysql_real_escape_string($uri_parts_second[0]).'\'';
	$result=$MySQLsel->QuerySelect($sql);
	$res=mysql_fetch_array($result);

	if($res['base_name']==''){$bad_link=1;}
	else{
	$title=$res['base_name'].$title;$description=$res['base_name'].$description;	$keywords=$res['base_name'].$keywords;
	$main_content.='<div class="fon">';
	require($root.'/blocks/base/menu_base.'.$phpEx);
	$main_content.='<section><h2>Рыболовные базы</h2>';
	$main_content.='<h3>'.$res['base_name'].'</h3>';

	$main_content.='<h4>Карта водоёма</h4><div id="map"></div><script type="text/javascript">ymaps.ready(init);
var myMap,myPlacemark;function init(){myMap = new ymaps.Map(\'map\',{center: ['.$res['coordinats'].'],zoom: 11,controls:[\'rulerControl\',\'fullscreenControl\',\'zoomControl\',\'typeSelector\']});
myPlacemark = new ymaps.Placemark(['.$res['coordinats'].'],{balloonContentHeader: \''.$res['oblast_map'].'\',hintContent: \''.$res['base_name'].'\',balloonContent: \''.$res['base_name'].'\',balloonContentFooter: \'Контакты: ';
if($res['contacts']==''){$main_content.='контакты не указаны';}
else{$main_content.=$res['contacts'];}
$main_content.='\'});myMap.geoObjects.add(myPlacemark);}</script>';

	$adress_mesta=explode(',',$res['adress'],2);
	$main_content.='<p>Координаты: '.str_replace(",",", ",$res['coordinats']).'</p><p>Разновидности рыб: '.str_replace(",",", ",$res['fish']).'</p><p>Географический ореентир: '.$adress_mesta[1].'</p>';

	if($res['bilet']!=''){
	$main_content.='<p>Отловочный билет: '.$res['bilet'].'</p>';
	}else{$main_content.='<p>Отловочный билет: информация не указана</p>';}
	if($res['glubina']!=''){
	$main_content.='<p>Глубина водоема: '.$res['glubina'].'</p>';
	}else{$main_content.='<p>Глубина водоема: информация не указана</p>';}
	if($res['boat']!=''){
	$main_content.='<p>Использование лодки: '.$res['boat'].'</p>';
	}else{$main_content.='<p>Использование лодки: информация не указана</p>';}
	if($res['ploschad']!=''){
	$main_content.='<p>Площадь водоема: '.$res['ploschad'].'</p>';
	}else{$main_content.='<p>Площадь водоема: информация не указана</p>';}	
	if($res['contacts']!=''){
	$main_content.='<p>Контакты владельца: '.$res['contacts'].'</p>';
	}else{$main_content.='<p>Контакты владельца: информация не указана</p>';}
	$main_content.='<br><p>Описание маршрута движения:</p>'.htmlspecialchars_decode($res['road'],ENT_QUOTES).'<br><br><p>Описание водоёма:</p>'.htmlspecialchars_decode($res['full_text'],ENT_QUOTES);
	$main_content.='</section></div>';
	$bad_link=0;
	}//else $bad_link=1;
}//else $bad_link=1;
?>


