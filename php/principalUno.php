<?php
function veo_datos($regV,$mail){
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
}

function veo_img($idV,$mail,$modelo,$x){
	$consultaVeoI='SELECT * FROM img WHERE id='.$idV;
	$resultadoVeoI=@mysql_query($consultaVeoI);
	$regV=@mysql_fetch_array($resultadoVeoI);
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
		veo_datos($regV,$mail);
	echo'
	</div>
	<div class="limpiar"></div>';
	@mysql_free_result($resultadoVeoI);
}

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

$consulta='SELECT * FROM img WHERE id_kaliforniazo='.$_REQUEST['id'].' ORDER BY id DESC';
$resultado=@mysql_query($consulta);
$x=2;
while($reg=@mysql_fetch_array($resultado)){
		echo'<div class="contenedorTotalImg" id="kal'.$reg['id'].'" data-x="'.$x.'">';
		veo_img($reg['id'],$_SESSION['mail'],$modelo,$x);
		echo'</div>';
		$x++;
}

@mysql_free_result($resultado);

?>