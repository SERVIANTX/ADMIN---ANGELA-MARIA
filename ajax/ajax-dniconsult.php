<?php

    $dni = $_REQUEST['dni'];
    $token = "3274aefe1f1d858ce16783744a5e7eb8";

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://apifacturacion.com/api-dni.php?dni='.$dni,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS  => array('token' => $token),
        CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
    ));

    $response = curl_exec($curl);


    curl_close($curl);

    $empresa = json_decode($response);

    if(isset($empresa->dni)){
        $datos = array(
            'dni' => $empresa->dni,
            'cliente' => $empresa->cliente,
    );

    echo json_encode($datos);

    }else{
        echo json_encode('error');
    }

?>