<?php
require_once __DIR__ . '/../model/connectaDB.php';
require_once __DIR__ . '/../model/detalleCurso_model.php';

$connection = DB::getInstance();

$curso_id = $_GET['id'] ?? null;

if ($curso_id) {
    // Obtener los datos del curso
    $curso = obtenerCursoPorId($connection, $curso_id);

    if ($curso) {
        // Incluir la vista con los detalles
        include __DIR__ . '/../views/detalleCurso_view.php';
    } else {
        echo "Curso no encontrado.";
    }
} else {
    echo "ID de curso no válido.";
}
?>