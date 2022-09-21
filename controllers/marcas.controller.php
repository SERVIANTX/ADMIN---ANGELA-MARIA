<?php

    class MarcasController{

        /*===========================================================================================
            TODO: Creación categorias
        ===========================================================================================*/

        public function create(){

            if(isset($_POST["namebrand"])){

                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';

                /*=============================================
                    TODO: Validamos la sintaxis de los campos
                =============================================*/

                if( preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["namebrand"] )){

                    /*=============================================
                        TODO: Agrupamos la información
                    =============================================*/

                    $data = array(

                        "name_brand" => trim(TemplateController::capitalize($_POST["namebrand"])),
                        "url_brand" => trim($_POST["url-name_brand"]),
                        "date_created_brand" => date("Y-m-d")
                    );

                    /*=============================================
                        TODO: Solicitud a la API
                    =============================================*/

                    $url = "brands?token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                    $method = "POST";
                    $fields = $data;

                    $response = CurlController::request($url, $method, $fields);

                    /*=============================================
                        TODO: Respuesta de la API
                    =============================================*/

                    if($response->status == 200){

                        /*=============================================
                            TODO: Tomamos el ID
                        =============================================*/

                        $id = $response->results->lastId;


                        /*=========================================================
                            TODO: Validamos y creamos la imagen en el servidor
                        =========================================================*/

                        if(isset($_FILES["picture"]["tmp_name"]) && !empty($_FILES["picture"]["tmp_name"])){

                            $fields = array(

                                "file"=>$_FILES["picture"]["tmp_name"],
                                "type"=>$_FILES["picture"]["type"],
                                "folder"=>"brands/",
                                "name"=>$id,
                                "width"=>300,
                                "height"=>300
                            );

                            $picture = CurlController::requestFile($fields);

                            /*=========================================================
                                TODO: Solicitud a la API
                            =========================================================*/

                            $url = "brands?id=".$id."&nameId=id_brand&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                            $method = "PUT";
                            $fields = 'picture_brand='.$picture;

                            $response = CurlController::request($url, $method, $fields);

                            if($response->status == 200){

                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncSweetAlert("success", "Sus registros fueron creados con éxito.", "/marcas");

                                    </script>';

                            }


                        }else{

                            echo '<script>

                                    fncFormatInputs();
                                    matPreloader("off");
                                    fncSweetAlert("close", "", "");
                                    fncNotie(3, "Error al guardar la imagen.");

                                </script>';

                        }

                    }
                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Field syntax error");

                        </script>';

                }
            }

        }

        /*===========================================================================================
            TODO: Editar administradores
        ===========================================================================================*/

        public function edit($id){

            if(isset($_POST["idmarcas"])){

                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';

                if($id == $_POST["idmarcas"]){

                    $select = "picture_brand";

                    $url = "brands?select=".$select."&linkTo=id_brand&equalTo=".$id;
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

                        if( preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["namebrand"] )){
                        /*=============================================
                            TODO: Tomamos el nombre de la marca
                        =============================================*/

                            $nombreimagen = $_POST["idmarcas"];

                            /*=============================================
                                TODO: Validar cambio imagen
                            =============================================*/

                            if(isset($_FILES["picture"]["tmp_name"]) && !empty($_FILES["picture"]["tmp_name"])){

                                $fields = array(

                                    "file"=>$_FILES["picture"]["tmp_name"],
                                    "type"=>$_FILES["picture"]["type"],
                                    "folder"=>"brands/",
                                    "name"=>$nombreimagen,
                                    "width"=>300,
                                    "height"=>300
                                );

                                    $picture = CurlController::requestFile($fields);

                            }else{

                                $picture = $response->results[0]->picture_brand;

                            }

                            /*=============================================
                                TODO: Agrupamos la información
                            =============================================*/

                            $data = "name_brand=".trim(TemplateController::capitalize($_POST["namebrand"]))."&url_brand=".trim($_POST["url-name_brand"])."&picture_brand=".$picture."&date_updated_brand=".date("Y-m-d");


                            /*=============================================
                                TODO: Solicitud a la API
                            =============================================*/

                            $url = "brands?id=".$id."&nameId=id_brand&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
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
                                        fncSweetAlert("success", "Sus registros fueron actualizados con éxito.", "/marcas");

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
                                    fncNotie(3, "Field syntax error");

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