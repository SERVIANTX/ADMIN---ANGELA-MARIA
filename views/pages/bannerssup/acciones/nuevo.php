<div class="card">

    <div class="card-header">

        <h3>Nuevo Banner Superior</h3>

        <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

            <div class="card-body">

                <div class="col-md-12">

                    <?php

                        require_once "controllers/banners.controller.php";

                        $create = new BannersController();
                        $create -> create();

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
                        <label>Ejemplo de Banner Superior del Producto</label>

                        <label class="d-flex justify-content-center">
                            <figure class="text-center py-3">
                                <img src="<?php echo TemplateController::srcImg() ?>views/img/banners/top/default/example-top-banner.png" class="img-fluid img-thumbnail changeImagen">
                            </figure>
                        </label>

                    </div>

                    <!--==================================================
                        TODO: Partes del Banner
                    ==================================================-->

                    <div class="form-group mt-4">
                        <div class="row mb-5">

                            <!--==================================================
                                TODO: H3 Tag
                            ==================================================-->

                            <div class="col-12 col-lg-6 input-group mx-0 pr-0 mb-3">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        H3 Tag:
                                    </span>
                                </div>

                                <input
                                type="text"
                                class="form-control"
                                placeholder="Ex: 20%"
                                name="topBannerH3Tag"
                                pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\'\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}"
                                maxlength="50"
                                onchange="validateJS(event,'regex')"
                                required
                                >

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                            <!--==================================================
                                TODO: P1 Tag
                            ==================================================-->

                            <div class="col-12 col-lg-6 input-group mx-0 mb-3">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        P1 Tag:
                                    </span>
                                </div>

                                <input type="text"
                                class="form-control"
                                placeholder="Ex: Disccount"
                                name="topBannerP1Tag"
                                pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\'\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}"
                                maxlength="50"
                                onchange="validateJS(event,'regex')"
                                required
                                >

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

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
                                placeholder="Ex: For Books Of March"
                                name="topBannerH4Tag"
                                pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\'\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}"
                                maxlength="50"
                                onchange="validateJS(event,'regex')"
                                required
                                >

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                            <!--==================================================
                                TODO: P2 Tag
                            ==================================================-->

                            <div class="col-12 col-lg-6 input-group mx-0 mb-3">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        P2 Tag:
                                    </span>
                                </div>

                                <input type="text"
                                class="form-control"
                                placeholder="Ex: Enter Promotion"
                                name="topBannerP2Tag"
                                pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\'\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}"
                                maxlength="50"
                                onchange="validateJS(event,'regex')"
                                required
                                >

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                            <!--==================================================
                                TODO: Span Tag
                            ==================================================-->

                            <div class="col-12 col-lg-6 input-group mx-0 pr-0 mb-3">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        Span Tag:
                                    </span>
                                </div>

                                <input
                                type="text"
                                class="form-control"
                                placeholder="Ex: Sale2019"
                                name="topBannerSpanTag"
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

                                <input
                                type="text"
                                class="form-control"
                                placeholder="Ex: Shop now"
                                name="topBannerButtonTag"
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

                                    <label class="pb-5" for="topBanner">
                                        <img src="<?php echo TemplateController::srcImg() ?>views/img/banners/top/default/default-top-banner.jpg" class="img-fluid img-thumbnail changeTopBanner" style="width:1920px">
                                    </label>

                                    <div class="custom-file">

                                        <input type="file"
                                        class="custom-file-input"
                                        id="topBanner"
                                        name="topBanner"
                                        accept="image/*"
                                        maxSize="2000000"
                                        onchange="validateImageJS(event, 'changeTopBanner')"
                                        required>

                                        <div class="valid-feedback">Campo Valido.</div>
                                        <div class="invalid-feedback">Por favor rellene este campo.</div>

                                        <button for="topBanner" class="custom-file-label"><i class="bx bx-upload mr-2"></i>Subir</button>

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
                    <a href="/bannerssup" class="btn btn-light border text-left"><i class="fa fa-arrow-left mr-2"></i>Volver</a>

                        <button type="submit"><i class="fa fa-save mr-2"></i> Guardar</button>
                    </div>

            </div>

        </form>

    </div>

</div>