<?php


    require_once "./controladores/configwebControlador.php";
    $classDoc = new configwebControlador();
    $filesL = $classDoc->data_configweb_controlador();
    if ($filesL->rowCount() >= 1) {

        $campos = $filesL->fetch();

?>

        <div class="pcoded-content">
            <!-- Page-header start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Configuracion</h5>
                                <p class="m-b-0">Mantenimiento de configuración</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html"> <i class="fa fa-home"></i> </a>
                                </li>
                                <li class="breadcrumb-item"><a href="#!">Configuración</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-header end -->
            <div class="pcoded-inner-content">
                <!-- Main-body start -->
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- Page-body start -->
                        <div class="page-body">

                            <div class="card" style="width: auto">
                                <div class="card-body">
                                    
                                    <form action="<?php echo SERVERURL; ?>ajax/configwebAjax.php" method="POST" data-form="update" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                                    
                                    <h5 class="card-title">Configuración de etiquetas</h5>    
                                    <div class="row">
                                            <input type="hidden" value="<?php echo $campos['id_etiqueta']?>" name="id_etiqueta">
                                            
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">URL Facebook</label>
                                                <input value="<?php echo $campos['url_fb_eti'] ?>"  name="url-fb-up" placeholder="Ingresar dirección de Facebook" type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">URL Instagram</label>
                                                <input value="<?php echo $campos['url_ins_eti'] ?>"  name="url-insta-up" placeholder="Ingresar dirección de instagram" type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">URL Twitter</label>
                                                <input value="<?php echo $campos['url_tw_eti'] ?>"  name="url-tw-up" placeholder="Ingresar dirección de Twitter" type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">URL LinkedIn</label>
                                                <input value="<?php echo $campos['url_in_eti'] ?>"  name="url-in-up" placeholder="Ingresar dirección de LinkedIn" type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>

                                    </div>
                                    <br>
                                            <h5 class="card-title">Configuración de empresa</h5>    
                                    <div class="row">
                                        <div class="col-md-6">
                                                <label for="exampleInputEmail1">Correo</label>
                                                <input value="<?php echo $campos['correo_eti'] ?>"  name="correo-up" placeholder="Ingresar correo" type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">Teléfono</label>
                                                <input value="<?php echo $campos['telefono_eti'] ?>"  name="telefono-up" placeholder="Ingresar teléfono" type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">Direccion de Local</label>
                                                <input value="<?php echo $campos['direccion_eti'] ?>"  name="direccion_eti" placeholder="Ingresar dirección de empresa" type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">Ciudad</label>
                                                <input value="<?php echo $campos['ciudad_eti'] ?>"  name="ciudad_eti" placeholder="Ingresar Ciudad" type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">Distrito</label>
                                                <input value="<?php echo $campos['distrito_eti'] ?>"  name="distrito_eti" placeholder="Ingresar Distrito" type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">País</label>
                                                <input value="<?php echo $campos['pais_eti'] ?>"  name="pais_eti" placeholder="Ingresar Pais" type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>

                                        </div>
                                        <br>
                                    <h5 class="card-title">Configuración de texto</h5>    
                                    <div class="row">
                                            <input type="hidden" value="<?php echo $campos['id_etiqueta']?>" name="id_etiqueta">
                                            
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">Texto pié de Página</label>
                                                <input value="<?php echo $campos['copy_eti'] ?>"  name="copy-up" placeholder="Ingresar texto pié de página" type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                            </div>
                                    </div>
                                        <br>
                                        <?php

                                        if ($_SESSION["tipo_usuario_corsch"] == "Administrador") {


                                        ?>
                                            <a href="javascript:history.back()" class="btn btn-secondary">Cancelar</a>
                                        <?php } ?>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>

                                    </form>


                                    <div class="RespuestaAjax" id="RespuestaAjax">
                                    </div>
                                </div>
                            </div>



                        </div>
                        <!-- Page-body end -->
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal de Actualización -->
<?php
    } else {

        echo '<div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row mb-3">
                                    <div class="col-md-8 mx-auto">

                                    <div class="form-group row showcase_row_area">
                                                    <div class="col-3 showcase_text_area">
                                                       <br>
                                                    </div>
                                                    <div class="col-6 showcase_content_area">
                                                    <h4>Usuario no eliminado o no existente</h4>

                                                    </div>
                                               

                                        
                                    </div>
                                </div>
                            </div>
                        </div>';
    }

?>