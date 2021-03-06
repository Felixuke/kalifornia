<!-- Button to trigger modal -->
<!-- Modal -->
<div id="nuevoKaliforniazo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close cierroE" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">+ Kaliforniazo</h3>
  </div>
  <form action="php/kaliforniazo-nuevo.php" method="post" enctype="multipart/form-data">
  <div class="modal-body">
  	<div class="row-fluid">
    	<div class="span6">
        	<p>Título</p>
            <input type="text" name="kaliforniazo" id="kaliforniazo" placeholder="Kaliforniazo"/>
            <p>Descripción</p>
            <textarea name="des" id="des" placeholder="Breve descripción"></textarea>
            <p>Fecha</p>
            <input type="text" name="fecha" id="fecha" placeholder="Fecha: 00/00/0000"/>
            
        </div>
        <div class="span6">
        	<p>Latitud</p>
            <input type="text" name="latitud" id="latitud" placeholder="Latitud: 36.06736397651583"/>
            <p>Longitud</p>
            <input type="text" name="longitud" id="longitud" placeholder="Longitud: -5.7354748249053955"/>
            
        </div>
    </div>
  </div>
  <div class="modal-footer">
  	<input type="hidden" name="mail" id="mail" value="<?php echo $_SESSION['mail'];?>"/>
  	<input type="hidden" name="ledoi" id="ledoi" value="1"/>
    <button type="button" class="btn btn-kalifa btn-large" id="kaliforniazoNuevo">+ Kaliforniazo</button>
    <button type="button" class="btn btn-large cierroE" id="cierroK" data-dismiss="modal" aria-hidden="true">Cerrar</button>
  </div>
  </form>
</div>
<!-- Button to trigger modal -->
<!-- Modal -->
<div id="miCuenta" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close cierroE" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><span class="nUsuario"><?php echo $_SESSION['usuario'];?></span></h3>
  </div>
  <form action="php/cuenta-modificar.php" method="post" enctype="multipart/form-data">
  <div class="modal-body">
  	<div class="row-fluid">
    	<div class="span6">
        	<p>Usuario</p>
            <input type="text" name="usuario" id="usuario" value="<?php echo $_SESSION['usuario'];?>"/>
            <p>Contraseña actual</p>
            <input type="password" name="passv" class="passBorrar" id="passv" placeholder="Contraseña actual" value=""/>
        </div>
        <div class="span6">
            <p>Contraseña nueva</p>
            <input type="password" name="passn" class="passBorrar" id="passn" placeholder="Contraseña nueva"/>
            <p>Repite la nueva contraseña</p>
            <input type="password" name="passnr" class="passBorrar" id="passnr" placeholder="Repite la nueva contraseña"/>
        </div>
    </div>
    <!--
    <div class="row-fluid">   
        <div class="span6">
        	<div id="busqueda">
                <input type="text" id="buscar_usuario" name="buscar_usuario" />
            </div>
            <div id="resultados">
    
            </div>
        </div>
        
    </div>--> 
  </div>
  <div class="modal-footer">
  	<input type="hidden" name="mailU" id="mailU" value="<?php echo $_SESSION['mail'];?>"/>
  	<input type="hidden" name="ledoi" id="ledoi" value="1"/>
    <button type="button" class="btn btn-kalifa btn-large modiCuenta">Guardar</button>
    <button type="button" class="btn btn-large cierroE" data-dismiss="modal" id="cierroU" aria-hidden="true">Cerrar</button>
    
  </div>
  </form>
</div>