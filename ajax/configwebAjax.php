
<?php

$peticionAjax=true;
require_once '../core/configGeneral.php';

require_once '../controladores/configwebControlador.php';
$instancearconfigweb = new configwebControlador();

if(isset($_POST['id_etiqueta'])) {
	


 echo $instancearconfigweb->actualizar_configweb_controlador(); 

}else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}
