<div class="card">

    <div class="card-header">

        <h3>Nuevo Banner Vertical</h3>

        <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

            <div class="card-body">

                <div class="col-md-12">

                    <?php

                        require_once "controllers/banners.controller.php";

                        $create = new BannersController();
                        $create -> createver();

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
                        TODO: Ejemplo y Slider Vertical del Producto
                    ==================================================-->

                    <div class="form-group mt-4">
                        <div class="row mb-3">

                            <!--==================================================
                                TODO: Ejemplo del Banner
                            ==================================================-->

                            <div class="form-group mt-4 col-md-6">
                                <label>Ejemplo de Slider Vertical del Producto</label>

                                <label class="d-flex justify-content-center">
                                    <figure class="text-center py-3">
                                        <img src="<?php echo TemplateController::srcImg() ?>views/img/banners/vertical/default/example-vertical-slider.jpg" class="img-fluid img-thumbnail changeImagen">
                                    </figure>
                                </label>

                            </div>

                            <!--==================================================
                                TODO: Slider Vertical del Producto
                            ==================================================-->

                            <div class="form-group mt-4 col-md-6">

                                <label>Slider Vertical del Producto<sup class="text-danger">*</sup></label>

                                <div class="form-group__content">

                                    <label class="d-flex justify-content-center py-3" for="vSlider">

                                        <img src="<?php echo TemplateController::srcImg() ?>views/img/banners/vertical/default/default-vertical-slider.jpg" class="img-fluid img-thumbnail changeVSlider" style="height:629px">

                                    </label>

                                    <div class="custom-file">

                                        <input type="file"
                                        class="custom-file-input"
                                        id="vSlider"
                                        name="vSlider"
                                        accept="image/*"
                                        maxSize="2000000"
                                        onchange="validateImageJS(event, 'changeVSlider')"
                                        required>

                                        <div class="valid-feedback">Campo Valido.</div>
                                        <div class="invalid-feedback">Por favor rellene este campo.</div>

                                        <button for="vSlider" class="custom-file-label"><i class="bx bx-upload mr-2"></i>Subir</button>

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
                    <a href="/bannersvert" class="btn btn-light border text-left"><i class="fa fa-arrow-left mr-2"></i>Volver</a>

                        <button type="submit"><i class="fa fa-save mr-2"></i> Guardar</button>
                    </div>

            </div>

        </form>

    </div>

</div>