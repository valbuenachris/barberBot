<?php

function registrarUsuario($pdo, $from) {
    try {
        $sql = "DELETE FROM booking WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$from]);
        
        // Insertar un nuevo registro si el usuario no existe
        $stmt = $pdo->prepare("INSERT INTO booking (user_id, status, cliente) VALUES (?, 'inicio', 'desconocido')");
        $stmt->execute([$from]);
        
        // Retorna un mensaje de éxito si el usuario se registró correctamente
        return "Usuario registrado exitosamente.";
    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        return "Error al registrar el usuario: " . $e->getMessage();
    }
}

?>
