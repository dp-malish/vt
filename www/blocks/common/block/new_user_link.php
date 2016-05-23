<?php
if (!defined('MAIN_FILE')){exit;}

//new user
$new_user=$Cash->IsSetCacheFile(1100,'new_user_link.html');

if($new_user == '0'){
$Cash->StartCache();//Старт кешика
$sql = "SELECT userid, username, joindate, usergroupid, displaygroupid FROM user ORDER BY userid DESC LIMIT 7";
$new_user='<div class="fon"><div class="fon_head"><h4>Новые пользователи:</h4></div><table class="forum_user">';
$result = $MySQLsel->QuerySelect($sql);
while($res = mysql_fetch_array($result)){
	$res_date=date(DATE_ATOM, $res["joindate"]);
	$res_date_m=substr($res_date, 4, 4);
	$res_date_d=substr($res_date, 8, 2);
	$res_date_y=substr($res_date, 2, 2);
	$res_date=$res_date_d.$res_date_m.$res_date_y.'г';
$new_user.='<tr><td class="td_linc"><a href="http://forum.vt-fishing.com.ua/members/user-'.$res["userid"].'/" target="_blank">'.$res["username"].'</a></td><td class="td_date  align-center">'.$res_date.'</td></tr>';
}mysql_free_result($result);
$new_user.='</table></div>';
echo $new_user;
$Cash->StopCache('new_user_link.html');
}
?>