<?php

    class SubcategoriasController{

        /*===========================================================================================
            TODO: Creación categorias
        ===========================================================================================*/

        public function create(){

            if(isset($_POST["nombre-subcategory"])){

                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';

                /*=============================================
                    TODO: Validamos la sintaxis de los campos
                =============================================*/

                if( preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["nombre-subcategory"] ) ){

                    /*=============================================
                        TODO: Agrupamos la información
                    =============================================*/

                    $data = array(

                        "name_subcategory" => trim(TemplateController::capitalize($_POST["nombre-subcategory"])),
                        "url_subcategory" => trim($_POST["url-name_subcategory"]),
                        "id_category_subcategory" => trim($_POST["categoria"]),
                        "title_list_subcategory" => $_POST["titleList-subcategory"],
                        "status_subcategory" => 1,
                        "date_created_subcategory" => date("Y-m-d")

                    );

                    /*=============================================
                        TODO: Solicitud a la API
                    =============================================*/

                    $url = "subcategories?token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                    $method = "POST";
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
                                fncSweetAlert("success", "Sus registros fueron creados con éxito.", "/subcategorias");

                            </script>';

                    }else{

                        echo '<script>

                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncNotie(3, "Error al guardar la Subcategoria.");

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
            }

        }

        /*===========================================================================================
            TODO: Editar administradores
        ===========================================================================================*/

        public function edit($id){

            if(isset($_POST["idsubcategory"])){

                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';

                if($id == $_POST["idsubcategory"]){

                        /*================================================================
                            TODO: Validación de lado del servidor
                        ================================================================*/

                        /*=============================================
                            TODO: Validamos la sintaxis de los campos
                        =============================================*/

                        if( preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["nombre-subcategory"] )){
                        /*=============================================
                            TODO: Tomamos el nombre de la categoria
                        =============================================*/

                            /*=============================================
                                TODO: Agrupamos la información
                            =============================================*/

                            $data = "name_subcategory=".trim(TemplateController::capitalize($_POST["nombre-subcategory"]))."&url_subcategory=".trim($_POST["url-name_subcategory"])."&id_category_subcategory=".$_POST["categoria"]."&title_list_subcategory=".$_POST["titleList-subcategory"]."&date_updated_subcategory=".date("Y-m-d");

                            /*=============================================
                                TODO: Solicitud a la API
                            =============================================*/

                            $url = "subcategories?id=".$id."&nameId=id_subcategory&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
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
                                        fncSweetAlert("success", "Sus registros fueron actualizados con éxito.", "/subcategorias");

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
            }

        }

    }

?>