<div class="login-area bg-image">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="login-form">
                <div class="logo">
                    <a><img src="views\assets\plugins\fiva\img\logoAM2.png" alt="image"></a>
                </div>

                <h2>Bienvenido</h2>

                <form method="post" class="needs-validation" novalidate>
                    <div class="form-group">
                        <input type="email" class="form-control" name="loginEmail" onchange="validateJS(event, 'email')" placeholder="Email" required>
                        <span class="label-title"><i class='bx bx-user'></i></span>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="loginPassword" placeholder="Password" required>
                        <span class="label-title"><i class='bx bx-lock'></i></span>
                    </div>

                    <?php

                        require_once "controllers/admins.controller.php";

                        $login = new AdminsController();
                        $login -> login();

                    ?>

                    <div class="form-group">
                        <div class="remember-forgot">
                            <label class="checkbox-box" for="remember">Recuerdame
                                <input type="checkbox" id="remember" onchange="rememberMe(event)">
                                <span class="checkmark"></span>
                            </label>

                            <a href="/resetpassword" class="forgot-password" target="_blank">Olvide mi contraseña</a>
                        </div>
                    </div>

                    <button type="submit" class="login-btn">Iniciar Sesión</button>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="views/assets/custom/formularios/formularios.js"></script>