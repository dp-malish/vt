//colorbox фото
$(document).ready(function(){$("img").lazyload({effect:"fadeIn"});$("a.colorbox").colorbox({maxWidth:"90%",maxHeight:"90%",opacity:"0.7",current:"{current} из {total}",photo:true});});

$(function(){//кнопрка прокрутки вверх
$(window).scroll(function(){
if($(this).scrollTop() != 0){$('#toTop').fadeIn();}else{$('#toTop').fadeOut();}});
$('#toTop').click(function(){$('body,html').animate({scrollTop:0},800);});});
//*************************End******************************
// Vodnoklasnikah
!function(d,id,did,st){var js=d.createElement("script");js.src="http://connect.ok.ru/connect.js";js.onload = js.onreadystatechange=function(){if(!this.readyState || this.readyState=="loaded" || this.readyState=="complete"){if(!this.executed){this.executed=true;setTimeout(function(){OK.CONNECT.insertGroupWidget(id,did,st);},0);}}}
d.documentElement.appendChild(js);}(document,"ok_group_widget","53239076683900","{width:235,height:280}");
// Vodnoklasnikah End
//****************************************************************************
//*******функция слайдера*****************************************************
window.requestAnimationFrame=(function(){ // для поддержки requestAnimationFrame всеми браузерами
        return window.requestAnimationFrame ||
               function(callback){
                   return window.setTimeout(callback, 1000 / 60);
               };
})();
// функция слайдера
function slider(f, img, button, V, Vo){
  var iii = 0,
      start = null,
      clear = 0;
  function step(time){
    if (start === null) start = time;
    var progress = time - start;
    if (progress > V){
      start = null;
      for (var i=0; i<img.length; i++){
        img[i].style.zIndex = "0";
        button[i].style.opacity = "1";
      }
      img[iii].style.zIndex = "1";
      iii = ((iii != (img.length - 1)) ? (iii + 1) : 0);
      img[iii].style.zIndex = "2";
      img[iii].style.opacity = "0";
      button[iii].style.opacity = ".4";
    } else if(img[iii].style.opacity != ""){
      img[iii].style.opacity = ((progress/Vo < 1) ? (progress/Vo) : 1);
    }
    if(clear != "0" && progress > Vo){}else{requestAnimationFrame(step);}
  }
  requestAnimationFrame(step);
  f.onmouseenter=function(){if(clear=="0")clear = "1";}  // при наведении на слайдер
  f.onmouseleave=function(){if(clear=="1"){clear = "0";requestAnimationFrame(step);}}  // курсор убран со слайдера
  for (var j=0;j<button.length;j++){  // при нажатии кнопок
    button[j].onclick=function(){
      clear="2";
      for(var i=0;i<img.length;i++){
        img[i].style.zIndex="0";
      }
      img[this.value].style.zIndex="2";
      img[this.value].style.opacity="1";
      for (var k=0;k<button.length;k++){
        button[k].style.opacity=((button[k]==this) ? '.4' : '1');
      }
    }
  }
}

//**************Post Ajax No Param*************
function PostNoParam(answer_file, answer_div){
$.ajax({
  type: 'POST',
  url: '/ajax/site/'+answer_file+'.php',
  cache: false,
  //data: 'name=Andrew&nickname=Aramis',
  success: function(data){
    $('#'+answer_div).html(data);
  }
});
}
//**************banner links*****************
$(document).ready(function(){              // по окончанию загрузки страницы
    $('#slid_one').click(function(){      // вешаем на клик по элементу с id=slid_one
        if (confirm("Просмотреть отчёт о мероприятии на форуме?")){
  		window.location.href="http://forum.vt-fishing.com.ua/meropriyatiya-kluba/212-kak-vse-bylo-1-madh-maiskii-piknik-na-zahar-evskom-vodohranilische-2.html#post3391";
		} // загрузку HTML кода из файла example.html               
		})
		
	    $('#slid_five').click(function(){if (confirm("Просмотреть отчёт о мероприятии на форуме?")){window.location.href="http://forum.vt-fishing.com.ua/meropriyatiya-kluba/258-sorevnovaniya-po-lovle-hischnoi-ryby-spinningom-kubok-zahar-evki-2015-osen-4.html#post3872";}})
		
});
//**************End banner links End*****************

$(document).ready(function(){
$('#weather').load('/ajax/site/weather.html');

PostNoParam('stat_forum','stat_forum');//вытяжка с форума

//$('#accordion ul:eq(0)').show();
// вызов функции слайдера
var f=document.getElementById('main_slider'),
    img=f.getElementsByTagName('img'),
    button=f.getElementsByTagName('div')[0].getElementsByTagName('button');
slider(f,img,button,'7000','1000');  // '7000' — скорость смены картинок, '1000' — скорость прозрачности
});

//****************fish_menu****************************
$(document).ready(function(){
	$("#fish_menu > li > div").click(function(){
    if(false==$(this).next().is(':visible')){
        $('#fish_menu ul').slideUp(350);
    }
    $(this).next().slideToggle(350);
	});
});
//*****************End fish_menu End*******************
