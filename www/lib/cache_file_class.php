<?php
class Cache_File{
	
	//protected $mes=1;//=idate('n');
	
	public function __construct(){
	$this->cache_file;
	$this->block_part_name;
	}
	
	
//-----------------------------------------------------------------	
public function CacheGo($block_part_name,$cache_time,$cache_file,$full_function=true){

$cache_file = 'cache/'.$cache_file; // Файл будет находиться в /cache/... .html  
//************************
if (file_exists($cache_file)){// Если файл с кэшем существует
	//++++++++++++++++++++
	if ((time() - $cache_time) < filemtime($cache_file)){//Если его время жизни ещё не прошло
	echo file_get_contents($cache_file);//Выводим содержимое файла

		(bool) $flag=1;
	}
	//++++++++++++++++++++
	}
//************************

//If not flag creat new file*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
if(!$flag){
	$this->cache_file=$cache_file;
	$this->block_part_name=$_SERVER['DOCUMENT_ROOT'].$block_part_name;
	$this->MadeCache();
}
//If not flag creat new file*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
}
//-----------------------------------------------------------------	
//-----------------------------------------------------------------	
public function IsSetCacheFile($cache_time,$cache_file){

$cache_file = 'cache/'.$cache_file; // Файл будет находиться в /cache/... .html  
//************************
if (file_exists($cache_file)){// Если файл с кэшем существует
	//++++++++++++++++++++
	if ((time() - $cache_time) < filemtime($cache_file)){//Если его время жизни ещё не прошло
	return file_get_contents($cache_file);//Выводим содержимое файла
	}else {return 0;}
	//++++++++++++++++++++
	}else {return 0;}
//************************
}
//-----------------------------------------------------------------
//-----------------------------------------------------------------
public function StartCache(){
	ob_start();
}
public function StopCache($cache_file){
	$cache_file = 'cache/'.$cache_file;	
	$handle = fopen($cache_file, 'w'); // Открываем файл для записи и стираем его содержимое
	fwrite($handle, ob_get_contents()); // Сохраняем всё содержимое буфера в файл
	fclose($handle); // Закрываем файл
	ob_end_clean();//Данная функция до отправки контента в браузер уберётотправку ))).
	//ob_end_flush(); // Выводим страницу в браузере
}
public function StopCacheWithOut($cache_file){
	$cache_file = 'cache/'.$cache_file;	
	$handle = fopen($cache_file, 'w'); // Открываем файл для записи и стираем его содержимое
	fwrite($handle, ob_get_contents()); // Сохраняем всё содержимое буфера в файл
	fclose($handle); // Закрываем файл
	//ob_end_clean();//Данная функция до отправки контента в браузер уберётотправку ))).
	ob_end_flush(); // Выводим страницу в браузере
}
//-----------------------------------------------------------------	
//-----------------------------------------------------------------	

private function MadeCache(){
	ob_start();
	
	require($this->block_part_name);

	$handle = fopen($this->cache_file, 'w'); // Открываем файл для записи и стираем его содержимое
	fwrite($handle, ob_get_contents()); // Сохраняем всё содержимое буфера в файл
	fclose($handle); // Закрываем файл
	
	ob_end_flush(); // Выводим страницу в браузере
	ob_end_clean();
}


}
?>