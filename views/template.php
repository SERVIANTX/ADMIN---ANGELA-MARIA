<?php

    session_start();

    /*=============================================
        TODO: Capturar las rutas de la URL
    =============================================*/

    $routesArray = explode("/", $_SERVER['REQUEST_URI']);
    $routesArray = array_filter($routesArray);

    /*=============================================
        TODO: Limpiar la URL de variables GET
    =============================================*/

    foreach ($routesArray as $key => $value) {

        $value = explode("?", $value)[0];
        $routesArray[$key] = $value;

    }

?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Administrador Angela Maria</title>

    <base href="<?php echo TemplateController::path(); ?>">

    <link rel="icon" href="views\assets\custom\img\angelam.ico">

    <!----------------------- CSS ----------------------->


    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="views/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="views/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Material Preloader -->
    <link rel="stylesheet" href="views/assets/plugins/material-preloader/material-preloader.css">
    <!-- Notie Alert -->
    <link rel="stylesheet" href="views/assets/plugins/notie/notie.css">
    <!-- Linear Icons -->
    <link rel="stylesheet" href="views/assets/plugins/linearicons/linearicons.css">
    <!-- Tags Input -->
    <link rel="stylesheet" href="views/assets/plugins/tags-input/tags-input.css">
    <!-- dropzone-->
    <link rel="stylesheet" href="views/assets/plugins/dropzone/dropzone.css">

    <!-- Bootstrap Switch -->
    <link rel="stylesheet" href="views\assets\plugins\bootstrap-switch\css\bootstrap4\bootstrap-switch.css">
    <!-- Iconpicker -->
    <link rel="stylesheet" href="views/assets/plugins/iconpicker/css/bootstrap-iconpicker.css">

    <link rel="stylesheet" href="views/assets/custom/template/template.css">

    <!-- Vendors Min CSS -->
    <link rel="stylesheet" href="views\assets\plugins\fiva\css\vendors.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="views\assets\plugins\fiva\css\style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="views\assets\plugins\fiva\css\responsive.css">




    <!----------------------- JS ----------------------->

    <!-- jQuery -->
    <script src="views/assets/plugins/jquery/jquery.min.js"></script>



    <!-- Notie Alert -->
    <!-- https://jaredreich.com/notie/ -->
    <!-- https://github.com/jaredreich/notie -->
    <script src="views/assets/plugins/notie/notie.min.js"></script>
    <!-- Sweet Alert -->
    <!-- https://sweetalert2.github.io/ -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>




    <script src="views\assets\plugins\fiva\js\vendors.min.js"></script>

    <!-- Bootstrap Switch -->
    <script src="views\assets\plugins\bootstrap-switch\js\bootstrap-switch.js"></script>

    <!-- Material Preloader -->
    <!-- https://www.jqueryscript.net/loading/Google-Inbox-Style-Linear-Preloader-Plugin-with-jQuery-CSS3.html -->
    <script src="views/assets/plugins/material-preloader/material-preloader.js"></script>
    <!-- Select2 -->
    <script src="views/assets/plugins/select2/js/select2.full.min.js"></script>
    <!-- Dropzone
    https://docs.dropzone.dev/-->
    <script src="views/assets/plugins/dropzone/dropzone.js"></script>
    <!-- Tags Input -->
    <!-- https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/ -->
    <script src="views/assets/plugins/tags-input/tags-input.js"></script>
    <!-- Iconpicker -->
    <script type="text/javascript" src="views/assets/plugins/iconpicker/js/bootstrap-iconpicker.bundle.min.js"></script>

    <!-- ApexCharts JS -->
    <script src="views\assets\plugins\fiva\js\apexcharts\apexcharts.min.js"></script>

    <!-- ChartJS -->
    <script src="views\assets\plugins\fiva\js\chartjs\chartjs.min.js"></script>
    <div class="chartjs-colors">
        <!-- To use template colors with Javascript -->
        <div class="bg-primary"></div>
        <div class="bg-primary-light"></div>
        <div class="bg-secondary"></div>
        <div class="bg-info"></div>
        <div class="bg-success"></div>
        <div class="bg-success-light"></div>
        <div class="bg-danger"></div>
        <div class="bg-warning"></div>
        <div class="bg-purple"></div>
        <div class="bg-pink"></div>
    </div>

    <!-- jvectormap Min JS -->
    <script src="views\assets\plugins\fiva\js\jvectormap-1.2.2.min.js"></script>
    <!-- jvectormap World Mil JS -->
    <script src="views\assets\plugins\fiva\js\jvectormap-world-mill-en.js"></script>
    <!-- Custom JS -->
    <script src="views\assets\plugins\fiva\js\custom.js"></script>


    <?php if(!empty($routesArray[1]) && !isset($routesArray[2])): ?>

        <?php if(   $routesArray[1] == "administradores" ||
                    $routesArray[1] == "perfil" ||
                    $routesArray[1] == "correo" ||
                    $routesArray[1] == "usuarios" ||
                    $routesArray[1] == "categorias" ||
                    $routesArray[1] == "subcategorias" ||
                    $routesArray[1] == "marcas" ||
                    $routesArray[1] == "productos" ||
                    $routesArray[1] == "ofertas" ||
                    $routesArray[1] == "subscribers" ||
                    $routesArray[1] == "bannerssup" ||
                    $routesArray[1] == "bannersdef" ||
                    $routesArray[1] == "bannershor" ||
                    $routesArray[1] == "bannersvert" ||
                    $routesArray[1] == "ordenes" ||
                    $routesArray[1] == "asignarorden" ||
                    $routesArray[1] == "seguimientos" ||
                    $routesArray[1] == "correo" ||
                    $routesArray[1] == "politicas"): ?>

            <!-- daterange picker -->
            <link rel="stylesheet" href="views/assets/plugins/daterangepicker/daterangepicker.css">

            <!-- DataTable -->
            <link rel="stylesheet" href="views/assets/plugins/data/datatables-bs4/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="views/assets/plugins/data/datatables-responsive/css/responsive.bootstrap4.min.css">
            <link rel="stylesheet" href="views/assets/plugins/data/datatables-buttons/css/buttons.bootstrap4.min.css">


            <script src="views/assets/plugins/moment/moment.min.js"></script>

            <!-- date-range-picker -->
            <script src="views/assets/plugins/daterangepicker/daterangepicker.js"></script>

            <!-- DataTables  & Plugins -->
            <script src="views/assets/plugins/data/datatables/jquery.dataTables.min.js"></script>
            <script src="views/assets/plugins/data/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="views/assets/plugins/data/datatables-responsive/js/dataTables.responsive.min.js"></script>
            <script src="views/assets/plugins/data/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
            <script src="views/assets/plugins/data/datatables-buttons/js/dataTables.buttons.min.js"></script>
            <script src="views/assets/plugins/data/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
            <script src="views/assets/plugins/data/jszip/jszip.min.js"></script>
            <script src="views/assets/plugins/data/pdfmake/pdfmake.min.js"></script>
            <script src="views/assets/plugins/data/pdfmake/vfs_fonts.js"></script>
            <script src="views/assets/plugins/data/datatables-buttons/js/buttons.html5.min.js"></script>
            <script src="views/assets/plugins/data/datatables-buttons/js/buttons.print.min.js"></script>
            <script src="views/assets/plugins/data/datatables-buttons/js/buttons.colVis.min.js"></script>

        <?php endif ?>

    <?php endif ?>


    <?php if(!empty($routesArray[2])): ?>

        <?php if(   $routesArray[2] == "administradores" ||
                    $routesArray[2] == "categorias" ||
                    $routesArray[2] == "subcategorias" ||
                    $routesArray[2] == "marcas" ||
                    $routesArray[2] == "productos" ||
                    $routesArray[2] == "tbanners" ||
                    $routesArray[2] == "dbanners"||
                    $routesArray[2] == "vbanners"||
                    $routesArray[2] == "hbanners" ): ?>

            <!-- daterange picker -->
            <link rel="stylesheet" href="views/assets/plugins/daterangepicker/daterangepicker.css">

            <!-- DataTable -->
            <link rel="stylesheet" href="views/assets/plugins/data/datatables-bs4/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="views/assets/plugins/data/datatables-responsive/css/responsive.bootstrap4.min.css">
            <link rel="stylesheet" href="views/assets/plugins/data/datatables-buttons/css/buttons.bootstrap4.min.css">


            <script src="views/assets/plugins/moment/moment.min.js"></script>

            <!-- date-range-picker -->
            <script src="views/assets/plugins/daterangepicker/daterangepicker.js"></script>

            <!-- DataTables  & Plugins -->
            <script src="views/assets/plugins/data/datatables/jquery.dataTables.min.js"></script>
            <script src="views/assets/plugins/data/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="views/assets/plugins/data/datatables-responsive/js/dataTables.responsive.min.js"></script>
            <script src="views/assets/plugins/data/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
            <script src="views/assets/plugins/data/datatables-buttons/js/dataTables.buttons.min.js"></script>
            <script src="views/assets/plugins/data/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
            <script src="views/assets/plugins/data/jszip/jszip.min.js"></script>
            <script src="views/assets/plugins/data/pdfmake/pdfmake.min.js"></script>
            <script src="views/assets/plugins/data/pdfmake/vfs_fonts.js"></script>
            <script src="views/assets/plugins/data/datatables-buttons/js/buttons.html5.min.js"></script>
            <script src="views/assets/plugins/data/datatables-buttons/js/buttons.print.min.js"></script>
            <script src="views/assets/plugins/data/datatables-buttons/js/buttons.colVis.min.js"></script>



        <?php endif ?>

    <?php endif ?>


    <script src="views/assets/custom/alerts/alerts.js"></script>

</head>

<body>

<?php

    if(!empty($routesArray[1]) && $routesArray[1] == "resetpassword"){

        include "views/pages/resetpassword/resetpassword.php";
        return;

    }

    if(!isset($_SESSION["admin"])){

        include "views/pages/login/login.php";
        echo '</body></head>';
        return;

    }

?>

<?php if(isset($_SESSION["admin"])): ?>

    <?php $time = time(); ?>
    <?php $timeExp = $_SESSION["admin"]->token_exp_user; ?>

    <?php if($time < $timeExp): ?>

        <?php include "views/modules/sidebar.php"; ?>

            <div class="main-content d-flex flex-column">

                <?php include "views/modules/navbar.php"; ?>

                <?php

                    if(!empty($routesArray[1])){

                        if( $routesArray[1] == "administradores" ||
                            $routesArray[1] == "usuarios" ||
                            $routesArray[1] == "perfil" ||
                            $routesArray[1] == "categorias" ||
                            $routesArray[1] == "subcategorias" ||
                            $routesArray[1] == "marcas" ||
                            $routesArray[1] == "productos" ||
                            $routesArray[1] == "ofertas" ||
                            $routesArray[1] == "subscribers" ||
                            $routesArray[1] == "email" ||
                            $routesArray[1] == "bannerssup" ||
                            $routesArray[1] == "bannersdef" ||
                            $routesArray[1] == "bannershor" ||
                            $routesArray[1] == "bannersvert" ||
                            $routesArray[1] == "ordenes" ||
                            $routesArray[1] == "asignarorden" ||
                            $routesArray[1] == "seguimientos" ||
                            $routesArray[1] == "correo" ||
                            $routesArray[1] == "politicas" ||
                            $routesArray[1] == "productos" ||
                            $routesArray[1] == "papelera" ||
                            $routesArray[1] == "ajustes" ||
                            $routesArray[1] == "chatbot" ||
                            $routesArray[1] == "logout" ){

                                include "views/pages/".$routesArray[1]."/".$routesArray[1].".php";

                        }else{

                            include "views/pages/404/404.php";
                        }
                    }else{

                        include "views/pages/home/home.php";

                    }

                ?>

                <div class="flex-grow-1"></div>

                <?php include "views/modules/footer.php"; ?>

            </div>

        <?php else: ?>

            <?php
                include "views/pages/sessionexpired/sessionexpired.php";
                echo '</body></head>';
                return;
            ?>

    <?php endif ?>


<?php endif ?>

<script src="views/assets/custom/formularios/formularios.js"></script>

<script type="text/javascript" src="views/assets/custom/template/template.js"></script>

</body>

</html>