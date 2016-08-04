<?php
if(!defined('MAIN_FILE')){exit;}
$msg=10;//kol-vo
//-----------
$menu1='class="sel_base_menu"';
$title='Водоёмы - перечень водоёмов для рыбалки';
$description='Водоёмы - перечень водоёмов для рыбалки. Карта водомов в Украине, России...';
$keywords='водоёмы, карта водоёмов, рыболовные водоёмы, водоёмы для рыбалки';

$main_content.='<div class="fon">';
require $root.'/modul/l/vodoem/menu.php';

if(isset($uri_parts[1])){$page=$uri_parts[1];$title.=' - раздел '.$page;$description.=' Подраздел '.$page;}else{$page=1;}

Str_navigation::navigation($uri_parts[0],$table_name,$page,$msg);
$main_content.='<article><h3>Водоёмы</h3>'.Str_navigation::$navigation;

$sql='SELECT id,id_user,data,coordinats,adress,country_map,oblast_map,
		base_name,fish,bilet,glubina,boat,ploschad,contacts,
		road,full_text FROM '.$table_name.' ORDER BY id DESC LIMIT '.Str_navigation::$start_nav.','.$msg;
$db_res=$DB->arrSQL($sql);
foreach($db_res as $key=>$val){
	$adress_mesta=explode(',',$val['adress'],2);
	$base_name=mb_convert_case($val['base_name'],MB_CASE_LOWER,"UTF-8");
	$main_content.='<div class="fon"><h4>'.$val['base_name'].'</h4><p>'.$adress_mesta[1].'</p><p><a href="/водоёмы/'.$val['id'].'-'.str_replace(" ","-",$base_name).'">просмотреть</a></p></div>';
}
$main_content.='</article>'.Str_navigation::$navigation.'</div>';