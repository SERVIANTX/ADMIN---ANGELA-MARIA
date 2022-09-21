
<ul class="list-wrapper" data-simplebar="">

<?php

    require ("views/assets/custom/template/date.php");

    if($routesArray[1] == 'correo'){

        $correos = [];
        $host = '{e-angelamaria.me:993/imap/ssl/novalidate-cert}INBOX';

        $user = 'info@e-angelamaria.me';
        $password = 'Angela@maria3';

        $conn = imap_open($host, $user, $password)
            or die('unable to connect Gmail: ' . imap_last_error());

        $mails = imap_search($conn, 'SUBJECT "Minimarket-Consultas"');

        if ($mails) {

            rsort($mails);
                $id = 0;
            foreach ($mails as $email_number) {

                $headers = imap_fetch_overview($conn, $email_number, 0);

                $message = imap_fetchbody($conn, $email_number, '1');
                $subMessage = substr($message, 0, 10000000);
                $finalMessage = trim(quoted_printable_decode($subMessage));

                $dateInit = date("Y-m-d h:i:s", substr($headers[0]->udate, 0, 10));
                $dateEnd = date('Y-m-d H:i:s', time());

                $dif = tiempoTranscurridoFechas($dateInit,$dateEnd);
                

                $arrayTemp = array(
                    "subject" => $headers[0]->subject,
                    "from" => $headers[0]->from,
                    "date" => $dateInit,
                    "message" =>$finalMessage
                );
                array_push($correos, $arrayTemp);
                $id++;
?>
                <li class="email-list-item">
                        <div class="email-list-actions mr-3">
                        </div>

                        <a href='/correo/leer/<?php echo base64_encode($id) ?>' class="email-list-detail">
                            <div>
                                <img src="views\assets\plugins\fiva\img\log2.png" alt="image">
                                <span class="from d-block"><?php echo $headers[0]->from ?></span>
                                <p class="mb-0 msg"><?php echo $headers[0]->subject ?></p>
                            </div>

                            <span class="date d-block"><?php echo $dif; ?></span>
                        </a>
                    </li>

            <?php
            }
        }
        imap_close($conn);
        $_SESSION['emails'] = $correos;
    }
    else{
    }

?>

</ul>

