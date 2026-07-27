<?php
// Aqui estamos haciendo que el admin pueda agregar un curso, modificar un curso y eliminar un curso.

/* Aqui estamos haciendo que el admin pueda agregar un curso, lo que hacemos es coger los datos del formularios 
y meterlos en la base de datos con el bindParam */
function agregarCurso($connection, $data) {
    try {
        $sql = "INSERT INTO cursos (nombre, descripcion_larga, precio, duracion, nivel, categoria_id, imagen) 
                VALUES (:nombre, :descripcion_larga, :precio, :duracion, :nivel, :categoria_id, :imagen)";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':descripcion_larga', $data['descripcion_larga']);
        $stmt->bindParam(':precio', $data['precio']);
        $stmt->bindParam(':duracion', $data['duracion']);
        $stmt->bindParam(':nivel', $data['nivel']);
        $stmt->bindParam(':categoria_id', $data['categoria_id']);
        $stmt->bindParam(':imagen', $data['imagen']);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}
/* Aqui podemos ver que hacemos lo mismo pero con la funcion modificarCurso, 
 lo unico que cambiamos es que en la consulta SQL hacemos un UPDATE para modificar los datos del curso */
function modificarCurso($connection, $id, $data) {
    try {
       
        $sql = "UPDATE cursos SET 
                nombre = :nombre, 
                descripcion_larga = :descripcion_larga, 
                precio = :precio, 
                duracion = :duracion, 
                nivel = :nivel, 
                categoria_id = :categoria_id";
        
        if (!empty($data['imagen'])) {
            $sql .= ", imagen = :imagen";
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':descripcion_larga', $data['descripcion_larga']);
        $stmt->bindParam(':precio', $data['precio']);
        $stmt->bindParam(':duracion', $data['duracion']);
        $stmt->bindParam(':nivel', $data['nivel']);
        $stmt->bindParam(':categoria_id', $data['categoria_id']);
        if (!empty($data['imagen'])) {
            $stmt->bindParam(':imagen', $data['imagen']);
        }
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}
/* Aqui podemos ver que hacemos lo mismo pero con la funcion eliminarCurso, 
 lo unico que cambiamos es que en la consulta SQL hacemos un DELETE para eliminar el curso */
function eliminarCurso($connection, $id) {
    try {
        $stmt = $connection->prepare("DELETE FROM cursos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}
?>
