<?php

    class AjustesController{

        /*===========================================================================================
            TODO: Editar Dirección
        ===========================================================================================*/

        public function editAddress(){

            if(isset($_POST["idDireccion"])){

                $url = "extrasettings?id=".$_POST["idDireccion"]."&nameId=id_extrasetting&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                $method = "PUT";
                $fields = "value_extrasetting=".$_POST["direccion"];

                $editStock = CurlController::request($url, $method, $fields);

                if($editStock->status == 200){

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("success", "Sus registros fueron actualizados con éxito.", "/ajustes");

                        </script>';

                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Error al actualizar la dirección.");

                        </script>';
                }

            }

        }

        /*===========================================================================================
            TODO: Editar Correo electrónico
        ===========================================================================================*/

        public function editEmail(){

            if(isset($_POST["idEmail"])){

                $url = "extrasettings?id=".$_POST["idEmail"]."&nameId=id_extrasetting&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                $method = "PUT";
                $fields = "value_extrasetting=".$_POST["email"];

                $editStock = CurlController::request($url, $method, $fields);

                if($editStock->status == 200){

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("success", "Sus registros fueron actualizados con éxito.", "/ajustes");

                        </script>';

                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Error al actualizar el email.");

                        </script>';
                }

            }

        }

        /*===========================================================================================
            TODO: Editar Celular
        ===========================================================================================*/

        public function editPhone(){

            if(isset($_POST["idCelular"])){

                $url = "extrasettings?id=".$_POST["idCelular"]."&nameId=id_extrasetting&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                $method = "PUT";
                $fields = "value_extrasetting=".$_POST["celular"];

                $editStock = CurlController::request($url, $method, $fields);

                if($editStock->status == 200){

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("success", "Sus registros fueron actualizados con éxito.", "/ajustes");

                        </script>';

                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Error al actualizar el celular.");

                        </script>';
                }

            }

        }

        /*===========================================================================================
            TODO: Editar Facebook
        ===========================================================================================*/

        public function editFacebook(){

            if(isset($_POST["idFacebook"])){

                $url = "extrasettings?id=".$_POST["idFacebook"]."&nameId=id_extrasetting&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                $method = "PUT";
                $fields = "value_extrasetting=".$_POST["facebook"];

                $editStock = CurlController::request($url, $method, $fields);

                if($editStock->status == 200){

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("success", "Sus registros fueron actualizados con éxito.", "/ajustes");

                        </script>';

                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Error al actualizar facebook.");

                        </script>';
                }

            }

        }

        /*===========================================================================================
            TODO: Editar Instagram
        ===========================================================================================*/

        public function editInstagram(){

            if(isset($_POST["idInstagram"])){

                $url = "extrasettings?id=".$_POST["idInstagram"]."&nameId=id_extrasetting&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                $method = "PUT";
                $fields = "value_extrasetting=".$_POST["instagram"];

                $editStock = CurlController::request($url, $method, $fields);

                if($editStock->status == 200){

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("success", "Sus registros fueron actualizados con éxito.", "/ajustes");

                        </script>';

                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Error al actualizar instagram.");

                        </script>';
                }

            }

        }

        /*===========================================================================================
            TODO: Editar Whatsapp
        ===========================================================================================*/

        public function editWhatsapp(){

            if(isset($_POST["idWhatsapp"])){

                if( strlen($_POST["whatsapp"]) == 9){

                    if( preg_match('/^[-\\(\\)\\0-9 ]{1,9}$/', $_POST["whatsapp"] )){

                        $mensajeWhats = str_replace(" " , "%20", $_POST["mensajeWhatsapp"]);
                        $urlWhats = urlencode("https://api.whatsapp.com/send?phone=51".$_POST["whatsapp"]."&text=".$mensajeWhats);

                        $url = "extrasettings?id=".$_POST["idWhatsapp"]."&nameId=id_extrasetting&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                        $method = "PUT";
                        $fields = "value_extrasetting=".$urlWhats;

                        $editStock = CurlController::request($url, $method, $fields);

                        if($editStock->status == 200){

                            echo '<script>

                                    fncFormatInputs();
                                    fncSweetAlert("success", "Sus registros fueron actualizados con éxito.", "/ajustes");

                                </script>';

                        }else{

                            echo '<script>

                                    fncFormatInputs();
                                    matPreloader("off");
                                    fncSweetAlert("close", "", "");
                                    fncNotie(3, "Error al actualizar whatsapp.");

                                </script>';
                        }
                    }else{

                        echo '<script>

                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncNotie(3, "Error de sintaxis de campo");

                            </script>';

                    }

                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "El número debe contener nueve dígitos.");

                        </script>';

                }

            }

        }

        /*===========================================================================================
            TODO: Editar Celular de Usuario
        ===========================================================================================*/

        public function editPhoneUser(){

            if(isset($_POST["idCelularUser"])){

                $url = "users?id=".$_POST["idCelularUser"]."&nameId=id_user&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                $method = "PUT";
                $fields = "phone_user=".urlencode("+51_".$_POST["celularUser"]);

                $editStock = CurlController::request($url, $method, $fields);

                if($editStock->status == 200){

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("success", "Sus registros fueron actualizados con éxito.", "/perfil");

                        </script>';

                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Error al actualizar el celular.");

                        </script>';
                }

            }

        }

        /*===========================================================================================
            TODO: Editar la contraseña de Usuario
        ===========================================================================================*/

        public function changePassword(){

            if(isset($_POST["comfirmPasswordUser"])){

                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';

                if($_SESSION["admin"]->id_user == $_POST["idPasswordUser"]){

                    $select = "password_user";

                    $url = "users?select=".$select."&linkTo=id_user&equalTo=".$_SESSION["admin"]->id_user;
                    $method = "GET";
                    $fields = array();

                    $response = CurlController::request($url, $method, $fields);

                    if($response->status == 200){

                        $pastPasswordUser = crypt(trim($_POST["pastPasswordUser"]), '$2a$07$azybxcags23425sdg23sdfhsd$');

                        if($response->results[0]->password_user == $pastPasswordUser){

                            $password = crypt(trim($_POST["comfirmPasswordUser"]), '$2a$07$azybxcags23425sdg23sdfhsd$');

                            /*=============================================
                                TODO: Agrupamos la información
                            =============================================*/

                            $data = "password_user=".$password."&date_updated_user=".date("Y-m-d");

                            /*=============================================
                                TODO: Solicitud a la API
                            =============================================*/

                            $url = "users?id=".$_SESSION["admin"]->id_user."&nameId=id_user&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                            $method = "PUT";
                            $fields = $data;

                            $response = CurlController::request($url, $method, $fields);

                            /*=============================================
                                TODO: Respuesta de la API
                            =============================================*/

                            if($response->status == 200){

                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncSweetAlert("success", "Su contraseña fue actualizado con éxito.", "/perfil");

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
                                    fncSweetAlert("error", "Las contraseña que ingresastes no coincide con la contraseña actual. Por seguridad se va a cerrar la ventana modal.", "");

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

        /*===========================================================================================
            TODO: Editar Foto de Usuario
        ===========================================================================================*/

        public function editPictureUser(){

            if(isset($_POST["idPictureUser"])){

                $url = "users?select=picture_user&linkTo=id_user&equalTo=".$_POST["idPictureUser"];
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    if(isset($_FILES["picture"]["tmp_name"]) && !empty($_FILES["picture"]["tmp_name"])){

                        $fields = array(

                            "file"=>$_FILES["picture"]["tmp_name"],
                            "type"=>$_FILES["picture"]["type"],
                            "folder"=>"users/".$_POST["idPictureUser"],
                            "name"=>$_POST["idPictureUser"],
                            "width"=>300,
                            "height"=>300
                        );

                        $picture = CurlController::requestFile($fields);

                    }else{
                        $picture = $response->results[0]->picture_user;
                    }

                    $url = "users?id=".$_POST["idPictureUser"]."&nameId=id_user&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                    $method = "PUT";
                    $fields = "picture_user=".$picture;

                    $editPhoto = CurlController::request($url, $method, $fields);

                    if($editPhoto->status == 200){

                        echo '<script>

                                fncFormatInputs();
                                fncSweetAlert("success", "Sus registros fueron actualizados con éxito.", "/perfil");

                            </script>';

                    }else{

                        echo '<script>

                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncNotie(3, "Error al actualizar el celular.");

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