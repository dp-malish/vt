<?php
header("Content-type: text/txt; charset=UTF-8");

$root=$_SERVER['DOCUMENT_ROOT'];
$site=$_SERVER['SERVER_NAME'];

include($_SERVER['DOCUMENT_ROOT'].'/lib/sql_select_class.php');
$MySQLsel= new SQL_select();

$cache_file =$root.'/sitemap.xml';

$content.='<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
//*************************top_links**************************
$content.='
<url>
<loc>http://'.$site.'/</loc>
<lastmod>';
$temp_file=$root.'/blocks/top_menu/main.php';
$content.=date ("Y-m-d", filemtime($temp_file)).'</lastmod>
<changefreq>monthly</changefreq>
<priority>1.0</priority>
</url>
<url>
<loc>http://'.$site.'/news/</loc>
<lastmod>';
$temp_file=$root.'/blocks/top_menu/news.php';
$content.=date ("Y-m-d", filemtime($temp_file)).'</lastmod>
<changefreq>weekly</changefreq>
<priority>0.8</priority>
</url>
<url>
<loc>http://'.$site.'/article/</loc>
<lastmod>';
$temp_file=$root.'/blocks/top_menu/article.php';
$content.=date ("Y-m-d", filemtime($temp_file)).'</lastmod>
<changefreq>weekly</changefreq>
<priority>0.7</priority>
</url>
<url>
<loc>http://'.$site.'/contacts</loc>
<lastmod>';
$temp_file=$root.'/blocks/top_menu/contacts.php';
$content.=date ("Y-m-d", filemtime($temp_file)).'</lastmod>
<changefreq>monthly</changefreq>
<priority>0.2</priority>
</url>
<url>
<loc>http://'.$site.'/about</loc>
<lastmod>';
$temp_file=$root.'/blocks/top_menu/about.php';
$content.=date ("Y-m-d", filemtime($temp_file)).'</lastmod>
<changefreq>monthly</changefreq>
<priority>0.3</priority>
</url>';

$sql='SELECT link,data FROM default_content';
$result=$MySQLsel->QuerySelect($sql);
while($res = mysql_fetch_array($result)){
$content.='<url><loc>http://'.$site.'/'.$res["link"].'</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
}mysql_free_result($result);
//*************************Статьи article ***********************************
$sql="SELECT links,data FROM zzz_article";
$result=$MySQLsel->QuerySelect($sql);
while($res=mysql_fetch_array($result)){
$content.='<url><loc>http://'.$site.'/article/'.$res["links"].'</loc>
<lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
}mysql_free_result($result);
//*************************End Статьи article End****************************

//*************************Статьи news ***********************************
$sql = "SELECT links,data FROM zzz_news";
$result = $MySQLsel->QuerySelect($sql);
while($res = mysql_fetch_array($result)){
$content.='
<url>
<loc>http://'.$site.'/news/'.$res["links"].'</loc>
<lastmod>'.$res["data"].'</lastmod>';
$content.='
<changefreq>monthly</changefreq>
<priority>0.5</priority>
</url>';
}mysql_free_result($result);
//*************************End news End****************************

//*************************Статьи school ***********************************

/*Спиннингова ловля*/
$sql='SELECT data FROM school_spin ORDER BY id DESC LIMIT 1';
$result=$MySQLsel->QuerySelect($sql); 
$res=mysql_fetch_array($result);
$content.='
<url><loc>http://'.$site.'/спиннинговая-ловля/</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
$sql='SELECT link,data FROM school_spin';
$result=$MySQLsel->QuerySelect($sql);
while($res=mysql_fetch_array($result)){
$content.='<url><loc>http://'.$site.'/спиннинговая-ловля/'.$res["link"].'</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
}mysql_free_result($result);
/*Спиннингова ловля*/


$table_name.='school';
//spinningovaya-lovlya
$sql = "SELECT links,data FROM school WHERE links!='index' AND links!='spinningovaya-lovlya' AND links_child is NULL AND links_grandson is NULL";
$result=$MySQLsel->QuerySelect($sql);
while($res=mysql_fetch_array($result)){
$content.='
<url>
<loc>http://'.$site.'/'.$table_name.'/'.$res["links"].'/</loc>
<lastmod>'.$res["data"].'</lastmod>';
$content.='
<changefreq>monthly</changefreq><priority>0.5</priority>
</url>';
}mysql_free_result($result);

$sql="SELECT links,links_child,data FROM school WHERE links_child is not NULL AND links_grandson is NULL";
$result = $MySQLsel->QuerySelect($sql);
while($res = mysql_fetch_array($result)){
$content.='
<url>
<loc>http://'.$site.'/'.$table_name.'/'.$res["links"].'/'.$res["links_child"].'/</loc>
<lastmod>'.$res["data"].'</lastmod>';
$content.='
<changefreq>monthly</changefreq><priority>0.5</priority>
</url>';
}mysql_free_result($result);
//*************************End Статьи school End****************************

//*************************Статьи рыб ***********************************
$sql = "SELECT links_child,data FROM fish_article";
$result = $MySQLsel->QuerySelect($sql);
while($res = mysql_fetch_array($result)){
$content.='<url>
<loc>http://'.$site.'/fish/'.$res["links_child"].'</loc>
<lastmod>'.$res["data"].'</lastmod>';
$content.='<changefreq>monthly</changefreq><priority>0.5</priority>
</url>';
}mysql_free_result($result);
//*************************End news End****************************

//*************************base****************************
$content.='<url>
<loc>http://'.$site.'/base/</loc>
<lastmod>';
$temp_file=$root.'/blocks/base/main.php';
$content.=date ("Y-m-d", filemtime($temp_file)).'</lastmod>
<changefreq>monthly</changefreq><priority>0.5</priority>
</url>';
$content.='<url>
<loc>http://'.$site.'/base/create/</loc>
<lastmod>';
$temp_file=$root.'/blocks/base/base_create.php';
$content.=date ("Y-m-d", filemtime($temp_file)).'</lastmod>
<changefreq>monthly</changefreq><priority>0.5</priority>
</url>';
$content.='<url>
<loc>http://'.$site.'/base/my/</loc>
<lastmod>';
$temp_file=$root.'/blocks/base/base_my.php';
$content.=date ("Y-m-d", filemtime($temp_file)).'</lastmod>
<changefreq>monthly</changefreq><priority>0.5</priority>
</url>';
$sql="SELECT id,base_name,data FROM base_fish LIMIT 3";
$result=$MySQLsel->QuerySelect($sql);
while($res = mysql_fetch_array($result)){
$base_name=mb_convert_case($res['base_name'],MB_CASE_LOWER,"UTF-8");
$content.='<url>
<loc>http://'.$site.'/base/view/'.$res['id'].'-'.str_replace(" ","-",$base_name).'/</loc>
<lastmod>'.date('Y-m-d',$res["data"]).'</lastmod>';
$content.='<changefreq>monthly</changefreq><priority>0.5</priority></url>';
}mysql_free_result($result);
//*************************************************************


//!!!верхнее меню!!!
/*Обзоры*/
$sql='SELECT data FROM obzor ORDER BY id DESC LIMIT 1';
$result=$MySQLsel->QuerySelect($sql); 
$res=mysql_fetch_array($result);
$content.='
<url><loc>http://'.$site.'/обзор/</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
$sql='SELECT link,data FROM obzor';
$result=$MySQLsel->QuerySelect($sql);
while($res=mysql_fetch_array($result)){
$content.='<url><loc>http://'.$site.'/обзор/'.$res["link"].'</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
}mysql_free_result($result);
/*беременность здоровье конец*/

//!!!левое меню!!!
/*Ультралайт*/
$sql='SELECT data FROM hish_ultralite ORDER BY id DESC LIMIT 1';
$result=$MySQLsel->QuerySelect($sql); 
$res=mysql_fetch_array($result);
$content.='
<url><loc>http://'.$site.'/ультралайт/</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
$sql='SELECT link,data FROM hish_ultralite';
$result=$MySQLsel->QuerySelect($sql);
while($res=mysql_fetch_array($result)){
$content.='<url><loc>http://'.$site.'/ультралайт/'.$res["link"].'</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
}mysql_free_result($result);
/*Ультралайт*/

/*Воблер*/
$sql='SELECT data FROM hish_vobler ORDER BY id DESC LIMIT 1';
$result=$MySQLsel->QuerySelect($sql); 
$res=mysql_fetch_array($result);
$content.='
<url><loc>http://'.$site.'/воблеры/</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
$sql='SELECT link,data FROM hish_vobler';
$result=$MySQLsel->QuerySelect($sql);
while($res=mysql_fetch_array($result)){
$content.='<url><loc>http://'.$site.'/воблеры/'.$res["link"].'</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
}mysql_free_result($result);
/*Воблер*/

/*блесны*/
$sql='SELECT data FROM hish_blesna ORDER BY id DESC LIMIT 1';
$result=$MySQLsel->QuerySelect($sql); 
$res=mysql_fetch_array($result);
$content.='
<url><loc>http://'.$site.'/блесны/</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
$sql='SELECT link,data FROM hish_blesna';
$result=$MySQLsel->QuerySelect($sql);
while($res=mysql_fetch_array($result)){
$content.='<url><loc>http://'.$site.'/блесны/'.$res["link"].'</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
}mysql_free_result($result);
/*блесны*/
//-------------------------------------------
/*донка*/
$sql='SELECT data FROM mir_donka ORDER BY id DESC LIMIT 1';
$result=$MySQLsel->QuerySelect($sql); 
$res=mysql_fetch_array($result);
$content.='
<url><loc>http://'.$site.'/донка/</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
$sql='SELECT link,data FROM mir_donka';
$result=$MySQLsel->QuerySelect($sql);
while($res=mysql_fetch_array($result)){
$content.='<url><loc>http://'.$site.'/донка/'.$res["link"].'</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
}mysql_free_result($result);
/*донка*/
//-------------------------------------------
//-------------------------------------------
/*Зимний спиннинг*/
$sql='SELECT data FROM zim_spinning ORDER BY id DESC LIMIT 1';
$result=$MySQLsel->QuerySelect($sql); 
$res=mysql_fetch_array($result);
$content.='
<url><loc>http://'.$site.'/зимний-спиннинг/</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
$sql='SELECT link,data FROM zim_spinning';
$result=$MySQLsel->QuerySelect($sql);
while($res=mysql_fetch_array($result)){
$content.='<url><loc>http://'.$site.'/зимний-спиннинг/'.$res["link"].'</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
}mysql_free_result($result);
/*Зимний спиннинг*/

/*Зимние снасти*/
$sql='SELECT data FROM zim_snasti ORDER BY id DESC LIMIT 1';
$result=$MySQLsel->QuerySelect($sql); 
$res=mysql_fetch_array($result);
$content.='
<url><loc>http://'.$site.'/зимние-снасти/</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
$sql='SELECT link,data FROM zim_snasti';
$result=$MySQLsel->QuerySelect($sql);
while($res=mysql_fetch_array($result)){
$content.='<url><loc>http://'.$site.'/зимние-снасти/'.$res["link"].'</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
}mysql_free_result($result);
/*Зимние снасти*/
//-------------------------------------------
//-------------------------------------------
/*Рыбалка и Закон*/
$sql='SELECT data FROM polza_zakon ORDER BY id DESC LIMIT 1';
$result=$MySQLsel->QuerySelect($sql); 
$res=mysql_fetch_array($result);
$content.='
<url><loc>http://'.$site.'/рыбалка-и-закон/</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
$sql='SELECT link,data FROM polza_zakon';
$result=$MySQLsel->QuerySelect($sql);
while($res=mysql_fetch_array($result)){
$content.='<url><loc>http://'.$site.'/рыбалка-и-закон/'.$res["link"].'</loc><lastmod>'.$res["data"].'</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>';
}mysql_free_result($result);
/*Рыбалка и Закон*/

//-------------------------------------------
//-------------------------------------------
//*************************End base End****************************
$content.='</urlset>';
$handle = fopen($cache_file, 'w'); // Открываем файл для записи и стираем его содержимое
fwrite($handle, $content); // Сохраняем всё содержимое буфера в файл
fclose($handle); // Закрываем файл

// Пример вывода: В последний раз файл sitemap.xml был изменен: December 29 2002 22:16:23.
if (file_exists($cache_file)){
    echo 'В последний раз файл <a href="/sitemap.xml" target="_blank">sitemap.xml</a> был изменен: ' . date ("Y-m-d", filemtime($cache_file));
}
?>