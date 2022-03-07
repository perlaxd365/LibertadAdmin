<?php
if ($peticionAjax) {
    require_once "../modelos/perfilModelo.php";
} else {
    require_once "./modelos/perfilModelo.php";
}

class perfilControlador extends perfilModelo
{

    public function paginador_perfil_controlador($pagina, $registros)
    {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);

        $tabla = '';
        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;


        $consulta = "CALL SP_LIST_PERFIL(" . $inicio . ", '" . $registros . "')";
        $paginaurl = "home";



        $conexion = mainModel::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();

        $Npaginas = ceil($total / $registros);

        $tabla .= '
                <table class="table">
                    <thead>
                        <tr class="table-secondary">
                        <th scope="col">#</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Vigencia</th>
                        <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
    
 
                
        ';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio;
            foreach ($datos as $rows) {
                $contador++;

                $tabla .= '
                <tr>
                <th scope="row">'.$contador.'</th>
                <td>'.$rows["desc_perfil"].'</td>
                <td>'.$rows["vigencia"].'</td>
                <td><button type="button" onclick="upVigencia('.$rows["id_perfil"].');" class="btn btn-outline-info">Cambiar Vigencia</button></td>
              </tr>
                
                
                ';
            }
            $tabla .= ' </tbody>
            </table>';
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


    public function actualizar_perfil_controlador()
    {

        $id_perfil = mainModel::limpiar_cadena($_POST['id_perfil_vigencia']);
        
        $result = mainModel::ejecutar_consulta_simple("SELECT * FROM perfil_usuario WHERE id_perfil='$id_perfil'");
                        
        $vigencia='';          
        foreach ($result as $key => $rows) {
            $vigencia=$rows["vigencia"];
        }
            if($vigencia=="SI"){
                $vigencia="NO";
            }else{

                $vigencia="SI";
            }

        $dataUser = [
            "id_perfil" => $id_perfil,
            "vigencia" => $vigencia
        ];

        $upPerfil = perfilModelo::up_perfil_modelo($dataUser);

        if ($upPerfil->rowCount() >= 1) {

            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Se actualizó correctamente la vigencia",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "No se pudo actualizar la vigencia. ¡Ups!",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }
}
