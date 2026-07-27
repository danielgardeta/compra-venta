<!-- views/detalleCursoView.php -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<h2>Detalle del Curso</h2>

<div>
    <h3><?php echo $curso['nombre']; ?></h3>
    <img src="imagenes/<?php echo $curso['imagen']; ?>" alt="<?php echo $curso['nombre']; ?>" width="200">
    <p><strong>Precio:</strong> <?php echo $curso['precio']; ?> €</p>
    <p><strong>Duración:</strong> <?php echo $curso['duracion']; ?> horas</p>
    <p><strong>Nivel:</strong> <?php echo $curso['nivel']; ?></p>
    <p><strong>Categoría:</strong> <?php echo $curso['categoria_id']; ?></p>
    <p><strong>Descripción:</strong> <?php echo $curso['descripcion_larga']; ?></p>
</div>

<a href="index.php?action=cursos">Volver al listado de cursos</a>