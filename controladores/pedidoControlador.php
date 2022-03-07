<?php
if ($peticionAjax) {
    require_once "../modelos/pedidoModelo.php";
} else {
    require_once "./modelos/pedidoModelo.php";
}

class pedidoControlador extends pedidoModelo
{



    public function paginador_cliente_controlador($pagina, $registros, $opcion,$valor)
    {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);

        $tabla = '';
        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

       
            $consulta = "CALL SP_ECM_LST_PEDIDO(".$opcion.", '".$valor."')";
            $paginaurl = "home";
        


        $conexion = mainModel::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();

        $Npaginas = ceil($total / $registros);


        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio;
            foreach ($datos as $rows) {
                $contador++;

                $tabla .= '
                <tr>
                    <td>
                        <div class="d-inline-block align-middle">
                            <img src="'.SERVERURL.'vistas/images/avatar-4.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                            <div class="d-inline-block">
                                <h6>'.$rows["razonsocial"].'</h6>
                                <p class="text-muted m-b-0">'.$rows["fecha_pedido"].'</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-right">
                        <h6 class="f-w-700">S/'.$rows["total_pedido"].'<i class="fas fa-level-down-alt text-c-red m-l-10"></i></h6>
                    </td>
                </tr>';
            }
            $tabla .= '</tbody>
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


        if ($total >= 1 && $pagina <= $Npaginas ) {
            $tabla .= '<div class="d-flex justify-content-center">
            <nav aria-label="...">
      <ul class="pagination">';
            if ($pagina == 1) {
                $tabla .= '<li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>';
            } else {
                $tabla .= '<li class="page-item">
                <a class="page-link" href="' . SERVERURL . $paginaurl . '/' . ($pagina - 1) . '" tabindex="-1">Previous</a></li>';
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


}
