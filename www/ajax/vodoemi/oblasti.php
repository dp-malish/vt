<?php
header("Content-type: text/html; charset=UTF-8");

define('ROOT',$_SERVER['DOCUMENT_ROOT']);
set_include_path(ROOT.PATH_SEPARATOR.ROOT.'/lib');spl_autoload_extensions('_class.php');spl_autoload_register();

Error_Reporting(E_ALL & ~E_NOTICE);//средний уровень ошибки
ini_set('display_errors',1);

$Cash=new Cache_File();

$main_content=$Cash->IsSetCacheFileTime(604800,'try.html');
if(!$main_content){
    $DB=new SQLi();
    $sql='SELECT id,base_name,coordinats,contacts FROM vodoemi WHERE oblast_map="Запорожская область"';
    $res=$DB->arrSQL($sql);
    if($res){
        $main_content='<script type="text/javascript">map.style.minHeight="250px";map.style.maxHeight="650px";ymaps.ready(init);var myMap,myPlacemark;function init(){';
        $placemark='';
        foreach($res as $key=>$val){
            if(!isset($coordinats)){$coordinats=$val['coordinats'];}
            $base_name=mb_convert_case($val['base_name'],MB_CASE_LOWER,"UTF-8");
            ($val['contacts']!=''?$contacts=$val['contacts']:$contacts='не указаны');
            $placemark.='myPlacemark=new ymaps.Placemark(['.$val['coordinats'].'],{hintContent:\''.$val['base_name'].'\',balloonContentHeader:\''.$val['base_name'].'\',balloonContent:\'<a href="/водоёмы/'.$val['id'].'-'.str_replace(" ","-",$base_name).'">узнать подробнее</a>\',balloonContentFooter:\'Контакты: '.$contacts.'\'});myMap.geoObjects.add(myPlacemark);';
        }
        $map='myMap=new ymaps.Map(\'map\',{center:['.$coordinats.'],zoom:8,controls:[\'rulerControl\',\'fullscreenControl\',\'zoomControl\',\'typeSelector\']});';

        $main_content.=$map.$placemark.'}</script>';
        $Cash->StartCache();
        echo $main_content;
        $Cash->StopCacheWithOut('try.html');
    }
}else{echo $main_content;}