<div class="email-compose-content-area mt-20">

    <?php include "sidebar-left.php"; ?>

    <div class="content-right">
        <div class="email-compose-area">
            <div class="email-compose-list-wrapper">
                <h3>Nuevo Mensaje</h3>

                <form method="post" class="needs-validation" novalidate>

                    <?php

                        require_once "controllers/enviar.controller.php";

                        $create = new EnviarController();
                        $create -> create();

                    ?>

                    <!--==================================================
                        TODO: Encabezado del correo
                    ==================================================-->

                    <div class="form-group">
                            <div class="input-group">
                                <input
                                type="text"
                                class="form-control"
                                pattern='[A-Za-z0-9]{1,}'
                                onchange="validateJS(event,'regex')"
                                name="txtde"
                                placeholder="De"
                                required>
                                <input
                                type="text"
                                class="form-control"
                                value="@angelamaria.social"
                                readonly>
                            </div>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                    <!--==================================================
                        TODO: Correo Destinatario
                    ==================================================-->

                    <div class="form-group">
                        <input
                            type="text"
                            class="form-control"
                            pattern="[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}"
                            onchange="validateRepeat(event,'email')"
                            name="txtpara"
                            placeholder="Para"
                            required>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                    <!--==================================================
                        TODO: Asunto
                    ==================================================-->

                    <div class="form-group">
                        <input
                            type="text"
                            class="form-control"
                            pattern='[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}'
                            onchange="validateJS(event,'regex')"
                            name="txtasunto"
                            placeholder="Asunto"
                            required>

                            <div class="valid-feedback">Campo Valido.</div>
                            <div class="invalid-feedback">Por favor rellene este campo.</div>

                    </div>

                    <!--==================================================
                        TODO: Mensaje
                    ===================================================-->

                    <div class="form-group">
                        <textarea
                        class="summernote"
                        name="descripcion-mensaje"
                        required>
                        </textarea>
                    </div>



                    <div class="form-group mb-0 text-right mt-4">
                        <button type="submit" class="btn btn-primary">Enviar <i class='bx bx-send'></i></button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>