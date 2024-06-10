<?php

    function porDefecto($pdo, $from) {

        // Consultar el perfil del usuario
        $stmt = $pdo->prepare("SELECT * FROM booking WHERE user_id = ?");
        $stmt->execute([$from]);
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($pedido && isset($pedido['status']) && $pedido['status'] != '') {

            $menuMessage = registrarUsuario($pdo, $from);
            $menuMessage = inicioBienvenida($pdo, $from);
        }
        
        elseif ($pedido && isset($pedido['perfil']) && $pedido['perfil'] == 'invitado') {
            
                    $menuMessage = construirMenuInvitado($pdo, $from);
                
            }
        
        else {
            
            $menuMessage = registrarUsuario($pdo, $from);
            $menuMessage = inicioBienvenida($pdo, $from);
        }
        
    }
    
?>
