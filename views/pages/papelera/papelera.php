<div class="card mb-30">

    <div class="card-body">


        <?php

            if(isset($routesArray[2])){

                if( $routesArray[2] == "administradores" ||
                    $routesArray[2] == "categorias" ||
                    $routesArray[2] == "subcategorias" ||
                    $routesArray[2] == "marcas" ||
                    $routesArray[2] == "productos" ||
                    $routesArray[2] == "tbanners" ||
                    $routesArray[2] == "dbanners"||
                    $routesArray[2] == "vbanners"||
                    $routesArray[2] == "hbanners"){

                    include "acciones/".$routesArray[2].".php";
                }

            }else{

                include "acciones/listar.php";

            }

        ?>


    </div>

</div>
