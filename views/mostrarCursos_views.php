<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<h2>Lista de Cursos</h2>

<?php if (!empty($cursos)): ?>
    <?php foreach ($cursos as $curso): ?>



        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <img src="imagenes/<?php echo htmlspecialchars($curso['imagen']); ?>" class="card-img-top" >
                <h3 class="card-title"><?php echo htmlspecialchars($curso['nombre']); ?></h3>
                <p class="card-text">Duración: <?php echo htmlspecialchars($curso['duracion']); ?> horas</p>
                <p class="card-text"><strong><?php echo htmlspecialchars($curso['precio']); ?> €</strong></p>
                <a href="index.php?action=detalleCurso&id=<?php echo $curso['id']; ?>" class="btn btn-primary">Ver Detalles</a>
                
                <form action="index.php?action=add_to_cart" method="POST" style="display:inline;">
                    <input type="hidden" name="curso_id" value="<?php echo $curso['id']; ?>">
                    <button type="submit" class="btn btn-success">Añadir al carrito</button>
                </form>
            </div>
        </div>


    <?php endforeach; ?>
<?php else: ?>
    <p>No hay cursos disponibles en este momento.</p>
<?php endif; ?>