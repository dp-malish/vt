<?php
if (!defined('MAIN_FILE')){exit;}
$MySQLsel= new SQL_select();
// Add table name for menu пример
$table_name= array(array("school"));
$table_count=count($table_name);

for ($i=0; $i<$table_count; $i++){
$sql = "SELECT links,links_name,title FROM ".$table_name[$i][0]." WHERE links='index'";	
$result = $MySQLsel->QuerySelect($sql);	
$row = mysql_fetch_array($result);
$table_name[$i][]=$row["links_name"];
}
//***********************************************
//***********************************************

for ($i=0; $i<$table_count; $i++){
$sql = "SELECT links,title FROM ".$table_name[$i][0]." WHERE links !='index' AND links_child is NULL AND links_grandson is NULL ORDER BY link_turn";
$result = $MySQLsel->QuerySelect($sql);	
while($res = mysql_fetch_array($result)){$table_name[$i][]=$res["links"];$table_name[$i][]=$res["title"];}
}

for ($i=0; $i<$table_count; $i++){$child_count[]=count($table_name[$i]);}

echo '<nav><ul class="left_menu align-center">';
for ($i=0; $i<$table_count; $i++){
echo '<li><a href="/'.$table_name[$i][0].'">'.$table_name[$i][1].'</a>';
	//****************	
	if($child_count[$i]>2){
	echo '<ul>';
		for ($x=2; $x<$child_count[$i]; $x+=2){
			echo '<li><a href="/'.$table_name[$i][0].'/'.$table_name[$i][$x].'">'.$table_name[$i][$x+1].'</a>';
				
				$sql = "SELECT links_child,title FROM ".$table_name[$i][0]." WHERE links ='".$table_name[$i][$x]."' AND links_child is NOT NULL  AND links_grandson is NULL ORDER BY link_turn";
				$result = $MySQLsel->QuerySelect($sql);	
				$res = mysql_fetch_array($result);
					
					
					if($res["links_child"] !=''){
						echo '<ul>';
							echo '<li><a href="/'.$table_name[$i][0].'/'.$table_name[$i][$x].'/'.$res["links_child"].'">'.$res["title"].'</a></li>';
							while($res = mysql_fetch_array($result)){
							echo '<li><a href="/'.$table_name[$i][0].'/'.$table_name[$i][$x].'/'.$res["links_child"].'">'.$res["title"].'</a></li>';							
							}
						echo '</ul>';
					}
															
			echo "</li>";
		}// end for ($x=2; $x<$child_count[$i]; $x+=2)
	echo '</ul>';
	}//end if($child_count[$i]>2)	
	
	//****************
echo "</li>";
}
echo '</ul></nav>';
?>