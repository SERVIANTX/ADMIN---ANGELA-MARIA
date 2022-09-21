<?php $primerNombre = explode(" ",trim($_SESSION["admin"]->displayname_user)); ?>

<form method="post">

    <div class="row">

        <input type="hidden" name="ofertaSubcategoriasClientes">

        <div class="col-md-6">
            <div class="faq-search mb-20">
                <br>
                <br>
                <h2><?php echo $primerNombre[0]; ?>, a la derecha tiene una vista previa del correo que se va a enviar a los clientes.</h2>
                <br>
                <br>
                <h2>Para continar presione el botón enviar.</h2>
                <br>
                <br>

                <?php

                    require_once "controllers/enviar.controller.php";

                    $reset = new EnviarController();
                    $reset -> mailSubcategoriasProductosClientes();

                ?>

                    <div class="calendar-container">
                        <div class="calendar-header">
                            <button type="submit" class="button-jr"><i class="bx bx-paper-plane mr-2"></i> Enviar</button>
                        </div>
                    </div>

            </div>

        </div>

        <div class="col-md-6">
            <br>
            <label class="d-flex justify-content-center">
                <figure class="frame text-center py-3">
                    <img src="views/assets/custom/img/subcategoriasC.png" >
                </figure>
            </label>
        </div>

    </div>

</form>