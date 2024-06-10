<?php

function inicioBienvenida($pdo, $from) {
    try {
        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';
    
        // Establecer la API utilizando la constante definida en api_key.php
        $api_key = API_KEY;
        
        // Mensaje de imagen
        $body = array(
            "api_key" => $api_key,
            "receiver" => "$from",
            "data" => array(
                "url" => "http://bot.tienderu.com/app/storage?url=1/logoBanusBarber.jpeg",
                "media_type" => "image",
                "caption" => ""
            )
        );

        // Enviar CURL de la solicitud de imagen
        $response = sendCurlRequestImage($body);
        
        /////////////////////////////////////////
        
        // Establecer la API utilizando la constante definida en api_key.php
        $api_key = API_KEY;
        
        // Consultar un mensaje aleatorio para la bienvenida
        $stmt = $pdo->query("SELECT * FROM mensajeNuevo ORDER BY RAND() LIMIT 1");
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
        
        /////////////////////////////////////////
        
        // Establecer la API utilizando la constante definida en api_key.php
        $api_key = API_KEY;
        
        // Consultar un mensaje aleatorio para la bienvenida
        $stmt = $pdo->query("SELECT * FROM headerInvitados ORDER BY RAND() LIMIT 1");
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
        
        /////////////////////////////////////////
        
        // Establecer la API utilizando la constante definida en api_key.php
        $api_key = API_KEY;
        
        // Consultar un mensaje aleatorio para la bienvenida
        $stmt = $pdo->query("SELECT * FROM menuInicio");
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
        update_status($pdo, $from, 'inicio');
        
        /////////////////////////////////////////
        

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

?>
