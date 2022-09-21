<?php

	if(isset($routesArray[3])){

		$security = explode("~",base64_decode($routesArray[3]));

		if($security[1] == $_SESSION["admin"]->token_user){

			$select = "id_brand,name_brand,url_brand,picture_brand";

			$url = "brands?select=".$select."&linkTo=id_brand&equalTo=".$security[0];
			$method = "GET";
			$fields = array();

			$response = CurlController::request($url, $method, $fields);

			if($response->status == 200){

				$marcas = $response->results[0];

			}else{

				echo '<script>

				window.location = "/marcas";

				</script>';
			}

		}else{

			echo '<script>

				window.location = "/marcas";

				</script>';
			}

		}

?>

<div class="card">

    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $marcas->id_brand ?>" name="idmarcas">

        <div class="card-body">

            <?php

                require_once "controllers/marcas.controller.php";

                $create = new MarcasController();
                $create -> edit($marcas->id_brand);

            ?>

            <div class="col-md-12">

                    <!--==================================================
                        TODO: Nombre de la marca
                    ==================================================-->

                    <div class="form-group mt-2">
                        <label>Nombre de la marca<sup class="text-danger">*</sup></label>
                        <input
                            type="text"
                            class="form-control"
                            pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}"
                            onchange="validateJS(event,'text')"
                            name="namebrand"
                            value="<?php echo $marcas->name_brand ?>"
                            required>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                    <!--==================================================
                        TODO: URL de la marca
                    ==================================================-->

                    <div class="form-group mt-4">
                        <label>URL<sup class="text-danger">*</sup></label>
                        <input
                            type="text"
                            class="form-control"
                            readonly
                            name="url-name_brand"
                            value="<?php echo $marcas->url_brand ?>"
                            required>

                    </div>

                    <!--==================================================
                        TODO: Fotografia de la marca
                    ==================================================-->

                    <div class="form-group mt-4">
                        <label>Imagen<sup class="text-danger">*</sup></label>

                        <label for="customFile" class="d-flex justify-content-center">
                            <figure class="text-center py-3">
                                <img src="<?php echo TemplateController::srcImg()."views/img/brands/".$marcas->picture_brand ?>" class="img-fluid changePicture rounded-circle img-thumbnail changePicture" style="width:150px">
                            </figure>
                        </label>

                        <div class="custom-file">
                            <input
                                type="file"
                                id="customFile"
                                class="custom-file-input"
                                accept="image/*"
                                onchange="validateImageJS(event,'changePicture')"
                                name="picture">

                                <div class="valid-feedback">Campo Valido.</div>
                                <div class="invalid-feedback">Por favor rellene este campo.</div>

                                <button for="customFile" class="custom-file-label"><i class="bx bx-upload mr-2"></i>Subir</button>
                        </div>

                    </div>

            </div>

        </div>

        <div class="card-footer">

            <div class="calendar-container mb-10">

                <div class="calendar-header">
                <a href="/marcas" class="btn btn-light border text-left"><i class="fa fa-arrow-left mr-2"></i>Volver</a>

                    <button type="submit"><i class="fa fa-save mr-2"></i> Guardar</button>
                </div>

        </div>

    </form>

</div>