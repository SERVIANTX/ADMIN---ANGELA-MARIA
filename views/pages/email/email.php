<div class="card mb-30">

    <div class="card-body">


        <?php

            if(isset($routesArray[2])){

                if( $routesArray[2] == "ofertas" ||
                    $routesArray[2] == "productos" ||
                    $routesArray[2] == "marcas" ||
                    $routesArray[2] == "categorias" ||
                    $routesArray[2] == "subcategorias" ||
                    $routesArray[2] == "festividades" ||
                    $routesArray[2] == "ofertas-subs" ||
                    $routesArray[2] == "productos-subs" ||
                    $routesArray[2] == "marcas-subs" ||
                    $routesArray[2] == "categorias-subs" ||
                    $routesArray[2] == "subcategorias-subs" ||
                    $routesArray[2] == "festividades-subs"){

                    include "acciones/".$routesArray[2].".php";
                }

            }else{

                include "acciones/listar.php";

            }

        ?>


    </div>

</div>