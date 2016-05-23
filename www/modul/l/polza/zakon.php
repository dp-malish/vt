<?php
if(!defined('MAIN_FILE')){exit;}
$title='Рыбалка и Закон  - Полезно знать';
$description='Рыбалка и Закон. Особенности ловле рыбы на водоёмах. Рассматриваемые темы: ';
$keywords='полезно знать, рыбалка и закон, ';
$table_name='polza_zakon';
$img_dir='polza_zakon';
try{if($count_uri_parts>2){throw new Exception();}else{
if(!isset($uri_parts[1])){
	$page=1;include $root.'/modul/l/hishnik/str_navigat.php';
	$main_content.='<section><h2>Полезно знать</h2><div class="fon">'.$navigation.'<div class="cl"></div><h3>Рыбалка и Закон</h3></div>'.$search_content.'<div class="fon cl">'.$navigation.'</div>'.'</section>';
}//*****
if(isset($uri_parts[1]) && !isset($uri_parts[2])){
	if(!$bad_link){
		if(!preg_match("/^[0-9а-яёa-z\-]+$/u",$uri_parts[1])){$bad_link=1;}else{
			if(preg_match("/^[0-9]+$/u",$uri_parts[1])){
			//цифры
			$page=$uri_parts[1];include $root.'/modul/l/hishnik/str_navigat.php';
			$main_content.='<section><h2>Полезно знать</h2><div class="fon">'.$navigation.'<div class="cl"></div><h3>Рыбалка и Закон</h3></div>'.$search_content.'<div class="fon cl">'.$navigation.'</div>'.'</section>';
			}else{
			$link=mysql_real_escape_string($uri_parts[1]);
$sql='SELECT link,title,meta_d,meta_k,caption,img,img_alt,img_title,full_text,right_part,author FROM '.$table_name.' WHERE link=\''.$link.'\'';
$result=$MySQLsel->QuerySelect($sql);$res=mysql_fetch_array($result);
	if($res['title']!=''){
	$title=$res['title'].' - '.$title;
	$description=$res['meta_d'];
	$keywords='рыбалка и закон, '.$res['meta_k'];
	if($res['img']!=''){$img='<img class="fl five img_link" src="/img/'.$img_dir.'/dbpic.php?id='.$res['img'].'" alt="'.$res['img_alt'].'" title="'.$res['img_title'].'">';}else{$img='';}
	if($res['right_part']!=''){$right_content='<div class="fon">'.$res['right_part'].'<div class="cl"></div></div>';}else{$right_content='';}
	if($res['author']!=''){$author='<p class="ar">Автор статьи '.$res['author'].'</p>';}else{$author='';}
	$main_content.='<section><div class="fon"><h4>Рыбалка и Закон</h4><article><h3>'.$res['caption'].'</h3><div class="cl"></div><p><a href="/'.$uri_parts[0].'/" onclick="button_back(\'рыбалка-и-закон/\');return false;" rel="nofollow">&#9668;&mdash;</a><br></p>'.$img.$res['full_text'].$author.'<p><a href="/'.$uri_parts[0].'/" onclick="button_back(\'рыбалка-и-закон/\');return false;" rel="nofollow">&#9668;&mdash; Вернуться в меню «Рыбалка и Закон»</a></p></article><div class="cl"></div></div></section>';
}else{$bad_link=1;}//$res['title']
			}
		}//preg_match
	}
	if($bad_link){$module='404';}
}//*****
}//else $count_uri_parts
}catch(Exception $e){$module='404';}?>