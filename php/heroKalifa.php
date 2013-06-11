<?php
$sql='SELECT * FROM kaliforniazo WHERE id='.$_REQUEST['id'];
$resultadoC= @mysql_query($sql);
if($regC=@mysql_fetch_array($resultadoC)){
echo'
<div class="hero-unit hero-p">
                
    <h1>'.$regC['nombre'].'</h1>
    <p class="descripcion">'.$regC['descripcion'].'</p>

    <div class="btn-toolbar">
      <div class="btn-group">
        <a href="#nuevaImg" class="btn btn-large icoEdi" data-toggle="modal" role="button" rel="tooltip" data-placement="bottom" data-original-title="A&ntilde;adir una foto"><i class="icon-plus"></i><i class="icon-picture"></i></a>
        <a class="btn btn-large icoEdi" rel="tooltip" id="creaCom" data-placement="bottom" data-original-title="Hacer Comentario"><i class="icon-plus"></i><i class="icon-comment"></i></a>
      </div>
    
      <div class="btn-group">';
    
    
    if($modelo==1){
        echo'
        <a href"#modelo" class="btn btn-large modelo active" data-model="1" data-placement="bottom" data-original-title="Cambiar Vista">';
    }else{
        echo'
        <a href"#modelo" class="btn btn-large modelo cambioModelo" rel="tooltip" data-model="1" data-placement="bottom" data-original-title="Cambiar Vista">';	
    }
        echo'
        <i class="icon-align-left"></i>
        </a>';
        
    if($modelo==2){
        echo'
        <a href"#modelo" class="btn btn-large modelo active" data-model="2" data-placement="bottom" data-original-title="Cambiar Vista">';
    }else{
        echo'
        <a href"#modelo" class="btn btn-large modelo cambioModelo" rel="tooltip" data-model="2" data-placement="bottom" data-original-title="Cambiar Vista">';	
    }
        echo'
        <i class="icon-align-right"></i>
        </a>';
        
    if($modelo==3){
        echo'
        <a href"#modelo" class="btn btn-large modelo active" data-model="3" data-placement="bottom" data-original-title="Cambiar Vista">';
    }else{
        echo'
        <a href"#modelo" class="btn btn-large modelo cambioModelo" rel="tooltip" data-model="3" data-placement="bottom" data-original-title="Cambiar Vista">';	
    }
        echo'
        <i class="icon-picture"></i>
        </a>
        
      </div>
    </div>
<!--<a href="#nuevaImg" class="btn btn-large" data-toggle="modal" role="button">A&ntilde;adir una foto</a>-->
</div>';
}
@mysql_free_result($resultadoC);
?>