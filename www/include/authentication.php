<?php
if (!defined('MAIN_FILE')){exit;}
define('COOKIE_SALT', 'ruT5Pjv6TOXdc4zMGVXdp7GmINV');
//define('TIMENOW', time());
//************************************************
//************************************************
$error_form=0;
$live_user=0;
//***************************
if(isset($_COOKIE['bb_userid']) && isset($_COOKIE['bb_password'])){
$login=htmlspecialchars($_COOKIE['bb_userid'], ENT_QUOTES);
if(preg_match("/[^0-9]+/",$login)){$error_form =1;}
$pass=htmlspecialchars($_COOKIE['bb_password'], ENT_QUOTES);
if(preg_match("/[^A-z0-9]+/",$pass)){$error_form =1;}

	if($error_form == 0){
	$sql = 'SELECT userid, usergroupid, membergroupids, infractiongroupids, username, password, salt FROM user WHERE userid ='.$login;
	$result = $MySQLsel->QuerySelect($sql);
	$res = mysql_fetch_array($result);
	$hash_res=md5($res['password'].COOKIE_SALT);
		if($hash_res == $pass){$live_user=1; $username=$res['username']; $userid=$res['userid'];}
	}
}//***************************

if($live_user < 1){
//хеш юзать
	if(isset($_COOKIE['bb_sessionhash'])){
	$ses_hash=htmlspecialchars($_COOKIE['bb_sessionhash'], ENT_QUOTES);
	if(preg_match("/[^A-z0-9]+/",$ses_hash)){$error_form =1;}

		if($error_form == 0){
		$sql = 'SELECT session.sessionhash AS sessionhash, user.username AS username, user.userid AS userid, user.salt AS salt
		FROM session AS session JOIN user AS user ON(session.userid = user.userid) 
		WHERE session.loggedin <> 0
		AND session.host = \'' . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . '\' 
		AND session.sessionhash = \'' . mysql_real_escape_string($_COOKIE['bb_sessionhash']) . '\'';
		$result = $MySQLsel->QuerySelect($sql);
		$res = mysql_fetch_array($result);		
		//допилить 
			if($ses_hash == $res['sessionhash']){$live_user=1; $username=$res['username']; $userid=$res['userid'];}
		}
	}
}//***************************
if($live_user==1){
	if(isset($_GET['do'])){
	$exit=Validator::html_cod($_GET['do']);
		if($exit=='logout'){//выйти надо
		$end_time_cookie = mktime(0,0,0,1,1,2015);
		setcookie("bb_userid","",$end_time_cookie, '/', '.'.$site);
		setcookie("bb_password","",$end_time_cookie, '/', '.'.$site);
		setcookie("bb_sessionhash","",$end_time_cookie, '/', '.'.$site);
		$live_user=0;
		}
	}
}else{
	if(isset($_POST['login']) && isset($_POST['pass'])){
	$login=Validator::html_cod($_POST['login']);
	$pass=Validator::html_cod($_POST['pass']);
	if(preg_match("/[^0-9А-Яа-яЁёa-zA-Z]+/u",$login)){$error_form =1;}
	if(preg_match("/[^0-9А-Яа-яЁёa-zA-Z]+/u",$pass)){$error_form =1;}
	$bad_login_form='<p>'.$login.'<br>'.$error_form.'</p>';
		if($error_form !=1){$_SESSION['kol_vo']++;
			if($_SESSION['kol_vo'] < 20){
				$sql = 'SELECT userid, username, password, salt FROM user WHERE username =\''. mysql_real_escape_string($login).'\'';
				$result = $MySQLsel->QuerySelect($sql);
				$res = mysql_fetch_array($result);
					if($res["userid"]==''){
						$bad_login_form='<p>Неверное имя пользователя или пароль</p>';
					}else{
						$pass=md5($pass);$pass=md5($pass.$res["salt"]);
						if($res["password"]==$pass){
						//всё гуд
						$live_user=1; $username=$res['username']; $userid=$res['userid'];
						//ОТПРАВИТЬ КУКИ  18144000; 30 дней
						$hash_pass=md5($res['password'].COOKIE_SALT);
						setcookie("bb_userid",$userid,time()+18144000, '/', '.'.$site);
						setcookie("bb_password",$hash_pass,time()+18144000, '/', '.'.$site);
						unset($_SESSION['kol_vo']);
						}else{$bad_login_form='<p>Неверное имя пользователя или пароль</p>';}
					}
			}
		}	
	}
}//***************************
/*
if($live_user==1){
//$user['securitytoken_raw'] = sha1($user['userid'] . sha1($user['salt']) . sha1(COOKIE_SALT));
$user_out=md5($res['userid'].md5($res['salt']).md5(COOKIE_SALT));
//$user['securitytoken'] = TIMENOW . '-' . sha1(TIMENOW . $user['securitytoken_raw']);
$user_out=TIMENOW . '-' . md5(TIMENOW.$user_out);

$right_content.='<a href="http://forum.vt-fishing.com.ua/login.php?do=logout&logouthash='.$user_out.'">Выход</a>';
}
*/
if($live_user==1){$top_nav_r='<div id="hello_user"><ul class="float-right"><li><a href="http://forum.vt-fishing.com.ua/members/user-'.$login.'/" target="_blank" >Добро пожаловать, '.$username.'</a></li><li><a href="http://forum.vt-fishing.com.ua/usercp.php" >Кабинет</a></li><li><a href="/?do=logout" >Выход</a></li></ul></div>';
}else{$top_nav_r='<div id="no_user"><ul class="float-right"><li><a href="http://forum.vt-fishing.com.ua/faq.php" >Помощь</a></li><li><a href="http://forum.vt-fishing.com.ua/register.php" >Регистрация</a></li></ul></div>';
}
?>