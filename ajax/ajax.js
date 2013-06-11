// JavaScript Document
/////////////////////////////////INICIO VALORES/////////////////////////////////////////////////////////////////////
var idSetTime;
var y=0;
var modelo=1;
var index=-1;
while(index==-1){
	index=document.getElementById('index').value;
}

if(index=="si" && $(document).width()>799){
	var hoy = new Date();
	if(hoy.getHours()>7 && hoy.getHours()<17){
		document.getElementById('imgFondo').src="img/fondo1.jpg";
	}else{
		document.getElementById('imgFondo').src="img/fondo2.jpg";
	}
}
/*else{
	if(index==1){
		document.getElementById('imgFondo').src="img/fondoM.png";	
	}
}*/

/////////////////////////////////FUNCIONES PARA OBTENER LA POSICION DEL SCROLL EN LA PANTALLA/////////////////////////////////////////////////////////////////////
// always return 1, except at non-default zoom levels in IE before version 8
function GetZoomFactor () {
	var factor = 1;
	if (document.body.getBoundingClientRect) {
			// rect is only in physical pixel size in IE before version 8 
		var rect = document.body.getBoundingClientRect ();
		var physicalW = rect.right - rect.left;
		var logicalW = document.body.offsetWidth;
			// the zoom level is always an integer percent value
		factor = Math.round ((physicalW / logicalW) * 100) / 100;
	}
	return factor;
}
function GetScrollPositions () {
	if ('pageXOffset' in window) {  // all browsers, except IE before version 9
		var scrollLeft =  window.pageXOffset;
		var scrollTop = window.pageYOffset;
	}
	else {      // Internet Explorer before version 9
		var zoomFactor = GetZoomFactor ();
		var scrollLeft = Math.round (document.documentElement.scrollLeft / zoomFactor);
		var scrollTop = Math.round (document.documentElement.scrollTop / zoomFactor);
	}
        
	return {x: scrollLeft, y: scrollTop};
}
/////////////////////////////////FUNCION QUE CARGA EL CONTENIDO DE LAS PAGINAS/////////////////////////////////////////////////////////////////////
function Cargado(){
	$("[rel='tooltip']").tooltip();
	if($('#bar').width('100%')){
		setTimeout("$('#carga').addClass('oculto')",700);
	}	
}
function CargandoPag(){
	if($('#bar').width('10%')){
		$('#carga').removeClass('oculto');
	}
	$("[rel='tooltip']").tooltip('destroy');
}
function Refresh(){
	CargandoPag();
	var mailR=$('#mailU').val();
	if(index==1){
		$('#principalK').load('ajax/ajax.php?type=1&mail='+mailR,'',function(){
			Cargado();});
	}else{
		idK=$('#idK').val();
		$('#principalK').load('ajax/ajax.php?type=8&mail='+mailR+'&id='+idK+'&modelo='+modelo,'',function(){
			Cargado();});	
	}
	/*idSetTime=setTimeout("Refresh()",10000);*/
}
/////////////////////////////////REFRESCO TODO EL CONTENIDO DE UNA IMAGEN EN CONCRETO/////////////////////////////////////////////////////////////////////
function RefrescoImg(id){
	CargandoPag();
	var mailR=$('#mailU').val();
	var x=$('#kal'+id).attr('data-x');
	$('#kal'+id).load('ajax/ajax.php?type=12&mail='+mailR+'&id='+id+'&x='+x+'&modelo='+modelo,'',function(){Cargado();});
}
/////////////////////////////////REFRESCA LOS COMENTARIOS DE UNA IMAGEN EN CONCRETO/////////////////////////////////////////////////////////////////////
function RefrescoComentario(id){
	var mailR=$('#mailU').val();
	$("[rel='tooltip']").tooltip('destroy');
	var x=$('#kal'+id).attr('data-x');
	$('#kalD'+id).load('ajax/ajax.php?type=13&mail='+mailR+'&id='+id,'',function(){$("[rel='tooltip']").tooltip();});
}
/////////////////////////////////PARO EL REFRESCO/////////////////////////////////////////////////////////////////////
function Stop()	{
	//clearTimeout(idSetTime);
}
/////////////////////////////////INICIO EL REFRESCO/////////////////////////////////////////////////////////////////////
function Play(){
	//idSetTime=setTimeout("Refresh()",10000);	
}
/////////////////////////////////COMPRUEBO LA FECHA/////////////////////////////////////////////////////////////////////
function comprueba_fecha(fecha){
	if(fecha.length==10){
		d=fecha.substring(0,2);
		ba=fecha.substring(2,3);
		m=fecha.substring(3,5);
		ba2=fecha.substring(5,6);
		a=fecha.substring(6,10);
		//alert(d+'  '+ba+'  '+m+'  '+ba2+'  '+a);
		if(d>0 && d<32 && ba=="/" && m>0 && m<13 && ba2=="/" && a>0 && a<10000){
			if((m==4 || m==6 || m==9 || m==11) && d==31){
				return false;
			}else{
				if((m==2 && d>29 && (a%4)==0) || (m==2 && d>28 && (a%4)!=0)){
					return false;
				}else{
					return true;
				}
			}
		}
		else{
			return false;	
		}
	}else{
		return false;	
	}
	
}

//////////////////////////////EJECUTO Y DECLARO FUNCIONES JQUERY/////////////////////////////////////////////////////////
$(function(){
	/******************************MUESTRO LOS KALIFORNIAZOS***************************************************************************/
	var mail_usu=$('#mailU').val();
	var data;
	$(window).load(function () {
		Cargado();
	});
	
	$(".botonMenu").live('click',function(){
		$(this).tooltip('hide');
    });
	
	/******************************CREO KALIFORNIAZO***************************************************************************/
	$('#kaliforniazoNuevo').live('click',function(){
		//var mail=$('#mailU').val();
		var kaliforniazo=$('#kaliforniazo').val().replace(/\s/g,'1-2');
		var des=$('#des').val().replace(/\s/g,'1-2');
		//var fecha=$('#fecha').val().replace(/\s/g,'1-2');
		var latitud=$('#latitud').val().replace(/\s/g,'1-2');
		var longitud=$('#longitud').val().replace(/\s/g,'1-2');
		var fecha=$('#fecha').val();
		
		if(kaliforniazo=="" || des=="" || fecha==""){
			alert('Falta algún dato obligatotio.');
		}else{
			if(comprueba_fecha(fecha)){
				data='?type=2&kaliforniazo='+kaliforniazo+'&des='+des+'&mail='+mail_usu+'&fecha='+fecha+'&longitud='+longitud+'&latitud='+latitud;
				$('#oculto').load('ajax/ajax.php'+data,'',function(){
					var es=document.getElementById('confirmadoK').value;
					if(es==1){
						document.getElementById('kaliforniazo').value="";
						document.getElementById('des').value="";
						document.getElementById('fecha').value="";
						document.getElementById('latitud').value="";
						document.getElementById('longitud').value="";
						alert("El Kaliforniazo se creó correctamente.");
						$('#cierroK').click();
						if(index==1){
							Refresh();
						}
						$('body,html').animate({scrollTop: y}, 500);
					}else{
						alert("No se pudo introducir el Kaliforniazo.");	
					}
				});
				$('#oculto').html('');
			}else{
				alert('Formato de fecha no valido: dd/mm/aaaa.');
			}
		}	
	});
	
	/******************************EDITO KALIFORNIAZO***************************************************************************/
	$('.kaliforniazoE').live('click',function(){
		var id=$(this).attr('data-id');
		var kaliforniazo=$('#kaliforniazo'+id).val().replace(/\s/g,'1-2');
		var des=$('#des'+id).val().replace(/\s/g,'1-2');
		/*var fecha=$('#fecha'+id).val().replace(/\s/g,'1-2');*/
		var fecha=$('#fecha'+id).val();
		
		var latitud=$('#latitud'+id).val().replace(/\s/g,'1-2');
		var longitud=$('#longitud'+id).val().replace(/\s/g,'1-2');
		
		if(kaliforniazo=="" || des=="" || fecha=="" ){
			alert('Falta algún dato obligatotio.');
		}else{
			if(comprueba_fecha(fecha)){
				data='?type=6&kaliforniazo='+kaliforniazo+'&des='+des+'&id='+id+'&fecha='+fecha+'&longitud='+longitud+'&latitud='+latitud;
				$('#oculto').load('ajax/ajax.php'+data,'',function(){
					var es=document.getElementById('confirmadoE'+id).value;
					if(es!=0){
						alert("El Kaliforniazo se editó correctamente.");
						$('#cierroE'+id).click();
						if(es==1){
							Refresh();
						}
						//$('body,html').animate({scrollTop: y}, 500);
					}else{
						alert("No se pudo editar el Kaliforniazo.");	
					}
				});
				$('#oculto').html('');
			}else{
				alert('Formato de fecha no valido: dd/mm/aaaa.');
			}
		}	
	});
	
	/******************************ELIMINO KALIFORNIAZO***************************************************************************/
	$('.icoEli').live('click',function(){
		
		var id=$(this).attr('data-id');
		if(confirm('¿Realmente quiere eliminar el Kaliforniazo?')){
			data='?type=7&id='+id;
			$('#oculto').load('ajax/ajax.php'+data,'',function(){
				var es=document.getElementById('confirmadoEli'+id).value;
				if(es==1){
					Refresh();
					alert("El Kaliforniazo se eliminó correctamente.");
				}else{
					alert("No se pudo eliminar el Kaliforniazo.");	
				}
				$('#oculto').html('');
			});
			
		}

	});
	
	/******************************LE DOY A CUALQUIER BOTON DEL MENU***************************************************************************/
	$('.icoEdi').live('click',function(){
		Stop();
		y = GetScrollPositions().y;
		if($('#menuA').hasClass('in')){
			$("#separador").click();
		}
		$('body,html').animate({scrollTop: 0}, 500);
	});
	
	/******************************CANCELO LA EDICION DE UN KALIFORNIAZO***************************************************************************/
	$('.cierroE').live('click',function(){
		$('body,html').animate({scrollTop: y}, 500);
		//Refresh();
		
	});
	
	/******************************EMPIEZO A CREAR IMG***************************************************************************/
	$('#creaImg').live('click',function(){
		Stop();
		$(this).tooltip('hide');
		var idCI=$(this).attr('data-id');
		
	});
	
	/******************************EMPIEZO A CREAR comentario***************************************************************************/
	$('#creaCom').live('click',function(){
		Stop();
		$(this).tooltip('hide');
		var idCI=$(this).attr('data-id');
		
	});
	
	/******************************CAMBIO DE MODELO***************************************************************************/
	$('.cambioModelo').live('click',function(){
		Stop();

		$(this).tooltip('hide');
		modelo=$(this).attr('data-model');
		
		$("[rel='tooltip']").tooltip('destroy');
		
		$('.active').addClass("cambioModelo");
		$('.cambioModelo').removeClass("active");
		$('.cambioModelo').removeAttr("rel");

		$(this).removeClass("cambioModelo");
		$(this).addClass("active");
		$(this).tooltip('destroy');
		$(this).removeAttr("rel");
		
		$('.cambioModelo').attr("rel","tooltip");		
		$("[rel='tooltip']").tooltip();
		
		if(modelo==1){
			$('.contenedorTotalImg50').addClass("contenedorTotalImg");
			$('.contenedorTotalImg').removeClass("contenedorTotalImg50");
			
			$('.kalIR').addClass("kalI1");
			$('.kalI1').removeClass("kalIR");
			$('.kalDR').addClass("kalD1");
			$('.kalD1').removeClass("kalDR");
			
			$('.kalII').addClass("kalI");
			$('.kalI').removeClass("kalII");
			$('.kalDI').addClass("kalD");
			$('.kalD').removeClass("kalDI");
			
			$('.kalII1').addClass("kalI1");
			$('.kalI1').removeClass("kalII1");
			$('.kalDI1').addClass("kalD1");
			$('.kalD1').removeClass("kalDI1");
			
		}else{
			if(modelo==2){
				$('.contenedorTotalImg50').addClass("contenedorTotalImg");
				$('.contenedorTotalImg').removeClass("contenedorTotalImg50");
				
				$('.kalI1').addClass("kalIR");
				$('.kalIR').removeClass("kalI1");
				$('.kalD1').addClass("kalDR");
				$('.kalDR').removeClass("kalD1");
				
				$('.kalII').addClass("kalI");
				$('.kalI').removeClass("kalII");
				$('.kalDI').addClass("kalD");
				$('.kalD').removeClass("kalDI");
				
				$('.kalII1').addClass("kalIR");
				$('.kalIR').removeClass("kalII1");
				$('.kalDI1').addClass("kalDR");
				$('.kalDR').removeClass("kalDI1");
			
			}else{
				$('.contenedorTotalImg').addClass("contenedorTotalImg50");
				$('.contenedorTotalImg50').removeClass("contenedorTotalImg");
				
				$('.kalI').addClass("kalII");
				$('.kalII').removeClass("kalI");
				$('.kalD').addClass("kalDI");
				$('.kalDI').removeClass("kalD");
				
				$('.kalI1').addClass("kalII1");
				$('.kalII1').removeClass("kalI1");
				$('.kalD1').addClass("kalDI1");
				$('.kalDI1').removeClass("kalD1");
				
				$('.kalIR').addClass("kalII1");
				$('.kalII1').removeClass("kalIR");
				$('.kalDR').addClass("kalDI1");
				$('.kalDI1').removeClass("kalDR");
			}
		}
		Play();
	});
	
	/******************************CREO IMG KALIFORNIAZO***************************************************************************/
	$('.kaliforniazoImgNuevo').live('click',function(){
		var titulo=$('#tituloIm').val().replace(/\s/g,'1-2');
		var des=$('#desIm').val().replace(/\s/g,'1-2');
		var fecha=$('#fechaIm').val().replace(/\s/g,'1-2');
		
		var url=$('#urlIm').val().replace(/\&/g,'*');
		if(titulo=="" || url=="" || des=="" || fecha==""){
			alert('Falta algún dato obligatotio.');
		}else{
			idK=document.getElementById('idK').value;
			data='?type=14&titulo='+titulo+'&url='+url+'&des='+des+'&fecha='+fecha+'&mail='+mail_usu+'&idK='+idK;
			$('#oculto').load('ajax/ajax.php'+data,'',function(){
				var es=document.getElementById('confirmadoEImgNuevo').value;
				if(es==1){
					alert("La imagen se creo correctamente.");
					$('#cierroEImgNuevo').click();
					Refresh();
					//$('body,html').animate({scrollTop: y}, 500);
				}else{
					alert("No se pudo crear la imagen.");	
				}
				$('#oculto').html('');
			});
			
		}
	});
	
	/******************************EDITO IMG KALIFORNIAZO***************************************************************************/
	$('.kaliforniazoImgE').live('click',function(){
		var id=$(this).attr('data-id');
		var titulo=$('#titulo'+id).val().replace(/\s/g,'1-2');
		var des=$('#des'+id).val().replace(/\s/g,'1-2');
		var fecha=$('#fecha'+id).val().replace(/\s/g,'1-2');
		var url=$('#url'+id).val().replace(/\&/g,'*');
		if(titulo=="" || url=="" || des=="" || fecha==""){
			alert('Falta algún dato obligatotio.');
		}else{
			data='?type=9&titulo='+titulo+'&url='+url+'&des='+des+'&id='+id+'&fecha='+fecha;
			$('#oculto').load('ajax/ajax.php'+data,'',function(){
				
				var es=document.getElementById('confirmadoEImg'+id).value;
				if(es!=0){
					alert("La imagen se editó correctamente.");
					$('#cierroE'+id).click();
					if(es==1){
						RefrescoImg(id);
					}
					//$('body,html').animate({scrollTop: y}, 500);
				}else{
					alert("No se pudo editar la imagen.");	
				}
				$('#oculto').html('');
			});
			
		}	
	});
	
	/******************************ELIMINO IMG KALIFORNIAZO***************************************************************************/
	$('.icoImgEli').live('click',function(){
		
		var id=$(this).attr('data-id');
		if(confirm('¿Realmente quiere eliminar la imagen?')){
			data='?type=10&id='+id;
			$('#oculto').load('ajax/ajax.php'+data,'',function(){
				var es=document.getElementById('confirmadoEli'+id).value;
				if(es==1){
					Refresh();
					alert("La imagen se eliminó correctamente.");
				}else{
					alert("No se pudo eliminar la imagen.");
				}
				$('#oculto').html('');
			});
		}
	});
	
	/******************************COMENTO IMG KALIFORNIAZO***************************************************************************/
	$('.kaliforniazoComenE').live('click',function(){
		var id=$(this).attr('data-id');
		var comentario=$('#comentario'+id).val().replace(/\s/g,'1-2');
		if(comentario==""){
			alert('Falta algún dato obligatotio.');
		}else{
			data='?type=11&comentario='+comentario+'&id='+id+'&mail='+mail_usu;
			$('#oculto').load('ajax/ajax.php'+data,'',function(){
				var es=document.getElementById('confirmadoComenImg'+id).value;
				if(es==1){
					alert("La imagen se comento correctamente.");
					$('#cierroEC'+id).click();
					RefrescoComentario(id);
					//$('body,html').animate({scrollTop: y}, 500);
				}else{
					alert("No se pudo comentar la imagen.");	
				}
				$('#oculto').html('');
			});
			
		}	
	});
	
	/******************************MODIFICO LA CUENTA DE USUARIO***************************************************************************/
	$('.modiCuenta').live('click',function(){
		//var mail_u=$('#mailU').val();
		var nombre=$('#usuario').val().replace(/\s/g,'1-2');
		var passV=$('#passv').val();
		var passN=$('#passn').val();
		var passNr=$('#passnr').val();
		if(nombre=="" || passV=="" || passN=="" || passNr==""){
			alert('Falta algún dato obligatotio.');
		}else{
			if(passN==passNr){
				data='?type=4&passV='+passV+'&passN='+passN+'&mail='+mail_usu+'&nombre='+nombre;
				$('#oculto').load('ajax/ajax.php'+data,'',function(){
					var es=document.getElementById('confirmado').value;
					if(es==1 || es==2){
						$('.nUsuario').html(nombre.replace(/1-2/g,' '));
						document.getElementById('passv').value="";
						document.getElementById('passn').value="";
						document.getElementById('passnr').value="";
						alert("Los datos se modificaron correctamente.");
						$('#cierroU').click();
						//$('body,html').animate({scrollTop: y}, 500);
					}else{
						alert("La contraseña no es correcta.");	
					}
				});
				$('#oculto').html('');
			}else{
				alert('Las contraseñas no coinciden.');	
			}
		}	
	});
	
	/******************************AUTOCOMPLETAR***************************************************************************/
	/*$('#buscar_usuario').autocomplete({
	   source : 'ajax/ajax.php?type=5',
	   select : function(event, ui){}
		   
	});*/
	
});