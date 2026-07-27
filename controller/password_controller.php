<?php
require_once __DIR__ . '/../model/connectaDB.php';
require_once __DIR__ . '/../model/password_model.php';

$error = null;
$mensaje = null;
$step = 1;
$email = '';
$usuario = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = DB::getInstance();
    
    if (isset($_POST['verificar_email'])) {
        $email = $_POST['email'] ?? '';
        $usuario = obtenerUsuarioPorEmail($conexion, $email);
        
        if ($usuario) {
            $step = 2;
        } else {
            $error = "El correo electrónico no está registrado.";
        }
    } elseif (isset($_POST['reset_password'])) {
        $email = $_POST['email'] ?? '';
        $respuesta = $_POST['respuesta_seguridad'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        
        $usuario = obtenerUsuarioPorEmail($conexion, $email);
        
        if ($usuario) {
            // Verificar respuesta (simple string comparison, or case-insensitive?)
            // Assuming case-insensitive for better UX
            if (strcasecmp($usuario['respuesta_seguridad'], $respuesta) === 0) {
                if (actualizarPassword($conexion, $email, $new_password)) {
                    $mensaje = "Contraseña actualizada correctamente. <a href='?action=home'>Iniciar sesión</a>";
                    $step = 3; // Success state
                } else {
                    $error = "Error al actualizar la contraseña.";
                    $step = 2;
                }
            } else {
                $error = "Respuesta de seguridad incorrecta.";
                $step = 2;
            }
        } else {
            $error = "Error inesperado.";
        }
    }
}

// Renderizar la vista
include __DIR__ . '/../contraseña.php';
