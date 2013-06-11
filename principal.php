<?php
if(!isset($_SESSION)){
	session_start();
}
/*$index=1;*/
include("php/controlS.php");

/*$consulta='SELECT * FROM kaliforniazo ORDER BY id DESC';
$resultado=select($consulta,$conexion,$database_conexion);*/
?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
        
        <title>Siempre nos quedar&aacute; Kalifornia</title>
        <meta name="description" content="">
        <?php include('php/head.php');?>
        
    </head>
    <body>
    	<?php include('php/carga.php');?>
        <?php include('php/menu.php');?>
		<?php include('php/menuBoton.php');?>
        <div class="container marT60">
        	<div class="hero-unit hero-p">
                <h2 class="proximamente">Preparando el pr&oacute;ximo Kaliforniazo:
                <div class="proximamente">"La Graciosa"</div>
                
              </h2>
                <br/><br/>
                Salida el 15 de Julio desde el aeropuerto de Sevilla, el coste es de 80 € ida y vuelta.</div>
			<!--
            <div class="row">
                <div class="span1">
                </div>
                <div class="span7">
                    <p class="fecha">Kaliforniazo</p>
                </div>
                <div class="span2">
                    <p class="fecha">fecha</p>  
                </div>
                <div class="span2">
                	<p class="fecha">actualizado</p>
                </div>
            </div>
            -->
            <div id="principalK">
            	<?php include('php/principal.php');?>
            </div>
        </div> 
        <!-- /container -->
        <input type="hidden" name="index" id="index" value="1"/>
        <?php include('php/footer.php');?>
    </body>
</html>