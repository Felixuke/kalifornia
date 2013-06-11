<?php
if(!isset($_SESSION)){
	session_start();
}
$index=1;
include("php/controlS.php");?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
        
        <title>Siempre nos quedar&aacute; Kalifornia</title>
        <meta name="description" content="">
        <?php include('php/head.php');?>
        
    </head>
    <body>
        <?php include('php/carga.php');?>
        <div id="fondo">
        <img id="imgFondo" src=""/>
        </div>
      
        <div class="container marT20x100">
        	<div class="hero-unit">
            	<div class="titulo"></div>
                <div class="limpiar"></div>
                <h2>Lo prometido es deuda. Te presentamos la web de los Kaliforniazos.</h2>
                <br/>
                <form class="">
                <input class="span4 index" type="text" placeholder="Email" name="mail1">
                <input class="span4 index" type="password" placeholder="Password" name="pass1">
                <button type="submit" class="btn btn-large btn-info">Entrar en Kalifornia</button>
            	</form>
                <input type="hidden" name="index" id="index" value="si"/>
            	<br/>
                <p>Aqu&iacute; puedes dejar todas las fotos y comentarios de los viajes, reuniones, salidas, quedadas y dem&aacute;s actividades que realizas conjuntamente con ese grupo de personas inigualables al que perteneces.</p>
            
                <p>Un saludo del equipo inform&aacute;tico de Kalifornia.</p>
            </div>
        </div> 
        

        <?php include('php/footer.php');?>
    </body>
</html>