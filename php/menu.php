<!--[if lt IE 7]>
    <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            
            <a class="brand" href="principal.php"><div class="tituloP">Siempre nos quedar&aacute;</div><div class="titulo"></div></a>
            <?php
            if(isset($_SESSION['mail']) && isset($_SESSION['usuario'])){
            ?>
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="active"><a href="principal.php">Inicio</a></li>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Men&uacute;<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a  href="#nuevoKaliforniazo" data-toggle="modal" role="button">+ Kaliforniazo</a></li>
                            <li><a  href="#miCuenta" data-toggle="modal" role="button">Mi cuenta</a></li>
                            <li><a href="fotos.php">Mis fotos</a></li>
                            <li><a href="comentarios.php">Mis comentarios</a></li>
                        </ul>
                    </li>
                </ul>
                
            </div><!--/.nav-collapse -->
            <?php
                echo '<div class="usuario">Usuario: <b><span class="nUsuario">'.$_SESSION['usuario'].'</span></b> - <a href="php/cerrarS.php">salir</a></div>';
            }else{
            ?>
            <form class="navbar-form pull-right">
                <input class="span2" type="text" placeholder="Email" name="mail1">
                <input class="span2" type="password" placeholder="Password" name="pass1">
                <button type="submit" class="btn">Entrar</button>
            </form>
            <?php
            }
            ?>
        </div>
    </div>
</div>