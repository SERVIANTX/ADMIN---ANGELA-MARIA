<?php

	if(isset($routesArray[3])){

		$security = explode("~",base64_decode($routesArray[3]));

		if($security[1] == $_SESSION["admin"]->token_user){

			$select = "id_subcategory,name_subcategory,title_list_subcategory,url_subcategory,id_category_subcategory";

			$url = "subcategories?select=".$select."&linkTo=id_subcategory&equalTo=".$security[0];
			$method = "GET";
			$fields = array();

			$response = CurlController::request($url, $method, $fields);

			if($response->status == 200){

				$subcategoria = $response->results[0];

			}else{

				echo '<script>

				window.location = "/subcategorias";

				</script>';
			}

		}else{

			echo '<script>

				window.location = "/subcategorias";

				</script>';
			}

		}

?>

<div class="card">

    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

    <input type="hidden" value="<?php echo $subcategoria->id_subcategory ?>" name="idsubcategory">

        <div class="card-body">

            <?php

                require_once "controllers/subcategorias.controller.php";

                $create = new SubcategoriasController();
                $create -> edit($subcategoria->id_subcategory);

            ?>

            <div class="col-md-12">

                <!--==================================================
                    TODO: Nombre de la subcategoria
                ==================================================-->

                <div class="form-group mt-5">
                    <label>Nombre<sup class="text-danger">*</sup></label>
                    <input
                        type="text"
                        class="form-control"
                        pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}"
                        onchange="validateJS(event,'text')"
                        name="nombre-subcategory"
                        value="<?php echo $subcategoria->name_subcategory ?>"
                        required>

                        <div class="valid-feedback">Campo Valido.</div>
                        <div class="invalid-feedback">Por favor rellene este campo.</div>

                </div>

                <!--==================================================
                    TODO: URL de la Subcategoria
                ==================================================-->

                <div class="form-group mt-4">
                    <label>URL<sup class="text-danger">*</sup></label>
                    <input
                        type="text"
                        class="form-control"
                        readonly
                        name="url-name_subcategory"
                        value="<?php echo $subcategoria->name_subcategory ?>"
                        required>

                </div>

                <!--==================================================
                    TODO: Nombre de la categoria perteneciente
                ==================================================-->

                <div class="form-group mt-4">
                    <label>Categoria<sup class="text-danger">*</sup></label>

                    <?php

                        require_once "controllers/curl.controller.php";
                        $select = "id_category,name_category";
                        $url = "categories?select=".$select;
                        $method = "GET";
                        $fields = array();
                        $data = CurlController::request($url, $method, $fields)->results;
                        $categorias = $data;

                    ?>
                    <select class="form-control select2" name="categoria" onchange="changeCategory(event, 'subcategories')" required >
                    <option value>Seleccionar la Categoria</option>

                        <?php foreach ($categorias as $key => $value):
                                $selected="";

                                if($value->id_category == $subcategoria->id_category_subcategory){
                                    $selected='selected="selected"';
                                }
                                ?>
                            <option value="<?php echo $value->id_category ?>" <?php echo $selected ?> ><?php echo $value->name_category ?></option>
                        <?php endforeach  ?>
                    </select>

                    <div class="valid-feedback">Campo Valido.</div>
                    <div class="invalid-feedback">Por favor rellene este campo.</div>

                </div>

                <!--==================================================
                    TODO: Listado de títulos de subcategoría
                ==================================================-->

                <div class="form-group titleList">

                    <label>Listado de títulos<sup class="text-danger">*</sup></label>

                    <div class="form-group__content">

                        <select
                        class="form-control"
                        name="titleList-subcategory"
                        required>

                            <option class="optTitleList" value="<?php echo $subcategoria->title_list_subcategory ?>">
                                <?php echo $subcategoria->title_list_subcategory ?></option>

                        </select>

                        <div class="valid-feedback">Campo Valido.</div>
                        <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                </div>

            </div>

        </div>

        <div class="card-footer">

            <div class="calendar-container mb-10">

                <div class="calendar-header">
                <a href="/subcategorias" class="btn btn-light border text-left"><i class="fa fa-arrow-left mr-2"></i>Volver</a>

                    <button type="submit"><i class="fa fa-save mr-2"></i> Guardar</button>
                </div>

        </div>

    </form>

</div>