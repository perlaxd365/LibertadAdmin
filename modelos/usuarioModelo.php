<?php 
	if ($peticionAjax) {
			require_once '../core/mainModel.php';
		}else{
			require_once './core/mainModel.php';
		}
	class usuarioModelo extends mainModel{
		
	

		protected function add_usuario_modelo($datos){
			$sql=mainModel::conectar()->prepare("CALL SP_ADD_USER('".$datos['usuario']."','".$datos['id_perfil']."','".$datos['pass']."','".$datos['email']."','".$datos['nombre']."','".$datos['apepat']."','".$datos['apemat']."','".$datos['dni']."','".$datos['telefono']."','".$datos['nombre']." ".$datos['apepat']." ".$datos['apemat']." ".$datos['usuario']."','".$datos['usuarioActual']."','".$datos['vigencia']."')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
		protected function up_usuario_modelo($datos){
			$sql=mainModel::conectar()->prepare("CALL SP_UP_USER('".$datos['usuario']."','".$datos['id_perfil']."','".$datos['pass']."','".$datos['email']."','".$datos['nombre']."','".$datos['apepat']."','".$datos['apemat']."','".$datos['dni']."','".$datos['telefono']."','".$datos['usuarioActual']."','".$datos['vigencia']."')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
		protected function delete_usuario_modelo($id,$usuarioActual){
			$sql=mainModel::conectar()->prepare("CALL SP_DELETE_USER('$id','$usuarioActual')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
		protected function data_usuario_modelo($id){
			$sql=mainModel::conectar()->prepare("CALL SP_DATA_USER('".$id."')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
    }
