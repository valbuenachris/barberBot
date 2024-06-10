<?php

    function confirmarCita($pdo, $from) {
    
            try{
                    // Incluir el archivo que contiene la API key
                    require_once 'api_key.php';
                    
                    $stmt = $pdo->query("SELECT * FROM citaConfirmada ORDER BY RAND() LIMIT 1");
                    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    // Construir el mensaje del menú
                    $menuMessage = "";
                    foreach ($menuItems as $item) {
                        $menuMessage .= "{$item['mensaje']}\n";
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
                    
                    // Actualizar la columna confirmada en la tabla booking
                    $stmt = $pdo->prepare("UPDATE booking SET estado = 'confirmada' WHERE user_id = ?");
                    $stmt->execute([$from]);
                    
                    // Actualizar la tabla horarios
                    $stmt = $pdo->prepare("
                        UPDATE horarios AS h
                        INNER JOIN booking AS b ON h.fecha = DATE(b.fecha) AND h.hora_inicio = TIME(b.hora)
                        SET h.estado = 'confirmada',
                            h.cliente = b.cliente,
                            h.servicio = b.servicio,
                            h.sucursal = b.sucursal,
                            h.user_id = b.user_id,
                            h.nombre_barbero = b.nombre_barbero
                        WHERE b.user_id = ?
                    ");
                    $stmt->execute([$from]);


                    // Actualizar el estado 
                    update_status($pdo, $from, 'menu');
                
    
            }catch (PDOException $e) {
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
    
?>
    
    