<div class="card mb-30">

    <div class="card-body">

        <?php

        if(isset($routesArray[2])){

            if($routesArray[2] == "leer" || $routesArray[2] == "enviar" || $routesArray[2] == "imbox"){

                include "acciones/".$routesArray[2].".php";
            }

        }
    ?>


    </div>

</div>
