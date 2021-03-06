<?php
if(!defined('MAIN_FILE')){exit;}
//-----------
if(isset($_POST['coordinats'])){
	if(PostRequest::issetPostKey(['adress','base_name','fish','bilet','glubina','boat','ploschad','contacts','road','full_text'])){

	$err_form_base=0;
	$uri_id_base=explode('-',$uri_parts[2],2);
	if(preg_match("/[^0-9]+$/u",$uri_id_base[0])){$err_form_base=1;}
	else{$id_base=$DB->realEscapeStr($uri_id_base[0]);
	$sql='SELECT id_user FROM '.$table_name.' WHERE id='.$id_base;
	$res=$DB->strSQL($sql);
	if($res['id_user']!=$userid){$err_form_base=1;$print_err_form='<p>Неверная ссылка</p>';}
	}
	$coordinats=Validator::html_cod($_POST['coordinats']);
	$res_coordinats=Validator::LengthStr($coordinats,23);
	if($res_coordinats=='0'){
	$err_form_base=1;
	$print_err_form='<p>Координаты места на карте не указаны</p>';
	}
	if($res_coordinats=='2'){
	$err_form_base=1;//$print_err_form='<p>Координаты длинные</p>';
	}		
	if(!preg_match("/\d{2}\.\d{8},\d{2}\.\d{8}/",$coordinats)){
	$err_form_base=1;
	$print_err_form.='<p>Координаты указаны не верно</p>';
	}
	//**********		
	$adress=Validator::html_cod($_POST['adress']);
	$res_adress=Validator::LengthStr($adress,200);
	if($res_adress=='0'){
	$err_form_base=1;
	$print_err_form.='<p>Адресс места на карте не определён</p>';
	}
	if($res_adress=='2'){
	$err_form_base=1;//$print_err_form.='<p>Адресс длинный</p>';
	}
	if(!preg_match("/^[0-9А-Яа-яЁёa-zA-Z\s,]+$/u",$adress)){
	$err_form_base=1;
	$print_err_form.='<p>Адресс определён не верно</p>';
	}else{
	$exp_adress=explode(',',$adress);
	$country_map=trim($exp_adress[0]);	
	$oblast_map=trim($exp_adress[1]);	
	}
	//**********
	$base_name=Validator::html_cod($_POST['base_name']);
	$res_base_name=Validator::LengthStr($base_name,200);
	if($res_base_name=='0'){
	$err_form_base=1;
	$print_err_form.='<p>Название базы не указано</p>';
	}		
	if($res_base_name=='2'){
	$err_form_base=1;
	$print_err_form.='<p>Название базы превышает 180 символов</p>';
	}
	if(!preg_match("/^[0-9А-Яа-яЁёa-zA-Z\s,\.\;\&\!]+$/u",$base_name)){
	$err_form_base=1;
	$print_err_form.='<p>В названии базы используются запрещённые символы</p>';
	}
	//**********
	$fish=Validator::html_cod($_POST['fish']);
	$res_fish=Validator::LengthStr($fish,0);
	if($res_fish=='0'){
	$err_form_base=1;
	$print_err_form.='<p>Перечень рыб не указан</p>';
	}		
	if(!preg_match("/^[А-яЁё,\s]+$/u",$fish)){
	$err_form_base=1;
	//
	$print_err_form.='<p>В названии рыб используются запрещённые символы</p>';
	}else{
	$exp_fish=explode(',',$fish);//$exp_fish[0] элемент массива
	$res_fish=count($exp_fish);//кол-во элементов массива
	}
	//**********
	$bilet=Validator::html_cod($_POST['bilet']);		
	$res_bilet=Validator::LengthStr($bilet,200);
	if($res_bilet=='2'){
	$err_form_base=1;
	$print_err_form.='<p>Отловочный билет превышает 180 символов</p>';
	}
	if($res_bilet!='0'){
	if(!preg_match("/^[0-9А-Яа-яЁёa-zA-Z\s,\.\;\&\!]+$/u",$bilet)){
	$err_form_base=1;
	$print_err_form.='<p>В графе отловочный билет используются запрещённые символы</p>';
	}}
	//**********
	$glubina=Validator::html_cod($_POST['glubina']);
	$res_glubina=Validator::LengthStr($glubina,200);
	if($res_glubina=='2'){
	$err_form_base=1;
	$print_err_form.='<p>Глубина превышает 180 символов</p>';
	}
	if($res_glubina!='0'){
	if(!preg_match("/^[0-9А-Яа-яЁёa-zA-Z\s,\.\;\&\!]+$/u",$glubina)){
	$err_form_base=1;
	$print_err_form.='<p>В графе глубина используются запрещённые символы</p>';
	}}
	//**********
	$boat=Validator::html_cod($_POST['boat']);
	$res_boat=Validator::LengthStr($boat,200);
	if($res_boat=='2'){
	$err_form_base=1;
	$print_err_form.='<p>Раздел лодка превышает 180 символов</p>';
	}
	if($res_boat!='0'){		
	if(!preg_match("/^[0-9А-Яа-яЁёa-zA-Z\s,\.\;\&\!]+$/u",$boat)){
	$err_form_base=1;
	$print_err_form.='<p>В графе лодка используются запрещённые символы</p>';
	}}
	//**********
	$ploschad=Validator::html_cod($_POST['ploschad']);				
	$res_ploschad=Validator::LengthStr($ploschad,200);		
	if($res_ploschad=='2'){
	$err_form_base=1;
	$print_err_form.='<p>Раздел лодка превышает 180 символов</p>';
	}
	if($res_ploschad!='0'){
	if(!preg_match("/^[0-9А-Яа-яЁёa-zA-Z\s,\.\;\&\!()]+$/u",$ploschad)){
	$err_form_base=1;
	$print_err_form.='<p>В графе площадь используются запрещённые символы</p>';
	}}
	//**********		
	$contacts=Validator::html_cod($_POST['contacts']);		
	$res_contacts=Validator::LengthStr($contacts,200);
	if($res_contacts=='2'){
	$err_form_base=1;
	$print_err_form.='<p>Раздел контакты превышает 180 символов</p>';
	}		
	if($res_contacts!='0'){
	if(!preg_match("/^[0-9А-Яа-яЁёa-zA-Z\s,\.\;\&\-\!()+]+$/u",$contacts)){
	$err_form_base=1;
	$print_err_form.='<p>В графе контакты используются запрещённые символы</p>';
	}}
	//**********
	$road=Validator::html_cod($_POST['road']);
	$res_road=Validator::LengthStr($road,1150);
	if($res_road=='0'){
	$err_form_base=1;
	$print_err_form.='<p>Путь к месту не указан</p>';
	}
	if($res_road=='2'){
	$err_form_base=1;
	$print_err_form.='<p>Путь к месту превышает 1000 символов</p>';
	}		
	//**********
	$full_text=Validator::html_cod($_POST['full_text']);
	$res_full_text=Validator::LengthStr($road,5200);
	if($res_full_text=='0'){
	$err_form_base=1;
	$print_err_form.='<p>Описание водоёма не указано</p>';
	}		
	if($res_full_text=='2'){
	$err_form_base=1;
	$print_err_form.='<p>Описание водоёма превышает 5000 символов</p>';
	}		
	//*******************************************************
	$main_content.='<div class="fon">';
		include $root.'/modul/l/vodoem/menu.php';
		
		if($err_form_base){$main_content.='<h3>Возникли ошибки при изменении рыболовной базы</h3>'.$print_err_form;
		}else{//добавим работу с базой
		$data_key=microtime(true);
		$sql='UPDATE '.$table_name.' SET
		data=\''.$data_key.'\',coordinats=?,adress=?,country_map=?,oblast_map=?,
		base_name=?,fish=?,bilet=?,glubina=?,boat=?,ploschad=?,contacts=?,road=?,full_text=?
		WHERE id='.$id_base;

			$sql=$DB->realEscape($sql,[$coordinats,$adress,$country_map,$oblast_map,$base_name,$fish,$bilet,$glubina,$boat,$ploschad,$contacts,$road,$full_text]);
		
		if($DB->boolSQL($sql)){
		$main_content.='<p>Запись изменена!</p>';
		$main_content.='<h3>Результат изменения рыболовной базы</h3>
		<br>
		<p>Дата: '.date('H:i:s  d-m-Y', $data_key).'</p>
		<p>Координаты места: '.$coordinats.'</p>
		<p>Расположение: '.$oblast_map.'</p>
		<p>Название базы: '.$base_name.'</p>
		<p>Рыба: '.$fish.'</p>
		<p>Отловочный билет: '.$bilet.'</p>
		<p>Глубина водоема: '.$glubina.'</p>
		<p>Использование лодки: '.$boat.'</p>
		<p>Площадь водоема: '.$ploschad.'</p>
		<p>Контакты владельца: '.$contacts.'</p><br>';

		$DB->boolSQL('DELETE FROM '.$table_name_ext.' WHERE id_vodoemi_fish='.$id_base);

		$sql='INSERT INTO '.$table_name_ext.' (id,id_vodoemi_fish,fish) VALUES ';
		for($i=0;$i<$res_fish;$i++){
		$sql.='(NULL,'.$id_base.',\''.$exp_fish[$i].'\')';
		if($i<($res_fish-1)){$sql.=',';}else{$sql.=';';}
		}
		if($DB->boolSQL($sql)){
		$main_content.='<p>Разновидность рыб зафиксирована.</p>';}
		else{$main_content.='<p>Ошибка базы данных при добавлении рыб...</p>';}
		}else{$main_content.='<p>Ошибка базы данных, попробуйте ещё раз...</p>';}
		}
	$main_content.='</div>';
	$bad_link=0;
	}else{$index=true;}
	}else{
$js_common='';
$jscript.='<script src="/js/base/chosen_base.php"></script><script src="/js/ckeditor_base/ckeditor.js"></script><script src="/js/base/base_update.js"></script>';
		
	$uri_parts_ext=explode('-',$uri_parts[2],2);
	if(preg_match("/[^0-9]+/",$uri_parts_ext[0])){$bad_link=1;}
	else{
	$sql='SELECT id,id_user,data,coordinats,adress,
	base_name,fish,bilet,glubina,boat,ploschad,contacts,road,full_text
	FROM '.$table_name.' WHERE id='.$DB->realEscapeStr($uri_parts_ext[0]);
	$res=$DB->strSQL($sql);
	if(!$res){$bad_link=1;}else{
		$main_content.='<div class="fon">';
		include $root.'/modul/l/vodoem/menu.php';
		$main_content.='<h3>Форма редактирования водоёмов</h3><div id="note_base"><p>Для изменения водоёма объекта - находим место рыболовной базы на карте с максимальной точностью и щелкаем левой кнопкой мыши перетаскивая метку в это место. После чего вы увидите, как перемещённый маркер.</p><p>Далее отредактируйте поля формы. Отмечены поля являются обязательными для заполнения.</p></div><div id="note_base_click"><p>Просмотреть инструкцию</p></div></div>';
		$main_content.='<div class="fon"><div id="map"></div></div>';
		$main_content.='<div class="fon">
		<form id="base_update" action="" onSubmit="return ValidForm(this);" method="post">
<input name="coordinats" id="coordinats" type="hidden" value="'.$res['coordinats'].'">
<input name="adress" id="adress" type="hidden" value="'.$res['adress'].'">
<div class="tr_fist align-left float-left">&nbsp;</div><div class="tr_second float-left"><div class="err_form" id="err_coordinats"></div><div class="err_form" id="err_adress"></div></div><div class="tr_third float-left"></div><div class="clear"></div>


<div class="tr_fist align-left float-left"><p>Название базы:</p></div>
<div class="tr_second float-left"><input type="text" name="base_name" id="base_name" value="'.$res['base_name'].'" class="tr_input" maxlength="180"><div class="err_form" id="err_base_name"></div></div><div class="tr_third float-left"></div><div class="clear"></div>

<input name="fish" type="hidden" id="fish" value="'.$res['fish'].'"><div class="tr_fist align-left float-left"><p>Рыба:</p></div><div class="tr_second float-left"><select class="chosen tr_select" multiple="true">';
	$sql="SELECT links,fish FROM reference_fish ORDER BY fish";
	$db_res=$DB->arrSQL($sql);
	foreach($db_res as $key=>$val){$main_content.='<option>'.$val["fish"].'</option>';}
	$main_content.='</select><div class="clear"></div><div class="err_form" id="err_fish"></div></div><div class="tr_third float-left"><p>Введите рыбу из списка</p></div><div class="clear"></div>

<div class="tr_fist align-left float-left"><p>Отловочный билет:</p></div><div class="tr_second float-left"><input type="text" name="bilet" id="bilet" value="'.$res['bilet'].'" class="tr_input" maxlength="180"><div class="err_form" id="err_bilet"></div></div><div class="tr_third float-left"></div><div class="clear"></div>

<div class="tr_fist align-left float-left"><p>Глубина водоема:</p></div><div class="tr_second float-left"><input type="text" name="glubina" id="glubina" value="'.$res['glubina'].'" class="tr_input" maxlength="180"><div class="err_form" id="err_glubina"></div></div><div class="tr_third float-left"></div><div class="clear"></div>


<div class="tr_fist align-left float-left"><p>Использование лодки:</p></div><div class="tr_second float-left"><input type="text" name="boat" id="boat" value="'.$res['boat'].'" class="tr_input" maxlength="180"><div class="err_form" id="err_boat"></div></div><div class="tr_third float-left"></div><div class="clear"></div>


<div class="tr_fist align-left float-left"><p>Площадь водоема:</p></div><div class="tr_second float-left"><input type="text" name="ploschad" id="ploschad" value="'.$res['ploschad'].'" class="tr_input" maxlength="180"><div class="err_form" id="err_ploschad"></div></div><div class="tr_third float-left"></div><div class="clear"></div>


<div class="tr_fist align-left float-left"><p>Контакты владельца:</p></div><div class="tr_second float-left"><input type="text" name="contacts" id="contacts" value="'.$res['contacts'].'" class="tr_input"/><div class="err_form" id="err_contacts"></div></div><div class="tr_third float-left"><p>Телефон</p></div><div class="clear"></div>


<div class="tr_fist align-left float-left"><p>Описание проезда:</p></div><div class="tr_second float-left"><textarea name="road" id="road" class="tr_input" rows="7">
'.htmlspecialchars_decode($res['road'],ENT_QUOTES).'</textarea><div class="err_form" id="err_road"></div></div><div class="tr_third float-left"><p>Кратко о том, как доехать (максимум 1000 символов).</p></div><div class="login_tr_margin clear"></div>

<div class="tr_fist align-left float-left"><p>Описание водоёма:</p></div><div class="tr_second float-left"><textarea name="full_text" id="full_text" class="tr_input" rows="17">'.htmlspecialchars_decode($res['full_text'],ENT_QUOTES).'</textarea><div class="err_form" id="err_full_text"></div></div><div class="tr_third float-left"></div><div class="clear"></div>

<div class="tr_fist align-left float-left">&nbsp;</div><div class="tr_second float-left"><input class="tr_input" type="submit" name="send_base" id="send_base" value="Сохранить"></div><div class="tr_third float-left">&nbsp;</div><div class="clear"></div></form></div>';
$main_content.='<script type="text/javascript">var mapcoordinate="'.$res['coordinats'].'";var hintContentVal="'.$res['base_name'].'";';
if($res['contacts']==''){$main_content.='var contaktsBase="контакты не указаны";';}
else{$main_content.='var contaktsBase="Контакты: '.$res['contacts'].'";</script>';}
$bad_link=0;
	}
}
//-----------
}