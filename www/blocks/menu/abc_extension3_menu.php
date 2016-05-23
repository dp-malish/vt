<?php
$table_name='sonnik';
$Cash->StartCache();
//$body_link=' href="/'.$table_name.'/'.$uri_parts[1].'/category';
$i == 1;
$sql = "SELECT links_grandson,links_name FROM $table_name WHERE links='$uri_parts[1]' AND links_child is NULL AND links_grandson IS NOT NULL ORDER BY links_name";

$left_child_menu='<div class="fon left_menu_child_abc align-center"><h3>Алфавит категорий</h3><nav>';
$result = $MySQLsel->QuerySelect($sql);
while($res = mysql_fetch_array($result)){
$left_child_menu.='<a href="/'.$table_name.'/'.$uri_parts[1].'/category/'.$res['links_grandson'].'">'.$res['links_name'].'</a> ';
$i++;
if($i == 10 || $i == 22){$left_child_menu.='<br>';}
}mysql_free_result($result);
/*
<a'.$body_link.'/a/">А</a>
<a'.$body_link.'/b/">Б</a>
<a'.$body_link.'/v/">В</a>
<a'.$body_link.'/g/">Г</a>
<a'.$body_link.'/d/">Д</a>
<a'.$body_link.'/e/">Е</a>
<a'.$body_link.'/zh/">Ж</a>
<a'.$body_link.'/z/">З</a><br>
<a'.$body_link.'/i/">И</a>
<a'.$body_link.'/k/">К</a>
<a'.$body_link.'/l/">Л</a>
<a'.$body_link.'/m/">М</a>
<a'.$body_link.'/n/">Н</a>
<a'.$body_link.'/o/">О</a>
<a'.$body_link.'/p/">П</a>
<a'.$body_link.'/r/">Р</a>
<a'.$body_link.'/s/">С</a>
<a'.$body_link.'/t/">Т</a><br>
<a'.$body_link.'/u/">У</a>
<a'.$body_link.'/f/">Ф</a>
<a'.$body_link.'/h/">Х</a>
<a'.$body_link.'/c/">Ц</a>
<a'.$body_link.'/ch/">Ч</a>
<a'.$body_link.'/sh/">Ш</a>
<a'.$body_link.'/shc/">Щ</a>
<a'.$body_link.'/ye/">Э</a>
<a'.$body_link.'/yu/">Ю</a>
<a'.$body_link.'/ya/">Я</a>
*/
$left_child_menu.='</nav></div>';
echo $left_child_menu;
$Cash->StopCache($temp_menu_name.'.html');
$left_content=$left_child_menu.$left_content;
?>