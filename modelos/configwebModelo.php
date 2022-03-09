<?php 
	if ($peticionAjax) {
			require_once '../core/mainModel.php';
		}else{
			require_once './core/mainModel.php';
		}
	class configwebModelo extends mainModel{
        
        protected function up_config_modelo($datos){
			$sql=mainModel::conectar()->prepare("CALL SP_UP_CONFIGWEB('".$datos['correo']."','".$datos['copy']."','".$datos['telefono']."','".$datos['face']."','".$datos['insta']."','".$datos['twi']."','".$datos['in']."','".$datos['id_etiqueta']."')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}

		protected function data_configweb_modelo(){
			$sql=mainModel::conectar()->prepare("CALL SP_DATA_ETIQUETAS()");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
    }
