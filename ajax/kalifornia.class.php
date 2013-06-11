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
        $res=@mysql_query($sql);
		if(mysql_affected_rows()>0){
			echo '<input type="hidden" id="confirmadoK" value="1"/>';	
		}else{
			echo '<input type="hidden" id="confirmadoK" value="0"/>';
		}
		@mysql_free_result($res);
    }
	
	/**
     * Actualizar informacion del kaliforniazo
     *
     * @param array $datos
     */
    public function editarKaliforniazo($datos){
		
		$sql= "UPDATE kaliforniazo SET nombre='" . str_replace('1-2',' ',$datos['kaliforniazo']) . "' ,
									   fecha='" . str_replace('1-2',' ',$datos['fecha']) . "' ,
									   descripcion='" . str_replace('1-2',' ',$datos['des']) . "' ,
									   latitud='" . str_replace('1-2',' ',$datos['latitud']) . "' ,
									   longitud='" . str_replace('1-2',' ',$datos['longitud']) . "' WHERE id = " . $datos['id'];
        $resultado=@mysql_query($sql);
		if(mysql_affected_rows()>0){
			echo '<input type="hidden" id="confirmadoE'. $datos['id'] .'" value="1"/>';	
		}else{	
			if(mysql_error()==0){
				echo '<input type="hidden" id="confirmadoE'. $datos['id'] .'" value="2"/>';	
			}else{
				echo '<input type="hidden" id="confirmadoE'. $datos['id'] .'" value="0"/>';	
			}
		}
		@mysql_free_result($resultado);
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
			echo '<input type="hidden" id="confirmadoEli'. $datos['id'] .'" value="1"/>';	
		}else{	
			echo '<input type="hidden" id="confirmadoEli'. $datos['id'] .'" value="0"/>';	
		}
		@mysql_free_result($resultado);
    }
	
	/**
     * Muestro los kaliforniazos
     *
     * @param string $mail
     */
    public function mostrarKaliforniazo($mail){
		$x=0;
		$y=0;
		$sql='SELECT * FROM kaliforniazo ORDER BY id DESC';
		$resultado= @mysql_query($sql);
		echo '
		<div class="contenedorTotalImg40">
		<div class="row">';
		while($reg=@mysql_fetch_array($resultado)){
			
			$x++;
			$y++;
			$sql='SELECT * FROM usuario WHERE mail="'.$reg['mail'].'"';
			$resultadoU= @mysql_query($sql);
			$regU=@mysql_fetch_array($resultadoU);
			
			$sql='SELECT * FROM img WHERE id_kaliforniazo='.$reg['id'].' ORDER BY id DESC';
			$resultadoI= @mysql_query($sql);
			if($regI=@mysql_fetch_array($resultadoI)){
				$rutaimg=$regI['url'];
			}else{
				$rutaimg='img/kaliforniazo.jpg';	
			}
		?>
			<div class="span3 show-grid encima<?php if($y!=1){echo' encimaT';}?>">

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
							echo '<a class="icoMio icoEdi" data-id="'.$reg['id'].'" href="#editaKaliforniazo'.$reg['id'].'" data-toggle="modal" role="button" rel="tooltip" data-placement="bottom" data-original-title="Editar"><i class="icon-pencil"></i></a>
    							  <a class="icoMio icoEli" data-id="'.$reg['id'].'" href="#eliminaKaliforniazo" rel="tooltip" data-placement="bottom" data-original-title="Eliminar"><i class="icon-trash"></i></a>
								  
								  <span class="nUsuario">'.$regU['nombre'].' - '.$reg['fecha'].'</span>
								  
								  <div id="editaKaliforniazo'.$reg['id'].'" data-id="'.$reg['id'].'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-header">
										<button type="button" class="close cierroE" data-dismiss="modal" aria-hidden="true">×</button>
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
										<button type="button" data-id="'.$reg['id'].'" class="btn btn-kalifa btn-large kaliforniazoE">Guardar</button>
										<button type="button" class="btn btn-large cierroE" id="cierroE'.$reg['id'].'" data-dismiss="modal" aria-hidden="true">Cerrar</button>
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
				echo '</div></div><div class="contenedorTotalImg40"><div class="row">';
				$y=0;
			}
		}
		if($x%4!=0){
			echo '</div></div><div class="contenedorTotalImg40"><div class="row">';
		}
		echo '</div>';
		@mysql_free_result($resultado);
		@mysql_free_result($resultadoU);
		@mysql_free_result($resultadoI);
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	/**
     * Muestro los datos de una imagen de un kaliforniazo
     * @param int $idV
     * @param string $mail
     */
	public function veo_datos($idV,$mail){
		$consultaVeo='SELECT * FROM img WHERE id='.$idV;
		$resultadoVeo=@mysql_query($consultaVeo);
		$regV=@mysql_fetch_array($resultadoVeo);
		$consultaU='SELECT * FROM usuario WHERE mail="'.$regV['mail'].'"';
		$resultadoU=@mysql_query($consultaU);
		$regU=@mysql_fetch_array($resultadoU);
		echo'
		<h2>'.$regV['titulo'].'</h2>
		
		<p class="descripcion">'.$regV['descripcion'].'</p>
		<p class="iconos">';
		
		if($regU['mail']==$mail){ 
			echo '<a class="icoMio icoEdi" data-id="'.$regV['id'].'" href="#editaKaliforniazoI'.$regV['id'].'" data-toggle="modal" role="button" rel="tooltip" data-placement="bottom" data-original-title="Editar"><i class="icon-pencil"></i></a>
				  <a class="icoMio icoImgEli" data-id="'.$regV['id'].'" href="#eliminaKaliforniazoI" rel="tooltip" data-placement="bottom" data-original-title="Eliminar"><i class="icon-trash"></i></a>
				  
				  <span class="nUsuario">'.$regU['nombre'].' - '.$regV['fecha'].'</span>
				  
				  <div id="editaKaliforniazoI'.$regV['id'].'" data-id="'.$regV['id'].'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-header">
						<button type="button" class="close cierroE" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">Editar - '.$regV['titulo'].'</h3>
					  </div>
					  <form action="php/kaliforniazo-nuevo.php" method="post" enctype="multipart/form-data">
					  <div class="modal-body">
						<div class="row-fluid">
							<div class="span6">
								<p>Título</p>
								<input type="text" id="titulo'.$regV['id'].'" placeholder="Titulo de la imagen" value="'.$regV['titulo'].'"/>
								<p>URL</p>
								<textarea id="url'.$regV['id'].'" placeholder="URL de la imagen">'.$regV['url'].'</textarea>
							</div>
							<div class="span6">
								<p>Fecha</p>
								<input type="text" disabled id="fecha'.$regV['id'].'" placeholder="Fecha: 00/00/0000" value="'.$regV['fecha'].'"/>
								<p>Descripción</p>
								<textarea id="des'.$regV['id'].'" placeholder="Breve descripción">'.$regV['descripcion'].'</textarea>
							</div>
						</div>
					  </div>
					  <div class="modal-footer">
						<button type="button" data-id="'.$regV['id'].'" class="btn btn-kalifa btn-large kaliforniazoImgE">Guardar</button>
						<button type="button" class="btn btn-large cierroE" id="cierroE'.$regV['id'].'" data-dismiss="modal" aria-hidden="true">Cerrar</button>
					  </div>
					  </form>
					</div>';
		}else{
			echo '<span class="icoMioNo"><i class="icon-pencil"></i></span>
				  <span class="icoMioNo"><i class="icon-trash"></i></span>
				  '.$regU['nombre'].' - '.$regV['fecha'];
		}
		
		echo'</p>';
		$consultaComen='SELECT * FROM comentarioi WHERE idImg='.$regV['id'].' ORDER BY id DESC';
		$resultadoComen= @mysql_query($consultaComen);
		while($regComen=@mysql_fetch_array($resultadoComen)){
			
			$consultaUC='SELECT * FROM usuario WHERE mail="'.$regComen['mail'].'"';
			$resultadoUC=@mysql_query($consultaUC);
			$regUC=@mysql_fetch_array($resultadoUC);
			echo'
			<div class="comentario">
			<p class="autor"><i class="icon-comment opaco30"></i>&nbsp;'.$regUC['nombre'].' - '.$regComen['fecha'].'</p>
			'.$regComen['comentario'].'
			</div>';
		}
		echo'
		<a class="btn btn-large marT20 icoEdi" data-id="'.$regV['id'].'" href="#comentoI'.$regV['id'].'" data-toggle="modal" role="button" rel="tooltip" data-placement="bottom" data-original-title="Comentar Foto"><i class="icon-plus"></i><i class="icon-comment"></i></a>
		<!--<a class="btn btn-block marT20 icoEdi" data-id="'.$regV['id'].'" href="#comentoI'.$regV['id'].'" data-toggle="modal" role="button">Coméntala !!!</a>-->
		</div>
		
		<div id="comentoI'.$regV['id'].'" data-id="'.$regV['id'].'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-header">
			<button type="button" class="close cierroE" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Comenta - '.$regV['titulo'].'</h3>
		  </div>
		  <form action="php/kaliforniazo-nuevo.php" method="post" enctype="multipart/form-data">
		  <div class="modal-body">
			<div class="row-fluid">
				<div class="span12">
					<textarea id="comentario'.$regV['id'].'" placeholder="Comentario"></textarea>
				</div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" data-id="'.$regV['id'].'" class="btn btn-kalifa btn-large kaliforniazoComenE">Comentar</button>
			<button type="button" class="btn btn-large cierroE" id="cierroEC'.$regV['id'].'" data-dismiss="modal" aria-hidden="true">Cerrar</button>
		  </div>
		  </form>';
		  
		@mysql_free_result($resultadoComen);
		@mysql_free_result($resultadoUC);
		@mysql_free_result($resultadoU);
		@mysql_free_result($resultadoVeo);
	}
	
	/**
     * Muestro UNA IMAGEN COMPLETA de un kaliforniazo
     * @param int $idV
     * @param string $mail
	 * @param int $modelo
	 * @param int $x
     */
	public function veo_img($idV,$mail,$modelo,$x){
		$consultaVeo='SELECT * FROM img WHERE id='.$idV;
		$resultadoVeo=@mysql_query($consultaVeo);
		$regV=@mysql_fetch_array($resultadoVeo);
		if($x%2==0){
			if($modelo!=3){
				$kalI='kalI';
				$kalD='kalD';
			}else{
				$kalI='kalII';
				$kalD='kalDI';	
			}
		}else{
			if($modelo==1){
				$kalI='kalI1';
				$kalD='kalD1';
			}else{
				if($modelo==2){
					$kalI='kalIR';
					$kalD='kalDR';
				}else{
					$kalI='kalII1';
					$kalD='kalDI1';
				}
			}
		}
		echo'<div class="'.$kalI.'" id="kalI'.$regV['id'].'">';
		
		echo'<img src="'.$regV['url'].'" class="imgKali" />
		</div>
		<div class="'.$kalD.'" id="kalD'.$regV['id'].'">';
			$this->veo_datos($regV['id'],$mail);
		echo'
		</div>
		<div class="limpiar"></div>';
		@mysql_free_result($resultadoVeo);
	}
	
	/**
     * Muestro un kaliforniazo entero
     * @param array $datos
     */
	public function mostrarUnKaliforniazo($datos){
			$consulta='SELECT * FROM img WHERE id_kaliforniazo='.$datos['id'].' ORDER BY id DESC';
			$resultado=@mysql_query($consulta);
			
        	echo'
			<div id="nuevaImg" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
				<button type="button" class="close cierroE" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Nueva Imagen</h3>
				</div>
				<form action="php/kaliforniazo-nuevo.php" method="post" enctype="multipart/form-data">
				<div class="modal-body">
				<div class="row-fluid">
					<div class="span6">
						<p>Título</p>
						<input type="text" id="tituloIm" placeholder="Titulo de la imagen" value=""/>
						<p>URL</p>
						<textarea id="urlIm" placeholder="URL de la imagen"></textarea>
					</div>
					<div class="span6">
						<p>Fecha</p>
						<input type="text" id="fechaIm" placeholder="Fecha: 00/00/0000" value="'.date('d/m/Y').'"/>
						<p>Descripción</p>
						<textarea id="desIm" placeholder="Breve descripción"></textarea>
					</div>
				</div>
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-kalifa btn-large kaliforniazoImgNuevo">Guardar</button>
				<button type="button" class="btn btn-large cierroE" id="cierroEImgNuevo" data-dismiss="modal" aria-hidden="true">Cerrar</button>
				</div>
				</form>
			</div>';
			$x=2;
			while($reg=@mysql_fetch_array($resultado)){
					echo'<div class="contenedorTotalImg" id="kal'.$reg['id'].'" data-x="'.$x.'">';
					$this->veo_img($reg['id'],$datos['mail'],$datos['modelo'],$x);
					echo'</div>';
					$x++;
			}
		@mysql_free_result($resultado);
		
	}
	
	/**
     * Crear imagen
     *
     * @param array $datos
     */
	public function compruebo_url($urlOr){
		$url=str_replace('*','&',$urlOr);
	 	$url=str_replace('https://www.dropbox.com','https://dl.dropbox.com',$url);
		$url=str_replace('https://docs.google.com/file/d/','http://drive.google.com/uc?export=view&id=',$url);
		$url=str_replace('/edit?usp=sharing','',$url);
		$url=str_replace('/edit','',$url);
		return $url;
	}
		
    public function agregarImgKaliforniazo($datos){
		$url=$this->compruebo_url($datos['url']);
		$sql= "INSERT INTO img (mail,id_kaliforniazo,titulo,fecha,url,descripcion) 
							  VALUES ( '" . $datos['mail'] . "' ,
							  		   " . $datos['idK'] . " ,
							  		   '" . str_replace('1-2',' ',$datos['titulo']) . "' ,
									   '" . str_replace('1-2',' ',$datos['fecha']) . "' ,
									   '" . $url . "' ,
									   '" . str_replace('1-2',' ',$datos['des']) . "')";
        $resultado=@mysql_query($sql);
		if(mysql_affected_rows()>0){
			echo '<input type="hidden" id="confirmadoEImgNuevo" value="1"/>';	
		}else{
			echo '<input type="hidden" id="confirmadoEImgNuevo" value="0"/>';	
		}
		@mysql_free_result($resultado);
    }
	
	/**
     * Actualizar informacion de la imagen
     *
     * @param array $datos
     */
    public function editarImgKaliforniazo($datos){
		$url=$this->compruebo_url($datos['url']);
		$sql= "UPDATE img SET titulo='" . str_replace('1-2',' ',$datos['titulo']) . "' ,
									   fecha='" . str_replace('1-2',' ',$datos['fecha']) . "' ,
									   url='" . $url . "' ,
									   descripcion='" . str_replace('1-2',' ',$datos['des']) . "' WHERE id = " . $datos['id'];
        $resultado=@mysql_query($sql);
		if(mysql_affected_rows()>0){
			echo '<input type="hidden" id="confirmadoEImg'. $datos['id'] .'" value="1"/>';	
		}else{
			if(mysql_error()==0){
				echo '<input type="hidden" id="confirmadoEImg'. $datos['id'] .'" value="2"/>';	
			}else{
				echo '<input type="hidden" id="confirmadoEImg'. $datos['id'] .'" value="0"/>';
			}	
		}
		@mysql_free_result($resultado);
    }
	
	/**
     * Eliminar imagen kaliforniazo
     *
     * @param array $datos
     */
    public function eliminarImgKaliforniazo($datos){
		
		$sql= "DELETE FROM img WHERE id = " . $datos['id'];
        $resultado=@mysql_query($sql);
		if(mysql_affected_rows()>0){
			$dir='../img/'.$datos['id'].'.jpg';
			if(is_file($dir)){
				unlink($dir);
			}
			echo '<input type="hidden" id="confirmadoEli'. $datos['id'] .'" value="1"/>';	
		}else{	
			echo '<input type="hidden" id="confirmadoEli'. $datos['id'] .'" value="0"/>';	
		}
		@mysql_free_result($resultado);
    }
	
	/**
     * Agregar usuarios en la base de datos
     *
     * @param array $datos
     */
    public function agregarComenImgKaliforniazo($datos){
        $sql = "INSERT INTO comentarioi (idImg,mail,comentario,fecha,hora) 
				VALUES (" . $datos['id'] . ",
					    '" . $datos['mail'] . "',
						'" . str_replace('1-2',' ',$datos['comentario']) . "',
						'" . date('d/m/Y') . "',
				    	'" . date('H:i') . "')";
        $resultado=@mysql_query($sql);
		if(mysql_affected_rows()>0){
			echo '<input type="hidden" id="confirmadoComenImg'. $datos['id'] .'" value="1"/>';
		}else{
			echo '<input type="hidden" id="confirmadoComenImg'. $datos['id'] .'" value="0"/>';
		}
		@mysql_free_result($resultado);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			   
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
		@mysql_free_result($resultado);
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
        $resultado=@mysql_query($sql);
		@mysql_free_result($resultado);
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
				echo '<input type="hidden" id="confirmado" value="2"/>';
			}else{
				echo '<input type="hidden" id="confirmado" value="0"/>';
			}
		}
		@mysql_free_result($resultado);
    }
}
