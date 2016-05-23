<?php
if(!defined('MAIN_FILE')){exit;}$title=' - Портал о рыбалке';//$description='';$keywords='';
try{if($count_uri_parts>1){throw new Exception();}else{
if(isset($uri_parts[0])&&!isset($uri_parts[1])){
	if(!preg_match("/^[0-9а-яёa-z\-]+$/u",$uri_parts[0])){$bad_link=1;}else{
	$link=mysql_real_escape_string($uri_parts[0]);
$sql='SELECT link,title,meta_d,meta_k,caption,img,img_alt,img_title,full_text FROM default_content WHERE link=\''.$link.'\'';
	$result=$MySQLsel->QuerySelect($sql);$res=mysql_fetch_array($result);
	if($res['title']!=''){
	$title=$res['title'].$title;
	$description=$res['meta_d'];
	$keywords=$res['meta_k'];
	if($res['img']!=''){$img='<img class="fl five img_link" src="/img/dbpic.php?id='.$res['img'].'" alt="'.$res['img_alt'].'" title="'.$res['img_title'].'">';}else{$img='';}
	$main_content.='<section><div class="fon"><article><h3>'.$res['caption'].'</h3>'.$img.$res['full_text'].'</article><div class="cl"></div></div></section>';
}else{$bad_link=1;}//$res['title']
	}//preg_match
	if($bad_link){$module='404';}
}//*****
}//else $count_uri_parts
}catch(Exception $e){$module='404';}?>