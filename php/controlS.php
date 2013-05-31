<?php include("Connections/conexion.php");
$error="no";
if(isset($index)){
	if(isset($_REQUEST['mail1']) && isset($_REQUEST['pass1'])){
		mysql_select_db($database_conexion,$conexion);
		$consulta='SELECT * FROM usuario where mail="'.$_REQUEST['mail1'].'" and pass=PASSWORD("'.$_REQUEST['pass1'].'")';
		$res=@mysql_query($consulta,$conexion);
		$cont=@mysql_num_rows($res);
		$reg=@mysql_fetch_array($res);
		if($cont>0){
			$_SESSION['usuario']=$reg['nombre'];
			$_SESSION['mail']=$reg['mail'];
			$_SESSION['janders']="jurilis";
			header('Location: principal.php');
		}else{
			$error="si";
		}
	}else{
		if(isset($_SESSION['mail']) && isset($_SESSION['usuario']) && isset($_SESSION['janders'])){
			header('Location: principal.php');	
		}	
	}
}else{
	if(!isset($_SESSION['mail']) || !isset($_SESSION['usuario']) || !isset($_SESSION['janders'])){
		header('Location: index.php');	
	}
	mysql_select_db($database_conexion,$conexion);
	$consulta='SELECT * FROM usuario where mail="'.$_SESSION['mail'].'"';
	$res=@mysql_query($consulta,$conexion);
	$cont=@mysql_num_rows($res);
	$reg=@mysql_fetch_array($res);
	if($cont>0){
		$_SESSION['usuario']=$reg['nombre'];
		$_SESSION['mail']=$reg['mail'];
		$_SESSION['janders']="jurilis";
	}else{
		$error="si";
	}
} ?>