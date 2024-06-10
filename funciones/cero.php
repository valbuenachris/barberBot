<?php

function cero($pdo, $from) {
    // Verificar si el estado es igual a 'inicio'
    $stmt = $pdo->prepare("SELECT status FROM booking WHERE user_id = ?");
    $stmt->execute([$from]);
    $status = $stmt->fetchColumn();

        if ($status === 'hora') {
            $menuMessage = salir($pdo, $from);
        }
        
        else  {

        // Construir el mensaje del menú
            $menuMessage = noValida($pdo, $from);
    }
    }

?>
