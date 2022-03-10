<?php
if ($peticionAjax) {
    require_once "../modelos/bannerModelo.php";
} else {
    require_once "./modelos/bannerModelo.php";
}

class bannerControlador extends bannerModelo
{

    public function agregar_imagen_controlador()
    {

        if (isset($_FILES["imagenBanner"])) {



            if ($_FILES["imagenBanner"]["size"][0] >  3000 * 1000) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "(Límite 1MB)",
                    "Texto" => "El tamaño de la imagen supera el límite establecido ",
                    "Tipo" => "error"
                ];
            } else {

                //NOMBRE DE ARCHIVO
                $filename = $_FILES["imagenBanner"]["name"];
                //NOMBRE TEMPORAL DE ARCHIVO
                $temporal = $_FILES["imagenBanner"]["tmp_name"];

                $directorio = "../../libertad/resources/images/slider";

                if (file_exists($directorio)) {
                    mkdir($directorio, 0777, true);
                } else {
                    mkdir($directorio, 0700, true);
                }

                $dir = opendir($directorio);
                $ruta = $directorio . '/' . $filename;
                if (move_uploaded_file($temporal, $ruta)) {




                    
            $titulo = mainModel::limpiar_cadena($_POST['titulo']);
            $descripcion = mainModel::limpiar_cadena($_POST['descripcion']);
            $boton = mainModel::limpiar_cadena($_POST['boton']);
            $url = $_POST['url'];
            $patch = $filename;
            $datos = [

                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "patch" => $patch,
                "boton" => $boton,
                "url" => $url
            ];
            $guardar = bannerModelo::agregar_banner_modelo($datos);
            if ($guardar->rowCount() >= 1) {
                $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "Completado",
                    "Texto" => "Se registró correctame el nuevo banner",
                    "Tipo" => "success"
                ];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Algo salió mal",
                    "Texto" => "No se pudo agregar la descripcion",
                    "Tipo" => "error"
                ];
            }


                   
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

    public function eliminar_banner_controlador(){
        $id=$_POST["id_banner"];
        $eliminarBanner=bannerModelo::delete_banner_modelo($id);
        if ($eliminarBanner->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Se eliminó banner",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "No se eliminar banner",
                "Tipo" => "error"
            ];
        }
        
        return mainModel::sweet_alert($alerta);
    }
}
