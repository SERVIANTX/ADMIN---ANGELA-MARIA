<?php

	if(isset($routesArray[3])){

		$security = explode("~",base64_decode($routesArray[3]));

		if($security[1] == $_SESSION["admin"]->token_user){

			$select = "*";

			$url = "relations?rel=vertical_banners,products&type=vbanner,product&select=".$select."&linkTo=id_vbanner&equalTo=".$security[0];
			$method = "GET";
			$fields = array();

			$response = CurlController::request($url, $method, $fields);

			if($response->status == 200){

				$vbanner = $response->results[0];

			}else{

				echo '<script>

                        window.location = "/bannersvert";

                    </script>';
			}

		}else{

			echo '<script>

                    window.location = "/bannersvert";

				</script>';
		}


	}

?>

<div class="card">

    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $vbanner->id_vbanner?>" name="idBannerV">

        <div class="card-body">

            <?php

                require_once "controllers/banners.controller.php";

                $edit = new BannersController();
                $edit -> editvert($vbanner->id_vbanner);

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

                                <?php if ($value->id_product == $vbanner->id_product_vbanner): ?>

                                    <option value="<?php echo $vbanner->id_product_vbanner ?>" selected><?php echo $vbanner->name_product ?></option>

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

                                    <img src="<?php echo TemplateController::srcImg() ?>views/img/banners/vertical/<?php echo $vbanner->picture_vbanner ?>" class="img-fluid img-thumbnail changeVSlider" style="height:629px">

                                </label>

                                <div class="custom-file">

                                    <input type="file"
                                    class="custom-file-input"
                                    id="vSlider"
                                    name="vSlider"
                                    accept="image/*"
                                    maxSize="2000000"
                                    onchange="validateImageJS(event, 'changeVSlider')"
                                    >

                                    <div class="valid-feedback">Campo Valido.</div>
                                    <div class="invalid-feedback">Por favor rellene este campo.</div>

                                    <button for="vSlider" class="custom-file-label"><i class="bx bx-upload mr-2"></i>Subir</button>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

        <div class="card-footer">

            <div class="calendar-container mb-30">

                <div class="calendar-header">
                <a href="/bannersvert" class="btn btn-light border text-left"><i class="fa fa-arrow-left mr-2"></i>Volver</a>

                    <button type="submit"><i class="fa fa-save mr-2"></i> Guardar</button>
                </div>

        </div>

    </form>

</div>