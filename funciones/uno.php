<?php

function uno($pdo, $from) {
    // Verificar si el estado es igual a 'inicio'
    $stmt = $pdo->prepare("SELECT status FROM booking WHERE user_id = ?");
    $stmt->execute([$from]);
    $status = $stmt->fetchColumn();
    
    
    
    if ($status === 'inicio') {
      
        // Construir el mensaje del menú
            $menuMessage = menuTurnos($pdo, $from);
        
    }
    
    elseif ($status === 'menuTurnos') {
      
        // Construir el mensaje del menú
            $menuMessage = sucursales($pdo, $from);
        
    }
    
    elseif ($status === 'sucursales') {
      
        // Construir el mensaje del menú
            $menuMessage = menuLasaigues($pdo, $from);
        
    }
    
    elseif ($status === 'menuLasaigues') {
      
        // Construir el mensaje del menú
        $menuMessage = menuBarberos($pdo, $from);
            
        // Obtener el servicio de la tabla menuBarberia
        $stmt = $pdo->prepare("SELECT item FROM menuBarberia WHERE id = 1");
        $stmt->execute();
        $servicio = $stmt->fetchColumn();
        
        // Actualizar el estado 
        update_servicio($pdo, $from, $servicio);
        
    }
    
    elseif ($status === 'menuCabral') {
      
        // Construir el mensaje del menú
        $menuMessage = menuBarberosCabral($pdo, $from);
            
        // Obtener el servicio de la tabla menuBarberia
        $stmt = $pdo->prepare("SELECT item FROM menuBarberia WHERE id = 1");
        $stmt->execute();
        $servicio = $stmt->fetchColumn();
        
        // Actualizar el estado 
        update_servicio($pdo, $from, $servicio);
        
    }
    
    elseif ($status === 'barbero') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';
        
        // Insertar un nuevo registro si el usuario no existe
        $stmt = $pdo->prepare("UPDATE booking SET nombre_barbero = (SELECT nombre FROM menuBarberos WHERE id = 1) WHERE user_id = ?");
        $stmt->execute([$from]);
        
        // Establecer la fecha y hora actual
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fechaActual = date('Y-m-d');
        
        // Preparar la consulta SQL para buscar horarios disponibles para los próximos 7 días (excluyendo domingo)
        $stmt = $pdo->prepare("SELECT DISTINCT fecha FROM horarios WHERE estado = 'disponible' AND fecha >= ? ORDER BY fecha ASC LIMIT 6");
        
        // Ejecutar la consulta con la fecha actual
        $stmt->execute([$fechaActual]);
        
        // Recuperar los resultados
        $horariosDisponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Verificar si hay horarios disponibles para la fecha actual
        $hayHorariosParaHoy = false;
        foreach ($horariosDisponibles as $horario) {
            if ($horario['fecha'] == $fechaActual) {
                $hayHorariosParaHoy = true;
                break;
            }
        }
        
        // Si no hay horarios disponibles para hoy, omitir la opción 0 y comenzar desde el próximo día
        $contador = 0;
        if (!$hayHorariosParaHoy) {
            $contador++;
        }
        
        // Actualizar el estado a 'hora'
        update_status($pdo, $from, 'mhd');
        
        $menuMessage = "🗓️ *¿Qué día quieres obtener tu turno?*\n\n";
        foreach ($horariosDisponibles as $horario) {
            $fecha = new DateTime($horario['fecha']);
            // Ignorar domingo
            if ($fecha->format('N') != 7) {
                // Si es el primer día después de hoy y no hay horarios disponibles para hoy, mostrar como opción 0 (día actual)
                if ($contador === 0 && !$hayHorariosParaHoy) {
                    $menuMessage .= "0. Hoy \n";
                    $contador++;
                } else {
                    $nombreDia = "";
                    switch ($fecha->format('N')) {
                        case 1:
                            $nombreDia = "Lunes";
                            break;
                        case 2:
                            $nombreDia = "Martes";
                            break;
                        case 3:
                            $nombreDia = "Miércoles";
                            break;
                        case 4:
                            $nombreDia = "Jueves";
                            break;
                        case 5:
                            $nombreDia = "Viernes";
                            break;
                        case 6:
                            $nombreDia = "Sábado";
                            break;
                    }
                    // Obtener el nombre completo del mes en español
                    setlocale(LC_TIME, 'es_ES');
                    $nombreMes = strftime('%B', strtotime($fecha->format('Y-m-d')));
                    $menuMessage .= "{$contador}. {$nombreDia} {$fecha->format('j')} de {$nombreMes}\n";
                }
                $contador++;
            }
        }
        
        $menuMessage .= "\nIngresá el número de la fecha en la que querés obtener un turno \n\n o escribí *salir* para cancelar.";
        sleep(1);
        return [
            'message_type' => 'text',
            'message' => [
                'message' => $menuMessage
            ]
        ];

        }
        
    elseif ($status === 'barberoCabral') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';
        
        // Insertar un nuevo registro si el usuario no existe
        $stmt = $pdo->prepare("UPDATE booking SET nombre_barbero = (SELECT nombre FROM menuBarberos WHERE id = 3) WHERE user_id = ?");
        $stmt->execute([$from]);
        
        // Establecer la fecha y hora actual
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fechaActual = date('Y-m-d');
        
        // Preparar la consulta SQL para buscar horarios disponibles para los próximos 7 días (excluyendo domingo)
        $stmt = $pdo->prepare("SELECT DISTINCT fecha FROM horarios WHERE estado = 'disponible' AND fecha >= ? ORDER BY fecha ASC LIMIT 6");
        
        // Ejecutar la consulta con la fecha actual
        $stmt->execute([$fechaActual]);
        
        // Recuperar los resultados
        $horariosDisponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Verificar si hay horarios disponibles para la fecha actual
        $hayHorariosParaHoy = false;
        foreach ($horariosDisponibles as $horario) {
            if ($horario['fecha'] == $fechaActual) {
                $hayHorariosParaHoy = true;
                break;
            }
        }
        
        // Si no hay horarios disponibles para hoy, omitir la opción 0 y comenzar desde el próximo día
        $contador = 0;
        if (!$hayHorariosParaHoy) {
            $contador++;
        }
        
        // Actualizar el estado a 'hora'
        update_status($pdo, $from, 'mhd');
        
        $menuMessage = "🗓️ *¿Qué día quieres obtener tu turno?*\n\n";
        foreach ($horariosDisponibles as $horario) {
            $fecha = new DateTime($horario['fecha']);
            // Ignorar domingo
            if ($fecha->format('N') != 7) {
                // Si es el primer día después de hoy y no hay horarios disponibles para hoy, mostrar como opción 0 (día actual)
                if ($contador === 0 && !$hayHorariosParaHoy) {
                    $menuMessage .= "0. Hoy \n";
                    $contador++;
                } else {
                    $nombreDia = "";
                    switch ($fecha->format('N')) {
                        case 1:
                            $nombreDia = "Lunes";
                            break;
                        case 2:
                            $nombreDia = "Martes";
                            break;
                        case 3:
                            $nombreDia = "Miércoles";
                            break;
                        case 4:
                            $nombreDia = "Jueves";
                            break;
                        case 5:
                            $nombreDia = "Viernes";
                            break;
                        case 6:
                            $nombreDia = "Sábado";
                            break;
                    }
                    // Obtener el nombre completo del mes en español
                    setlocale(LC_TIME, 'es_ES');
                    $nombreMes = strftime('%B', strtotime($fecha->format('Y-m-d')));
                    $menuMessage .= "{$contador}. {$nombreDia} {$fecha->format('j')} de {$nombreMes}\n";
                }
                $contador++;
            }
        }
        
        $menuMessage .= "\nIngresá el número de la fecha en la que querés obtener un turno \n\n o escribí *salir* para cancelar.";
        sleep(1);
        return [
            'message_type' => 'text',
            'message' => [
                'message' => $menuMessage
            ]
        ];

        }
    
    elseif ($status === 'confirmaCita') {
        
        // Construir el mensaje del menú
            $menuMessage = confirmarCita($pdo, $from);
        
        }
        
    elseif ($status === 'menuCancelar') {
      
            // Construir el mensaje del menú
            $menuMessage = cancelarTurno($pdo, $from);
        }
        
    else  {

        // Construir el mensaje del menú
            $menuMessage = noValida($pdo, $from);
    }
    
}


?>
