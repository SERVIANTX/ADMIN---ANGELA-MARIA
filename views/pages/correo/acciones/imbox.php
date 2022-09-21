<div class="email-content-area mt-20">
    <div class="sidebar-left">
        <div class="sidebar">
            <div class="sidebar-content d-flex email-sidebar" data-simplebar="">
                <div class="email-menu">
                    <button type="button" class="btn btn-primary btn-block compose-btn mb-4" onclick="nuevoMensaje()"><i class='bx bx-plus'></i>
                        Redactar</button>

                    <div class="list-group list-group-messages">
                        <a href="/correo" class="list-group-item active">
                            <i class='bx bx-envelope'></i>
                            Inbox
                        </a>

                        <a href="/correo/enviar" class="list-group-item">
                            <i class='bx bx-paper-plane'></i>
                            Redactar
                        </a>

                    </div>

                    <div class="list-group list-group-labels">
                        <img src="views/assets/custom/img/fondo-dt-copy.png" >
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-right">
        <div class="email-area">
            <div class="email-list-wrapper">
                <div class="email-list">
                    <div class="email-list-header d-flex align-items-center">
                        <div class="header-left d-flex align-items-center mr-3">
                        </div>
                    </div>

                    <?php include "controllers/inbox.controller.php"; ?>

                    <div class="email-list-footer d-flex justify-content-between align-items-center">

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>