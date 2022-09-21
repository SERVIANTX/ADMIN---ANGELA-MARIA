<?php

    /*=====================================================================
        TODO: Cantidad de Ofertas
    =====================================================================*/

    $url = "products?select=productoffer_product";
    $method = "GET";
    $fields = array();
    $ofertas = CurlController::request($url,$method,$fields);

    if($ofertas->status == 200){

        $ofertas = $ofertas->results;

    }else{

        $ofertas = array();

    }

    $totalOfertas = 0;

    foreach ($ofertas as $key => $value) {

        if($value->productoffer_product != null){

            $totalOfertas++;

        }

    }


?>

<div class="sidemenu-area">

    <div class="sidemenu-header">
        <a href="/" class="navbar-brand d-flex align-items-center">
            <img src="views\assets\plugins\fiva\img\log2.png" alt="image">
            <span>AM</span>
        </a>

        <div class="burger-menu d-none d-lg-block">
            <span class="top-bar"></span>
            <span class="middle-bar"></span>
            <span class="bottom-bar"></span>
        </div>

        <div class="responsive-burger-menu d-block d-lg-none">
            <span class="top-bar"></span>
            <span class="middle-bar"></span>
            <span class="bottom-bar"></span>
        </div>
    </div>

    <div class="sidemenu-body">

        <ul class="sidemenu-nav metisMenu h-100" id="sidemenu-nav">

            <li class="nav-item <?php if(empty($routesArray)): ?>mm-active<?php endif ?>">
                <a href="/" class="nav-link">
                    <span class="icon"><i class='bx bx-home-circle'></i></span>
                    <span class="menu-title">Home</span>
                </a>
            </li>

            <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "administradores"): ?>mm-active<?php endif ?>">
                <a href="/administradores" class="nav-link">
                    <span class="icon"><i class='bx bx-user-pin'></i></span>
                    <span class="menu-title">Administradores</span>
                </a>
            </li>

            <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "usuarios"): ?>mm-active<?php endif ?>">
                <a href="/usuarios" class="nav-link">
                    <span class="icon"><i class='bx bx-user'></i></span>
                    <span class="menu-title">Usuarios</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="collapsed-nav-link nav-link" aria-expanded="false">
                    <span class="icon"><i class='bx bx-store-alt'></i></span>
                    <span class="menu-title">E-Commerce</span>
                </a>

                <ul class="sidemenu-nav-second-level">

                    <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "categorias"): ?>mm-active<?php endif ?>">
                        <a href="/categorias" class="nav-link">
                            <span class="icon"><i class='bx bx-grid-alt'></i></span>
                            <span class="menu-title">Categorias</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "subcategorias"): ?>mm-active<?php endif ?>">
                        <a href="/subcategorias" class="nav-link">
                            <span class="icon"><i class='bx bx-command'></i></span>
                            <span class="menu-title">Sub-Categorias</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "marcas"): ?>mm-active<?php endif ?>">
                        <a href="/marcas" class="nav-link">
                            <span class="icon"><i class='bx bx-package'></i></span>
                            <span class="menu-title">marcas</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "productos"): ?>mm-active<?php endif ?>">
                        <a href="/productos" class="nav-link">
                            <span class="icon"><i class='bx bx-shopping-bag'></i></span>
                            <span class="menu-title">Productos</span>
                        </a>
                    </li>

                </ul>

            </li>

            <li class="nav-item">
                <a href="#" class="collapsed-nav-link nav-link" aria-expanded="false">
                    <span class="icon"><i class='bx bx-bulb'></i></span>
                    <span class="menu-title">Marketing</span>
                </a>

                <ul class="sidemenu-nav-second-level">

                    <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "ofertas"): ?>mm-active<?php endif ?>">
                        <a href="/ofertas" class="nav-link">
                            <span class="icon"><i class='bx bxs-offer'></i></span>
                            <span class="menu-title">Ofertas</span>
                            <?php if ($totalOfertas > 0): ?>

                                <span class="badge"><?php echo $totalOfertas ?></span>

                            <?php endif ?>
                        </a>
                    </li>

                    <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "subscribers"): ?>mm-active<?php endif ?>">
                        <a href="/subscribers" class="nav-link">
                            <span class="icon"><i class='bx bx-user-check'></i></span>
                            <span class="menu-title">Suscriptores</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "email"): ?>mm-active<?php endif ?>">
                        <a href="/email" class="nav-link">
                            <span class="icon"><i class='bx bx-mail-send'></i></span>
                            <span class="menu-title">Correos</span>
                        </a>
                    </li>


                </ul>

            </li>


            <li class="nav-item">
                <a href="#" class="collapsed-nav-link nav-link" aria-expanded="false">
                    <span class="icon"><i class='bx bx-badge-check'></i></span>
                    <span class="menu-title">Banners</span>
                </a>

                <ul class="sidemenu-nav-second-level">

                    <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "bannerssup"): ?>mm-active<?php endif ?>">
                        <a href="/bannerssup" class="nav-link">
                            <span class="icon"><i class='bx bx-images'></i></span>
                            <span class="menu-title">Banner superior</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "bannersdef"): ?>mm-active<?php endif ?>">
                        <a href="/bannersdef" class="nav-link">
                            <span class="icon"><i class='bx bx-image-alt'></i></span>
                            <span class="menu-title">Banner por defecto</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "bannershor"): ?>mm-active<?php endif ?>">
                        <a href="/bannershor" class="nav-link">
                            <span class="icon"><i class='bx bx-image'></i></span>
                            <span class="menu-title">Banner horizontal</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "bannersvert"): ?>mm-active<?php endif ?>">
                        <a href="/bannersvert" class="nav-link">
                            <span class="icon"><i class='bx bx-image-add'></i></span>
                            <span class="menu-title">Banner vertical</span>
                        </a>
                    </li>

                </ul>

            </li>

            <li class="nav-item">
                <a href="#" class="collapsed-nav-link nav-link" aria-expanded="false">
                    <span class="icon"><i class='bx bx-shopping-bag'></i></span>
                    <span class="menu-title">Pedidos</span>
                </a>

                <ul class="sidemenu-nav-second-level">

                    <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "ordenes"): ?>mm-active<?php endif ?>">
                        <a href="/ordenes" class="nav-link">
                            <span class="icon"><i class='bx bx-cart'></i></span>
                            <span class="menu-title">Ordenes</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "seguimientos"): ?>mm-active<?php endif ?>">
                        <a href="/seguimientos" class="nav-link">
                            <span class="icon"><i class='bx bx-map-pin'></i></span>
                            <span class="menu-title">Tracking</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "asignarorden"): ?>mm-active<?php endif ?>">
                        <a href="/asignarorden" class="nav-link">
                            <span class="icon"><i class='bx bx-car'></i></span>
                            <span class="menu-title">Asignar orden</span>
                        </a>
                    </li>

                </ul>

            </li>

            <li class="nav-item">
                <a href="#" class="collapsed-nav-link nav-link" aria-expanded="false">
                    <span class="icon"><i class='bx bx-envelope'></i></span>
                    <span class="menu-title">Correo</span>
                </a>

                <ul class="sidemenu-nav-second-level">

                    <li class="nav-item <?php if(!empty($routesArray[2]) && $routesArray[2] == "imbox"): ?>mm-active<?php endif ?>">
                        <a href="/correo/imbox" class="nav-link">
                            <span class="icon"><i class='bx bxs-inbox'></i></span>
                            <span class="menu-title">Inbox</span>
                        </a>
                    </li>

                    <li class="nav-item <?php if(!empty($routesArray[2]) && $routesArray[2] == "enviar"): ?>mm-active<?php endif ?>">
                        <a href="/correo/enviar" class="nav-link">
                            <span class="icon"><i class='bx bx-send'></i></span>
                            <span class="menu-title">Redactar</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "papelera"): ?>mm-active<?php endif ?>">
                <a href="/papelera" class="nav-link">
                    <span class="icon"><i class='bx bx-trash'></i></span>
                    <span class="menu-title">Papelera</span>
                </a>
            </li>

            <li class="nav-item <?php if(!empty($routesArray) && $routesArray[1] == "politicas"): ?>mm-active<?php endif ?>">
                <a href="/politicas" class="nav-link">
                    <span class="icon"><i class='bx bx-detail'></i></span>
                    <span class="menu-title">Politicas Y Privacidad</span>
                </a>
            </li>

        </ul>
    </div>

</div>