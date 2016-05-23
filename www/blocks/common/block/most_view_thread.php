<?php
if (!defined('MAIN_FILE')){exit;}

//top_poster
$most_view_thread=$Cash->IsSetCacheFile(3600,'most_view_thread.html');

if($most_view_thread == '0'){
$Cash->StartCache();//Старт кешика
$sql = "SELECT threadid, title, views FROM thread ORDER BY views DESC LIMIT 7";
$most_view_thread='<div class="fon"><div class="fon_head"><h4>Топовые темы форума:</h4></div><table class="forum_user">';
$result = $MySQLsel->QuerySelect($sql);
while($res = mysql_fetch_array($result)){
	if(iconv_strlen($res["title"],'UTF-8')>32){
	$res_title=mb_substr($res["title"], 0, 31,'utf-8');$res_title.='...';
	}else{$res_title=$res["title"];}
$most_view_thread.='<tr><td class="td_linc align-center"><a href="http://forum.vt-fishing.com.ua/showthread.php?t='.$res["threadid"].'" title="'.$res["title"].'">'.$res_title.'</a></td><td class="td_date align-center">'.$res["views"].'</td></tr>';
}mysql_free_result($result);
$most_view_thread.='</table></div>';
echo $most_view_thread;
$Cash->StopCache('most_view_thread.html');
}
?>