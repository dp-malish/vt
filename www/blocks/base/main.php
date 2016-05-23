<?php
//base
if (!defined('MAIN_FILE')){exit;}
$jscript.='<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>';
$css.='<link rel="stylesheet" type="text/css" href="/css/base.css" media="screen,projection"><link rel="stylesheet" type="text/css" href="/css/chosen.css" media="screen,projection">';

try{if($count_uri_parts > 3){throw new Exception();}else{
	
if(!isset($uri_parts[1])){//base
$bad_link=1;
$menu1='class="sel_base_menu"';
$title='Перечень рыболовных база - ПОРТАЛ О РЫБАЛКЕ';	
$description='ПОРТАЛ О РЫБАЛКЕ. Карта рыболовных баз в Украине и России.';
$keywords='ПОРТАЛ О РЫБАЛКЕ, рыбалка, базы, карта водоемов, рыболовные базы, Мариупольский рыболовный клуб';
require($root.'/blocks/base/base_all.'.$phpEx);
if($bad_link!=0){include($root.'/blocks/base/bad_content_404.'.$phpEx);}
}

//****// Base + одна ссылка//****//
if(isset($uri_parts[1]) && !isset($uri_parts[2])){
	$bad_link=1;
	//temp
	if($site=='fishing'){$live_user=1;$userid=198;}
	if($uri_parts[1]=='create'){
$menu2='class="sel_base_menu"';
$title='Добавить рыболовную базу - ПОРТАЛ О РЫБАЛКЕ';
$description='ПОРТАЛ О РЫБАЛКЕ. Добавление Ваших рыболовных баз в Украине и России.';
$keywords='ПОРТАЛ О РЫБАЛКЕ, рыбалка, способы ловли, карта водоемов, рыболовные базы, Мариупольский рыболовный клуб';
			if($live_user==1){
			require($root.'/blocks/base/base_create.'.$phpEx);
			}else{
			$main_content.='<div class="fon">';
			require($root.'/blocks/base/menu_base.'.$phpEx);
			$main_content.='<p>Страница доступна только зарегистрированным пользователям. Для регистрации проследуйте по ссылке <a href="http://forum.vt-fishing.com.ua/register.php" >регистрация</a> либо воспользуйтесь формой входа представленной ниже:</p></div>';
			require($root.'/blocks/common/block/form_login.'.$phpEx);
			}
		$bad_link=0;
	}//$uri_parts[1]=='create'
	if($uri_parts[1]=='my'){
$menu3='class="sel_base_menu"';
$title='Мои рыболовные базу - РЫБАЛОВНЫЙ ПОРТАЛ';
$description='РЫБАЛОВНЫЙ ПОРТАЛ. Регистрация Ваших рыболовных баз в Украине и России.';
$keywords='РЫБАЛОВНЫЙ ПОРТАЛ, рыбалка, регистрация бызы, карта водоемов, рыболовные базы, водоёмы';
			if($live_user==1){
			require($root.'/blocks/base/base_my.'.$phpEx);
			}else{
			$main_content.='<div class="fon">';
			require($root.'/blocks/base/menu_base.'.$phpEx);
			$main_content.='<p>Страница доступна только зарегистрированным пользователям. Для регистрации проследуйте по ссылке <a href="http://forum.vt-fishing.com.ua/register.php" >регистрация</a> либо воспользуйтесь формой входа представленной ниже:</p></div>';
			require($root.'/blocks/common/block/form_login.'.$phpEx);
			}
		$bad_link=0;
	}//$uri_parts[1]=='my'
	if($bad_link!=0){include($root.'/blocks/base/bad_content_404.'.$phpEx);}
}
//****//Вывод по одной ссылке конец//****//


//****// Base + две ссылка//****//
if(isset($uri_parts[1]) && isset($uri_parts[2]) && !isset($uri_parts[3])){$bad_link=1;
//temp
if($site=='fishing'){$live_user=1;$userid=198;}	
if($uri_parts[1]=='view'){
//проработанные титлы************************************************************
$title=' - Рыболовные базы - ПОРТАЛ О РЫБАЛКЕ';//********************************
$description='. ПОРТАЛ О РЫБАЛКЕ. Рыболовные базы Украины и России.';//**********
$keywords=',рыболовный портал,рыбалка,водоёмы,карта водоемов,рыболовные базы';//*
//*******************************************************************************
	require($root.'/blocks/base/base_view.'.$phpEx);
	if($bad_link!=0){include($root.'/blocks/base/bad_content_404.'.$phpEx);}
	}//$uri_parts[1]=='view'
//-------------------------------------------------------------------------------
if($uri_parts[1]=='update'){
$title='Редактирование рыболовных баз - Рыболовные базы - ПОРТАЛ О РЫБАЛКЕ';
$description='Редактирование рыболовных баз. ПОРТАЛ О РЫБАЛКЕ. Рыболовные базы Украины и России.';
$keywords='Редактирование баз,ПОРТАЛ О РЫБАЛКЕ, рыбалка, водоёмы, карта водоемов, рыболовные базы';$title.=$live_user;
	if($live_user==1){require($root.'/blocks/base/base_update.'.$phpEx);
	}else{
	$main_content.='<div class="fon">';
	require($root.'/blocks/base/menu_base.'.$phpEx);
	$main_content.='<p>Страница доступна только зарегистрированным пользователям. Для регистрации проследуйте по ссылке <a href="http://forum.vt-fishing.com.ua/register.php" >регистрация</a> либо воспользуйтесь формой входа представленной ниже:</p></div>';
	require($root.'/blocks/common/block/form_login.'.$phpEx);
	$bad_link=0;}
	if($bad_link!=0){include($root.'/blocks/base/bad_content_404.'.$phpEx);}
}//$uri_parts[1]=='update'
//----------------------------------------------------------------
//----------------------------------------------------------------
		if($uri_parts[1]=='oblast'){
//$menu2='class="sel_base_menu"';
$title='Рыболовные базы - ПОРТАЛ О РЫБАЛКЕ';
$description='ПОРТАЛ О РЫБАЛКЕ. Рыболовные базы Украины и России.';
$keywords='ПОРТАЛ О РЫБАЛКЕ, рыбалка, водоёмы, карта водоемов, рыболовные базы, Мариупольский рыболовный клуб';

		require($root.'/blocks/base/base_oblast.'.$phpEx);
			
		$bad_link=0;
		}//$uri_parts[1]=='oblast'		
		
	if($bad_link!=0){include($root.'/blocks/base/bad_content_404.'.$phpEx);}
}
}//else $count_uri_parts
} catch(Exception $e){$index=true;$module = '404';}
?>