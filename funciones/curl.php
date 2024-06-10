<?php

function update_servicio($pdo, $from, $new_status) {
    // Actualizar el estado del usuario
    $stmt = $pdo->prepare("UPDATE booking SET servicio = ? WHERE user_id = ?");
    $stmt->execute([$new_status, $from]);
    
    // Eliminar registros duplicados para el mismo usuario, manteniendo solo el último
    $stmt = $pdo->prepare("DELETE FROM booking 
                           WHERE id NOT IN (SELECT MAX(id) 
                                            FROM (SELECT id FROM booking WHERE user_id = ?) AS temp) 
                           AND user_id = ?");
    $stmt->execute([$from, $from]);
}


function update_status($pdo, $from, $new_status) {
    // Actualizar el estado del usuario
    $stmt = $pdo->prepare("UPDATE booking SET status = ? WHERE user_id = ?");
    $stmt->execute([$new_status, $from]);
    
    // Eliminar registros duplicados para el mismo usuario, manteniendo solo el último
    $stmt = $pdo->prepare("DELETE FROM booking 
                           WHERE id NOT IN (SELECT MAX(id) 
                                            FROM (SELECT id FROM booking WHERE user_id = ?) AS temp) 
                           AND user_id = ?");
    $stmt->execute([$from, $from]);
}



function update_sucursal($pdo, $from, $new_status) {
    // Actualizar el estado del usuario
    $stmt = $pdo->prepare("UPDATE booking SET sucursal = ? WHERE user_id = ?");
    $stmt->execute([$new_status, $from]);
    
    // Eliminar registros duplicados para el mismo usuario, manteniendo solo el último
    $stmt = $pdo->prepare("DELETE FROM booking 
                           WHERE id NOT IN (SELECT MAX(id) 
                                            FROM (SELECT id FROM booking WHERE user_id = ?) AS temp) 
                           AND user_id = ?");
    $stmt->execute([$from, $from]);
}


// Función para enviar CURL de texto
function sendCurlRequestText($body) {
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "http://bot.tienderu.com/api/send-message",
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

// Función para enviar CURL de imagen
function sendCurlRequestImage($body) {
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "http://bot.tienderu.com/api/send-media",
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