<?php $primerNombre = explode(" ",trim($_SESSION["admin"]->displayname_user)); ?>

<?php

	if(isset($routesArray[3])){

		$security = explode("~",base64_decode($routesArray[3]));

		if($security[1] == $_SESSION["admin"]->token_user){

			$select = "id_user,displayname_user,email_user";

			$url = "users?select=".$select."&linkTo=id_user&equalTo=".$security[0];
			$method = "GET";
			$fields = array();

			$response = CurlController::request($url, $method, $fields);

			if($response->status == 200){

				$admin = $response->results[0];

			}else{

				echo '<script>

				window.location = "/administradores";

				</script>';
			}

		}else{

			echo '<script>

				window.location = "/administradores";

				</script>';
		}

	}

?>

<form method="post">

    <div class="row">

        <input type="hidden" name="idUser" value="<?php echo $admin->id_user ?>">

        <div class="col-md-6">
            <div class="faq-search mb-20">
                <br>
                <br>
                <h2><?php echo $primerNombre[0]; ?>, a la derecha tiene una vista previa del correo que se va a enviar junto a la aplicación a <?php echo $admin->displayname_user ?>.</h2>
                <br>
                <br>
                <h2>Para continar presione el botón enviar.</h2>
                <br>
                <br>

                <?php

                    require_once "controllers/enviar.controller.php";

                    $reset = new EnviarController();
                    $reset -> mailEnviarApp();

                ?>

                    <div class="calendar-container">
                        <div class="calendar-header">
                            <button type="submit" class="button-jr"><i class="bx bx-paper-plane mr-2"></i> Enviar</button>
                        </div>
                    </div>

            </div>

        </div>

        <div class="col-md-6">
            <br>
            <label class="d-flex justify-content-center">
                <figure class="frame text-center py-3">
                    <img src="views/assets/custom/img/ofertasC.png" >
                </figure>
            </label>
        </div>

    </div>

</form>