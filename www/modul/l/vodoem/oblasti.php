<?php
if(!defined('MAIN_FILE')){exit;}
$msg=10;//kol-vo
//-----------
$menu1='class="sel_base_menu"';
$title='Водоёмы по областям - Рыболовные водоёмы';
$description='Рыболовные водоёмы по областям - перечень водоёмов для рыбалки, для удобства разделены на области. Карта водомов в Украине, России...';
$keywords='водоёмы, карта водоёмов, рыболовные водоёмы, водоёмы для рыбалки, водоёмы по областям';

$main_content.='<div class="fon">';
require $root.'/modul/l/vodoem/menu.php';

if(isset($uri_parts[3])){$page=$uri_parts[3];$title.=' - раздел '.$page;$description.=' Подраздел '.$page;}else{$page=1;}

$main_content.='<article><h3>Водоёмы по областям:</h3><div class="fon"><nav><ul class="nav_link five">';

$menu_oblasti=$Cash->IsSetCacheFileTime(172800,'vodoemi/oblasti.html');//два дня
if($menu_oblasti=='0'){
	$res=$DB->arrSQL('SELECT DISTINCT(oblast_map) FROM vodoemi ORDER BY oblast_map');
	if($res){
		$menu_oblasti='';
		foreach($res as $key=>$val){
			$menu_oblasti.='<li><a href="/водоёмы/по-областям/'.str_replace(" ","-",$val['oblast_map']). '">'.$val['oblast_map'].'</a></li>';
		}
	}else{$menu_oblasti='';}
	$Cash->StartCache();echo $menu_oblasti;$Cash->StopCache('vodoemi/oblasti.html');
}
$main_content.=$menu_oblasti.'</ul></nav></div></article>';

$oblast=str_replace("-"," ",$uri_parts[2]);
$oblast_sql=$DB->realEscapeStr($oblast);
$sql=$table_name.' WHERE oblast_map='.$oblast_sql;
Str_navigation::navigation($uri_parts[0].'/'.$uri_parts[1].'/'.$uri_parts[2],$sql,$page,$msg);

$main_content.='<article><h3>'.$oblast.'</h3>'.Str_navigation::$navigation;

$sql='SELECT id,adress,base_name
		FROM '.$table_name.' WHERE oblast_map='.$oblast_sql.' ORDER BY id DESC LIMIT '.Str_navigation::$start_nav.','.$msg;
$db_res=$DB->arrSQL($sql);
if($db_res){$bad_link=0;
foreach($db_res as $key=>$val){
	$adress_mesta=explode(',',$val['adress'],2);
	$base_name=mb_convert_case($val['base_name'],MB_CASE_LOWER,"UTF-8");
	$main_content.='<div class="fon"><h4>'.$val['base_name'].'</h4><p>'.$adress_mesta[1].'</p><p><a href="/водоёмы/'.$val['id'].'-'.str_replace(" ","-",$base_name).'">просмотреть</a></p></div>';
}}else{$bad_link=1;}
$main_content.='</article>'.Str_navigation::$navigation.'</div>';
