<?php
header('Content-Type: application/json');
// Aqui estamos haciendo que el password sea verificado, utilizamos AJAX para que el password sea verificado sin recargar la página
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $password = $_POST['password'];
    
    if (strlen($password) >= 8) {
        echo json_encode(['valid' => true]);
    } else {
        echo json_encode(['valid' => false, 'message' => 'La contraseña debe tener al menos 8 caracteres.']);
    }
} else {
    echo json_encode(['error' => 'Solicitud inválida']);
}
