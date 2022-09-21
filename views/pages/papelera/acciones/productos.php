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




    <div class="card-header mb-30">

        <div class="card-tools">

            <div class="faq-search mb-20">
                <h2>Hola, ¿Deseas activar algun producto?</h2>
            </div>

            <div class="calendar-container mb-30">

                <div class="calendar-header">
                    <button type="button" onclick="papelera()"><i class="fa fa-arrow-left mr-2"></i> Volver a la papelera</button>
                </div>

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

        <input type="hidden" id="idAdmin" value="<?php echo $_SESSION["admin"]->id_user ?>">

        <table id="TablaAdministradores" class="table table-bordered table-striped tableProductos">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Acciones</th>
                    <th>Estado</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Vistas</th>
                    <th>Fecha en que se desactivó</th>
                </tr>
            </thead>

        </table>
    </div>



<script src="views/assets/custom/datatable/datatable-papelera.js"></script>