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
                        <h5 class="m-b-10">Seguridad</h5>
                        <p class="m-b-0">Gestion de Usuarios</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Seguridad</a>
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
                            <h5 class="card-title">Registro de Usuario</h5>
                            <form action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">

                                <input type="hidden" value="<?php echo $_SESSION["nombre_usuario_corsch"] ?>" name="usuarioActual">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Nombres</label>
                                        <input type="text" required name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresar Nombres">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Apellido Paterno</label>
                                        <input type="text" required name="apepat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Apellido Paterno">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Apellido Materno</label>
                                        <input type="text" required name="apemat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Apellido Materno">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Perfil de Usuario</label>
                                        <select name="id_perfil" class="custom-select">

                                            <?php
                                            $result = mainModel::ejecutar_consulta_simple("SELECT * FROM perfil_usuario");

                                            foreach ($result as $key => $rows) {

                                                echo '<option value="' . $rows["id_perfil"] . '">' . $rows["desc_perfil"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">DNI</label>
                                        <input type="text" required maxlength="8" name="dni" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresar DNI">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Número de Teléfono</label>
                                        <input type="text" required name="telefono" maxlength="12" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Número de Teléfono">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" required name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresar Email">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Usuario</label>
                                        <input type="text" required name="usuario" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresar Usuario">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputPassword1">Contraseña</label>
                                        <input type="password" required name="pass" class="form-control" id="exampleInputPassword1" placeholder="Ingresar Contraseña">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Vigencia</label>
                                        <select name="vigencia" class="custom-select">
                                            <option selected value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Guardar</button>

                            </form>


                            <div class="RespuestaAjax" id="RespuestaAjax">
                            </div>
                        </div>
                    </div>



                    <div class="card" style="width: auto">
                        <div class="card-body">
                            <h5 class="card-title">Listado de Usuarios</h5>
                            <br>
                            <div class="input-group col-md-6">
                                <input placeholder="Ingrese Nombres y Apellidos del Usuario" onkeypress="limpiarDiv();" onkeydown="limpiarDiv();" onkeyup="limpiarDiv()" id="texto" type="text" Class="custom-select">
                                <select class="custom-select" aria-placeholder="aver" id="vigencia">
                                    <option selected value="TODOS">Vigencia (Todos)</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                                <button onclick="obtenerBusqueda()" id="show_password" class="btn btn-primary" type="button">
                                    <span>Buscar</span>
                                </button>
                            </div>
                            </div>
                            <div id="loading" style="display: none;">
                                <img width="80" class="rounded mx-auto d-block" height="50" src="<?php echo SERVERURL ?>vistas/images/cargando.gif" alt="">
                            </div>
                            <div class=" card-block" id="tablaresultado">

                            </div>
                            <div class=" card-block" id="tabla">




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



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="datos"> </div>
        </div>
    </div>
</div>

<?php 
  }
?>


<script>
    function limpiarDiv() {

        document.getElementById("tablaresultado").innerHTML = "";
    }

    function enviarIdUser(id) {

        $.ajax({
            url: "<?php echo SERVERURL; ?>ajax/usuarioAjax.php",
            method: "POST",
            data: {
                "id_usuario": id
            },
            success: function(respuesta) {
                $("#datos").attr("disabled", false);
                $("#datos").html(respuesta);
            }
        });
    }

    function obtenerBusqueda() {
        var texto = $("#texto").val();
        var vigencia = $("#vigencia").val();
        var ln_opcion=0;
        if (vigencia=='SI' || vigencia=='NO') {
            ln_opcion=1;
        }else{
            ln_opcion=0;
        }



        document.getElementById("tabla").style.display = "none";
        document.getElementById("tablaresultado").style.display = "block";
        var usuario = '<?php echo $_SESSION["nombre_usuario_corsch"]; ?>'
        $.ajax({
            url: "<?php echo SERVERURL; ?>ajax/usuarioAjax.php",
            method: "POST",
            data: {
                "buscar": texto,
                "usuarioActual": usuario,
                "vigencia": vigencia,
                "ln_opcion": ln_opcion
            },
            beforeSend: function() {
                document.getElementById("loading").style.display = "block";
            },
            success: function(respuesta) {
                document.getElementById("loading").style.display = "none";
                $("#tablaresultado").attr("disabled", false);
                $("#tablaresultado").html(respuesta);
            }
        })

    }
</script>