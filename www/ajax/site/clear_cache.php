<?php
header("Content-type: text/txt; charset=UTF-8");
//*****************************************************************************************
$root=$_SERVER['DOCUMENT_ROOT'];
$col_vo_element=count(array_map("unlink",glob($root."/cache/*")));
//*****************************************************************************************
echo '<p>Было удалено '.$col_vo_element.' элементов</p>';
?>