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
        <table id="TablaAdministradores" class="table row-border table-striped tableSus">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Correo</th>
                    <th>Status</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>

        </table>
    </div>

</div>

<script src="views/assets/custom/datatable/datatable.js"></script>
