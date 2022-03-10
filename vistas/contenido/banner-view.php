<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Banner</h5>
                        <p class="m-b-0">Gestion de banner</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Banner</a>
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
                            <div class="card-block">
                                <br>
                                <h4>Registro de Banner</h4>
                                <br>
                                <form action="<?php echo SERVERURL; ?>ajax/bannerAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Título de Banner</label>
                                        <input type="text" name="titulo" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Título">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Descripción de Banner</label>
                                        <input type="text" name="descripcion" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Descripción">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Botón</label>
                                        <input type="text" name="boton" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Descripcion de Botón">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Dirección URL</label>
                                        <input type="text" name="url" class="form-control" id="exampleInputEmail1" placeholder="Ingresar Dirección URL del botón">
                                    </div>
                                </form>
                                <br>


                                <div class="card" style="width: auto">
                                    <div class="card-body">
                                        <h6>Cargar imágen a banner <span class="badge badge-secondary">Formato: PNG | Dimensiones 1280 x 400 | Límite de 3MB</span></h6>

                                        <div class="form-group">
                                            <input name="imagenBanner" id="imagenBanner" type="file" accept="image/png,image/jpeg,image/jpg" class="form-control-file" id="exampleFormControlFile1">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Cargar</button>
                                    </div>
                                </div>
                                </form>


                                <div class="RespuestaAjax" id="RespuestaAjax">
                                </div>


                                <br>
                                <br>

                                <h4>Listado de Banners</h4>

                                <!-- Carousel wrapper -->
                                <div id="carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-mdb-ride="carousel">
                                    <!-- Controls -->
                                    <!-- Inner -->
                                    <div class="carousel-inner py-4">
                                        <!-- Single item -->
                                        <div class="carousel-item active">
                                            <div class="container">
                                                <div class="row">

                                                    <?php

                                                    require_once "./core/mainModel.php";
                                                    $result = mainModel::ejecutar_consulta_simple("SELECT * FROM web_biblioteca WHERE BIB_ESTADO=1");
                                                    while ($row = $result->fetch()) {
                                                        $path = "./../libertad/resources/images/slider";
                                                        if (file_exists($path)) {
                                                            $directorio = opendir($path);



                                                            while ($archivo = readdir($directorio)) {
                                                                if (!is_dir($archivo) && $row["BIB_PATH"] == $archivo) {
                                                                    echo
                                                                    '<div class="col-lg-4">
                                                                            <div class="card">
                                                                                <img onclick="showMaxImg(this)" src="../../libertad/resources/images/slider/' . $archivo . '" class="card-img-top" alt="Waterfall" />
                                                                                <div class="card-body">
                                                                                <h5 class="card-title">' . $row["BIB_TITULO"] . '</h5>
                                                                                    <p class="card-text">' . $row["BIB_DESCRIPCION"] . '</p>
                                                                                    <a href="javascript:eliminarBanner(' . $row["BIB_ID"] . ');" class="btn btn-outline-danger btn-sm">Eliminar</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>';
                                                                }
                                                            }
                                                        }
                                                    }





                                                    ?>


                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Inner -->
                                </div>
                                <!-- Carousel wrapper -->
                            </div>
                        </div>
                    </div>
                    <!-- Page-body end -->





                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg text-center" id="imgModal" tabindex="-1" role="dialog" data-toggle="modal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="display:inline-block;width:auto; width: 100%">
            <div class="modal-content">
                <div id="imgshow"></div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        function showMaxImg(obj) {
            var src = $(obj).attr("src");
            $("#imgModal").find("#imgshow").html("<img src='" + src + "' class='carousel-inner img-responsive img-rounded' data-dismiss='modal'>");
            $("#imgModal").modal('show');
        }

        function eliminarBanner(id) {

            $.ajax({
                url: "<?php echo SERVERURL; ?>ajax/bannerAjax.php",
                method: "POST",
                data: {
                    "id_banner": id
                },
                success: function(respuesta) {
                    $("#RespuestaAjax").attr("disabled", false);
                    $("#RespuestaAjax").html(respuesta);
                }
            })
        }
    </script>