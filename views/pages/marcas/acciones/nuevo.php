<div class="card">

    <div class="card-header">

        <h3>Nueva Marca</h3>

        <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

            <div class="card-body">

                <div class="col-md-12">

                    <?php

                        require_once "controllers/marcas.controller.php";

                        $create = new MarcasController();
                        $create -> create();

                    ?>

                    <!--==================================================
                        TODO: Nombre de la marca
                    ==================================================-->

                    <div class="form-group mt-5">
                        <label>Nombre<sup class="text-danger">*</sup></label>
                        <input
                            type="text"
                            class="form-control"
                            pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                            onchange="validateRepeat(event,'regex','brands','name_brand')"
                            name="namebrand"
                            required>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                    <!--==================================================
                        TODO: URL de la marca
                    ==================================================-->

                    <div class="form-group mt-4">
                        <label>URL<sup class="text-danger">*</sup></label>
                        <input
                            type="text"
                            class="form-control"
                            readonly
                            name="url-name_brand"
                            required>

                    </div>

                    <!--==================================================
                        TODO: Fotografia de la marca
                    ==================================================-->

                    <div class="form-group mt-4">
                        <label>Imagen<sup class="text-danger">*</sup></label>

                        <label for="customFile" class="d-flex justify-content-center">
                            <figure class="text-center py-3">
                                <img src="<?php echo TemplateController::srcImg() ?>views/img/brands/default.jpg" class="img-fluid changePicture rounded-circle img-thumbnail changePicture" style="width:150px">
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
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            <button for="customFile" class="custom-file-label"><i class="bx bx-upload mr-2"></i>Subir</button>
                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer">

                <div class="calendar-container mb-10">

                    <div class="calendar-header">
                    <a href="/marcas" class="btn btn-light border text-left"><i class="fa fa-arrow-left mr-2"></i>Volver</a>

                        <button type="submit"><i class="fa fa-save mr-2"></i> Guardar</button>
                    </div>

            </div>

        </form>

    </div>

</div>