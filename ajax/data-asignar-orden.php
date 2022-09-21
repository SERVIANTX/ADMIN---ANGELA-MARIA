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

                $url = "relations?rel=orders,customers&type=order,customer&select=id_order&linkTo=date_created_order&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&filterTo=status_order&inTo=0";

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

                $select = "id_order,date_order,status_order,id_user_order,displayname_customer,date_created_order";

                if(!empty($_POST['search']['value'])){

                    if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                        $linkTo = ["date_created_order","address_order","phone_order","namepickup_order"];

                        $search = str_replace(" ", "_", $_POST['search']['value']);

                        foreach($linkTo as $key => $value) {

                            $url = "relations?rel=orders,customers&type=order,customer&select=".$select."&linkTo=".$value.",status_order&search=".$search.",0&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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

                    $url = "relations?rel=orders,customers&type=order,customer&select=".$select."&linkTo=date_created_order&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&filterTo=status_order&inTo=0";

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

                            $status_order = "No Asignado";
                            $id_user_order = $value->id_user_order;

                        }else{

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
                                TODO: Asignar Repartidor
                            =====================================================*/

                            if($value->id_user_order == null){

                                $id_user_order = "<div class='btn-group'>

                                                    <a class='btn btn-outline-success-jrfd btn-sm infoAsignarRepartidor' idOrden='".$value->id_order."'>

                                                        <i class='bx bx-car mr-1'></i> Asignar

                                                    </a>

                                                </div>";

                            }

                            $id_user_order = TemplateController::htmlClean($id_user_order);

                        }

                        $id_order = $value->id_order;
                        $date_order = $value->date_order;
                        $displayname_customer = $value->displayname_customer;

                        $dataJson.='{

                            "id_order":"'.($id_order).'",
                            "date_order":"'.$date_order.'",
                            "displayname_customer":"'.$displayname_customer.'",
                            "status_order":"'.$status_order.'",
                            "displayname_user":"'.$id_user_order.'"

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