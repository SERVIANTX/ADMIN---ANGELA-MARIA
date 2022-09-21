<?php

    require_once "../controllers/curl.controller.php";

    class DeleteController{

        public $idItem;
        public $table;
        public $suffix;
        public $token;

        public function dataDelete(){

            $security = explode("~",base64_decode($this->idItem));

            if($security[1] == $this->token){

                /*================================================================
                    TODO: Desactivar el registro
                ================================================================*/

                    $url = $this->table."?id=".$security[0]."&nameId=id_".$this->suffix."&token=".$this->token."&table=users&suffix=user";
                    $method = "PUT";
                    $fields = 'status_'.$this->suffix.'=1&date_updated_'.$this->suffix.'='.date("Y-m-d");

                    $response = CurlController::request($url, $method, $fields);

                    echo $response->status;

            }

        }

    }

    if(isset($_POST["idItem"])){

        $validate = new DeleteController();
        $validate -> idItem = $_POST["idItem"];
        $validate -> table = $_POST["table"];
        $validate -> suffix = $_POST["suffix"];
        $validate -> token = $_POST["token"];
        $validate -> dataDelete();

    }


?>