<?php
$Cash->StartCache();//Старт кешика
$left_child_menu='<div class="fon"><h3>Категории:</h3><nav><ul class="left_menu_child">';	
$sql = "SELECT links_grandson,title FROM $table_name WHERE links='$uri_parts[1]' AND links_child is NULL AND links_grandson IS NOT NULL";
$result = $MySQLsel->QuerySelect($sql);
while($res = mysql_fetch_array($result)){
$left_child_menu.='<li><a href="/'.$table_name.'/'.$uri_parts[1].'/category/'.$res['links_grandson'].'">'.$res['title'].'</a></li>';
}mysql_free_result($result);
$left_child_menu.='</ul></nav></div>';
echo $left_child_menu;
$Cash->StopCache($temp_menu_name.'.html');
$left_content=$left_child_menu.$left_content;
?>