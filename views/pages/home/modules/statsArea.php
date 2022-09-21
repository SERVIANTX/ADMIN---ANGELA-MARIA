<?php

    /*=====================================================================
        TODO: Total de Usuarios
    =====================================================================*/

    $url = "customers?select=id_customer";
    $method = "GET";
    $fields = array();
    $clientes = CurlController::request($url,$method,$fields);

    if($clientes->status == 200){

        $clientes = $clientes->total;

    }else{

        $clientes = 0;

    }

    /*=====================================================================
        TODO: Total de Suscriptores
    =====================================================================*/

    $url = "subscribers?select=id_subscriber";
    $method = "GET";
    $fields = array();
    $suscriptores = CurlController::request($url,$method,$fields);

    if($suscriptores->status == 200){

        $suscriptores = $suscriptores->total;

    }else{

        $suscriptores = 0;

    }

    /*=====================================================================
        TODO: Total de Ventas
    =====================================================================*/

    $url = "orders?select=id_order&linkTo=status_order&equalTo=3";
    $method = "GET";
    $fields = array();
    $ventas = CurlController::request($url,$method,$fields);

    if($ventas->status == 200){

        $ventas = $ventas->total;

    }else{

        $ventas = 0;

    }

    /*=====================================================================
        TODO: Total de Ordenes
    =====================================================================*/

    $url = "orders?select=id_order&linkTo=status_order&equalTo=0";
    $method = "GET";
    $fields = array();
    $ordenes = CurlController::request($url,$method,$fields);

    if($ordenes->status == 200){

        $ordenes = $ordenes->total;

    }else{

        $ordenes = 0;

    }

?>

<!-- Stats Area -->
<div class="ecommerce-stats-area">
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-md-6">
            <div class="single-stats-card-box">
                <div class="icon">
                    <i class='bx bxs-user-check'></i>
                </div>
                <span class="sub-title">Nuevos Usuarios</span>
                <h3><?php echo $clientes ?></h3>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-md-6">
            <div class="single-stats-card-box">
                <div class="icon">
                    <i class='bx bx-paper-plane'></i>
                </div>
                <span class="sub-title">Suscriptores Ganados</span>
                <h3><?php echo $suscriptores ?></h3>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-md-6">
            <div class="single-stats-card-box">
                <div class="icon">
                    <i class='bx bx-purchase-tag'></i>
                </div>
                <span class="sub-title">Ordenes Entragadas</span>
                <h3><?php echo $ventas ?></h3>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-md-6">
            <div class="single-stats-card-box">
                <div class="icon">
                    <i class='bx bx-shopping-bag'></i>
                </div>
                <span class="sub-title">Ordenes Recibidas</span>
                <h3><?php echo $ordenes ?></h3>
            </div>
        </div>
    </div>
</div>
<!-- End Stats Area -->