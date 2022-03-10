<?php 
	if ($peticionAjax) {
			require_once '../core/mainModel.php';
		}else{
			require_once './core/mainModel.php';
		}

	class bannerModelo extends mainModel{
		
		protected function agregar_banner_modelo($datos){
			$sql=mainModel::conectar()->prepare("CALL SP_ADD_SLIDER('".$datos["titulo"]."'
			,'".$datos["descripcion"]."'
			,'".$datos["patch"]."'
			,'".$datos["boton"]."'
			,'".$datos["url"]."')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}

		protected function delete_banner_modelo($id){
			$sql=mainModel::conectar()->prepare("CALL SP_DELETE_SLIDER('$id')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
    }
