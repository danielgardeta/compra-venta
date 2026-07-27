<?php
require_once '../model/connectaDB.php';
require_once '../model/registro_modelo.php';

header('Content-Type: application/json');
// Aqui estamos haciendo que el email sea verificado, utilizamos AJAX para que el email sea verificado sin recargar la página
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $conexion = DB::getInstance();
        $existe = verificarEmail($conexion, $email);
        
        echo json_encode(['existe' => $existe]);
    } else {
        echo json_encode(['error' => 'Email inválido']);
    }
} else {
    echo json_encode(['error' => 'Solicitud inválida']);
}
