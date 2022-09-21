<?php

    require ("views/assets/custom/template/date.php");
    $security = explode("~",base64_decode($routesArray[3]));
    $id = $security[0];
    $id = $id - 1;
    $newDate = fechaEs($_SESSION['emails'][$id]['date']);
    $form = $_SESSION['emails'][$id]['from'];
    $subject = $_SESSION['emails'][$id]['subject'];
    $message = $_SESSION['emails'][$id]['message'];
?>


<div class="email-read-content-area mt-20">
    <div class="sidebar-left">
        <div class="sidebar">
            <div class="sidebar-content d-flex email-sidebar" data-simplebar="">
                <div class="email-read-menu">
                    <button type="button" class="btn btn-primary btn-block compose-btn mb-4" onclick="nuevoMensaje()"><i class='bx bx-plus'></i> Redactar</button>

                    <div class="list-group list-group-messages">
                        <a href="/correo/imbox" class="list-group-item active">
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
        <div class="email-read-area">
            <div class="email-read-list-wrapper">
                <div class="email-read-list">
                    <div class="email-read-list-header d-flex align-items-center justify-content-between">
                        <div class="header-left d-flex align-items-center">
                            <a href="/correo/imbox" class="d-inline-block go-back">
                                <i class='bx bx-chevron-left'></i>
                            </a>
                            <h3 class="font-weight-bold mb-0"><span class="badge bg-success ml-1">Inbox</span></h3>
                        </div>
                    </div>

                    <div class="email-read-scroll-area" data-simplebar="">
                        <ul class="list-wrapper">
                            <li class="email-read-list-item">
                                <div class="email-read-list-detail">
                                    <div class="user-information">
                                        <img src="views\assets\plugins\fiva\img\log2.png" alt="image">
                                        <span class="name d-block"><?php echo $form ?> <span class="email d-inline-block"></span></span>
                                        <p class="font-weight-bold"><?php echo $subject ?></p>
                                    </div>

                                    <div class="email-information d-flex align-items-center">
                                        <span class="date d-block"><?php echo $newDate ?></span>

                                    </div>
                                </div>

                                <div class="email-read-list-content">
                                    <p><?php echo $message ?></p>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>