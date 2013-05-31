// JavaScript Document
$(function(){
	/******************************MUESTRO LOS KALIFORNIAZOS***************************************************************************/
	var mail_usu=$('#mailU').val();
	var data;
	$('#principalK').load('ajax/ajax.php?type=1&mail='+mail_usu,'',function(){});
	
	/******************************CREO KALIFORNIAZO***************************************************************************/
	$('#kaliforniazoNuevo').live('click',function(){
		//var mail=$('#mailU').val();
		var kaliforniazo=$('#kaliforniazo').val().replace(/\s/g,'1-2');
		var des=$('#des').val().replace(/\s/g,'1-2');
		var fecha=$('#fecha').val().replace(/\s/g,'1-2');
		var latitud=$('#latitud').val().replace(/\s/g,'1-2');
		var longitud=$('#longitud').val().replace(/\s/g,'1-2');
		
		if(kaliforniazo=="" || des=="" || fecha==""){
			alert('Falta algún dato obligatotio.');
		}else{
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
					$('#principalK').load('ajax/ajax.php?type=1&mail='+mail_usu,'',function(){});
				}else{
					alert("No se pudo introducir el Kaliforniazo.");	
				}
			});
			$('#oculto').html('');
		}	
	});
	
	/******************************EMPIEZO A EDITAR KALIFORNIAZO***************************************************************************/
	$('.icoEdi').live('click',function(){
		Stop();
		$('body,html').animate({scrollTop: 0}, 500);
	});
	
	
	/******************************CANCELO LA EDITACION KALIFORNIAZO***************************************************************************/
	$('.cierroE').live('click',function(){
		Refresh();
	});
	
	/******************************EDITO KALIFORNIAZO***************************************************************************/
	$('.kaliforniazoE').live('click',function(){
		var id=$(this).attr('data-id');
		var kaliforniazo=$('#kaliforniazo'+id).val().replace(/\s/g,'1-2');
		var des=$('#des'+id).val().replace(/\s/g,'1-2');
		var fecha=$('#fecha'+id).val().replace(/\s/g,'1-2');
		var latitud=$('#latitud'+id).val().replace(/\s/g,'1-2');
		var longitud=$('#longitud'+id).val().replace(/\s/g,'1-2');
		
		if(kaliforniazo=="" || des=="" || fecha==""){
			alert('Falta algún dato obligatotio.');
		}else{
			data='?type=6&kaliforniazo='+kaliforniazo+'&des='+des+'&id='+id+'&fecha='+fecha+'&longitud='+longitud+'&latitud='+latitud;
			$('#oculto').load('ajax/ajax.php'+data,'',function(){
				var es=document.getElementById('confirmadoE'+id).value;
				if(es==1){
					alert("El Kaliforniazo se editó correctamente.");
					$('#cierroE'+id).click();
				}else{
					alert("No se pudo editar el Kaliforniazo.");	
				}
			});
			$('#oculto').html('');
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
					$('#principalK').load('ajax/ajax.php?type=1&mail='+mail_usu,'',function(){});
					alert("El Kaliforniazo se eliminó correctamente.");
				}else{
					alert("No se pudo eliminar el Kaliforniazo.");	
				}
			});
			$('#oculto').html('');
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
	$('#buscar_usuario').autocomplete({
	   source : 'ajax/ajax.php?type=5',
	   select : function(event, ui){}
		   
	});
	
});

function Refresh(){
	var mailR=$('#mailU').val();
	$('#principalK').load('ajax/ajax.php?type=1&mail='+mailR,'',function(){});
	idSetTime=setTimeout("Refresh()",5000);	
}
function Stop()	{
	clearTimeout(idSetTime);
}
var idSetTime;
Refresh();
