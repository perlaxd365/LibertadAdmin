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
                        <h5 class="m-b-10">Perfil</h5>
                        <p class="m-b-0">Perfil de Usuario</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Perfil</a>
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
                    <div class="card" style="max-width: 800px;">
                        <div class="card-body table-responsive">

                            <?php require_once './controladores/perfilControlador.php';
                            $lista = new perfilControlador();


                            $pagina = explode("/", $_GET['views']);

                            echo $lista->paginador_perfil_controlador($pagina[1], 10);
                            ?>


                        </div>
                        <div id="datos">

                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>
<?php  
  }
 ?>

<script>
    
    function upVigencia(id) {

$.ajax({
    url: "<?php echo SERVERURL; ?>ajax/perfilAjax.php",
    method: "POST",
    data: {
        "id_perfil_vigencia": id
    },
    success: function(respuesta) {
        $("#datos").attr("disabled", false);
        $("#datos").html(respuesta);
    }
});
}
</script>