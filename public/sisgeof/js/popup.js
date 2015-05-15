/*
Author: Adrian "yEnS" Mato Gondelle
website: www.yensdesign.com
email: yensamg@gmail.com
license: Feel free to use it, but keep this credits please!					
*/

//SETTING UP OUR POPUP
//0 means disabled; 1 means enabled;
var popupStatus = 0;

//loading popup with jQuery magic!
function loadPopup(textoMensagem){
	//loads popup only if it is disabled

	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#popupContact").height();	
	var popupWidth = $("#popupContact").width();
	
	//alert("Altura: "+popupHeight+" Largura: "+popupWidth);
	//centering
	$("#popupContact").css({
		"position": "fixed",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2,
		"height": "auto"
	});
	$("#popupContact").html("<h1>Erro</h1><h2 id=\"contactArea\">"+textoMensagem+"</h2><br><input class=\" btn btn-primary \" id=\"popupContactClose\" onClick=\"disablePopup();\" type=\"button\" value=\"Fechar\" />");
	//only need force for IE6
	
	//$("#backgroundPopup").html("<a id=\"popupContactClose\">X</a>");
	
	/*$("#backgroundPopup").css({
		"height": windowHeight
	});*/
	
	if(popupStatus==0){
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		$("#backgroundPopup").fadeIn("slow");
		$("#popupContact").fadeIn("slow");
		popupStatus = 1;
	}
}

//disabling popup with jQuery magic!
function disablePopup(){
	//disables popup only if it is enabled
	if(popupStatus==1){
		$("#backgroundPopup").fadeOut("slow");
		$("#popupContact").fadeOut("slow");
		popupStatus = 0;
	}
}
/*
//centering popup
function centerPopup(){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#popupContact").height();
	var popupWidth = $("#popupContact").width();
	//centering
	$("#popupContact").css({
		"position": "fixed",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});
	$("#popupContact").html("<h1>Mensagem</h1><p id=\"contactArea\">A função não é permitida para núcleos!!!<br/><br/><a id=\"popupContactClose\">X</a></p>");
	//only need force for IE6
	
	$("#backgroundPopup").html("<a id=\"popupContactClose\">X</a>");
	
	$("#backgroundPopup").css({
		"height": windowHeight
	});
	
}*/


//CONTROLLING EVENTS IN jQuery
function inicializaPopup(){
	
	//LOADING POPUP
	//Click the button event!
	/*$("#button").click(function(){
		//centering with css
		centerPopup();
		//load popup
		loadPopup();
	});*/
		
	//CLOSING POPUP
	//Click the x event!
	/*$("#popupContactClose").click(function(){
		disablePopup();
	});
	$(".popupContactClose").click(function(){
		disablePopup();
	});*/
	//Click out event!
	$("#backgroundPopup").click(function(){
		disablePopup();
	});
	//Press Escape event!
	$(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus==1){
			disablePopup();
		}
	});

}