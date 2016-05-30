<?php
if(!defined('MAIN_FILE')){exit;}
$title='Спиннингова ловля - Школа рыболова';
$description='Школа рыболова – ваш проводник в мире спиннинговой ловли! В этом разделе можно получить исчерпывающую информацию относительно любого вида спиннинговой ловли.';
$keywords='спиннинговая ловля, ';
$table_name='school_spin';
$img_dir='school_spin';
try{if($count_uri_parts>2){throw new Exception();}else{
if(!isset($uri_parts[1])){$page=1;include $root.'/modul/l/school/str_navigat.php';
$main_content.='<article><h2>Спиннингова ловля</h2><div class="fon"><article><h3>Школа рыболова – ваш проводник в мире спиннинговой ловли!</h3><p>В этом разделе можно получить исчерпывающую информацию относительно любого вида спиннинговой ловли. Вы узнаете об уловистых приманках и способах их анимации (проводки). Здесь наши спортсмены и просто опытные спиннингисты поделятся своими наблюдениями относительно выбора «клёвого» места.</p><p>Мы совершенно добровольно поведаем о секретах спиннинга и откроем все известные нам тайны…</p><p>Ни в коей мере не преуменьшая прелестей карповой, фидерной и поплавочной ловли можно смело утверждать, что <strong>спиннинговая ловля</strong> – самая активная, самая мобильная, самая «адреналиновая». Момент атаки хищника вполне возможно ощутить непосредственно рукой, а нередко даже и видеть!</p><p>Под словом «спиннинг» у нас почему-то принято понимать <strong>удилище для спиннинга</strong>, хотя в остальном мире спиннинг – способ ловли. Как выбрать <strong>спиннинговые удилища</strong>? Заходите – узнаете!</p><p>Практически всегда применяется искусственная приманка и от её типа и способа её применения спиннинговую ловлю принято условно делить на несколько видов:</p><p>1. <strong>Джиговая ловля</strong> – использование мягких пластиковых приманок (в основном), оснащенных крючком и огрузкой, с проводкой их чередующимися подёргиваниями (подыгрываниями), почти всегда с касанием дна.</p><p>2. <strong>Блеснение</strong> – ловля с применением блесны. Это почти всегда изделие из полоски металла (существуют варианты), оснащенное одним или несколькими крючками, и проводимое в толще воды с использованием его планирующих свойств.</p><p>3. <strong>Ловля на воблеры</strong> – применение в качестве приманки более или менее правдоподобных копий кормовой рыбки. Они изготавливаются из дерева или пластмассы, имеют внутреннюю неизменную огрузку и оснащаются одним или несколькими крючками.</p><p>Рыболов, занимающийся спиннингом, сам в чём-то уподобляется хищнику. Найти, выследить, обхитрить, поймать… Попробуйте, а мы поможем!</p></article></div>'.$search_content.'<div class="fon cl">'.$navigation.'</div></article>';
}//*****
if(isset($uri_parts[1]) && !isset($uri_parts[2])){
	if(!$bad_link){
		if(!preg_match("/^[0-9а-яёa-z\-]+$/u",$uri_parts[1])){$bad_link=1;}else{
			if(preg_match("/^[0-9]+$/u",$uri_parts[1])){
			//цифры
			$page=$uri_parts[1];include $root.'/modul/l/school/str_navigat.php';
			$main_content.='<section><h2>Спиннингова ловля</h2><div class="fon">'.$navigation.'<div class="cl"></div></div>'.$search_content.'<div class="fon cl">'.$navigation.'</div>'.'</section>';
			}else{
			$link=mysql_real_escape_string($uri_parts[1]);
$sql='SELECT link,title,meta_d,meta_k,caption,img,img_alt,img_title,full_text,right_part,author FROM '.$table_name.' WHERE link=\''.$link.'\'';
$result=$MySQLsel->QuerySelect($sql);$res=mysql_fetch_array($result);
	if($res['title']!=''){
	$title=$res['title'].' - '.$title;
	$description=$res['meta_d'];
	$keywords.=$res['meta_k'];
	if($res['img']!=''){$img='<img class="fl five img_link" src="/img/'.$img_dir.'/dbpic.php?id='.$res['img'].'" alt="'.$res['img_alt'].'" title="'.$res['img_title'].'">';}else{$img='';}
	if($res['right_part']!=''){$right_content='<div class="fon">'.$res['right_part'].'<div class="cl"></div></div>';}else{$right_content='';}
	if($res['author']!=''){$author='<p class="ar">Автор статьи '.$res['author'].'</p>';}else{$author='';}
	$main_content.='<article><div class="fon"><h4>Спиннингова ловля</h4><article><h3>'.$res['caption'].'</h3><div class="cl"></div><p><a href="/'.$uri_parts[0].'/" onclick="button_back(\'воблеры/\');return false;" rel="nofollow">&#9668;&mdash;</a><br></p>'.$img.$res['full_text'].$author.'<p><a href="/'.$uri_parts[0].'/" onclick="button_back(\'воблеры/\');return false;" rel="nofollow">&#9668;&mdash; Вернуться в меню «Спиннингова ловля»</a></p></article><div class="cl"></div></div></article>';
}else{$bad_link=1;}//$res['title']
			}
		}//preg_match
	}
	if($bad_link){$module='404';}
}//*****
}//else $count_uri_parts
}catch(Exception $e){$module='404';}?>