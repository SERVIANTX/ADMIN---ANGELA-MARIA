<?php

error_reporting(0);
    /*=====================================================================
        TODO: Total de Productos
    =====================================================================*/

    $url = "products?select=id_product";
    $method = "GET";
    $fields = array();
    $productos = CurlController::request($url,$method,$fields);

    if($productos->status == 200){

        $productos = $productos->total;

    }else{

        $productos = 0;

    }

    /*=====================================================================
        TODO: Total de ventas
    =====================================================================*/

    $url = "orders?select=id_order,date_created_order,import_order&linkTo=status_order&equalTo=3";
    $sales = CurlController::request($url,$method,$fields);
    $salesT = CurlController::request($url,$method,$fields);

    if($sales->status == 200){

        $sales = $sales->results;

    }else{

        $sales = array();

    }

    if($salesT->status == 200){

        $salesT = $salesT->total;

    }else{

        $salesT = 0;

    }

    $arrayDate = array();

    $sumSales = array();

    $salesIN = 0;

    foreach ($sales as $key => $value){

        //Sumamos el total de todas las ordenes
        $salesIN = $value->import_order + $salesIN;

        //Capturamos año y mes
        $date = substr($value->date_created_order, 0, 7);

        //Introducir fechas en un nuevo array
        array_push($arrayDate, $date);

        //Capturar las ventas que ocurrieron en dichas fechas
        $arraySales = array($date => $value->import_order);

        //Sumamos los pagos que ocurrieron el mismo mes
        foreach ($arraySales  as $index => $item) {

            $sumSales[$index] += $item;

        }

    }

    //Agrupar las fechas en un nuevo arreglo para que no se repitan
    $dateNoRepeat = array_unique($arrayDate);

?>

<!-- Start -->
<div class="row">
    <div class="col-lg-9 col-md-12">
        <div class="card mb-30">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Resumen de ingresos</h3>
            </div>

            <div class="card-body">
                <div class="revenue-summary-content">
                    <div class="d-sm-flex">
                        <div class="pr-4 border-right">
                            <p class="mb-1">Ingresos netos</p>
                            <h5 class="mb-0">
                                <span class="font-weight-bold">S/. <?php echo $salesIN ?></span>
                                <span class="primary-text">soles</span>
                            </h5>
                        </div>

                        <div class="px-4 border-right">
                            <p class="mb-1">N° de Ventas</p>
                            <h5 class="mb-0">
                                <span class="font-weight-bold"><?php echo $salesT ?></span>
                                <span class="danger-text">ventas</span>
                            </h5>
                        </div>
                    </div>
                </div>

                <div id="revenue-summary-chart" class="extra-margin"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-4">
        <div class="new-product-box">
            <div class="icon">
                <i class='bx bx-shopping-bag'></i>
            </div>
            Nuevos Productos
            <span class="sub-text d-block font-weight-bold"><?php echo $productos ?></span>
        </div>

        <div class="new-user-box">
            <div class="icon">
                <i class='bx bx-user-pin'></i>
            </div>
            Nuevos Usuarios
            <span class="sub-text d-block font-weight-bold"><?php echo $clientes ?></span>
        </div>

        <div class="upcoming-product-box">
            <div class="icon">
                <i class='bx bxs-offer'></i>
            </div>
            Productos en Oferta
            <span class="sub-text d-block font-weight-bold"><?php echo $totalOfertas ?></span>
        </div>
    </div>
</div>
<!-- End -->


<script>
    if(document.getElementById("revenue-summary-chart")){
            var options = {
                chart: {
                    height: 350,
                    type: 'area',
                },
                dataLabels: {
                    enabled: false
                },
                colors: ['#008FFB', '#18D2B7'],
                stroke: {
                    curve: 'smooth'
                },
                series: [{
                    name: 'Ventas mensuales',
                    data: [<?php foreach($dateNoRepeat as $key => $value){ echo "'".$sumSales[$value]."',"; } ?>]
                }],
                xaxis: {
                    categories: [<?php foreach ($dateNoRepeat as $key => $value) { echo "'".$value."',"; } ?>],
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                }
            }
            var chart = new ApexCharts(
                document.querySelector("#revenue-summary-chart"),
                options
            );
            chart.render();
        }
</script>