<?php
if ($peticionAjax) {
    require_once "../modelos/usuarioModelo.php";
} else {
    require_once "./modelos/usuarioModelo.php";
}

class usuarioControlador extends usuarioModelo
{
    public function add_user_controlador()
    {

        $usuario = mainModel::limpiar_cadena($_POST['usuario']);
        $id_perfil = mainModel::limpiar_cadena($_POST['id_perfil']);
        $email = mainModel::limpiar_cadena($_POST['email']);
        $pass = mainModel::limpiar_cadena($_POST['pass']);
        $nombre = mainModel::limpiar_cadena($_POST['nombre']);
        $apepat = mainModel::limpiar_cadena($_POST['apepat']);
        $apemat = mainModel::limpiar_cadena($_POST['apemat']);
        $dni = mainModel::limpiar_cadena($_POST['dni']);
        $telefono = mainModel::limpiar_cadena($_POST['telefono']);
        $vigencia = mainModel::limpiar_cadena($_POST['vigencia']);

        //usuario Actual//
        
        $usuarioActual = mainModel::limpiar_cadena($_POST['usuarioActual']);


        $consultaEmail = mainModel::ejecutar_consulta_simple("SELECT USR_EMAIL FROM glb_usuario  WHERE USR_EMAIL='$email'");
        $consultaUsuario = mainModel::ejecutar_consulta_simple("SELECT USR_LOGIN FROM glb_usuario  WHERE USR_LOGIN='$usuario'");
        $consultaDNI = mainModel::ejecutar_consulta_simple("SELECT USR_DNI FROM glb_usuario  WHERE USR_DNI='$dni'");

        if ($consultaUsuario->rowCount() >= 1 || $consultaDNI->rowCount() >= 1 || $consultaEmail->rowCount() >= 1) {
            if ($consultaUsuario->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Algo salió mal",
                    "Texto" => "El usuario ya se encuentra registrado",
                    "Tipo" => "error"
                ];
            } elseif ($consultaDNI->rowCount() >= 1) {

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Algo salió mal",
                    "Texto" => "El DNI ya se encuentra registrado",
                    "Tipo" => "error"
                ];
            } elseif ($consultaEmail->rowCount() >= 1) {

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Algo salió mal",
                    "Texto" => "El Email ya se encuentra registrado",
                    "Tipo" => "error"
                ];
            }
            return mainModel::sweet_alert($alerta);
        } else {

            $dataUser = [
                "usuario" => $usuario,
                "id_perfil" => $id_perfil,
                "pass" => $pass,
                "email" => $email,
                "nombre" => $nombre,
                "apepat" => $apepat,
                "apemat" => $apemat,
                "dni" => $dni,
                "telefono" => $telefono,
                "vigencia" => $vigencia,
                "usuarioActual" => $usuarioActual
            ];

            $guardarUser = usuarioModelo::add_usuario_modelo($dataUser);

            if ($guardarUser->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "Completado",
                    "Texto" => "Exito al registrar Usuario",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Algo salió mal",
                    "Texto" => "No se pudo registrar Usuario. ¡Ups!",
                    "Tipo" => "error"
                ];
            }

            return mainModel::sweet_alert($alerta);
        }
    }


    public function paginador_usuarios_controlador($pagina, $registros, $busqueda,$usuarioActual,$vigencia,$ln_option)
    {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);

        $tabla = '';
        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "CALL SP_SEARCH_USER( '" . $busqueda . "', '" . $ln_option . "', '" . $vigencia . "')";
            $paginaurl = "user/";
        } else {
            $consulta = "CALL SP_SEARCH_USER(' ', '" . $ln_option . "', '" . $vigencia . "')";
            $paginaurl = "user/";
        }




        $conexion = mainModel::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();

        $Npaginas = ceil($total / $registros);

        $tabla .= '
        <div class="table-responsive" style="overflow-y:scroll;height:400px;">
            <table style="height: 200px;" class="table table-sm">
        <thead class="thead-dark">
        <tr>
        <th scope="col">Nombres</th>
            <th scope="col">Usuario</th>
            <th scope="col">Email</th>
            <th scope="col">DNI</th>
            <th scope="col">Perfil</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Vigencia</th>
            <th scope="col">Fecha de Registro</th>
            <th scope="col">Acción</th>
        </tr>
    </thead>
    <tbody>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio;
            foreach ($datos as $rows) {
                $contador++;
                $estado = '';
               

                $tabla .= '
                
                <tr>
                <td>' . $rows["USR_NOMBRE"] . ' ' . $rows["USR_APE_MAT"] . ' ' . $rows["USR_APE_PAT"] . '</td>
                    <td scope="row">' . $rows["USR_LOGIN"] . '</td>
                    <td scope="row">' . $rows["USR_EMAIL"] . '</td>
                    <td>' . $rows["USR_DNI"] . '</td>
                    <td>' . $rows["desc_perfil"] . '</td>
                    <td>' . $rows["USR_TELEFONO"] . '</td>
                    <td>' . $rows["vigencia_usuario"] . '</td>
                    <td>' . $rows["USR_FECHAREG"] . '</td>
                    <td>
                    <form action="' . SERVERURL . 'userUP" method="POST" data-form="update" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="id_usuario_actualizar" value="' . $rows["USR_LOGIN"] . '">
                    <input type="hidden" name="usuarioActual" value="' . $usuarioActual . '">
                    <input class="btn btn-outline-success btn-sm" type="submit" name="idPersonaDel" value="Actualizar">
                    </form>
                    <form action="' . SERVERURL . 'ajax/usuarioAjax.php" method="POST" data-form="delete" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="id_usuario_delete" value="' . $rows["USR_LOGIN"] . '">
                    <input type="hidden" name="usuarioActual" value="' . $usuarioActual . '">
                    <input class="btn btn-outline-danger btn-sm" type="submit" name="idPersonaDel" value="Eliminar">
                    </form>
                    </td>
                     
               
                </tr>
                ';
            }
            $tabla .= "
            </tbody>
            </table>

            </div>";
            $contador++;
        } else {



            if ($total >= 1) {

                $tabla .= '
				<tr>
					<td colspan="5">
						<a href="' . SERVERURL . '/adminlist/" class="btn btn-sm btn-info btn-raised"> 
							Haga click para recargar el listado
						</a>
					</td>
				</tr>
			';
            } else {
                $tabla .= '
				<tr>
					<td colspan="5">No hay registros</td>
				</tr>
			';
            }
        }

        $tabla .= '</tbody></table></div>';


        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<div class="d-flex justify-content-center">
            <nav aria-label="...">
      <ul class="pagination">';
            if ($pagina == 1) {
                $tabla .= '<li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Anterior</a>
    </li>';
            } else {
                $tabla .= '<li class="page-item">
                <a class="page-link" href="' . SERVERURL . $paginaurl . '/' . ($pagina - 1) . '" tabindex="-1">Anterior</a></li>';
            }


            for ($i = 1; $i < $Npaginas; $i++) {
                if ($pagina == $i) {
                    $tabla .= '<li class="page-item active">
                        <a class="page-link" href="' . SERVERURL . $paginaurl . '/' . ($i) . '">' . $i . '<span class="sr-only"></span></a>
                      </li>';
                } else {

                    $tabla .= ' <li class="page-item"><a class="page-link" href="' . SERVERURL . $paginaurl . '/' . ($i) . '">' . $i . '</a></li>';
                }
            }


            if ($pagina == $Npaginas) {
                $tabla .= '<li class="page-item disabled">
                <a class="page-link" href="#">Siguiente</a>
              </li>';
            } else {
                $tabla .= '
                <li class="page-item">
                    <a class="page-link" href="' . SERVERURL . $paginaurl . '/' . ($pagina + 1) . '">Siguiente</a>
                 </li>';
            }


            $tabla .= '</ul></nav>';
        } else {
            echo '';
        }

        return $tabla;
    }

    public function datos_usuario_controlador($id)
    {

        $result = mainModel::ejecutar_consulta_simple("CALL SP_LST_USER_ID ($id)");

        $inputsLlenos = '';

        foreach ($result as $key => $rows) {

            $inputsLlenos .= '


            <div class="card">
                <div class="card-header">
                    Actualizar Usuario : ' . $rows["USR_LOGIN"] . '
                </div>
                <form action="' . SERVERURL . 'ajax/usuarioAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
            
                <input hidden type="text" name="id_up_user" value="' . $rows["PER_ID"] . '">
                <div class="card-body row">   
                 <div class="col-md-6">
                    <label for="exampleInputEmail1">Nombres</label>
                    <input name="nombre" value="' . $rows["USR_NOMBRE"] . '"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresar usuario">
                </div>
                <div class="col-md-6">
                    <label for="exampleInputEmail1">Apellido Paterno</label>
                    <input name="apepat" value="' . $rows["USR_APE_PAT"] . '"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresar usuario">
                </div>
                <div class="col-md-6">
                    <label for="exampleInputEmail1">Apellido Materno</label>
                    <input name="apemat" value="' . $rows["USR_APE_MAT"] . '"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresar usuario">
                </div>
                <div class="col-md-6">
                    <label for="exampleInputEmail1">DNI</label>
                    <input name="dni" value="' . $rows["USR_DNI"] . '"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresar usuario">
                </div>
                <div class="col-md-6">
                    <label for="exampleInputEmail1">TELEFONO</label>
                    <input name="telefono" value="' . $rows["USR_TELEFONO"] . '"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresar usuario">
                </div>
                <div class="col-md-6">
                    <label for="exampleInputEmail1">Usuario</label>
                    <input type="email" value="' . $rows["USR_LOGIN"] . '" name="usuario_up" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresar usuario">
                </div>
                <div class="col-md-6">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" value="' . $rows["USR_CLAVE"] . '" name="pass_up" class="form-control" id="input" placeholder="Contraseña">
                    <br>
                    <div onclick="myFunction()">
                    <input type="checkbox">
                    Mostrar Contraseña}
                </div>
                <br>
                <button type="submit" class="btn btn-primary col-md-6">Actualizar</button>
                <button type="button" id="cerrar" class="btn btn-inverse-dark col-md-6" data-dismiss="modal">Salir</button>
                </form>
                </div>
                <div class="RespuestaAjax" id="RespuestaAjax">
                </div>    
                </div>
            </div>
            <script>
            function myFunction() {
                var x = document.getElementById("input");
                if (x.type === "password") {
                  x.type = "text";
                } else {
                  x.type = "password";
                }
              }
              </script>

           
            ';
        }

        return $inputsLlenos;
    }

    public function actualizar_usuario_controlador()
    {

        $id = mainModel::limpiar_cadena($_POST['id_usuario_actualizar']);
        $id_perfil = mainModel::limpiar_cadena($_POST['id_perfil_up']);
        $email = mainModel::limpiar_cadena($_POST['email-up']);
        $pass = mainModel::limpiar_cadena($_POST['pass-up']);
        $nombre = mainModel::limpiar_cadena($_POST['nombre-up']);
        $apepat = mainModel::limpiar_cadena($_POST['apepat-up']);
        $apemat = mainModel::limpiar_cadena($_POST['apemat-up']);
        $telefono = mainModel::limpiar_cadena($_POST['telefono-up']);
        $dni = mainModel::limpiar_cadena($_POST['dni-up']);
        $vigencia = mainModel::limpiar_cadena($_POST['vigencia-up']);
        //usuario Actual//
        
        $usuarioActual = mainModel::limpiar_cadena($_POST['usuarioActual']);


        $dataUser = [
            "usuario" => $id,
            "id_perfil" => $id_perfil,
            "pass" => $pass,
            "email" => $email,
            "nombre" => $nombre,
            "apepat" => $apepat,
            "apemat" => $apemat,
            "telefono" => $telefono,
            "dni" => $dni,
            "usuarioActual" => $usuarioActual,
            "vigencia" => $vigencia
        ];


        $consultaEmail = mainModel::ejecutar_consulta_simple("SELECT USR_EMAIL FROM glb_usuario  WHERE USR_EMAIL='$email' AND USR_LOGIN !='$id'");
        $consultaDNI = mainModel::ejecutar_consulta_simple("SELECT USR_DNI FROM glb_usuario  WHERE USR_DNI='$dni' AND USR_LOGIN !='$id'");

        if ($consultaDNI->rowCount() >= 1 || $consultaEmail->rowCount() >= 1) {
            if ($consultaDNI->rowCount() >= 1) {

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Algo salió mal",
                    "Texto" => "El DNI ya se encuentra registrado",
                    "Tipo" => "error"
                ];
            } elseif ($consultaEmail->rowCount() >= 1) {

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Algo salió mal",
                    "Texto" => "El Email ya se encuentra registrado",
                    "Tipo" => "error"
                ];
            }
            return mainModel::sweet_alert($alerta);
        }else{

            $guardarUser = usuarioModelo::up_usuario_modelo($dataUser);

            if ($guardarUser->rowCount() >= 1) {
                
                $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "Usuario Actualizado",
                    "Texto" => "Registro exitoso del usuario",
                    "Tipo" => "success"
                ];
                
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Algo salió mal",
                    "Texto" => "No se pudo actualizar Usuario. ¡Ups!",
                    "Tipo" => "error"
                ];
            }

        }
        return mainModel::sweet_alert($alerta);
    }

    public function eliminar_usuario_controlador()
    {

        $idusuario = mainModel::limpiar_cadena($_POST['id_usuario_delete']);
        $idusuarioActual = mainModel::limpiar_cadena($_POST['usuarioActual']);



        $eliminarUser = usuarioModelo::delete_usuario_modelo($idusuario,$idusuarioActual);

        header('Location: ' . SERVERURL . 'user');
    }
    public function data_usuario_controlador($id_usuario)
    {

        return usuarioModelo::data_usuario_modelo($id_usuario);
    }
}
