<?php
// Validamos el usuario y contraseña para iniciar sesión
function validarUsuario($conexion, $nombre, $password) {
    try {
        $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE nombre = ?");
        $consulta->execute([$nombre]);
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        } else {
            return false;
        }

    } catch(PDOException $e){
        return false;
    }
}
?>