<?php
session_start();

// Verifica se a sessão foi iniciada corretamente
if (session_status() == PHP_SESSION_ACTIVE) {
    $_SESSION['secretary_id'] = 1;
    $_SESSION['tipo_secretary'] = 'secretaria';
    $session_id = session_id();
    
    // Salva o ID da sessão no arquivo
    file_put_contents("session_id.txt", $session_id);
    echo "Session ID: " . $session_id . "\n";
} else {
    echo "Não foi possível iniciar a sessão\n";
}
?>
