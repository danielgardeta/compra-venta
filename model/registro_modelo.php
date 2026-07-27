<?php

// Esta funcion sirve para insertar un usuario en la base de datos
function insertarUsuario($conexion, $nombre, $email, $password_hash, $rol, $pregunta, $respuesta) {
    try {
        $consulta = $conexion->prepare("
            INSERT INTO usuarios 
            (nombre, email, password, rol, pregunta_seguridad, respuesta_seguridad, fecha_registro)
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");

        $consulta->execute([
            $nombre,
            $email,
            $password_hash,
            $rol,
            $pregunta,
            $respuesta
        ]);

        return true;

    } catch(PDOException $e){
        return false;
    }
}

// Esta funcion sirve para verificar si el email ya existe en la base de datos
function verificarEmail($conexion, $email) {
    try {
        $consulta = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
        $consulta->execute([$email]);
        return $consulta->fetchColumn() > 0;
    } catch(PDOException $e) {
        return false;
    }
}

