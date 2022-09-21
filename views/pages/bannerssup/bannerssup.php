<div class="breadcrumb-area">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="/"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Banners</li>

        <li class="item">Banner Superior</li>
    </ol>
</div>


<div class="card mb-10">

    <div class="card-body">

        <?php

        if(isset($routesArray[2])){

            if($routesArray[2] == "editar" || $routesArray[2] == "nuevo"){

                include "acciones/".$routesArray[2].".php";
                echo "</div>";
            }

        }else{

            include "acciones/listar.php";

        }

    ?>


    </div>

</div>