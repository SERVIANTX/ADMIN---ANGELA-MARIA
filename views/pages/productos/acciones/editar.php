<?php

	if(isset($routesArray[3])){

		$security = explode("~",base64_decode($routesArray[3]));

		if($security[1] == $_SESSION["admin"]->token_user){

			$select = "*";

			$url = "relations?rel=products,categories,subcategories,brands&type=product,category,subcategory,brand&select=".$select."&linkTo=id_product&equalTo=".$security[0];
			$method = "GET";
			$fields = array();

			$response = CurlController::request($url, $method, $fields);

			if($response->status == 200){

				$product = $response->results[0];

			}else{

				echo '<script>

				window.location = "/productos";

				</script>';
			}

		}else{

			echo '<script>

				window.location = "/productos";

				</script>';
		}


	}

?>

<div class="card">

    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $product->id_product?>" name="idProduct">

        <div class="card-body">

            <?php

                require_once "controllers/productos.controller.php";

                $create = new ProductosController();
                $create -> edit($product->id_product);

            ?>

            <div class="col-md-12">

                    <!--==================================================
                        TODO: Nombre del Producto
                    ===================================================-->

                    <div class="form-group mt-2">
                        <label>Nombre del Producto<sup class="text-danger">*</sup></label>

                        <input
                            type="text"
                            class="form-control"
                            pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}"
                            onchange="validateJS(event,'text&number')"
                            maxlength="100"
                            name="name-product"
                            value="<?php echo $product->name_product ?>"
                            required>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                    <!--==================================================
                        TODO: URL del Producto
                    ===================================================-->

                    <div class="form-group mt-2">

                        <label>Url del Producto<sup class="text-danger">*</sup></label>

                        <input
                        type="text"
                        class="form-control"
                        readonly
                        name="url-name_product"
                        value="<?php echo $product->url_product ?>"
                        required>

                    </div>

                    <!--==================================================
                        TODO: Categoria del Producto
                    ===================================================-->

                    <div class="form-group mt-2">

                        <label>Categoria<sup class="text-danger">*</sup></label>

                        <input
                        type="text"
                        class="form-control"
                        value="<?php echo $product->name_category ?>"
                        readonly>

                        <input type="hidden"  name="name-category" value="<?php echo $product->id_category ?>_<?php echo $product->url_category ?>"  >

                    </div>

                    <!--==================================================
                        TODO: Subcategoría del Producto
                    ===================================================-->

                    <div class="form-group mt-2">

                        <label>Subcategoría<sup class="text-danger">*</sup></label>


                        <?php

                            $url = "subcategories?select=id_subcategory,name_subcategory,title_list_subcategory&linkTo=id_category_subcategory&equalTo=".$product->id_category;
                            $method = "GET";
                            $fields = array();

                            $subcategories = CurlController::request($url, $method, $fields)->results;

                        ?>

                        <div class="form-group__content">

                            <select
                            class="form-control"
                            name="name-subcategory"
                            required>

                                <?php foreach ($subcategories as $key => $value): ?>

                                    <?php if ($value->id_subcategory == $product->id_subcategory_product): ?>

                                        <option value="<?php echo $product->id_subcategory_product ?>_<?php echo $product->title_list_product ?>" selected><?php echo $product->name_subcategory ?></option>

                                    <?php else: ?>

                                        <option value="<?php echo $value->id_subcategory ?>_<?php echo $value->title_list_subcategory ?>"><?php echo $value->name_subcategory ?></option>

                                    <?php endif ?>

                                <?php endforeach ?>

                            </select>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                        </div>

                    </div>

                    <!--==================================================
                        TODO: Marca del Producto
                    ==================================================-->

                    <div class="form-group mt-2">

                        <label>Marca<sup class="text-danger">*</sup></label>

                        <?php

                            require_once "controllers/curl.controller.php";
                            $select = "id_brand,name_brand";
                            $url = "brands?select=".$select;
                            $method = "GET";
                            $fields = array();
                            $data = CurlController::request($url, $method, $fields)->results;
                            $brands = $data;

                        ?>


                        <select class="form-control select2" name="name-brand" required >
                            <option value>Seleccionar</option>

                                <?php foreach ($brands as $key => $value):
                                        $selected="";

                                        if($value->id_brand == $product->id_brand_product){
                                            $selected='selected="selected"';
                                        }
                                ?>
                                    <option value="<?php echo $value->id_brand ?>" <?php echo $selected ?> ><?php echo $value->name_brand ?></option>
                                <?php endforeach  ?>
                        </select>

                        <div class="valid-feedback">Campo Valido.</div>
                        <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                    <!--==================================================
                        TODO: Precio, Stock y cntidad del Producto
                    ==================================================-->

                    <div class="form-group mt-2">
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
                                    value="<?php echo $product->price_product ?>"
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
                                        value="<?php echo $product->stock_product ?>"
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
                                        value="<?php echo $product->maxquantitysale_product ?>"
                                        required>

                                    <div class="valid-feedback">Campo Valido.</div>
                                    <div class="invalid-feedback">Por favor rellene este campo.</div>
                            </div>

                        </div>
                    </div>

                    <!--==================================================
                        TODO: Imagen del Producto
                    ==================================================-->

                    <div class="form-group mt-2">
                        <label>Imagen del Producto<sup class="text-danger">*</sup></label>

                        <label for="customFile" class="d-flex justify-content-center">
                            <figure class="text-center py-3">
                                <img src="<?php echo TemplateController::srcImg() ?>views/img/products/<?php echo $product->url_category ?>/<?php echo $product->picture_product ?>" class="img-fluid img-thumbnail changeImagen" style="width:150px">
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
                                >

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            <button for="customFile" class="custom-file-label"><i class="bx bx-upload mr-2"></i>Subir</button>
                        </div>

                    </div>

                    <!--==================================================
                        TODO: Galería del Producto
                    ==================================================-->

                    <div class="form-group mt-2">

                        <label>Galería del Producto: <sup class="text-danger">*</sup></label>

                        <div class="dropzone mb-3">

                            <?php foreach (json_decode($product->gallery_product,true) as $value): ?>

                                <div class="dz-preview dz-file-preview">

                                    <div class="dz-image">

                                        <img class="img-fluid" src="<?php echo TemplateController::srcImg() ?>views/img/products/<?php echo $product->url_category ?>/gallery/<?php echo $value ?>">

                                    </div>

                                    <a class="dz-remove" data-dz-remove remove="<?php echo $value?>" onclick="removeGallery(this)">Remove file</a>

                                </div>

                            <?php endforeach ?>

                            <div class="dz-message">

                                Suelta tus imágenes aquí, tamaño máximo 500px * 500px

                            </div>

                        </div>

                        <input type="hidden" name="galeria-producto-old" value='<?php echo $product->gallery_product ?>'>

                        <input type="hidden" name="galeria-producto">

                        <input type="hidden" name="delete-galeria-producto">

                    </div>

                    <!--==================================================
                        TODO: Descripción del Producto
                    ===================================================-->

                    <div class="form-group mt-2">
                        <label>Descripción del Producto<sup class="text-danger">*</sup></label>

                        <textarea
                        class="summernote"
                        name="descripcion-producto"
                        required
                        ><?php echo $product->description_product ?></textarea>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                    <!--==================================================
                        TODO: Resumen del Producto
                    ==================================================-->

                    <div class="form-group mt-2">

						<label>Resumen del Producto<sup class="text-danger">*</sup> Ex: 20 hours of portable capabilities</label>

                        <?php foreach (json_decode($product->summary_product, true) as $key => $value): ?>

                            <input type="hidden" name="inputSummary" value="<?php echo $key+1 ?>">

                            <div class="input-group mb-3 inputSummary">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <button type="button" class="btn btn-danger btn-sm border-0" onclick="removeInput(<?php echo $key ?>,'inputSummary')">&times;</button>
                                    </span>
                                </div>

                                <input
                                class="form-control py-4"
                                type="text"
                                name="summary-product_<?php echo $key ?>"
                                pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                                onchange="validateJS(event,'regex')"
                                value="<?php echo $value ?>"
                                required>

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                        <?php endforeach ?>

						<button type="button" class="btn btn-primary mb-2" onclick="addInput(this, 'inputSummary')">Adicionar Resumen</button>

					</div>

                    <!--==================================================
                        TODO: Detalles del Producto
                    ==================================================-->

                    <div class="form-group mt-2">

                        <label>Detalles del Producto<sup class="text-danger">*</sup></label>

                        <?php foreach (json_decode($product->details_product, true) as $key => $value): ?>

                            <input type="hidden" name="inputDetails" value="<?php echo $key+1 ?>">

                            <div class="input-group mb-3 inputDetails">

                                <!--==================================================
                                    TODO: Entrada para el título del detalle
                                ==================================================-->

                                <div class="col-12 col-lg-6 input-group">

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <button type="button" class="btn btn-danger btn-sm border-0" onclick="removeInput(<?php echo $key ?>,'inputDetails')">&times;</button>
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
                                    name="details-title-product_<?php echo $key ?>"
                                    pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                                    onchange="validateJS(event,'regex')"
                                    value="<?php echo $value["title"] ?>"
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
                                    name="details-value-product_<?php echo $key ?>"
                                    pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                                    onchange="validateJS(event,'regex')"
                                    value="<?php echo $value["value"] ?>"
                                    required>

                                    <div class="valid-feedback">Campo Valido.</div>
                                    <div class="invalid-feedback">Por favor rellene este campo.</div>

                                </div>

                            </div>

                        <?php endforeach ?>

						<button type="button" class="btn btn-primary mb-2" onclick="addInput(this, 'inputDetails')">Adicionar Detalle</button>

					</div>

            </div>

        </div>

        <div class="card-footer">

            <div class="calendar-container mb-30">

                <div class="calendar-header">
                <a href="/productos" class="btn btn-light border text-left"><i class="fa fa-arrow-left mr-2"></i>Volver</a>

                    <button type="submit"><i class="fa fa-save mr-2"></i> Guardar</button>
                </div>

        </div>

    </form>

</div>