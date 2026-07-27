<?php
// Este archivo lo utilizamos para que el usuario pueda cambiar su contraseña si no recuerda la anterior.

// Esta funcion sirve para obtener un usuario por su email
function obtenerUsuarioPorEmail($conexion, $email) {
    try {
        $consulta = $conexion->prepare("SELECT id, nombre, email, pregunta_seguridad, respuesta_seguridad FROM usuarios WHERE email = ?");
        $consulta->execute([$email]);
        return $consulta->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return false;
    }
}

// Esta funcion sirve para actualizar el password de un usuario
function actualizarPassword($conexion, $email, $new_password) {
    try {
        $password_hash = password_hash($new_password, PASSWORD_BCRYPT);
        $consulta = $conexion->prepare("UPDATE usuarios SET password = ? WHERE email = ?");
        return $consulta->execute([$password_hash, $email]);
    } catch(PDOException $e) {
        return false;
    }
}
