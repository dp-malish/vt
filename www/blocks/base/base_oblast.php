<?php
if (!defined('MAIN_FILE')){exit;}
//$jscript.='';
//-----------



	$main_content.='<div class="fon">';
	require($root.'/blocks/base/menu_base.'.$phpEx);
	$main_content.='<section><h3>Рыболовные базы отсортированные по областям</h3>';
	
	
	$main_content.=urldecode($uri_parts[2]);
	
	$oblast=str_replace("_"," ",urldecode($uri_parts[2]));
	
	$sql = 'SELECT id,id_user,data,coordinats,adress,country_map,oblast_map,
		base_name,fish,bilet,glubina,boat,ploschad,contacts,
		road,full_text FROM base_fish WHERE oblast_map=\''.$oblast.'\';';
	/*$sql = "SELECT id,id_user,data,coordinats,adress,country_map,oblast_map,
		base_name,fish,bilet,glubina,boat,ploschad,contacts,
		road,full_text FROM base_fish WHERE id_user=$userid";
	$sql = "SELECT id,id_user,data,coordinats,adress,country_map,oblast_map,
		base_name,fish,bilet,glubina,boat,ploschad,contacts
		FROM base_fish WHERE id_user=$userid";*/
		
	$result = $MySQLsel->QuerySelect($sql);
	
	while($res = mysql_fetch_array($result)){
	$main_content.='<div class="fon"><p><a href="/base/oblast/'.$res['oblast_map'].'">'.$res['id'].'</a> |</p>';
	$main_content.='</div>';
	}mysql_free_result($result);

	


	
	$main_content.='<p>Отобразить все базы и виды сортировки</p><p>Раздел в разработке</p>';

	$main_content.='</section></div>';
?>