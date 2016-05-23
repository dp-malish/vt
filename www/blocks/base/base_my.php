<?php
if(!defined('MAIN_FILE')){exit;}//$jscript.='';
//-----------
$main_content.='<div class="fon">';
require($root.'/blocks/base/menu_base.'.$phpEx);
$main_content.='<section><h3>Список Ваших рыболовных баз</h3>';
$sql="SELECT id,data,coordinats,adress,country_map,oblast_map,
base_name,fish,bilet,glubina,boat,ploschad,contacts
FROM base_fish WHERE id_user=$userid";	
$result=$MySQLsel->QuerySelect($sql);
$res=mysql_fetch_array($result);
if($res['id']==''){
$main_content.='<p>У Вас нет добавленных Вами рыболовных баз. Для добавления базы наобходимо проследовать в раздел добавления рыболовной базы...</p>';	
}else{
$base_name=mb_convert_case($res['base_name'],MB_CASE_LOWER,"UTF-8");
$main_content.='<div class="fon"><h4>'.$res['base_name'].'</h4><p>'.$res['oblast_map'].'</p><p><a href="/base/view/'.$res['id'].'-'.str_replace(" ","-",$base_name).'">просмотреть</a> | <a href="/base/update/'.$res['id'].'-'.str_replace(" ","-",$base_name).'">редактировать</a></p>';	
$main_content.='</div>';	
while($res = mysql_fetch_array($result)){
$base_name=mb_convert_case($res['base_name'],MB_CASE_LOWER,"UTF-8");
$main_content.='<div class="fon"><h4>'.$res['base_name'].'</h4><p>'.$res['oblast_map'].'</p><p><a href="/base/view/'.$res['id'].'-'.str_replace(" ","-",$base_name).'">просмотреть</a> | <a href="/base/update/'.$res['id'].'-'.str_replace(" ","-",$base_name).'">редактировать</a></p>';
$main_content.='</div>';
}mysql_free_result($result);
}$main_content.='</section></div>';?>