<?php

    /*=============================================
        TODO: INFORMACIÓN PERSONAL
    =============================================*/

    $url = "users?select=id_user,displayname_user,numdoc_user,email_user,phone_user,address_user,country_user,picture_user,city_user&linkTo=id_user&equalTo=".$_SESSION["admin"]->id_user;
    $method = "GET";
    $fields = array();

    $response = CurlController::request($url, $method, $fields);

    if($response->status == 200){

        $infoUser = $response->results[0];

    }else{

        echo '<script>

                window.location = "/";

            </script>';
    }


?>

<section class="profile-area">
    <div class="profile-header mb-30">
        <div class="user-profile-images">
            <img src="views\assets\plugins\fiva\img\profile-banner.jpg" class="cover-image" alt="image">

            <div class="profile-image">
                <img src="<?php echo TemplateController::returnImg($_SESSION["admin"]->id_user, $_SESSION["admin"]->picture_user, $_SESSION["admin"]->method_user) ?>" alt="image">

                <div class="upload-profile-photo">
                    <a class="editPictureUser" idPictureUser="<?php echo $infoUser->id_user ?>" pictureUser="<?php echo $infoUser->picture_user ?>" style="cursor:pointer;"><i class='bx bx-camera'></i> <span>Actualizar</span></a>
                </div>
            </div>

            <div class="user-profile-text">
                <h3><?php echo $_SESSION["admin"]->displayname_user ?></h3>
                <span class="d-block"><?php echo $_SESSION["admin"]->rol_user ?></span>
            </div>
        </div>

        <div class="user-profile-nav">
            <ul class="nav nav-tabs" role="tablist">

                <li class="nav-item"></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card user-settings-box mb-30">
                <div class="card-body">
                    <form>

                        <!-- ==================================
                                TODO: Información Personal
                        =================================== -->

                        <h3><i class='bx bx-user-circle'></i> Información Personal</h3>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        readonly
                                        value="<?php echo $infoUser->displayname_user ?>"
                                    >
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Número de Documento</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        readonly
                                        value="<?php echo $infoUser->numdoc_user ?>"
                                    >
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label>Correo Electrónico</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        readonly
                                        value="<?php echo $infoUser->email_user ?>"
                                    >
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    readonly
                                    value="<?php echo $infoUser->country_user." - ".$infoUser->city_user." - ".$infoUser->address_user ?>"
                                    >
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    readonly
                                    value="<?php echo $infoUser->phone_user ? explode("_",$infoUser->phone_user)[1] : null ?>"
                                    >
                                    <span class="form-text text-muted d-block">
                                        <small>Si desea cambiar el celular por favor haga <a class="btn btn-warning-jrfd d-inline-block editCelularUser" idCelularUser="<?php echo $infoUser->id_user ?>" celularUser="<?php echo $infoUser->phone_user ? explode("_",$infoUser->phone_user)[1] : null ?>" style="padding: unset !important; padding-right: 4px !important; padding-left: 4px !important; font-size: .8rem !important;">click</a> aqui.</small>
                                    </span>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label>Si desea cambiar su contraseña por favor haga <a class="btn btn-warning-jrfd d-inline-block editPasswordUser" idPasswordUser="<?php echo $infoUser->id_user ?>" style="padding: unset !important; padding-right: 4px !important; padding-left: 4px !important; font-size: .8rem !important;">click</a> aqui.</label>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<script src="./views/assets/custom/template/template.js"></script>

<!--=====================================================================
    TODO: Ventana modal para actualizar el password del Usuario
=====================================================================-->

<div class="modal fade" id="editPasswordUser" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form method="post" class="needs-validation" novalidate>

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar la contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" name="idPasswordUser">

                    <div class="form-group">

                        <div class="form-group__content">

                            <!--==================================================
                                TODO: Contraseña
                            ==================================================-->

                            <div class="form-group">
                                <label>Te recomendamos que, por tu seguridad, eligas una contraseña única que no uses en ningun otro sitio. Tu contraseña debe contener mínimo 6 caracteres y puede utilizar cualquier tipo de caracter.</label>
                            </div>
                            <label>Contraseña Actual<sup class="text-danger">*</sup></label>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="bx bx-shield"></i></span>
                                </div>
                                <input
                                type="password"
                                class="form-control"
                                pattern="[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{6,}"
                                onchange="validateJS(event,'newPass')"
                                name="pastPasswordUser"
                                required>

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>
                            </div>

                            <label>Contraseña Nueva<sup class="text-danger">*</sup></label>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="bx bx-key"></i></span>
                                </div>
                                <input
                                type="password"
                                class="form-control"
                                pattern="[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{6,}"
                                onchange="validateJS(event,'newPass')"
                                name="newPasswordUser"
                                id="newPasswordUser"
                                required>

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>
                            </div>

                            <label>Confirmar Contraseña Nueva<sup class="text-danger">*</sup></label>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="bx bx-key"></i></span>
                                </div>
                                <input
                                type="password"
                                class="form-control"
                                pattern="[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{6,}"
                                onchange="validateJS(event,'newPass')"
                                name="comfirmPasswordUser"
                                id="comfirmPasswordUser"
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
                        $assign -> changePassword();

                    ?>

                    <div><button type="button" class="btn btn-light border" data-dismiss="modal">Cancelar</button></div>
                    <div><button type="submit" class="btn btn-danger"><i class='fa fa-save mr-1'></i> Actualizar</button></div>

                </div>

            </form>

        </div>

    </div>

</div>

<!--=====================================================================
    TODO: Ventana modal para actualizar el Celular del Usuario
=====================================================================-->

<div class="modal fade" id="editCelularUser" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

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

                    <input type="hidden" name="idCelularUser">

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
                                name="celularUser"
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
                        $assign -> editPhoneUser();

                    ?>

                    <div><button type="button" class="btn btn-light border" data-dismiss="modal">Cancelar</button></div>
                    <div><button type="submit" class="btn btn-danger"><i class='fa fa-save mr-1'></i> Actualizar</button></div>

                </div>

            </form>

        </div>

    </div>

</div>

<!--=====================================================================
    TODO: Ventana modal para actualizar la foto del Usuario
=====================================================================-->

<div class="modal fade" id="editPictureUser" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form method="post" class="needs-validation" novalidate enctype="multipart/form-data"

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <input type="hidden" name="idPictureUser">

                    <div class="form-group mt-4">

                        <label for="customFile" class="d-flex justify-content-center">
                            <figure class="text-center py-3">
                                <img src="<?php echo TemplateController::srcImg() ?>views/img/users/default/default.png" class="img-fluid rounded-circle img-thumbnail changePicture" style="width:150px; height:150px">
                            </figure>
                        </label>

                        <div class="custom-file">
                            <input
                                type="file"
                                id="customFile"
                                class="custom-file-input"
                                accept="image/*"
                                onchange="validateImageJS(event,'changePicture')"
                                name="picture"
                                required>

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor suba la imagen.</div>

                            <button for="customFile" class="custom-file-label"><i class="bx bx-upload mr-2"></i>Subir</button>

                        </div>

                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer d-flex justify-content-between">

                    <?php

                        require_once "controllers/ajustes.controller.php";

                        $assign = new AjustesController();
                        $assign -> editPictureUser();

                    ?>

                    <div><button type="button" class="btn btn-light border" data-dismiss="modal">Cancelar</button></div>
                    <div><button type="submit" class="btn btn-danger"><i class='fa fa-save mr-1'></i> Actualizar</button></div>

                </div>

            </form>

        </div>

    </div>

</div>