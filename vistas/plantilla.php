<?php

session_start(['name' => 'CORSCH']);
$peticionAjax = false;


require_once "./controladores/vistasControlador.php";

$vt = new vistasControlador();
$vistasR = $vt->obtener_vistas_controlador();
if ($vistasR == "login" || $vistasR == "404") {
  if ($vistasR == "404") {

    require_once "./vistas/contenido/404-view.php";
  } else {
    include "modulos/header.php";
    include "modulos/script.php";
    require_once "./vistas/contenido/login-view.php";
  }
} else {



  include "./controladores/loginControlador.php";
  $lc = new loginControlador();
  if (!isset($_SESSION['token_corsch'])) {
    echo $lc->forzar_cierre_sesion_controlador();
    header("location:" . SERVERURL . "");
  }

?>
  <!DOCTYPE html>
  <html lang="en">

  <?php include "modulos/header.php"; ?>

  <body>
    <!-- Pre-loader start -->
    <?php include "modulos/preload.php"; ?>
    <!-- Pre-loader end -->

        <?php include "modulos/nav.php"; ?>
        <!-- nav-->

        <?php require_once $vistasR; ?>


      <?php
    }
      ?>





      </div>
    </div>
    </div>
    </div>
    <?php include "modulos/script.php"; ?>

    <?php include "modulos/logoutScript.php"; ?>
  </body>

  </html>