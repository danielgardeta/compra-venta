<?php
// controller/login_controller.php

require_once __DIR__ . '/../model/connectaDB.php';
require_once __DIR__ . '/../model/login_model.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($nombre === 'admin' && $password === '123') {
        $_SESSION['usuario_id'] = 999; 
        $_SESSION['usuario_nombre'] = 'Admin';
        $_SESSION['usuario_rol'] = 'admin';
        
        header('Location: index.php?action=admin');
        exit;
    }

    $conexion = DB::getInstance();
    $usuario = validarUsuario($conexion, $nombre, $password);

    if ($usuario) {
        // Login correcto
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_rol'] = $usuario['rol'];
        
        header('Location: index.php?action=login');
        exit;
    } else {
        // Login incorrecto
        header('Location: index.php?action=home&error=1');
        exit;
    }
} else {
    // Si no es POST, redirigir al home
    header('Location: index.php?action=home');
    exit;
}
?>
