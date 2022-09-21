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

                $url = "relations?rel=orders,customers&type=order,customer&select=id_order&linkTo=date_created_order&between1=".$_GET["between1"]."&between2=".$_GET["between2"];

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

                $select = "id_order,date_order,address_order,dni_picture_order,phone_order,notes_order,status_order,displayname_customer,payment_order,date_created_order";

                if(!empty($_POST['search']['value'])){

                    if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                        $linkTo = ["date_created_order","address_order","phone_order"];

                        $search = str_replace(" ", "_", $_POST['search']['value']);

                        foreach($linkTo as $key => $value) {

                            $url = "relations?rel=orders,customers&type=order,customer&select=".$select."&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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

                    $url = "relations?rel=orders,customers&type=order,customer&select=".$select."&linkTo=date_created_order&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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

                            $detalles = "";

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

                            switch($value->payment_order){
                                case "0":
                                    $method_pay_order = "Mercado Pago";
                                    break;
                                case "1":
                                    $method_pay_order = "Paypal";
                                    break;
                            }

                        }else{

                            if($value->dni_picture_order != null){

                                $detalles = "<a class='btn btn-outline-info btn-sm rounded-circle mr-2' href='/ordenes/detalles/".base64_encode($value->id_order."~".$_GET["token"])."'>

                                            <i class='fas fa-eye'></i>

                                        </a>

                                        <a class='btn btn-outline-dark btn-sm rounded-circle mr-2' href='/ordenes/factura/".base64_encode($value->id_order."~".$_GET["token"])."'>

                                            <i class='bx bx-receipt'></i>

                                        </a>

                                        <a class='btn btn-outline-jrfd-primary btn-sm rounded-circle infoDocument mr-2' id_order='".$value->id_order."' dni_order='".TemplateController::srcImg()."views/img/dni_orders/".$value->dni_picture_order."'>

                                            <i class='bx bx-credit-card'></i>

                                        </a>";

                            }else{

                                $detalles = "<a class='btn btn-outline-info btn-sm rounded-circle mr-2' href='/ordenes/detalles/".base64_encode($value->id_order."~".$_GET["token"])."'>

                                            <i class='fas fa-eye'></i>

                                        </a>

                                        <a class='btn btn-outline-dark btn-sm rounded-circle mr-2' href='/ordenes/factura/".base64_encode($value->id_order."~".$_GET["token"])."'>

                                            <i class='bx bx-receipt'></i>

                                        </a>";

                            }

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
                                TODO: Método de pago
                            =====================================================*/

                            switch($value->payment_order){
                                case "0":
                                    $method_pay_order = "<span class='badge badge-info mr-1'><i class='fas fa-store mr-1'></i> Mercado Pago</span>";
                                    break;
                                case "1":
                                    $method_pay_order = "<span class='badge badge-primary mr-1'><i class='bx bxl-paypal mr-1'></i> Paypal</span>";
                                    break;
                            }

                        }

                        $id_order = $value->id_order;
                        $date_order = $value->date_order;
                        $address_order = $value->address_order;
                        $phone_order = "<a href='tel:".$value->phone_order."'>"."$value->phone_order</a>";
                        $displayname_customer = $value->displayname_customer;

                        $dataJson.='{

                            "id_order":"'.($id_order).'",
                            "date_order":"'.$date_order.'",
                            "address_order":"'.$address_order.'",
                            "phone_order":"'.$phone_order.'",
                            "displayname_customer":"'.$displayname_customer.'",
                            "status_order":"'.$status_order.'",
                            "payment_order":"'.$method_pay_order.'",
                            "detalles":"'.$detalles.'"

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