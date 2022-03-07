<?php 
	if ($peticionAjax) {
			require_once '../core/mainModel.php';
		}else{
			require_once './core/mainModel.php';
		}
	class perfilModelo extends mainModel{
		
	
		protected function up_perfil_modelo($datos){
			$sql=mainModel::conectar()->prepare("CALL SP_UP_PERFIL('".$datos['id_perfil']."','".$datos['vigencia']."')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
    }
