<?php 
	if ($peticionAjax) {
			require_once '../core/mainModel.php';
		}else{
			require_once './core/mainModel.php';
		}
	class cpeModelo extends mainModel{
		
	

		protected function add_cpe_modelo($datos){
			$sql=mainModel::conectar()->prepare("CALL SP_ADD_CPE('".$datos['cpe_rucemisor']."','".$datos['cpe_tipodocumento']."',
			'".$datos['cpe_serie']."','".$datos['cpe_numero']."','".$datos['fechaemsion']."','".$datos['ruccliente']."',
			'".$datos['razoncliente']."','".$datos['subotal']."','".$datos['igv']."','".$datos['total']."',
			'".$datos['rutaxml']."','".$datos['rutazip']."','".$datos['rutapdf']."','".$datos['rutacdr']."',
			'".$datos['estadocomprobantes']."','".$datos['estadosunat']."','".$datos['usuario']."','".$datos['moneda']."')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
		protected function add_cpe_temporal_modelo($datos){
			$sql=mainModel::conectar()->prepare("CALL SP_ADD_CPE_TEMPORAL('".$datos['cpe_rucemisor']."','".$datos['cpe_tipodocumento']."',
			'".$datos['cpe_serie']."','".$datos['cpe_numero']."','".$datos['fechaemsion']."','".$datos['ruccliente']."',
			'".$datos['razoncliente']."','".$datos['subotal']."','".$datos['igv']."','".$datos['total']."',
			'".$datos['rutaxml']."','".$datos['rutazip']."','".$datos['rutapdf']."','".$datos['rutacdr']."',
			'".$datos['estadocomprobantes']."','".$datos['estadosunat']."','".$datos['moneda']."','".$datos['usuario']."')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
		protected function limpiar_tabla(){
			$sql=mainModel::conectar()->prepare("CALL SP_LIMPIAR_TABLA()");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
		protected function update_cpe_vige_modelo($cpe){
			$sql=mainModel::conectar()->prepare("CALL SP_UP_CPE_VIG('".$cpe."')");
			//le ponemos 'dni' y mas porque en el controlador definimos ese array de datos 
			$sql->execute();
			return $sql;
		}
    }
