<?php

    function sucursales($pdo, $from) {
        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';
        
        // Establecer la API utilizando la constante definida en api_key.php
        $api_key = API_KEY;
        
        // Consultar un mensaje aleatorio para la bienvenida
        $stmt = $pdo->query("SELECT * FROM headerSucursales ORDER BY RAND() LIMIT 1");
        $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Construir el mensaje del menú
            $menuMessage = "";
            foreach ($menuItems as $item) {
                $menuMessage .= "{$item['mensaje']}";
            }
            
            // Mensaje de texto 
            $body = array(
                "api_key" => $api_key,
                "receiver" => $from,
                "data" => array("message" => $menuMessage)
            );
        
        // Enviar solicitud de texto
        $response = sendCurlRequestText($body);
        
        // Establecer la API utilizando la constante definida en api_key.php
        $api_key = API_KEY;
        
        // Consultar un mensaje aleatorio para la bienvenida
        $stmt = $pdo->query("SELECT * FROM menuSucursales");
        $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Construir el mensaje del menú
            $menuMessage = "";
            foreach ($menuItems as $item) {
                $menuMessage .= "{$item['icono']} {$item['item']}\n";
            }
            
            // Mensaje de texto 
            $body = array(
                "api_key" => $api_key,
                "receiver" => $from,
                "data" => array("message" => $menuMessage)
            );
        
        // Enviar solicitud de texto
        $response = sendCurlRequestText($body);
        
        // Actualizar el estado 
        update_status($pdo, $from, 'sucursales');
        
        
    }

    
?>
    
    