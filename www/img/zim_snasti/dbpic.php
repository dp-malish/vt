<?php
$DBTable='zim_snasti_img';
if(isset($_GET['id'])){$id=htmlspecialchars($_GET['id'],ENT_QUOTES);
if(preg_match("/[0-9]+$/",$id)){$root=$_SERVER['DOCUMENT_ROOT'];
require $root.'/img/site/utilities/bd.php';
//мобила или нет
if(!isset($_COOKIE['mob'])){$mob=0;$file_part='pc';$mobile_agent_array=array('ipad','iphone','android','pocket','palm','windows ce','windowsce','cellphone','opera mobi','ipod','small','sharp','sonyericsson','symbian','opera mini','nokia','htc_','samsung','motorola','smartphone','blackberry','playstation portable','tablet browser');$agent=strtolower($_SERVER['HTTP_USER_AGENT']);foreach($mobile_agent_array as $value){if(strpos($agent,$value)!==false){$mob=1;$file_part='m';}}setcookie('mob',$mob,time()+28144000,'/','.'.$_SERVER['SERVER_NAME']);}else{$mob=htmlspecialchars($_COOKIE['mob'],ENT_QUOTES);if(!preg_match("/[^0-1]+/",$mob)){($mob)?$file_part='m':$file_part='pc';}else{break;}}
try{$Link=@mysql_connect($Host,$Admin,$Password);@mysql_select_db($DBName,$Link);@mysql_query("SET NAMES utf8");
$sql='SELECT png,content FROM '.$DBTable.' WHERE id =\''.mysql_real_escape_string($id).'\'';
$image=@mysql_query($sql);$result=@mysql_fetch_array($image);
if($result['content']=='')exit();
@mysql_free_result($image);@mysql_close($Link);}catch(Exception $e){}
($result['png']=='1')?header('Content-Type: image/png'):header('Content-Type: image/jpeg');
header('Cache-Control: public, max-age=29030400');
$im=imagecreatefromstring($result['content']);
$x=imagesx($im);$y=imagesy($im);
($x>1000)?$koef_font=27:$koef_font=20;$font_size=(int)($x/$koef_font);
($x>1000)?$rotate=8:$rotate=1;
($x>1000)?$koef_sdviga=0.35:$koef_sdviga=0.56;$x=$x-($x*$koef_sdviga);
$y=$y-($y*0.06);
$color=imagecolorallocate($im,255,215,0);
$font=$root.'/img/site/utilities/arial.ttf';$text=$_SERVER['HTTP_HOST'];
imagettftext($im,$font_size,$rotate,$x,$y,$color,$font,$text);
if($result['png']=='1'){($mob)?imagepng($im,NULL,6):imagepng($im,NULL,1);}
else{($mob)?imagejpeg($im,NULL,59):imagejpeg($im,NULL,91);}imagedestroy($im);}}?>