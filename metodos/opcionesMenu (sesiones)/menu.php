<?php

function menu($pdo, $from) {
    try {
        

    $stmt = $pdo->query("SELECT * FROM mensajeAntiguo ORDER BY RAND() LIMIT 1");
    $menuItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Construir el mensaje del menú
    $menuMessage = "";
    foreach ($menuItems as $item) {
        $menuMessage .= "{$item['mensaje']}\n";
    }
        
    } catch (PDOException $e) {
        // Manejar excepciones PDO
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
        die();
    } catch (Exception $e) {
        // Manejar otras excepciones
        echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        die();
    }
    
    // Actualizar el estado a 'calzado'
        update_status($pdo, $from, 'inicio');
    
    return $response;
}

?>