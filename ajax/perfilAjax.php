
<?php

$peticionAjax=true;
require_once '../core/configGeneral.php';

require_once '../controladores/perfilControlador.php';
$instancearPerfil = new perfilControlador();

if(isset($_POST['id_perfil_vigencia'])) {
	

	
	echo $instancearPerfil->actualizar_perfil_controlador();

}else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}
