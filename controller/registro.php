<?php

require_once __DIR__ . '/../model/connectaDB.php';
require_once __DIR__ . '/../model/registro_modelo.php';

$connection = DB::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recoger datos
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $pregunta_seguridad = trim($_POST['pregunta_seguridad'] ?? '');
    $respuesta_seguridad = trim($_POST['respuesta_seguridad'] ?? '');

    $errores = [];


    // Obligatorios
    if (
        empty($nombre) ||
        empty($email) ||
        empty($password) ||
        empty($pregunta_seguridad) ||
        empty($respuesta_seguridad)
    ) {
        $errores[] = "Todos los campos son obligatorios.";
    }

    // Nombre
    if (strlen($nombre) < 4 || strlen($nombre) > 40) {
        $errores[] = "El nombre debe tener entre 4 y 40 caracteres.";
    }

    // Password
    if (strlen($password) < 8 || strlen($password) > 20) {
        $errores[] = "La contraseña debe tener entre 8 y 20 caracteres.";
    }

    // Email formato
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email no tiene un formato válido.";
    }

    // Email duplicado (seguridad real)
    if (verificarEmail($connection, $email)) {
        $errores[] = "El email ya está registrado.";
    }

    // Si hay errores vuelve al form
    if (!empty($errores)) {
        $_SESSION['errores_registro'] = $errores;
        header("Location: ?action=registro");
        exit;
    }

    // rol
    $rol = (strtolower($nombre) === 'admin') ? 'Administrador' : 'usuario';

    // hashea contraseña antes de subirla
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // insert
    if (insertarUsuario(
        $connection,
        $nombre,
        $email,
        $password_hash,
        $rol,
        $pregunta_seguridad,
        $respuesta_seguridad
    )) {
        header("Location: ?action=login");
        exit;
    } else {
        $_SESSION['errores_registro'] = ["Error al registrar el usuario."];
        header("Location: ?action=registro");
        exit;
    }

} else {
    header("Location: ?action=registro");
    exit;
}
