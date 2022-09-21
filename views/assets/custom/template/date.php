<?php

    function tiempoTranscurridoFechas($fechaInicio,$fechaFin)
    {
        $fecha1 = new DateTime($fechaInicio);
        $fecha2 = new DateTime($fechaFin);
        $fecha = $fecha1->diff($fecha2);
        $tiempo = "";


        //años
        if($fecha->y > 0)
        {
            $tiempo .= $fecha->y;

            if($fecha->y == 1)
                $tiempo .= " a ";
            else
                $tiempo .= " a ";
        }

        if($tiempo == ""){

            //meses
            if($fecha->m > 0)
            {
                $tiempo .= $fecha->m;

                if($fecha->m == 1)
                    $tiempo .= " m ";
                else
                    $tiempo .= " m ";
            }
            if($tiempo == ""){
                //dias
                if($fecha->d > 0)
                {
                    $tiempo .= $fecha->d;

                    if($fecha->d == 1)
                        $tiempo .= " d ";
                    else
                        $tiempo .= " d ";
                }
                if($tiempo == ""){
                    //horas
                    if($fecha->h > 0)
                    {
                        $tiempo .= $fecha->h;

                        if($fecha->h == 1)
                            $tiempo .= " h ";
                        else
                            $tiempo .= " h ";
                    }
                    if($tiempo == ""){
                        //minutos
                        if($fecha->i > 0)
                        {
                            $tiempo .= $fecha->i;
                            if($fecha->i == 1)
                                $tiempo .= " min";
                            else
                                $tiempo .= " min";
                        }
                        if($tiempo == ""){
                            if($fecha->i == 0)
                            $tiempo .= $fecha->s." seg";
                        }
                    }
                }
            }
        }
        return $tiempo;
    }

    function fechaEs($fecha) {
        $fechaT = substr($fecha, 0, 10);
        $Hora = substr($fecha, 11, 18);
        $Hora = date("h:i:s A", strtotime($Hora));
        $numeroDia = date('d', strtotime($fechaT));
        $dia = date('l', strtotime($fechaT));
        $mes = date('F', strtotime($fechaT));
        $anio = date('Y', strtotime($fechaT));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $nombredia." ".$numeroDia." de ".$nombreMes." del ".$anio. " ". $Hora;
    }

?>