<?php

function obtenerCursoPorId($connection, $id) {
    // Mostramos toda la info a detalle de los cursos
    try {
        $consulta = $connection->prepare("SELECT * FROM cursos WHERE id = :id");
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}
?>
