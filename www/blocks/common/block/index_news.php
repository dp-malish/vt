<?php
if (!defined('MAIN_FILE')){exit;}
//last_article
$index_news=$Cash->IsSetCacheFile(172800,'index_news.html');
if($index_news=='0'){
$Cash->StartCache();//Старт кешика
$sql="SELECT links,caption,index_text,data FROM zzz_news ORDER BY id DESC LIMIT 1";
$result=$MySQLsel->QuerySelect($sql);
$index_news='<div class="fon"><div class="fon_head"><h4>Последние новости:</h4></div>';
while($res = mysql_fetch_array($result)){
	$res_date_m=substr($res["data"],4,4);
	$res_date_d=substr($res["data"],8,2);
	$res_date_y=substr($res["data"],2,2);
	$res_date=$res_date_d.$res_date_m.$res_date_y.'г';
$index_news.='<div class="ind_news"><div><h4 class="align-center">'.$res["caption"].'</h4>'.$res["index_text"].'</div><div class="cl"></div>
<div>&nbsp;&nbsp;&nbsp;<a href="/news/'.$res["links"].'">Узнать подробнее...</a><div class="ind_news_data align-center fr">'.$res_date.'</div></div></div><div class="cl"></div>';
}mysql_free_result($result);
$index_news.='</div>';
echo $index_news;
$Cash->StopCache('index_news.html');
}
?>