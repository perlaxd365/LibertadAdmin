<?php
if ($peticionAjax) {
    require_once "../modelos/configwebModelo.php";
} else {
    require_once "./modelos/configwebModelo.php";
}

class configwebControlador extends configwebModelo
{

    public function actualizar_configweb_controlador()
    {

        $id_etiqueta = $_POST['id_etiqueta'];
        $correo = $_POST['correo-up'];
        $telefono = $_POST['telefono-up'];
        $copy = $_POST['copy-up'];
        $face = $_POST['url-fb-up'];
        $insta = $_POST['url-insta-up'];
        $twi = $_POST['url-tw-up'];
        $in = $_POST['url-in-up'];
        
        $dataConfigWeb = [
            "id_etiqueta" => $id_etiqueta,
            "correo" => $correo,
            "telefono" => $telefono,
            "copy" => $copy,
            "face" => $face,
            "insta" => $insta,
            "twi" => $twi,
            "in" => $in
        ];

        $upConfig = configwebModelo::up_config_modelo($dataConfigWeb);

        if ($upConfig->rowCount() >= 1) {

            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Completado",
                "Texto" => "Se actualizó correctamente la configuración",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Algo salió mal",
                "Texto" => "No se pudo actualizar la configuración. ¡Ups!",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }

    public function data_configweb_controlador()
    {

        return configwebModelo::data_configweb_modelo();
    }
}
