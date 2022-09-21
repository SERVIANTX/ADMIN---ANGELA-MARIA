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

                $url = "relations?rel=orders,customers,users&type=order,customer,user&select=id_order&linkTo=date_created_order&between1=".$_GET["between1"]."&between2=".$_GET["between2"];

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

                $select = "id_order,date_order,status_order,id_user_order,rol_user,picture_user,username_user,email_user,country_user,city_user,phone_user,address_user,status_user,displayname_customer,displayname_user,date_created_order";

                if(!empty($_POST['search']['value'])){

                    if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                        $linkTo = ["date_created_order","address_order","phone_order","namepickup_order"];

                        $search = str_replace(" ", "_", $_POST['search']['value']);

                        foreach($linkTo as $key => $value) {

                            $url = "relations?rel=orders,customers,users&type=order,customer,user&select=".$select."&linkTo=".$value.",status_order&search=".$search.",1&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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

                    $url = "relations?rel=orders,customers,users&type=order,customer,user&select=".$select."&linkTo=date_created_order&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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

                        if($value->status_order != 0){


                        if($_GET["text"] == "flat"){

                            $detalles = "";
                            $displayname_user = $value->displayname_user;

                            switch($value->status_order){
                                case "0":
                                    $status_order = "Asignado";
                                    break;
                                case "1":
                                    $status_order = "Preparando el pédido";
                                    break;
                                case "2":
                                    $status_order = "Pedido en camino";
                                    break;
                                case "3":
                                    $status_order = "Pedido entregado";
                                    break;
                            }

                        }else{

                            $detalles = "<a class='btn btn-outline-info btn-sm rounded-circle mr-2' href='/ordenes/detalles/".base64_encode($value->id_order."~".$_GET["token"])."'>

                                        <i class='fas fa-eye'></i>

                                        </a> ";

                            $detalles = TemplateController::htmlClean($detalles);

                            /*=====================================================
                                TODO: Status de la órden
                            =====================================================*/

                            switch($value->status_order){
                                case "0":
                                    $status_order = "<span class='badge badge-danger mr-1'><i class='fas fa-user mr-1'></i> No Asignado</span>";
                                    break;
                                case "1":
                                    $status_order = "<span class='badge badge-primary mr-1'><i class='bx bx-check-double mr-1'></i> Preparando el pédido</span>";
                                    break;
                                case "2":
                                    $status_order = "<span class='badge badge-warning mr-1'><i class='fas fa-dolly mr-1'></i> Pedido en camino</span>";
                                    break;
                                case "3":
                                    $status_order = "<span class='badge badge-success mr-1'><i class='fas fa-truck mr-1'></i> Pedido entregado</span>";
                                    break;
                            }

                            /*=====================================================
                                TODO: Repartidor
                            =====================================================*/

                            $displayname_user = "<span class='badge badge-dark mr-1'><i class='bx bx-car mr-1'></i> ".$value->displayname_user."</span>
                                                <a style='cursor:pointer;' class='infoAdmin' id_user='".$value->id_user_order."' rol_user='".$value->rol_user."' picture_user='".$value->picture_user."' displayname_user='".$value->displayname_user."' username_user='".$value->username_user."' email_user='".$value->email_user."' country_user='".$value->country_user."' city_user='".$value->city_user."' phone_user='".$value->phone_user."' address_user='".$value->address_user."' status_user='".$value->status_user."'><span class='badge-am-danger mr-1'>
                                                    <i class='bx bx-info-circle'></i>
                                                </span></a>";

                            $displayname_user = TemplateController::htmlClean($displayname_user);

                        }

                        $id_order = $value->id_order;
                        $date_order = $value->date_order;
                        $displayname_customer = $value->displayname_customer;

                        $dataJson.='{

                            "id_order":"'.($id_order).'",
                            "date_order":"'.$date_order.'",
                            "displayname_customer":"'.$displayname_customer.'",
                            "status_order":"'.$status_order.'",
                            "displayname_user":"'.$displayname_user.'",
                            "detalles":"'.$detalles.'"

                        },';

                    }}

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