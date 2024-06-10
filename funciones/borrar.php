<?php

    function borrar($pdo, $from) {
        try {
            $sql = "DELETE FROM booking WHERE user_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$from]);
            
            $sql = "DELETE FROM sesiones WHERE user_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$from]);
    
            return [
                'message_type' => 'text',
                'message' => [
                    'message' => 'Ya puedes iniciar de nuevo en nuestro *MENÚ PRINCIPAL*.'
                ]
            ];
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
            die();
        }
    }
    
    
    
