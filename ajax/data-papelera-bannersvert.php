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

                $url = "relations?rel=vertical_banners,products&type=vbanner,product&select=id_vbanner&linkTo=date_updated_vbanner&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&filterTo=status_vbanner&inTo=0";


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

                $select = "id_vbanner,picture_vbanner,name_product,status_vbanner,date_updated_vbanner";

                if(!empty($_POST['search']['value'])){

                    if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                        $linkTo = ["name_product","date_updated_vbanner"];

                        $search = str_replace(" ", "_", $_POST['search']['value']);

                        foreach($linkTo as $key => $value) {

                            $url = "relations?rel=vertical_banners,products&type=vbanner,product&select=".$select."&linkTo=".$value.",status_vbanner&search=".$search.",0&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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

                    $url = "relations?rel=vertical_banners,products&type=vbanner,product&select=".$select."&linkTo=date_updated_vbanner&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&filterTo=status_vbanner&inTo=0";

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
                            $picture_vbanner = $value->picture_vbanner;
                            if($value->status_vbanner == 1){

                                $status_vbanner = "Visible";

                            }else{

                                $status_vbanner = "No Visible";

                            }

                        }else{

                            $actions = "<a class='btn btn-warning-jrfd btn-sm rounded-circle mr-2 removeItem' idItem='".base64_encode($value->id_vbanner."~".$_GET["token"])."' table='vertical_banners' suffix='vbanner' page='bannersvert'>
                                            <i class='bx bx-power-off'></i>
                                        </a>";

                            $picture_vbanner = "<img src='".TemplateController::srcImg()."views/img/banners/vertical/".$value->picture_vbanner."' style='width:50px'>";

                            if($value->status_vbanner == 1){

                                $status_vbanner = "<span class='badge badge-success mr-1'>Visible</span>";

                            }else{

                                $status_vbanner = "<span class='badge badge-danger mr-1'>No Visible</span>";

                            }

                                        $actions = TemplateController::htmlClean($actions);

                        }

                        $name_product = $value->name_product;
                        $date_updated_vbanner = $value->date_updated_vbanner;


                        $dataJson.='{

                            "id_vbanner":"'.($start+$key+1).'",
                            "picture_vbanner":"'.$picture_vbanner.'",
                            "name_product":"'.$name_product.'",
                            "status_vbanner":"'.$status_vbanner.'",
                            "date_updated_vbanner":"'.$date_updated_vbanner.'",
                            "actions":"'.$actions.'"

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