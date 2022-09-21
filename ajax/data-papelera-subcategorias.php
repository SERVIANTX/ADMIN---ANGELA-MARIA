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

                $url = "relations?rel=subcategories,categories&type=subcategory,category&select=id_subcategory&linkTo=date_updated_subcategory&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&filterTo=status_subcategory&inTo=0";

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

                $select = "id_subcategory,name_subcategory,name_category,title_list_subcategory,url_subcategory,date_updated_subcategory";

                if(!empty($_POST['search']['value'])){

                    if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                        $linkTo = ["name_subcategory","name_category","date_updated_subcategory"];

                        $search = str_replace(" ", "_", $_POST['search']['value']);

                        foreach($linkTo as $key => $value) {

                            $url = "relations?rel=subcategories,categories&type=subcategory,category&select=".$select."&linkTo=".$value.",status_subcategory&search=".$search.",0&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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

                    $url = "relations?rel=subcategories,categories&type=subcategory,category&select=".$select."&linkTo=date_updated_subcategory&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&filterTo=status_subcategory&inTo=0";

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

                        }else{

                            $actions = "<a class='btn btn-warning-jrfd btn-sm rounded-circle mr-2 removeItem' idItem='".base64_encode($value->id_subcategory."~".$_GET["token"])."' table='subcategories' suffix='subcategory' page='subcategorias'><i class='bx bx-power-off'></i></a>";

                                        $actions = TemplateController::htmlClean($actions);

                        }

                        $name_subcategory = $value->name_subcategory;
                        $name_category = $value->name_category;
                        $title_list_subcategory = $value->title_list_subcategory;
                        $url_subcategory = "<a href='".TemplateController::pathEcommerce().$value->url_subcategory."' target='_blank'>".TemplateController::pathEcommerce()."$value->url_subcategory</a>";
                        $date_updated_subcategory = $value->date_updated_subcategory;

                        $dataJson.='{

                            "id_subcategory":"'.($start+$key+1).'",
                            "name_subcategory":"'.$name_subcategory.'",
                            "name_category":"'.$name_category.'",
                            "title_list_subcategory":"'.$title_list_subcategory.'",
                            "url_subcategory":"'.$url_subcategory.'",
                            "date_updated_subcategory":"'.$date_updated_subcategory.'",
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