<?php

    function menuTurnos($pdo, $from) {
        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';
        
        // Consultar en la tabla horarios si el user_id tiene citas confirmadas
        $stmt = $pdo->prepare("SELECT fecha, hora_inicio FROM horarios WHERE user_id = ? AND estado = 'confirmada'");
        $stmt->execute([$from]);
        $citasConfirmadas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Verificar si el usuario tiene citas confirmadas
        if (!empty($citasConfirmadas)) {
            $menuMessage = "Ya tenés turno agendado:\n";
            foreach ($citasConfirmadas as $cita) {
                $fechaCita = date('d/m/Y', strtotime($cita['fecha']));
                $horaCita = date('H:i', strtotime($cita['hora_inicio']));
                $menuMessage .= "Fecha: $fechaCita, Hora: $horaCita\n";
            }
            
            // Enviar mensaje con las citas confirmadas
            $api_key = API_KEY;
            $body = array(
                "api_key" => $api_key,
                "receiver" => $from,
                "data" => array("message" => $menuMessage)
            );
            $response = sendCurlRequestText($body);
            
        // Establecer la API utilizando la constante definida en api_key.php
        $api_key = API_KEY;
        
        // Consultar un mensaje aleatorio para la bienvenida
        $stmt = $pdo->query("SELECT * FROM menuTurnos");
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
        update_status($pdo, $from, 'menuTurnos');
        
        }
        
        elseif (empty($citasConfirmadas)) {
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
        
}

    
?>
    
    