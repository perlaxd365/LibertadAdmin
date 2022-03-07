<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Panel</h5>
                        <p class="m-b-0">Bienvenidos al administrador: "Pollería Libertad"</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Inicio</a>
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



                    <img src="<?php echo SERVERURL?>vistas/images/gallo.png" class="rounded mx-auto d-block" alt="Responsive image">

                    <div class="col-xl-6 col-md-12">

                        <!-- <div class="card table-card">
                            <div class="card-header">
                                <h5>Listado de Pedidos</h5>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                        <li><i class="fa fa-window-maximize full-card"></i></li>
                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                        <li><i class="fa fa-refresh reload-card"></i></li>
                                        <li><i class="fa fa-trash close-card"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table table-hover m-b-0 without-header">
                                        <tbody>

                                        
                                        <?php require_once './controladores/pedidoControlador.php';
                                        $lista = new pedidoControlador();


                                        $pagina = explode("/", $_GET['views']);

                                        echo $lista->paginador_cliente_controlador($pagina[1], 5,0,null);
                                        ?>



                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div> -->
                    </div>

                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>