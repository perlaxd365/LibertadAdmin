
<?php

$peticionAjax=true;
require_once '../core/configGeneral.php';

require_once '../controladores/usuarioControlador.php';
$instancearUsuario = new usuarioControlador();

if(isset($_POST['email'])) {
	

	
	echo $instancearUsuario->add_user_controlador();

}elseif(isset($_POST['id_usuario'])){

	echo $instancearUsuario->datos_usuario_controlador($_POST['id_usuario']);

}elseif(isset($_POST['id_usuario_actualizar'])){

	echo $instancearUsuario->actualizar_usuario_controlador($_POST['id_usuario_actualizar']);

}elseif(isset($_POST['buscar'])){

	echo $instancearUsuario->paginador_usuarios_controlador(1, 30,$_POST['buscar'],$_POST["usuarioActual"],$_POST["vigencia"],$_POST["ln_opcion"]);

}elseif(isset($_POST['id_usuario_delete'])){

	echo $instancearUsuario->eliminar_usuario_controlador();

}else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}
