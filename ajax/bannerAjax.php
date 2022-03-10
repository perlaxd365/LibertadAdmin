
<?php

$peticionAjax=true;
require_once '../core/configGeneral.php';

require_once '../controladores/bannerControlador.php';
$instancearBanner = new bannerControlador();

if(isset($_FILES['imagenBanner'])) {
	

	
	echo $instancearBanner->agregar_imagen_controlador();

}elseif(isset($_POST['id_banner'])) {
	

	
	echo $instancearBanner->eliminar_banner_controlador();

}else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}
