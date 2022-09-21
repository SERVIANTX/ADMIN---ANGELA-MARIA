<!doctype html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Vendors Min CSS -->
    <link rel="stylesheet" href="views\assets\plugins\fiva\css\vendors.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="views\assets\plugins\fiva\css\style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="views\assets\plugins\fiva\css\responsive.css">

        <title>Angela Maria - Recuperar Contraseña</title>

        <link rel="icon" href="views\assets\custom\img\angelam.ico">
    </head>


    <body>

        <div class="forgot-password-area bg-image">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="forgot-password-content">
                        <div class="row m-0">
                            <div class="col-lg-5 p-0">
                                <div class="image">
                                    <img src="views\assets\plugins\fiva\img\computer.png" alt="image">
                                </div>
                            </div>

                            <div class="col-lg-7 p-0">
                                <div class="forgot-password-form">
                                    <h2>Recupera tu contraseña</h2>
                                    <p class="mb-0">Proporcione la dirección de correo electrónico que el administrador de Angela Maria le dio.</p>

                                    <form method="post" class="ps-form--account ps-tab-root needs-validation" novalidate>

                                        <div class="form-group">
                                            <input type="email" class="form-control" name="resetPassword" onchange="validateJS(event, 'email')" placeholder="Dirección de correo electrónico" required>
                                            <span class="label-title"><i class='bx bx-envelope'></i></span>
                                        </div>

                                        <?php

                                            require_once "controllers/enviar.controller.php";

                                            $reset = new EnviarController();
                                            $reset -> resetPassword();

                                        ?>

                                        <button type="submit" class="forgot-password-btn">Enviar contraseña</button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="views/assets/custom/formularios/formularios.js"></script>

    </body>
</html>

