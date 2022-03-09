
<?php

$peticionAjax=true;
require_once '../core/configGeneral.php';

require_once '../controladores/productoControlador.php';
$instancearProducto = new productoControlador();

if(isset($_FILES["dataProducto"])) {
	

	
	echo $instancearProducto->agregar_producto_controlador();

}elseif(isset($_POST['up_producto'])) {
	

	
	echo $instancearProducto->actualizar_productos_controlador();

}elseif(isset($_FILES['imagenesProducto'])) {
	

	
	echo $instancearProducto->agregar_imagenes_producto_controlador();

}else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}
