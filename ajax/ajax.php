<?php
include_once 'kalifornia.class.php';

$kalifornia = new Kalifornia();
$type = $_GET['type'];
/**
 * Type 1: Resultados del autocomplete.
 * Type 2: Formulario para agregar usuarios.
 * Type 3: Funcion para agregar usuario.
 */
switch ($type) {
    
    case 1:
        $kalifornia->mostrarKaliforniazo($_GET['mail']);
    break;

    case 2:
		$kalifornia->agregarKaliforniazo($_GET);
    break;

    case 3:
        $kalifornia->agregarUsuario($_GET);
    break;

    case 4:
		$kalifornia->editarUsuario($_GET, $_GET['mail']);
    break;
	
	 case 5:
        echo json_encode($kalifornia->buscarUsuario($_GET['term']));
    break;
	
	case 6:
		$kalifornia->editarKaliforniazo($_GET);
    break;
	
	case 7:
		$kalifornia->eliminarKaliforniazo($_GET);
    break;
	
	case 8:
		$kalifornia->mostrarUnKaliforniazo($_GET);
    break;
	
	case 9:
		$kalifornia->editarImgKaliforniazo($_GET);
    break;
	
	case 10:
		$kalifornia->eliminarImgKaliforniazo($_GET);
    break;
	
	case 11:
		$kalifornia->agregarComenImgKaliforniazo($_GET);
    break;
	
	case 12:
		$kalifornia->veo_img($_GET['id'],$_GET['mail'],$_GET['modelo'],$_GET['x']);
	break;
	
	case 13:
		$kalifornia->veo_datos($_GET['id'],$_GET['mail']);
	break;
	
	case 14:
		$kalifornia->agregarImgKaliforniazo($_GET);
    break;
	
    default:
    break;
}

