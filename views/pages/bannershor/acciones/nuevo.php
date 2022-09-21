<div class="card">

    <div class="card-header">

        <h3>Nuevo Banner Horizontal</h3>

        <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

            <div class="card-body">

                <div class="col-md-12">

                    <?php

                        require_once "controllers/banners.controller.php";

                        $create = new BannersController();
                        $create -> createhor();

                    ?>

                    <!--==================================================
                        TODO: Nombre del Producto
                    ===================================================-->

                    <div class="form-group mt-4">

                        <label>Producto<sup class="text-danger">*</sup></label>

                        <?php

                            $url = "products?select=id_product,name_product";
                            $method = "GET";
                            $fields = array();

                            $product = CurlController::request($url, $method, $fields)->results;

                        ?>

                        <div class="form-group">

                            <select
                                class="form-control select2"
                                name="name-product"
                                style="width:100%"
                                required>

                                <option value="">Seleccionar</option>

                                <?php foreach ($product as $key => $value): ?>

                                    <option value="<?php echo $value->id_product ?>"><?php echo $value->name_product ?></option>

                                <?php endforeach ?>

                            </select>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                        </div>

                    </div>

                    <!--==================================================
                        TODO: Ejemplo del Banner
                    ==================================================-->

                    <div class="form-group mt-4">
                        <label>Ejemplo de Banner Horizontal del Producto</label>

                        <label class="d-flex justify-content-center">
                            <figure class="text-center py-3">
                                <img src="<?php echo TemplateController::srcImg() ?>views/img/banners/horizontal/default/example-horizontal-slider.png" class="img-fluid img-thumbnail changeImagen">
                            </figure>
                        </label>

                    </div>

                    <!--==================================================
                        TODO: Slider Horizontal del Producto
                    ==================================================-->

                    <div class="form-group mt-2">

                        <label>Slider Horizontal del Producto<sup class="text-danger">*</sup></label>

                        <div class="row mb-3">

                            <!--==================================================
                                TODO: H4 Tag
                            ==================================================-->

                            <div class="col-12 col-lg-6 input-group mx-0 pr-0 mb-3">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        H4 Tag:
                                    </span>
                                </div>

                                <input type="text"
                                class="form-control"
                                placeholder="Ex: Limit Edition"
                                name="hSliderH4Tag"
                                pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\'\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}"
                                maxlength="50"
                                onchange="validateJS(event,'regex')"
                                required
                                >

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                            <!--==================================================
                                TODO: H3-1 Tag
                            ==================================================-->

                            <div class="col-12 col-lg-6 input-group mx-0 mb-3">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        H3-1 Tag:
                                    </span>
                                </div>

                                <input type="text"
                                class="form-control"
                                placeholder="Ex: Happy Summer"
                                name="hSliderH3_1Tag"
                                pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\'\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}"
                                maxlength="50"
                                onchange="validateJS(event,'regex')"
                                required
                                >

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                            <!--==================================================
                                TODO: H3-2 Tag
                            ==================================================-->

                            <div class="col-12 col-lg-6 input-group mx-0 pr-0 mb-3">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        H3-2 Tag:
                                    </span>
                                </div>

                                <input type="text"
                                class="form-control"
                                placeholder="Ex: Combo Super Cool"
                                name="hSliderH3_2Tag"
                                pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\'\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}"
                                maxlength="50"
                                onchange="validateJS(event,'regex')"
                                required
                                >

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                            <!--==================================================
                                TODO: H3-3 Tag
                            ==================================================-->

                            <div class="col-12 col-lg-6 input-group mx-0 mb-3">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        H3-3 Tag:
                                    </span>
                                </div>

                                <input type="text"
                                class="form-control"
                                placeholder="Ex: Up to"
                                name="hSliderH3_3Tag"
                                pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\'\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}"
                                maxlength="50"
                                onchange="validateJS(event,'regex')"
                                required
                                >

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                            <!--==================================================
                                TODO: H3-4s Tag
                            ==================================================-->

                            <div class="col-12 col-lg-6 input-group mx-0 pr-0 mb-3">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        H3-4s Tag:
                                    </span>
                                </div>

                                <input type="text"
                                class="form-control"
                                placeholder="Ex: 40%"
                                name="hSliderH3_4sTag"
                                pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\'\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}"
                                maxlength="50"
                                onchange="validateJS(event,'regex')"
                                required
                                >

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                            <!--==================================================
                                TODO: Button Tag
                            ==================================================-->

                            <div class="col-12 col-lg-6 input-group mx-0 mb-3">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        Button Tag:
                                    </span>
                                </div>

                                <input type="text"
                                class="form-control"
                                placeholder="Ex: Shop now"
                                name="hSliderButtonTag"
                                pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\'\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}"
                                maxlength="50"
                                onchange="validateJS(event,'regex')"
                                required
                                >

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                            <!--==================================================
                                TODO: IMG Tag
                            ==================================================-->

                            <div class="col-12">

                                <label>Imagen:</label>

                                <div class="form-group__content">

                                    <label class="d-flex justify-content-center" for="hSlider">
                                    <img src="<?php echo TemplateController::srcImg() ?>views/img/banners/horizontal/default/default-horizontal-slider.jpg" class="img-fluid img-thumbnail changeHSlider">

                                    </label>

                                    <div class="custom-file">

                                        <input type="file"
                                        class="custom-file-input"
                                        id="hSlider"
                                        name="hSlider"
                                        accept="image/*"
                                        maxSize="2000000"
                                        onchange="validateImageJS(event, 'changeHSlider')"
                                        required>

                                        <div class="valid-feedback">Campo Valido.</div>
                                        <div class="invalid-feedback">Por favor rellene este campo.</div>

                                        <button for="hSlider" class="custom-file-label"><i class="bx bx-upload mr-2"></i>Subir</button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer">

                <div class="calendar-container mb-10">

                    <div class="calendar-header">
                    <a href="/bannershor" class="btn btn-light border text-left"><i class="fa fa-arrow-left mr-2"></i>Volver</a>

                        <button type="submit"><i class="fa fa-save mr-2"></i> Guardar</button>
                    </div>

            </div>

        </form>

    </div>

</div>