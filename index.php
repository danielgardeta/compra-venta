<?php
session_start();
$action = $_GET['action'] ?? null;

/* Aqui vemos el Router que sirve para gestionar 
las rutas de la aplicacion de manera mas segura y correcta */

switch ($action) {

    case null:
    case 'home':
        include __DIR__ . '/home.php';
        break;

    case 'login':
        include __DIR__ . '/login.php';
        break;

    case 'registro':
        include __DIR__ . '/registrarse.php';
        break;

    case 'cursos':
        include __DIR__ . '/cursos.php';
        break;

    case 'admin':
        include __DIR__ . '/admin.php';
        break;

    case 'conocenos':
        include __DIR__ . '/conocenosUnPocoMas.php';
        break;

    // Controladores

    case 'registrarse':
        require_once __DIR__ . '/controller/registro.php';
        break;

    case 'iniciar_sesion':
        require_once __DIR__ . '/controller/login_controller.php';
        break;

    case 'cerrar':
        require_once __DIR__ . '/controller/cerrarSesion_controller.php';
        break;


    case 'contraseña':
        include __DIR__ . '/contraseña.php';
        break;

    case 'procesar_reset':
        require_once __DIR__ . '/controller/password_controller.php';
        break;

    case 'detalleCurso':
        include __DIR__ . '/controller/detalleCurso_controller.php';
        break;

    case 'carrito':
    case 'add_to_cart':
    case 'remove_from_cart':
        include __DIR__ . '/controller/carrito_controller.php';
        break;
    default:
        include __DIR__ . '/error.php';
        break;

}

?>