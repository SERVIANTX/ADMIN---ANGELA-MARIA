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

                $url = "users?select=id_user&linkTo=date_updated_user&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&filterTo=status_user&inTo=0";

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

                $select = "id_user,rol_user,picture_user,displayname_user,username_user,email_user,country_user,city_user,address_user,phone_user,date_updated_user,method_user,status_user";

                if(!empty($_POST['search']['value'])){

                    if(preg_match('/^[0-9A-Za-zñÑáéíóú ]{1,}$/',$_POST['search']['value'])){

                        $linkTo = ["displayname_user","username_user","email_user","date_updated_user"];

                        $search = str_replace(" ", "_", $_POST['search']['value']);

                        foreach($linkTo as $key => $value) {

                            $url = "users?select=".$select."&linkTo=".$value.",status_user&search=".$search.",0&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length;

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

                    $url = "users?select=".$select."&linkTo=date_updated_user&between1=".$_GET["between1"]."&between2=".$_GET["between2"]."&orderBy=".$orderBy."&orderMode=".$orderType."&startAt=".$start."&endAt=".$length."&filterTo=status_user&inTo=0";

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

                            $picture_user = $value->picture_user;
                            $rol_user = $value->rol_user;
                            $actions = "";

                            switch($value->status_user){
                                case "1":
                                    $status_user = "Activo";
                                    break;
                                case "0":
                                    $status_user = "Inactivo";
                                    break;
                            }

                            switch($value->rol_user){
                                case "admin":
                                    $rol_user = "Administrador";
                                    break;
                                case "repart":
                                    $rol_user = "Repartidor";
                                    break;
                            }

                        }else{

                            $picture_user = "<img src='".TemplateController::returnImg($value->id_user, $value->picture_user, $value->method_user)."' class='img-fluid changePicture rounded-circle img-thumbnail' style='width:70px'>";

                            if($value->status_user == 1){

                                $status_user = "<span class='badge badge-success mr-1'>Activo</span>";

                            }else{

                                $status_user = "<span class='badge badge-danger mr-1'>Inactivo</span>";

                            }

                            switch($value->rol_user){
                                case "admin":
                                    $rol_user = "<span class='badge badge-primary mr-1'><i class='bx bx-user-circle mr-1'></i> Administrador</span>";
                                    break;
                                case "repart":
                                    $rol_user = "<span class='badge badge-dark mr-1'><i class='bx bx-car mr-1'></i> Repartidor</span>";
                                    break;
                            }

                            $actions = "<a class='btn btn-outline-info-jrfd btn-sm rounded-circle infoAdmin mr-2' id_user='".$value->id_user."' rol_user='".$value->rol_user."' picture_user='".$value->picture_user."' displayname_user='".$value->displayname_user."' username_user='".$value->username_user."' email_user='".$value->email_user."' country_user='".$value->country_user."' city_user='".$value->city_user."' phone_user='".$value->phone_user."' address_user='".$value->address_user."' status_user='".$value->status_user."'>

                                            <i class='fas fa-eye'></i>

                                        </a>

                                        <a class='btn btn-warning-jrfd btn-sm rounded-circle mr-2 removeItem' idItem='".base64_encode($value->id_user."~".$_GET["token"])."' table='users' suffix='user' page='administradores'>

                                            <i class='bx bx-power-off'></i>

                                        </a>";

                            $actions = TemplateController::htmlClean($actions);


                        }

                        $displayname_user = $value->displayname_user;
                        $email_user = $value->email_user;
                        $country_user = $value->country_user;
                        $phone_user = $value->phone_user;
                        $date_updated_user = $value->date_updated_user;

                        $dataJson.='{

                            "id_user":"'.($start+$key+1).'",
                            "picture_user":"'.$picture_user.'",
                            "displayname_user":"'.$displayname_user.'",
                            "email_user":"'.$email_user.'",
                            "phone_user":"'.$phone_user.'",
                            "rol_user":"'.$rol_user.'",
                            "status_user":"'.$status_user.'",
                            "date_updated_user":"'.$date_updated_user.'",
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