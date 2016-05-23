<?php
header("Content-type: text/txt; charset=UTF-8");
include($_SERVER['DOCUMENT_ROOT'].'/lib/sql_select_class.php');$MySQLsel= new SQL_select();
//forum статистика
$sql = "SELECT thread.threadid AS link_main, thread.title AS link_main_title,
thread.lastposter AS user_name,thread.lastposterid AS user_id,
thread.lastpost AS last_date,
thread.forumid AS forum_id,
thread.replycount AS answer,
thread.views AS views,
forum.title AS forum
FROM thread LEFT OUTER JOIN forum ON thread.forumid = forum.forumid
WHERE thread.forumid NOT IN (0) AND thread.visible = 1 AND thread.lastpostid > 0 ORDER BY thread.lastpost DESC LIMIT 8";
$main_content.='<div class="fon stat_forum"><div class="fon_head"><h4>Последние сообщения форума:</h4></div><table class="align-center"><tr><td>Тема</td><td>Дата</td><td>Автор</td><td>Отв.</td><td>Просм.</td><td>Форум</td></tr>';
$result = $MySQLsel->QuerySelect($sql);
while($res = mysql_fetch_array($result)){
	if(iconv_strlen($res["link_main_title"],'UTF-8')>28){
	$res_forum_tema=mb_substr($res["link_main_title"],0,27,'utf-8');$res_forum_tema.='...';
	}else{$res_forum_tema=$res["link_main_title"];}	
	$res_date=date(DATE_ATOM,$res["last_date"]);
	$res_date_m=substr($res_date,4,3);$res_date_d=substr($res_date,8,2);$res_date_h=substr($res_date,11,5);$res_date=$res_date_d.$res_date_m.', '.$res_date_h;
	if(iconv_strlen($res["forum"],'UTF-8')>22){
	$res_forum=mb_substr($res["forum"],0,21,'utf-8');$res_forum.='...';
	}else{$res_forum=$res["forum"];}
$main_content.='<tr><td><a href="http://forum.vt-fishing.com.ua/showthread.php?t='.$res["link_main"].'" title="'.$res["link_main_title"].'" target="_blank">'.$res_forum_tema.'</a></td><td>'.$res_date.'</td><td><a href="http://forum.vt-fishing.com.ua/members/user-'.$res["user_id"].'/" target="_blank">'.$res["user_name"].'</a></td><td>'.$res["answer"].'</td><td>'.$res["views"].'</td><td><a href="http://forum.vt-fishing.com.ua/forumdisplay.php?f='.$res["forum_id"].'" title="'.$res["forum"].'" target="_blank">'.$res_forum.'</a></td></tr>';
}mysql_free_result($result);$main_content.='</table></div>';
//Далее gzip
$HTTP_ACCEPT_ENCODING = $_SERVER["HTTP_ACCEPT_ENCODING"]; 
if(strpos($HTTP_ACCEPT_ENCODING,'x-gzip')!==false)$encoding='x-gzip';
else if(strpos($HTTP_ACCEPT_ENCODING,'gzip')!==false)$encoding='gzip';
else $encoding=false;
if($encoding){$l_str=strlen($main_content);
if($l_str>2048){header('Content-Encoding: '.$encoding);echo("\x1f\x8b\x08\x00\x00\x00\x00\x00");$main_content=gzcompress($main_content,3);
}}echo $main_content;
?>