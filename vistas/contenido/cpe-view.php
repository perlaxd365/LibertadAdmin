<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Importación</h5>
                        <p class="m-b-0">Permite importar los comprobantes de ventas emitidos</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Importación</a>
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
                                <h6>Cargar listado de comprobantes de ventas emitidos | <span class="badge badge-secondary">Formato: "CSV Delimitado por Comas"</span></h6>
                                <form action="<?php echo SERVERURL; ?>ajax/CPE.php" method="POST" data-form="save" class="moduloCPE" autocomplete="off" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <input type="hidden" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                        <input type="hidden" name="id_usuario_sesion" value="<?php echo $_SESSION["nombre_usuario_corsch"] ?>" >

                                        <input name="dataComprobante" type="file" accept="text/csv" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                    <a href="<?php echo SERVERURL;?>vistas/PlantillasDonwload/PlantillaCPE.csv"  class="btn btn-secondary">Descargar Plantilla</a>
                                    <button type="submit" class="btn btn-primary">Cargar</button>
                                </form>

                                <div id="loading" style="display: none;">
                                    <img width="80" class="rounded mx-auto d-block" height="50" src="<?php echo SERVERURL ?>vistas/images/cargando.gif" alt="">
                                </div>

                                <div class="RespuestaAjax" id="RespuestaAjax">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page-body end -->



                    <div class="card" style="width: auto">
                        <div class="card-body">
                            <div class="card-block">

                                <h6>Cargar archivos de comprobantes de ventas emitidos | <span class="badge badge-secondary">Formato: PDF,XML</span></h6>
                                <form action="<?php echo SERVERURL; ?>ajax/CPE.php"  method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">

                                    <div class="form-group"> <input type="hidden" name="archivos" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                                        <input multiple="" name="archivosCPE[]" id="archivosCPE[]" accept="application/pdf,text/xml"  type="file" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                      <button type="submit" class="btn btn-primary">Cargar</button>
                                </form>

                                <div id="loading1" style="display: none;">
                                    <img width="80" class="rounded mx-auto d-block" height="50" src="<?php echo SERVERURL ?>vistas/images/cargando.gif" alt="">
                                </div>

                                <div class="RespuestaAjax" id="RespuestaAjax">
                                </div>

                            </div>
                        </div>
                    </div>

                    

                </div>
            </div>
        </div>
    </div>