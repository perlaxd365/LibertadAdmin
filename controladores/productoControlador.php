<?php
if ($peticionAjax) {
    require_once "../modelos/productoModelo.php";
} else {
    require_once "./modelos/productoModelo.php";
}

class productoControlador extends productoModelo
{

    public function agregar_producto_controlador()
    {

        if (isset($_FILES["dataProducto"])) {

            $tipo = $_FILES["dataProducto"]["type"];
            $tamaño = $_FILES["dataProducto"]["size"];
            $archivotmp = $_FILES["dataProducto"]["tmp_name"];
            $lineas = file($archivotmp);

            $contador = 0;

            $limpiar = productoModelo::limpiar_prod_temp_modelo();
            foreach ($lineas as $linea) {
                $cantidad_registros = count($lineas);

                $datos = explode(";", $linea);

                $prod_codigo =            !empty($datos[0]) ? ($datos[0]) : '';
                $prod_descripcion =       !empty($datos[1]) ? ($datos[1]) : '';
                $prod_abreviatura =       !empty($datos[2]) ? ($datos[2]) : '';
                $prod_denominacion =      !empty($datos[3]) ? ($datos[3]) : '';
                $produc_imagen =          !empty($datos[4]) ? ($datos[4]) : '';
                $line_descripcion =       !empty($datos[5]) ? ($datos[5]) : '';
                $suli_descripcion =       !empty($datos[6]) ? ($datos[6]) : '';
                $ssli_descripcion =       !empty($datos[7]) ? ($datos[7]) : '';
                $prod_vigencia =          !empty($datos[8]) ? ($datos[8]) : '';
                $pvpd_importe =           !empty($datos[9]) ? ($datos[9]) : '';





                $dataProducto = [
                    "prod_codigo" => trim($prod_codigo),
                    "prod_descripcion" => trim($prod_descripcion),
                    "prod_abreviatura" => trim($prod_abreviatura),
                    "prod_denominacion" => trim($prod_denominacion),
                    "produc_imagen" => trim($produc_imagen),
                    "line_descripcion" => trim($line_descripcion),
                    "suli_descripcion" => trim($suli_descripcion),
                    "ssli_descripcion" => trim($ssli_descripcion),
                    "prod_vigencia" => trim($prod_vigencia),
                    "pvpd_importe" => trim($pvpd_importe)

                ];
                if ($contador > 0) {
                    $guardarProducto = productoModelo::agregar_producto_temporal_modelo($dataProducto);
                    $guardarProducto = productoModelo::temporal_a_producto_modelo();
                }

                $contador++;
            }
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Exito al registrar Productos",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "No se seleccionó documento. ¡Ups!",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }


    public function agregar_imagenes_producto_controlador()
    {

        if (isset($_FILES["imagenesProducto"])) {
            $contador = 0;

            foreach ($_FILES["imagenesProducto"]["tmp_name"] as $key => $tmp_name) {
                $contador++;

                if ($_FILES["imagenesProducto"]["name"][$key]) {

                    //NOMBRE DE ARCHIVO
                    $filename = $_FILES["imagenesProducto"]["name"][$key];
                    //NOMBRE TEMPORAL DE ARCHIVO
                    $temporal = $_FILES["imagenesProducto"]["tmp_name"][$key];

                    $directorio = "../../libertad/resources/images/general";

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
            }
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "Por favor selecciona una o más imagenes",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }

    public function actualizar_productos_controlador()
    {


        $result = mainModel::ejecutar_consulta_simple("CALL SP_DUPLICADOS_TEMPO_PROD()");

        foreach ($result as $key => $rows) {
            $codigo = $rows["prod_codigo"];
            $result = mainModel::ejecutar_consulta_simple("CALL SP_DELETE_PRODUCTO('" . trim($codigo) . "')");
        }

        $upCpe = mainModel::ejecutar_consulta_simple("CALL SP_UP_TEMP_A_PROD()");

        if ($upCpe->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Exito al actualizar Productos",
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
}
