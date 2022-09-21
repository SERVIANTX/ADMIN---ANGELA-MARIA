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

                $url = "categories?select=id_category&linkTo=date_created_category&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&filterTo=status_category&inTo=1";

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

                $select = "id_category,picture_category,name_category,description_category,url_category,icon_category,views_category,date_created_category";

                if(!empty($_POST['search']['value'])){

                    if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                        $linkTo = ["name_category","description_category","date_created_category"];

                        $search = str_replace(" ", "_", $_POST['search']['value']);

                        foreach($linkTo as $key => $value) {

                            $url = "categories?select=".$select."&linkTo=".$value.",status_category&search=".$search.",1&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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

                    $url = "categories?select=".$select."&linkTo=date_created_category&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&filterTo=status_category&inTo=1";

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

                            $picture_category = $value->picture_category;
                            $icon_category = $value->icon_category;
                            $actions = "";

                        }else{

                            $picture_category = "<img src='".TemplateController::srcImg()."views/img/categories/".$value->picture_category."' class='img-thumbnail' style='width:70px'>";

                            $icon_category = "<i class='".$value->icon_category."'></i>";

                            $actions = "<a href='/categorias/editar/".base64_encode($value->id_category."~".$_GET["token"])."' class='btn btn-warning-jrfd btn-sm mr-2 rounded-circle'>

                                            <i class='bx bx-edit-alt'></i>

                                        </a>

                                        <a class='btn btn-outline-danger-jrfd btn-sm rounded-circle mr-2 removeItem' idItem='".base64_encode($value->id_category."~".$_GET["token"])."' table='categories' suffix='category' page='categorias'>

                                            <i class='bx bx-trash'></i>

                                        </a>";

                            $actions = TemplateController::htmlClean($actions);

                        }
                        $name_category = $value->name_category;
                        $url_category = "<a href='".TemplateController::pathEcommerce().$value->url_category."' target='_blank'>".TemplateController::pathEcommerce()."$value->url_category</a>";
                        $views_category = $value->views_category;
                        $date_created_category = $value->date_created_category;

                        $dataJson.='{

                            "id_category":"'.($start+$key+1).'",
                            "picture_category":"'.$picture_category.'",
                            "name_category":"'.$name_category.'",
                            "url_category":"'.$url_category.'",
                            "icon_category":"'.$icon_category.'",
                            "views_category":"'.$views_category.'",
                            "date_created_category":"'.$date_created_category.'",
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