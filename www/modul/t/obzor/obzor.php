<?php
if(!defined('MAIN_FILE')){exit;}
$title='Обзор аксессуаров для рыбалки - Портал о рыбалке';
$description='Обзор аксессуаров для рыбалки. Рассматриваемые темы: ';
$keywords='обзор, аксессуары для рыбалки, ';
$table_name='obzor';
try{if($count_uri_parts>2){throw new Exception();}else{
if(!isset($uri_parts[1])){
	$page=1;include $root.'/modul/t/obzor/str_navigat.php';
	$main_content.='<section><h2>Обзоры</h2><div class="fon">'.$navigation.'<div class="cl"></div><h3>Аксессуары для рыбалки</h3></div>'.$search_content.'<div class="fon cl">'.$navigation.'</div>'.'</section>';
}//*****
if(isset($uri_parts[1]) && !isset($uri_parts[2])){
	if(!$bad_link){
		if(!preg_match("/^[0-9а-яёa-z\-]+$/u",$uri_parts[1])){$bad_link=1;}else{
			if(preg_match("/^[0-9]+$/u",$uri_parts[1])){
			//цифры
			$page=$uri_parts[1];include $root.'/modul/t/obzor/str_navigat.php';
			$main_content.='<section><h2>Обзоры</h2><div class="fon">'.$navigation.'<div class="cl"></div><h3>Аксессуары для рыбалки</h3></div>'.$search_content.'<div class="fon cl">'.$navigation.'</div>'.'</section>';
			}else{
			$link=mysql_real_escape_string($uri_parts[1]);
$sql='SELECT link,title,meta_d,meta_k,caption,img,img_alt,img_title,full_text FROM '.$table_name.' WHERE link=\''.$link.'\'';
$result=$MySQLsel->QuerySelect($sql);$res=mysql_fetch_array($result);
	if($res['title']!=''){
	$title=$res['title'].' - '.$title;
	$description='Обзор рыболовных аксессуаров вместе с школой рыболова. '.$res['meta_d'];
	$keywords='рыболовные аксессуары, '.$res['meta_k'];
	if($res['img']!=''){$img='<img class="fl five img_link" src="/img/obzor/dbjpg.php?id='.$res['img'].'" alt="'.$res['img_alt'].'" title="'.$res['img_title'].'">';}else{$img='';}
	$main_content.='<section><div class="fon"><article><h3>'.$res['caption'].'</h3><div class="cl"></div><p><a href="/'.$uri_parts[0].'/" onclick="button_back(\'обзор/\');return false;" rel="nofollow">&#9668;&mdash;</a><br></p>'.$img.$res['full_text'].'<p><a href="/'.$uri_parts[0].'/" onclick="button_back(\'обзор/\');return false;" rel="nofollow">&#9668;&mdash; Вернуться к меню обзоров</a></p></article><div class="cl"></div></div></section>';
}else{$bad_link=1;}//$res['title']
			}
		}//preg_match
	}
	if($bad_link){$module='404';}
}//*****
}//else $count_uri_parts
}catch(Exception $e){$module='404';}?>