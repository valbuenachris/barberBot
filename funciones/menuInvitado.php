<?php

function construirMenuInvitado($pdo, $from) {
    
    // Verificar si el estado es igual a 'inicio'
    $stmt = $pdo->prepare("SELECT status FROM sesiones WHERE user_id = ?");
    $stmt->execute([$from]);
    $status = $stmt->fetchColumn();

    /*/////////////////////////////////////////////////////////////////
    /////////////   ESTABLECE EL ESTATUS DEL USUARIO     /////////////   
    ////////////////////////////////////////////////////////////////*/
    
    if ($status = 'desconocido') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

       
    
    
    /*/////////////   MENSAJE   ////////////*/

        $stmt = $pdo->query("SELECT * FROM iconosDefecto ORDER BY RAND() LIMIT 1");
        $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Construir el mensaje del menú
        $menuMessage = "";
        foreach ($menuItems as $item) {
            $menuMessage .= "{$item['mensaje']}";
        }

        // Establecer la API utilizando la constante definida en api_key.php
        $api_key = API_KEY;

        // Mensaje de texto con el menú
        $body = array(
            "api_key" => $api_key,
            "receiver" => $from,
            "data" => array("message" => $menuMessage)
        );

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://bot.educol.club/api/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => [
                "Accept: */*",
                "Content-Type: application/json",
            ],
        ]);

        sleep(1.5);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        }
        
        
         /*/////////////   MENSAJE IMAGEN  ////////////*/
        
        
        // Establecer la API utilizando la constante definida en api_key.php
        $api_key = API_KEY;

        
    $body = array(
        "api_key" => $api_key,
        "receiver" => "$from",
        "data" => array(
            "url" => "https://bot.educol.club/app/storage?url=2/logo_tienderu_bot.png",
            "media_type" => "image",
            "caption" => ""
        )
    );

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://bot.educol.club/api/send-media",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => [
            "Accept: */*",
            "Content-Type: application/json",
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        
    }
        
        /*/////////////   MENSAJE   ////////////*/

        $stmt = $pdo->query("SELECT * FROM headerInvitados ORDER BY RAND() LIMIT 1");
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

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://bot.educol.club/api/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => [
                "Accept: */*",
                "Content-Type: application/json",
            ],
        ]);

        sleep(1.5);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        }

        /*/////////////   MENSAJE 2   ////////////*/

        $stmt = $pdo->query("SELECT * FROM subHeaderInvitados ORDER BY RAND() LIMIT 1 ");
        $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Construir el mensaje del menú
        $menuMessage = "";
        foreach ($menuItems as $item) {
            $menuMessage .= "{$item['mensaje']}";
            
            
        }
        
        // Mensaje de texto con el menú
        $body = array(
            "api_key" => $api_key,
            "receiver" => $from,
            "data" => array("message" => $menuMessage)
        );

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://bot.educol.club/api/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => [
                "Accept: */*",
                "Content-Type: application/json",
            ],
        ]);

        sleep(1);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        }
        
       
        /*/////////////   MENSAJE 3   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerDefecto ORDER BY RAND() LIMIT 1 ");
        $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Construir el mensaje del menú
        $menuMessage = "";
        foreach ($menuItems as $item) {
            $menuMessage .= "{$item['mensaje']} ";
        }
        
        // Mensaje de texto con el menú
        $body = array(
            "api_key" => $api_key,
            "receiver" => $from,
            "data" => array("message" => $menuMessage)
        );

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://bot.educol.club/api/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => [
                "Accept: */*",
                "Content-Type: application/json",
            ],
        ]);

        sleep(1);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        }
        
        // Actualizar el estado a 'inicio'
        $stmt = $pdo->prepare("UPDATE sesiones SET status = 'inicio' WHERE user_id = ?");
        $stmt->execute([$from]);

        // Eliminar registros duplicados más antiguos para el mismo usuario
        $stmt = $pdo->prepare("DELETE s1 FROM sesiones s1 
                               INNER JOIN sesiones s2 
                               ON s1.user_id = s2.user_id 
                               AND s1.status = s2.status 
                               AND s1.id > s2.id 
                               WHERE s1.user_id = ?");
        $stmt->execute([$from]);
        
        
        
         /*/////////////   MENSAJE   ////////////*/

        $stmt = $pdo->query("SELECT * FROM menuDefecto");
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

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://bot.educol.club/api/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => [
                "Accept: */*",
                "Content-Type: application/json",
            ],
        ]);

        sleep(1.5);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        }

        
    }
}

?>
