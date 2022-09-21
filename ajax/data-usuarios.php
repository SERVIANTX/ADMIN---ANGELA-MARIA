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

                $url = "customers?select=id_customer&linkTo=date_created_customer&between1=".$_GET["between1"]."&between2=".$_GET["between2"];

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

                $select = "id_customer,picture_customer,displayname_customer,username_customer,email_customer,country_customer,city_customer,address_customer,phone_customer,date_created_customer,method_customer,status_customer";

                if(!empty($_POST['search']['value'])){

                    if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                        $linkTo = ["displayname_customer","username_customer","email_customer","date_created_customer"];

                        $search = str_replace(" ", "_", $_POST['search']['value']);

                        foreach($linkTo as $key => $value) {

                            $url = "customers?select=".$select."&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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

                    $url = "customers?select=".$select."&linkTo=date_created_customer&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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

                            $picture_customer = $value->picture_customer;
                            $actions = "";

                            switch($value->method_customer){
                                case "google":
                                    $method_customer = "Google";
                                    break;
                                case "facebook":
                                    $method_customer = "Facebook";
                                    break;
                                case "direct":
                                    $method_customer = "Directo";
                                    break;
                            }

                            switch($value->status_customer){
                                case "1":
                                    $status_customer = "Activo";
                                    break;
                                case "0":
                                    $status_customer = "Inactivo";
                                    break;
                            }

                        }else{

                            $picture_customer = "<img src='".TemplateController::returnImgCust($value->id_customer, $value->picture_customer, $value->method_customer)."' class='rounded-circle img-thumbnail changePicture' style='width:70px'>";

                            switch($value->status_customer){
                                case "1":
                                    $status_customer = "<span class='badge badge-success mr-1'>Activo</span>";
                                    break;
                                case "0":
                                    $status_customer = "<span class='badge badge-danger mr-1'>Inactivo</span>";
                                    break;
                            }

                            switch($value->method_customer){
                                case "google":
                                    $method_customer = "<span class='badge badge-danger mr-1'><i class='bx bxl-google mr-1'></i> Google</span>";
                                    break;
                                case "facebook":
                                    $method_customer = "<span class='badge badge-primary mr-1'><i class='bx bxl-facebook mr-1'></i> Facebook</span>";
                                    break;
                                case "direct":
                                    $method_customer = "<span class='badge badge-secondary mr-1'><i class='bx bx-globe mr-1'></i> Directo</span>";
                                    break;
                            }

                            $actions = "<a class='btn btn-outline-info-jrfd btn-sm rounded-circle infoCustomer mr-2' id_customer='".$value->id_customer."' rol_customer='Cliente' picture_customer='".$value->picture_customer."' displayname_customer='".$value->displayname_customer."' username_customer='".$value->username_customer."' email_customer='".$value->email_customer."' country_customer='".$value->country_customer."' city_customer='".$value->city_customer."' phone_customer='".$value->phone_customer."' address_customer='".$value->address_customer."' method_customer='".$value->method_customer."' status_customer='".$value->status_customer."'>

                                            <i class='fas fa-eye'></i>

                                        </a>";

                            $actions = TemplateController::htmlClean($actions);

                        }

                        $displayname_customer = $value->displayname_customer;
                        $username_customer = $value->username_customer;
                        $email_customer = $value->email_customer;
                        $country_customer = $value->country_customer;
                        $city_customer = $value->city_customer;
                        $address_customer = $value->address_customer;
                        $phone_customer = $value->phone_customer;
                        $date_created_customer = $value->date_created_customer;

                        $dataJson.='{

                            "id_customer":"'.($start+$key+1).'",
                            "actions":"'.$actions.'",
                            "picture_customer":"'.$picture_customer.'",
                            "displayname_customer":"'.$displayname_customer.'",
                            "username_customer":"'.$username_customer.'",
                            "email_customer":"'.$email_customer.'",
                            "status_customer":"'.$status_customer.'",
                            "method_customer":"'.$method_customer.'",
                            "date_created_customer":"'.$date_created_customer.'"

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