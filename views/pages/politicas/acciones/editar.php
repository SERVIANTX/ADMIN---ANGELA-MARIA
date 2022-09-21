<?php

	if(isset($routesArray[3])){

		$security = explode("~",base64_decode($routesArray[3]));

		if($security[1] == $_SESSION["admin"]->token_user){

			$select = "id_pageview,type_pageview,text_pageview";

			$url = "pageviews?select=".$select."&linkTo=id_pageview&equalTo=".$security[0];
			$method = "GET";
			$fields = array();

			$response = CurlController::request($url, $method, $fields);

			if($response->status == 200){

				$pageview = $response->results[0];

			}else{

				echo '<script>

				window.location = "/politicas";

				</script>';
			}

		}else{

			echo '<script>

				window.location = "/politicas";

				</script>';
			}

		}

?>

<div class="card">

    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $pageview->id_pageview ?>" name="idPolicies">

        <div class="card-body">

            <?php

                require_once "controllers/policies.controller.php";

                $create = new PoliciesController();
                $create -> edit($pageview->id_pageview);

            ?>

            <div class="col-md-12">

                    <!--==================================================
                        TODO: Nombre de Política
                    ==================================================-->

                    <div class="form-group mt-2">
                        <label>Tipo de Politica</label>
                        <input
                            type="text"
                            class="form-control"
                            name="typepage"
                            value="<?php echo $pageview->type_pageview ?>"
                            readonly
                            required>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                    <!--==================================================
                        TODO: Descripción de la Politica
                    ===================================================-->

                    <div class="form-group mt-2">
                        <label>Descripción de la Politica<sup class="text-danger">*</sup></label>

                        <textarea
                        class="summernote"
                        name="descripcion-politica"
                        required
                        ><?php echo $pageview->text_pageview ?></textarea>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

            </div>

        </div>

        <div class="card-footer">

            <div class="calendar-container mb-30">

                <div class="calendar-header">
                <a href="/politicas" class="btn btn-light border text-left"><i class="fa fa-arrow-left mr-2"></i>Volver</a>

                    <button type="submit"><i class="fa fa-save mr-2"></i> Guardar</button>
                </div>

        </div>

    </form>

</div>