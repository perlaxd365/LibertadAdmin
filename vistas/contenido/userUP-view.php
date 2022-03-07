<?php
if (isset($_POST["id_usuario_actualizar"])) {



    require_once "./controladores/usuarioControlador.php";
    $classDoc = new usuarioControlador();
    $filesL = $classDoc->data_usuario_controlador($_POST["id_usuario_actualizar"]);
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
                                    <h5 class="card-title">Actualizar Usuario: <?php echo $campos['USR_LOGIN'] ?></h5>
                                    <form action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="update" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                                        <div class="row">
                                            <input type="hidden" value="<?php echo $_SESSION["nombre_usuario_corsch"] ?>" name="usuarioActual">

                                            <input type="text" value="<?php echo $campos['USR_LOGIN'] ?>" hidden name="id_usuario_actualizar">

                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">Nombres</label>
                                                <input type="text" value="<?php echo $campos['USR_NOMBRE'] ?>" required name="nombre-up" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresar Nombres">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">Apellido Paterno</label>
                                                <input type="text" required value="<?php echo $campos['USR_APE_PAT'] ?>" name="apepat-up" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Apellido Paterno">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">Apellido Materno</label>
                                                <input type="text" required value="<?php echo $campos['USR_APE_MAT'] ?>" name="apemat-up" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Apellido Materno">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">Perfil de Usuario</label>
                                                <select name="id_perfil_up" class="custom-select">
                                                    <option <?php if ($campos['id_perfil'] == "3") {
                                                                echo 'selected=""';
                                                            } ?> value="3">Administrador</option>
                                                    <option <?php if ($campos['id_perfil'] == "4") {
                                                                echo 'selected=""';
                                                            } ?> value="4">Operador</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">DNI</label>
                                                <input type="text" required value="<?php echo $campos['USR_DNI'] ?>" maxlength="8" name="dni-up" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="DNI">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">Número de Teléfono</label>
                                                <input type="text" required value="<?php echo $campos['USR_TELEFONO'] ?>" name="telefono-up" maxlength="12" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Número de Teléfono">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input type="text" required value="<?php echo $campos['USR_EMAIL'] ?>" name="email-up" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Dirección de Email">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputPassword1">Contraseña</label>
                                                <input type="password" required value="<?php echo $campos['USR_CLAVE'] ?>" name="pass-up" class="form-control" id="exampleInputPassword1" placeholder="Ingresar Contraseña">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputPassword1">Usuario Creacion</label>
                                                <input readonly value="<?php echo $campos['usuario_creacion'] ?>" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputPassword1">Fecha Creacion</label>
                                                <input readonly value="<?php echo $campos['fecha_hora_creacion'] ?>" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputPassword1">Usuario Modificacion</label>
                                                <input readonly value="<?php echo $campos['usuario_modificacion'] ?>" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputPassword1">Fecha Modificacion</label>
                                                <input readonly value="<?php echo $campos['fecha_modificacion'] ?>" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputPassword1">Usuario Eliminacion</label>
                                                <input readonly value="<?php echo $campos['usuario_eliminacion'] ?>" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputPassword1">Fecha Eliminacion</label>
                                                <input readonly value="<?php echo $campos['fecha_eliminacion'] ?>" class="form-control" id="exampleInputPassword1">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">Vigencia</label>
                                                <select name="vigencia-up" class="custom-select">
                                                    <option <?php if ($campos['vigencia_usuario'] == "SI") {
                                                                echo 'selected=""';
                                                            } ?> value="SI">SI</option>
                                                    <option <?php if ($campos['vigencia_usuario'] == "NO") {
                                                                echo 'selected=""';
                                                            } ?> value="NO">NO</option>
                                                </select>
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
}
?>