<?php 
	if ($peticionAjax) {
			require_once '../core/mainModel.php';
		}else{
			require_once './core/mainModel.php';
		}

	class productoModelo extends mainModel{
		
		protected function agregar_producto_modelo($datos){
			$sql=mainModel::conectar()->prepare("CALL SP_ADD_PRODUCTO('".$datos["prod_codigo"]."'
			,'".$datos["prod_descripcion"]."'
			,'".$datos["prod_abreviatura"]."'
			,'".$datos["prod_denominacion"]."'
			,'".$datos["produc_imagen"]."'
			,'".$datos["line_descripcion"]."'
			,'".$datos["suli_descripcion"]."'
			,'".$datos["ssli_descripcion"]."'
			,'".$datos["prod_vigencia"]."'
			,'".$datos["pvpd_importe"]."')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
		protected function agregar_producto_temporal_modelo($datos){
			$sql=mainModel::conectar()->prepare("CALL SP_ADD_PRODUCTO_TEMPORAL('".$datos["prod_codigo"]."'
			,'".$datos["prod_descripcion"]."'
			,'".$datos["prod_abreviatura"]."'
			,'".$datos["prod_denominacion"]."'
			,'".$datos["produc_imagen"]."'
			,'".$datos["line_descripcion"]."'
			,'".$datos["suli_descripcion"]."'
			,'".$datos["ssli_descripcion"]."'
			,'".$datos["prod_vigencia"]."'
			,'".$datos["pvpd_importe"]."')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
		protected function temporal_a_producto_modelo(){
			$sql=mainModel::conectar()->prepare("CALL SP_TEMPRO_A_PRO()");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
		protected function limpiar_prod_temp_modelo(){
			$sql=mainModel::conectar()->prepare("CALL SP_LIMPIAR_PROD_TEMPO()");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
    }
