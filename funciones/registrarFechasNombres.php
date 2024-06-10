
<?php

    function mostrarHorariosDia($pdo, $from, $numeroDia) {
        
        // Verificar si el número de día seleccionado es válido (0 representa el día de hoy)
        if ($numeroDia < 0 || $numeroDia > 6) {
            return [
                'message_type' => 'text',
                'message' => [
                    'message' => 'Por favor, selecciona un número de día válido (entre 0 y 6).'
                ]
            ];
        }
        
            // Establecer la fecha actual y la hora actual de Buenos Aires
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fechaActual = date('Y-m-d');
            $horaActual = date('H:i:s');
    
                // Calcular la fecha del día seleccionado, incluyendo hoy
                $fechaSeleccionada = date('Y-m-d', strtotime("{$fechaActual} +{$numeroDia} days"));
    
                    // Actualizar la fecha en la tabla 'booking' para el usuario especificado
                    $stmtUpdate = $pdo->prepare("UPDATE booking SET fecha = ? WHERE user_id = ?");
                    $stmtUpdate->execute([$fechaSeleccionada, $from]); 
        
            // Preparar la consulta SQL para buscar los horarios disponibles para la fecha seleccionada y posterior a la hora actual
            $stmt = $pdo->prepare("SELECT hora_inicio FROM horarios WHERE fecha = ? AND estado = 'disponible' AND hora_inicio > ? ORDER BY hora_inicio ASC");
    
            // Ejecutar la consulta con la fecha seleccionada y la hora actual
            $stmt->execute([$fechaSeleccionada, $horaActual]);
    
                // Recuperar los resultados
                $horariosDisponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                    // Verificar si hay horarios disponibles para la fecha seleccionada
                    if (empty($horariosDisponibles)) {
                        // Actualizar el estado a 'mhd' solo si hay una sesión activa
                        if ($from && isset($_SESSION['session_id'])) {
                            update_status($pdo, $from, 'mhd');
                        }
                        
                        $menuMessage = '⛔ No hay turnos disponibles para el día seleccionado.';
                        
                        return [
                            'message_type' => 'text',
                            'message' => [
                                'message' => $menuMessage
                            ]
                        ];
                    } else {
                        // Actualizar el estado a 'hora' solo si hay una sesión activa
                        if ($from && isset($_SESSION['session_id'])) {
                            update_status($pdo, $from, 'hora');
                        }
    
                // Formatear el día y mes para mostrar en el mensaje
                setlocale(LC_TIME, 'es_ES');
                $diaMes = strftime('%e de %B', strtotime($fechaSeleccionada));
    
            $menuMessage = "🕗 Turnos disponibles para el " . $diaMes . ":\n\n";
            foreach ($horariosDisponibles as $horario) {
                // Mostrar solo la hora de inicio
                $horaInicio = date('H:i', strtotime($horario['hora_inicio']));
                $menuMessage .= $horaInicio . "\n";
            }
    
            // Actualizar la tabla booking con la fecha seleccionada solo si hay una sesión activa
            if ($from && isset($_SESSION['session_id'])) {
                $stmtUpdate = $pdo->prepare("UPDATE booking SET fecha = ? WHERE user_id = ?");
                $stmtUpdate->execute([$fechaSeleccionada, $from]);
            }
            
            update_status($pdo, $from, 'hora');
            
            // Enviar un nuevo mensaje para que escriba la hora
            $menuMessage .= "\nEscribí la hora en la que deseás tu turno; debe tener el siguiente formato (HH:MM), por ejemplo: 09:00 \n\n o escribí *salir* para cancelar.";
    
            return [
                'message_type' => 'text',
                'message' => [
                    'message' => $menuMessage
                ]
            ];
        }
    }


    function agendarHora($pdo, $from, $message) {
        try {
            // Verificar si $message es un valor de tiempo válido en formato 'HH:mm'
            if (!preg_match('/^\d{1,2}:\d{2}$/', $message)) {
                // Si no es un formato de tiempo válido, intentar convertirlo a hora
                if (is_numeric($message) && $message >= 0 && $message <= 23) {
                    // Si $message es un número entero válido, asignarlo a la hora
                    $hora = sprintf("%02d:00", $message);
                } else {
                    // Si no es un valor de tiempo válido ni un número entero válido, lanzar una excepción
                    throw new Exception("El valor de hora ingresado no es válido.");
                }
            } else {
                // Si $message es un valor de tiempo válido en formato 'HH:mm', asignarlo a la hora
                $hora = $message;
            }
    
            // Preparar la consulta SQL para actualizar la hora en la tabla booking
            $stmt = $pdo->prepare("UPDATE booking SET hora = ? WHERE user_id = ?");
            
            // Ejecutar la consulta para actualizar la hora
            $stmt->execute([$hora, $from]);
    
            // Preparar la consulta SQL para actualizar los valores de la columna 'hora' en la tabla 'booking' para un 'user_id' específico
            $stmt = $pdo->prepare("
                UPDATE booking AS b
                INNER JOIN horarios AS h ON b.hora = h.hora_inicio
                SET b.hora = h.hora_inicio
                WHERE b.user_id = ?");
    
            // Ejecutar la consulta para actualizar los números basados en los horarios
            $stmt->execute([$from]);
    
            // Construir el mensaje de confirmación de la hora
            $menuMessage = "¡Hora agendada para el turno! \n\n⏰ *{$hora}*";
    
            // Establecer la API utilizando la constante definida en api_key.php
            $api_key = API_KEY;
    
            // Mensaje de texto con el menú
            $body = array(
                "api_key" => $api_key,
                "receiver" => $from,
                "data" => array("message" => $menuMessage)
            );
    
            // Enviar solicitud de texto
            $response = sendCurlRequestText($body);
    
            // Solicitar el nombre del usuario
            $menuMessage = "Por favor, escribí tu nombre.";
    
            // Mensaje de texto con la solicitud del nombre
            $body = array(
                "api_key" => $api_key,
                "receiver" => $from,
                "data" => array("message" => $menuMessage)
            );
    
            // Enviar solicitud de texto para el nombre
            $response = sendCurlRequestText($body);
    
            // Actualizar el estado a 'nombre'
            update_status($pdo, $from, 'nombre');
            
            return $response;
        } catch (PDOException $e) {
            // Manejar errores de la base de datos
            return [
                'message_type' => 'text',
                'message' => [
                    'message' => 'Error en la base de datos: ' . $e->getMessage()
                ]
            ];
        } catch (Exception $e) {
            // Manejar otros errores
            return [
                'message_type' => 'text',
                'message' => [
                    'message' => 'Error: ' . $e->getMessage()
                ]
            ];
        }
    }
    
    
    function agendarNombre($pdo, $from, $message) {
        // Preparar la consulta SQL para actualizar la hora en la tabla booking
        $stmt = $pdo->prepare("UPDATE booking SET cliente = ? WHERE user_id = ?");
        
        // Obtener el ID del usuario desde $from (asumiendo que $from contiene el ID del usuario)
        $user_id = $from;
    
        // Ejecutar la consulta para actualizar la hora
        $stmt->execute([$message, $user_id]);
    
        // Consultar el estado del pedido y el nombre para el usuario dado
            $stmt = $pdo->prepare("SELECT nombre_barbero, fecha, servicio, hora, cliente, sucursal FROM booking WHERE user_id = ?");
            $stmt->execute([$from]); // Ejecutar la consulta
            $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener los resultados de la consulta
            
            // Verificar si hay resultados
            if (empty($menuItems)) {
                return [
                    'message_type' => 'text',
                    'message' => [
                        'message' => 'No se encontraron citas para este usuario.'
                    ]
                ];
            }
    
            // Construir el mensaje a partir de los resultados de la consulta
            $menuMessage = '*🧾 Acá tenés el resumen de tu turno:*';
            foreach ($menuItems as $item) {
                // Formatear la hora para mostrar solo horas y minutos
                $horaFormateada = date("H:i", strtotime($item['hora']));
                
                $menuMessage .= "\n\n👤 *Cliente:* {$item['cliente']} \n📅 *Fecha:* {$item['fecha']}  \n⏱️ *Hora:* {$horaFormateada}  \n👨🏻‍🦰 *Barbero:* {$item['nombre_barbero']} \n💈 *Servicio:* {$item['servicio']} \n🏬 *Sucursal:* {$item['sucursal']}";
            }
    
    
        // Establecer la API utilizando la constante definida en api_key.php
        $api_key = API_KEY;
    
        // Mensaje de texto con el menú
        $body = array(
            "api_key" => $api_key,
            "receiver" => $from,
            "data" => array("message" => $menuMessage)
        );
    
        // Enviar solicitud de texto
        $response = sendCurlRequestText($body);
        
        /////////////////////////////
        
        $stmt = $pdo->query("SELECT * FROM menuConfirmar");
        $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Construir el mensaje del menú
        $menuMessage = "🤖 ¿Querés confirmar tu turno?\n\n";
        foreach ($menuItems as $item) {
            $menuMessage .= "{$item['icono']} {$item['item']}\n";
        }
        // Establecer la API utilizando la constante definida en api_key.php
        $api_key = API_KEY;
    
        // Mensaje de texto con el menú
        $body = array(
            "api_key" => $api_key,
            "receiver" => $from,
            "data" => array("message" => $menuMessage)
        );
    
        // Enviar solicitud de texto
        $response = sendCurlRequestText($body);
        
        // Actualizar el estado a 'calzado'
        update_status($pdo, $from, 'confirmaCita');
        
        return $response;
    }

?>
