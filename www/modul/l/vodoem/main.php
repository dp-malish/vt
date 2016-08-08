<?php
//base
if(!defined('MAIN_FILE')){exit;}
$table_name='vodoemi';
$table_name_ext='vodoemi_kind';
$jscript.='<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>';
$css.='<link rel="stylesheet" type="text/css" href="/css/base.css" media="screen,projection"><link rel="stylesheet" type="text/css" href="/css/chosen.css" media="screen,projection">';

//temp
if($site=='vt'){$live_user=1;$userid=198;}

try{if($count_uri_parts>3){throw new Exception();}else{
	
if(!isset($uri_parts[1])){include $root.'/modul/l/vodoem/all.php';}

//****водоёмы + одна ссылка****//
if(isset($uri_parts[1]) && !isset($uri_parts[2])){

	if(Validator::paternInt($uri_parts[1])){include $root.'/modul/l/vodoem/all.php';
	}else{
		$uri_parts_ext=explode('-',$uri_parts[1],2);
		if(Validator::paternInt($uri_parts_ext[0])){include $root.'/modul/l/vodoem/view.php';
		}else{
		$bad_link=1;

		if($uri_parts[1]=='добавить'){
			$menu2='class="sel_base_menu"';
			$title='Добавить рыболовный водоём';
			$description='ПОРТАЛ О РЫБАЛКЕ. Добавление Ваших рыболовных водоёмов в Украине, России и других странах СНГ.';
			$keywords='рыбалка, карта водоемов, рыболовные базы, водоёмы, добавить водоём';
			if($live_user==1){require $root.'/modul/l/vodoem/add.php';
			}else{
				$main_content.='<div class="fon">';
				include $root.'/modul/l/vodoem/menu.php';
				$main_content.='<p>Страница доступна только зарегистрированным пользователям. Для регистрации проследуйте по ссылке <a href="http://forum.vt-fishing.com.ua/register.php" >регистрация</a> либо воспользуйтесь формой входа представленной ниже:</p></div>';
				include $root.'/blocks/common/block/form_login.php';
			}
			$bad_link = 0;
		}
		if($uri_parts[1]=='мои'){
			$menu3='class="sel_base_menu"';
			$title='Мои рыболовные водоёмы';
			$description='РЫБАЛОВНЫЙ ПОРТАЛ. Регистрация Ваших водоёмов в Украине, России и других странах СНГ.';
			$keywords='рыбалка, карта водоёмов, рыболовные базы, водоёмы, рыболовные базы, водоёмы, просмотреть водоёмы';
			if($live_user==1){require $root.'/modul/l/vodoem/my.php';
			}else{
				$main_content .= '<div class="fon">';
				include $root.'/modul/l/vodoem/menu.php';
				$main_content .= '<p>Страница доступна только зарегистрированным пользователям. Для регистрации проследуйте по ссылке <a href="http://forum.vt-fishing.com.ua/register.php" >регистрация</a> либо воспользуйтесь формой входа представленной ниже:</p></div>';
				include $root.'/blocks/common/block/form_login.php';
			}
			$bad_link = 0;
		}//$uri_parts[1]=='мои'
		if($bad_link!=0){include $root.'/modul/l/vodoem/bad_content_404.php';}
		}
	}
}
//****//Вывод по одной ссылке конец//****//


//****// Base + две ссылка//****//
if(isset($uri_parts[1]) && isset($uri_parts[2]) && !isset($uri_parts[3])){$bad_link=1;
//-------------------------------------------------------------------------------
if($uri_parts[1]=='обновить'){
$title='Редактирование рыболовных баз - Рыболовные базы - ПОРТАЛ О РЫБАЛКЕ';
$description='Редактирование рыболовных баз. ПОРТАЛ О РЫБАЛКЕ. Рыболовные базы Украины и России.';
$keywords='Редактирование баз,ПОРТАЛ О РЫБАЛКЕ, рыбалка, водоёмы, карта водоемов, рыболовные базы';$title.=$live_user;
	if($live_user==1){require($root.'/blocks/base/base_update.'.$phpEx);
	}else{
	$main_content.='<div class="fon">';
	require($root.'/blocks/base/menu_base.'.$phpEx);
	$main_content.='<p>Страница доступна только зарегистрированным пользователям. Для регистрации проследуйте по ссылке <a href="http://forum.vt-fishing.com.ua/register.php" >регистрация</a> либо воспользуйтесь формой входа представленной ниже:</p></div>';
		include $root.'/blocks/common/block/form_login.php';
	$bad_link=0;}
	if($bad_link!=0){include $root.'/modul/l/vodoem/bad_content_404.php';}
}//$uri_parts[1]=='update'

}
}//else $count_uri_parts
}catch(Exception $e){$index=true;}