<?php

    /*=====================================================================
        TODO: Útlimas 5 órdenes
    =====================================================================*/

	$select =  "id_order,status_order,import_order,date_created_order,id_customer,displayname_customer,picture_customer,method_customer";
	$url = "relations?rel=orders,customers&type=order,customer&select=".$select."&orderBy=id_order&orderMode=DESC&startAt=0&endAt=5";
    $method = "GET";
    $fields = array();
	$orders = CurlController::request($url,$method,$fields);

	if($orders->status == 200){

		$orders = $orders->results;

	}else{

		$orders = array();

	}

    /*=====================================================================
        TODO: 3 productos más vendidos
    =====================================================================*/

    $select =  "name_product,price_product,name_brand,url_category,url_product,picture_product";

	$url = "relations?rel=products,brands,categories&type=product,brand,category&select=".$select."&linkTo=status_product&equalTo=1&orderBy=sales_product&orderMode=DESC&startAt=0&endAt=3";
	$products = CurlController::request($url,$method,$fields);

	if($products->status == 200){

		$products = $products->results;

	}else{

		$products = array();

	}


?>

<!-- Start -->
<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="card recent-orders-box mb-30">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Ordenes Recientes</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($orders as $key => $value): ?>

                                <tr>
                                    <td>#<?php echo $value->id_order ?></td>
                                    <td class="name"><img src="<?php echo TemplateController::returnImgCust($value->id_customer, $value->picture_customer, $value->method_customer); ?>" alt="image"> <?php echo $value->displayname_customer ?></td>
                                    <td><?php echo $value->date_created_order ?></td>
                                    <td>S/. <?php echo $value->import_order ?></td>
                                    <?php if ($value->status_order == 0): ?>
                                        <td><span class="badge badge-danger">No Asignado</span></td>
                                    <?php elseif ($value->status_order == 1): ?>
                                        <td><span class="badge badge-primary-JRF">Preparando el pédido</span></td>
                                    <?php elseif ($value->status_order == 2): ?>
                                        <td><span class="badge badge-success">Pedido en camino</span></td>
                                    <?php else: ?>
                                        <td><span class="badge badge-primary">Pedido entregado</span></td>
                                    <?php endif ?>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
        <div class="card top-rated-product-box mb-30">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Productos más vendidos</h3>
            </div>

            <div class="card-body">
                <ul>

                    <?php foreach ($products as $key => $valueProduct): ?>

                        <li class="single-product">
                            <a href="<?php echo TemplateController::pathEcommerce().$valueProduct->url_product ?>" target="_blank" class="image d-inline-block">
                                <img src="<?php echo TemplateController::srcImg()?>views/img/products/<?php echo $valueProduct->url_category."/".$valueProduct->picture_product ?>" alt="<?php echo $valueProduct->name_product ?>">
                            </a>
                            <h4 class="mb-2"><a href="<?php echo TemplateController::pathEcommerce().$valueProduct->url_product ?>" target="_blank" class="d-inline-block"><?php echo $valueProduct->name_product ?></a></h4>
                            <p class="mb-2">Marca: <?php echo $valueProduct->name_brand ?></p>
                            <div class="price mr-2 d-inline-block">S/. <?php echo $valueProduct->price_product ?></div>
                            <a href="<?php echo TemplateController::pathEcommerce().$valueProduct->url_product ?>" target="_blank" class="view-link d-inline-block" data-toggle="tooltip" data-placement="top" title="Ver Detalles"><i class='bx bxs-arrow-to-right'></i></a>
                        </li>

                    <?php endforeach; ?>

                </ul>
            </div>
        </div>
    </div>

</div>
<!-- End -->

