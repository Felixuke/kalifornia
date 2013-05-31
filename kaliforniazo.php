<?php
if(!isset($_SESSION)){
	session_start();
}
/*$index=1;*/
include("php/controlS.php");
if(isset($_REQUEST['id'])){
	$consulta='SELECT * FROM img WHERE id_kaliforniazo='.$_REQUEST['id'].' ORDER BY id DESC';
	$resultado=select($consulta,$conexion,$database_conexion);
}else{
	header('Location: principal.php');	
}
?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
        
        <title>Siempre nos quedar&aacute; Kalifornia</title>
        <meta name="description" content="">
        <?php include('php/head.php');?>
        
    </head>
    <body>
        <?php include('php/menu.php');?>
		<?php include('php/menuBoton.php');?>
        <div class="container padT30">
        	<div class="hero-unit">
                <h1>A&ntilde;ade una foto</h1>
            </div>
            <div class="row">
            <?php
			$x=3;
			while($reg=@mysql_fetch_array($resultado)){
				$consultaU='SELECT * FROM usuario WHERE mail="'.$reg['mail'].'"';
				$resultadoU=select($consultaU,$conexion,$database_conexion);
				$regU=@mysql_fetch_array($resultadoU);
			?> 
                <div class="span4 show-grid">
  
                    <img src="img/<?php echo $reg['id'];?>.jpg" width="100%" />
                    <h2><?php echo $reg['titulo'];?></h2>
                    <p class="descripcion"><?php echo $reg['descripcion'];?>To complement this strong statement, you don't want anything that competes for attention. Instead pick something plain and simple like Cabin.To complement this strong statement, you don't want anything that competes for attention. Instead pick something plain and simple like Cabin.</p>
                    <p class="autor">Subida por <?php 
                                if($regU['mail']==$_SESSION['mail']){ 
                                    echo '<span class="nUsuario">'.$regU['nombre'].'</span>';
                                }else{
                                    echo $regU['nombre'];
                                }?></p>

                </div>
            <?php
            }
            ?>
            </div>

        </div> 
        <!-- /container -->

        <?php include('php/footer.php');?>
    </body>
</html>