<?php 
// Esta funcion sirve para obtener todos los cursos de la base de datos
function obtenerCursos($connection)
{
    try {
        $consulta = $connection->prepare("SELECT nombre, precio, id, duracion, imagen FROM CURSOS");
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}