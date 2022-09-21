<?php

    class BannersController{

        /*===========================================================================================
            TODO: Creación de Banners Superiores
        ===========================================================================================*/

        public function create(){

            if(isset($_POST["topBannerH3Tag"])){


                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';

                /*================================================================
                    TODO: Validación de lado del servidor
                ================================================================*/

                /*=============================================
                    TODO: Validamos la sintaxis de los campos
                =============================================*/

                if( isset($_POST['topBannerH3Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerH3Tag']) &&
                    isset($_POST['topBannerP1Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerP1Tag']) &&
                    isset($_POST['topBannerH4Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerH4Tag']) &&
                    isset($_POST['topBannerP2Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerP2Tag']) &&
                    isset($_POST['topBannerSpanTag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerSpanTag']) &&
                    isset($_POST['topBannerButtonTag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerButtonTag'])
                ){

                    $topBanner = (object)[

                        "H3 tag"=>TemplateController::capitalize($_POST['topBannerH3Tag']),
                        "P1 tag"=>TemplateController::capitalize($_POST['topBannerP1Tag']),
                        "H4 tag"=>TemplateController::capitalize($_POST['topBannerH4Tag']),
                        "P2 tag"=>TemplateController::capitalize($_POST['topBannerP2Tag']),
                        "Span tag"=>TemplateController::capitalize($_POST['topBannerSpanTag']),
                        "Button tag"=>TemplateController::capitalize($_POST['topBannerButtonTag'])

                    ];

                    /*=============================================
                        TODO: Agrupamos la información
                    =============================================*/

                    $data = array(

                        "id_product_tbanner" => $_POST["name-product"],
                        "data_tbanner" => json_encode($topBanner),
                        "status_tbanner" => 1,
                        "date_created_tbanner" => date("Y-m-d")

                    );

                    /*=============================================
                        TODO: Solicitud a la API
                    =============================================*/

                    $url = "top_banners?token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
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

                        if(isset($_FILES['topBanner']["tmp_name"]) && !empty($_FILES['topBanner']["tmp_name"])){

                            $fields = array(

                                "file"=>$_FILES['topBanner']["tmp_name"],
                                "type"=>$_FILES['topBanner']["type"],
                                "folder"=>"banners/top",
                                "name"=>$id,
                                "width"=>1920,
                                "height"=>80
                            );

                            $saveImageTopBanner = CurlController::requestFile($fields);

                            /*=========================================================
                                TODO: Solicitud a la API
                            =========================================================*/

                            $url = "top_banners?id=".$id."&nameId=id_tbanner&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                            $method = "PUT";
                            $fields = 'picture_tbanner='.$saveImageTopBanner;

                            $response = CurlController::request($url, $method, $fields);

                            if($response->status == 200){

                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncSweetAlert("success", "Sus registros fueron creados con éxito.", "/bannerssup");

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

                            fncNotie(3, "Error en la sintaxis de los campos de Top Banner.");

                        </script>';

                    return;

                }

            }

        }

        /*===========================================================================================
            TODO: Edición de Banners Superiores
        ===========================================================================================*/

        public function edit($id){

            if(isset($_POST["idBanner"])){


                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';


                if($id == $_POST["idBanner"]){

                    $select = "*";

                    $url = "top_banners?select=".$select."&linkTo=id_tbanner&equalTo=".$id."&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                    $method = "GET";
                    $fields = array();

                    $response = CurlController::request($url, $method, $fields);

                    if($response->status == 200){

                        $picture = $response->results[0]->picture_tbanner;

                        /*=======================================================
                            TODO: Agrupar información para Top Banner
                        =======================================================*/

                        if(isset($_FILES['topBanner']["tmp_name"]) && !empty($_FILES['topBanner']["tmp_name"])){

                            $fields = array(

                                "file"=>$_FILES['topBanner']["tmp_name"],
                                "type"=>$_FILES['topBanner']["type"],
                                "folder"=>"banners/top",
                                "name"=>$_POST["idBanner"],
                                "width"=>1920,
                                "height"=>80
                            );

                            $saveImageTopBanner = CurlController::requestFile($fields);

                        }else{

                            $saveImageTopBanner = $picture;

                        }

                        if($saveImageTopBanner != "error"){

                            /*================================================================
                                TODO: Validación de lado del servidor
                            ================================================================*/

                            /*=============================================
                                TODO: Validamos la sintaxis de los campos
                            =============================================*/

                            if( isset($_POST['topBannerH3Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerH3Tag']) &&
                                isset($_POST['topBannerP1Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerP1Tag']) &&
                                isset($_POST['topBannerH4Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerH4Tag']) &&
                                isset($_POST['topBannerP2Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerP2Tag']) &&
                                isset($_POST['topBannerSpanTag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerSpanTag']) &&
                                isset($_POST['topBannerButtonTag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['topBannerButtonTag'])
                                ){

                                $topBanner = (object)[

                                    "H3 tag"=>TemplateController::capitalize($_POST['topBannerH3Tag']),
                                    "P1 tag"=>TemplateController::capitalize($_POST['topBannerP1Tag']),
                                    "H4 tag"=>TemplateController::capitalize($_POST['topBannerH4Tag']),
                                    "P2 tag"=>TemplateController::capitalize($_POST['topBannerP2Tag']),
                                    "Span tag"=>TemplateController::capitalize($_POST['topBannerSpanTag']),
                                    "Button tag"=>TemplateController::capitalize($_POST['topBannerButtonTag'])

                                ];

                            }else{

                                echo '<script>

                                    fncFormatInputs();

                                    fncNotie(3, "Error en la sintaxis de los campos de Top Banner");

                                </script>';

                                return;

                            }

                        }

                        /*=======================================================
                            TODO: Agrupar la información
                        =======================================================*/

                        $data = "id_product_tbanner=".$_POST["name-product"]."&picture_tbanner=".$saveImageTopBanner."&data_tbanner=".json_encode($topBanner)."&date_updated_tbanner=".date("Y-m-d");

                        /*=======================================================
                            TODO: Solicitud a la API
                        =======================================================*/

                        $url = "top_banners?id=".$id."&nameId=id_tbanner&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                        $method = "PUT";
                        $fields = $data;

                        $response = CurlController::request($url,$method,$fields);

                        /*=======================================================
                            TODO: Respuesta de la API
                        =======================================================*/

                        if($response->status == 200){

                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncSweetAlert("success", "Sus registros fueron editados con éxito.", "/bannerssup");

                                    </script>';


                        }else{

                            echo '<script>

                                    //fncFormatInputs();
                                    matPreloader("off");
                                    fncSweetAlert("close", "", "");
                                    fncNotie(3, "Error al guardar el banner.");

                                </script>';

                        }

                    }else{

                        echo '<script>

                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncNotie(3, "Error al editar el registro");

                            </script>';

                    }

                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Error al editar el registro");

                        </script>';

                }

            }

        }

        /*===========================================================================================
            TODO: Creación de Banners por Defecto
        ===========================================================================================*/

        public function createdef(){

            if(isset($_POST["name-product"])){


                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';

                    /*=============================================
                        TODO: Agrupamos la información
                    =============================================*/

                    $data = array(

                        "id_product_dbanner" => $_POST["name-product"],
                        "status_dbanner" => 1,
                        "date_created_dbanner" => date("Y-m-d")

                    );

                    /*=============================================
                        TODO: Solicitud a la API
                    =============================================*/

                    $url = "default_banners?token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
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

                        if(isset($_FILES['defaultBanner']["tmp_name"]) && !empty($_FILES['defaultBanner']["tmp_name"])){

                            $fields = array(

                                "file"=>$_FILES['defaultBanner']["tmp_name"],
                                "type"=>$_FILES['defaultBanner']["type"],
                                "folder"=>"banners/default",
                                "name"=>$id,
                                "width"=>570,
                                "height"=>210
                            );

                            $saveImageDefaultBanner = CurlController::requestFile($fields);

                            /*=========================================================
                                TODO: Solicitud a la API
                            =========================================================*/

                            $url = "default_banners?id=".$id."&nameId=id_dbanner&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                            $method = "PUT";
                            $fields = 'picture_dbanner='.$saveImageDefaultBanner;

                            $response = CurlController::request($url, $method, $fields);

                            if($response->status == 200){

                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncSweetAlert("success", "Sus registros fueron creados con éxito.", "/bannersdef");

                                    </script>';

                            }else{

                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncNotie(3, "Error al guardar la imagen.");

                                    </script>';

                            }

                        }else{

                            echo '<script>

                                    fncFormatInputs();
                                    matPreloader("off");
                                    fncSweetAlert("close", "", "");
                                    fncNotie(3, "Error al guardar el banner.");

                                </script>';

                        }

                    }

            }

        }

        /*===========================================================================================
            TODO: Edición de Banners por Defecto
        ===========================================================================================*/

        public function editdef($id){

            if(isset($_POST["idBannerD"])){


                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';


                if($id == $_POST["idBannerD"]){

                    $select = "*";

                    $url = "default_banners?select=".$select."&linkTo=id_dbanner&equalTo=".$id."&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                    $method = "GET";
                    $fields = array();

                    $response = CurlController::request($url, $method, $fields);

                    if($response->status == 200){

                        $picture = $response->results[0]->picture_dbanner;

                        /*=======================================================
                            TODO: Agrupar información para Top Banner
                        =======================================================*/

                        if(isset($_FILES['defaultBanner']["tmp_name"]) && !empty($_FILES['defaultBanner']["tmp_name"])){

                            $fields = array(

                                "file"=>$_FILES['defaultBanner']["tmp_name"],
                                "type"=>$_FILES['defaultBanner']["type"],
                                "folder"=>"banners/default",
                                "name"=>$_POST["idBannerD"],
                                "width"=>570,
                                "height"=>210
                            );

                            $saveImageDefaultBanner = CurlController::requestFile($fields);

                        }else{

                            $saveImageDefaultBanner = $picture;

                        }

                        /*=======================================================
                            TODO: Agrupar la información
                        =======================================================*/

                        /* $data = "id_product_dbanner=".$_POST["name-product"]."&picture_dbanner=".$saveImageDefaultBanner."&date_updated_dbanner=".date("Y-m-d"); */
                        $data = "id_product_dbanner=".$_POST["name-product"]."&picture_dbanner=".$saveImageDefaultBanner."&date_updated_dbanner=".date("Y-m-d");

                        /*=======================================================
                            TODO: Solicitud a la API
                        =======================================================*/

                        $url = "default_banners?id=".$id."&nameId=id_dbanner&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                        $method = "PUT";
                        $fields = $data;

                        $response = CurlController::request($url,$method,$fields);

                        /*=======================================================
                            TODO: Respuesta de la API
                        =======================================================*/

                        if($response->status == 200){

                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncSweetAlert("success", "Sus registros fueron editados con éxito.", "/bannersdef");

                                    </script>';


                        }else{

                            echo '<script>

                                    //fncFormatInputs();
                                    matPreloader("off");
                                    fncSweetAlert("close", "", "");
                                    fncNotie(3, "Error al guardar el banner.");

                                </script>';

                        }

                    }else{

                        echo '<script>

                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncNotie(3, "Error al editar el registro");

                            </script>';

                    }

                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Error al editar el registro");

                        </script>';

                }

            }

        }

        /*===========================================================================================
            TODO: Creación de Banners Horizontales - Slider
        ===========================================================================================*/

        public function createhor(){

            if(isset($_POST["name-product"])){


                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';

                /*================================================================
                    TODO: Validación de lado del servidor
                ================================================================*/

                /*=============================================
                    TODO: Validamos la sintaxis de los campos
                =============================================*/

                if( isset($_POST['hSliderH4Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH4Tag']) &&
                    isset($_POST['hSliderH3_1Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH3_1Tag']) &&
                    isset($_POST['hSliderH3_2Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH3_2Tag']) &&
                    isset($_POST['hSliderH3_3Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH3_3Tag']) &&
                    isset($_POST['hSliderH3_4sTag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH3_4sTag']) &&
                    isset($_POST['hSliderButtonTag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderButtonTag'])
                ){

                    $topBanner = (object)[

                        "H4 tag"=>TemplateController::capitalize($_POST['hSliderH4Tag']),
                        "H3-1 tag"=>TemplateController::capitalize($_POST['hSliderH3_1Tag']),
                        "H3-2 tag"=>TemplateController::capitalize($_POST['hSliderH3_2Tag']),
                        "H3-3 tag"=>TemplateController::capitalize($_POST['hSliderH3_3Tag']),
                        "H3-4s tag"=>TemplateController::capitalize($_POST['hSliderH3_4sTag']),
                        "Button tag"=>TemplateController::capitalize($_POST['hSliderButtonTag'])

                    ];

                    /*=============================================
                        TODO: Agrupamos la información
                    =============================================*/

                    $data = array(

                        "id_product_hbanner" => $_POST["name-product"],
                        "data_hbanner" => json_encode($topBanner),
                        "status_hbanner" => 1,
                        "date_created_hbanner" => date("Y-m-d")

                    );

                    /*=============================================
                        TODO: Solicitud a la API
                    =============================================*/

                    $url = "horizontal_banners?token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
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

                        if(isset($_FILES['hSlider']["tmp_name"]) && !empty($_FILES['hSlider']["tmp_name"])){

                            $fields = array(

                                "file"=>$_FILES['hSlider']["tmp_name"],
                                "type"=>$_FILES['hSlider']["type"],
                                "folder"=>"banners/horizontal",
                                "name"=>$id,
                                "width"=>1920,
                                "height"=>358
                            );

                            $saveImageHSlider = CurlController::requestFile($fields);

                            /*=========================================================
                                TODO: Solicitud a la API
                            =========================================================*/

                            $url = "horizontal_banners?id=".$id."&nameId=id_hbanner&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                            $method = "PUT";
                            $fields = 'picture_hbanner='.$saveImageHSlider;

                            $response = CurlController::request($url, $method, $fields);

                            if($response->status == 200){

                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncSweetAlert("success", "Sus registros fueron creados con éxito.", "/bannershor");

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

                            fncNotie(3, "Error en la sintaxis de los campos.");

                        </script>';

                    return;

                }

            }

        }

        /*===========================================================================================
            TODO: Edición de Banners Horizontales - Slider
        ===========================================================================================*/

        public function edithor($id){

            if(isset($_POST["idBanner"])){


                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';


                if($id == $_POST["idBanner"]){

                    $select = "*";

                    $url = "horizontal_banners?select=".$select."&linkTo=id_hbanner&equalTo=".$id."&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                    $method = "GET";
                    $fields = array();

                    $response = CurlController::request($url, $method, $fields);

                    if($response->status == 200){

                        $picture = $response->results[0]->picture_hbanner;

                        /*=======================================================
                            TODO: Agrupar información para Top Banner
                        =======================================================*/

                        if(isset($_FILES['hSlider']["tmp_name"]) && !empty($_FILES['hSlider']["tmp_name"])){

                            $fields = array(

                                "file"=>$_FILES['hSlider']["tmp_name"],
                                "type"=>$_FILES['hSlider']["type"],
                                "folder"=>"banners/horizontal",
                                "name"=>$_POST["idBanner"],
                                "width"=>1920,
                                "height"=>358
                            );

                            $saveImageHSlider = CurlController::requestFile($fields);

                        }else{

                            $saveImageHSlider = $picture;

                        }

                        if($saveImageHSlider != "error"){

                            /*================================================================
                                TODO: Validación de lado del servidor
                            ================================================================*/

                            /*=============================================
                                TODO: Validamos la sintaxis de los campos
                            =============================================*/

                            if( isset($_POST['hSliderH4Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH4Tag']) &&
                                isset($_POST['hSliderH3_1Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH3_1Tag']) &&
                                isset($_POST['hSliderH3_2Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH3_2Tag']) &&
                                isset($_POST['hSliderH3_3Tag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH3_3Tag']) &&
                                isset($_POST['hSliderH3_4sTag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderH3_4sTag']) &&
                                isset($_POST['hSliderButtonTag']) && preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,50}$/', $_POST['hSliderButtonTag'])
                            ){

                                $horBanner = (object)[

                                    "H4 tag"=>TemplateController::capitalize($_POST['hSliderH4Tag']),
                                    "H3-1 tag"=>TemplateController::capitalize($_POST['hSliderH3_1Tag']),
                                    "H3-2 tag"=>TemplateController::capitalize($_POST['hSliderH3_2Tag']),
                                    "H3-3 tag"=>TemplateController::capitalize($_POST['hSliderH3_3Tag']),
                                    "H3-4s tag"=>TemplateController::capitalize($_POST['hSliderH3_4sTag']),
                                    "Button tag"=>TemplateController::capitalize($_POST['hSliderButtonTag'])

                                ];

                            }else{

                                echo '<script>

                                        fncFormatInputs();

                                        fncNotie(3, "Error en la sintaxis de los campos.");

                                    </script>';

                                return;

                            }

                        }

                        /*=======================================================
                            TODO: Agrupar la información
                        =======================================================*/

                        $data = "id_product_hbanner=".$_POST["name-product"]."&picture_hbanner=".$saveImageHSlider."&data_hbanner=".json_encode($horBanner)."&date_updated_hbanner=".date("Y-m-d");

                        /*=======================================================
                            TODO: Solicitud a la API
                        =======================================================*/

                        $url = "horizontal_banners?id=".$id."&nameId=id_hbanner&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                        $method = "PUT";
                        $fields = $data;

                        $response = CurlController::request($url,$method,$fields);

                        /*=======================================================
                            TODO: Respuesta de la API
                        =======================================================*/

                        if($response->status == 200){

                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncSweetAlert("success", "Sus registros fueron editados con éxito.", "/bannershor");

                                    </script>';


                        }else{

                            echo '<script>

                                    //fncFormatInputs();
                                    matPreloader("off");
                                    fncSweetAlert("close", "", "");
                                    fncNotie(3, "Error al guardar el banner.");

                                </script>';

                        }

                    }else{

                        echo '<script>

                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncNotie(3, "Error al editar el registro");

                            </script>';

                    }

                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Error al editar el registro");

                        </script>';

                }

            }

        }

        /*===========================================================================================
            TODO: Creación de Banners Banners Verticales
        ===========================================================================================*/

        public function createver(){

            if(isset($_POST["name-product"])){


                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';

                    /*=============================================
                        TODO: Agrupamos la información
                    =============================================*/

                    $data = array(

                        "id_product_vbanner" => $_POST["name-product"],
                        "status_vbanner" => 1,
                        "date_created_vbanner" => date("Y-m-d")

                    );

                    /*=============================================
                        TODO: Solicitud a la API
                    =============================================*/

                    $url = "vertical_banners?token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
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

                        if(isset($_FILES['vSlider']["tmp_name"]) && !empty($_FILES['vSlider']["tmp_name"])){

                            $fields = array(

                                "file"=>$_FILES['vSlider']["tmp_name"],
                                "type"=>$_FILES['vSlider']["type"],
                                "folder"=>"banners/vertical",
                                "name"=>$id,
                                "width"=>263,
                                "height"=>629
                            );

                            $saveImageVSlider = CurlController::requestFile($fields);

                            /*=========================================================
                                TODO: Solicitud a la API
                            =========================================================*/

                            $url = "vertical_banners?id=".$id."&nameId=id_vbanner&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                            $method = "PUT";
                            $fields = 'picture_vbanner='.$saveImageVSlider;

                            $response = CurlController::request($url, $method, $fields);

                            if($response->status == 200){

                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncSweetAlert("success", "Sus registros fueron creados con éxito.", "/bannersvert");

                                    </script>';

                            }else{

                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncNotie(3, "Error al guardar la imagen.");

                                    </script>';

                            }

                        }else{

                            echo '<script>

                                    fncFormatInputs();
                                    matPreloader("off");
                                    fncSweetAlert("close", "", "");
                                    fncNotie(3, "Error al guardar el banner.");

                                </script>';

                        }

                    }

            }

        }

        /*===========================================================================================
            TODO: Edición de Banners Verticales
        ===========================================================================================*/

        public function editvert($id){

            if(isset($_POST["name-product"])){


                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';


                if($id == $_POST["idBannerV"]){

                    $select = "*";

                    $url = "vertical_banners?select=".$select."&linkTo=id_vbanner&equalTo=".$id."&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                    $method = "GET";
                    $fields = array();

                    $response = CurlController::request($url, $method, $fields);

                    if($response->status == 200){

                        $picture = $response->results[0]->picture_vbanner;

                        /*=======================================================
                            TODO: Agrupar información para Top Banner
                        =======================================================*/

                        if(isset($_FILES['vSlider']["tmp_name"]) && !empty($_FILES['vSlider']["tmp_name"])){

                            $fields = array(

                                "file"=>$_FILES['vSlider']["tmp_name"],
                                "type"=>$_FILES['vSlider']["type"],
                                "folder"=>"banners/vertical",
                                "name"=>$_POST["idBannerV"],
                                "width"=>263,
                                "height"=>629
                            );

                            $saveImageVSlider = CurlController::requestFile($fields);

                        }else{

                            $saveImageVSlider = $picture;

                        }

                        /*=======================================================
                            TODO: Agrupar la información
                        =======================================================*/

                        $data = "id_product_vbanner=".$_POST["name-product"]."&picture_vbanner=".$saveImageVSlider."&date_updated_vbanner=".date("Y-m-d");

                        /*=======================================================
                            TODO: Solicitud a la API
                        =======================================================*/

                        $url = "vertical_banners?id=".$id."&nameId=id_vbanner&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                        $method = "PUT";
                        $fields = $data;

                        $response = CurlController::request($url,$method,$fields);

                        /*=======================================================
                            TODO: Respuesta de la API
                        =======================================================*/

                        if($response->status == 200){

                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncSweetAlert("success", "Sus registros fueron editados con éxito.", "/bannersvert");

                                    </script>';


                        }else{

                            echo '<script>

                                    //fncFormatInputs();
                                    matPreloader("off");
                                    fncSweetAlert("close", "", "");
                                    fncNotie(3, "Error al guardar el banner.");

                                </script>';

                        }

                    }else{

                        echo '<script>

                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncNotie(3, "Error al editar el registro");

                            </script>';

                    }

                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Error al editar el registro");

                        </script>';

                }

            }

        }


    }

?>