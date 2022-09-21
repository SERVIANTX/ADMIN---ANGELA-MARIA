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

    <div class="card-body">
        <table id="TablaAdministradores" class="table table-bordered table-striped tablePoliticas">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipo</th>
                    <th>Fecha de Edición</th>
                    <th>Acciones</th>
                </tr>
            </thead>

        </table>
    </div>

</div>

<script src="views/assets/custom/datatable/datatable.js"></script>