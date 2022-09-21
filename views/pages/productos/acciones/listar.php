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
                    <button type="button" onclick="nuevoProducto()"><i class="fa fa-plus mr-2"></i> Nuevo Producto</button>
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

        <table id="TablaAdministradores" class="table table-striped tableProductos">
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
                    <th>Fecha de Creación</th>
                </tr>
            </thead>

        </table>
    </div>

</div>

<script src="views/assets/custom/datatable/datatable.js"></script>

<!--=====================================================================
    TODO: Ventana modal para actualizar el precio del producto
=====================================================================-->

<div class="modal fade" id="editPrecio" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form method="post" class="needs-validation" novalidate>

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar el precio del producto</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" name="idProduct">
                    <input type="hidden" name="stockProduct">

                    <div class="form-group">

                        <div class="form-group__content">

                            <!--==================================================
                                TODO: Precio del Producto
                            ==================================================-->

                            <div class="form-group">
                                <label>Precio del Producto<sup class="text-danger">*</sup></label>

                                <input type="number"
                                    class="form-control"
                                    name="priceProduct"
                                    min="0"
                                    step="any"
                                    pattern="[.\\,\\0-9]{1,}"
                                    onchange="validateJS(event, 'numbers')"
                                    required>

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer d-flex justify-content-between">

                    <?php

                        require_once "controllers/productos.controller.php";

                        $assign = new ProductosController();
                        $assign -> editPrice();

                    ?>

                    <div><button type="button" class="btn btn-light border" data-dismiss="modal">Cancelar</button></div>
                    <div><button type="submit" class="btn btn-danger"><i class='bx bx-money mr-1'></i> Actualizar</button></div>

                </div>

            </form>

        </div>

    </div>

</div>


<!--=====================================================================
    TODO: Ventana modal para actualizar el stock del producto
=====================================================================-->

<div class="modal fade" id="editCantidad" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form method="post" class="needs-validation" novalidate>

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar el stock del producto</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" name="idProduct">
                    <input type="hidden" name="priceProduct">

                    <div class="form-group">

                        <div class="form-group__content">

                            <!--==================================================
                                TODO: Stock del Producto
                            ==================================================-->

                            <div class="form-group">
                                <label>Stock del Producto<sup class="text-danger">*</sup></label>

                                <input type="number"
                                    class="form-control"
                                    name="stockProduct"
                                    min="0"
                                    step="any"
                                    pattern="[.\\,\\0-9]{1,}"
                                    onchange="validateJS(event, 'numbers')"
                                    required>

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer d-flex justify-content-between">

                    <?php

                        require_once "controllers/productos.controller.php";

                        $assign = new ProductosController();
                        $assign -> editStock();

                    ?>

                    <div><button type="button" class="btn btn-light border" data-dismiss="modal">Cancelar</button></div>
                    <div><button type="submit" class="btn btn-danger"><i class='bx bx-layer-plus mr-1'></i> Actualizar</button></div>

                </div>

            </form>

        </div>

    </div>

</div>