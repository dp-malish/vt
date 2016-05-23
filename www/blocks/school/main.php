<?php
if (!defined('MAIN_FILE')){exit;}
$cache_time=604800;
try{if($count_uri_parts>4){throw new Exception();}else{
	if(!isset($uri_parts[1])){header('HTTP/1.1 301 Moved Permanently');header('Location: http://'.$site.'/школа-рыболова');exit();}
//*********************************
//****//Вывод каждой статьи по одной ссылке//****//
	if(isset($uri_parts[1]) && !isset($uri_parts[2])){
	//school/spinningovaya-lovlya
	if($uri_parts[1]=='spinningovaya-lovlya'){
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: http://'.$site.'/спиннинговая-ловля/');exit();}
	$sql="SELECT extension,title,meta_d,meta_k,caption,left_part,main_part,right_part FROM $table_name WHERE links='".mysql_real_escape_string($uri_parts[1])."' AND links_child is NULL AND links_grandson is NULL";
		$result = $MySQLsel->QuerySelect($sql);$res = mysql_fetch_array($result);
		if($res["title"]==''){include($root.'/blocks/school/bad_content_404.'.$phpEx);
		}else{
		$title.=$res['title'];$description=$res['meta_d'];$keywords=$res['meta_k'];
		$left_content.=$res['left_part'];
		$main_content.='<div class="fon"><article><h2>'.$res["caption"].'</h2>'.$res["main_part"].'<div class="clear"></div></article></div>';
		$right_content.=$res['right_part'];
		mysql_free_result($result);
		}
				if($res['extension'] == 1){
				$temp_menu_name=$table_name.'_'.$uri_parts[1];//имя кеш файла
				$temp=$Cash->IsSetCacheFile($cache_time,$temp_menu_name.'.html');
					if($temp){$left_content=$temp.$left_content;
					}else{include($root.'/blocks/menu/extension1_menu.'.$phpEx);}
				}//end extension 1
				if($res['extension'] == 3){
				$temp_menu_name=$table_name.'_'.$uri_parts[1];//имя кеш файла
				$temp=$Cash->IsSetCacheFile($cache_time,$temp_menu_name.'.html');
					if($temp){$left_content=$temp.$left_content;
					}else{include($root.'/blocks/menu/abc_extension3_menu.'.$phpEx);}
				}//end extension 3
	}
//****//Вывод каждой статьи  по одной ссылке конец//****//
//*********************************
//****//Вывод каждой статьи по две ссылке//****//
	if(isset($uri_parts[1]) && isset($uri_parts[2]) && !isset($uri_parts[3])){
		$sql = "SELECT extension,title,meta_d,meta_k,caption,left_part,main_part,right_part FROM $table_name WHERE links='".mysql_real_escape_string($uri_parts[1])."' AND links_child='".mysql_real_escape_string($uri_parts[2])."' AND links_grandson is NULL";
		$result = $MySQLsel->QuerySelect($sql);$res = mysql_fetch_array($result);
		if($res["title"]==''){include($root.'/blocks/school/bad_content_404.'.$phpEx);
		}else{
		$title.=$res['title'];$description=$res['meta_d'];$keywords=$res['meta_k'];
		$left_content.=$res['left_part'];
		$main_content.='<section><div class="fon"><article><h2>'.$res["caption"].'</h2>'.$res["main_part"].'<div class="clear"></div></article></div></section>';
		$right_content.=$res['right_part'];
		mysql_free_result($result);
		}
			if($res['extension'] == 2){
			$temp_menu_name=$table_name.'_'.$uri_parts[1].'_'.$uri_parts[2];//имя кеш файла
			$temp=$Cash->IsSetCacheFile($cache_time,$temp_menu_name.'.html');
				if($temp){$left_content=$temp.$left_content;
				}else{include($root.'/blocks/menu/extension2_menu.'.$phpEx);}
			}//end extension 2

	}
//****//Вывод каждой статьи  по две ссылке конец//****//
//*********************************
//****//Вывод каждой статьи по три ссылке//****//
	if(isset($uri_parts[1]) && isset($uri_parts[2]) && isset($uri_parts[3])){
		
		if($uri_parts[2] =='category'){
			$sql = "SELECT title,meta_d,meta_k,caption,left_part,main_part,right_part FROM $table_name WHERE links='".mysql_real_escape_string($uri_parts[1])."' AND links_grandson='".mysql_real_escape_string($uri_parts[3])."';";
			$result = $MySQLsel->QuerySelect($sql);$res = mysql_fetch_array($result);	
			if($res["title"]==''){include($root.'/blocks/school/bad_content_404.'.$phpEx);
			}else{
			$title.=$res['title'];$description=$res['meta_d'];$keywords=$res['meta_k'];
			$left_content.=$res['left_part'];
			$main_content.='<section><div class="fon"><article><h2>'.$res["caption"].'</h2>'.$res["main_part"].'<div class="clear"></div></article></div></section>';
			$right_content.=$res['right_part'];
			mysql_free_result($result);
			}
			//левое меню child
				$temp_menu_name=$table_name.'_'.$uri_parts[1];//имя кеш файла
				$temp=$Cash->IsSetCacheFile($cache_time,$temp_menu_name.'.html');
					if($temp){$left_content=$temp.$left_content;
					}else{include($root.'/blocks/menu/extension1_menu.'.$phpEx);}
		}//if($uri_parts[2] =='category') равно
//********		
		if($uri_parts[2] !='category'){
			$sql = "SELECT title,meta_d,meta_k,caption,left_part,main_part,right_part FROM $table_name WHERE links='".mysql_real_escape_string($uri_parts[1])."' AND links_child='".mysql_real_escape_string($uri_parts[2])."' AND links_grandson='".mysql_real_escape_string($uri_parts[3])."';";
			$result = $MySQLsel->QuerySelect($sql);$res = mysql_fetch_array($result);
			if($res["title"]==''){include($root.'/blocks/school/bad_content_404.'.$phpEx);
			}else{
			$title.=$res['title'];$description=$res['meta_d'];$keywords=$res['meta_k'];
			$left_content.=$res['left_part'];
			$main_content.='<section><div class="fon"><article><h2>'.$res["caption"].'</h2>'.$res["main_part"].'<div class="clear"></div></article></div></section>';
			$right_content.=$res['right_part'];
			mysql_free_result($result);
			}
			//левое меню child
				$temp_menu_name=$table_name.'_'.$uri_parts[1].'_'.$uri_parts[2];//имя кеш файла
				$temp=$Cash->IsSetCacheFile($cache_time,$temp_menu_name.'.html');
				if($temp){$left_content=$temp.$left_content;
				}else{include($root.'/blocks/menu/extension2_menu.'.$phpEx);}
		}//if($uri_parts[2] !='category') не равно
	}
//****//Вывод каждой статьи  по три ссылке конец//****//
//*********************************
}//else $count_uri_parts
} catch(Exception $e){$index=true;$module = '404';}
?>