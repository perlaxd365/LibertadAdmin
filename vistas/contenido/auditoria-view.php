<?php 

if ($_SESSION["tipo_usuario_corsch"] != "Administrador"){
    echo $lc->forzar_cierre_sesion_controlador();
    header("location:".SERVERURL."");
    
    echo "<h1>No tienes permiso para acceder a esta página</h1>";
  }else{
     

?>
<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Auditoria</h5>
                        <p class="m-b-0">Auditoria</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Auditoria</a>
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



                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>

<?php } ?>