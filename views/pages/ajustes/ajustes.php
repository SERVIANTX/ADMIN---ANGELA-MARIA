<?php

    /*=============================================
        TODO: Dirección
    =============================================*/

    $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=direccion";
    $method = "GET";
    $fields = array();

    $response = CurlController::request($url, $method, $fields);

    if($response->status == 200){

        $direccion = $response->results[0];

    }else{

        echo '<script>

                window.location = "/";

            </script>';
    }

    /*=============================================
        TODO: Correo
    =============================================*/

    $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=email";
    $method = "GET";
    $fields = array();

    $response = CurlController::request($url, $method, $fields);

    if($response->status == 200){

        $email = $response->results[0];

    }else{

        echo '<script>

                window.location = "/";

            </script>';
    }

    /*=============================================
        TODO: Celular
    =============================================*/

    $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=celular";
    $method = "GET";
    $fields = array();

    $response = CurlController::request($url, $method, $fields);

    if($response->status == 200){

        $celular = $response->results[0];

    }else{

        echo '<script>

                window.location = "/";

            </script>';
    }

    /*=============================================
        TODO: facebook
    =============================================*/

    $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
    $method = "GET";
    $fields = array();

    $response = CurlController::request($url, $method, $fields);

    if($response->status == 200){

        $facebook = $response->results[0];

    }else{

        echo '<script>

                window.location = "/";

            </script>';
    }

    /*=============================================
        TODO: instagram
    =============================================*/

    $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
    $method = "GET";
    $fields = array();

    $response = CurlController::request($url, $method, $fields);

    if($response->status == 200){

        $instagram = $response->results[0];

    }else{

        echo '<script>

                window.location = "/";

            </script>';
    }

    /*=============================================
        TODO: whatsapp
    =============================================*/

    $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
    $method = "GET";
    $fields = array();

    $response = CurlController::request($url, $method, $fields);

    if($response->status == 200){

        $whatsapp = $response->results[0];

    }else{

        echo '<script>

                window.location = "/";

            </script>';
    }


?>


<section class="profile-area">

    <div class="profile-header mb-30">
        <div class="user-profile-images">
            <img src="views\assets\plugins\fiva\img\profile-banner3.png" class="cover-image" alt="image">
        </div>
    </div>

    <div class="card user-settings-box mb-30">
        <div class="card-body">
            <form>

                <!-- ==================================
                        TODO: Contacto
                =================================== -->

                <h3><i class='bx bx-building'></i> Contacto con la empresa</h3>

                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label>Dirección</label>
                            <input
                            type="text"
                            class="form-control"
                            id="direccion"
                            readonly
                            value="<?php echo $direccion->value_extrasetting ?>"
                            >
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>.</label>
                            <a class="btn btn-warning-jrfd padding-jrfd mr-1 editDireccion" idDireccion="<?php echo $direccion->id_extrasetting ?>" direccion="<?php echo $direccion->value_extrasetting ?>"><i class='bx bx-edit-alt'></i> Editar</a>
                            <a onclick="copyToClipDireccion()" class="btn btn-outline-info-jrfd padding-jrfd" data-clipboard-target="#defaultButtons"><i class='bx bx-copy'></i> Copiar</a>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label>Correo electrónico</label>
                            <input
                            type="text"
                            class="form-control"
                            readonly
                            id="correo"
                            value="<?php echo $email->value_extrasetting ?>"
                            >
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>.</label>
                            <a class="btn btn-warning-jrfd padding-jrfd mr-1 editEmail" idEmail="<?php echo $email->id_extrasetting ?>" email="<?php echo $email->value_extrasetting ?>"><i class='bx bx-edit-alt'></i> Editar</a>
                            <a onclick="copyToClipCorreo()" class="btn btn-outline-info-jrfd padding-jrfd" data-clipboard-target="#defaultButtons"><i class='bx bx-copy'></i> Copiar</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label>Celular</label>
                            <input
                            type="text"
                            readonly
                            class="form-control"
                            id="celular"
                            value="<?php echo $celular->value_extrasetting ?>"
                            >
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>.</label>
                            <a class="btn btn-warning-jrfd padding-jrfd mr-1 editCelular" idCelular="<?php echo $celular->id_extrasetting ?>" celular="<?php echo $celular->value_extrasetting ?>"><i class='bx bx-edit-alt'></i> Editar</a>
                            <a onclick="copyToClipCelular()" class="btn btn-outline-info-jrfd padding-jrfd" data-clipboard-target="#defaultButtons"><i class='bx bx-copy'></i> Copiar</a>
                        </div>
                    </div>
                </div>

                <!-- ==================================
                        TODO: Redes Sociales
                =================================== -->

                <h3><i class='bx bx-world'></i> Redes Sociales</h3>

                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label>Facebook</label>
                            <input
                            type="text"
                            readonly
                            class="form-control"
                            id="facebook"
                            readonly
                            value="<?php echo $facebook->value_extrasetting ?>"
                            >
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>.</label>
                            <a class="btn btn-warning-jrfd padding-jrfd mr-1 editFacebook" idFacebook="<?php echo $facebook->id_extrasetting ?>" facebook="<?php echo $facebook->value_extrasetting ?>"><i class='bx bx-edit-alt'></i> Editar</a>
                            <a onclick="copyToClipFacebook()" class="btn btn-outline-info-jrfd padding-jrfd" data-clipboard-target="#defaultButtons"><i class='bx bx-copy'></i> Copiar</a>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label>Instagram</label>
                            <input
                            type="text"
                            readonly
                            class="form-control"
                            id="instagram"
                            value="<?php echo $instagram->value_extrasetting ?>"
                            >
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>.</label>
                            <a class="btn btn-warning-jrfd padding-jrfd mr-1 editInstagram" idInstagram="<?php echo $instagram->id_extrasetting ?>" instagram="<?php echo $instagram->value_extrasetting ?>"><i class='bx bx-edit-alt'></i> Editar</a>
                            <a onclick="copyToClipInstagram()" class="btn btn-outline-info-jrfd padding-jrfd" data-clipboard-target="#defaultButtons"><i class='bx bx-copy'></i> Copiar</a>
                        </div>
                    </div>
                </div>

                <?php
                    $mensajeWhats = substr($whatsapp->value_extrasetting,53);
                    $nuevoMensajeWhats = str_replace("%20" , " ", $mensajeWhats);
                ?>

                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label>Whatsapp</label>
                            <input
                            type="text"
                            readonly
                            class="form-control"
                            id="whatsapp"
                            value="<?php echo $whatsapp->value_extrasetting ?>"
                            >
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label>.</label>
                            <a class="btn btn-warning-jrfd padding-jrfd mr-1 editWhatsapp" idWhatsapp="<?php echo $whatsapp->id_extrasetting ?>" whatsapp="<?php echo substr($whatsapp->value_extrasetting,38,9) ?>" mensajeWhatsapp="<?php echo $nuevoMensajeWhats ?>"><i class='bx bx-edit-alt'></i> Editar</a>
                            <a onclick="copyToClipWhatsapp()" class="btn btn-outline-info-jrfd padding-jrfd" data-clipboard-target="#defaultButtons"><i class='bx bx-copy'></i> Copiar</a>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>

</section>

<script src="views/assets/custom/template/template.js"></script>

<!--=====================================================================
    TODO: Ventana modal para actualizar la dirección
=====================================================================-->

<div class="modal fade" id="editDireccion" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form method="post" class="needs-validation" novalidate>

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar la Dirección</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" name="idDireccion">

                    <div class="form-group">

                        <div class="form-group__content">

                            <!--==================================================
                                TODO: Dirección
                            ==================================================-->

                            <div class="form-group">
                                <label>Dirección<sup class="text-danger">*</sup></label>

                                <input
                                type="text"
                                class="form-control"
                                pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                                onchange="validateJS(event,'regex')"
                                name="direccion"
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

                        require_once "controllers/ajustes.controller.php";

                        $assign = new AjustesController();
                        $assign -> editAddress();

                    ?>

                    <div><button type="button" class="btn btn-light border" data-dismiss="modal">Cancelar</button></div>
                    <div><button type="submit" class="btn btn-danger"><i class='fa fa-save mr-1'></i> Actualizar</button></div>

                </div>

            </form>

        </div>

    </div>

</div>

<!--=====================================================================
    TODO: Ventana modal para actualizar el Correo electrónico
=====================================================================-->

<div class="modal fade" id="editEmail" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form method="post" class="needs-validation" novalidate>

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar el Correo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" name="idEmail">

                    <div class="form-group">

                        <div class="form-group__content">

                            <!--==================================================
                                TODO: el Correo electrónico
                            ==================================================-->

                            <div class="form-group">
                                <label>Correo electrónico<sup class="text-danger">*</sup></label>

                                <input
                                type="email"
                                class="form-control"
                                pattern="[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}"
                                onchange="validateJS(event,'email')"
                                name="email"
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

                        require_once "controllers/ajustes.controller.php";

                        $assign = new AjustesController();
                        $assign -> editEmail();

                    ?>

                    <div><button type="button" class="btn btn-light border" data-dismiss="modal">Cancelar</button></div>
                    <div><button type="submit" class="btn btn-danger"><i class='fa fa-save mr-1'></i> Actualizar</button></div>

                </div>

            </form>

        </div>

    </div>

</div>

<!--=====================================================================
    TODO: Ventana modal para actualizar el Celular
=====================================================================-->

<div class="modal fade" id="editCelular" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form method="post" class="needs-validation" novalidate>

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar el n° de celular</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" name="idCelular">

                    <div class="form-group">

                        <div class="form-group__content">

                            <!--==================================================
                                TODO: Celular
                            ==================================================-->

                            <div class="form-group">
                                <label>N° de celular<sup class="text-danger">*</sup></label>

                                <input
                                type="text"
                                class="form-control"
                                pattern="[-\\(\\)\\0-9 ]{1,}"
                                onchange="validateJS(event,'phone')"
                                name="celular"
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

                        require_once "controllers/ajustes.controller.php";

                        $assign = new AjustesController();
                        $assign -> editPhone();

                    ?>

                    <div><button type="button" class="btn btn-light border" data-dismiss="modal">Cancelar</button></div>
                    <div><button type="submit" class="btn btn-danger"><i class='fa fa-save mr-1'></i> Actualizar</button></div>

                </div>

            </form>

        </div>

    </div>

</div>

<!--=====================================================================
    TODO: Ventana modal para actualizar Facebook
=====================================================================-->

<div class="modal fade" id="editFacebook" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form method="post" class="needs-validation" novalidate>

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar Página</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" name="idFacebook">

                    <div class="form-group">

                        <div class="form-group__content">

                            <!--==================================================
                                TODO: Facebook
                            ==================================================-->

                            <div class="form-group">
                                <label>Enlace de Facebook<sup class="text-danger">*</sup></label>

                                <input type="text"
                                class="form-control"
                                name="facebook"
                                pattern='[-\\/\\(\\)\\=\\/\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                                onchange="validateJS(event,'social')"
                                >

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer d-flex justify-content-between">

                    <?php

                        require_once "controllers/ajustes.controller.php";

                        $assign = new AjustesController();
                        $assign -> editFacebook();

                    ?>

                    <div><button type="button" class="btn btn-light border" data-dismiss="modal">Cancelar</button></div>
                    <div><button type="submit" class="btn btn-danger"><i class='fa fa-save mr-1'></i> Actualizar</button></div>

                </div>

            </form>

        </div>

    </div>

</div>

<!--=====================================================================
    TODO: Ventana modal para actualizar Instagram
=====================================================================-->

<div class="modal fade" id="editInstagram" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form method="post" class="needs-validation" novalidate>

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar Página</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" name="idInstagram">

                    <div class="form-group">

                        <div class="form-group__content">

                            <!--==================================================
                                TODO: Instagram
                            ==================================================-->

                            <div class="form-group">
                                <label>Enlace de Instagram<sup class="text-danger">*</sup></label>

                                <input type="text"
                                class="form-control"
                                name="instagram"
                                pattern='[-\\/\\(\\)\\=\\/\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                                onchange="validateJS(event,'social')"
                                >

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer d-flex justify-content-between">

                    <?php

                        require_once "controllers/ajustes.controller.php";

                        $assign = new AjustesController();
                        $assign -> editInstagram();

                    ?>

                    <div><button type="button" class="btn btn-light border" data-dismiss="modal">Cancelar</button></div>
                    <div><button type="submit" class="btn btn-danger"><i class='fa fa-save mr-1'></i> Actualizar</button></div>

                </div>

            </form>

        </div>

    </div>

</div>

<!--=====================================================================
    TODO: Ventana modal para actualizar Whatsapp
=====================================================================-->

<div class="modal fade" id="editWhatsapp" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form method="post" class="needs-validation" novalidate>

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar Página</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" name="idWhatsapp">

                    <div class="form-group">

                        <div class="form-group__content">

                            <!--==================================================
                                TODO: Whatsapp
                            ==================================================-->

                            <div class="form-group">
                                <label>Nro. de celular<sup class="text-danger">*</sup></label>

                                <input type="number"
                                class="form-control"
                                name="whatsapp"
                                pattern="[-\\(\\)\\0-9 ]{1,9}"
                                onchange="validateJS(event,'cel')"
                                required>

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                            <!--==================================================
                                TODO: Mensaje
                            ===================================================-->

                            <div class="form-group">
                                <label>Mensaje<sup class="text-danger">*</sup></label>

                                <input type="text"
                                class="form-control"
                                name="mensajeWhatsapp"
                                pattern='[-\\/\\(\\)\\=\\/\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                                onchange="validateJS(event,'social')"
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

                        require_once "controllers/ajustes.controller.php";

                        $assign = new AjustesController();
                        $assign -> editWhatsapp();

                    ?>

                    <div><button type="button" class="btn btn-light border" data-dismiss="modal">Cancelar</button></div>
                    <div><button type="submit" class="btn btn-danger"><i class='fa fa-save mr-1'></i> Actualizar</button></div>

                </div>

            </form>

        </div>

    </div>

</div>