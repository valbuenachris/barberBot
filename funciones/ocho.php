<?php

function ocho($pdo, $from) {
    // Verificar si el estado es igual a 'inicio'
    $stmt = $pdo->prepare("SELECT status FROM booking WHERE user_id = ?");
    $stmt->execute([$from]);
    $status = $stmt->fetchColumn();

        if ($status === 'menuLasaigues') {
      
            // Construir el mensaje del menú
            $menuMessage = menuBarberos($pdo, $from);
                
            // Obtener el servicio de la tabla menuBarberia
            $stmt = $pdo->prepare("SELECT item FROM menuBarberia WHERE id = 8");
            $stmt->execute();
            $servicio = $stmt->fetchColumn();
            
            // Actualizar el estado 
            update_servicio($pdo, $from, $servicio);
            
        }
        
        elseif ($status === 'menuCabral') {
        
            // Construir el mensaje del menú
            $menuMessage = menuBarberosCabral($pdo, $from);
                
            // Obtener el servicio 'Corte de Pelo' de la tabla menuBarberia
            $stmt = $pdo->prepare("SELECT item FROM menuBarberia WHERE id = 4");
            $stmt->execute();
            $servicio = $stmt->fetchColumn();
            
            // Actualizar el estado 
            update_servicio($pdo, $from, $servicio);
            
        }
        
        else  {

        // Construir el mensaje del menú
            $menuMessage = noValida($pdo, $from);
    }
    }

?>
