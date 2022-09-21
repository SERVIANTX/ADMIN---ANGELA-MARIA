<?php

    require_once "vendor/autoload.php";
    use Mailgun\Mailgun;

    class EnviarController{

        public function create(){

            if(isset($_POST["txtde"])){

                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';

                /*================================================================
                    TODO: Validación de lado del servidor
                ================================================================*/

                /*=============================================
                    TODO: Validamos la sintaxis de los campos
                =============================================*/

                if( preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["txtde"] ) &&
                    preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["txtpara"] ) &&
                    preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["txtasunto"] )
                    ){

                        /*=============================================
                        TODO: Envio del mensaje
                        =============================================*/
                        $Mensaje = $_POST["descripcion-mensaje"];

                        $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                        $domain = "angelamaria.social";
                        $params = array(
                            'from'    => 'Angela Maria Minimarket <'.$_POST["txtde"].'@angelamaria.social>',
                            'to'      => $_POST["txtpara"],
                            'subject' => $_POST["txtasunto"],
                            'html'    => $Mensaje
                            );
                        # Make the call to the client.
                        $response = $mgClient->messages()->send($domain, $params);
                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncSweetAlert("success", "Se envio con éxito el mensaje.", "/correo");

                                    </script>';

                        }
                        else{

                            echo '<script>
        
                                    fncFormatInputs();
                                    matPreloader("off");
                                    fncSweetAlert("close", "", "");
        
                                </script>
        
                                <div class="alert alert-danger">Errores en la sintaxis de los campos</div>';
        
                        }
                }

        }

        public function sendInvoice(){

            if(isset($_POST["emailCustomer"])){

                echo '<script>

                        matPreloader("on");
                        fncSweetAlert("loading", "Loading...", "");

                    </script>';

                /*================================================================
                    TODO: Validación de lado del servidor
                ================================================================*/

                /*=============================================
                    TODO: Validamos la sintaxis de los campos
                =============================================*/

                if( preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailCustomer"] ) ){

                        /*=============================================
                        TODO: Envio del mensaje
                        =============================================*/
                        $Mensaje = file_get_contents('views/mails/a.php');

                        $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                        $domain = "angelamaria.social";
                        $params = array(
                            'from'    => 'Angela Maria Minimarket <info@angelamaria.social>',
                            'to'      => $_POST["emailCustomer"],
                            'subject' => "Factura",
                            'html'    => $Mensaje
                            );
                        # Make the call to the client.
                        $response = $mgClient->messages()->send($domain, $params);
                                echo '<script>

                                        fncFormatInputs();
                                        matPreloader("off");
                                        fncSweetAlert("close", "", "");
                                        fncSweetAlert("success", "Se envio con éxito la factura.", "/ordenes");

                                    </script>';

                        }
                        else{

                            echo '<script>

                                    fncFormatInputs();
                                    matPreloader("off");
                                    fncSweetAlert("close", "", "");

                                </script>

                                <div class="alert alert-danger">Errores en la sintaxis de los campos</div>';

                        }
                }

        }

        /*=====================================================
			TODO: Recuperar contraseña
		======================================================*/

		public function resetPassword(){

			if(isset($_POST["resetPassword"])){

				/*=====================================================
					TODO: Validamos la sintaxis de los campos
				======================================================*/

				if(preg_match( '/^[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["resetPassword"] )){

                    /*=============================================
                        TODO: facebook
                    =============================================*/

                    $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                    $method = "GET";
                    $fields = array();

                    $response = CurlController::request($url, $method, $fields);

                    if($response->status == 200){

                        $UrlFacebook = $response->results[0];

                    }else{

                        $UrlFacebook = "https://www.facebook.com/";
                    }

                    /*=============================================
                        TODO: instagram
                    =============================================*/

                    $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                    $method = "GET";
                    $fields = array();

                    $response = CurlController::request($url, $method, $fields);

                    if($response->status == 200){

                        $UrlInstagram = $response->results[0];

                    }else{

                        $UrlInstagram = "https://www.instagram.com/";
                    }

                    /*=============================================
                        TODO: whatsapp
                    =============================================*/

                    $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                    $method = "GET";
                    $fields = array();

                    $response = CurlController::request($url, $method, $fields);

                    if($response->status == 200){

                        $UrlWhatsapp = $response->results[0];

                    }else{

                        $UrlWhatsapp = "https://web.whatsapp.com/";
                    }

                    /*===================================================================
                        TODO: Preguntamos primero si el usuario está registrado
                    ====================================================================*/

                    $url = "users?linkTo=email_user&equalTo=".$_POST["resetPassword"]."&select=*";
                    $method = "GET";
                    $fields = array();

                    $user = CurlController::request($url, $method, $fields);

                    if($user->status == 200){

                        $url = "users?linkTo=status_user,email_user&equalTo=1,".$_POST["resetPassword"]."&select=*";
                        $method = "GET";
                        $fields = array();

                        $user = CurlController::request($url, $method, $fields);

                        if($user->status == 200){

                            if($user->results[0]->method_user == "direct"){

                                function genPassword($length){

                                    $password = "";
                                    $chain = "123456789abcdefghijklmnopqrstuvwxyz";

                                    $password = substr(str_shuffle($chain), 0, $length);

                                    return $password;

                                }

                                $newPassword = genPassword(11);

                                $crypt = crypt($newPassword, '$2a$07$azybxcags23425sdg23sdfhsd$');

                                /*===================================================================
                                    TODO: Actualizar contraseña en base de datos
                                ====================================================================*/

                                $url = "users?id=".$user->results[0]->id_user."&nameId=id_user&token=no&except=password_user";
                                $method = "PUT";
                                $fields =  "password_user=".$crypt;

                                $updatePassword = CurlController::request($url, $method, $fields);

                                if($updatePassword->status == 200){

                                    /*=============================================================
                                        TODO: Enviamos nueva contraseña al correo electrónico
                                    =============================================================*/

                                    $Mensaje = file_get_contents('views/mails/resetYourPassword.html');

                                    /* Parametros del Template a Remplazar */
                                    $Mensaje = str_replace("amPassword", $newPassword, $Mensaje);
                                    $Mensaje = str_replace("amDisplayname", $user->results[0]->displayname_user, $Mensaje);
                                    $Mensaje = str_replace("amUrl", TemplateController::path(), $Mensaje);
                                    $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                                    $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                                    $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);

                                    $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                                    $domain = "angelamaria.social";
                                    $params = array(
                                        'from'    => 'Angela Maria Minimarket <info@angelamaria.social>',
                                        'to'      => $user->results[0]->email_user,
                                        'subject' => 'Solicitar nueva contraseña',
                                        'html'    => $Mensaje
                                        );
                                    # Make the call to the client.
                                    $response = $mgClient->messages()->send($domain, $params);

                                    echo '<script>

                                            fncFormatInputs();
                                            fncNotie(1, "Su nueva contraseña ha sido enviada con éxito, por favor revise su bandeja de entrada de correo electrónico.");

                                        </script>';

                                }

                            }else{

                                echo '<script>

                                        fncFormatInputs();
                                        fncSweetAlert("error", "No se puede recuperar la contraseña porque te has registrado con '.$user->results[0]->method_user.'". "")

                                    </script>';

                            }

                        }else{

                            echo '<script>

                                    fncFormatInputs();
                                    fncSweetAlert("error", "Su cuenta ha sido desactivada. Por favor comunicarse con el administrador.", "")

                                </script>';

                        }

                    }else{

                        echo '<script>

                                fncFormatInputs();
                                fncSweetAlert("error", "El correo no existe en la base de datos.", "")

                            </script>';

                    }

                }else{

                    echo '<script>

                            fncFormatInputs();
                            fncNotie(3, "Errores en la sintaxis de los campos.");

                        </script>';

                }

            }

        }


        /*=====================================================
			TODO: Email de Ofertas - Marketing -> Clientes
		======================================================*/

		public function mailOfertasClientes(){

            if(isset($_POST["ofertaClientes"])){

                /*=====================================================================
                    TODO: Seleccionamos las últimas 5 ofertas
                =====================================================================*/

                $url = "relations?rel=products,categories&type=product,category&select=name_product,url_product,picture_product,price_product,productoffer_product,url_category";
                $method = "GET";
                $fields = array();
                $ofertasClientes = CurlController::request($url,$method,$fields);

                if($ofertasClientes->status == 200){

                    $ofertasClientes = $ofertasClientes->results;

                }else{

                    $ofertasClientes = array();

                }

                $tbody = "";

                foreach ($ofertasClientes as $key => $value) {

                    if ($value->productoffer_product != null){

                        if (json_decode($value->productoffer_product, true)[0] == "Discount"){

                            $price = $value->price_product;

                            $newP = $price - (json_decode($value->productoffer_product, true)[1] * $price / 100);
                            $newPrice = round($newP, 2);

                            $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                        <tbody>
                                            <tr>
                                                <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                    <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                        <tbody>
                                                            <tr>
                                                                <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                    <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center" class="container-padding">
                                                                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                    &nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="center" valign="middle">
                                                                                                    <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
                                                                                                    <table width="100" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:100px;max-width:100px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td align="center" valign="middle">
                                                                                                                    <a href="'. TemplateController::pathEcommerce() . $value->url_product .'" style="text-decoration:none;border:0px;"><img data-image="Product Img 1"
                                                                                                                            src="'. TemplateController::srcImg() .'views/img/products/'. $value->url_category . '/' . $value->picture_product .'"
                                                                                                                            alt="'. $value->name_product .'" border="0" width="100" style="display:inline-block!important;border:0;width:100px;max-width:100px;border-radius:8px;"></a>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="20" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:20px;max-width:20px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" height="20">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:300px;max-width:300px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Title"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    '. $value->name_product .'
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Qty"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    S/'. $newPrice .' <span style="color:red; text-decoration: line-through;">(S/'. $value->price_product .')</span></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="10" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:10px;max-width:10px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="90" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:90px;max-width:90px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    class="autoheight"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Price"
                                                                                                                data-font="Primary"
                                                                                                                align="right"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_product .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>';
                        }else {

                            $newPrice = json_decode($value->productoffer_product, true)[1];

                            $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                        <tbody>
                                            <tr>
                                                <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                    <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                        <tbody>
                                                            <tr>
                                                                <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                    <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center" class="container-padding">
                                                                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                    &nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="center" valign="middle">
                                                                                                    <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
                                                                                                    <table width="100" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:100px;max-width:100px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td align="center" valign="middle">
                                                                                                                    <a href="'. TemplateController::pathEcommerce() . $value->url_product .'" style="text-decoration:none;border:0px;"><img data-image="Product Img 1"
                                                                                                                            src="'. TemplateController::srcImg() .'views/img/products/'. $value->url_category . '/' . $value->picture_product .'"
                                                                                                                            alt="'. $value->name_product .'" border="0" width="100" style="display:inline-block!important;border:0;width:100px;max-width:100px;border-radius:8px;"></a>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="20" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:20px;max-width:20px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" height="20">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:300px;max-width:300px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Title"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    '. $value->name_product .'
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Qty"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    S/'. $newPrice .' <span style="color:red; text-decoration: line-through;">(S/'. $value->price_product .')</span></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="10" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:10px;max-width:10px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="90" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:90px;max-width:90px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    class="autoheight"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Price"
                                                                                                                data-font="Primary"
                                                                                                                align="right"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_product .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>';
                        }

                    }

                }

                /*=============================================
                    TODO: facebook
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlFacebook = $response->results[0];

                }else{

                    $UrlFacebook = "https://www.facebook.com/";
                }

                /*=============================================
                    TODO: instagram
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlInstagram = $response->results[0];

                }else{

                    $UrlInstagram = "https://www.instagram.com/";
                }

                /*=============================================
                    TODO: whatsapp
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlWhatsapp = $response->results[0];

                }else{

                    $UrlWhatsapp = "https://web.whatsapp.com/";
                }

                /*===================================================================
                    TODO: Preguntamos primero si el usuario está registrado
                ====================================================================*/

                $url = "customers?select=email_customer,displayname_customer&linkTo=status_customer&equalTo=1";
                $method = "GET";
                $fields = array();

                $data = CurlController::request($url, $method, $fields)->results;
                $data2 = CurlController::request($url, $method, $fields);

                if($data2->status == 200){

                    foreach($data as $key => $value_data){

                        $emailUser = $value_data->email_customer;

                            /*=============================================================
                                TODO: Enviamos nueva contraseña al correo electrónico
                            =============================================================*/

                            $Mensaje = file_get_contents('views/mails/ofertas.html');

                            /* Parametros del Template a Remplazar */
                            $Mensaje = str_replace("amDisplayname", $value_data->displayname_customer, $Mensaje);
                            $Mensaje = str_replace("amUrl", TemplateController::pathEcommerce(), $Mensaje);
                            $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amMensaje", "compra los mejores productos a precios bajos.", $Mensaje);
                            $Mensaje = str_replace('amDetalle', $tbody , $Mensaje);

                            $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                            $domain = "angelamaria.social";
                            $params = array(
                                'from'    => 'Angela Maria Minimarket <promotion@angelamaria.social>',
                                'to'      => $emailUser,
                                'subject' => 'Ofertas',
                                'html'    => $Mensaje
                                );
                            # Make the call to the client.
                            $response = $mgClient->messages()->send($domain, $params);
                    }

                            echo '<script>

                                    fncFormatInputs();
                                    fncSweetAlert("success", "Los correos se han enviado con exito.", "");

                                </script>';


                }else{

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("error", "No se puedo enviar.", "")

                        </script>';

                }

            }
        }

        /*=====================================================
			TODO: Email de Productos - Marketing -> Clientes
		======================================================*/

		public function mailOfertasProductosClientes(){

            if(isset($_POST["ofertaProductosClientes"])){

                /*=====================================================================
                    TODO: Seleccionamos las últimas 5 ofertas
                =====================================================================*/

                $url = "relations?rel=products,categories&type=product,category&select=name_product,status_product,url_product,picture_product,price_product,url_category&orderBy=id_product&orderMode=DESC&startAt=0&endAt=5";
                $method = "GET";
                $fields = array();
                $ofertasClientes = CurlController::request($url,$method,$fields);

                if($ofertasClientes->status == 200){

                    $ofertasClientes = $ofertasClientes->results;

                }else{

                    $ofertasClientes = array();

                }

                $tbody = "";

                foreach ($ofertasClientes as $key => $value) {

                    if ($value->status_product != 0){

                        $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                    <tbody>
                                        <tr>
                                            <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                    <tbody>
                                                        <tr>
                                                            <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center" class="container-padding">
                                                                                <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                &nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="center" valign="middle">
                                                                                                <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
                                                                                                <table width="100" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:100px;max-width:100px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td align="center" valign="middle">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_product .'" style="text-decoration:none;border:0px;"><img data-image="Product Img 1"
                                                                                                                        src="'. TemplateController::srcImg() .'views/img/products/'. $value->url_category . '/' . $value->picture_product .'"
                                                                                                                        alt="'. $value->name_product .'" border="0" width="100" style="display:inline-block!important;border:0;width:100px;max-width:100px;border-radius:8px;"></a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="20" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:20px;max-width:20px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="center" height="20">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:300px;max-width:300px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Title"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                '. $value->name_product .'
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Qty"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                S/'. $value->price_product .'</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="10" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:10px;max-width:10px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="90" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:90px;max-width:90px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                class="autoheight"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Price"
                                                                                                            data-font="Primary"
                                                                                                            align="right"
                                                                                                            valign="middle"
                                                                                                            class="center-text"
                                                                                                            style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                            contenteditable="true"
                                                                                                            data-gramm="false">
                                                                                                            <a href="'. TemplateController::pathEcommerce() . $value->url_product .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>';

                    }

                }

                /*=============================================
                    TODO: facebook
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlFacebook = $response->results[0];

                }else{

                    $UrlFacebook = "https://www.facebook.com/";
                }

                /*=============================================
                    TODO: instagram
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlInstagram = $response->results[0];

                }else{

                    $UrlInstagram = "https://www.instagram.com/";
                }

                /*=============================================
                    TODO: whatsapp
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlWhatsapp = $response->results[0];

                }else{

                    $UrlWhatsapp = "https://web.whatsapp.com/";
                }

                /*===================================================================
                    TODO: Preguntamos primero si el usuario está registrado
                ====================================================================*/

                $url = "customers?select=email_customer,displayname_customer&linkTo=status_customer&equalTo=1";
                $method = "GET";
                $fields = array();

                $data = CurlController::request($url, $method, $fields)->results;
                $data2 = CurlController::request($url, $method, $fields);

                if($data2->status == 200){

                    foreach($data as $key => $value_data){

                        $emailUser = $value_data->email_customer;

                            /*=============================================================
                                TODO: Enviamos nueva contraseña al correo electrónico
                            =============================================================*/

                            $Mensaje = file_get_contents('views/mails/ofertas.html');

                            /* Parametros del Template a Remplazar */
                            $Mensaje = str_replace("amDisplayname", $value_data->displayname_customer, $Mensaje);
                            $Mensaje = str_replace("amUrl", TemplateController::pathEcommerce(), $Mensaje);
                            $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amMensaje", "compra nuestros mejores productos a precios bajos.", $Mensaje);
                            $Mensaje = str_replace('amDetalle', $tbody , $Mensaje);

                            $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                            $domain = "angelamaria.social";
                            $params = array(
                                'from'    => 'Angela Maria Minimarket <promotion@angelamaria.social>',
                                'to'      => $emailUser,
                                'subject' => 'Ofertas',
                                'html'    => $Mensaje
                                );
                            # Make the call to the client.
                            $response = $mgClient->messages()->send($domain, $params);
                    }

                            echo '<script>

                                    fncFormatInputs();
                                    fncSweetAlert("success", "Los correos se han enviado con exito.", "");

                                </script>';


                }else{

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("error", "No se puedo enviar.", "")

                        </script>';

                }

            }
        }

        /*=====================================================
			TODO: Email de Marcas - Marketing -> Clientes
		======================================================*/

		public function mailMarcasProductosClientes(){

            if(isset($_POST["ofertaMarcasClientes"])){

                /*=====================================================================
                    TODO: Seleccionamos las últimas 5 marcas
                =====================================================================*/

                $url = "brands?select=id_brand,name_brand,url_brand,picture_brand,status_brand&orderBy=id_brand&orderMode=DESC&startAt=0&endAt=5";
                $method = "GET";
                $fields = array();
                $ofertasClientes = CurlController::request($url,$method,$fields);

                if($ofertasClientes->status == 200){

                    $ofertasClientes = $ofertasClientes->results;

                }else{

                    $ofertasClientes = array();

                }

                $tbody = "";

                foreach ($ofertasClientes as $key => $value) {

                    if ($value->status_brand != 0){

                        $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                    <tbody>
                                        <tr>
                                            <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                    <tbody>
                                                        <tr>
                                                            <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center" class="container-padding">
                                                                                <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                &nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="center" valign="middle">
                                                                                                <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
                                                                                                <table width="100" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:100px;max-width:100px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td align="center" valign="middle">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_brand .'" style="text-decoration:none;border:0px;"><img data-image="Product Img 1"
                                                                                                                        src="'. TemplateController::srcImg() .'views/img/brands/'. $value->picture_brand .'"
                                                                                                                        alt="'. $value->name_brand .'" border="0" width="100" style="display:inline-block!important;border:0;width:100px;max-width:100px;border-radius:8px;"></a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="20" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:20px;max-width:20px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="center" height="20">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:300px;max-width:300px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Title"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                '. $value->name_brand .'
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Qty"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_brand .'"> '. TemplateController::pathEcommerce() . $value->url_brand .' </a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="10" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:10px;max-width:10px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="90" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:90px;max-width:90px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                class="autoheight"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Price"
                                                                                                            data-font="Primary"
                                                                                                            align="right"
                                                                                                            valign="middle"
                                                                                                            class="center-text"
                                                                                                            style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                            contenteditable="true"
                                                                                                            data-gramm="false">
                                                                                                            <a href="'. TemplateController::pathEcommerce() . $value->url_brand .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>';

                    }

                }

                /*=============================================
                    TODO: facebook
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlFacebook = $response->results[0];

                }else{

                    $UrlFacebook = "https://www.facebook.com/";
                }

                /*=============================================
                    TODO: instagram
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlInstagram = $response->results[0];

                }else{

                    $UrlInstagram = "https://www.instagram.com/";
                }

                /*=============================================
                    TODO: whatsapp
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlWhatsapp = $response->results[0];

                }else{

                    $UrlWhatsapp = "https://web.whatsapp.com/";
                }

                /*===================================================================
                    TODO: Preguntamos primero si el usuario está registrado
                ====================================================================*/

                $url = "customers?select=email_customer,displayname_customer&linkTo=status_customer&equalTo=1";
                $method = "GET";
                $fields = array();

                $data = CurlController::request($url, $method, $fields)->results;
                $data2 = CurlController::request($url, $method, $fields);

                if($data2->status == 200){

                    foreach($data as $key => $value_data){

                        $emailUser = $value_data->email_customer;

                            /*=============================================================
                                TODO: Enviamos nueva contraseña al correo electrónico
                            =============================================================*/

                            $Mensaje = file_get_contents('views/mails/ofertas.html');

                            /* Parametros del Template a Remplazar */
                            $Mensaje = str_replace("amDisplayname", $value_data->displayname_customer, $Mensaje);
                            $Mensaje = str_replace("amUrl", TemplateController::pathEcommerce(), $Mensaje);
                            $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amMensaje", "conoce nuestras nuevas marcas.", $Mensaje);
                            $Mensaje = str_replace('amDetalle', $tbody , $Mensaje);

                            $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                            $domain = "angelamaria.social";
                            $params = array(
                                'from'    => 'Angela Maria Minimarket <promotion@angelamaria.social>',
                                'to'      => $emailUser,
                                'subject' => 'Ofertas',
                                'html'    => $Mensaje
                                );
                            # Make the call to the client.
                            $response = $mgClient->messages()->send($domain, $params);
                    }

                            echo '<script>

                                    fncFormatInputs();
                                    fncSweetAlert("success", "Los correos se han enviado con exito.", "");

                                </script>';


                }else{

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("error", "No se puedo enviar.", "")

                        </script>';

                }

            }
        }

        /*=====================================================
			TODO: Email de Categorias - Marketing -> Clientes
		======================================================*/

		public function mailCategoriasProductosClientes(){

            if(isset($_POST["ofertaCategoriasClientes"])){

                /*=====================================================================
                    TODO: Seleccionamos las últimas 5 marcas
                =====================================================================*/

                $url = "categories?select=id_category,name_category,url_category,picture_category,status_category&orderBy=id_category&orderMode=DESC&startAt=0&endAt=6";
                $method = "GET";
                $fields = array();
                $ofertasClientes = CurlController::request($url,$method,$fields);

                if($ofertasClientes->status == 200){

                    $ofertasClientes = $ofertasClientes->results;

                }else{

                    $ofertasClientes = array();

                }

                $tbody = "";

                foreach ($ofertasClientes as $key => $value) {

                    if ($value->status_category != 0){

                        $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                    <tbody>
                                        <tr>
                                            <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                    <tbody>
                                                        <tr>
                                                            <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center" class="container-padding">
                                                                                <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                &nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="center" valign="middle">
                                                                                                <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
                                                                                                <table width="100" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:100px;max-width:100px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td align="center" valign="middle">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_category .'" style="text-decoration:none;border:0px;"><img data-image="Product Img 1"
                                                                                                                        src="'. TemplateController::srcImg() .'views/img/categories/'. $value->picture_category .'"
                                                                                                                        alt="'. $value->name_category .'" border="0" width="100" style="display:inline-block!important;border:0;width:100px;max-width:100px;border-radius:8px;"></a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="20" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:20px;max-width:20px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="center" height="20">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:300px;max-width:300px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Title"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                '. $value->name_category .'
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Qty"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_category .'"> '. TemplateController::pathEcommerce() . $value->url_category .' </a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="10" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:10px;max-width:10px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="90" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:90px;max-width:90px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                class="autoheight"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Price"
                                                                                                            data-font="Primary"
                                                                                                            align="right"
                                                                                                            valign="middle"
                                                                                                            class="center-text"
                                                                                                            style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                            contenteditable="true"
                                                                                                            data-gramm="false">
                                                                                                            <a href="'. TemplateController::pathEcommerce() . $value->url_category .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>';

                    }

                }

                /*=============================================
                    TODO: facebook
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlFacebook = $response->results[0];

                }else{

                    $UrlFacebook = "https://www.facebook.com/";
                }

                /*=============================================
                    TODO: instagram
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlInstagram = $response->results[0];

                }else{

                    $UrlInstagram = "https://www.instagram.com/";
                }

                /*=============================================
                    TODO: whatsapp
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlWhatsapp = $response->results[0];

                }else{

                    $UrlWhatsapp = "https://web.whatsapp.com/";
                }

                /*===================================================================
                    TODO: Preguntamos primero si el usuario está registrado
                ====================================================================*/

                $url = "customers?select=email_customer,displayname_customer&linkTo=status_customer&equalTo=1";
                $method = "GET";
                $fields = array();

                $data = CurlController::request($url, $method, $fields)->results;
                $data2 = CurlController::request($url, $method, $fields);

                if($data2->status == 200){

                    foreach($data as $key => $value_data){

                        $emailUser = $value_data->email_customer;

                            /*=============================================================
                                TODO: Enviamos nueva contraseña al correo electrónico
                            =============================================================*/

                            $Mensaje = file_get_contents('views/mails/ofertas.html');

                            /* Parametros del Template a Remplazar */
                            $Mensaje = str_replace("amDisplayname", $value_data->displayname_customer, $Mensaje);
                            $Mensaje = str_replace("amUrl", TemplateController::pathEcommerce(), $Mensaje);
                            $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amMensaje", "conoce nuestras nuevas categorías.", $Mensaje);
                            $Mensaje = str_replace('amDetalle', $tbody , $Mensaje);

                            $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                            $domain = "angelamaria.social";
                            $params = array(
                                'from'    => 'Angela Maria Minimarket <promotion@angelamaria.social>',
                                'to'      => $emailUser,
                                'subject' => 'Ofertas',
                                'html'    => $Mensaje
                                );
                            # Make the call to the client.
                            $response = $mgClient->messages()->send($domain, $params);
                    }

                            echo '<script>

                                    fncFormatInputs();
                                    fncSweetAlert("success", "Los correos se han enviado con exito.", "");

                                </script>';


                }else{

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("error", "No se puedo enviar.", "")

                        </script>';

                }

            }
        }

        /*=====================================================
			TODO: Email de Sub-Categorias - Marketing -> Clientes
		======================================================*/

		public function mailSubcategoriasProductosClientes(){

            if(isset($_POST["ofertaSubcategoriasClientes"])){

                /*=====================================================================
                    TODO: Seleccionamos las últimas 10
                =====================================================================*/

                $url = "subcategories?select=id_subcategory,name_subcategory,url_subcategory,title_list_subcategory,status_subcategory&orderBy=id_subcategory&orderMode=DESC&startAt=0&endAt=6";
                $method = "GET";
                $fields = array();
                $ofertasClientes = CurlController::request($url,$method,$fields);

                if($ofertasClientes->status == 200){

                    $ofertasClientes = $ofertasClientes->results;

                }else{

                    $ofertasClientes = array();

                }

                $tbody = "";

                foreach ($ofertasClientes as $key => $value) {

                    if ($value->status_subcategory != 0){

                        $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                    <tbody>
                                        <tr>
                                            <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                    <tbody>
                                                        <tr>
                                                            <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center" class="container-padding">
                                                                                <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                &nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="center" valign="middle">
                                                                                                <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->

                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="600" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:600px;max-width:400px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Title"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                '. $value->name_subcategory .'
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Title"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                '. $value->title_list_subcategory .'
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Qty"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_subcategory .'"> '. TemplateController::pathEcommerce() . $value->url_subcategory .' </a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="10" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:10px;max-width:10px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="90" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:90px;max-width:90px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                class="autoheight"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Price"
                                                                                                            data-font="Primary"
                                                                                                            align="right"
                                                                                                            valign="middle"
                                                                                                            class="center-text"
                                                                                                            style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                            contenteditable="true"
                                                                                                            data-gramm="false">
                                                                                                            <a href="'. TemplateController::pathEcommerce() . $value->url_subcategory .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>';

                    }

                }

                /*=============================================
                    TODO: facebook
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlFacebook = $response->results[0];

                }else{

                    $UrlFacebook = "https://www.facebook.com/";
                }

                /*=============================================
                    TODO: instagram
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlInstagram = $response->results[0];

                }else{

                    $UrlInstagram = "https://www.instagram.com/";
                }

                /*=============================================
                    TODO: whatsapp
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlWhatsapp = $response->results[0];

                }else{

                    $UrlWhatsapp = "https://web.whatsapp.com/";
                }

                /*===================================================================
                    TODO: Preguntamos primero si el usuario está registrado
                ====================================================================*/

                $url = "customers?select=email_customer,displayname_customer&linkTo=status_customer&equalTo=1";
                $method = "GET";
                $fields = array();

                $data = CurlController::request($url, $method, $fields)->results;
                $data2 = CurlController::request($url, $method, $fields);

                if($data2->status == 200){

                    foreach($data as $key => $value_data){

                        $emailUser = $value_data->email_customer;

                            /*=============================================================
                                TODO: Enviamos nueva contraseña al correo electrónico
                            =============================================================*/

                            $Mensaje = file_get_contents('views/mails/ofertas.html');

                            /* Parametros del Template a Remplazar */
                            $Mensaje = str_replace("amDisplayname", $value_data->displayname_customer, $Mensaje);
                            $Mensaje = str_replace("amUrl", TemplateController::pathEcommerce(), $Mensaje);
                            $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amMensaje", "conoce nuestras nuevas sub-categorías.", $Mensaje);
                            $Mensaje = str_replace('amDetalle', $tbody , $Mensaje);

                            $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                            $domain = "angelamaria.social";
                            $params = array(
                                'from'    => 'Angela Maria Minimarket <promotion@angelamaria.social>',
                                'to'      => $emailUser,
                                'subject' => 'Ofertas',
                                'html'    => $Mensaje
                                );
                            # Make the call to the client.
                            $response = $mgClient->messages()->send($domain, $params);
                    }

                            echo '<script>

                                    fncFormatInputs();
                                    fncSweetAlert("success", "Los correos se han enviado con exito.", "");

                                </script>';


                }else{

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("error", "No se puedo enviar.", "")

                        </script>';

                }

            }
        }

        /*=====================================================
			TODO: Email de Festividades - Marketing -> Clientes
		======================================================*/

		public function mailFestividadesClientes(){

            if(isset($_POST["festividadesClientes"])){

                /*=====================================================================
                    TODO: Seleccionamos la festividad
                =====================================================================*/

                if($_POST["name-celeb"] == 1){
                    $mensajeFestividad = "celebramos el día del amor y la amistad.";
                }elseif($_POST["name-celeb"] == 2){
                    $mensajeFestividad = "celebramos el día de las super mamás.";
                }elseif($_POST["name-celeb"] == 3){
                    $mensajeFestividad = "celebramos el día de las super papás.";
                }elseif($_POST["name-celeb"] == 4){
                    $mensajeFestividad = "celebramos contigo las fiestas patrias.";
                }elseif($_POST["name-celeb"] == 5){
                    $mensajeFestividad = "celebramos contigo una feliz navidad.";
                }elseif($_POST["name-celeb"] == 6){
                    $mensajeFestividad = "celebramos contigo un próspero año nuevo.";
                }

                /*=====================================================================
                    TODO: Seleccionamos las últimas 5 ofertas
                =====================================================================*/

                $url = "relations?rel=products,categories&type=product,category&select=name_product,url_product,picture_product,price_product,productoffer_product,url_category";
                $method = "GET";
                $fields = array();
                $ofertasClientes = CurlController::request($url,$method,$fields);

                if($ofertasClientes->status == 200){

                    $ofertasClientes = $ofertasClientes->results;

                }else{

                    $ofertasClientes = array();

                }

                $tbody = "";

                foreach ($ofertasClientes as $key => $value) {

                    if ($value->productoffer_product != null){

                        if (json_decode($value->productoffer_product, true)[0] == "Discount"){

                            $price = $value->price_product;

                            $newP = $price - (json_decode($value->productoffer_product, true)[1] * $price / 100);
                            $newPrice = round($newP, 2);

                            $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                        <tbody>
                                            <tr>
                                                <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                    <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                        <tbody>
                                                            <tr>
                                                                <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                    <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center" class="container-padding">
                                                                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                    &nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="center" valign="middle">
                                                                                                    <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
                                                                                                    <table width="100" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:100px;max-width:100px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td align="center" valign="middle">
                                                                                                                    <a href="'. TemplateController::pathEcommerce() . $value->url_product .'" style="text-decoration:none;border:0px;"><img data-image="Product Img 1"
                                                                                                                            src="'. TemplateController::srcImg() .'views/img/products/'. $value->url_category . '/' . $value->picture_product .'"
                                                                                                                            alt="'. $value->name_product .'" border="0" width="100" style="display:inline-block!important;border:0;width:100px;max-width:100px;border-radius:8px;"></a>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="20" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:20px;max-width:20px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" height="20">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:300px;max-width:300px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Title"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    '. $value->name_product .'
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Qty"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    S/'. $newPrice .' <span style="color:red; text-decoration: line-through;">(S/'. $value->price_product .')</span></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="10" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:10px;max-width:10px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="90" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:90px;max-width:90px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    class="autoheight"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Price"
                                                                                                                data-font="Primary"
                                                                                                                align="right"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_product .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>';
                        }else {

                            $newPrice = json_decode($value->productoffer_product, true)[1];

                            $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                        <tbody>
                                            <tr>
                                                <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                    <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                        <tbody>
                                                            <tr>
                                                                <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                    <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center" class="container-padding">
                                                                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                    &nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="center" valign="middle">
                                                                                                    <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
                                                                                                    <table width="100" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:100px;max-width:100px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td align="center" valign="middle">
                                                                                                                    <a href="'. TemplateController::pathEcommerce() . $value->url_product .'" style="text-decoration:none;border:0px;"><img data-image="Product Img 1"
                                                                                                                            src="'. TemplateController::srcImg() .'views/img/products/'. $value->url_category . '/' . $value->picture_product .'"
                                                                                                                            alt="'. $value->name_product .'" border="0" width="100" style="display:inline-block!important;border:0;width:100px;max-width:100px;border-radius:8px;"></a>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="20" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:20px;max-width:20px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" height="20">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:300px;max-width:300px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Title"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    '. $value->name_product .'
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Qty"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    S/'. $newPrice .' <span style="color:red; text-decoration: line-through;">(S/'. $value->price_product .')</span></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="10" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:10px;max-width:10px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="90" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:90px;max-width:90px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    class="autoheight"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Price"
                                                                                                                data-font="Primary"
                                                                                                                align="right"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_product .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>';
                        }

                    }

                }

                /*=============================================
                    TODO: facebook
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlFacebook = $response->results[0];

                }else{

                    $UrlFacebook = "https://www.facebook.com/";
                }

                /*=============================================
                    TODO: instagram
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlInstagram = $response->results[0];

                }else{

                    $UrlInstagram = "https://www.instagram.com/";
                }

                /*=============================================
                    TODO: whatsapp
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlWhatsapp = $response->results[0];

                }else{

                    $UrlWhatsapp = "https://web.whatsapp.com/";
                }

                /*===================================================================
                    TODO: Preguntamos primero si el usuario está registrado
                ====================================================================*/

                $url = "customers?select=email_customer,displayname_customer&linkTo=status_customer&equalTo=1";
                $method = "GET";
                $fields = array();

                $data = CurlController::request($url, $method, $fields)->results;
                $data2 = CurlController::request($url, $method, $fields);

                if($data2->status == 200){

                    foreach($data as $key => $value_data){

                        $emailUser = $value_data->email_customer;

                            /*=============================================================
                                TODO: Enviamos nueva contraseña al correo electrónico
                            =============================================================*/

                            $Mensaje = file_get_contents('views/mails/ofertas.html');

                            /* Parametros del Template a Remplazar */
                            $Mensaje = str_replace("amDisplayname", $value_data->displayname_customer, $Mensaje);
                            $Mensaje = str_replace("amMensaje", $mensajeFestividad, $Mensaje);
                            $Mensaje = str_replace("amUrl", TemplateController::pathEcommerce(), $Mensaje);
                            $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace('amDetalle', $tbody , $Mensaje);

                            $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                            $domain = "angelamaria.social";
                            $params = array(
                                'from'    => 'Angela Maria Minimarket <promotion@angelamaria.social>',
                                'to'      => $emailUser,
                                'subject' => 'Ofertas',
                                'html'    => $Mensaje
                                );
                            # Make the call to the client.
                            $response = $mgClient->messages()->send($domain, $params);
                    }

                            echo '<script>

                                    fncFormatInputs();
                                    fncSweetAlert("success", "Los correos se han enviado con exito.", "");

                                </script>';


                }else{

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("error", "No se puedo enviar.", "")

                        </script>';

                }

            }
        }



        /*=====================================================
			TODO: Email de Ofertas - Marketing -> subscribers
		======================================================*/

		public function mailOfertasSubscribers(){

            if(isset($_POST["ofertaSubscribers"])){

                /*=====================================================================
                    TODO: Seleccionamos las últimas 5 ofertas
                =====================================================================*/

                $url = "relations?rel=products,categories&type=product,category&select=name_product,url_product,picture_product,price_product,productoffer_product,url_category";
                $method = "GET";
                $fields = array();
                $ofertasClientes = CurlController::request($url,$method,$fields);

                if($ofertasClientes->status == 200){

                    $ofertasClientes = $ofertasClientes->results;

                }else{

                    $ofertasClientes = array();

                }

                $tbody = "";

                foreach ($ofertasClientes as $key => $value) {

                    if ($value->productoffer_product != null){

                        if (json_decode($value->productoffer_product, true)[0] == "Discount"){

                            $price = $value->price_product;

                            $newP = $price - (json_decode($value->productoffer_product, true)[1] * $price / 100);
                            $newPrice = round($newP, 2);

                            $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                        <tbody>
                                            <tr>
                                                <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                    <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                        <tbody>
                                                            <tr>
                                                                <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                    <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center" class="container-padding">
                                                                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                    &nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="center" valign="middle">
                                                                                                    <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
                                                                                                    <table width="100" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:100px;max-width:100px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td align="center" valign="middle">
                                                                                                                    <a href="'. TemplateController::pathEcommerce() . $value->url_product .'" style="text-decoration:none;border:0px;"><img data-image="Product Img 1"
                                                                                                                            src="'. TemplateController::srcImg() .'views/img/products/'. $value->url_category . '/' . $value->picture_product .'"
                                                                                                                            alt="'. $value->name_product .'" border="0" width="100" style="display:inline-block!important;border:0;width:100px;max-width:100px;border-radius:8px;"></a>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="20" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:20px;max-width:20px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" height="20">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:300px;max-width:300px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Title"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    '. $value->name_product .'
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Qty"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    S/'. $newPrice .' <span style="color:red; text-decoration: line-through;">(S/'. $value->price_product .')</span></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="10" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:10px;max-width:10px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="90" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:90px;max-width:90px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    class="autoheight"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Price"
                                                                                                                data-font="Primary"
                                                                                                                align="right"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_product .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>';
                        }else {

                            $newPrice = json_decode($value->productoffer_product, true)[1];

                            $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                        <tbody>
                                            <tr>
                                                <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                    <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                        <tbody>
                                                            <tr>
                                                                <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                    <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center" class="container-padding">
                                                                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                    &nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="center" valign="middle">
                                                                                                    <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
                                                                                                    <table width="100" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:100px;max-width:100px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td align="center" valign="middle">
                                                                                                                    <a href="'. TemplateController::pathEcommerce() . $value->url_product .'" style="text-decoration:none;border:0px;"><img data-image="Product Img 1"
                                                                                                                            src="'. TemplateController::srcImg() .'views/img/products/'. $value->url_category . '/' . $value->picture_product .'"
                                                                                                                            alt="'. $value->name_product .'" border="0" width="100" style="display:inline-block!important;border:0;width:100px;max-width:100px;border-radius:8px;"></a>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="20" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:20px;max-width:20px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" height="20">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:300px;max-width:300px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Title"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    '. $value->name_product .'
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Qty"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    S/'. $newPrice .' <span style="color:red; text-decoration: line-through;">(S/'. $value->price_product .')</span></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="10" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:10px;max-width:10px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="90" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:90px;max-width:90px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    class="autoheight"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Price"
                                                                                                                data-font="Primary"
                                                                                                                align="right"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_product .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>';
                        }

                    }

                }

                /*=============================================
                    TODO: facebook
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlFacebook = $response->results[0];

                }else{

                    $UrlFacebook = "https://www.facebook.com/";
                }

                /*=============================================
                    TODO: instagram
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlInstagram = $response->results[0];

                }else{

                    $UrlInstagram = "https://www.instagram.com/";
                }

                /*=============================================
                    TODO: whatsapp
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlWhatsapp = $response->results[0];

                }else{

                    $UrlWhatsapp = "https://web.whatsapp.com/";
                }

                /*===================================================================
                    TODO: Preguntamos primero si está registrado
                ====================================================================*/

                $url = "subscribers?select=email_subscriber&linkTo=status_subscriber&equalTo=1";
                $method = "GET";
                $fields = array();

                $data = CurlController::request($url, $method, $fields)->results;
                $data2 = CurlController::request($url, $method, $fields);

                if($data2->status == 200){

                    foreach($data as $key => $value_data){

                        $emailUser = $value_data->email_subscriber;

                            /*=============================================================
                                TODO: Enviamos nueva contraseña al correo electrónico
                            =============================================================*/

                            $Mensaje = file_get_contents('views/mails/ofertasSubs.html');

                            /* Parametros del Template a Remplazar */
                            $Mensaje = str_replace("amUrl", TemplateController::pathEcommerce(), $Mensaje);
                            $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amMensaje", "compra los mejores productos a precios bajos.", $Mensaje);
                            $Mensaje = str_replace('amDetalle', $tbody , $Mensaje);

                            $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                            $domain = "angelamaria.social";
                            $params = array(
                                'from'    => 'Angela Maria Minimarket <promotion@angelamaria.social>',
                                'to'      => $emailUser,
                                'subject' => 'Ofertas',
                                'html'    => $Mensaje
                                );
                            # Make the call to the client.
                            $response = $mgClient->messages()->send($domain, $params);
                    }

                            echo '<script>

                                    fncFormatInputs();
                                    fncSweetAlert("success", "Los correos se han enviado con exito.", "");

                                </script>';


                }else{

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("error", "No se puedo enviar.", "")

                        </script>';

                }

            }
        }

        /*=====================================================
			TODO: Email de Productos - Marketing -> subscribers
		======================================================*/

		public function mailOfertasProductosSubscribers(){

            if(isset($_POST["ofertaProductosSubscribers"])){

                /*=====================================================================
                    TODO: Seleccionamos las últimas 5 ofertas
                =====================================================================*/

                $url = "relations?rel=products,categories&type=product,category&select=name_product,status_product,url_product,picture_product,price_product,url_category&orderBy=id_product&orderMode=DESC&startAt=0&endAt=5";
                $method = "GET";
                $fields = array();
                $ofertasClientes = CurlController::request($url,$method,$fields);

                if($ofertasClientes->status == 200){

                    $ofertasClientes = $ofertasClientes->results;

                }else{

                    $ofertasClientes = array();

                }

                $tbody = "";

                foreach ($ofertasClientes as $key => $value) {

                    if ($value->status_product != 0){

                        $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                    <tbody>
                                        <tr>
                                            <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                    <tbody>
                                                        <tr>
                                                            <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center" class="container-padding">
                                                                                <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                &nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="center" valign="middle">
                                                                                                <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
                                                                                                <table width="100" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:100px;max-width:100px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td align="center" valign="middle">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_product .'" style="text-decoration:none;border:0px;"><img data-image="Product Img 1"
                                                                                                                        src="'. TemplateController::srcImg() .'views/img/products/'. $value->url_category . '/' . $value->picture_product .'"
                                                                                                                        alt="'. $value->name_product .'" border="0" width="100" style="display:inline-block!important;border:0;width:100px;max-width:100px;border-radius:8px;"></a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="20" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:20px;max-width:20px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="center" height="20">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:300px;max-width:300px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Title"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                '. $value->name_product .'
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Qty"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                S/'. $value->price_product .'</td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="10" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:10px;max-width:10px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="90" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:90px;max-width:90px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                class="autoheight"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Price"
                                                                                                            data-font="Primary"
                                                                                                            align="right"
                                                                                                            valign="middle"
                                                                                                            class="center-text"
                                                                                                            style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                            contenteditable="true"
                                                                                                            data-gramm="false">
                                                                                                            <a href="'. TemplateController::pathEcommerce() . $value->url_product .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>';

                    }

                }

                /*=============================================
                    TODO: facebook
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlFacebook = $response->results[0];

                }else{

                    $UrlFacebook = "https://www.facebook.com/";
                }

                /*=============================================
                    TODO: instagram
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlInstagram = $response->results[0];

                }else{

                    $UrlInstagram = "https://www.instagram.com/";
                }

                /*=============================================
                    TODO: whatsapp
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlWhatsapp = $response->results[0];

                }else{

                    $UrlWhatsapp = "https://web.whatsapp.com/";
                }

                /*===================================================================
                    TODO: Preguntamos primero si el usuario está registrado
                ====================================================================*/

                $url = "subscribers?select=email_subscriber&linkTo=status_subscriber&equalTo=1";
                $method = "GET";
                $fields = array();

                $data = CurlController::request($url, $method, $fields)->results;
                $data2 = CurlController::request($url, $method, $fields);

                if($data2->status == 200){

                    foreach($data as $key => $value_data){

                        $emailUser = $value_data->email_subscriber;

                            /*=============================================================
                                TODO: Enviamos nueva contraseña al correo electrónico
                            =============================================================*/

                            $Mensaje = file_get_contents('views/mails/ofertasSubs.html');

                            /* Parametros del Template a Remplazar */
                            $Mensaje = str_replace("amUrl", TemplateController::pathEcommerce(), $Mensaje);
                            $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amMensaje", "compra nuestros mejores productos a precios bajos.", $Mensaje);
                            $Mensaje = str_replace('amDetalle', $tbody , $Mensaje);

                            $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                            $domain = "angelamaria.social";
                            $params = array(
                                'from'    => 'Angela Maria Minimarket <promotion@angelamaria.social>',
                                'to'      => $emailUser,
                                'subject' => 'Ofertas',
                                'html'    => $Mensaje
                                );
                            # Make the call to the client.
                            $response = $mgClient->messages()->send($domain, $params);
                    }

                            echo '<script>

                                    fncFormatInputs();
                                    fncSweetAlert("success", "Los correos se han enviado con exito.", "");

                                </script>';


                }else{

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("error", "No se puedo enviar.", "")

                        </script>';

                }

            }
        }

        /*=====================================================
			TODO: Email de Marcas - Marketing -> Subscribers
		======================================================*/

		public function mailMarcasProductosSubscribers(){

            if(isset($_POST["ofertaMarcasSubscribers"])){

                /*=====================================================================
                    TODO: Seleccionamos las últimas 5 marcas
                =====================================================================*/

                $url = "brands?select=id_brand,name_brand,url_brand,picture_brand,status_brand&orderBy=id_brand&orderMode=DESC&startAt=0&endAt=5";
                $method = "GET";
                $fields = array();
                $ofertasClientes = CurlController::request($url,$method,$fields);

                if($ofertasClientes->status == 200){

                    $ofertasClientes = $ofertasClientes->results;

                }else{

                    $ofertasClientes = array();

                }

                $tbody = "";

                foreach ($ofertasClientes as $key => $value) {

                    if ($value->status_brand != 0){

                        $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                    <tbody>
                                        <tr>
                                            <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                    <tbody>
                                                        <tr>
                                                            <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center" class="container-padding">
                                                                                <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                &nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="center" valign="middle">
                                                                                                <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
                                                                                                <table width="100" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:100px;max-width:100px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td align="center" valign="middle">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_brand .'" style="text-decoration:none;border:0px;"><img data-image="Product Img 1"
                                                                                                                        src="'. TemplateController::srcImg() .'views/img/brands/'. $value->picture_brand .'"
                                                                                                                        alt="'. $value->name_brand .'" border="0" width="100" style="display:inline-block!important;border:0;width:100px;max-width:100px;border-radius:8px;"></a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="20" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:20px;max-width:20px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="center" height="20">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:300px;max-width:300px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Title"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                '. $value->name_brand .'
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Qty"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_brand .'"> '. TemplateController::pathEcommerce() . $value->url_brand .' </a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="10" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:10px;max-width:10px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="90" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:90px;max-width:90px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                class="autoheight"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Price"
                                                                                                            data-font="Primary"
                                                                                                            align="right"
                                                                                                            valign="middle"
                                                                                                            class="center-text"
                                                                                                            style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                            contenteditable="true"
                                                                                                            data-gramm="false">
                                                                                                            <a href="'. TemplateController::pathEcommerce() . $value->url_brand .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>';

                    }

                }

                /*=============================================
                    TODO: facebook
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlFacebook = $response->results[0];

                }else{

                    $UrlFacebook = "https://www.facebook.com/";
                }

                /*=============================================
                    TODO: instagram
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlInstagram = $response->results[0];

                }else{

                    $UrlInstagram = "https://www.instagram.com/";
                }

                /*=============================================
                    TODO: whatsapp
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlWhatsapp = $response->results[0];

                }else{

                    $UrlWhatsapp = "https://web.whatsapp.com/";
                }

                /*===================================================================
                    TODO: Preguntamos primero si está registrado
                ====================================================================*/

                $url = "subscribers?select=email_subscriber&linkTo=status_subscriber&equalTo=1";
                $method = "GET";
                $fields = array();

                $data = CurlController::request($url, $method, $fields)->results;
                $data2 = CurlController::request($url, $method, $fields);

                if($data2->status == 200){

                    foreach($data as $key => $value_data){

                        $emailUser = $value_data->email_subscriber;

                            /*=============================================================
                                TODO: Enviamos nueva contraseña al correo electrónico
                            =============================================================*/

                            $Mensaje = file_get_contents('views/mails/ofertasSubs.html');

                            /* Parametros del Template a Remplazar */
                            $Mensaje = str_replace("amUrl", TemplateController::pathEcommerce(), $Mensaje);
                            $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amMensaje", "conoce nuestras nuevas marcas.", $Mensaje);
                            $Mensaje = str_replace('amDetalle', $tbody , $Mensaje);

                            $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                            $domain = "angelamaria.social";
                            $params = array(
                                'from'    => 'Angela Maria Minimarket <promotion@angelamaria.social>',
                                'to'      => $emailUser,
                                'subject' => 'Ofertas',
                                'html'    => $Mensaje
                                );
                            # Make the call to the client.
                            $response = $mgClient->messages()->send($domain, $params);
                    }

                            echo '<script>

                                    fncFormatInputs();
                                    fncSweetAlert("success", "Los correos se han enviado con exito.", "");

                                </script>';


                }else{

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("error", "No se puedo enviar.", "")

                        </script>';

                }

            }
        }

        /*=====================================================
			TODO: Email de Categorias - Marketing -> Subscribers
		======================================================*/

		public function mailCategoriasProductosSubscribers(){

            if(isset($_POST["ofertaCategoriasSubscribers"])){

                /*=====================================================================
                    TODO: Seleccionamos las últimas 5 marcas
                =====================================================================*/

                $url = "categories?select=id_category,name_category,url_category,picture_category,status_category&orderBy=id_category&orderMode=DESC&startAt=0&endAt=6";
                $method = "GET";
                $fields = array();
                $ofertasClientes = CurlController::request($url,$method,$fields);

                if($ofertasClientes->status == 200){

                    $ofertasClientes = $ofertasClientes->results;

                }else{

                    $ofertasClientes = array();

                }

                $tbody = "";

                foreach ($ofertasClientes as $key => $value) {

                    if ($value->status_category != 0){

                        $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                    <tbody>
                                        <tr>
                                            <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                    <tbody>
                                                        <tr>
                                                            <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center" class="container-padding">
                                                                                <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                &nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="center" valign="middle">
                                                                                                <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
                                                                                                <table width="100" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:100px;max-width:100px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td align="center" valign="middle">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_category .'" style="text-decoration:none;border:0px;"><img data-image="Product Img 1"
                                                                                                                        src="'. TemplateController::srcImg() .'views/img/categories/'. $value->picture_category .'"
                                                                                                                        alt="'. $value->name_category .'" border="0" width="100" style="display:inline-block!important;border:0;width:100px;max-width:100px;border-radius:8px;"></a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="20" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:20px;max-width:20px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="center" height="20">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:300px;max-width:300px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Title"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                '. $value->name_category .'
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Qty"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_category .'"> '. TemplateController::pathEcommerce() . $value->url_category .' </a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="10" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:10px;max-width:10px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="90" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:90px;max-width:90px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                class="autoheight"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Price"
                                                                                                            data-font="Primary"
                                                                                                            align="right"
                                                                                                            valign="middle"
                                                                                                            class="center-text"
                                                                                                            style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                            contenteditable="true"
                                                                                                            data-gramm="false">
                                                                                                            <a href="'. TemplateController::pathEcommerce() . $value->url_category .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>';

                    }

                }

                /*=============================================
                    TODO: facebook
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlFacebook = $response->results[0];

                }else{

                    $UrlFacebook = "https://www.facebook.com/";
                }

                /*=============================================
                    TODO: instagram
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlInstagram = $response->results[0];

                }else{

                    $UrlInstagram = "https://www.instagram.com/";
                }

                /*=============================================
                    TODO: whatsapp
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlWhatsapp = $response->results[0];

                }else{

                    $UrlWhatsapp = "https://web.whatsapp.com/";
                }

                /*===================================================================
                    TODO: Preguntamos primero si el usuario está registrado
                ====================================================================*/

                $url = "subscribers?select=email_subscriber&linkTo=status_subscriber&equalTo=1";
                $method = "GET";
                $fields = array();

                $data = CurlController::request($url, $method, $fields)->results;
                $data2 = CurlController::request($url, $method, $fields);

                if($data2->status == 200){

                    foreach($data as $key => $value_data){

                        $emailUser = $value_data->email_subscriber;

                            /*=============================================================
                                TODO: Enviamos nueva contraseña al correo electrónico
                            =============================================================*/

                            $Mensaje = file_get_contents('views/mails/ofertasSubs.html');

                            /* Parametros del Template a Remplazar */
                            $Mensaje = str_replace("amUrl", TemplateController::pathEcommerce(), $Mensaje);
                            $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amMensaje", "conoce nuestras nuevas categorías.", $Mensaje);
                            $Mensaje = str_replace('amDetalle', $tbody , $Mensaje);

                            $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                            $domain = "angelamaria.social";
                            $params = array(
                                'from'    => 'Angela Maria Minimarket <promotion@angelamaria.social>',
                                'to'      => $emailUser,
                                'subject' => 'Ofertas',
                                'html'    => $Mensaje
                                );
                            # Make the call to the client.
                            $response = $mgClient->messages()->send($domain, $params);
                    }

                            echo '<script>

                                    fncFormatInputs();
                                    fncSweetAlert("success", "Los correos se han enviado con exito.", "");

                                </script>';


                }else{

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("error", "No se puedo enviar.", "")

                        </script>';

                }

            }
        }

        /*=====================================================
			TODO: Email de Sub-Categorias - Marketing -> Subscribers
		======================================================*/

		public function mailSubcategoriasProductosSubscribers(){

            if(isset($_POST["ofertaSubcategoriasSubscribers"])){

                /*=====================================================================
                    TODO: Seleccionamos las últimas 10
                =====================================================================*/

                $url = "subcategories?select=id_subcategory,name_subcategory,url_subcategory,title_list_subcategory,status_subcategory&orderBy=id_subcategory&orderMode=DESC&startAt=0&endAt=6";
                $method = "GET";
                $fields = array();
                $ofertasClientes = CurlController::request($url,$method,$fields);

                if($ofertasClientes->status == 200){

                    $ofertasClientes = $ofertasClientes->results;

                }else{

                    $ofertasClientes = array();

                }

                $tbody = "";

                foreach ($ofertasClientes as $key => $value) {

                    if ($value->status_subcategory != 0){

                        $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                    <tbody>
                                        <tr>
                                            <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                    <tbody>
                                                        <tr>
                                                            <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center" class="container-padding">
                                                                                <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                &nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td align="center" valign="middle">
                                                                                                <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->

                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="600" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:600px;max-width:400px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Title"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                '. $value->name_subcategory .'
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Title"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                '. $value->title_list_subcategory .'
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Qty"
                                                                                                                data-font="Primary"
                                                                                                                align="left"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_subcategory .'"> '. TemplateController::pathEcommerce() . $value->url_subcategory .' </a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="10" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:10px;max-width:10px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                <table width="90" border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0" align="left"
                                                                                                    class="row"
                                                                                                    style="width:90px;max-width:90px;">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td valign="middle"
                                                                                                                align="center"
                                                                                                                class="autoheight"
                                                                                                                height="10">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td data-text="Product Price"
                                                                                                            data-font="Primary"
                                                                                                            align="right"
                                                                                                            valign="middle"
                                                                                                            class="center-text"
                                                                                                            style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                            contenteditable="true"
                                                                                                            data-gramm="false">
                                                                                                            <a href="'. TemplateController::pathEcommerce() . $value->url_subcategory .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                    class="ui-resizable-handle ui-resizable-s"
                                                                                                    style="z-index: 90;"></div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>';

                    }

                }

                /*=============================================
                    TODO: facebook
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlFacebook = $response->results[0];

                }else{

                    $UrlFacebook = "https://www.facebook.com/";
                }

                /*=============================================
                    TODO: instagram
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlInstagram = $response->results[0];

                }else{

                    $UrlInstagram = "https://www.instagram.com/";
                }

                /*=============================================
                    TODO: whatsapp
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlWhatsapp = $response->results[0];

                }else{

                    $UrlWhatsapp = "https://web.whatsapp.com/";
                }

                /*===================================================================
                    TODO: Preguntamos primero si el usuario está registrado
                ====================================================================*/

                $url = "subscribers?select=email_subscriber&linkTo=status_subscriber&equalTo=1";
                $method = "GET";
                $fields = array();

                $data = CurlController::request($url, $method, $fields)->results;
                $data2 = CurlController::request($url, $method, $fields);

                if($data2->status == 200){

                    foreach($data as $key => $value_data){

                        $emailUser = $value_data->email_subscriber;

                            /*=============================================================
                                TODO: Enviamos nueva contraseña al correo electrónico
                            =============================================================*/

                            $Mensaje = file_get_contents('views/mails/ofertasSubs.html');

                            /* Parametros del Template a Remplazar */
                            $Mensaje = str_replace("amUrl", TemplateController::pathEcommerce(), $Mensaje);
                            $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amMensaje", "conoce nuestras nuevas sub-categorías.", $Mensaje);
                            $Mensaje = str_replace('amDetalle', $tbody , $Mensaje);

                            $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                            $domain = "angelamaria.social";
                            $params = array(
                                'from'    => 'Angela Maria Minimarket <promotion@angelamaria.social>',
                                'to'      => $emailUser,
                                'subject' => 'Ofertas',
                                'html'    => $Mensaje
                                );
                            # Make the call to the client.
                            $response = $mgClient->messages()->send($domain, $params);
                    }

                            echo '<script>

                                    fncFormatInputs();
                                    fncSweetAlert("success", "Los correos se han enviado con exito.", "");

                                </script>';


                }else{

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("error", "No se puedo enviar.", "")

                        </script>';

                }

            }
        }

        /*=====================================================
			TODO: Email de Festividades - Marketing -> Subscribers
		======================================================*/

		public function mailFestividadesSubscribers(){

            if(isset($_POST["festividadesSubscribers"])){

                /*=====================================================================
                    TODO: Seleccionamos la festividad
                =====================================================================*/

                if($_POST["name-celeb"] == 1){
                    $mensajeFestividad = "celebramos el día del amor y la amistad.";
                }elseif($_POST["name-celeb"] == 2){
                    $mensajeFestividad = "celebramos el día de las super mamás.";
                }elseif($_POST["name-celeb"] == 3){
                    $mensajeFestividad = "celebramos el día de las super papás.";
                }elseif($_POST["name-celeb"] == 4){
                    $mensajeFestividad = "celebramos contigo las fiestas patrias.";
                }elseif($_POST["name-celeb"] == 5){
                    $mensajeFestividad = "celebramos contigo una feliz navidad.";
                }elseif($_POST["name-celeb"] == 6){
                    $mensajeFestividad = "celebramos contigo un próspero año nuevo.";
                }

                /*=====================================================================
                    TODO: Seleccionamos las últimas 5 ofertas
                =====================================================================*/

                $url = "relations?rel=products,categories&type=product,category&select=name_product,url_product,picture_product,price_product,productoffer_product,url_category";
                $method = "GET";
                $fields = array();
                $ofertasClientes = CurlController::request($url,$method,$fields);

                if($ofertasClientes->status == 200){

                    $ofertasClientes = $ofertasClientes->results;

                }else{

                    $ofertasClientes = array();

                }

                $tbody = "";

                foreach ($ofertasClientes as $key => $value) {

                    if ($value->productoffer_product != null){

                        if (json_decode($value->productoffer_product, true)[0] == "Discount"){

                            $price = $value->price_product;

                            $newP = $price - (json_decode($value->productoffer_product, true)[1] * $price / 100);
                            $newPrice = round($newP, 2);

                            $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                        <tbody>
                                            <tr>
                                                <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                    <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                        <tbody>
                                                            <tr>
                                                                <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                    <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center" class="container-padding">
                                                                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                    &nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="center" valign="middle">
                                                                                                    <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
                                                                                                    <table width="100" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:100px;max-width:100px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td align="center" valign="middle">
                                                                                                                    <a href="'. TemplateController::pathEcommerce() . $value->url_product .'" style="text-decoration:none;border:0px;"><img data-image="Product Img 1"
                                                                                                                            src="'. TemplateController::srcImg() .'views/img/products/'. $value->url_category . '/' . $value->picture_product .'"
                                                                                                                            alt="'. $value->name_product .'" border="0" width="100" style="display:inline-block!important;border:0;width:100px;max-width:100px;border-radius:8px;"></a>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="20" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:20px;max-width:20px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" height="20">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:300px;max-width:300px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Title"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    '. $value->name_product .'
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Qty"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    S/'. $newPrice .' <span style="color:red; text-decoration: line-through;">(S/'. $value->price_product .')</span></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="10" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:10px;max-width:10px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="90" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:90px;max-width:90px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    class="autoheight"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Price"
                                                                                                                data-font="Primary"
                                                                                                                align="right"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_product .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>';
                        }else {

                            $newPrice = json_decode($value->productoffer_product, true)[1];

                            $tbody.= '<table data-group="Contents" data-module="Content 4" data-thumbnail="https://editor.maool.com/images/starto/thumbnails/content-4.png" border="0" width="100%" align="center" cellpadding="0" cellspacing="0" style="width:100%;max-width:100%;">
                                        <tbody>
                                            <tr>
                                                <td data-bgcolor="Outer Bgcolor" align="center" valign="middle" bgcolor="#F1F1F1" style="background-color: #F1F1F1;">
                                                    <table border="0" width="600" align="center" cellpadding="0" cellspacing="0" class="row" style="width:600px;max-width:600px;">
                                                        <tbody>
                                                            <tr>
                                                                <td data-bgcolor="Inner Bgcolor" align="center" bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
                                                                    <table border="0" width="520" align="center" cellpadding="0" cellspacing="0" class="row" style="width:520px;max-width:520px;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center" class="container-padding">
                                                                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center" style="width:100%; max-width:100%;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="spacer-first ui-resizable">
                                                                                                    &nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td align="center" valign="middle">
                                                                                                    <!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
                                                                                                    <table width="100" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:100px;max-width:100px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td align="center" valign="middle">
                                                                                                                    <a href="'. TemplateController::pathEcommerce() . $value->url_product .'" style="text-decoration:none;border:0px;"><img data-image="Product Img 1"
                                                                                                                            src="'. TemplateController::srcImg() .'views/img/products/'. $value->url_category . '/' . $value->picture_product .'"
                                                                                                                            alt="'. $value->name_product .'" border="0" width="100" style="display:inline-block!important;border:0;width:100px;max-width:100px;border-radius:8px;"></a>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="20" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:20px;max-width:20px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" height="20">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="300" border="0" cellpadding="0" cellspacing="0" align="left" class="row" style="width:300px;max-width:300px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle" align="center" class="autoheight" height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Title"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:18px;line-height:28px;font-weight:600;letter-spacing:0px;padding:0px;padding-bottom:5px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    '. $value->name_product .'
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Qty"
                                                                                                                    data-font="Primary"
                                                                                                                    align="left"
                                                                                                                    valign="middle"
                                                                                                                    class="center-text"
                                                                                                                    style="font-family:&#39;Poppins&#39;, sans-serif;color:#595959;font-size:16px;line-height:26px;font-weight:400;letter-spacing:0px;"
                                                                                                                    contenteditable="true"
                                                                                                                    data-gramm="false">
                                                                                                                    S/'. $newPrice .' <span style="color:red; text-decoration: line-through;">(S/'. $value->price_product .')</span></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="10" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:10px;max-width:10px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
                                                                                                    <table width="90" border="0"
                                                                                                        cellpadding="0"
                                                                                                        cellspacing="0" align="left"
                                                                                                        class="row"
                                                                                                        style="width:90px;max-width:90px;">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td valign="middle"
                                                                                                                    align="center"
                                                                                                                    class="autoheight"
                                                                                                                    height="10">
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td data-text="Product Price"
                                                                                                                data-font="Primary"
                                                                                                                align="right"
                                                                                                                valign="middle"
                                                                                                                class="center-text"
                                                                                                                style="font-family:&#39;Poppins&#39;, sans-serif;color:#191919;font-size:20px;line-height:30px;font-weight:600;letter-spacing:0px;"
                                                                                                                contenteditable="true"
                                                                                                                data-gramm="false">
                                                                                                                <a href="'. TemplateController::pathEcommerce() . $value->url_product .'"><img class="imgEco" src="https://img.icons8.com/color/48/000000/shopping-basket.png"/></a></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td data-resizable-height="" style="font-size:15px;height:15px;line-height:15px;" class="ui-resizable">&nbsp;<div
                                                                                                        class="ui-resizable-handle ui-resizable-s"
                                                                                                        style="z-index: 90;"></div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>';
                        }

                    }

                }

                /*=============================================
                    TODO: facebook
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlFacebook = $response->results[0];

                }else{

                    $UrlFacebook = "https://www.facebook.com/";
                }

                /*=============================================
                    TODO: instagram
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlInstagram = $response->results[0];

                }else{

                    $UrlInstagram = "https://www.instagram.com/";
                }

                /*=============================================
                    TODO: whatsapp
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlWhatsapp = $response->results[0];

                }else{

                    $UrlWhatsapp = "https://web.whatsapp.com/";
                }

                /*===================================================================
                    TODO: Preguntamos primero si el usuario está registrado
                ====================================================================*/

                $url = "subscribers?select=email_subscriber&linkTo=status_subscriber&equalTo=1";
                $method = "GET";
                $fields = array();

                $data = CurlController::request($url, $method, $fields)->results;
                $data2 = CurlController::request($url, $method, $fields);

                if($data2->status == 200){

                    foreach($data as $key => $value_data){

                        $emailUser = $value_data->email_subscriber;

                            /*=============================================================
                                TODO: Enviamos nueva contraseña al correo electrónico
                            =============================================================*/

                            $Mensaje = file_get_contents('views/mails/ofertasSubs.html');

                            /* Parametros del Template a Remplazar */
                            $Mensaje = str_replace("amMensaje", $mensajeFestividad, $Mensaje);
                            $Mensaje = str_replace("amUrl", TemplateController::pathEcommerce(), $Mensaje);
                            $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);
                            $Mensaje = str_replace('amDetalle', $tbody , $Mensaje);

                            $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                            $domain = "angelamaria.social";
                            $params = array(
                                'from'    => 'Angela Maria Minimarket <promotion@angelamaria.social>',
                                'to'      => $emailUser,
                                'subject' => 'Ofertas',
                                'html'    => $Mensaje
                                );
                            # Make the call to the client.
                            $response = $mgClient->messages()->send($domain, $params);
                    }

                            echo '<script>

                                    fncFormatInputs();
                                    fncSweetAlert("success", "Los correos se han enviado con exito.", "");

                                </script>';


                }else{

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("error", "No se puedo enviar.", "")

                        </script>';

                }

            }
        }

        /*=====================================================
			TODO: Enviar APK
		======================================================*/

		public function mailEnviarApp(){

			if(isset($_POST["idUser"])){

                /*=============================================
                    TODO: facebook
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=facebook";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlFacebook = $response->results[0];

                }else{

                    $UrlFacebook = "https://www.facebook.com/";
                }

                /*=============================================
                    TODO: instagram
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=instagram";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlInstagram = $response->results[0];

                }else{

                    $UrlInstagram = "https://www.instagram.com/";
                }

                /*=============================================
                    TODO: whatsapp
                =============================================*/

                $url = "extrasettings?select=id_extrasetting,value_extrasetting&linkTo=type_extrasetting&equalTo=whatsapp";
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if($response->status == 200){

                    $UrlWhatsapp = $response->results[0];

                }else{

                    $UrlWhatsapp = "https://web.whatsapp.com/";
                }

                $url = "users?linkTo=id_user&equalTo=".$_POST["idUser"]."&select=displayname_user,email_user";
                $method = "GET";
                $fields = array();

                $userMail = CurlController::request($url, $method, $fields);

                if($userMail->status == 200){

                    /*=============================================================
                        TODO: Enviamos la apk al correo electrónico
                    =============================================================*/

                    $Mensaje = file_get_contents('views/mails/downloadEmail.html');

                    /* Parametros del Template a Remplazar */
                    $Mensaje = str_replace("amDisplayname", $userMail->results[0]->displayname_user, $Mensaje);
                    $Mensaje = str_replace("amUrl", TemplateController::path(), $Mensaje);
                    $Mensaje = str_replace("amApp", TemplateController::pathApp(), $Mensaje);
                    $Mensaje = str_replace("amWhatsapp", $UrlWhatsapp->value_extrasetting, $Mensaje);
                    $Mensaje = str_replace("amFacebook", $UrlFacebook->value_extrasetting, $Mensaje);
                    $Mensaje = str_replace("amInstagram", $UrlInstagram->value_extrasetting, $Mensaje);

                    $mgClient = Mailgun::create('e02f7c76f0f498d115ec3261f310eb88-53ce4923-6545a211', 'https://api.mailgun.net/v3/angelamaria.social');
                    $domain = "angelamaria.social";
                    $params = array(
                        'from'    => 'Angela Maria Minimarket <info@angelamaria.social>',
                        'to'      => $userMail->results[0]->email_user,
                        'subject' => 'Aplicacion',
                        'html'    => $Mensaje
                        );
                    # Make the call to the client.
                    $response = $mgClient->messages()->send($domain, $params);

                    echo '<script>

                            fncFormatInputs();
                            fncNotie(1, "La aplicación se a enviado con éxito, por favor revise su bandeja de entrada de correo electrónico.");

                        </script>';


                }else{

                    echo '<script>

                            fncFormatInputs();
                            fncSweetAlert("error", "No se puedo enviar la aplicación.", "")

                        </script>';

                }

            }

        }

    }

?>