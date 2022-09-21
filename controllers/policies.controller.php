<?php

    require_once "vendor/autoload.php";
    use Mailgun\Mailgun;

    class PoliciesController{

        /*=====================================================
			TODO: Editar
		======================================================*/

		public function edit($id){

            if(isset($_POST["idPolicies"])){

                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';


                if($id == $_POST["idPolicies"]){

                    $select = "id_pageview,type_pageview";

                    $url = "pageviews?select=".$select."&linkTo=id_pageview&equalTo=".$id;
                    $method = "GET";
                    $fields = array();

                    $response = CurlController::request($url, $method, $fields);

                    if($response->status == 200){

                        /*================================================================
                            TODO: Validación de lado del servidor
                        ================================================================*/

                        /*=============================================
                            TODO: Validamos la sintaxis de los campos
                        =============================================*/

                        if( preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["typepage"] )){

                            /*=============================================
                                TODO: Agrupamos la información
                            =============================================*/

                            $data = "type_pageview=".trim($_POST["typepage"])."&text_pageview=".urlencode(trim(TemplateController::htmlClean($_POST["descripcion-politica"])))."&date_updated_pageview=".date("Y-m-d");

                            /*=============================================
                                TODO: Solicitud a la API
                            =============================================*/

                            $url = "pageviews?id=".$id."&nameId=id_pageview&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                            $method = "PUT";
                            $fields = $data;

                            $response = CurlController::request($url, $method, $fields);

                            /*=============================================
                                TODO: Respuesta de la API
                            =============================================*/

                            if($response->status == 200){

                                switch($_POST["typepage"]){
                                    case "terminos-condiciones":
                                        $newPageview = "nuestros Terminos Y Condiciones";
                                        break;
                                    case "condiciones-de-promociones":
                                        $newPageview = "nuestras Condiciones De Promociones";
                                        break;
                                    case "politicas-de-privacidad":
                                        $newPageview = "nuestras Politicas De Privacidad";
                                        break;
                                }

                                /*=============================================
                                    TODO: facebook
                                =============================================*/

                                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                                $method = "GET";
                                $fields = array();
                                $response = CurlController::request($url, $method, $fields);
                                if($response->status == 200){ $UrlFacebook = $response->results[0];
                                }else{ $UrlFacebook = "https://www.facebook.com/"; }

                                /*=============================================
                                    TODO: instagram
                                =============================================*/

                                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                                $method = "GET";
                                $fields = array();
                                $response = CurlController::request($url, $method, $fields);
                                if($response->status == 200){ $UrlInstagram = $response->results[0];
                                }else{ $UrlInstagram = "https://www.instagram.com/"; }

                                /*=============================================
                                    TODO: whatsapp
                                =============================================*/

                                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                                $method = "GET";
                                $fields = array();
                                $response = CurlController::request($url, $method, $fields);
                                if($response->status == 200){ $UrlWhatsapp = $response->results[0];
                                }else{ $UrlWhatsapp = "https://web.whatsapp.com/"; }


                                /*===================================================================
                                    TODO: Preguntamos primero si el usuario está registrado
                                ====================================================================*/

                                $url = "customers?select=email_customer,displayname_customer&linkTo=status_customer&equalTo=1";
                                $method = "GET";
                                $fields = array();

                                $data = CurlController::request($url, $method, $fields)->results;


                                foreach($data as $key => $value_data){

                                    $emailUser = $value_data->email_customer;

                                        /*=============================================================
                                            TODO: Enviamos nueva contraseña al correo electrónico
                                        =============================================================*/

                                        $Mensaje = file_get_contents('views/mails/PrivacyPolicyEmail.html');

                                        /* Parametros del Template a Remplazar */
                                        $Mensaje = str_replace("amDisplayname", $value_data->displayname_customer, $Mensaje);
                                        $Mensaje = str_replace("amUrl", TemplateController::pathEcommerce(), $Mensaje);
                                        $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                                        $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                                        $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);
                                        $Mensaje = str_replace("amBoton", $newPageview, $Mensaje);
                                        $Mensaje = str_replace("amLeer", TemplateController::pathEcommerce().$_POST["typepage"], $Mensaje);

                                        $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                                        $domain = "angelamaria.social";
                                        $params = array(
                                            'from'    => 'Angela Maria Minimarket <info@angelamaria.social>',
                                            'to'      => $emailUser,
                                            'subject' => 'Actualización de '.$newPageview,
                                            'html'    => $Mensaje
                                            );
                                        # Make the call to the client.
                                        $response = $mgClient->messages()->send($domain, $params);
                                }


                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncSweetAlert("success", "Sus registros fueron actualizados y los clientes fueron notificados con éxito.", "/politicas");

                                    </script>';

                            }else{

                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncNotie(3, "Error al editar el registro.");

                                    </script>';

                            }

                        }else{

                            echo '<script>

                                    fncFormatInputs();
                                    matPreloader("off");
                                    fncSweetAlert("close", "", "");
                                    fncNotie(3, "Error de sintaxis del campo.");

                                </script>';

                        }

                    }else{

                        echo '<script>

                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncNotie(3, "Error al editar el registro.");

                            </script>';
                    }
                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Error al editar el registro.");

                        </script>';
                }

            }
        }

    }

?>