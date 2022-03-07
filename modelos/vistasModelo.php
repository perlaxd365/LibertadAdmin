<?php 
	class vistasModelo{
		protected function obtener_vistas_modelo($vistas){
			$listaBlanca=["home","cpe","user","consultaCpe","userUP","EliminarComp","perfil","auditoria","consultaComprobante"];
			if(in_array($vistas, $listaBlanca)){
				if(is_file("./vistas/contenido/".$vistas."-view.php")){
					$contenido="./vistas/contenido/".$vistas."-view.php";
				}else{
					$contenido="login";
				}
			}else{
				$contenido="404";
			}
			return $contenido;
		}
	}