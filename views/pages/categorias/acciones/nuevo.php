<div class="card">

    <div class="card-header">

        <h3>Nueva Categoria</h3>

        <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

            <div class="card-body">

                <div class="col-md-12">

                    <?php

                        require_once "controllers/categorias.controller.php";

                        $create = new CategoriasController();
                        $create -> create();

                    ?>

                    <!--==================================================
                        TODO: Nombre de categoria
                    ==================================================-->

                    <div class="form-group mt-5">
                        <label>Nombre<sup class="text-danger">*</sup></label>
                        <input
                            type="text"
                            class="form-control"
                            pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}"
                            onchange="validateRepeat(event,'text','categories','name_category')"
                            name="nombre-category"
                            required>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                    <!--==================================================
                        TODO: URL de la categoria
                    ==================================================-->

                    <div class="form-group mt-4">
                        <label>URL<sup class="text-danger">*</sup></label>
                        <input
                            type="text"
                            class="form-control"
                            readonly
                            name="url-name_category"
                            required>

                    </div>

                    <!--==================================================
                        TODO: Descripción de la categoria
                    ==================================================-->

                    <div class="form-group mt-4">
                        <label>Descripción<sup class="text-danger">*</sup></label>
                        <textarea
                            class="summernote"
                            name="descriptioncategory"
                            required></textarea>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                    <!--==================================================
                        TODO: Listado de títulos de la categoria
                    ==================================================-->

                    <div class="form-group mt-4">
                        <label>Lista de Titulos<sup class="text-danger">*</sup></label>
                        <input
                            type="text"
                            class="form-control tags-input"
                            pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                            onchange="validateJS(event,'regex')"
                            name="tituloLista-category"
                            required>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                    <!--==================================================
                        TODO: Icono de categoria
                    ==================================================-->

                    <div class="form-group mt-4">
                        <label>Icono<sup class="text-danger">*</sup></a></label>

                        <div class="input-group mb-3">

                            <div class="input-group-append">
                                <button  id="icon_convert" class="btn btn-danger" data-icon="fas fa-tags" role="iconpicker"></button>
                            </div>

                            <input
                                type="text"
                                class="form-control"
                                pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                                onchange="validateJS(event,'icon')"
                                name="icono-category"
                                id="icono-category"
                                value="fas fa-tags"
                                required>

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                        </div>

                    </div>

                    <!--==================================================
                        TODO: Fotografia de la categoria
                    ==================================================-->

                    <div class="form-group mt-4">
                        <label>Imagen<sup class="text-danger">*</sup></label>

                        <label for="customFile" class="d-flex justify-content-center">
                            <figure class="text-center py-3">
                                <img src="<?php echo TemplateController::srcImg() ?>views/img/categories/default.jpg" class="img-fluid changePicture img-thumbnail changePicture" style="width:150px">
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
                    <a href="/categorias" class="btn btn-light border text-left"><i class="fa fa-arrow-left mr-2"></i>Volver</a>

                        <button type="submit"><i class="fa fa-save mr-2"></i> Guardar</button>
                    </div>

            </div>

        </form>

    </div>

</div>

