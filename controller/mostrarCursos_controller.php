<?php require_once __DIR__ . '/../model/connectaDB.php';
require_once __DIR__ . '/../model/mostrarCursos_model.php';
$connection = DB::getInstance();
$cursos = obtenerCursos($connection);
include __DIR__ . '/../views/mostrarCursos_views.php'; ?>