<?php
/**
 * Clase para manipular kaliforniazos y usuarios
 */
class Kalifornia
{
    /**
     * Conectar a base de datos
     */
    public function  __construct() {
		if(!strncmp($_SERVER['HTTP_HOST'],'localhost',9)){
			$dbhost = 'localhost';
			$dbuser = 'root';
			$dbpass = 'fantasia';
			$dbname = 'kalifornia';
		}else{
			$dbhost = "db439974848.db.1and1.com";
			$dbuser = "dbo439974848";
			$dbpass = "fantasia";
			$dbname = "db439974848";
		}

        @mysql_connect($dbhost, $dbuser, $dbpass);

        @mysql_select_db($dbname);
		
    }
	
	/**
     * Agregar kalforniazo en la base de datos
     *
     * @param array $datos
     */
    public function agregarKaliforniazo($datos){
        $sql = 'INSERT INTO kaliforniazo (proximo,mail,nombre,fecha,descripcion,latitud,longitud) 
				VALUES (1,
					   "'. str_replace('1-2',' ',$datos['mail']).'",
					   "'. str_replace('1-2',' ',$datos['kaliforniazo']).'",
					   "'. str_replace('1-2',' ',$datos['fecha']).'",
					   "'. str_replace('1-2',' ',$datos['des']).'",
					   "'. str_replace('1-2',' ',$datos['latitud']).'",
					   "'. str_replace('1-2',' ',$datos['longitud']).'")';   
        @mysql_query($sql);
		if(mysql_affected_rows()>0){
			echo '<input type="hidden" name="confirmadoK" id="confirmadoK" value="1"/>';	
		}else{
			echo '<input type="hidden" name="confirmadoK" id="confirmadoK" value="0"/>';
		}
    }
	
	/**
     * Muestro los kaliforniazos
     *
     * @param string $mail
     */
    public function mostrarKaliforniazo($mail){
		$x=0;
		$sql='SELECT * FROM kaliforniazo ORDER BY id DESC';
		$resultado= @mysql_query($sql);
		echo '<div class="row">';
		while($reg=@mysql_fetch_array($resultado)){
			
			$x++;
			
			$sql='SELECT * FROM usuario WHERE mail="'.$reg['mail'].'"';
			$resultadoU= @mysql_query($sql);
			$regU=@mysql_fetch_array($resultadoU);
			
			$sql='SELECT * FROM img WHERE id_kaliforniazo='.$reg['id'].' ORDER BY id DESC';
			$resultadoI= @mysql_query($sql);
			if($regI=@mysql_fetch_array($resultadoI)){
				$rutaimg='img/'.$regI['id'].'.jpg';
			}else{
				$rutaimg='img/kaliforniazo.jpg';	
			}
		?>
			<div class="span3 show-grid encima">

				<a href="kaliforniazo.php?id=<?php echo $reg['id'];?>" >
				<img src="<?php echo $rutaimg;?>" class="filaKaPImg" title="<?php echo $reg['nombre'];?>" alt="<?php echo $reg['nombre'];?>" />
				</a>
         <?php
		 		echo'
				<h2><a href="kaliforniazo.php?id='.$reg['id'].'" >'.$reg['nombre'].'</a></h2>';
				
				echo'
				<p class="descripcion">'.$reg['descripcion'].'</p>
				'; ?>
				
                <p class="iconos">
                <?php
						if($regU['mail']==$mail){ 
							echo '<a class="icoMio icoEdi" data-id="'.$reg['id'].'" href="#editaKaliforniazo'.$reg['id'].'" data-toggle="modal" role="button" title="Editar"><i class="icon-pencil"></i></a>
    							  <a class="icoMio icoEli" data-id="'.$reg['id'].'" href="#" title="Eliminar"><i class="icon-trash"></i></a>
								  
								  <span class="nUsuario">'.$regU['nombre'].' - '.$reg['fecha'].'</span>
								  
								  <div id="editaKaliforniazo'.$reg['id'].'" data-id="'.$reg['id'].'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h3 id="myModalLabel">Editar - '.$reg['nombre'].'</h3>
									  </div>
									  <form action="php/kaliforniazo-nuevo.php" method="post" enctype="multipart/form-data">
									  <div class="modal-body">
										<div class="row-fluid">
											<div class="span6">
												<p>Título</p>
												<input type="text" name="kaliforniazo'.$reg['id'].'" id="kaliforniazo'.$reg['id'].'" placeholder="Kaliforniazo" value="'.$reg['nombre'].'"/>
												<p>Descripción</p>
												<textarea name="des'.$reg['id'].'" id="des'.$reg['id'].'" placeholder="Breve descripción">'.$reg['descripcion'].'</textarea>
												<p>Fecha</p>
												<input type="text" name="fecha'.$reg['id'].'" id="fecha'.$reg['id'].'" placeholder="Fecha: 00/00/0000" value="'.$reg['fecha'].'"/>
											</div>
											<div class="span6">
												<p>Latitud</p>
												<input type="text" name="latitud'.$reg['id'].'" id="latitud'.$reg['id'].'" placeholder="Latitud: 36.06736397651583" value="'.$reg['latitud'].'"/>
												<p>Longitud</p>
												<input type="text" name="longitud'.$reg['id'].'" id="longitud'.$reg['id'].'" placeholder="Longitud: -5.7354748249053955" value="'.$reg['longitud'].'"/>
											</div>
										</div>
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-directo cierroE" id="cierroE'.$reg['id'].'" data-dismiss="modal" aria-hidden="true">Cerrar</button>
										<button type="button" data-id="'.$reg['id'].'" class="btn btn-kalifa btn-directo kaliforniazoE">Guardar</button>
									  </div>
									  </form>
									</div>';
						}else{
							echo '<span class="icoMioNo"><i class="icon-pencil"></i></span>
    							  <span class="icoMioNo"><i class="icon-trash"></i></span>
								  '.$regU['nombre'].' - '.$reg['fecha'];
						}
				?>
                </p>
						
			</div>
		<?php
			if($x%4==0){
				echo '</div><div class="row">';	
			}
		}
		echo '</div>';
	}
	
	/**
     * Actualizar informacion del kaliforniazo
     *
     * @param array $datos
     * @param string $mail
     */
    public function editarKaliforniazo($datos){
		
		$sql= "UPDATE kaliforniazo SET nombre='" . str_replace('1-2',' ',$datos['kaliforniazo']) . "' ,
									   fecha='" . str_replace('1-2',' ',$datos['fecha']) . "' ,
									   descripcion='" . str_replace('1-2',' ',$datos['des']) . "' ,
									   latitud='" . str_replace('1-2',' ',$datos['latitud']) . "' ,
									   longitud='" . str_replace('1-2',' ',$datos['longitud']) . "' WHERE id = " . $datos['id'];
        $resultado=@mysql_query($sql);
		if(mysql_affected_rows()>0){
			echo '<input type="hidden" name="confirmadoE'. $datos['id'] .'" id="confirmadoE'. $datos['id'] .'" value="1"/>';	
		}else{	
			echo '<input type="hidden" name="confirmadoE'. $datos['id'] .'" id="confirmadoE'. $datos['id'] .'" value="0"/>';	
		}
    }
	
	/**
     * Eliminar kaliforniazo
     *
     * @param array $datos
     */
    public function eliminarKaliforniazo($datos){
		
		$sql= "DELETE FROM kaliforniazo WHERE id = " . $datos['id'];
        $resultado=@mysql_query($sql);
		if(mysql_affected_rows()>0){
			echo '<input type="hidden" name="confirmadoEli'. $datos['id'] .'" id="confirmadoEli'. $datos['id'] .'" value="1"/>';	
		}else{	
			echo '<input type="hidden" name="confirmadoEli'. $datos['id'] .'" id="confirmadoEli'. $datos['id'] .'" value="0"/>';	
		}
    }
					   
    /**
     * Seleccionar usuario a partir de un caracter en nombre
     *
     * @param string $nombreUsuario
     * @return array
     */
    public function buscarUsuario($nombreUsuario){
		$datos = array();
        $sql = "SELECT * FROM usuario
                WHERE nombre LIKE '%$nombreUsuario%'";

        $resultado = @mysql_query($sql);

        while ($row = @mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['nombre'] ,
                             "id" => $row['mail']);
        }

        return $datos;
    }
    /**
     * Agregar usuarios en la base de datos
     *
     * @param array $datos
     */
    public function agregarUsuario($datos){
        $sql = "INSERT INTO usuario (nombre, mail, pass) VALUES ('" . $datos['nombre'] . "',
																 '" . $datos['mail'] . "',
																 PASSWORD('" . $datos['pass'] . "'))";
        @mysql_query($sql);
    }
    /**
     * Actualizar informacion de usuario
     *
     * @param array $datos
     * @param string $mail
     */
    public function editarUsuario($datos, $mail){
		$sql= "UPDATE usuario SET nombre='" . str_replace('1-2',' ',$datos['nombre']) . "' , pass=PASSWORD('".$datos['passN']."') WHERE mail = '" . $mail . "' and pass=PASSWORD('".$datos['passV']."')";
        $resultado=@mysql_query($sql);
		if(mysql_affected_rows()>0){
			echo '<input type="hidden" name="confirmado" id="confirmado" value="1"/>';	
		}else{
			$sql = "SELECT * FROM usuario WHERE mail = '" . $mail . "' and pass=PASSWORD('".$datos['passV']."')";
			$resultado=@mysql_query($sql);
			if(mysql_affected_rows()>0){
				echo '<input type="hidden" name="confirmado" id="confirmado" value="2"/>';
			}else{
				echo '<input type="hidden" name="confirmado" id="confirmado" value="0"/>';
			}
		}
    }
}
