<?php

    /*=====================================================================
        TODO: Ordenes
    =====================================================================*/

    $url = "orders?select=id_order,status_order,date_order&orderBy=id_order&orderMode=DESC&startAt=0&endAt=5&linkTo=status_order&equalTo=0";
    $method = "GET";
    $fields = array();
    $pedidos = CurlController::request($url,$method,$fields);

    if($pedidos->status == 200){

        $pedidos = $pedidos->results;

    }else{

        $pedidos = array();

    }

    $totalPedidos = 0;

    foreach ($pedidos as $key => $value) {

        if($value->status_order == 0){

            $totalPedidos++;

        }

    }

?>

<nav class="navbar top-navbar navbar-expand">
    <div class="collapse navbar-collapse" id="navbarSupportContent">
        <div class="responsive-burger-menu d-block d-lg-none">
            <span class="top-bar"></span>
            <span class="middle-bar"></span>
            <span class="bottom-bar"></span>
        </div>

        <ul class="navbar-nav left-nav align-items-center">
            <li class="nav-item">
                <a href="/ajustes" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Ajustes">
                    <i class="bx bx-cog"></i>
                </a>
            </li>

            <li class="nav-item">
                <a href="/correo" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Correo">
                    <i class="bx bx-envelope"></i>
                </a>
            </li>

            <li class="nav-item">
                <a href="/chatbot" class="nav-link" data-toggle="tooltip" data-placement="bottom"
                    title="Chatbot">
                    <i class='bx bx-bot'></i>
                </a>
            </li>

            <li class="nav-item">
                <a href="/papelera" class="nav-link" data-toggle="tooltip" data-placement="bottom"
                    title="Papelera">
                    <i class='bx bx-trash'></i>
                </a>
            </li>

        </ul>

        <form class="nav-search-form d-none ml-auto d-md-block">
        </form>

        <ul class="navbar-nav right-nav align-items-center">
            <li class="nav-item">
                <a class="nav-link bx-fullscreen-btn" id="fullscreen-button">
                    <i class="bx bx-fullscreen"></i>
                </a>
            </li>

            <li class="nav-item message-box dropdown">
                <a href="<?php echo TemplateController::pathEcommerce() ?>" class="nav-link" role="button" data-toggle="tooltip" aria-expanded="false" target="_blank" title="E-Commerce">
                    <div class="message-btn">
                        <i class='bx bx-store-alt'></i>
                    </div>
                </a>
            </li>

            <li class="nav-item notification-box dropdown">
                <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="notification-btn">
                        <i class='bx bx-bell'></i>

                            <?php if ($totalPedidos > 0): ?>

                                <span class="badge badge-navbar badge-secondary"><?php echo $totalPedidos ?></span>

                            <?php endif ?>

                    </div>
                </a>

                <?php if ($totalPedidos != 0): ?>

                    <div class="dropdown-menu">
                        <div class="dropdown-header d-flex justify-content-between align-items-center">
                            <span class="title d-inline-block"><?php echo $totalPedidos ?> Nuevas ordenes</span>
                        </div>

                        <div class="dropdown-body">

                            <?php foreach ($pedidos as $key => $value_pedido) : ?>

                                <a href="<?php echo "/ordenes/detalles/".base64_encode($value_pedido->id_order."~".$_SESSION["admin"]->token_user) ?>" class="dropdown-item d-flex align-items-center">
                                    <div class="icon">
                                        <i class='bx bx-cart-alt'></i>
                                    </div>

                                    <div class="content">
                                        <span class="d-block">#0000<?php echo $value_pedido->id_order ?></span>
                                        <p class="sub-text mb-0"><?php echo $value_pedido->date_order ?></p>
                                    </div>
                                </a>

                            <?php endforeach; ?>

                        </div>

                        <div class="dropdown-footer">
                            <a href="/ordenes" class="dropdown-item">Ver todo</a>
                        </div>

                    </div>

                <?php endif ?>

            </li>

            <li class="nav-item dropdown profile-nav-item">
                <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="menu-profile">
                        <span class="name">Bienvenido <?php echo $_SESSION["admin"]->displayname_user ?></span>
                        <img src="<?php echo TemplateController::returnImg($_SESSION["admin"]->id_user, $_SESSION["admin"]->picture_user, $_SESSION["admin"]->method_user) ?>" class="rounded-circle" alt="image">
                    </div>
                </a>

                <div class="dropdown-menu">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="figure mb-3">
                            <img src="<?php echo TemplateController::returnImg($_SESSION["admin"]->id_user, $_SESSION["admin"]->picture_user, $_SESSION["admin"]->method_user) ?>" class="rounded-circle" alt="image">
                        </div>

                        <div class="info text-center">
                            <span class="name"><?php echo $_SESSION["admin"]->displayname_user ?></span>
                            <p class="mb-3 email"><?php echo $_SESSION["admin"]->email_user ?></p>
                        </div>
                    </div>

                    <div class="dropdown-body">
                        <ul class="profile-nav p-0 pt-3">
                            <li class="nav-item">
                                <a href="/perfil" class="nav-link">
                                    <i class='bx bx-user'></i> <span>Perfil</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/correo" class="nav-link">
                                    <i class='bx bx-envelope'></i> <span>Mi bandeja de entrada</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/ajustes" class="nav-link">
                                    <i class='bx bx-cog'></i> <span>Ajustes</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown-footer">
                        <ul class="profile-nav">
                            <li class="nav-item">
                                <a href="/logout" class="nav-link">
                                    <i class='bx bx-log-out'></i> <span>Cerrar Sesión</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</nav>