<?php
    
    function info($pdo, $from) {
        // Validar si el remitente está autorizado
        if ($from !== '5491168496060@s.whatsapp.net') {
            // Si no está autorizado, enviar un mensaje de no autorizado
            $menuMessage = '🚫 No estás autorizado para acceder a esta información.';
            
            // Establecer la API utilizando la constante definida en api_key.php
            $api_key = API_KEY;
        
            // Mensaje de texto con el menú
            $body = array(
                "api_key" => $api_key,
                "receiver" => $from,
                "data" => array("message" => $menuMessage)
            );
        
            // Enviar solicitud de texto
            return sendCurlRequestText($body);
        }
        
        // Consultar la información de los turnos confirmados
        $stmt = $pdo->prepare("SELECT nombre_barbero, fecha, servicio, hora_inicio, cliente, sucursal, user_id FROM horarios WHERE estado = 'confirmada'");
        $stmt->execute(); // Ejecutar la consulta
        $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener los resultados de la consulta
    
        // Verificar si hay resultados
        if (empty($menuItems)) {
            // Si no hay turnos agendados, enviar un mensaje informativo
            $menuMessage = '⛔ No tienes turnos agendados. ';
        } else {
            // Construir el mensaje a partir de los resultados de la consulta
            $menuMessage = '*🧾 Acá tenés toda la agenda de turnos:*';
            foreach ($menuItems as $item) {
                // Formatear la hora para mostrar solo horas y minutos
                $horaFormateada = date("H:i", strtotime($item['hora_inicio']));
                // Añadir la información del turno al mensaje
                $menuMessage .= "\n\n📅 *Fecha:* {$item['fecha']} \n⏱️ *Hora:* {$horaFormateada}  \n👤 *Cliente:* {$item['cliente']} \n📞 *Teléfono:* " . substr($item['user_id'], 0, 12) . " \n👨🏻‍🦰 *Barbero:* {$item['nombre_barbero']} \n💈 *Servicio:* {$item['servicio']} \n🏬 *Sucursal:* {$item['sucursal']}";
            }
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
        return sendCurlRequestText($body);
    }
    
    
    function ver($pdo, $from) {
        try {
            // Consultar todos los registros de la tabla booking
            $stmt = $pdo->prepare("SELECT nombre_barbero, fecha, hora_inicio, cliente FROM horarios WHERE estado = 'confirmada'");
            $stmt->execute(); // Ejecutar la consulta
            $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener los resultados de la consulta
            
            // Verificar si hay resultados
            if (empty($menuItems)) {
                return [
                    'message_type' => 'text',
                    'message' => [
                        'message' => 'No se encontraron citas confirmadas.'
                    ]
                ];
            }
    
            // Construir el mensaje a partir de los resultados de la consulta
            $menuMessage = '*Acá tenés el resumen de tu turno*';
            foreach ($menuItems as $item) {
                // Formatear la hora para mostrar solo horas y minutos
                $horaFormateada = date("H:i", strtotime($item['hora_inicio']));
                
                $menuMessage .= "\nFecha: {$item['fecha']} \nBarbero: {$item['nombre_barbero']}  \nHora: {$horaFormateada} \nCliente: {$item['cliente']} \n";
            }
    
            // Actualizar el estado a 'calzado'
            update_status($pdo, $from, 'inicio');
    
            // Crear el array de respuesta con el mensaje construido
            $responseData = [
                'message_type' => 'text',
                'message' => [
                    'message' => $menuMessage
                ]
            ];
    
            // Devolver los datos de respuesta
            return $responseData;
        } catch (PDOException $e) {
            // Manejar excepciones PDO
            return [
                'message_type' => 'text',
                'message' => [
                    'message' => 'Error en la base de datos: ' . $e->getMessage()
                ]
            ];
        } catch (Exception $e) {
            // Manejar otras excepciones
            return [
                'message_type' => 'text',
                'message' => [
                    'message' => 'Error: ' . $e->getMessage()
                ]
            ];
        }
    }

?>