<?php

function nueve($pdo, $from) {
    // Verificar si el estado es igual a 'inicio'
    $stmt = $pdo->prepare("SELECT status FROM sesiones WHERE user_id = ?");
    $stmt->execute([$from]);
    $status = $stmt->fetchColumn();

    if ($status === 'tiendasElectronicos') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM headerTiendas ORDER BY RAND() LIMIT 1");
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

        $response = sendCurlRequest($body);

        /*/////////////   SUBHEADER   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM menuTiendas");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   FOOTER   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerMenu ORDER BY RAND() LIMIT 1 ");
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

        $response = sendCurlRequest($body);

        // Actualizar el estado a 'inicio'
        $stmt = $pdo->prepare("UPDATE sesiones SET status = 'tiendas' WHERE user_id = ?");
        $stmt->execute([$from]);

        // Eliminar registros duplicados más antiguos para el mismo usuario
        $stmt = $pdo->prepare("DELETE s1 FROM sesiones s1 
                               INNER JOIN sesiones s2 
                               ON s1.user_id = s2.user_id 
                               AND s1.status = s2.status 
                               AND s1.id > s2.id 
                               WHERE s1.user_id = ?");
        $stmt->execute([$from]);

        return $response;
    }
    
    
    if ($status === 'tiendas') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM headerMenu ORDER BY RAND() LIMIT 1");
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

        $response = sendCurlRequest($body);

        /*/////////////   SUBHEADER   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM menu");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   FOOTER   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerMenu ORDER BY RAND() LIMIT 1 ");
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

        $response = sendCurlRequest($body);

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

        return $response;
    }
    
    
    if ($status === 'restaurantesRapidas') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM headerRestaurantes ORDER BY RAND() LIMIT 1");
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

        $response = sendCurlRequest($body);

        /*/////////////   SUBHEADER   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENU   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   FOOTER   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerMenu ORDER BY RAND() LIMIT 1 ");
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

        $response = sendCurlRequest($body);

        // Actualizar el estado a 'inicio'
        $stmt = $pdo->prepare("UPDATE sesiones SET status = 'restaurantes' WHERE user_id = ?");
        $stmt->execute([$from]);

        // Eliminar registros duplicados más antiguos para el mismo usuario
        $stmt = $pdo->prepare("DELETE s1 FROM sesiones s1 
                               INNER JOIN sesiones s2 
                               ON s1.user_id = s2.user_id 
                               AND s1.status = s2.status 
                               AND s1.id > s2.id 
                               WHERE s1.user_id = ?");
        $stmt->execute([$from]);

        return $response;
    }
    
    if ($status === 'restaurantes') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM headerMenu ORDER BY RAND() LIMIT 1");
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

        $response = sendCurlRequest($body);

        /*/////////////   SUBHEADER   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM menu");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   FOOTER   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerMenu ORDER BY RAND() LIMIT 1 ");
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

        $response = sendCurlRequest($body);

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

        return $response;
    }
    
    
    if ($status === 'pantalones' || $status === 'camisas') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM headerModaHombres ORDER BY RAND() LIMIT 1");
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

        $response = sendCurlRequest($body);

        /*/////////////   SUBHEADER   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM menuModaHombres");
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

        $response = sendCurlRequest($body);

        /*/////////////   FOOTER   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerMenu ORDER BY RAND() LIMIT 1 ");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

        // Actualizar el estado a 'modaHombres'
        $stmt = $pdo->prepare("UPDATE sesiones SET status = 'modaHombres' WHERE user_id = ?");
        $stmt->execute([$from]);

        // Eliminar registros duplicados más antiguos para el mismo usuario
        $stmt = $pdo->prepare("DELETE s1 FROM sesiones s1 
                               INNER JOIN sesiones s2 
                               ON s1.user_id = s2.user_id 
                               AND s1.status = s2.status 
                               AND s1.id > s2.id 
                               WHERE s1.user_id = ?");
        $stmt->execute([$from]);

        return $response;
    }
    
    
    if ($status === 'calzado' || $status === 'modaHombres' || $status === 'modaInfantil' 
    || $status === 'modaMujer' || $status === 'ropaDeportiva' || $status === 'vestidosBano'
    || $status === 'ropaDeportiva') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM headerModa ORDER BY RAND() LIMIT 1");
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

        $response = sendCurlRequest($body);

        /*/////////////   SUBHEADER   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM menuModa");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   FOOTER   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerMenu ORDER BY RAND() LIMIT 1 ");
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

        $response = sendCurlRequest($body);

        // Actualizar el estado a 'moda'
        $stmt = $pdo->prepare("UPDATE sesiones SET status = 'moda' WHERE user_id = ?");
        $stmt->execute([$from]);

        // Eliminar registros duplicados más antiguos para el mismo usuario
        $stmt = $pdo->prepare("DELETE s1 FROM sesiones s1 
                               INNER JOIN sesiones s2 
                               ON s1.user_id = s2.user_id 
                               AND s1.status = s2.status 
                               AND s1.id > s2.id 
                               WHERE s1.user_id = ?");
        $stmt->execute([$from]);

        return $response;
    }
    
    
    if ($status === 'calzadoDeportivo') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM headerCalzado ORDER BY RAND() LIMIT 1");
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

        $response = sendCurlRequest($body);

        /*/////////////   SUBHEADER   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM menuCalzado");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   FOOTER   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerMenu ORDER BY RAND() LIMIT 1 ");
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

        $response = sendCurlRequest($body);

        // Actualizar el estado a 'inicio'
        $stmt = $pdo->prepare("UPDATE sesiones SET status = 'calzado' WHERE user_id = ?");
        $stmt->execute([$from]);

        // Eliminar registros duplicados más antiguos para el mismo usuario
        $stmt = $pdo->prepare("DELETE s1 FROM sesiones s1 
                               INNER JOIN sesiones s2 
                               ON s1.user_id = s2.user_id 
                               AND s1.status = s2.status 
                               AND s1.id > s2.id 
                               WHERE s1.user_id = ?");
        $stmt->execute([$from]);

        return $response;
    }
    
    if ($status === 'moda') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM headerMenu ORDER BY RAND() LIMIT 1");
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

        $response = sendCurlRequest($body);

        /*/////////////   SUBHEADER   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENU   ////////////*/

        $stmt = $pdo->query("SELECT * FROM menu");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   FOOTER   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerMenu ORDER BY RAND() LIMIT 1 ");
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

        $response = sendCurlRequest($body);

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

        return $response;
    }
    
    
    if ($status === 'HotelesUrbanos') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

        /*/////////////   MENSAJE   ////////////*/

        $stmt = $pdo->query("SELECT * FROM headerHoteles ORDER BY RAND() LIMIT 1");
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

        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE subheader   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE 2   ////////////*/

        $stmt = $pdo->query("SELECT * FROM menuHoteles ");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE 3   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerMenu ORDER BY RAND() LIMIT 1 ");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

        // Actualizar el estado a 'hoteles'
        $stmt = $pdo->prepare("UPDATE sesiones SET status = 'hoteles' WHERE user_id = ?");
        $stmt->execute([$from]);

        // Eliminar registros duplicados más antiguos para el mismo usuario
        $stmt = $pdo->prepare("DELETE s1 FROM sesiones s1 
                               INNER JOIN sesiones s2 
                               ON s1.user_id = s2.user_id 
                               AND s1.status = s2.status 
                               AND s1.id > s2.id 
                               WHERE s1.user_id = ?");
        $stmt->execute([$from]);

        return $response;
    }
    
    
    if ($status === 'hoteles') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

        /*/////////////   MENSAJE   ////////////*/

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

        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE subheader   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE 2   ////////////*/

        $stmt = $pdo->query("SELECT * FROM menuAlojamientos ");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE 3   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerMenu ORDER BY RAND() LIMIT 1 ");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

        // Actualizar el estado a 'turismo'
        $stmt = $pdo->prepare("UPDATE sesiones SET status = 'alojamientos' WHERE user_id = ?");
        $stmt->execute([$from]);

        // Eliminar registros duplicados más antiguos para el mismo usuario
        $stmt = $pdo->prepare("DELETE s1 FROM sesiones s1 
                               INNER JOIN sesiones s2 
                               ON s1.user_id = s2.user_id 
                               AND s1.status = s2.status 
                               AND s1.id > s2.id 
                               WHERE s1.user_id = ?");
        $stmt->execute([$from]);

        return $response;
    }
    
    
    if ($status === 'alojamientos' || $status === 'turismoPlanes' || $status === 'turismoEventos') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

        /*/////////////   MENSAJE   ////////////*/

        $stmt = $pdo->query("SELECT * FROM headerTurismo ORDER BY RAND() LIMIT 1");
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

        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE subheader   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE 2   ////////////*/

        $stmt = $pdo->query("SELECT * FROM menuTurismo ");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE 3   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerMenu ORDER BY RAND() LIMIT 1 ");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

        // Actualizar el estado a 'turismo'
        $stmt = $pdo->prepare("UPDATE sesiones SET status = 'turismo' WHERE user_id = ?");
        $stmt->execute([$from]);

        // Eliminar registros duplicados más antiguos para el mismo usuario
        $stmt = $pdo->prepare("DELETE s1 FROM sesiones s1 
                               INNER JOIN sesiones s2 
                               ON s1.user_id = s2.user_id 
                               AND s1.status = s2.status 
                               AND s1.id > s2.id 
                               WHERE s1.user_id = ?");
        $stmt->execute([$from]);

        return $response;
    }
    
    
    if ($status === 'turismo') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

        /*/////////////   MENSAJE   ////////////*/

        $stmt = $pdo->query("SELECT * FROM headerMenu ORDER BY RAND() LIMIT 1");
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

        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE subheader   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE 2   ////////////*/

        $stmt = $pdo->query("SELECT * FROM menu ");
        $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Construir el mensaje del menú
        $menuMessage = "🏠 *MENU PRINCIAL*\n\n";
        foreach ($menuItems as $item) {
            $menuMessage .= "{$item['icono']} {$item['item']}\n";
        }
        
        // Mensaje de texto con el menú
        $body = array(
            "api_key" => $api_key,
            "receiver" => $from,
            "data" => array("message" => $menuMessage)
        );

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE 3   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerMenu ORDER BY RAND() LIMIT 1 ");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

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

        return $response;
    }
    
    if ($status === 'inicio') {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

        /*/////////////   MENSAJE   ////////////*/

        $stmt = $pdo->query("SELECT * FROM headerMenu ORDER BY RAND() LIMIT 1");
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

        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE subheader   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE 2   ////////////*/

        $stmt = $pdo->query("SELECT * FROM menuExplorar ");
        $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Construir el mensaje del menú
        $menuMessage = "🏠 *MENU PRINCIAL*\n\n";
        foreach ($menuItems as $item) {
            $menuMessage .= "{$item['icono']} {$item['item']}\n";
        }
        
        // Mensaje de texto con el menú
        $body = array(
            "api_key" => $api_key,
            "receiver" => $from,
            "data" => array("message" => $menuMessage)
        );

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE 3   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerMenu ORDER BY RAND() LIMIT 1 ");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

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

        return $response;
    }
    
    
    else  {

        // Incluir el archivo que contiene la API key
        require_once 'api_key.php';

        /*/////////////   MENSAJE   ////////////*/

        $stmt = $pdo->query("SELECT * FROM headerMenu ORDER BY RAND() LIMIT 1");
        $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Construir el mensaje del menú
        $menuMessage = "*OPCION NO VALIDA*";
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

        
        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE subheader   ////////////*/

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

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE 2   ////////////*/

        $stmt = $pdo->query("SELECT * FROM menu ");
        $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Construir el mensaje del menú
        $menuMessage = "🏠 *MENU PRINCIAL*\n\n";
        foreach ($menuItems as $item) {
            $menuMessage .= "{$item['icono']} {$item['item']}\n";
        }
        
        // Mensaje de texto con el menú
        $body = array(
            "api_key" => $api_key,
            "receiver" => $from,
            "data" => array("message" => $menuMessage)
        );

        sleep(1.5);
        $response = sendCurlRequest($body);

        /*/////////////   MENSAJE 3   ////////////*/

        $stmt = $pdo->query("SELECT * FROM footerMenu ORDER BY RAND() LIMIT 1 ");
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

        sleep(1.5);
        $response = sendCurlRequest($body);

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

        return $response;
    }
}

function sendCurlRequest($body) {
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

?>
