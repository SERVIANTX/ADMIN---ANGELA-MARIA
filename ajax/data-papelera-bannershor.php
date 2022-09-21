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

                $url = "relations?rel=horizontal_banners,products&type=hbanner,product&select=id_hbanner&linkTo=date_updated_hbanner&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&filterTo=status_hbanner&inTo=0";


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

                $select = "id_hbanner,picture_hbanner,name_product,status_hbanner,date_updated_hbanner";

                if(!empty($_POST['search']['value'])){

                    if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                        $linkTo = ["name_product","date_updated_hbanner"];

                        $search = str_replace(" ", "_", $_POST['search']['value']);

                        foreach($linkTo as $key => $value) {

                            $url = "relations?rel=horizontal_banners,products&type=hbanner,product&select=".$select."&linkTo=".$value.",status_hbanner&search=".$search.",0&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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

                    $url = "relations?rel=horizontal_banners,products&type=hbanner,product&select=".$select."&linkTo=date_updated_hbanner&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&filterTo=status_hbanner&inTo=0";

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
                            $picture_hbanner = $value->picture_hbanner;
                            if($value->status_hbanner == 1){

                                $status_hbanner = "Visible";

                            }else{

                                $status_hbanner = "No Visible";

                            }

                        }else{

                            $actions = "<a class='btn btn-warning-jrfd btn-sm rounded-circle mr-2 removeItem' idItem='".base64_encode($value->id_hbanner."~".$_GET["token"])."' table='horizontal_banners' suffix='hbanner' page='bannershor'>
                                            <i class='bx bx-power-off'></i>
                                        </a>";

                            $picture_hbanner = "<img src='".TemplateController::srcImg()."views/img/banners/horizontal/".$value->picture_hbanner."' style='width:500px'>";

                            if($value->status_hbanner == 1){

                                $status_hbanner = "<span class='badge badge-success mr-1'>Visible</span>";

                            }else{

                                $status_hbanner = "<span class='badge badge-danger mr-1'>No Visible</span>";

                            }

                                        $actions = TemplateController::htmlClean($actions);

                        }

                        $name_product = $value->name_product;
                        $date_updated_hbanner = $value->date_updated_hbanner;


                        $dataJson.='{

                            "id_hbanner":"'.($start+$key+1).'",
                            "picture_hbanner":"'.$picture_hbanner.'",
                            "name_product":"'.$name_product.'",
                            "status_hbanner":"'.$status_hbanner.'",
                            "date_updated_hbanner":"'.$date_updated_hbanner.'",
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