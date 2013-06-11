<?php
if(!isset($_SESSION)){
	session_start();
}
/*$index=1;*/
include("php/controlS.php");
if(isset($_REQUEST['id'])){
	
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
    	<?php include('php/carga.php');?>
        <?php include('php/menu.php');?>
		<?php include('php/menuBoton.php');?>
        
        <div class="container marT60">
       		<?php
			$modelo=1; include('php/heroKalifa.php');?>
            <div id="principalK">
            	<?php include('php/principalUno.php');?>
            </div>
       	</div>
        <!-- /container -->
		<input type="hidden" name="index" id="index" value="0"/>
        <input type="hidden" name="idK" id="idK" value="<?php echo $_REQUEST['id'];?>"/>
        <?php include('php/footer.php');?>
        
    </body>
</html>