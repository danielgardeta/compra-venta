<?php

require_once __DIR__ . '/../model/connectaDB.php';
require_once __DIR__ . '/../model/detalleCurso_model.php';

// Iniciamos la sesión solo si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si el carrito no existe en la sesión, lo creamos como un array vacío
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}


$action = $_GET['action'] ?? 'carrito';

if ($action === 'add_to_cart') {

    // Verificamos que sea POST y que venga el id del curso
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['curso_id'])) {

        $curso_id = $_POST['curso_id'];

        // Obtenemos la conexión a la BD
        $connection = DB::getInstance();

        // Buscamos el curso por su ID
        $curso = obtenerCursoPorId($connection, $curso_id);

        // Si el curso existe
        if ($curso) {

            // Revisamos si el curso ya está en el carrito
            $found = false;
            foreach ($_SESSION['carrito'] as $item) {
                if ($item['id'] == $curso_id) {
                    $found = true;
                    break;
                }
            }

            // Si no está en el carrito, lo agregamos
            if (!$found) {
                $_SESSION['carrito'][] = $curso;
            }
        }
    }

    // Redirigimos al carrito
    header('Location: index.php?action=carrito');
    exit;
}

if ($action === 'remove_from_cart') {

    // Verificamos que venga el ID por GET
    if (isset($_GET['id'])) {

        $id_to_remove = $_GET['id'];

        // Buscamos el curso y lo eliminamos
        foreach ($_SESSION['carrito'] as $key => $item) {
            if ($item['id'] == $id_to_remove) {
                unset($_SESSION['carrito'][$key]);
                break;
            }
        }

        // Reordenamos el array para evitar huecos
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }

    // Volvemos al carrito
    header('Location: index.php?action=carrito');
    exit;
}


if ($action === 'remove_from_cart_ajax') {

    // Indicamos que la respuesta será JSON
    header('Content-Type: application/json');

    // Leemos los datos enviados por AJAX
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Verificamos que venga el ID
    if (isset($data['id'])) {

        $id_to_remove = $data['id'];
        $removed = false;

        // Buscamos y eliminamos el curso
        foreach ($_SESSION['carrito'] as $key => $item) {
            if ($item['id'] == $id_to_remove) {
                unset($_SESSION['carrito'][$key]);
                $removed = true;
                break;
            }
        }

        // Si se eliminó correctamente
        if ($removed) {

            
            $_SESSION['carrito'] = array_values($_SESSION['carrito']);

            
            $newTotal = 0;
            foreach ($_SESSION['carrito'] as $c) {
                $newTotal += $c['precio'];
            }

            
            echo json_encode([
                'success' => true,
                'total' => $newTotal
            ]);
            exit;
        }
    }

    // Esto sirve para enviar un error si algo falla
    echo json_encode(['success' => false]);
    exit;
}

// Finalmente cargamos la vista del carrito
include __DIR__ . '/../views/carrito_view.php';
?>
