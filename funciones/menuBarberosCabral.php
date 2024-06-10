<?php

    function menuBarberos($pdo, $from) {
    
            try{
                    // Incluir el archivo que contiene la API key
                    require_once 'api_key.php';
                        
                    $stmt = $pdo->query("SELECT * FROM subHeaderBarberos ORDER BY RAND() LIMIT 1");
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
                    
                    /////////////////////////////////////
                    
                    // Establecer la API utilizando la constante definida en api_key.php
                    $api_key = API_KEY;
                    
                    // Mensaje de imagen
                    $body = array(
                        "api_key" => $api_key,
                        "receiver" => "$from",
                        "data" => array(
                            "url" => "http://bot.tienderu.com/app/storage?url=1/emiliano_banus.jpeg",
                            "media_type" => "image",
                            "caption" => "*1. EMILIANO BANUS* \n💇🏻‍♂️ Especialidad: Cortes Modernos y peinados de tendencia. \n🕒 Experiencia: Más de 10 años en la industria de la barbería."
                        )
                    );
            
                    // Enviar CURL de la solicitud de imagen
                    $response = sendCurlRequestImage($body);
                    
                    /////////////////////////////////////
                    
                    // Establecer la API utilizando la constante definida en api_key.php
                    $api_key = API_KEY;
                    
                    // Mensaje de imagen
                    $body = array(
                        "api_key" => $api_key,
                        "receiver" => "$from",
                        "data" => array(
                            "url" => "http://bot.tienderu.com/app/storage?url=1/enzo_banus.jpeg",
                            "media_type" => "image",
                            "caption" => "*2. ENZO BANUS* \n💇🏻‍♂️ Especialidad: Cortes Modernos y peinados de tendencia. \n🕒 Experiencia: Más de 4 años en la industria de la barbería."
                        )
                    );
            
                    // Enviar CURL de la solicitud de imagen
                    $response = sendCurlRequestImage($body);
                    
                    /*/////////////   MENSAJE   ////////////*/
                
                    $stmt = $pdo->query("SELECT * FROM footerBarberos ORDER BY RAND() LIMIT 1");
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
            
                    // Actualizar el estado 
                    update_status($pdo, $from, 'barberoCabral');
                
    
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
    
    