<?php

    function menuCabral($pdo, $from) {
    
            try{
                    // Incluir el archivo que contiene la API key
                    require_once 'api_key.php';
                
                    /*/////////////   MENSAJE   ////////////*/
                
                    $stmt = $pdo->query("SELECT * FROM headerOpciones ORDER BY RAND() LIMIT 1");
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
                        
                    
                    
                    /*/////////////   MENSAJE   ////////////*/
                
                    $stmt = $pdo->query("SELECT * FROM menuBarberia");
                    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                    // Construir el mensaje del menú
                    $menuMessage = "";
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
            
                    // Actualizar el estado 
                    update_status($pdo, $from, 'menuCabral');
                    
                    // Actualizar el estado 
                    update_sucursal($pdo, $from, 'Sargento Cabral 3400');
                
    
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
    
    