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

                $url = "brands?select=id_brand&linkTo=date_created_brand&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&filterTo=status_brand&inTo=1";

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

                $select = "id_brand,picture_brand,name_brand,url_brand,date_created_brand";

                if(!empty($_POST['search']['value'])){

                    if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                        $linkTo = ["name_brand","date_created_brand"];

                        $search = str_replace(" ", "_", $_POST['search']['value']);

                        foreach($linkTo as $key => $value) {

                            $url = "brands?select=".$select."&linkTo=".$value.",status_brand&search=".$search.",1&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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

                    $url = "brands?select=".$select."&linkTo=date_created_brand&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&filterTo=status_brand&inTo=1";

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

                            $picture_brand = $value->picture_brand;
                            $actions = "";

                        }else{

                            $picture_brand = "<img src='".TemplateController::srcImg()."views/img/brands/".$value->picture_brand."' class='img-fluid changePicture rounded-circle img-thumbnail' style='width:70px'>";

                            $actions = "<a href='/marcas/editar/".base64_encode($value->id_brand."~".$_GET["token"])."' class='btn btn-warning-jrfd btn-sm mr-2 rounded-circle'>

                                            <i class='bx bx-edit-alt'></i>

                                        </a>

                                        <a class='btn btn-outline-danger-jrfd btn-sm rounded-circle mr-2 removeItem' idItem='".base64_encode($value->id_brand."~".$_GET["token"])."' table='brands' suffix='brand' page='marcas'>

                                            <i class='bx bx-trash'></i>

                                        </a>";

                            $actions = TemplateController::htmlClean($actions);

                        }
                        $name_brand = $value->name_brand;
                        $url_brand = "<a href='".TemplateController::pathEcommerce().$value->url_brand."' target='_blank'>".TemplateController::pathEcommerce()."$value->url_brand</a>";
                        $date_created_brand = $value->date_created_brand;

                        $dataJson.='{

                            "id_brand":"'.($start+$key+1).'",
                            "picture_brand":"'.$picture_brand.'",
                            "name_brand":"'.$name_brand.'",
                            "url_brand":"'.$url_brand.'",
                            "date_created_brand":"'.$date_created_brand.'",
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