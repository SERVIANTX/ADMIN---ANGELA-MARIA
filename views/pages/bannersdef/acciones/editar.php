<?php

	if(isset($routesArray[3])){

		$security = explode("~",base64_decode($routesArray[3]));

		if($security[1] == $_SESSION["admin"]->token_user){

			$select = "*";

			$url = "relations?rel=default_banners,products&type=dbanner,product&select=".$select."&linkTo=id_dbanner&equalTo=".$security[0];
			$method = "GET";
			$fields = array();

			$response = CurlController::request($url, $method, $fields);

			if($response->status == 200){

				$dbanner = $response->results[0];

			}else{

				echo '<script>

                        window.location = "/bannersdef";

                    </script>';
			}

		}else{

			echo '<script>

                    window.location = "/bannersdef";

				</script>';
		}


	}

?>

<div class="card">

    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $dbanner->id_dbanner?>" name="idBannerD">

        <div class="card-body">

            <?php

                require_once "controllers/banners.controller.php";

                $edit = new BannersController();
                $edit -> editdef($dbanner->id_dbanner);

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

                                <?php if ($value->id_product == $dbanner->id_product_dbanner): ?>

                                    <option value="<?php echo $dbanner->id_product_dbanner ?>" selected><?php echo $dbanner->name_product ?></option>

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
                    <label>Ejemplo de Banner por defecto del Producto</label>

                    <label class="d-flex justify-content-center">
                        <figure class="text-center py-3">
                            <img src="<?php echo TemplateController::srcImg() ?>views/img/banners/default/default/example-default-banner.jpg" class="img-fluid img-thumbnail">
                        </figure>
                    </label>

                </div>

                <!--==================================================
                    TODO: Banner por defecto del Producto
                ==================================================-->

                <div class="form-group mt-4">

                    <label>Banner por defecto del Producto<sup class="text-danger">*</sup></label>

                    <label class="d-flex justify-content-center" for="defaultBanner">
                        <img src="<?php echo TemplateController::srcImg() ?>views/img/banners/default/<?php echo $dbanner->picture_dbanner ?>" class="img-fluid img-thumbnail changePicture" style="width:570px">
                    </label>

                    <div class="custom-file">

                        <input type="file"
                        class="custom-file-input"
                        id="defaultBanner"
                        name="defaultBanner"
                        accept="image/*"
                        maxSize="2000000"
                        onchange="validateImageJS(event, 'changePicture')"
                        >

                        <div class="valid-feedback">Campo Valido.</div>
                        <div class="invalid-feedback">Por favor rellene este campo.</div>

                        <button for="defaultBanner" class="custom-file-label"><i class="bx bx-upload mr-2"></i>Subir</button>

                    </div>

                </div>

            </div>

        <div class="card-footer">

            <div class="calendar-container mb-30">

                <div class="calendar-header">
                <a href="/bannersdef" class="btn btn-light border text-left"><i class="fa fa-arrow-left mr-2"></i>Volver</a>

                    <button type="submit"><i class="fa fa-save mr-2"></i> Guardar</button>
                </div>

        </div>

    </form>

</div>