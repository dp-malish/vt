<?php
define('MAIN_FILE',true);
//++++++++++++++++++++++++++++++++++++++++++++++++++++
$site=$_SERVER['SERVER_NAME'];$root=$_SERVER['DOCUMENT_ROOT'];
$phpEx=substr(strrchr(__FILE__,'.'),1);	
//++++++++++++++++++++++++++++++++++++++++++++++++++++
//error_reporting(E_ALL);//высокий уровень ошибки
Error_Reporting(E_ALL & ~E_NOTICE);//средний уровень ошибки
ini_set('display_errors',1);
//классы в автозагрузке
set_include_path(get_include_path().PATH_SEPARATOR."lib");
spl_autoload_extensions("_class.php");spl_autoload_register();
//классы в автозагрузке end
$MySQLsel=new SQL_select();$Cash=new Cache_File();
require($root.'/include/authentication.'.$phpEx);
require($root.'/blocks/common/block/main_slyder.'.$phpEx);

$js_common='async ';
if($_SERVER['REQUEST_URI']!='/'){
$uri=htmlspecialchars($_SERVER['REQUEST_URI'],ENT_QUOTES);$uri=urldecode($uri);
	try{$url_path=parse_url($uri, PHP_URL_PATH);
		$uri_parts=explode('/',trim($url_path,'/'));
		$count_uri_parts=count($uri_parts);
		if($count_uri_parts>4){throw new Exception();}else{
			$uri_parts0_id=explode('-',$uri_parts[0],2);$count_uri0_parts=count($uri_parts0_id);
			if(isset($uri_parts0_id[0]) && !isset($uri_parts0_id[1])){
			switch($uri_parts[0]){
			/**/
			case 'set':$page_admin='/set';include($root.'/blocks/admin/main.'.$phpEx);break;
//top_menu
			case 'news':include($root.'/blocks/top_menu/news.'.$phpEx);break;
			case 'article':include($root.'/blocks/top_menu/article.'.$phpEx);break;
			case 'contacts':include($root.'/blocks/top_menu/contacts.'.$phpEx);break;
			case 'about':include($root.'/blocks/top_menu/about.'.$phpEx);break;

			case 'обзор':include($root.'/modul/t/obzor/obzor.'.$phpEx);break;
//left_menu
			case 'base':include($root.'/blocks/base/main.'.$phpEx);break;
			case 'school':$table_name=$uri_parts[0];include($root.'/blocks/school/main.'.$phpEx);break;
			
			case 'ультралайт':include($root.'/modul/l/hishnik/ultralite.'.$phpEx);break;
			case 'воблеры':include($root.'/modul/l/hishnik/vobler.'.$phpEx);break;
			case 'блесны':include($root.'/modul/l/hishnik/blesna.'.$phpEx);break;
			
			case 'донка':include($root.'/modul/l/mirnaya/donka.'.$phpEx);break;
//right_menu
			case 'fish':include($root.'/blocks/fish/main.'.$phpEx);break;
			default:$index=true;break;
			}//switch
			}
			if(isset($uri_parts0_id[0]) && isset($uri_parts0_id[1])){
				switch($uri_parts0_id[0]){
			//left_menu
				//Школа рыболова
				case 'спиннинговая':include $root.'/modul/l/school/spin.php';	break;//ловля
				
				case 'зимний':include $root.'/modul/l/zimnyaya/spinning.php';break;//спиннинг
				case 'зимние':include $root.'/modul/l/zimnyaya/snasti.php';break;//снасти
				
				case 'рыбалка':include $root.'/modul/l/polza/zakon.php';break;//и закон
				
				default:include $root.'/modul/def/def.php';
				}
			}
		}//else
	}catch(Exception $e){$module='404';}
}else{$index=true;}
if($module=='404'){header("HTTP/1.0 404 Not Found");header('Location: http://'.$site);exit;}
if($index){
require($root.'/blocks/common/block/index_news.'.$phpEx);
include($root.'/blocks/top_menu/main.'.$phpEx);}
//left - all stranici
require($root.'/blocks/menu/left_menu.'.$phpEx);
//require($root.'/blocks/common/block/google_adsense.'.$phpEx);

require($root.'/blocks/common/block/last_article.'.$phpEx);

//right - all stranici
require($root.'/blocks/menu/fish_menu.'.$phpEx);


if($live_user==1){require($root.'/blocks/common/block/new_user_link.'.$phpEx);}else{require($root.'/blocks/common/block/new_user.'.$phpEx);}

require($root.'/blocks/common/head.'.$phpEx);
require($root.'/blocks/common/header.'.$phpEx);
require($root.'/blocks/common/left_column.'.$phpEx);
require($root.'/blocks/common/right_column.'.$phpEx);
require($root.'/blocks/common/copyright.'.$phpEx);?>