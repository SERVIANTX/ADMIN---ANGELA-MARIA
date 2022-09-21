<?php

	if(isset($routesArray[3])){

		$security = explode("~",base64_decode($routesArray[3]));

		if($security[1] == $_SESSION["admin"]->token_user){

			$select = "*";

			$url = "relations?rel=top_banners,products&type=tbanner,product&select=".$select."&linkTo=id_tbanner&equalTo=".$security[0];
			$method = "GET";
			$fields = array();

			$response = CurlController::request($url, $method, $fields);

			if($response->status == 200){

				$tbanner = $response->results[0];

			}else{

				echo '<script>

				window.location = "/bannerssup";

				</script>';
			}

		}else{

			echo '<script>

				window.location = "/bannerssup";

				</script>';
		}


	}

?>

<div class="card">

    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $tbanner->id_tbanner?>" name="idBanner">

        <div class="card-body">

            <?php

                require_once "controllers/banners.controller.php";

                $create = new BannersController();
                $create -> edit($tbanner->id_tbanner);

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

                                <?php if ($value->id_product == $tbanner->id_product_tbanner): ?>

                                    <option value="<?php echo $tbanner->id_product_tbanner ?>" selected><?php echo $tbanner->name_product ?></option>

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
                            value="<?php echo json_decode($tbanner->data_tbanner, true)["H3 tag"] ?>"
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
                            value="<?php echo json_decode($tbanner->data_tbanner, true)["P1 tag"] ?>"
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
                            value="<?php echo json_decode($tbanner->data_tbanner, true)["H4 tag"] ?>"
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
                            value="<?php echo json_decode($tbanner->data_tbanner, true)["P2 tag"] ?>"
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
                            value="<?php echo json_decode($tbanner->data_tbanner, true)["Span tag"] ?>"
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
                            value="<?php echo json_decode($tbanner->data_tbanner, true)["Button tag"] ?>"
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
                                    <img src="<?php echo TemplateController::srcImg() ?>views/img/banners/top/<?php echo $tbanner->picture_tbanner ?>" class="img-fluid img-thumbnail changeTopBanner">
                                </label>

                                <div class="custom-file">

                                    <input type="file"
                                    class="custom-file-input"
                                    id="topBanner"
                                    name="topBanner"
                                    accept="image/*"
                                    maxSize="2000000"
                                    onchange="validateImageJS(event, 'changeTopBanner')"
                                    >

                                    <div class="valid-feedback">Campo Valido.</div>
                                    <div class="invalid-feedback">Por favor rellene este campo.</div>

                                    <button for="topBanner" class="custom-file-label"><i class="bx bx-upload mr-2"></i>Subir</button>

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