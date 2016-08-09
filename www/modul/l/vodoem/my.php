<?php
if(!defined('MAIN_FILE')){exit;}//$jscript.='';
//-----------
$main_content.='<div class="fon">';
require $root.'/modul/l/vodoem/menu.php';
$main_content.='<section><h3>Список Ваших водоёмов</h3>';
$sql="SELECT id,data,coordinats,adress,country_map,oblast_map,
base_name,fish,bilet,glubina,boat,ploschad,contacts
FROM $table_name WHERE id_user=$userid";
$db_res=$DB->arrSQL($sql);
if(!$db_res){$main_content.='<p>У Вас нет добавленных Вами водоёмов. Для добавления водоёма наобходимо проследовать в раздел <a href="/водоёмы/добавить">добавления водоёма</a>...</p>';
}else{
    foreach($db_res as $key=>$val){
$base_name=mb_convert_case($val['base_name'],MB_CASE_LOWER,"UTF-8");
$main_content.='<div class="fon"><h4>'.$val['base_name'].'</h4><p>'.$val['oblast_map'].'</p><p><a href="/водоёмы/'.$val['id'].'-'.str_replace(" ","-",$base_name).'">просмотреть</a> | <a href="/водоёмы/обновить/'.$val['id'].'-'.str_replace(" ","-",$base_name).'">редактировать</a></p>';
$main_content.='</div>';
    }
}$main_content.='</section></div>';