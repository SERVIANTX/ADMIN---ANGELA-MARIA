<?php

    class ProductosController{

        /*===========================================================================================
            TODO: Creación de Productos
        ===========================================================================================*/

        public function create(){

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

                if( preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}$/', $_POST["name-product"] ) &&
                    preg_match('/^[.\\,\\0-9]{1,}$/', $_POST["precio-producto"] ) &&
                    preg_match('/^[.\\,\\0-9]{1,}$/', $_POST["stock-producto"] ) &&
                    preg_match('/^[.\\,\\0-9]{1,}$/', $_POST["cantidadmaxima"] )){


                        /*=============================================
                            TODO: Proceso para configurar la galería
                        =============================================*/

                        $galleryProduct = array();
                        $countGallery = 0;

                        foreach (json_decode($_POST["galeria-producto"],true) as $key => $value) {

                            $countGallery++;

                            $fields = array(

                                "file"=>$value["file"],
                                "type"=>$value["type"],
                                "folder"=>"products/".explode("_",$_POST["name-category"])[1]."/gallery/",
                                "name"=>$_POST["url-name_product"]."_".mt_rand(100000000, 9999999999),
                                "width"=>$value["width"],
                                "height"=>$value["height"]
                            );

                            $saveImageGaleria = CurlController::requestFile($fields);

                            array_push($galleryProduct, $saveImageGaleria);

                        }

                        if($countGallery == count($galleryProduct)){

                            /*=============================================
                                TODO: Validación de Imagen del Producto
                            =============================================*/

                            if(isset($_FILES["imagen-producto"]["tmp_name"]) && !empty($_FILES["imagen-producto"]["tmp_name"])){

                                $fields = array(

                                    "file"=>$_FILES["imagen-producto"]["tmp_name"],
                                    "type"=>$_FILES["imagen-producto"]["type"],
                                    "folder"=>"products/".explode("_",$_POST["name-category"])[1],
                                    "name"=>$_POST["url-name_product"],
                                    "width"=>300,
                                    "height"=>300
                                );

                                $saveImageProducto = CurlController::requestFile($fields);

                            }else{

                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncNotie(3, "Campo de Imagen con error.");

                                    </script>';

                                return;
                            }

                            /*=============================================
                                TODO: Agrupamos el resumen
                            =============================================*/

                            if(isset($_POST["inputSummary"])){

                                $summaryProduct = array();

                                for($i = 0; $i < $_POST["inputSummary"]; $i++){

                                    array_push($summaryProduct, trim($_POST["summary-product_".$i]));

                                }

                            }

                            /*=============================================
                                TODO: Agrupamos el detalle
                            =============================================*/

                            if(isset($_POST["inputDetails"])){

                                $detailsProduct = array();

                                for($i = 0; $i < $_POST["inputDetails"]; $i++){

                                    $detailsProduct[$i] = (object)["title"=>trim($_POST["details-title-product_".$i]),"value"=>trim($_POST["details-value-product_".$i])];

                                }

                            }

                            /*=============================================
                                TODO: Agrupamos la información
                            =============================================*/

                            $data = array(

                                "name_product" => trim(TemplateController::capitalize($_POST["name-product"])),
                                "url_product" => trim($_POST["url-name_product"]),
                                "picture_product" => $saveImageProducto,
                                "price_product" => str_replace(",", ".", $_POST["precio-producto"]),
                                "stock_product" => $_POST["stock-producto"],
                                "gallery_product" => json_encode($galleryProduct),
                                "maxquantitysale_product" => $_POST["cantidadmaxima"],
                                "description_product" => trim(TemplateController::htmlClean($_POST["descripcion-producto"])),
                                "summary_product" => json_encode($summaryProduct),
                                "details_product" => json_encode($detailsProduct),
                                "status_product" => 1,
                                "id_category_product" => explode("_",$_POST["name-category"])[0],
                                "id_subcategory_product" => explode("_",$_POST["name-subcategory"])[0],
                                "title_list_product" =>  explode("_",$_POST["name-subcategory"])[1],
                                "id_brand_product" => $_POST["name-brand"],
                                "date_created_product" => date("Y-m-d")

                            );

                            /*=============================================
                                TODO: Solicitud a la API
                            =============================================*/

                            $url = "products?token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
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
                                        fncSweetAlert("success", "Sus registros fueron creados con éxito.", "/productos");

                                    </script>';

                            }else{

                                echo '<script>

                                        //fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncNotie(3, "Error al guardar el producto.");

                                    </script>';

                            }
                        }

                }else{

                    echo '<script>

                            //fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Field syntax error");

                        </script>';


                }
            }

        }

        /*===========================================================================================
            TODO: Editar de Productos
        ===========================================================================================*/

        public function edit($id){

            if(isset($_POST["idProduct"])){

                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';

                if($id == $_POST["idProduct"]){

                    $select = "*";

                    $url = "products?select=".$select."&linkTo=id_product&equalTo=".$id;
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

                        if( preg_match('/^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,100}$/', $_POST["name-product"] ) &&
                            preg_match('/^[.\\,\\0-9]{1,}$/', $_POST["precio-producto"] ) &&
                            preg_match('/^[.\\,\\0-9]{1,}$/', $_POST["stock-producto"] ) &&
                            preg_match('/^[.\\,\\0-9]{1,}$/', $_POST["cantidadmaxima"] )){

                            $galleryProduct = array();
                            $countGallery = 0;
                            $countGallery2 = 0;
                            $continueEdit = false;

                            if(!empty($_POST['galeria-producto'])){

                                /*=============================================
                                    TODO: Proceso para configurar la galería
                                =============================================*/
                                foreach (json_decode($_POST["galeria-producto"],true) as $key => $value) {

                                    $countGallery++;

                                    $fields = array(

                                        "file"=>$value["file"],
                                        "type"=>$value["type"],
                                        "folder"=>"products/".explode("_",$_POST["name-category"])[1]."/gallery",
                                        "name"=>$_POST["url-name_product"]."_".mt_rand(100000000, 9999999999),
                                        "width"=>$value["width"],
                                        "height"=>$value["height"]
                                    );

                                    $saveImageGallery = CurlController::requestFile($fields);

                                    array_push($galleryProduct, $saveImageGallery);

                                    if($countGallery == count($galleryProduct)){

                                        if(!empty($_POST['galeria-producto-old'])){

                                            foreach (json_decode($_POST['galeria-producto-old'],true) as $key => $value) {

                                                $countGallery2++;
                                                array_push($galleryProduct, $value);
                                            }

                                            if(count(json_decode($_POST['galeria-producto-old'],true)) == $countGallery2){

                                                    $continueEdit = true;

                                            }

                                        }else{

                                            $continueEdit = true;

                                        }

                                    }

                                }

                            }else{

                                if(!empty($_POST['galeria-producto-old'])){

                                    $countGallery2 = 0;

                                    foreach (json_decode($_POST['galeria-producto-old'],true) as $key => $value) {

                                        $countGallery2++;
                                        array_push($galleryProduct, $value);
                                    }

                                    if(count(json_decode($_POST['galeria-producto-old'],true)) == $countGallery2){

                                            $continueEdit = true;

                                        }

                                }

                            }

                            /*=======================================================
                                TODO: Eliminamos archivos basura del servidor
                            =======================================================*/

                            if(!empty($_POST['delete-galeria-producto'])){

                                foreach (json_decode($_POST['delete-galeria-producto'],true) as $key => $value) {

                                    $fields = array(

                                        "deleteFile"=> "products/".explode("_",$_POST["name-category"])[1]."/gallery/".$value

                                    );

                                    $picture = CurlController::requestFile($fields);

                                }

                            }

                            /*=======================================================
                                TODO: Validamos que no venga la galería vacía
                            =======================================================*/

                            if(count($galleryProduct) == 0){

                                    echo '<script>

                                            fncFormatInputs();

                                            fncNotie(3, "La galería no puede estar vacía.");

                                        </script>';

                                    return;

                            }

                            if($continueEdit){

                                /*=======================================================
                                    TODO: Validación Imagen
                                =======================================================*/

                                if(isset($_FILES["imagen-producto"]["tmp_name"]) && !empty($_FILES["imagen-producto"]["tmp_name"])){

                                    $fields = array(

                                        "file"=>$_FILES["imagen-producto"]["tmp_name"],
                                        "type"=>$_FILES["imagen-producto"]["type"],
                                        "folder"=>"products/".explode("_",$_POST["name-category"])[1],
                                        "name"=>$_POST["url-name_product"],
                                        "width"=>300,
                                        "height"=>300
                                    );

                                    $saveImageProducto = CurlController::requestFile($fields);

                                }else{

                                    $saveImageProducto = $response->results[0]->picture_product;
                                }

                                /*=======================================================
                                    TODO: Agrupamos el resumen
                                =======================================================*/

                                if(isset($_POST["inputSummary"])){

                                    $summaryProduct = array();

                                    for($i = 0; $i < $_POST["inputSummary"]; $i++){

                                        array_push($summaryProduct, trim($_POST["summary-product_".$i]));

                                    }

                                }

                                /*=======================================================
                                    TODO: Agrupamos el detalle
                                =======================================================*/

                                if(isset($_POST["inputDetails"])){

                                    $detailsProduct = array();


                                    for($i = 0; $i < $_POST["inputDetails"]; $i++){

                                        $detailsProduct[$i] = (object)["title"=>trim($_POST["details-title-product_".$i]),"value"=>trim($_POST["details-value-product_".$i])];

                                    }

                                }

                                /*=======================================================
                                    TODO: Agrupar la información
                                =======================================================*/

                                $data = "name_product=".trim(TemplateController::capitalize($_POST["name-product"]))."&url_product=".trim($_POST["url-name_product"])."&picture_product=".$saveImageProducto."&price_product=".str_replace(",", ".", $_POST["precio-producto"])."&stock_product=".$_POST["stock-producto"]."&gallery_product=".json_encode($galleryProduct)."&maxquantitysale_product=".$_POST["cantidadmaxima"]."&description_product=".urlencode(trim(TemplateController::htmlClean($_POST["descripcion-producto"])))."&details_product=".json_encode($detailsProduct)."&summary_product=".json_encode($summaryProduct)."&id_category_product=".explode("_",$_POST["name-category"])[0]."&id_subcategory_product=".explode("_",$_POST["name-subcategory"])[0]."&title_list_product=". explode("_",$_POST["name-subcategory"])[1]."&id_brand_product=".$_POST["name-brand"];

                                /*=======================================================
                                    TODO: Solicitud a la API
                                =======================================================*/

                                $url = "products?id=".$id."&nameId=id_product&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
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
                                                fncSweetAlert("success", "Sus registros fueron creados con éxito.", "/productos");

                                            </script>';


                                }else{

                                    echo '<script>

                                            //fncFormatInputs();
                                            matPreloader("off");
                                            fncSweetAlert("close", "", "");
                                            fncNotie(3, "Error al guardar el producto.");

                                        </script>';

                                }

                            }


                        }else{

                            echo '<script>

                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncNotie(3, "Error en los campos de sintaxis");

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
            TODO: Oferta de Productos
        ===========================================================================================*/

        public function offer($id){

            if(isset($_POST["idProduct"])){

                if(!empty($_POST["type_offer"]) && !empty($_POST["value_offer"]) && !empty($_POST["date_offer"])){

                    if(preg_match('/^[.\\,\\0-9]{1,}$/', $_POST['value_offer'])){

                        $offer_product = array($_POST["type_offer"], $_POST["value_offer"], $_POST["date_offer"] );

                        $offer_product = json_encode($offer_product);

                        /*=======================================================
                            TODO: Agrupar la información
                        =======================================================*/

                        $data = "productoffer_product=".$offer_product;

                        /*=======================================================
                            TODO: Solicitud a la API
                        =======================================================*/

                        $url = "products?id=".$_POST["idProduct"]."&nameId=id_product&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
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
                                        fncSweetAlert("success", "La oferta fue creado con éxito.", "/ofertas");

                                    </script>';


                        }else{

                            echo '<script>

                                    //fncFormatInputs();
                                    matPreloader("off");
                                    fncSweetAlert("close", "", "");
                                    fncNotie(3, "Error al crear la oferta.");

                                </script>';

                        }

                    }else{

                        echo '<script>

                                fncFormatInputs();

                                fncNotie(3, "Error en la sintaxis de los campos de Oferta.");

                            </script>';

                        return;

                    }

                }else{

                    echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Error de sintaxis de campo.");

                    </script>';

                }

            }
        }

        /*=============================================
            TODO: Editar Stock
        =============================================*/

        public function editStock(){

            if(isset($_POST["idProduct"])){

                $url = "products?id=".$_POST["idProduct"]."&nameId=id_product&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                $method = "PUT";
                $fields = "stock_product=".$_POST["stockProduct"]."&date_update_product=".date("Y-m-d");

                $editStock = CurlController::request($url, $method, $fields);

                if($editStock->status == 200){

                    echo '<script>

                            fncFormatInputs();
                            fncNotie(1, "Se actualizo el stock del producto.");

                        </script>';

                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Error al actualizar el stock del producto.");

                        </script>';
                }

            }

        }

        /*=============================================
            TODO: Editar Precio
        =============================================*/

        public function editPrice(){

            if(isset($_POST["idProduct"])){

                $url = "products?id=".$_POST["idProduct"]."&nameId=id_product&token=".$_SESSION["admin"]->token_user."&table=users&suffix=user";
                $method = "PUT";
                $fields = "price_product=".$_POST["priceProduct"]."&date_update_product=".date("Y-m-d");

                $editStock = CurlController::request($url, $method, $fields);

                if($editStock->status == 200){

                    echo '<script>

                            fncFormatInputs();
                            fncNotie(1, "Se actualizo el precio del producto.");

                        </script>';

                }else{

                    echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Error al actualizar el precio del producto.");

                        </script>';
                }

            }

        }

    }

?>