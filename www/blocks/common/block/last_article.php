<?php
if (!defined('MAIN_FILE')){exit;}
$last_article=$Cash->IsSetCacheFile(400000,'last_article.html');
if($last_article=='0'){$Cash->StartCache();
$sql="SELECT links,title,level,data FROM zzz_article ORDER BY id DESC LIMIT 5";
$last_article='<div class="fon"><div class="fon_head"><h4>Последние статьи:</h4></div><table class="forum_user">';
$result = $MySQLsel->QuerySelect($sql);
while($res = mysql_fetch_array($result)){
	$res_date_m=substr($res["data"], 4, 4);$res_date_d=substr($res["data"], 8, 2);$res_date_y=substr($res["data"], 2, 2);$res_date=$res_date_d.$res_date_m.$res_date_y.'г';
$last_article.='<tr><td class="td_linc align-left"><a href="/article/'.$res["links"].'">'.$res["title"].'</a></td><td class="td_date align-center">'.$res_date.'</td></tr>';
}mysql_free_result($result);
$last_article.='</table></div>';echo $last_article;
$Cash->StopCache('last_article.html');
}?>