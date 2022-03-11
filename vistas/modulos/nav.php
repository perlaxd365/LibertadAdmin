<?php

if ($_SESSION["tipo_usuario_corsch"] != "Administrador") {
} else {
?>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <div class="mobile-search waves-effect waves-light">
                            <div class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close"><i class="ti-close input-group-text"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn"><i class="ti-search input-group-text"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo SERVERURL ?>home" style="padding-left: 40px;">
                            <img class="img-fluid" width="100" height="100" src="<?php echo SERVERURL ?>vistas/images/logopollo.png" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <img src="<?php echo SERVERURL ?>vistas/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                    <span><?php echo $_SESSION["nombre_usuario_corsch"] ?></span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li class="waves-effect waves-light">
                                        <a class="btn-exit-system dropdown-item" href="<?php echo $lc->encryption($_SESSION['token_corsch']); ?>">
                                            <i class="ti-layout-sidebar-left"></i> Salir
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- fin nav nav-->

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-80 img-radius" src="<?php echo SERVERURL ?>vistas/images/avatar-4.jpg" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span id="more-details"><?php echo $_SESSION["nombre_usuario_corsch"] ?><i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details"><a class="btn-exit-system dropdown-item" href="<?php echo $lc->encryption($_SESSION['token_corsch']); ?>"><i class="ti-layout-sidebar-left"></i>Salir</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>



                            <?php


                            if ($_SESSION["tipo_usuario_corsch"] == "Administrador" || $_SESSION["tipo_usuario_corsch"] == "Operario") {


                            ?>

                                <div class="pcoded-navigation-label">Navegación</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <?php
                                    $pagina = explode("/", $_GET['views']);
                                    ?>
                                    <li class="<?php if ($pagina[0] == "home") {
                                                    echo 'active';
                                                } ?>">
                                        <a href="<?php echo SERVERURL ?>home/" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                            <span class="pcoded-mtext">Inicio</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="pcoded-navigation-label">Gestión</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu <?php if ($pagina[0] == "cpe") {
                                                                    echo 'active';
                                                                } ?>">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-files"></i><b>BC</b></span>
                                            <span class="pcoded-mtext">Comprobantes</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class=" ">
                                                <a href="<?php echo SERVERURL ?>cpe/" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext">Importación</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class=" ">
                                                <a href="<?php echo SERVERURL ?>consultaCpe/" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext">Consultas</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                            <li class=" ">
                                                <a href="<?php echo SERVERURL ?>EliminarComp/" class="waves-effect waves-dark">
                                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                    <span class="pcoded-mtext">Eliminar</span>
                                                    <span class="pcoded-mcaret"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu <?php if ($pagina[0] == "user") {
                                                                    echo 'active';
                                                                } ?>">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-lock"></i><b>BC</b></span>
                                            <span class="pcoded-mtext">Seguridad</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                        <ul class="pcoded-submenu">

                                            <?php


                                            if ($_SESSION["tipo_usuario_corsch"] == "Administrador") {


                                            ?>
                                                <li class=" ">
                                                    <a href="<?php echo SERVERURL ?>user/" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Usuarios</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="<?php echo SERVERURL ?>perfil/" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Perfil</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="<?php echo SERVERURL ?>auditoria/" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Auditoría</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>

                                            <?php } else {

                                            ?>

                                                <li class=" ">

                                                    <form id="form" method="POST" action="<?php echo SERVERURL ?>userUP">
                                                        <input hidden type="text" name="id_usuario_actualizar" value="<?php echo $_SESSION["nombre_usuario_corsch"] ?>">
                                                        <a style="cursor: pointer;" onclick="document.forms['form'].submit()">Usuarios</a>
                                                    </form>
                                                </li>


                                            <?php
                                            } ?>

                                        </ul>
                                    </li>
                                </ul>
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="pcoded-hasmenu <?php if ($pagina[0] == "configWeb") {
                                                                    echo 'active';
                                                                } ?>">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-lock"></i><b>BC</b></span>
                                            <span class="pcoded-mtext">Mantenimiento</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                        <ul class="pcoded-submenu">

                                            <?php


                                            if ($_SESSION["tipo_usuario_corsch"] == "Administrador") {


                                            ?>
                                                <li class=" ">
                                                    <a href="<?php echo SERVERURL ?>configWeb/" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Configuración Web</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="<?php echo SERVERURL ?>importarProducto/" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Importar Productos</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="<?php echo SERVERURL ?>banner/" class="waves-effect waves-dark">
                                                        <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                        <span class="pcoded-mtext">Banner</span>
                                                        <span class="pcoded-mcaret"></span>
                                                    </a>
                                                </li>

                                            <?php }  ?>

                                        </ul>
                                    </li>
                                </ul>
                            <?php

                            } else {
                            ?>
                                <div class="pcoded-navigation-label">Navegación</div>
                                <ul class="pcoded-item pcoded-left-item">
                                    <?php
                                    $pagina = explode("/", $_GET['views']);
                                    ?>
                                    <li class="<?php if ($pagina[0] == "home") {
                                                    echo 'active';
                                                } ?>">
                                        <a href="<?php echo SERVERURL ?>consultaComprobante/" class="waves-effect waves-dark">
                                            <span class="pcoded-micon"><i class="ti-files"></i><b>D</b></span>
                                            <span class="pcoded-mtext">Consultar Comprobante</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                            <?php
                            }
                            ?>
                        </div>
                    </nav>
                    <script>

                    </script>
                <?php

            }

                ?>