// JavaScript Document без бом

//***********
$(document).ready(function(){
	//ф-ции справки
	$("#note_base_click").click(function(){
	$("#note_base").fadeIn(3500);
	$("#note_base_click").fadeOut(800);
	});
	
	//ф-ции выбора рыб
	jQuery(".chosen").chosen().change(function(e){
	//alert($(this).val());
	document.getElementById('fish').value=$(this).val();
	//$('.infoch').fadeOut().empty().text($(this).val()).fadeIn();
	});
/*	$('#button').click(function(){
		$('#append').load('chosen.html',function(){
			jQuery(".chosennew").chosen().change(function(e){
			console.log($(this).val());
			});
		});
	});*/
	CKEDITOR.replace('road');	
	CKEDITOR.replace('full_text');
});
//************

ymaps.ready(init);

function init(){

    var myMap = new ymaps.Map('map', {
            center: [50.40239489, 30.53269000],
            zoom: 8,
			controls:['rulerControl', 'fullscreenControl', 'zoomControl', 'typeSelector']
        });
//************
    // положение, вычисленное средствами браузера И яндекса
	var geolocation = ymaps.geolocation;
    geolocation.get({
        provider: 'yandex',
        mapStateAutoApply: true
    }).then(function (result) {
        myMap.geoObjects.add(result.geoObjects);
    });
//************

	var flag_click=0;
    myMap.events.add('click', function (e) {
		var	coords,txt;
		var myReverseGeocoder;
        if(!flag_click){
			flag_click=1;
//******************************************			
			// Создание метки
			var myPlacemark = new ymaps.Placemark(
			// Координаты метки
			e.get('coords'),{hintContent:'Для перемещения метки её необходимо перетащить.'},{draggable: true});
				// Добавление метки на карту
			myMap.geoObjects.add(myPlacemark);
			coords=myPlacemark.geometry.getCoordinates();
			txt = [coords[0].toPrecision(10),coords[1].toPrecision(10)].join(',');
			document.getElementById('coordinats').value=txt;
			myReverseGeocoder=ymaps.geocode([txt]);
			myReverseGeocoder.then(
			function(res){
			var nearest = res.geoObjects.get(0);
			var name = nearest.properties.get('description');
			//name = nearest.properties.get('text');
			document.getElementById('adress').value=name;},
			function(err){
			alert('Ошибка определения адресса');
			});	
//******************************************
//Взять координаты метки		
			myPlacemark.events.add('dragend', function (e) {
			coords=myPlacemark.geometry.getCoordinates();
			txt = [coords[0].toPrecision(10),coords[1].toPrecision(10)].join(',');
			document.getElementById('coordinats').value=txt;
//**************
//Адресс объекта
			myReverseGeocoder=ymaps.geocode([txt]);
			myReverseGeocoder.then(
			function(res){
			var nearest = res.geoObjects.get(0);
			var name = nearest.properties.get('description');
			//name = nearest.properties.get('text');
			document.getElementById('adress').value=name;},
			function(err){
			alert('Ошибка определения адресса');
			});
			});
			}else{//flag_click
			alert('Имеющуюся метку на карте можно передвигать мышкой с зажатой левой кнопкой на метке.');
			}
			});

//**********************


}
//****************************
//****************************
function ValidForm(form){

var valid = true;

var err_coordinats=document.getElementById('err_coordinats');
if(document.getElementById('coordinats').value==""){
	err_coordinats.innerHTML='<p>Определите положение базы на карте</p>';
	valid = false;
	}else{err_coordinats.innerHTML="";}

var err_adress=document.getElementById('err_adress');
if(document.getElementById('adress').value==""){
	err_adress.innerHTML='<p>Не определён адрес базы на карте</p>';
	valid = false;
	}else{err_adress.innerHTML="";}

var err_base_name=document.getElementById('err_base_name');
var str_base_name=document.getElementById('base_name').value;
if(str_base_name==""){
	err_base_name.innerHTML='<p>Укажите название базы</p>';
	valid = false;
	}else{
		if(str_base_name.length > 180){
			err_base_name.innerHTML='<p>Название базы превышает 180 символов</p>';
		}else{
		err_base_name.innerHTML="";
		}
	}

var err_fish=document.getElementById('err_fish');
if(document.getElementById('fish').value==""){
	err_fish.innerHTML='<p>Выберите разновидность рыб в водоёме</p>';
	valid = false;
	}else{err_fish.innerHTML="";}
/*
var err_bilet=document.getElementById('err_bilet');
if(document.getElementById('bilet').value==""){
	err_bilet.innerHTML='<p>Укажите стоимость отловочного билета</p>';
	valid = false;
	}else{err_bilet.innerHTML="";}

var err_glubina=document.getElementById('err_glubina');
if(document.getElementById('glubina').value==""){
	err_glubina.innerHTML='<p>Укажите глубину водоёма</p>';
	valid = false;
	}else{err_glubina.innerHTML="";}
*/
/*
var err_glubina=document.getElementById('err_boat');
if(document.getElementById('boat').value==""){
	err_boat.innerHTML='<p>Укажите условия использования лодки</p>';
	valid = false;
	}else{err_boat.innerHTML="";}

var err_ploschad=document.getElementById('err_ploschad');
if(document.getElementById('ploschad').value==""){
	err_ploschad.innerHTML='<p>Укажите площадь водоёма</p>';
	valid = false;
	}else{err_ploschad.innerHTML="";}

var err_contacts=document.getElementById('err_contacts');
if(document.getElementById('contacts').value==""){
	err_contacts.innerHTML='<p>Укажите контактную информацию владельца</p>';
	valid = false;
	}else{err_contacts.innerHTML="";}
*/
var err_road=document.getElementById('err_road');
var data_road = CKEDITOR.instances.road.getData();
if(data_road==""){
	err_road.innerHTML='<p>Укажите как добраться к водоёму</p>';
	valid = false;
	}else{
		if(data_road.length > 1000){
		err_road.innerHTML='<p>Раздел превышает 1000 символов</p>';
		}else{
	err_road.innerHTML="";
	document.getElementById('road').value==data_road;}}

var err_full_text=document.getElementById('err_full_text');
var data_full_text = CKEDITOR.instances.full_text.getData();
if(data_full_text==""){
	err_full_text.innerHTML='<p>Опишите водоём и базу</p>';
	valid = false;
	}else{
		if(data_full_text.length > 5000){
		err_road.innerHTML='<p>Раздел превышает 5000 символов</p>';
		}else{
	err_full_text.innerHTML="";
	document.getElementById('full_text').value==data_full_text;}}




return valid;

	
}

//****************************
//****************************









/*function init(){


			myMap = new ymaps.Map("map", {
            center: [47.22505901, 37.50354260],
            zoom: 12,
			controls:['rulerControl', 'fullscreenControl', 'zoomControl', 'typeSelector']}
			);

		
		myMap.events.add('contextmenu', function (e) {
        myMap.setZoom(myMap.getZoom() - 2);
    	});
}
*/

