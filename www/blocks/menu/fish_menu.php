<?php
if(!defined('MAIN_FILE')){exit;}
$fish_menu=$Cash->IsSetCacheFile(172800,'fish_menu.html');
if($fish_menu=='0'){$fish_menu='';
$sql="SELECT links,fish FROM reference_fish WHERE menu=1 ORDER BY link_turn";
$result=$MySQLsel->QuerySelect($sql);
while($res=mysql_fetch_array($result)){
	$fish_link[]=$res["links"];
	$fish_name[]=$res["fish"];
}
$result_str=count($fish_name);
if($result_str>0){$Cash->StartCache();
//***********
$fish_menu='<div class="fon"><div class="fon_head"><h4>Ловля рыбы:</h4></div><nav><ul id="fish_menu">';
for($i=0;$i<$result_str;$i++){
	$fish_menu.='<li><div>'.$fish_name[$i].'</div><ul>';
	$sql='SELECT links_child,links_name FROM fish_article WHERE links=\''.$fish_link[$i].'\' ORDER BY link_turn';
	$result=$MySQLsel->QuerySelect($sql);
	while($res=mysql_fetch_array($result)){
		$fish_menu.='<li><a href="/fish/'.$res["links_child"].'">'.$res["links_name"].'</a></li>';
	}
	$fish_menu.='</ul></li>';
}
$fish_menu.='</ul></nav></div>';
//***********
echo $fish_menu;
$Cash->StopCache('fish_menu.html');
}// End if($result_str > 0)
}//if($fish_menu == '0')
?>