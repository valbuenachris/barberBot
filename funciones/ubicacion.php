<?php

    function ubicacion($pdo, $from) {
    
        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

            $stmt = $pdo->query("SELECT * FROM headerUbicacion ORDER BY RAND() LIMIT 1");
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

        // Establecer la API utilizando la constante definida en api_key.php
        $api_key = API_KEY;
        
            $body = array(
                "api_key" => $api_key,
                "receiver" => "$from",
                "data" => array(
                    "url" => "http://bot.tienderu.com/app/storage?url=1/banus_lasaigues_ubicacion.png",
                    "media_type" => "image",
                    "caption" => "Mariano Castex 3173, B1804 Canning, Provincia de Buenos Aires, Argentina"
                )
            );
        
        // Enviar solicitud de texto
        $response = sendCurlRequestImage($body);
        
        // Establecer la API utilizando la constante definida en api_key.php
        $api_key = API_KEY;
        
            $body = array(
                "api_key" => $api_key,
                "receiver" => "$from",
                "data" => array(
                    "url" => "http://bot.tienderu.com/app/storage?url=1/banus_cabral_ubicacion.png",
                    "media_type" => "image",
                    "caption" => "Sgto. Cabral 3400 Oficina 19 , B1801 Canning Mariano Castex 3173, B1804, B1804 Canning, Provincia de Buenos Aires, Argentina"
                )
            );
        
        // Enviar solicitud de texto
        $response = sendCurlRequestImage($body);
        
        $stmt = $pdo->query("SELECT * FROM subHeaderUbicacion ORDER BY RAND() LIMIT 1");
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
        
        $menuMessage = menuInicio($pdo, $from);
        
    }
    
    function horarios($pdo, $from) {
    
        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

            $stmt = $pdo->query("SELECT * FROM subHeaderUbicacion ORDER BY RAND() LIMIT 1");
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
            
    
        $menuMessage = menuInicio($pdo, $from);
        
    
    }

    
?>
