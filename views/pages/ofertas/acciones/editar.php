<?php

	if(isset($routesArray[3])){

		$security = explode("~",base64_decode($routesArray[3]));

		if($security[1] == $_SESSION["admin"]->token_user){

            $select = "id_product,name_product,productoffer_product,picture_product,url_category";

            $url = "relations?rel=products,categories&type=product,category&select=".$select."&linkTo=id_product&equalTo=".$security[0];

            $method = "GET";

			$fields = array();

			$response = CurlController::request($url, $method, $fields);

			if($response->status == 200){

				$product = $response->results[0];

			}else{

				echo '<script>

				window.location = "/ofertas";

				</script>';
			}

		}else{

			echo '<script>

				window.location = "/ofertas";

				</script>';
		}


	}

?>

<div class="card">

    <form method="post" class="needs-validation" novalidate>

        <input type="hidden" value="<?php echo $product->id_product?>" name="idProduct">

        <div class="card-body">

            <?php

                require_once "controllers/productos.controller.php";

                $approval = new ProductosController();
                $approval -> offer($product->id_product);

            ?>

            <div class="col-md-12">

                    <!--==================================================
                        TODO: Imagen del Producto
                    ==================================================-->

                    <div class="form-group mt-2">
                        <label>Imagen del Producto<sup class="text-danger">*</sup></label>

                        <label class="d-flex justify-content-center">
                            <figure class="text-center py-3">
                                <img src="<?php echo TemplateController::srcImg() ?>views/img/products/<?php echo $product->url_category ?>/<?php echo $product->picture_product ?>" class="img-fluid img-thumbnail changePicture" style="width:150px">
                            </figure>
                        </label>

                    </div>

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
                            readonly
                            required>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>


                    <!--==================================================
                        TODO: Oferta del Producto
                    ==================================================-->

                    <div class="form-group mt-2">

                        <label>Oferta del Producto<sup class="text-danger">*</sup></label>

                        <div class="row mb-3">

                            <!--==================================================
                                TODO: Tipo de Oferta
                            ===================================================-->

                            <div class="col-12 col-lg-4 form-group__content input-group mx-0 pr-0">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        Tipo:
                                    </span>
                                </div>

                                <select
                                class="form-control"
                                name="type_offer"
                                onchange="changeOffer(event)">

                                    <?php if ($product->productoffer_product != null): ?>

                                        <?php if (json_decode($product->productoffer_product, true)[0] == "Discount"): ?>

                                            <option value="Discount">Descuento</option>
                                            <option value="Fixed">Precio</option>

                                        <?php else: ?>

                                            <option value="Fixed">Precio</option>
                                            <option value="Discount">Descuento</option>

                                        <?php endif ?>

                                    <?php else: ?>

                                        <option value="Discount">Descuento</option>
                                        <option value="Fixed">Precio</option>

                                    <?php endif ?>

                                </select>

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                            <!--==================================================
                                TODO: El valor de la oferta
                            ===================================================-->

                            <div class="col-12 col-lg-4 input-group mx-0 pr-0">

                                <?php if ($product->productoffer_product != null): ?>

                                    <div class="input-group-append">

                                        <?php if (json_decode($product->productoffer_product, true)[0] == "Discount"): ?>

                                            <span
                                                class="input-group-text typeOffer">
                                                Porcentaje %:
                                            </span>

                                        <?php else: ?>

                                            <span
                                                class="input-group-text typeOffer">
                                                Precio S/.:
                                            </span>

                                        <?php endif ?>

                                    </div>

                                    <input type="number"
                                    class="form-control"
                                    name="value_offer"
                                    min="0"
                                    step="any"
                                    pattern="[.\\,\\0-9]{1,}"
                                    onchange="validateJS(event, 'numbers')"
                                    value="<?php echo json_decode($product->productoffer_product, true)[1] ?>"
                                    required>


                                <?php else: ?>

                                    <div class="input-group-append">

                                        <span
                                            class="input-group-text typeOffer">
                                            Porcentaje %:
                                        </span>

                                    </div>

                                    <input type="number"
                                    class="form-control"
                                    name="value_offer"
                                    min="0"
                                    step="any"
                                    pattern="[.\\,\\0-9]{1,}"
                                    onchange="validateJS(event, 'numbers')"
                                    required>

                                <?php endif ?>

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                            <!--==================================================
                                TODO: Fecha de vencimiento de la oferta
                            ===================================================-->

                            <div class="col-12 col-lg-4 input-group mx-0 pr-0">

                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        Fin de la oferta:
                                    </span>
                                </div>

                                <?php if ($product->productoffer_product != null): ?>

                                    <input type="date"
                                    class="form-control"
                                    name="date_offer"
                                    value="<?php echo json_decode($product->productoffer_product, true)[2] ?>"
                                    required>

                                <?php else: ?>

                                    <input type="date"
                                    class="form-control"
                                    name="date_offer"
                                    required>

                                <?php endif ?>

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                            </div>

                        </div>

                    </div>

            </div>

        </div>

        <div class="card-footer">

            <div class="calendar-container mb-30">

                <div class="calendar-header">
                <a href="/ofertas" class="btn btn-light border text-left"><i class="fa fa-arrow-left mr-2"></i>Volver</a>

                    <button type="submit"><i class="fa fa-save mr-2"></i> Guardar</button>
                </div>

        </div>

    </form>

</div>