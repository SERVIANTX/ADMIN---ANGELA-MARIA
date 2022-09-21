<?php $primerNombre = explode(" ",trim($_SESSION["admin"]->displayname_user)); ?>

<div class="faq-search mb-20">
    <h2>Hola <?php echo $primerNombre[0]; ?>, escoje a que sector quiere enviar y seleccione el contenido del correo.</h2>
</div>

<br>

<div class="row">

    <div class="col-md-6">

        <div class="faq-search mb-20">
            <h2><i class='bx bx-user'></i> Clientes</h2>
        </div>

        <div class="faq-area mb-30">
            <div class="tab faq-accordion-tab">

                <ul class="tabs1 d-flex flex-wrap justify-content-center">
                    <li><a class="btn" href="/email/ofertas"><i class='bx bxs-offer'></i> <span class="mr-2 ml-2">Ofertas</span></a></li>
                </ul>

                <ul class="tabs1 d-flex flex-wrap justify-content-center">
                    <li><a class="btn" href="/email/productos"><i class='bx bx-shopping-bag'></i> <span class="mr-1 ml-1">Productos</span></a></li>
                    <li><a class="btn" href="/email/marcas"><i class='bx bx-package'></i> <span class="mr-3 ml-3">Marcas</span></a></li>
                </ul>

                <ul class="tabs1 d-flex flex-wrap justify-content-center">
                    <li><a class="btn" href="/email/categorias"><i class='bx bx-grid-alt'></i> <span class="mr-1 ml-1">Categorías</span></a></li>
                    <li><a class="btn" href="/email/subcategorias"><i class='bx bx-command'></i> <span>Sub-Categorías</span></a></li>
                    <li><a class="btn" href="/email/festividades"><i class='bx bx-home-heart'></i> <span>Festividades</span></a></li>
                </ul>

            </div>
        </div>

    </div>

    <div class="col-md-6">

        <div class="faq-search mb-20">
            <h2><i class='bx bx-user-check'></i> Suscriptores</h2>
        </div>

        <div class="faq-area mb-30">
            <div class="tab faq-accordion-tab">

                <ul class="tabs1 d-flex flex-wrap justify-content-center">
                    <li><a class="btn" href="/email/ofertas-subs"><i class='bx bxs-offer'></i> <span class="mr-2 ml-2">Ofertas</span></a></li>
                </ul>

                <ul class="tabs1 d-flex flex-wrap justify-content-center">
                    <li><a class="btn" href="/email/productos-subs"><i class='bx bx-shopping-bag'></i> <span class="mr-1 ml-1">Productos</span></a></li>
                    <li><a class="btn" href="/email/marcas-subs"><i class='bx bx-package'></i> <span class="mr-3 ml-3">Marcas</span></a></li>
                </ul>

                <ul class="tabs1 d-flex flex-wrap justify-content-center">
                    <li><a class="btn" href="/email/categorias-subs"><i class='bx bx-grid-alt'></i> <span class="mr-1 ml-1">Categorías</span></a></li>
                    <li><a class="btn" href="/email/subcategorias-subs"><i class='bx bx-command'></i> <span>Sub-Categorías</span></a></li>
                    <li><a class="btn" href="/email/festividades-subs"><i class='bx bx-home-heart'></i> <span>Festividades</span></a></li>
                </ul>

            </div>
        </div>

    </div>

</div>