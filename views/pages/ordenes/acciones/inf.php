<?php
$dataneworder = 0;
$dataorderintransit = 0;
$datacompletorder = 0;

$url = "orders?select=status_order";
$method = "GET";
$fields = array();

$response = CurlController::request($url, $method, $fields);
$data = CurlController::request($url, $method, $fields)->results;

    if($response->status == 200){
        $datos = $data;
    foreach ($datos as $key => $value) {
        if($value->status_order == 0){
        $dataneworder++;
        }elseif($value->status_order == 2) {
            $dataorderintransit++;
        }elseif($value->status_order == 3) {
            $datacompletorder++;
        }
    }
    }
?>

<div class="ecommerce-stats-area">
    <div class="row">

        <div class="col-lg-4 col-sm-6 col-md-6">
            <div class="single-stats-card-box">
                <div class="icon">
                    <i class='bx bx-cart'></i>
                </div>
                <span class="sub-title">Pedidos nuevos</span>
                <h3><?php echo $dataneworder ?></h3>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-md-6">
            <div class="single-stats-card-box">
                <div class="icon">
                    <i class='bx bxs-car'></i>
                </div>
                <span class="sub-title">Pedidos en camino</span>
                <h3><?php echo $dataorderintransit ?></h3>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-md-6">
            <div class="single-stats-card-box ">
                <div class="icon">
                    <i class='bx bx-check'></i>
                </div>
                <span class="sub-title">Pedidos completados</span>
                <h3><?php echo $datacompletorder ?></h3>
            </div>
        </div>

    </div>
</div>