<?php
header("Content-type: text/javascript; charset=UTF-8");header('Cache-Control: public, max-age=14515200');$main_content.='function button_back(page_link){var my_protocol=window.location.protocol;var my_host=window.location.hostname;my_protocol+=\'//\'+my_host+\'/\'+page_link;var length_str_start,length_str_end;length_str_start=my_protocol.length;var referal=document.referrer;var temp_ref=referal.substring(0,length_str_start);length_str_end=temp_ref.length;if(length_str_start==length_str_end){window.history.back();}else{document.location.href=my_protocol;}}';
$HTTP_ACCEPT_ENCODING = $_SERVER["HTTP_ACCEPT_ENCODING"]; 
if(strpos($HTTP_ACCEPT_ENCODING,'x-gzip')!==false)$encoding='x-gzip';
else if(strpos($HTTP_ACCEPT_ENCODING,'gzip')!==false)$encoding='gzip';else $encoding=false;
if($encoding){$l_str=strlen($main_content);
if($l_str>1048){header('Content-Encoding: '.$encoding);echo("\x1f\x8b\x08\x00\x00\x00\x00\x00");$main_content=gzcompress($main_content,3);
}}echo $main_content;
?>