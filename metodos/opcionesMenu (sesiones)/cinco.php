<?php

function cinco($pdo, $from) {
    // Verificar si el estado es igual a 'inicio'
    $stmt = $pdo->prepare("SELECT status FROM sesiones WHERE user_id = ?");
    $stmt->execute([$from]);
    $status = $stmt->fetchColumn();

    if ($status === 'restaurantes') {
        // Si el estado no es 'inicio', retornar un mensaje indicando que la acción no es válida
        
    // Incluir el archivo que contiene la API key
    require_once 'api_key.php';

    $stmt = $pdo->query("SELECT * FROM headerRestaurantesGourmet ORDER BY RAND() LIMIT 1");
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

    
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    

    if ($err) {
        return "cURL Error #:" . $err;
    }

    /*/////////////   MENSAJE IMAGEN 1 ////////////*/

    $body = array(
        "api_key" => $api_key,
        "receiver" => "$from",
        "data" => array(
            "url" => "https://bot.educol.club/app/storage?url=2/Captura-de-Pantalla-2024-02-01-a-las-9.20.45-a.m..png",
            "media_type" => "image",
            "caption" => "*GLAMPING CRS* \n📝: 3143181438\n📍: Km 3 Vía Restrepo"
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }

    /*/////////////   MENSAJE 2   ////////////*/

    $stmt = $pdo->query("SELECT * FROM subHeaderResultados ORDER BY RAND() LIMIT 1");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Construir el mensaje del menú
    $menuMessage = "";
    foreach ($menuItems as $item) {
        $menuMessage .= "{$item['mensaje']}\n";
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }

    /*/////////////   MENSAJE 2   ////////////*/

    // Consultar un establecimiento aleatorio con la clave 'perros calientes'
    $stmt = $pdo->query("SELECT * FROM establecimientos  ");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Construir el mensaje del menú
    $menuMessage = "*HOTELES URBANOS*\n";
    foreach ($menuItems as $item) {
        $menuMessage .= "_______________________\n{$item['nombre']}\n{$item['telefono']}\n{$item['website']}\n";
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }
    
    /*/////////////   MENSAJE 2   ////////////*/

    // Consultar un establecimiento aleatorio con la clave 'perros calientes'
    $stmt = $pdo->query("SELECT * FROM footerResultados ORDER BY RAND() LIMIT 1");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Construir el mensaje del menú
    $menuMessage = "";
    foreach ($menuItems as $item) {
        $menuMessage .= "{$item['mensaje']}\n";
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }
    
    /*/////////////   MENSAJE 2   ////////////*/

    // Consultar un establecimiento aleatorio con la clave 'perros calientes'
    $stmt = $pdo->query("SELECT * FROM menuRestaurantes");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Construir el mensaje del menú
    $menuMessage = "";
    foreach ($menuItems as $item) {
        $menuMessage .= "{$item['icono']} {$item['item']}\n";
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }
    
        update_status($pdo, $from, 'restaurantes');
    
    return $response;
    }
    
    elseif ($status === 'alojamientos') {
        // Si el estado no es 'inicio', retornar un mensaje indicando que la acción no es válida
        
    // Incluir el archivo que contiene la API key
    require_once 'api_key.php';

    $stmt = $pdo->query("SELECT * FROM headerGlamping ORDER BY RAND() LIMIT 1");
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

    
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    

    if ($err) {
        return "cURL Error #:" . $err;
    }

    /*/////////////   MENSAJE IMAGEN 1 ////////////*/

    $body = array(
        "api_key" => $api_key,
        "receiver" => "$from",
        "data" => array(
            "url" => "https://bot.educol.club/app/storage?url=2/Captura-de-Pantalla-2024-02-01-a-las-9.20.45-a.m..png",
            "media_type" => "image",
            "caption" => "*GLAMPING CRS* \n📝: 3143181438\n📍: Km 3 Vía Restrepo"
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }

    /*/////////////   MENSAJE 2   ////////////*/

    $stmt = $pdo->query("SELECT * FROM subHeaderResultados ORDER BY RAND() LIMIT 1");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Construir el mensaje del menú
    $menuMessage = "";
    foreach ($menuItems as $item) {
        $menuMessage .= "{$item['mensaje']}\n";
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }

    /*/////////////   MENSAJE 2   ////////////*/

    // Consultar un establecimiento aleatorio con la clave 'perros calientes'
    $stmt = $pdo->query("SELECT * FROM establecimientos  ");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Construir el mensaje del menú
    $menuMessage = "*HOTELES URBANOS*\n";
    foreach ($menuItems as $item) {
        $menuMessage .= "_______________________\n{$item['nombre']}\n{$item['telefono']}\n{$item['website']}\n";
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }
    
    /*/////////////   MENSAJE 2   ////////////*/

    // Consultar un establecimiento aleatorio con la clave 'perros calientes'
    $stmt = $pdo->query("SELECT * FROM footerCabanas ORDER BY RAND() LIMIT 1");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Construir el mensaje del menú
    $menuMessage = "";
    foreach ($menuItems as $item) {
        $menuMessage .= "{$item['mensaje']}\n";
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }
    
    /*/////////////   MENSAJE 2   ////////////*/

    // Consultar un establecimiento aleatorio con la clave 'perros calientes'
    $stmt = $pdo->query("SELECT * FROM menuAlojamientos");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Construir el mensaje del menú
    $menuMessage = "";
    foreach ($menuItems as $item) {
        $menuMessage .= "{$item['icono']} {$item['item']}\n";
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }

        // Actualizar el estado a 'alojamientos'
        update_status($pdo, $from, 'alojamientos');
    
    return $response;
        
    }
    
    elseif ($status === 'moda') {
        // Si el estado no es 'inicio', retornar un mensaje indicando que la acción no es válida
        
    // Incluir el archivo que contiene la API key
    require_once 'api_key.php';

    $stmt = $pdo->query("SELECT * FROM headerRopaDeportiva ORDER BY RAND() LIMIT 1");
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

    
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    
    if ($err) {
        return "cURL Error #:" . $err;
    }
    
    /*/////////////   MENSAJE 2   ////////////*/

    $stmt = $pdo->query("SELECT * FROM subHeader ORDER BY RAND() LIMIT 1");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Construir el mensaje del menú
    $menuMessage = "";
    foreach ($menuItems as $item) {
        $menuMessage .= "{$item['mensaje']}\n";
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }
    
    /*/////////////   MENSAJE 2   ////////////*/

    // Consultar un establecimiento aleatorio con la clave 'perros calientes'
    $stmt = $pdo->query("SELECT * FROM menuRopaDeportiva");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Construir el mensaje del menú
    $menuMessage = "";
    foreach ($menuItems as $item) {
        $menuMessage .= "{$item['icono']} {$item['item']}\n";
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }
    
        update_status($pdo, $from, 'ropaDeportiva');
    
    return $response;
        
    }
    
    elseif ($status === 'calzado') {
        // Si el estado no es 'inicio', retornar un mensaje indicando que la acción no es válida
        
    // Incluir el archivo que contiene la API key
    require_once 'api_key.php';

    $stmt = $pdo->query("SELECT * FROM headerCalzadoDeportivo ORDER BY RAND() LIMIT 1");
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

    
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    

    if ($err) {
        return "cURL Error #:" . $err;
    }
    
    /*/////////////   MENSAJE 2   ////////////*/

    // Consultar un establecimiento aleatorio con la clave 'perros calientes'
    $stmt = $pdo->query("SELECT * FROM footerResultados ORDER BY RAND() LIMIT 1");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Construir el mensaje del menú
    $menuMessage = "";
    foreach ($menuItems as $item) {
        $menuMessage .= "{$item['mensaje']}\n";
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }
    
    /*/////////////   MENSAJE 2   ////////////*/

    // Consultar un establecimiento aleatorio con la clave 'perros calientes'
    $stmt = $pdo->query("SELECT * FROM menuCalzadoDeportivo");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Construir el mensaje del menú
    $menuMessage = "";
    foreach ($menuItems as $item) {
        $menuMessage .= "{$item['icono']} {$item['item']}\n";
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }
    
        update_status($pdo, $from, 'calzadoDeportivo');
    
    return $response;
        
    }
    
    elseif ($status === 'inicio') {
        // Si el estado no es 'inicio', retornar un mensaje indicando que la acción no es válida
        
    // Incluir el archivo que contiene la API key
    require_once 'api_key.php';

    $stmt = $pdo->query("SELECT * FROM headerAlojamientos ORDER BY RAND() LIMIT 1");
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

    
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    

    if ($err) {
        return "cURL Error #:" . $err;
    }
    
    /*/////////////   MENSAJE 2   ////////////*/

    // Consultar un establecimiento aleatorio con la clave 'perros calientes'
    $stmt = $pdo->query("SELECT * FROM subHeader ORDER BY RAND() LIMIT 1");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Construir el mensaje del menú
    $menuMessage = "";
    foreach ($menuItems as $item) {
        $menuMessage .= "{$item['mensaje']}\n";
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }
    
    /*/////////////   MENSAJE 2   ////////////*/

    // Consultar un establecimiento aleatorio con la clave 'perros calientes'
    $stmt = $pdo->query("SELECT * FROM menuAlojamientos");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Construir el mensaje del menú
    $menuMessage = "";
    foreach ($menuItems as $item) {
        $menuMessage .= "{$item['icono']} {$item['item']}\n";
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

    sleep(1.5);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    }
    
    update_status($pdo, $from, 'alojamientos');
    
    return $response;
    }
    
    else  {

    // Incluir el archivo que contiene la API key
    require_once 'api_key.php';

    // Construir el mensaje del menú
    $menuMessage = "*OPCIÓN NO VÁLIDA*";
    
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

    return $response;
    }
}

?>
