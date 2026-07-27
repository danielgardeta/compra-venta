<div class="admin-actions">
    <a href="admin.php?sub=add_form" class="btn btn-dark">Agregar Nuevo Curso</a>
</div>

<h2>Lista de Cursos (Admin)</h2>

<?php if (!empty($cursos)): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Duración</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cursos as $curso): ?>
                <tr>
                    <td><?php echo htmlspecialchars($curso['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($curso['duracion']); ?> h</td>
                    <td><?php echo htmlspecialchars($curso['precio']); ?> €</td>
                    <td>
                        <a href="admin.php?sub=edit_form&id=<?php echo $curso['id']; ?>" class="btn btn-success">Editar</a>
                        <a href="admin.php?sub=delete&id=<?php echo $curso['id']; ?>"  onclick="return confirm('¿Estás seguro de eliminar este curso?');" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay cursos disponibles en este momento.</p>
<?php endif; ?>
