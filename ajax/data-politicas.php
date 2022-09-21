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

                $url = "pageviews?select=id_pageview&linkTo=date_updated_pageview&between1=".$_GET["between1"]."&between2=".$_GET["between2"];

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

                $select = "id_pageview,type_pageview,text_pageview,date_updated_pageview";

                if(!empty($_POST['search']['value'])){

                    if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                        $linkTo = ["type_pageview","date_updated_pageview"];

                        $search = str_replace(" ", "_", $_POST['search']['value']);

                        foreach($linkTo as $key => $value) {

                            $url = "pageviews?select=".$select."&linkTo=".$value."&search=".$search."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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

                    $url = "pageviews?select=".$select."&linkTo=date_updated_pageview&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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
                            $text_pageview = "";
                            $type_pageview = $value->type_pageview;

                        }else{

                            $actions = "<div class='btn-group'>

                                            <a href='/politicas/editar/".base64_encode($value->id_pageview."~".$_GET["token"])."' class='btn btn-warning-jrfd btn-sm mr-2 rounded-circle'>

                                                <i class='bx bx-edit-alt'></i>

                                            </a>

                                            <a href='".TemplateController::pathEcommerce().$value->type_pageview."' target='_blank' class='btn btn-outline-info-jrfd btn-sm rounded-circle mr-2'>

                                                <i class='fas fa-eye'></i>

                                            </a>

                                        </div>";

                            switch($value->type_pageview){
                                case "terminos-condiciones":
                                    $type_pageview = "Terminos Y Condiciones";
                                    break;
                                case "condiciones-de-promociones":
                                    $type_pageview = "Condiciones De Promociones";
                                    break;
                                case "politicas-de-privacidad":
                                    $type_pageview = "Politicas De Privacidad";
                                    break;
                            }


                            /*=====================================================
                                TODO: Descripción del Producto
                            =====================================================*/

                            $text2_pageview =  TemplateController::htmlClean($value->text_pageview);
                            $text2_pageview =  preg_replace("/\"/","'",$text2_pageview);

                            $actions = TemplateController::htmlClean($actions);


                        }

                        $date_updated_pageview = $value->date_updated_pageview;

                        $dataJson.='{

                            "id_pageview":"'.($start+$key+1).'",
                            "type_pageview":"'.$type_pageview.'",
                            "text_pageview":"'.$text2_pageview.'",
                            "date_updated_pageview":"'.$date_updated_pageview.'",
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