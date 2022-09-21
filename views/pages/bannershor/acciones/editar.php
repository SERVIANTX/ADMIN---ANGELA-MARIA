<?php

	if(isset($routesArray[3])){

		$security = explode("~",base64_decode($routesArray[3]));

		if($security[1] == $_SESSION["admin"]->token_user){

			$select = "*";

			$url = "relations?rel=horizontal_banners,products&type=hbanner,product&select=".$select."&linkTo=id_hbanner&equalTo=".$security[0];
			$method = "GET";
			$fields = array();

			$response = CurlController::request($url, $method, $fields);

			if($response->status == 200){

				$hbanner = $response->results[0];

			}else{

				echo '<script>

                    window.location = "/bannershor";

				</script>';
			}

		}else{

			echo '<script>

                    window.location = "/bannershor";

				</script>';
		}


	}

?>

<div class="card">

    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $hbanner->id_hbanner?>" name="idBanner">

        <div class="card-body">

            <?php

                require_once "controllers/banners.controller.php";

                $create = new BannersController();
                $create -> edithor($hbanner->id_hbanner);

            ?>

            <div class="col-md-12">

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

                            <?php foreach ($product as $key => $value): ?>

                                <?php if ($value->id_product == $hbanner->id_product_hbanner): ?>

                                    <option value="<?php echo $hbanner->id_product_hbanner ?>" selected><?php echo $hbanner->name_product ?></option>

                                <?php else: ?>

                                    <option value="<?php echo $value->id_product ?>"><?php echo $value->name_product ?></option>

                                <?php endif ?>

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
                    TODO: Partes del Banner
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
                            value="<?php echo json_decode($hbanner->data_hbanner, true)["H4 tag"] ?>"
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
                            value="<?php echo json_decode($hbanner->data_hbanner, true)["H3-1 tag"] ?>"
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
                            value="<?php echo json_decode($hbanner->data_hbanner, true)["H3-2 tag"] ?>"
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
                            value="<?php echo json_decode($hbanner->data_hbanner, true)["H3-3 tag"] ?>"
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
                            value="<?php echo json_decode($hbanner->data_hbanner, true)["H3-4s tag"] ?>"
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
                            value="<?php echo json_decode($hbanner->data_hbanner, true)["Button tag"] ?>"
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
                                    <img src="<?php echo TemplateController::srcImg() ?>views/img/banners/horizontal/<?php echo $hbanner->picture_hbanner ?>"" class="img-fluid img-thumbnail changeHSlider">
                                </label>

                                <div class="custom-file">

                                    <input type="file"
                                    class="custom-file-input"
                                    id="hSlider"
                                    name="hSlider"
                                    accept="image/*"
                                    maxSize="2000000"
                                    onchange="validateImageJS(event, 'changeHSlider')"
                                    >

                                    <div class="valid-feedback">Campo Valido.</div>
                                    <div class="invalid-feedback">Por favor rellene este campo.</div>

                                    <button for="hSlider" class="custom-file-label"><i class="bx bx-upload mr-2"></i>Subir</button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        <div class="card-footer">

            <div class="calendar-container mb-30">

                <div class="calendar-header">
                <a href="/bannerssup" class="btn btn-light border text-left"><i class="fa fa-arrow-left mr-2"></i>Volver</a>

                    <button type="submit"><i class="fa fa-save mr-2"></i> Guardar</button>
                </div>

        </div>

    </form>

</div>