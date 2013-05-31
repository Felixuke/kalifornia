<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
function select($consulta,$conexion,$basedatos){
	@mysql_select_db($basedatos,$conexion);
	return @mysql_query($consulta,$conexion);
}
if(!strncmp($_SERVER['HTTP_HOST'],'localhost',9)){
	$hostname_conexion = "localhost";
	$database_conexion = "kalifornia";
	$username_conexion = "root";
	$password_conexion = "fantasia";
}else{
	$hostname_conexion = "db439974848.db.1and1.com";
	$database_conexion = "db439974848";
	$username_conexion = "dbo439974848";
	$password_conexion = "fantasia";
}

$conexion = @mysql_connect($hostname_conexion, $username_conexion, $password_conexion) or die('Error en la conexión con la base de datos. Disculpen las mlestias.<br/><strong>'.mysql_error().'</strong>'); 
?>