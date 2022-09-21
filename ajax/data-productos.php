<?php

    require_once "../controllers/curl.controller.php";
    require_once "../controllers/template.controller.php";

    class DatatableController{

        public function data(){

            if(!empty($_POST)){

                /*=====================================================================
                    TODO: Capturando y organizando las variables POST de DataTable
                =====================================================================*/

                $draw = $_POST["draw"];//Contador utilizado por DataTables para garantizar que los retornos de Ajax de las solicitudes de procesamiento del lado del servidor sean dibujados en secuencia por DataTables

                $orderByColumnIndex = $_POST['order'][0]['column']; //Índice de la columna de clasificación (0 basado en el índice, es decir, 0 es el primer registro)

                $orderBy = $_POST['columns'][$orderByColumnIndex]["data"];//Obtener el nombre de la columna de clasificación de su índice

                $orderType = $_POST['order'][0]['dir'];// Obtener el orden ASC o DESC

                $start  = $_POST["start"];//Indicador de primer registro de paginación.

                $length = $_POST['length'];//Indicador de la longitud de la paginación.

                /*=====================================================================
                    TODO: El total de registros de la data
                =====================================================================*/

                $url = "products?select=id_product&linkTo=date_created_product&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&filterTo=status_product&inTo=1";

                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $totalData = $response->total;

                }else{

                    echo '{"data": []}';
                    return;

                }

                /*=====================================================================
                    TODO: Busqueda de datos
                =====================================================================*/

                $select = "id_product,name_product,url_product,url_category,picture_product,price_product,productoffer_product,stock_product,maxquantitysale_product,description_product,summary_product,sales_product,views_product,status_product,id_category_product,id_brand_product,date_created_product";

                if(!empty($_POST['search']['value'])){

                    if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                        $linkTo = ["name_product","date_created_product"];

                        $search = str_replace(" ", "_", $_POST['search']['value']);

                        foreach($linkTo as $key => $value) {

                            $url = "relations?rel=products,categories&type=product,category&select=".$select."&linkTo=".$value.",status_product&search=".$search.",1&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

                            $data = CurlController::request($url, $method, $fields)->results;

                            if($data == "Not Found"){

                                $data = array();
                                $recordsFiltered = count($data);

                            }else{

                                $data = $data;
                                $recordsFiltered = count($data);

                                break;

                            }

                        }
                    }else{

                        echo '{"data": []}';
                        return;

                    }

                }else{

                    /*=====================================================================
                        TODO: Seleccionar datos
                    =====================================================================*/

                    $url = "relations?rel=products,categories&type=product,category&select=".$select."&linkTo=date_created_product&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&filterTo=status_product&inTo=1";

                    $data = CurlController::request($url, $method, $fields)->results;

                    $recordsFiltered = $totalData;

                }

                /*=====================================================================
                    TODO: Cuando la data viene vacía
                =====================================================================*/

                if(empty($data)){

                    echo '{"data": []}';
                    return;

                }

                /*=====================================================================
                    TODO: Construimos el dato JSON a regresar
                =====================================================================*/

                $dataJson = '{

                    "Draw": '.intval($draw).',
                    "recordsTotal": '.$totalData.',
                    "recordsFiltered": '.$recordsFiltered.',
                    "data": [';

                    /*=====================================================================
                        TODO: Recorremos la data
                    =====================================================================*/

                    foreach($data as $key => $value){

                        if($_GET["text"] == "flat"){

                            $actions = "";
                            $picture_product = $value->picture_product;
                            $stock_product = $value->stock_product;

                            if($value->status_product == 1){

                                $status = "Activo";

                            }else{

                                $status = "Inactivo";

                            }

                        }else{

                            $actions = "<div class='btn-group'>

                                        <a href='".TemplateController::pathEcommerce().$value->url_product."' target='_blank' class='btn btn-outline-info-jrfd btn-sm rounded-circle mr-2'>

                                            <i class='fas fa-eye'></i>

                                        </a>

                                        <a href='/productos/editar/".base64_encode($value->id_product."~".$_GET["token"])."' class='btn btn-warning-jrfd btn-sm rounded-circle mr-2'>

                                            <i class='bx bx-edit-alt'></i>

                                        </a>

                                        <a class='btn btn-outline-success2-jrfd btn-sm rounded-circle mr-2 editPrecio' idProduct='".$value->id_product."' priceProduct='".$value->price_product."' stockProduct='".$value->stock_product."'>

                                            <i class='bx bx-money'></i>

                                        </a>

                                        <a class='btn btn-outline-success-jrfd btn-sm rounded-circle mr-2 editCantidad' idProduct='".$value->id_product."' stockProduct='".$value->stock_product."' priceProduct='".$value->price_product."'>

                                            <i class='bx bx-layer-plus'></i>

                                        </a>

                                </div>";

                            /*=====================================================
                                TODO: State del Producto
                            =====================================================*/

                            if($value->status_product == 1){

                                $status = "<div class='custom-control custom-switch'><input type='checkbox' class='custom-control-input' id='switch".$key."' checked onchange='changeState(event,".$value->id_product.")'><label class='custom-control-label' for='switch".$key."'></label></div>";

                            }else{

                                $status = "<div class='custom-control custom-switch'><input type='checkbox' class='custom-control-input' id='switch".$key."' onchange='changeState(event,".$value->id_product.")'><label class='custom-control-label' for='switch".$key."'></label></div>";

                            }

                            /*=====================================================
                                TODO: Imagen del Producto
                            =====================================================*/

                            $picture_product = "<img src='".TemplateController::srcImg()."views/img/products/".$value->url_category."/".$value->picture_product."' style='width:70px'>";

                            /*=====================================================
                                TODO: Stock del Producto
                            =====================================================*/

                            if($value->stock_product >= 50){

                                $stock_product = "<span class='badge badge-success p-2'>".$value->stock_product."</span>";

                            }else if($value->stock_product < 50 && $value->stock_product > 20){

                                $stock_product = "<span class='badge badge-warning p-2'>".$value->stock_product."</span>";

                            }else{

                                $stock_product = "<span class='badge badge-danger p-2'>".$value->stock_product."</span>";

                            }


                                        $actions = TemplateController::htmlClean($actions);

                        }

                        $name_product = $value->name_product;
                        $price_product = $value->price_product;
                        $views_product = $value->views_product;
                        $date_created_product = $value->date_created_product;

                        $dataJson.='{

                            "id_product":"'.($start+$key+1).'",
                            "actions":"'.$actions.'",
                            "status_product":"'.$status.'",
                            "picture_product":"'.$picture_product.'",
                            "name_product":"'.$name_product.'",
                            "price_product":"'.$price_product.'",
                            "stock_product":"'.$stock_product.'",
                            "views_product":"'.$views_product.'",
                            "date_created_product":"'.$date_created_product.'"

                        },';

                    }

                $dataJson = substr($dataJson,0,-1); // este substr quita el último caracter de la cadena, que es una coma, para impedir que rompa la tabla

                $dataJson .= ']}';

                echo $dataJson;

            }
        }
    }


    /*=============================================
        TODO: Activar función DataTable
    =============================================*/

    $data = new DatatableController();
    $data -> data();

?>
