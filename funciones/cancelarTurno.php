<?php

function cancelarTurno($pdo, $from) {
    try {
        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';
    
        $sql = "UPDATE horarios 
                SET cliente = '', user_id = '', nombre_barbero = '', servicio = '', sucursal = '', estado = 'disponible' 
                WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$from]);    
        
        /////////////////////////////////////////
        
        // Establecer la API utilizando la constante definida en api_key.php
        $api_key = API_KEY;
        
        // Construir el mensaje del menú
        $menuMessage = "Su turno ha sido *CANCELADO*";
        
        
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
