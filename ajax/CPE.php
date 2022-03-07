
<?php

$peticionAjax=true;
require_once '../core/configGeneral.php';

require_once '../controladores/cpeControlador.php';
$instancearCPE = new cpeControlador();

if(isset($_POST['name'])) {
	

	
	echo $instancearCPE->add_cpe_controlador();

}elseif(isset($_POST['archivos'])){
	
	echo $instancearCPE->add_archivos_cpe_controlador();

}elseif(isset($_POST['buscar-cliente'])){
	
	echo $instancearCPE->paginador_cpe_controlador($_POST["nro-pagina"], 30 , $_POST['fechaini'] ,$_POST['fechafin'],$_POST['buscar-cliente'],$_POST['buscar-ruc'],$_POST['vigencia'],$_POST['estado']);

}elseif(isset($_POST['up_cpe'])){
	
	echo $instancearCPE->actualizar_cpe_controlador();

}elseif(isset($_POST['cpe_numero_up_vig'])){
	
	echo $instancearCPE->actualizar_cpe_vigencia_controlador($_POST['cpe_numero_up_vig']);

}elseif(isset($_POST['json'])){
	
	echo $instancearCPE->actualizar_cpe_vigencia_list_controlador();


}elseif(isset($_POST['consulta_numero_cpe'])){
	
	echo $instancearCPE->consulta_cpe_usuario_controlador();


}else{

	echo '<script> window.location.href="'.SERVERURL.'login/"</script>';
}
