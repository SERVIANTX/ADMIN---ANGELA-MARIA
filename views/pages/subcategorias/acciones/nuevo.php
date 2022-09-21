<div class="card">

    <div class="card-header">

        <h3>Nueva Sub-Categoria</h3>

        <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

            <div class="card-body">

                <div class="col-md-12">

                    <?php

                        require_once "controllers/subcategorias.controller.php";

                        $create = new SubcategoriasController();
                        $create -> create();

                    ?>

                        <!--==================================================
                            TODO: Nombre de Subcategoria
                        ==================================================-->

                        <div class="form-group mt-5">
                            <label>Nombre<sup class="text-danger">*</sup></label>
                            <input
                                type="text"
                                class="form-control"
                                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}"
                                onchange="validateRepeat(event,'text','subcategories','name_subcategory')"
                                name="nombre-subcategory"
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

                            <select class="form-control select2" name="categoria" onchange="changeCategory(event, 'subcategories')" required>
                                <option value>Seleccionar la Categoria</option>

                                <?php foreach ($categorias as $key => $value): ?>

                                    <option value="<?php echo $value->id_category ?>"><?php echo $value->name_category ?></option>

                                <?php endforeach ?>

                            </select>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                        </div>

                        <!--==================================================
                            TODO: Listado de títulos de subcategoría
                        ==================================================-->

                        <div class="form-group titleList" style="display:none">

                            <label>Listado de títulos<sup class="text-danger">*</sup></label>

                            <div class="form-group__content">

                                <select class="form-control" name="titleList-subcategory" required>

                                    <option value="">Seleccione</option>

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

</div>