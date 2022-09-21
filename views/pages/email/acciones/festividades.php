<?php $primerNombre = explode(" ",trim($_SESSION["admin"]->displayname_user)); ?>

<form method="post" class="needs-validation" novalidate>

    <div class="row">

        <input type="hidden" name="festividadesClientes">

        <div class="col-md-6">
            <div class="faq-search mb-20">
                <br>
                <br>
                <h2><?php echo $primerNombre[0]; ?>, a la derecha tiene una vista previa del correo que se va a enviar a los clientes.</h2>
                <br>
                <br>
                <h2> Para continar escoja la festividad y presione el botón enviar.</h2>
                <br>
                <br>
                <select name="name-celeb" class="form-control" required>
                    <option value="" selected>Seleccione</option>
                    <option value="1">San Valentín</option>
                    <option value="2">Dia de la madre</option>
                    <option value="3">Dia del padre</option>
                    <option value="4">Fiestas patrias</option>
                    <option value="5">Navidad</option>
                    <option value="6">Año nuevo</option>
                </select>
                <div class="valid-feedback">Campo Valido.</div>
                <div class="invalid-feedback">Por favor escoja una opción.</div>
                <br>
                <br>

                <?php

                    require_once "controllers/enviar.controller.php";

                    $reset = new EnviarController();
                    $reset -> mailFestividadesClientes();

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
                    <img src="views/assets/custom/img/festividadesC.png" >
                </figure>
            </label>
        </div>

    </div>

</form>