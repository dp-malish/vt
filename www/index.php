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
$MySQLsel=new SQL_select();
$Cash=new Cache_File();

require $root.'/include/authentication.php';
require $root.'/blocks/common/block/main_slyder.php';

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

			case 'set':$page_admin='/set';include $root.'/blocks/admin/main.php';break;
//top_menu
			case 'news':include $root.'/blocks/top_menu/news.php';break;
			case 'article':include $root.'/blocks/top_menu/article.php';break;
			case 'contacts':include $root.'/blocks/top_menu/contacts.php';break;
			case 'about':include $root.'/blocks/top_menu/about.php';break;

			case 'обзор':include $root.'/modul/t/obzor/obzor.php';break;
//left_menu
			case 'водоёмы':$DB=new SQLi();include $root.'/modul/l/vodoem/main.php';break;
			case 'base':include $root.'/blocks/base/main.php';break;
			case 'school':include $root.'/blocks/school/main.php';break;
			
			case 'ультралайт':include $root.'/modul/l/hishnik/ultralite.php';break;
			case 'воблеры':include $root.'/modul/l/hishnik/vobler.php';break;
			case 'блесны':include $root.'/modul/l/hishnik/blesna.php';break;
			
			case 'донка':include $root.'/modul/l/mirnaya/donka.php';break;
//right_menu
			case 'fish':include $root.'/blocks/fish/main.php';break;
			default:$index=true;break;
			}//switch
			}
			if(isset($uri_parts0_id[0]) && isset($uri_parts0_id[1])){
				switch($uri_parts0_id[0]){
			//left_menu
				//Школа рыболова
				case 'спиннинговая':include $root.'/modul/l/school/spin.php';break;//ловля
				
				case 'зимний':include $root.'/modul/l/zimnyaya/spinning.php';break;//спиннинг
				case 'зимние':include $root.'/modul/l/zimnyaya/snasti.php';break;//снасти
				
				case 'рыбалка':include $root.'/modul/l/polza/zakon.php';break;//и закон
				
				default:include $root.'/modul/def/def.php';
				}
			}
		}//else
	}catch(Exception $e){$module='404';}
}else{$index=true;}
if($module=='404'){Route::modul404();}

if($index){
	include $root.'/blocks/common/block/index_news.php';
	include $root.'/blocks/top_menu/main.php';}
//left - all stranici
require $root.'/blocks/menu/left_menu.php';
require $root.'/blocks/common/block/last_article.php';
//require $root.'/blocks/common/block/google_adsense.php';

//right - all stranici
require $root.'/blocks/menu/fish_menu.php';
require $root.'/blocks/common/block/new_user'.($live_user==1?'_link':'').'.php';
//body
require $root.'/blocks/common/head.php';
require $root.'/blocks/common/header.php';
require $root.'/blocks/common/left_column.php';
require $root.'/blocks/common/right_column.php';
require $root.'/blocks/common/copyright.php';