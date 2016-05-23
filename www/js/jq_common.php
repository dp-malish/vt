<?php
header("Content-type: text/javascript; charset=UTF-8");header('Cache-Control: public, max-age=14515200');
ob_start();include('jq1_11_1.js');include('jquery.lazyload.mini.js');include('jquery.colorbox-min.js');include('common_jq.js');
$mc=ob_get_contents();ob_end_clean();
$HTTP_ACCEPT_ENCODING=$_SERVER["HTTP_ACCEPT_ENCODING"]; 
if(strpos($HTTP_ACCEPT_ENCODING,'x-gzip')!==false)$encoding='x-gzip';
else if(strpos($HTTP_ACCEPT_ENCODING,'gzip')!==false)$encoding='gzip';else $encoding=false;
if($encoding){$l_str=strlen($mc);
header('Content-Encoding: '.$encoding);echo("\x1f\x8b\x08\x00\x00\x00\x00\x00");$mc=gzcompress($mc,3);}echo $mc;?>