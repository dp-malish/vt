<?php
if (!defined('MAIN_FILE')){exit;}
$table_name='fish_article';

//$jscript.='';$css='';

try{if($count_uri_parts > 2){throw new Exception();}else{
	
	if(!isset($uri_parts[1])){//links_name,
	$sql = "SELECT title,meta_d,meta_k,caption,left_part,main_part,right_part
FROM $table_name ORDER BY id DESC LIMIT 1";
	$result = $MySQLsel->QuerySelect($sql);$res = mysql_fetch_array($result);
		if($res["title"]==''){include($root.'/blocks/fish/bad_content_404.'.$phpEx);
		}else{
		$title.=$res['title'];$title.=' - Рыбацкий портал';		
		$description=$res['meta_d'];$keywords=$res['meta_k'];
		$left_content.=$res['left_part'];
		$main_content.='<div class="fon"><article><h2>'.$res["caption"].'</h2>'.$res["main_part"].'<div class="clear"></div></article></div>';
		$right_content.=$res['right_part'];
		mysql_free_result($result);
		}
	}
//*********************************
//****//Вывод каждой статьи по одной ссылке//****//
	if(isset($uri_parts[1]) && !isset($uri_parts[2])){
		
		$link=htmlspecialchars($uri_parts[1], ENT_QUOTES);

		if(preg_match("/[^A-z0-9,-]+/",$link)){$error_link =1;}

		if($error_link != 1){
$sql = "SELECT title,meta_d,meta_k,caption,left_part,main_part,right_part
FROM $table_name WHERE links_child='$link'";
		$result = $MySQLsel->QuerySelect($sql);$res = mysql_fetch_array($result);
		
		if($res["title"]==''){include($root.'/blocks/school/bad_content_404.'.$phpEx);
		}else{
		$title.=$res['title'];$title.=' - Рыбацкий портал';$description=$res['meta_d'];$keywords=$res['meta_k'];
		$left_content.=$res['left_part'];
		$main_content.='<div class="fon"><article><h2>'.$res["caption"].'</h2>'.$res["main_part"].'<div class="clear"></div></article></div>';
		$right_content.=$res['right_part'];
		mysql_free_result($result);
		}
		}else{include($root.'/blocks/fish/bad_content_404.'.$phpEx);}
	}
//****//Вывод каждой статьи  по одной ссылке конец//****//
//*********************************
}//else $count_uri_parts
} catch(Exception $e){$index=true;$module = '404';}
?>