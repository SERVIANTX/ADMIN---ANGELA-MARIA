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

?>
<script type="text/javascript">
    function PrintDiv() {
    var divToPrint = document.getElementById('divToPrint');
    var popupWin = window.open('', '_blank', 'width=1290,height=850');
    popupWin.document.open();
    popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
</script>

<!-- Start Invoice -->
<div class="invoice-area mb-30">

    <form method="post">

        <?php

            require_once "controllers/enviar.controller.php";

            $create = new EnviarController();
            $create -> sendInvoice();

        ?>

        <?php foreach ($datos as $key => $value_data) : ?>

            <input type="hidden" name="emailCustomer" value="<?php echo $value_data->email_customer?>">

            <div class="invoice-header mb-30 d-flex justify-content-between">
                <div class="invoice-left-text">
                    <h3 class="mb-0">Angela Maria</h3>
                    <p class="mt-2 mb-0">JR. 1° DE MAYO, <br>Junin, <br>Jauja.</p>
                </div>

                <div class="invoice-right-text">
                    <h3 class="mb-0 text-uppercase">Boleta(Detalles de Compra)</h3>
                </div>
            </div>

            <div class="invoice-middle mb-30">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="text">
                            <h4 class="mb-2">Pagado por</h4>
                            <span class="d-block mb-1"><?php echo $value_data->displayname_customer?></span>
                            <span class="d-block mb-1"><?php echo $value_data->address_order?></span>
                            <span class="d-block"><?php echo $value_data->phone_order?></span>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="text">
                            <h4 class="mb-2">Enviado a</h4>
                            <span class="d-block mb-1"><?php echo $value_data->displayname_customer?></span>
                            <span class="d-block mb-1"><?php echo $value_data->address_order?></span>
                            <span class="d-block"><?php echo $value_data->phone_order?></span>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="text text-right">
                            <h5>N° de pedido <sub><?php echo $value_data->id_order?></sub></h5>
                            <h5>Fecha del Pedido <sub><?php echo $value_data->date_created_order?></sub></h5>
                        </div>
                    </div>
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

        <div class="invoice-btn-box text-right">
            <a href="https://pdf.e-angelamaria.me/?id=<?php echo base64_encode($security[0]); ?>"  target="_blank" class="default-btn" ><i class='bx bx-printer'></i> Imprimir</a>
        </div>

    </form>

</div>
<!-- End Invoice -->

