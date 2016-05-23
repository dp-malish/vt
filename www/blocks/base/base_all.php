<?php
if (!defined('MAIN_FILE')){exit;}
//$jscript.='';
//-----------
$bad_link=0;
if(isset($_GET['page'])){
if(preg_match("/[^0-9]+/",$_GET['page'])){$bad_link=1;}
else{$page=$_GET['page'];}
}else{$page=1;}

if($bad_link!=1){
$main_content.='<div class="fon">';
require($root.'/blocks/base/menu_base.'.$phpEx);
$main_content.='<section><h3>Список рыболовных баз</h3>';

$msg=10;//kol-vo stranic для отображения
$sql="SELECT COUNT(id) FROM base_fish";
$result=$MySQLsel->QuerySelect($sql);
$str=mysql_result($result,0);
$total=(int)(($str-1)/$msg)+1;
$start=$page * $msg - $msg;

$sql="SELECT id,id_user,data,coordinats,adress,country_map,oblast_map,
		base_name,fish,bilet,glubina,boat,ploschad,contacts,
		road,full_text FROM base_fish ORDER BY id DESC LIMIT $start, $msg";
$result=$MySQLsel->QuerySelect($sql);
while($res=mysql_fetch_array($result)){
	$adress_mesta=explode(',',$res['adress'],2);
	$base_name=mb_convert_case($res['base_name'],MB_CASE_LOWER,"UTF-8");
	$main_content.='<div class="fon"><h4>'.$res['base_name'].'</h4><p>'.$adress_mesta[1].'</p><p><a href="/base/view/'.$res['id'].'-'.str_replace(" ","-",$base_name).'">просмотреть</a></p>';
	$main_content.='</div>';
}mysql_free_result($result);

//Проверяем нужны ли стрелки назад  
if($page!=1)$pervpage='<a href=/base?page=1><<</a> <a href=/base?page='.($page-1).'><</a> ';
//Проверяем нужны ли стрелки вперед  
if($page!=$total)$nextpage=' <a href=/base?page='.($page+1).'>></a> <a href=/base?page='.$total.'>>></a>';
//Находим две ближайшие станицы с обоих краев, если они есть 
if($page-3>0)$page3left=' <a href=/base?page='.($page-3).'>'.($page-3).'</a> | ';
if($page-2>0)$page2left=' <a href=/base?page='.($page-2).'>'.($page-2).'</a> | ';  
if($page-1>0)$page1left='<a href=/base?page='.($page-1).'>'.($page-1).'</a> | ';
if($page+3<=$total)$page3right=' | <a href=/base?page='.($page+3).'>'.($page+3).'</a>';
if($page+2<=$total)$page2right=' | <a href=/base?page='.($page+2).'>'.($page+2).'</a>';
if($page+1<=$total)$page1right=' | <a href=/base?page='.($page+1).'>'.($page+1).'</a>'; 
// Вывод меню  
$main_content.='<div class="fon align-center"><p>'.$pervpage.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$page3right.$nextpage.'</p></div>';

/* Вывод меню областей
	$main_content.='<div class="fon">';
	require($root.'/blocks/base/menu_base.'.$phpEx);
	$main_content.='<section><h3>Рыболовные базы отсортированные по областям</h3>';
	$sql = "SELECT DISTINCT oblast_map	FROM base_fish";	
	
	$result = $MySQLsel->QuerySelect($sql);
	
	while($res = mysql_fetch_array($result)){
	$main_content.='<div class="fon"><p>| <a href="/base/oblast/';
	$oblast=str_replace(" ","_",$res['oblast_map']);
	
	$main_content.=$oblast.'">'.$res['oblast_map'].'</a> |</p>';
	$main_content.='</div>';
	}mysql_free_result($result);	
*/	
	/*$sql = "SELECT id,id_user,data,coordinats,adress,country_map,oblast_map,
		base_name,fish,bilet,glubina,boat,ploschad,contacts,
		road,full_text FROM base_fish WHERE id_user=$userid";
	$sql = "SELECT id,id_user,data,coordinats,adress,country_map,oblast_map,
		base_name,fish,bilet,glubina,boat,ploschad,contacts
		FROM base_fish WHERE id_user=$userid";*/
		
	//$result = $MySQLsel->QuerySelect($sql);
	//$res = mysql_fetch_array($result);


//*********************************
//*********************************
	$main_content.='</section></div>';
}//if($bad_link!=1)
?>