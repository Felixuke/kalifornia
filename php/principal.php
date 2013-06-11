 <?php
 $mail=$_SESSION['mail'];
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
echo '</div></div>';

@mysql_free_result($resultado);
@mysql_free_result($resultadoU);
@mysql_free_result($resultadoI);
?>