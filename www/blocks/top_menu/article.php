<?php
if (!defined('MAIN_FILE')){exit;}
//**Head site ***статьи про рыбалку
$title='Статьи о рыбалке';
$description='Статьи о рыбалке. Для начинающих рыбаков и профессионалов';
$keywords='Статьи о рыбалке,статьи,статьи про рыбалку';
//$jscript.='';
//$css.='<link rel="stylesheet" type="text/css" href="/css/top_links.css" media="screen,projection">';
//**Head site End
try{
if ($count_uri_parts > 3){throw new Exception();
}else{
if(!isset($uri_parts[1])){$uri_parts[1]='section';$uri_parts[2]=1;}
//*********************************
//****//vivod kaghdoy statti//****//
	if(isset($uri_parts[1]) && !isset($uri_parts[2])){
	$sql = "SELECT links,meta_d,meta_k,title,caption,level,data,full_text FROM zzz_article WHERE links='$uri_parts[1]'";
	$result = $MySQLsel->QuerySelect($sql);
	$res = mysql_fetch_array($result);

		if($res["links"]==''){
		$main_content.='<section><h2>Статьи</h2><div class="fon"><div class="text_article align-center">Вы пытаетесь загрузить несуществующую страницу.<br>Пожалуйста, убедитесь, что ссылка указанна правильно!<br><a href="/article">Последуйте к перечню статей...</a></div></div></section><script type="text/javascript">setTimeout(\'location.replace("/article")\', 5000);</script>';
	
		}else{
		$title=$res['title'];
		$description=$res['meta_d'];
		$keywords=$res['meta_k'];
		$main_content.='<div class="fon"><article><h2>'.$res["caption"].'</h2><div class="rel"><div class="float-left data">Рейтинг материала: <div class="level '.$res["level"].'"></div></div><div class="float-right data">Дата публикации: '.$res["data"].'</div></div><div class="clear"></div><div class="text_article">&nbsp;&nbsp;'.$res["full_text"].'</div><div class="clear"></div><div class="to_link"><a href="/article" onclick="button_back(\'article\');return false;">Вернуться к статьям</a></div></article></div><div class="clear"></div>';		
		mysql_free_result($result);
		}
}
//****//End vivod kaghdoy statti End//***//
//*********************************

if(isset($uri_parts[1]) && isset($uri_parts[2])){
//*********************************
//****//block po sranicam//****//
	if (preg_match("/[^0-9]+/", $uri_parts[2])) {
	$index=true;
	}else{
	$msg=3; //kol-vo statey
	$page=(int)$uri_parts[2]; //get $page
	$sql="SELECT COUNT(id) FROM zzz_article";
	$result = $MySQLsel->QuerySelect($sql);
	$str=mysql_result($result,0);
	$total=(int)(($str - 1) / $msg) + 1;
	$start=$page * $msg - $msg;
//*********************************

//*********************************
//****//block vivoda navigatsii//****//
	$nav_page='<div class="article_nav align-center rel"><nav><a href="/article" title="Перейти на первую страницу"><div class="art_nav_page outpage float-left';
	if ($page == 1) $nav_page.=' selected';
	$nav_page.='">В начало</div></a><a href="/article';
	$l_page=$page-1;
	if($l_page > 1){$nav_page.='/section/'.$l_page;}
	if($l_page == 0){$sel=' selected';}
	$nav_page.='" title="Перейти на предыдущую страницу"><div class="art_nav_page centerpage float-left'.$sel.'">&lt;&lt;&lt;</div></a><a href="/article/section/'.$total.'" title="Перейти на последнюю страницу">';
	if($page ==$total){$sel_2=' selected';}
	$nav_page.='<div class="art_nav_page outpage float-right'.$sel_2.'">В конец</div></a><a href="/article/section/';
	$r_page=$page+1;
	if($r_page > $total){$sel_3=' selected';}
	$nav_page.=$r_page.'" title="Перейти на следующую страницу"><div class="art_nav_page centerpage float-right'.$sel_3.'">&gt;&gt;&gt;</div></a><div class="clear"></div></nav></div>';
	// End block vivoda navigatsii End
//*********************************

	$main_content.=$nav_page;

//if page > total!!!!!!!!!!!!!!!!!!!
/**/		if($page > $total){
		$main_content.='<section><h2>Статьи</h2><div class="fon"><div class="text_article align-center">Вы пытаетесь загрузить несуществующую страницу.<br>Пожалуйста, убедитесь, что ссылка указанна правильно!<br><a href="/article">Последуйте к перечню статей...</a></div></div></section><script type="text/javascript">setTimeout(\'location.replace("/article")\', 5000);</script>';
		}else{
//******************************************
//****//bloki statey//****//
$main_content.='<section><h2>Статьи</h2>';
$sql = "SELECT links,caption,level,data,short_text FROM zzz_article ORDER BY id DESC LIMIT $start, $msg";
$result = $MySQLsel->QuerySelect($sql);
while($res = mysql_fetch_array($result)){
$main_content.='<div class="fon"><article><h2>'.$res["caption"].'</h2><div class="rel"><div class="float-left data">Рейтинг материала: <div class="level '.$res["level"].'"></div></div><div class="float-right data">Дата публикации: '.$res["data"].'</div></div><div class="clear"></div><div class="text_article">&nbsp;&nbsp;'.$res["short_text"].'</div><div class="to_link"><nav><a href="/article/'.$res["links"].'">Читать подробнее</a></nav></div></article></div>';
}mysql_free_result($result);
$main_content.='</section>';
//****////****//
//******************************************
$main_content.=$nav_page;
			}
		}
}
$title.= ' - Школа рыболова';
}//else
}catch(Exception $e){$index=true;$module='404';}
?>