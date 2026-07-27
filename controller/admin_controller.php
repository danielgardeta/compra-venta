<?php
// Aqui ponemos las rutas de los archivos que utilizamos para el admin
require_once __DIR__ . '/../model/connectaDB.php';
require_once __DIR__ . '/../model/mostrarCursos_model.php';
require_once __DIR__ . '/../model/detalleCurso_model.php';
require_once __DIR__ . '/../model/admin_model.php';

// conexión a la base de datos
$connection = DB::getInstance();

// Aqui ponemos la subacción que se va a realizar
$sub = $_GET['sub'] ?? 'list';
$message = '';

//Aqui ponemos los detalles de cada curso
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($sub === 'add') {
        
        $data = [
            'nombre' => $_POST['nombre'],
            'descripcion_larga' => $_POST['descripcion_larga'],
            'precio' => $_POST['precio'],
            'duracion' => $_POST['duracion'],
            'nivel' => $_POST['nivel'],
            'categoria_id' => $_POST['categoria_id'],
            'imagen' => 'default.png' 
        ];
        
       // Eto sirve para poner la imagen 
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../imagenes/';
            $fileName = basename($_FILES['imagen']['name']);
            
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadDir . $fileName)) {
                $data['imagen'] = $fileName;
            }
        }
        // Lo que estamos haciendo aqui sirve para que salga un mensaje si el curso se agregado correctamente o si hubo un error
        if (agregarCurso($connection, $data)) {
            $message = "Curso agregado correctamente.";
            $sub = 'list'; 
        } else {
            $message = "Error al agregar el curso.";
        }
    } elseif ($sub === 'edit') {
        
        $id = $_POST['id'];
        $data = [
            'nombre' => $_POST['nombre'],
            'descripcion_larga' => $_POST['descripcion_larga'],
            'precio' => $_POST['precio'],
            'duracion' => $_POST['duracion'],
            'nivel' => $_POST['nivel'],
            'categoria_id' => $_POST['categoria_id'],
            'imagen' => null
        ];
        // Este apartado es muy similiar al anterior pero cambia que estamos modificando el curso
        if (modificarCurso($connection, $id, $data)) {
            $message = "Curso modificado correctamente.";
            $sub = 'list';
        } else {
            $message = "Error al modificar el curso.";
        }
    } elseif ($sub === 'delete') {
         $id = $_POST['id'];
         if (eliminarCurso($connection, $id)) {
             $message = "Curso eliminado correctamente.";
             $sub = 'list';
         } else {
             $message = "Error al eliminar el curso.";
         }
    }
} else {
    // Aqui estamos haciendo que el admin pueda eliminar el curso elegido por el mismo
    if ($sub === 'delete' && isset($_GET['id'])) {
         $id = $_GET['id'];
         if (eliminarCurso($connection, $id)) {
             $message = "Curso eliminado correctamente.";
         } else {
             $message = "Error al eliminar el curso.";
         }
         $sub = 'list';
    }
}

// Aqui estamos haciendo que el admin pueda ver la lista de los cursos
if ($sub === 'list') {
    $cursos = obtenerCursos($connection);
    include __DIR__ . '/../views/admin_views.php';
} elseif ($sub === 'add_form') {
    include __DIR__ . '/../views/admin_form_view.php';
} elseif ($sub === 'edit_form') {
    if (isset($_GET['id'])) {
        $curso = obtenerCursoPorId($connection, $_GET['id']);
        if ($curso) {
            include __DIR__ . '/../views/admin_form_view.php';
        } else {
            echo "Curso no encontrado.";
        }
    } else {
        echo "ID no especificado.";
    }
}
?>
