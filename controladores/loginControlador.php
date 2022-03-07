<?php 
if ($peticionAjax) {
	require_once '../modelos/loginModelo.php';
}else{
	require_once './modelos/loginModelo.php';
}

class loginControlador extends loginModelo
{
	
	public function iniciar_sesion_controlador(){

		if (isset($_POST['email']) && $_POST['email']!="" && isset($_POST['password'])  && $_POST['email']!="") {
			
		$usuario=mainModel::limpiar_cadena($_POST["email"]);
		$clave=mainModel::limpiar_cadena($_POST["password"]);

		$datosLogin=[

			"Usuario"=>$usuario,
			"Clave"=>$clave
		];

		$datosCuenta=loginModelo::iniciar_sesion_modelo($datosLogin);
		if ($datosCuenta->rowCount()==1) {


			session_start(['name'=>'CORSCH']);

				$UserData=$datosCuenta->fetch();

				$_SESSION['id_usuario_corsch']=$UserData['PER_ID'];
				$_SESSION['nombre_usuario_corsch']=$UserData['USR_LOGIN'];
				$_SESSION['tipo_usuario_corsch']=$UserData['desc_perfil'];
				$_SESSION['token_corsch']=md5(uniqid(mt_rand(),true));
				$url=SERVERURL."home/";
				return $urlLocation='<script>window.location="'.$url.'"</script>';
			
		}
		else{

			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Algo salió mal",
				"Texto"=>"El usuario y contraseña no son correctos / Cuenta inactiva. ¡Ups!",
				"Tipo"=>"error"
			];	
		}
		}else{
			session_start(['name'=>'CORSCH']);
			$_SESSION['id_usuario_corsch']="consultor";
			$_SESSION['nombre_usuario_corsch']="cliente";
			$_SESSION['tipo_usuario_corsch']="consultor";
			$_SESSION['token_corsch']=md5(uniqid(mt_rand(),true));

			$url=SERVERURL."consultaComprobante/";
			return $urlLocation='<script>window.location="'.$url.'"</script>';

		}


		return mainModel::sweet_alert($alerta);	

	}

	public function cerrar_sesion_controlador(){

		session_start(['name'=>'CORSCH']);
		$token=mainModel::decryption($_GET['Token']);
		$datos=[
			"Token_S"=>$_SESSION['token_corsch'],
			"Token"=>$token
		];
		return loginModelo::cerrar_sesion_modelo($datos);

	}

	public function forzar_cierre_sesion_controlador(){
		
		session_start(['name'=>'CORSCH']);
		session_destroy(); 
		return header("location:".SERVERURL."login/");
	}
}