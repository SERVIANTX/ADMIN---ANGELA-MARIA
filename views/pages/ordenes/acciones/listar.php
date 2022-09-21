<?php

    if(isset($_GET["start"]) && isset($_GET["end"])){

        $between1 = $_GET["start"];
        $between2 = $_GET["end"];

    }else{

        $between1 = date("Y-m-d", strtotime("-100000 day", strtotime(date("Y-m-d"))));
        $between2 = date("Y-m-d");

    }

?>

<input type="hidden" id="between1" value="<?php echo $between1 ?>">
<input type="hidden" id="between2" value="<?php echo $between2 ?>">



<div class="card">

    <div class="card-header">

        <div class="card-tools">

            <div class="calendar-container mb-30">

                <div class="calendar-header">
                    <span class="mr-2">Reportes</span>
                        <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-off-color="warning" data-on-color="success" data-size="mini" data-handle-width="70" onchange="reportActive(event)">

                        <button type="button" class="btn flex-end" id="daterange-btn">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <?php if($between1 < "2000"){ echo "Start"; }else{ echo $between1; } ?> - <?php echo $between2 ?>
                            <i class="fas fa-caret-down ml-2"></i>
                        </button>
                </div>

            </div>


        </div>

    </div>

    <div class="card-body">
        <table id="TablaAdministradores" class="table table-striped tableOrdenes">
            <thead>
                <tr>
                    <th>N° de la orden</th>
                    <th>Fecha de la orden</th>
                    <th>Cliente</th>
                    <th>Dirección</th>
                    <th>Celular</th>
                    <th>Estado del pedido</th>
                    <th>Metodo de pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>

        </table>
    </div>

</div>

<script src="views/assets/custom/datatable/datatable.js"></script>

<!--=====================================================================
    TODO: Ventana modal para actualizar Facebook
=====================================================================-->

<div class="modal fade" id="infoDocument" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form method="post" class="needs-validation" novalidate>

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Fotografia del documento</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" name="id_order">

                    <div class="form-group">

                        <div class="form-group__content">

                            <!--==================================================
                                TODO: Fotografia del DNI
                            ==================================================-->

                            <div class="form-group mt-4">

                                <label for="customFile" class="d-flex justify-content-center">
                                    <figure class="text-center py-3">
                                        <img src="img.png" alt="imagen del documento" id="imgDJR" class="img-fluid changePicture img-thumbnail changePicture" style="width:250px">
                                    </figure>
                                </label>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>