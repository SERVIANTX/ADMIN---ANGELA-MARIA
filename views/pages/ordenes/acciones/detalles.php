<?php

	if(isset($routesArray[3])){

		$security = explode("~",base64_decode($routesArray[3]));

		if($security[1] == $_SESSION["admin"]->token_user ){

			$select = "id_order,picture_product,name_product,quantity_orderdetail,price_orderdetail,subtotal_orderdetail";

			$url = "relations?rel=ordersdetails,products&type=orderdetail,product&select=*&linkTo=id_order&equalTo=".$security[0];
			$method = "GET";
			$fields = array();

			$response = CurlController::request($url, $method, $fields);
            $data = CurlController::request($url, $method, $fields)->results;

			if($response->status == 200){

				$detalles = $data;

			}else{

				echo '<script>

                        window.location = "/ordenes";

                    </script>';
			}

            $url = "relations?rel=orders,customers&type=order,customer&select=*&linkTo=id_order&equalTo=".$security[0];
			$method = "GET";
			$fields = array();

			$response = CurlController::request($url, $method, $fields);
            $data = CurlController::request($url, $method, $fields)->results;

			if($response->status == 200){

				$datos = $data;

			}else{

				echo '<script>

                        window.location = "/ordenes";

                    </script>';
			}

		}else{

			echo '<script>

                    window.location = "/ordenes";

				</script>';
			}

		}

        require ("views/assets/custom/template/date.php");

?>

<div class="row">

    <!-- Start Invoice -->
    <div class="col-lg-9">

        <div class="invoice-area mb-30">


            <?php foreach ($datos as $key => $value_data) : ?>

                <div class="invoice-header mb-30 d-flex justify-content-between">
                    <div class="invoice-left-text">
                        <h3 class="mb-0">Orden #<?php echo $value_data->id_order?></h3>
                        <p class="mt-2 mb-0"><br><br></p>
                    </div>

                    <div class="invoice-right-text">
                        <?php

                            setlocale(LC_ALL, 'es_PE');

                            $newDate = fechaEs($value_data->date_order);

                            switch($value_data->status_order){
                                case "0":
                                    echo "<span class='badge badge-danger mr-2'><i class='fas fa-user mr-1'></i> No Asignado</span>";
                                    break;
                                case "1":
                                    echo "<span class='badge badge-primary mr-2'><i class='bx bx-check-double mr-1'></i> Pedido confirmado</span>";
                                    break;
                                case "2":
                                    echo "<span class='badge badge-warning mr-2'><i class='fas fa-dolly mr-1'></i> Pedido en camino</span>";
                                    break;
                                case "3":
                                    echo "<span class='badge badge-success mr-2'><i class='bx bx-building-house mr-1'></i> Pedido entregado</span>";
                                    break;
                            }

                        ?>

                        <span class="badge badge-success mb-0 ml-1"><i class='bx bx-calendar mr-1'></i> <?php echo $newDate?></span>

                    </div>
                </div>

                <div class="invoice-middle mb-30">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="text">
                                <h4 class="mb-2">Nota</h4>
                                <span class="d-block mb-1"><?php echo $value_data->notes_order?></span>
                            </div>
                        </div>

                        <div class="col-lg-3">
                        </div>

                        <div class="col-lg-3">
                            <div class="text text-right">
                                <h4 class="mb-2">Forma de pago</h4>
                                    <?php if ($value_data->payment_order == 0 ) : ?>
                                        <span class="d-block mb-1">Mercado Pago</span>
                                    <?php else : ?>
                                        <span class="d-block mb-1">Paypal</span>
                                    <?php endif ; ?>
                            </div>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>


            <div class="invoice-table table-responsive mb-30">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Imagen</th>
                            <th>Descripción</th>
                            <th>Cantidad </th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                            <?php

                                $Total = 0;
                                $Idcontador = 0;

                                foreach ($detalles as $key => $value) :

                                    $Total = $Total + $value->subtotal_orderdetail;
                                    $Idcontador++;

                            ?>

                                <tr>
                                    <td><?php echo $Idcontador ?></td>

                                    <?php

                                            $url = "categories?select=url_category&linkTo=id_category&equalTo=".$value->id_category_product;
                                            $method = "GET";
                                            $fields = array();

                                            $responseCategory = CurlController::request($url, $method, $fields);
                                            $dataCategory = CurlController::request($url, $method, $fields)->results;

                                            if($responseCategory->status == 200){

                                                $datoCategory = $dataCategory;

                                            }else{

                                                echo '<script>

                                                        window.location = "/ordenes";

                                                    </script>';
                                            }

                                            foreach ($datoCategory as $key => $valueCategory) :

                                    ?>

                                    <td><img src='<?php echo TemplateController::srcImg() ?>/views/img/products/<?php echo $valueCategory->url_category ?>/<?php echo $value->picture_product ?>' style='width:70px'></td>

                                    <?php endforeach; ?>

                                    <td><?php echo $value->name_product ?></td>
                                    <td class="text-right"><?php echo $value->quantity_orderdetail ?></td>
                                    <td class="text-right">S/ <?php echo $value->price_orderdetail ?></td>
                                    <td class="text-right">S/ <?php echo $value->subtotal_orderdetail ?></td>
                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                        <tfoot>
                            <tr>
                            <th class="text-right" colspan="5">SubTotal</th>
                            <th class="text-right">S/ <?php echo $Total ?></th>
                            </tr>
                            <tr>
                            <th class="text-right" colspan="5">Costo de Envio</th>
                            <th class="text-right">S/ 3.00</th>
                            </tr>
                            <tr>
                            <th class="text-right" colspan="5">Total</th>
                            <th class="text-right">S/ <?php echo $value_data->import_order ?></th>
                            </tr>
                        </tfoot>

                </table>
            </div>

        </div>

    </div>
    <!-- End Invoice -->


    <!-- Details -->
    <div class="col-lg-3">

        <section class="profile-area">

            <!-- <div class="profile-header">

                <div class="user-profile-images">
                    <img src="views/assets/plugins/fiva/img/profile-banner2.jpg" class="cover-image" alt="image">

                    <div class="profile-image">
                        <img src="http://server.angelamaria.com/views/img/users/`+id_user+`/`+picture_user+`" alt="image">
                    </div>

                    <div class="user-profile-text">
                        <h3><mark>`+displayname_user+`</mark></h3>
                        <span class="d-block"><mark>Administrador</mark></span>
                    </div>
                </div>

                <div class="user-profile-nav">

                </div>

            </div>

            <br> -->


            <!-- Delivery Man -->
            <div class=" user-info-box">
                <br>

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Repartidor</h3>
                </div>

                <div class="card-body">
                    <ul class="list-unstyled mb-15">

                        <?php foreach ($datos as $key => $delivery) : ?>

                            <?php if ($delivery->status_order != 0 ) : ?>

                                <li class="d-flex">
                                    <i class="bx bx-car mr-2"></i>
                                    <span class="d-inline-block">Asignado</span>
                                </li>

                            <?php else : ?>

                                <li class="d-flex">
                                <i class="bx bx-car mr-2"></i>
                                    <span class="d-inline-block">No asignado</span>
                                </li>

                            <?php endif ; ?>

                        <?php endforeach; ?>

                    </ul>

                </div>
            </div>

            <?php foreach ($datos as $key => $value_customer) : ?>

                <!-- Customer -->
                <div class=" user-info-box">
                    <br>

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Cliente </h3>
                    </div>

                    <div class="card-body">

                        <ul class="list-unstyled mb-15">
                            <li class="d-flex">
                                <i class="bx bx-user mr-2"></i>
                                <span class="d-inline-block"><?php echo $value_customer->displayname_customer?></span>
                            </li>
                        </ul>

                    </div>
                </div>

                <!-- Info Customer -->
                <div class=" user-info-box">
                    <br>

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Información de contacto </h3>
                    </div>

                    <div class="card-body">

                        <ul class="list-unstyled mb-15">
                            <li class="d-flex">
                                <i class="bx bx-envelope mr-2"></i>
                                <span class="d-inline-block"><?php echo $value_customer->email_customer?></span>
                            </li>
                            <li class="d-flex">
                                <i class="bx bx-phone mr-2"></i>
                                <span class="d-inline-block"><?php echo $value_customer->phone_order?></span>
                            </li>
                        </ul>

                    </div>
                </div>

                <!-- Info Delivery -->
                <div class=" user-info-box">
                    <br>

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Información de entrega </h3>
                    </div>

                    <div class="card-body">

                        <ul class="list-unstyled mb-15">

                            <li class="d-flex">
                                <i class="bx bx-user mr-2"></i>
                                <span class="d-inline-block">Nombre : <?php echo $value_customer->displayname_customer?></span>
                            </li>

                            <li class="d-flex">
                                <i class="bx bx-phone mr-2"></i>
                                <span class="d-inline-block">Contacto : <?php echo $value_customer->phone_order?></span>
                            </li>

                            <li class="d-flex">
                                <i class="bx bx-building-house mr-2"></i>
                                <span class="d-inline-block">Dirección : <?php echo $value_customer->address_order?></span>
                            </li>

                        </ul>

                    </div>
                </div>

            <?php endforeach; ?>



        </section>

    </div>
    <!-- End Details -->

</div>