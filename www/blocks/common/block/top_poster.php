<?php
if (!defined('MAIN_FILE')){exit;}

//top_poster
$top_poster=$Cash->IsSetCacheFile(3600,'top_poster.html');

if($top_poster == '0'){
$Cash->StartCache();//Старт кешика
$sql = "SELECT userid,username,posts,usergroupid,displaygroupid FROM user ORDER BY posts DESC LIMIT 7";
$top_poster='<div class="fon"><div class="fon_head"><h4>Лучшие авторы:</h4></div><table class="forum_user">';
$result = $MySQLsel->QuerySelect($sql);
while($res = mysql_fetch_array($result)){
$top_poster.='<tr><td class="td_linc align-left"><a href="http://forum.vt-fishing.com.ua/members/user-'.$res["userid"].'/">'.$res["username"].'</a></td><td class="td_date align-center">'.$res["posts"].'</td></tr>';
}mysql_free_result($result);
$top_poster.='</table></div>';
echo $top_poster;
$Cash->StopCache('top_poster.html');
}
?>