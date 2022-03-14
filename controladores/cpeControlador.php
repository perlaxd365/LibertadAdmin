<?php
if ($peticionAjax) {
    require_once "../modelos/cpeModelo.php";
} else {
    require_once "./modelos/cpeModelo.php";
}

class cpeControlador extends cpeModelo
{
    public function add_cpe_controlador()
    {

        if (isset($_FILES["dataComprobante"])) {

            $id_usuario_sesion = mainModel::limpiar_cadena($_POST["id_usuario_sesion"]);
            $tipo = $_FILES["dataComprobante"]["type"];
            $tamaño = $_FILES["dataComprobante"]["size"];
            $archivotmp = $_FILES["dataComprobante"]["tmp_name"];
            $lineas = file($archivotmp);

            $contador = 0;

            $limpiar = cpeModelo::limpiar_tabla();
            foreach ($lineas as $linea) {
                $cantidad_registros = count($lineas);

                $datos = explode(";", $linea);

                $cpe_rucemisor =            !empty($datos[0]) ? ($datos[0]) : '';
                $cpe_tipodocumento =        !empty($datos[1]) ? ($datos[1]) : '';
                $cpe_serie =                !empty($datos[2]) ? ($datos[2]) : '';
                $cpe_numero =               !empty($datos[3]) ? ($datos[3]) : '';
                $fechaemsion =              !empty($datos[4]) ? ($datos[4]) : '';
                $ruccliente =               !empty($datos[5]) ? ($datos[5]) : '';
                $razoncliente =             !empty($datos[6]) ? ($datos[6]) : '';
                $moneda =                  !empty($datos[7]) ? ($datos[7]) : '';
                $subotal =                  !empty($datos[8]) ? ($datos[8]) : '';
                $igv =                      !empty($datos[9]) ? ($datos[9]) : '';
                $total =                    !empty($datos[10]) ? ($datos[10]) : '';
                $rutaxml =                  !empty($datos[11]) ? ($datos[11]) : '';
                $rutazip =                  !empty($datos[12]) ? ($datos[12]) : '';
                $rutapdf =                  !empty($datos[13]) ? ($datos[13]) : '';
                $rutacdr =                  !empty($datos[14]) ? ($datos[14]) : '';
                $estadocomprobantes =       !empty($datos[15]) ? ($datos[15]) : '';
                $estadosunat =              !empty($datos[16]) ? ($datos[16]) : '';




                $dataCPE = [
                    "cpe_rucemisor" => trim($cpe_rucemisor),
                    "cpe_tipodocumento" => trim($cpe_tipodocumento),
                    "cpe_serie" => trim($cpe_serie),
                    "cpe_numero" => trim($cpe_numero),
                    "fechaemsion" => trim($fechaemsion),
                    "ruccliente" => trim($ruccliente),
                    "razoncliente" => trim($razoncliente),
                    "subotal" => trim($subotal),
                    "igv" => trim($igv),
                    "total" => trim($total),
                    "rutaxml" => trim($rutaxml),
                    "rutazip" => trim($rutazip),
                    "rutapdf" => trim($rutapdf),
                    "rutacdr" => trim($rutacdr),
                    "estadocomprobantes" => trim($estadocomprobantes),
                    "estadosunat" => trim($estadosunat),
                    "moneda" => trim($moneda),
                    "usuario" => trim($id_usuario_sesion)

                ];
                if ($contador > 0) {
                    $guardarCPE = cpeModelo::add_cpe_temporal_modelo($dataCPE);
                }

                $contador++;
            }


            if ($guardarCPE->rowCount() >= 1) {


                $result = mainModel::ejecutar_consulta_simple("CALL SP_CPE_DUPLICADOS()");

                $filas = $result->rowCount();
                $comprobantes_repetidos = '';
                if ($filas > 1) {

                    $filas = $filas - 1;
                    foreach ($result as $key => $rows) {

                        $comprobantes_repetidos .= $rows["cpe_serie"] . "-" . $rows["cpe_numero"] . "-" . $rows["vigencia_cpe"] . "; ";
                    }


                    $actualizar = "
                    <script>
                    swal({
                        title: 'Error',
                        text: 'Existen $filas comprobantes repetidos <h6> $comprobantes_repetidos </h6> vuelve a intentarlo',
                        type:'error',
                        confirmButtonText: 'Aceptar'
                        }).then(function(){

                            swal({
                                title: 'Actualización',
                                text: '¿Deseas reemplazar los comprobantes existentes?',
                                type:'question',
                                showCancelButton: true,   
                                confirmButtonText: 'Si',
                                cancelButtonText: 'No'
                                }).then(function(){
                                    $.ajax({
                                        url: '" . SERVERURL . "ajax/CPE.php',
                                        method: 'POST',
                                        data: {
                                            'up_cpe': 3
                                        },
                                        beforeSend: function() {
                                            document.getElementById('loading').style.display = 'block';
                                        },
                                        success: function(respuesta) {
                                            document.getElementById('loading').style.display = 'none';
                                            $('#RespuestaAjax').attr('disabled', false);
                                            $('#RespuestaAjax').html(respuesta);
                                        }
                                    });
                                });
                            
                        });
                        
                            </script>
                            ";
                } else {
                    $contador = 0;
                    foreach ($lineas as $linea) {
                        $cantidad_registros = count($lineas);

                        $datos = explode(";", $linea);


                        $cpe_rucemisor =            !empty($datos[0]) ? ($datos[0]) : '';
                        $cpe_tipodocumento =        !empty($datos[1]) ? ($datos[1]) : '';
                        $cpe_serie =                !empty($datos[2]) ? ($datos[2]) : '';
                        $cpe_numero =               !empty($datos[3]) ? ($datos[3]) : '';
                        $fechaemsion =              !empty($datos[4]) ? ($datos[4]) : '';
                        $ruccliente =               !empty($datos[5]) ? ($datos[5]) : '';
                        $razoncliente =             !empty($datos[6]) ? ($datos[6]) : '';
                        $moneda =                  !empty($datos[7]) ? ($datos[7]) : '';
                        $subotal =                  !empty($datos[8]) ? ($datos[8]) : '';
                        $igv =                      !empty($datos[9]) ? ($datos[9]) : '';
                        $total =                    !empty($datos[10]) ? ($datos[10]) : '';
                        $rutaxml =                  !empty($datos[11]) ? ($datos[11]) : '';
                        $rutazip =                  !empty($datos[12]) ? ($datos[12]) : '';
                        $rutapdf =                  !empty($datos[13]) ? ($datos[13]) : '';
                        $rutacdr =                  !empty($datos[14]) ? ($datos[14]) : '';
                        $estadocomprobantes =       !empty($datos[15]) ? ($datos[15]) : '';
                        $estadosunat =              !empty($datos[16]) ? ($datos[16]) : '';




                        $dataCPE = [
                            "cpe_rucemisor" => trim($cpe_rucemisor),
                            "cpe_tipodocumento" => trim($cpe_tipodocumento),
                            "cpe_serie" => trim($cpe_serie),
                            "cpe_numero" => trim($cpe_numero),
                            "fechaemsion" => trim($fechaemsion),
                            "ruccliente" => trim($ruccliente),
                            "razoncliente" => trim($razoncliente),
                            "subotal" => trim($subotal),
                            "igv" => trim($igv),
                            "total" => trim($total),
                            "rutaxml" => trim($rutaxml),
                            "rutazip" => trim($rutazip),
                            "rutapdf" => trim($rutapdf),
                            "rutacdr" => trim($rutacdr),
                            "estadocomprobantes" => trim($estadocomprobantes),
                            "estadosunat" => trim($estadosunat),
                            "usuario" => trim($id_usuario_sesion),
                            "moneda" => trim($moneda)

                        ];
                        if ($contador > 0) {
                            $guardarCPEVentas = cpeModelo::add_cpe_modelo($dataCPE);
                        }

                        $contador++;
                    }

                    if ($guardarCPEVentas->rowCount() >= 1) {
                        $alerta = [
                            "Alerta" => "recargar",
                            "Titulo" => "Completado",
                            "Texto" => "Exito al registrar Comprobantes Electrónicos ",
                            "Tipo" => "success"
                        ];
                    } else {
                        $alerta = [
                            "Alerta" => "simple",
                            "Titulo" => "Algo salió mal",
                            "Texto" => "Ocurrió un error. ¡Ups!",
                            "Tipo" => "error"
                        ];
                    }
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Algo salió mal",
                    "Texto" => "No se pudo registrar CPE. ¡Ups!",
                    "Tipo" => "error"
                ];
            }



            if (isset($actualizar)) {
                return $actualizar;
            } else {

                return mainModel::sweet_alert($alerta);
            }
        } {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "No se seleccionó documento. ¡Ups!",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }
    public function add_archivos_cpe_controlador()
    {

        if (isset($_FILES["archivosCPE"])) {
            $contador = 0;

            foreach ($_FILES["archivosCPE"]["tmp_name"] as $key => $tmp_name) {
                $contador++;

                if ($_FILES["archivosCPE"]["name"][$key]) {

                    //NOMBRE DE ARCHIVO
                    $filename = $_FILES["archivosCPE"]["name"][$key];
                    //NOMBRE TEMPORAL DE ARCHIVO
                    $temporal = $_FILES["archivosCPE"]["tmp_name"][$key];
                    //EXTENSION DE ARCHIVO
                    $file = new SplFileInfo($_FILES["archivosCPE"]["name"][$key]);
                    $extension = $file->getExtension();

                    //CONCATENAR EXTENSION
                    $tipoConsulta = 0;
                    switch ($extension = $file->getExtension()) {
                        case $extension = "xml":
                            $tipoConsulta = 1;
                            break;
                        case $extension = "zip":
                            $tipoConsulta = 2;
                            break;
                        case $extension = "pdf":
                            $tipoConsulta = 3;
                            break;
                        case $extension = "cdr":
                            $tipoConsulta = 4;
                            break;

                        default:
                            # code...
                            break;
                    }


                    //CONSULTA DE NOMBRE ARCHIVO PARA EXTRAER FECHA
                    $result = mainModel::ejecutar_consulta_simple("CALL SP_ALL_CPE('" . $tipoConsulta . "',' " . $filename . " ')");

                    $contador = 0;
                    $fecha = '';
                    foreach ($result as $key => $rows) {
                        $contador++;
                        $fecha = $rows["fechaemsion"];
                    }


                    if ($contador == 0) {
                    } else {
                        $rucArray = explode("-", $filename);
                        $directorio = "../vistas/archivosCPE/" . $fecha . "/";

                        if (file_exists($directorio)) {
                            mkdir($directorio, 0777, true);
                        } else {
                            mkdir($directorio, 0700, true);
                        }

                        $dir = opendir($directorio);
                        $ruta = $directorio . '/' . $filename;
                        if (move_uploaded_file($temporal, $ruta)) {
                            $alerta = [
                                "Alerta" => "recargar",
                                "Titulo" => "Completado",
                                "Texto" => "Se guardaron correctamente los archivos",
                                "Tipo" => "success"
                            ];
                        } else {
                            $alerta = [
                                "Alerta" => "simple",
                                "Titulo" => "Algo salió mal",
                                "Texto" => "No se pudo agregar pago. ¡Ups! 2",
                                "Tipo" => "error"
                            ];
                        }
                        closedir($dir);
                    }
                }else{
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Algo salió mal",
                        "Texto" => "ERROR",
                        "Tipo" => "error"
                    ];
                }
            }

        }else{
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "Por favor selecciona 1 o mas archivos",
                "Tipo" => "error"
            ];
        }
        
            return mainModel::sweet_alert($alerta);
    }


    public function paginador_cpe_controlador($pagina, $registros, $fechaini, $fechafin, $cliente, $ruccliente, $vigencia, $estado)
    {
        $tabla = '';
        $TamañoInicio = strlen($fechaini);
        $TamañoFin = strlen($fechafin);

        if ($TamañoInicio > 10 || $TamañoInicio < 10 || $TamañoFin > 10 || $TamañoFin < 10 || $fechaini == '' || $TamañoInicio == '') {
            echo '<div class="alert alert-danger" role="alert">
            Fecha inválida, por favor ingresar la fecha correctamente : "Dia/Mes/Año" => "00/00/0000"
          </div>';
        } else {



            $pagina = mainModel::limpiar_cadena($pagina);
            $registros = mainModel::limpiar_cadena($registros);
            $fechaini = date("Y-m-d", strtotime($fechaini));
            $fechafin = date("Y-m-d", strtotime($fechafin));

            if ($ruccliente == "") {
                $ruccliente = null;
            }
            if ($cliente == "") {
                $cliente = null;
            }

            $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
            $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM compelec_ventas 
            WHERE  fechaemsion BETWEEN '" . $fechaini . "' AND '" . $fechafin . "' ";
            $paginaurl = "consultaCpe/";

            if (isset($cliente) && $cliente != "") {

                $consulta .= " AND razoncliente LIKE '%$cliente%' ";
            }
            if (isset($ruccliente) && $ruccliente != "") {

                $consulta .= " AND ruccliente LIKE '%$ruccliente%' ";
            }
            if (isset($vigencia) && $vigencia != "") {

                if ($vigencia == "SI") {
                    $consulta .= " AND vigencia_cpe ='SI' ";
                } elseif ($vigencia == "NO") {
                    $consulta .= " AND vigencia_cpe ='NO' ";
                }
            }
            if (isset($estado) && $estado != "") {

                if ($estado == "SI") {
                    $consulta .= " AND estadosunat ='ACEPTADO' ";
                } elseif ($estado == "NO") {
                    $consulta .= " AND estadosunat ='ANULADO' ";
                }
            } else {
            }




            $conexion = mainModel::conectar();

            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();

            $total = $conexion->query("SELECT FOUND_ROWS()");
            $total = (int) $total->fetchColumn();

            $Npaginas = ceil($total / $registros);


            $tabla .= '
        
                <h4 class="alert-heading">Listado de Comprobantes de Ventas</h4>
                <br>
                        <div class="table-responsive fixedHeaderTable" style="overflow-y:scroll;height:400px;" id="fixedY">
                            <table style="height: 300px;"  class="table table-sm">
                                <thead class="thead-dark">
                                    <tr class="tbl-st6">
                                         <th scope="col">
                                         <button type="button" onclick="EliminarCPE();" class="btn btn-outline-danger btn-sm">Eliminar</button></th>
                                        <th scope="col">RUC del Emisor</th>
                                        <th scope="col">Tipo Doc.</th>
                                        <th scope="col">Series CPE</th>
                                        <th scope="col">Número CPE</th>
                                        <th scope="col">Fecha CPE</th>
                                        <th scope="col">RUC Cliente</th>
                                        <th scope="col">Razón Social</th>
                                        <th scope="col">Moneda</th>
                                        <th scope="col">Sub Total</th>
                                        <th scope="col">IGV</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Vigencia</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acción</th>
                                        <th scope="col">Adjuntos</th>
                                    </tr>
                                </thead>
                                <tbody>';
            if ($total >= 1 && $pagina <= $Npaginas) {
                $contador = $inicio;
                foreach ($datos as $rows) {
                    $contador++;
                    $moneda = "";
                    if ($rows["moneda"] == 1) {
                        $moneda = "Soles";
                    } else {

                        $moneda = "Dólares";
                    }
                    $tabla .= '
                
                <tr>
                    <td>
                        <div class="input-group mb-3">
                            <div class="input-group-" style="padding-top:12px;">
                                <div class="input-group-text">
                                    <input  type="checkbox"  value="' . $rows['cpe_numero'] . '" name="cpe_list[]">
                                </div>
                            </div>
                        </div>
                    </td>
                    <th scope="row">' . $rows["cpe_rucemisor"] . '</th>
                    <td>' . $rows["cpe_tipodocumento"] . '</td>
                    <td>' . $rows["cpe_serie"] . '</td>
                    <td>' . $rows["cpe_numero"] . '</td>
                    <td>' . $rows["fechaemsion"] . '</td>
                    <td>' . $rows["ruccliente"] . '</td>
                    <td>' . $rows["razoncliente"] . '</td>
                    <td>' . $moneda . '</td>
                    <td>' . $rows["subotal"] . '</td>
                    <td>' . $rows["igv"] . '</td>
                    <td>' . $rows["total"] . '</td>
                    <td>' . $rows["vigencia_cpe"] . '</td>
                    <td>' . $rows["estadosunat"] . '</td>
                    <td>

                    <form action="' . SERVERURL . 'ajax/CPE.php" method="POST" class="FormularioAjax"  data-form="delete" autocomplete="off" enctype="multipart/form-data">
            
                    <input type="hidden" hidden name="cpe_numero_up_vig" value="' . $rows['cpe_numero'] . '">
                        <input class="btn btn-outline-danger btn-sm" type="submit" value="Eliminar" >
                    </form>
                    <div class="RespuestaAjax" id="RespuestaAjax">
        
                    </td>
                <td>';
                    // BUSCAR ARCHIVOS XML
                    $nombreArchivo = $rows["rutazip"];
                    $fechaEmision = $rows["fechaemsion"];
                    $archivoName = explode(".", $nombreArchivo);

                    $path = "././vistas/archivosCPE/" . $fechaEmision;
                    $i = 0;
                    if (file_exists($path)) {
                        $directorio = opendir($path);
                        while ($archivo = readdir($directorio)) {
                            if (!is_dir($archivo) && $i++ == 0) {

                                $archivoBD = $archivoName[0] . ".xml";

                                if ($archivoBD == $archivo) {

                                    $tabla .= '
                                <a download="' . $archivo . '" href="' . SERVERURL . 'vistas/archivosCPE/' . $archivoName[0] . '.xml" ><img title="Descargar XML" width="25" src="' . SERVERURL . 'vistas/images/xml.jpg"  /></a>';
                                }
                            }
                        }
                    } else {
                        $xml = $rows["rutaxml"];
                        $cdr = $rows["rutacdr"];
                        $pdf = $rows["rutapdf"];
                        $zip = $rows["rutazip"];
                        $nombreArchivo = $rows["rutazip"];
                        $fechaEmision = $rows["fechaemsion"];
                        $archivoName = explode(".", $nombreArchivo);

                        $path = ".././vistas/archivosCPE/" . $fechaEmision;
                        if (file_exists($path)) {
                            $directorio = opendir($path);

                            while ($archivo = readdir($directorio)) {
                                if ($archivo == trim($zip) || $archivo == trim($cdr) || $archivo == trim($xml) || $archivo == trim($pdf)) {
                                    $file = new SplFileInfo($archivo);
                                    $extencion = '';
                                    $logo = '';
                                    $size = 0;
                                    switch ($nombre = $file->getExtension()) {
                                        case $nombre = "xml":
                                            $extencion = '.xml';
                                            $logo = 'xml.jpg';
                                            $size = 25;
                                            break;
                                        case $nombre = "cdr":
                                            $extencion = '.cdr';
                                            $logo = 'cdr.png';
                                            $size = 20;
                                            break;
                                        case $nombre = "pdf":
                                            $extencion = '.pdf';
                                            $logo = 'pdf.jpg';
                                            $size = 15;
                                            break;
                                        case $nombre = "zip":
                                            $extencion = '.zip';
                                            $logo = 'zip.png';
                                            $size = 20;
                                            break;

                                        default:
                                            # code...
                                            break;
                                    }
                                    if (!is_dir($archivo)) {
                                        $archivo = trim($archivo);
                                        $tabla .= '
                                <a download="' . $archivo . '" href="' . SERVERURL . 'vistas/archivosCPE/' . $fechaEmision . '/' . $archivo . '"><img title="' . $archivo . '" width="' . $size . '" src="' . SERVERURL . 'vistas/images/' . $logo . '"  /></a>';
                                    }
                                }
                            }
                        }
                    }





                    $tabla .= '
                </td>
                    
            </tr>
            ';
                }

                $tabla .= ' </tbody>
            </table>

        </div>';
                $contador++;
            } else {



                if ($total >= 1) {

                    $tabla .= '
				<tr>
					<td colspan="5">
						<a href="' . SERVERURL . '/cpe/" class="btn btn-sm btn-info btn-raised"> 
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
    }


    public function actualizar_cpe_controlador()
    {


        $result = mainModel::ejecutar_consulta_simple("CALL SP_CPE_DUPLICADOS()");
        $result2 = mainModel::ejecutar_consulta_simple("CALL SP_CPE_DUPLICADOS_NOVIG()");

        foreach ($result as $key => $rows) {
            $cpe = $rows["cpe_numero"];
            $result = mainModel::ejecutar_consulta_simple("CALL SP_DROP_CPE('" . trim($cpe) . "')");
        }

        foreach ($result2 as $key => $rows) {
            $cpe = $rows["cpe_numero"];
            $result = mainModel::ejecutar_consulta_simple("CALL SP_DROP_CPE_TEMP('" . trim($cpe) . "')");
        }

        $upCpe = mainModel::ejecutar_consulta_simple("CALL SP_UP_CPE_TEMPORAL()");

        if ($upCpe->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Exito al actualizar Comprobantes Electrónicos ",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "Ocurrió un error. ¡Ups!",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }
    public function actualizar_cpe_vigencia_controlador()
    {

        $cpe_numero_up_vig = mainModel::limpiar_cadena($_POST["cpe_numero_up_vig"]);

        $guardarCPE = cpeModelo::update_cpe_vige_modelo($cpe_numero_up_vig);

        if ($guardarCPE->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Exito al eliminar comprobante",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "Ocurrió un error. ¡Ups!",
                "Tipo" => "error"
            ];
        }

        return header('Location: ' . SERVERURL . 'consultaCpe');
    }
    public function actualizar_cpe_vigencia_list_controlador()
    {

        $json_cpe = mainModel::limpiar_cadena($_POST["json"]);

        for ($i = 0; $i < count($json_cpe); $i++) {
            $guardarCPE = cpeModelo::update_cpe_vige_modelo($json_cpe[$i]);
        }


        if ($guardarCPE->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Se eliminaron los comprobantes seleccionados",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "Ocurrió un error. ¡Ups!",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }


    public function consulta_cpe_usuario_controlador()
    {

        $ruc = mainModel::limpiar_cadena($_POST["consulta_ruc"]);
        $tipo = mainModel::limpiar_cadena($_POST["consulta_tipo_comp"]);
        $serie = mainModel::limpiar_cadena($_POST["consulta_serie"]);
        $numero = mainModel::limpiar_cadena($_POST["consulta_numero_cpe"]);
        $fecha = mainModel::limpiar_cadena($_POST["consulta_fecha_emision"]);
        $importe = mainModel::limpiar_cadena($_POST["consulta_importe"]);

        $tabla = '';


        $result = mainModel::ejecutar_consulta_simple("CALL SP_CPE_CONSULTA_USU('" . $ruc . "','" . $tipo . "','" . $serie . "','" . $numero . "','" . $fecha . "','" . $importe . "')");


        if ($result->rowCount() >= 1) {
            
            $tabla .= '
    
        <h4 class="alert-heading">Listado de Comprobantes de Ventas</h4>
        <br>
                <div class="table-responsive fixedHeaderTable" style="overflow-y:scroll;height:160px;" id="fixedY">
                    <table style="height: 00px;"  class="table table-sm">
                        <thead class="thead-dark">
                            <tr class="tbl-st6">
                            <th scope="col">RUC del Emisor</th>
                                <th scope="col">Tipo Doc.</th>
                                <th scope="col">Series CPE</th>
                                <th scope="col">Número CPE</th>
                                <th scope="col">Fecha CPE</th>
                                <th scope="col">RUC Cliente</th>
                                <th scope="col">Razón Social</th>
                                <th scope="col">Moneda</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">IGV</th>
                                <th scope="col">Total</th>
                                <th scope="col">Vigencia</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Adjuntos</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($result as $key => $rows) {

                $moneda = "";
                if ($rows["moneda"] == 1) {
                    $moneda = "Soles";
                } else {

                    $moneda = "Dólares";
                }
                $tabla .= '
            
            <tr>
                <th scope="row">' . $rows["cpe_rucemisor"] . '</th>
                <td>' . $rows["cpe_tipodocumento"] . '</td>
                <td>' . $rows["cpe_serie"] . '</td>
                <td>' . $rows["cpe_numero"] . '</td>
                <td>' . $rows["fechaemsion"] . '</td>
                <td>' . $rows["ruccliente"] . '</td>
                <td>' . $rows["razoncliente"] . '</td>
                <td>' . $moneda . '</td>
                <td>' . $rows["subotal"] . '</td>
                <td>' . $rows["igv"] . '</td>
                <td>' . $rows["total"] . '</td>
                <td>' . $rows["vigencia_cpe"] . '</td>
                <td>' . $rows["estadosunat"] . '</td>
            <td>';
                // BUSCAR ARCHIVOS XML
                $nombreArchivo = $rows["rutazip"];
                $fechaEmision = $rows["fechaemsion"];
                $archivoName = explode(".", $nombreArchivo);

                $path = "././vistas/archivosCPE/" . $fechaEmision;
                $i = 0;
                if (file_exists($path)) {
                    $directorio = opendir($path);
                    while ($archivo = readdir($directorio)) {
                        if (!is_dir($archivo) && $i++ == 0) {

                            $archivoBD = $archivoName[0] . ".xml";

                            if ($archivoBD == $archivo) {

                                $tabla .= '
                            <a download="' . $archivo . '" href="' . SERVERURL . 'vistas/archivosCPE/' . $archivoName[0] . '.xml" ><img title="Descargar XML" width="25" src="' . SERVERURL . 'vistas/images/xml.jpg"  /></a>';
                            }
                        }
                    }
                } else {
                    $xml = $rows["rutaxml"];
                    $cdr = $rows["rutacdr"];
                    $pdf = $rows["rutapdf"];
                    $zip = $rows["rutazip"];
                    $nombreArchivo = $rows["rutazip"];
                    $fechaEmision = $rows["fechaemsion"];
                    $archivoName = explode(".", $nombreArchivo);

                    $path = ".././vistas/archivosCPE/" . $fechaEmision;
                    if (file_exists($path)) {
                        $directorio = opendir($path);

                        while ($archivo = readdir($directorio)) {
                            if ($archivo == trim($zip) || $archivo == trim($cdr) || $archivo == trim($xml) || $archivo == trim($pdf)) {
                                $file = new SplFileInfo($archivo);
                                $extencion = '';
                                $logo = '';
                                $size = 0;
                                switch ($nombre = $file->getExtension()) {
                                    case $nombre = "xml":
                                        $extencion = '.xml';
                                        $logo = 'xml.jpg';
                                        $size = 25;
                                        break;
                                    case $nombre = "cdr":
                                        $extencion = '.cdr';
                                        $logo = 'cdr.png';
                                        $size = 20;
                                        break;
                                    case $nombre = "pdf":
                                        $extencion = '.pdf';
                                        $logo = 'pdf.jpg';
                                        $size = 15;
                                        break;
                                    case $nombre = "zip":
                                        $extencion = '.zip';
                                        $logo = 'zip.png';
                                        $size = 20;
                                        break;

                                    default:
                                        # code...
                                        break;
                                }
                                if (!is_dir($archivo)) {
                                    $archivo = trim($archivo);
                                    $tabla .= '
                            <a download="' . $archivo . '" href="' . SERVERURL . 'vistas/archivosCPE/' . $fechaEmision . '/' . $archivo . '"><img title="' . $archivo . '" width="' . $size . '" src="' . SERVERURL . 'vistas/images/' . $logo . '"  /></a>';
                                }
                            }
                        }
                    }else{
                        $tabla.='<h6>No contiene adjuntos</h6>';
                    }
                }

                $tabla .= '
            </td>
                
        </tr>
        ';
            }

            $tabla .= ' </tbody>
        </table>

    </div>
    <script>
    swal({
        title: "Comprobante Encontrado",
        text: "Los datos ingresados coinciden",
        type: "success",
        confirmButtonText: "Aceptar"
    })
    </script>';

             return $tabla;
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Lo sentimos",
                "Texto" => "Los datos que ingresaste no coinciden con algún comprobante",
                "Tipo" => "error"
            ];
            return mainModel::sweet_alert($alerta);
        }


        
    }
}
