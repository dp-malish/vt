<?php
//$page=1;//надо задавать
$msg=3;//count page for view
$sql='SELECT COUNT(id) FROM '.$table_name;$result=$MySQLsel->QuerySelect($sql);
$str=mysql_result($result,0);
$total=(int)(($str-1)/$msg)+1;$start=$page*$msg-$msg;
//Проверяем нужны ли стрелки назад  
if($page!=1)$pervpage='<a href="/'.$uri_parts[0].'/"><<</a>
<a href="/'.$uri_parts[0].'/'.($page-1).'"><</a> ';
//Проверяем нужны ли стрелки вперед  
if($page!=$total)$nextpage=' <a href="/'.$uri_parts[0].'/'.($page+1).'">></a> <a href="/'.$uri_parts[0].'/'.$total.'">>></a>';
// Находим две ближайшие станицы с обоих краев, если они есть
if($page-4 >0)$page4left='<a href="/'.$uri_parts[0].'/'.($page-4).'">'.($page-4).'</a> | ';
if($page-3 >0)$page3left='<a href="/'.$uri_parts[0].'/'.($page-3).'">'.($page-3).'</a> | ';
if($page-2 >0)$page2left='<a href="/'.$uri_parts[0].'/'.($page-2).'">'.($page-2).'</a> | ';  
if($page-1 >0){$page1left='<a href="/'.$uri_parts[0].'/'.($page-1).'">'.($page-1).'</a> | ';$wiev_nav=1;}
if($page+4 <=$total)$page4right=' | <a href="/'.$uri_parts[0].'/'.($page+4).'">'.($page + 4).'</a>';
if($page+3 <=$total)$page3right=' | <a href="/'.$uri_parts[0].'/'.($page+3).'">'.($page + 3).'</a>';
if($page+2 <=$total)$page2right=' | <a href="/'.$uri_parts[0].'/'.($page+2).'">'.($page+2).'</a>';
if($page+1 <=$total){$page1right=' | <a href="/'.$uri_parts[0].'/'.($page+1).'">'.($page+1).'</a>';$wiev_nav=1;}
//Вывод меню
if($wiev_nav)$navigation='<div class="ac nav_link"><p>'.$pervpage.$page4left.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$page3right.$page4right.$nextpage.'</p></div>';
$sql='SELECT id,link,link_name,title,meta_d,meta_k,caption,
	img_s,img_alt_s,img_title_s,short_text
	FROM '.$table_name.' ORDER BY id DESC LIMIT '.$start.','.$msg;
	$result=$MySQLsel->QuerySelect($sql);
	if($result){while($res=mysql_fetch_array($result)){$i++;
	//$title=$res['title'].$title;
	$description.=$res['link_name'].', ';//добавить все 
	$keywords.=$res['link_name'].', ';
	if($res['img_s']!=''){$img_s='<a href="/'.$uri_parts[0].'/'.$res['link'].'"><img class="fl five img_link" src="/img/obzor/dbjpg.php?id='.$res['img_s'].'" alt="'.$res['img_alt_s'].'" title="'.$res['img_title_s'].' - узнать подробнее..."></a>';}else{$img_s='';}

	$search_content.='<div class="fon"><article>'.$img_s.'<a href="/'.$uri_parts[0].'/'.$res['link'].'"><h4>'.$res['caption'].'</h4></a>'.$res['short_text'].'</article><div class="cl"></div></div>';
//***конец
}}mysql_free_result($result);$description.='подробнее...';$keywords.='подробнее';?>