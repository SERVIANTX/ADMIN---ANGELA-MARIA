<div class="card">

    <div class="card-header">

        <h3>Nuevo Producto</h3>

        <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

            <div class="card-body">

                <div class="col-md-12">

                    <?php

                        require_once "controllers/productos.controller.php";

                        $create = new ProductosController();
                        $create -> create();

                    ?>

                    <!--==================================================
                        TODO: Nombre del Producto
                    ===================================================-->

                    <div class="form-group mt-5">
                        <label>Nombre del Producto<sup class="text-danger">*</sup></label>

                        <input
                            type="text"
                            class="form-control"
                            pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}"
                            onchange="validateRepeat(event,'text&number','products','name_product')"
                            maxlength="100"
                            name="name-product"
                            required>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                    <!--==================================================
                        TODO: URL del Producto
                    ===================================================-->

                    <div class="form-group mt-4">

                        <label>Url del Producto<sup class="text-danger">*</sup></label>

                        <input
                        type="text"
                        class="form-control"
                        readonly
                        name="url-name_product"
                        required>

                    </div>

                    <!--==================================================
                        TODO: Categoria del Producto
                    ===================================================-->

                    <div class="form-group mt-4">

                        <label>Categoria<sup class="text-danger">*</sup></label>

                        <?php

                            $url = "categories?select=id_category,name_category,url_category";
                            $method = "GET";
                            $fields = array();

                            $categories = CurlController::request($url, $method, $fields)->results;

                        ?>

                        <div class="form-group">

                            <select
                                class="form-control select2"
                                name="name-category"
                                style="width:100%"
                                onchange="changeCategory(event, 'products')"
                                required>

                                <option value="">Seleccionar</option>

                                <?php foreach ($categories as $key => $value): ?>

                                    <option value="<?php echo $value->id_category ?>_<?php echo $value->url_category ?>"><?php echo $value->name_category ?></option>

                                <?php endforeach ?>

                            </select>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                        </div>

                    </div>

                    <!--==================================================
                        TODO: Subcategoría del Producto
                    ===================================================-->

                    <div class="form-group selectSubcategory" style="display:none">

                        <label>Subcategoría<sup class="text-danger">*</sup></label>

                        <div class="form-group__content">

                            <select class="form-control" name="name-subcategory" required>

                                <option value="">Seleccionar Subcategoría</option>

                            </select>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                        </div>

                    </div>

                    <!--==================================================
                        TODO: Marca del Producto
                    ==================================================-->

                    <div class="form-group mt-4">

                        <label>Marca<sup class="text-danger">*</sup></label>

                        <?php

                            $url = "brands?select=id_brand,name_brand";
                            $method = "GET";
                            $fields = array();

                            $brands = CurlController::request($url, $method, $fields)->results;

                        ?>

                        <div class="form-group">

                            <select
                                class="form-control select2"
                                name="name-brand"
                                style="width:100%"
                                required>

                                <option value="">Seleccionar</option>

                                <?php foreach ($brands as $key => $value): ?>

                                    <option value="<?php echo $value->id_brand ?>"><?php echo $value->name_brand ?></option>

                                <?php endforeach ?>

                            </select>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                        </div>

                    </div>

                    <!--==================================================
                        TODO: Precio, Stock y cntidad del Producto
                    ==================================================-->

                    <div class="form-group mt-4">
                        <div class="row mb-3">

                            <!--==================================================
                                TODO: Precio del Producto
                            ==================================================-->

                            <div class="form-group col-md-4">
                                <label>Precio del Producto<sup class="text-danger">*</sup></label>

                                <input type="number"
                                        class="form-control"
                                        name="precio-producto"
                                        min="0"
                                        step="any"
                                        pattern="[.\\,\\0-9]{1,}"
                                        onchange="validateJS(event, 'numbers')"
                                        required>

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                            <!--==================================================
                                TODO: Stock
                            ==================================================-->

                            <div class="form-group col-md-4">
                                <label>Stock<sup class="text-danger">*</sup></label>

                                <input type="number"
                                    class="form-control"
                                    name="stock-producto"
                                    min="0"
                                    step="any"
                                    pattern="[.\\,\\0-9]{1,}"
                                    onchange="validateJS(event, 'numbers')"
                                    required>

                                    <div class="valid-feedback">Campo Valido.</div>
                                    <div class="invalid-feedback">Por favor rellene este campo.</div>
                            </div>

                            <!--==================================================
                                TODO: Cantidad Maxima del Producto
                            ==================================================-->

                            <div class="form-group col-md-4">
                                <label>Cantidad Maxima<sup class="text-danger">*</sup></label>

                                <input type="number"
                                        class="form-control"
                                        name="cantidadmaxima"
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

                    <!--==================================================
                        TODO: Imagen del Producto
                    ==================================================-->

                    <div class="form-group mt-4">
                        <label>Imagen del Producto<sup class="text-danger">*</sup></label>

                        <label for="customFile" class="d-flex justify-content-center">
                            <figure class="text-center py-3">
                                <img src="<?php echo TemplateController::srcImg() ?>views/img/products/default/default.jpg" class="img-fluid img-thumbnail changeImagen" style="width:150px">
                            </figure>
                        </label>

                        <div class="custom-file">
                            <input
                                type="file"
                                id="customFile"
                                class="custom-file-input"
                                accept="image/*"
                                onchange="validateImageJS(event,'changeImagen')"
                                name="imagen-producto"
                                required>

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            <button for="customFile" class="custom-file-label"><i class="bx bx-upload mr-2"></i>Subir</button>
                        </div>

                    </div>

                    <!--==================================================
                        TODO: Galería del Producto
                    ==================================================-->

                    <div class="form-group mt-4">

                        <label>Galería del Producto: <sup class="text-danger">*</sup></label>

                        <div class="dropzone mb-3">

                            <div class="dz-message">

                                Suelta tus imágenes aquí, tamaño máximo 500px * 500px

                            </div>

                        </div>

                        <input type="hidden" name="galeria-producto">

                    </div>

                    <!--==================================================
                        TODO: Descripción del Producto
                    ==================================================-->

                    <div class="form-group mt-4">
                        <label>Descripción del Producto<sup class="text-danger">*</sup></label>

                        <textarea
                        class="summernote"
                        name="descripcion-producto"
                        required
                        ></textarea>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                    <!--==================================================
                        TODO: Resumén del producto
                    ==================================================-->

                    <div class="form-group mt-4">

						<label>Resumen del Producto<sup class="text-danger">*</sup></label>

						<input type="hidden" name="inputSummary" value="1">

						<div class="input-group mb-3 inputSummary">

							<div class="input-group-append">
								<span class="input-group-text">
									<button type="button" class="btn btn-danger btn-sm border-0" onclick="removeInput(0,'inputSummary')">&times;</button>
								</span>
							</div>

							<input
							class="form-control py-4"
							type="text"
							name="summary-product_0"
							pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
							onchange="validateJS(event,'regex')"
							required>

							<div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

						</div>

						<button type="button" class="btn btn-primary mb-2" onclick="addInput(this, 'inputSummary')">Adicionar Resumen</button>

					</div>

                    <!--==================================================
                        TODO: Detalles del Producto
                    ==================================================-->

                    <div class="form-group mt-4">

						<label>Detalles del Producto<sup class="text-danger">*</sup></label>

                        <div class="row mb-3">

                            <input type="hidden" name="inputDetails" value="1">

                            <div class="input-group mb-3 inputDetails">

                                <!--==================================================
                                    TODO: Entrada para el título del detalle
                                ==================================================-->

                                <div class="col-12 col-lg-6 input-group">

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <button type="button" class="btn btn-danger btn-sm border-0" onclick="removeInput(0,'inputDetails')">&times;</button>
                                        </span>
                                    </div>

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            Titulo:
                                        </span>
                                    </div>

                                    <input
                                    class="form-control py-4"
                                    type="text"
                                    name="details-title-product_0"
                                    pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                                    onchange="validateJS(event,'regex')"
                                    required>

                                    <div class="valid-feedback">Campo Valido.</div>
                                    <div class="invalid-feedback">Por favor rellene este campo.</div>

                                </div>

                                <!--==================================================
                                    TODO: Entrada para valores del detalle
                                ==================================================-->

                                <div class="col-12 col-lg-6 input-group">

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            Valor:
                                        </span>
                                    </div>

                                    <input
                                    class="form-control py-4"
                                    type="text"
                                    name="details-value-product_0"
                                    pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                                    onchange="validateJS(event,'regex')"
                                    required>

                                    <div class="valid-feedback">Campo Valido.</div>
                                    <div class="invalid-feedback">Por favor rellene este campo.</div>

                                </div>

                            </div>

                        </div>

						<button type="button" class="btn btn-primary mb-2" onclick="addInput(this, 'inputDetails')">Adicionar Detalle</button>

					</div>

                </div>

            </div>

            <div class="card-footer">

                <div class="calendar-container mb-10">

                    <div class="calendar-header">
                    <a href="/productos" class="btn btn-light border text-left"><i class="fa fa-arrow-left mr-2"></i>Volver</a>

                        <button type="submit" class="saveBtn"><i class="fa fa-save mr-2"></i> Guardar</button>
                    </div>

            </div>

        </form>

    </div>

</div>