<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="pcoded-content">
    <style>
        /* Styles for wrapping the search box */

        .main {
            width: 50%;
            margin: 50px auto;
        }

        /* Bootstrap 4 text input with search icon */

        .has-search .form-control {
            padding-left: 2.375rem;
        }

        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 2.375rem;
            height: 2.375rem;
            line-height: 2.375rem;
            text-align: center;
            pointer-events: none;
            color: #aaa;
        }
    </style>
    <!-- Page-header start -->



    <script>
        $(function() {
            $('#datosConsultaCPE').submit(function(ev) {

                ev.preventDefault();
                $.ajax({
                    type: $('#datosConsultaCPE').attr('method'),
                    url: $('#datosConsultaCPE').attr('action'),
                    data: $('#datosConsultaCPE').serialize(),
                    beforeSend: function() {
                        document.getElementById("loading").style.display = "block";
                    },
                    success: function(data) {
                        document.getElementById("loading").style.display = "none";
                        $("#RespuestaAjax").attr("disabled", false);
                        $("#RespuestaAjax").html(data);
                    }
                });
            });



        });
    </script>
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Consulta</h5>
                        <p class="m-b-0">Consulta de comprobantes electrónicos</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Consulta</a>
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
                    <!-- Page-body end -->

                    <div class="card" style="width: auto">
                        <div class="card-body">
                            <div class="card-block">
                                <form id="datosConsultaCPE" method="POST" action="<?php echo SERVERURL ?>ajax/CPE.php" name="datosConsultaCPE" enctype="multipart/form-data">


                                    <?php
                                    $pagina = explode("/", $_GET['views']); ?>
                                    <input name="nro-pagina" type="hidden" value="<?php $pagina[1] ?> ">


                                    <div class="row">
                                        <div class="col-6">
                                            <label for="exampleInputEmail1">Cliente</label>
                                            <input onkeypress="limpiarDiv();" onkeydown="limpiarDiv();" name="buscar-cliente" id="buscar-cliente" type="text" class="form-control" placeholder="Buscar Por Cliente" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>

                                        <div class="col-6">
                                            <label for="exampleInputEmail1">RUC</label>
                                            <input onkeypress="limpiarDiv();" onkeydown="limpiarDiv();" name="buscar-ruc" type="text" class="form-control" placeholder="Buscar por Ruc" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-6">

                                            <label for="exampleInputEmail1">Vigencia</label>
                                            <select onchange="limpiarDiv();" name="vigencia" class="custom-select">
                                                <option selected value="SI">SI</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                        <div class="col-6">

                                            <label for="exampleInputEmail1">Estado</label>
                                            <select onchange="limpiarDiv();" name="estado" class="custom-select">
                                                <option selected value="SI">ACTIVO</option>
                                                <option value="NO">ANULADO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="exampleInputEmail1">Fecha de Inicio</label>
                                            <input onkeypress="limpiarDiv();" onkeydown="limpiarDiv();" onchange="limpiarDiv();" id="datepicker" autocomplete="off" class="form-control" name="fechaini" />
                                        </div>
                                        <div class="col-6">
                                            <label for="exampleInputEmail1">Fecha de Fin</label>
                                            <input onkeypress="limpiarDiv();" onkeydown="limpiarDiv();" onchange="limpiarDiv();" id="datepicker2" autocomplete="off" class="form-control" name="fechafin" />
                                        </div>
                                    </div>
                                    <br>
                                    <input type="submit" onclick="limpiarDiv()" class="btn btn-primary col-md-1 btn-sm" value="Buscar">


                                </form>
                                <br>
                                <div id="loading" style="display: none;">
                                    <img width="80" class="rounded mx-auto d-block" height="50" src="<?php echo SERVERURL ?>vistas/images/cargando.gif" alt="">
                                </div>
                                <div class="RespuestaAjax" id="RespuestaAjax">
                                </div>

                                <div id="respuestaEliminar" id="respuestaEliminar"></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        function limpiarDiv() {

            document.getElementById("RespuestaAjax").innerHTML = "";
        }

        function EliminarCPE() {


            var arrTodo = new Array();
            var cpe_list = $("input:checkbox:checked").map(function() {
                return $(this).val();
            }).get();

            

            if (cpe_list.length <=0) {
                swal({
                    title: 'Error',
                    text: 'Para eliminar por favor seleccionar un comprobante',
                    type: 'error',
                    confirmButtonText: 'Aceptar'
                })
            } else {



                console.log(cpe_list);

                swal({
                    title: 'Advertencia',
                    text: '¿Estas seguro que quieres eliminar los comprobantes seleccionados?',
                    type: 'question',
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonText: 'Aceptar'
                }).then(function() {

                    var url = "../ajax/CPE.php";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            "json": cpe_list
                        },
                        beforeSend: function() {
                            document.getElementById("loading").style.display = "block";
                        },
                        success: function(data) {
                            document.getElementById("loading").style.display = "none";
                            $("#respuestaEliminar").attr("disabled", false);
                            $("#respuestaEliminar").html(data);
                        }
                    });


                });


            }



        }



        $(document).ready(function() {
            var date = new Date();
            $("#datepicker").datepicker({
                dateFormat: "dd-mm-yy",
                uiLibrary: 'bootstrap4'
            }).datepicker("setDate", new Date(date.getFullYear(), date.getMonth(), 1));
        });


        $(document).ready(function() {
            $("#datepicker2").datepicker({
                dateFormat: "dd-mm-yy",
                uiLibrary: 'bootstrap4'
            }).datepicker("setDate", new Date());
        });
    </script>