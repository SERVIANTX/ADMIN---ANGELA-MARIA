<?php


    class CurlController{

        /*=============================================
            TODO: Peticiones a la API
        =============================================*/

        static public function request($url, $method, $fields){

            $api = 'http://api.angelamaria.com/';
            // $api = 'https://api.e-angelamaria.me/';


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $api.$url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => $method,
                    CURLOPT_POSTFIELDS => $fields,
                    CURLOPT_HTTPHEADER => array(
                    'Authorization: YJEntU7gJwbnqeukvXxnRgNzA3jg9Q'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $response = json_decode($response);
            return $response;

        }

        /*=============================================
            TODO: Peticiones al destino de archivos
        =============================================*/

        static public function requestFile($fields){

            $server = 'http://server.angelamaria.com/views/img/index.php';
            // $server = 'https://server.e-angelamaria.me/views/img/index.php';

            $curl = curl_init();

            curl_setopt_array($curl, array(
                /* CURLOPT_URL => 'https://e-angelamaria.me/views/img/index.php', */
                CURLOPT_URL => $server,
                /* CURLOPT_URL => 'https://server2.joseraulraul3.repl.co/views/img/index.php', */
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $fields,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: YJEntU7gJwbnqeukvXxnRgNzA3jg9Q'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return $response;

        }


    }

?>