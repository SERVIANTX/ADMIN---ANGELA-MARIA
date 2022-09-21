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
        <table id="TablaAdministradores" class="table table-striped tableAsignarOrden">
            <thead>
                <tr>
                <th>N° de la orden</th>
                <th>Fecha de la orden</th>
                <th>Cliente</th>
                <th>Estado del pedido</th>
                <th>Asignar repartidor</th>
                </tr>
            </thead>

        </table>
    </div>

</div>

<script src="views/assets/custom/datatable/datatable.js"></script>

<!--=====================================================================
    TODO: Ventana modal para Asignar Repartidor
=====================================================================-->

<div class="modal fade" id="infoAsignarRepartidor" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form method="post">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Asignar Repartidor</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <?php

                    $select = "id_user,displayname_user,rol_user,picture_user,method_user";

                    $url = "users?select=".$select."&linkTo=rol_user&equalTo=repart";
                    $method = "GET";
                    $fields = array();

                    $data = CurlController::request($url, $method, $fields)->results;

                ?>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" name="idOrden">

                    <div class="form-group">

                        <div class="form-group__content">

                                <div class="card user-friend-request-box mb-30">

                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">

                                        <?php foreach ($data as $key => $value_data) : ?>

                                            <li class="d-flex align-items-center">

                                                <div class="info ml-3 mr-4">
                                                    <input class="form-check-input mr-5" type="radio" name="idUser" id="idUser" value="<?php echo $value_data->id_user ?>" required>
                                                </div>

                                                <img src="<?php echo TemplateController::returnImg($value_data->id_user, $value_data->picture_user, $value_data->method_user) ?>" width="70" height="70" class="rounded-circle" alt="image">

                                                <div class="info ml-3">
                                                    <h6><a><?php echo $value_data->displayname_user ?></a></h6>
                                                    <span class="d-block"><a>Repartidor</a></span>
                                                </div>

                                            </li>

                                        <?php endforeach; ?>

                                        </ul>
                                    </div>
                                </div>

                        </div>

                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer d-flex justify-content-between">

                    <?php

                        require_once "controllers/admins.controller.php";

                        $assign = new AdminsController();
                        $assign -> assignDeliveryPerson();

                    ?>

                    <div><button type="button" class="btn btn-light border" data-dismiss="modal">Cancelar</button></div>
                    <div><button type="submit" class="btn btn-danger"><i class='fas fa-truck mr-1'></i> Asignar</button></div>

                </div>

            </form>

        </div>

    </div>

</div>