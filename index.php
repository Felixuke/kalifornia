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
        <?php include('php/menu.php');?>
        <div class="container marT30">
        	<div class="hero-unit">
                <h1>Lo prometido es deuda!</h1>
                <h2>Te presentamos la web de los Kaliforniazos.</h2>
                <p>Aqu&iacute; puedes dejar todas las fotos y comentarios de los viajes, reuniones, salidas, quedadas y dem&aacute;s actividades que realizas conjuntamente con ese grupo de personas inigualables al que perteneces.</p>
                <br/>
                <p>Un saludo del equipo inform&aacute;tico de Kalifornia.</p>
            </div>
        </div> 
        <!-- /container -->

        <?php include('php/footer.php');?>
    </body>
</html>