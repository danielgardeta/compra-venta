<?php
$isEdit = isset($curso);
$actionTarget = $isEdit ? 'edit' : 'add';
$actionTitle = $isEdit ? 'Editar Curso' : 'Agregar Nuevo Curso';

$nombre = $isEdit ? $curso['nombre'] : '';
$duracion = $isEdit ? $curso['duracion'] : '';
$precio = $isEdit ? $curso['precio'] : '';
$descripcion_larga = $isEdit ? $curso['descripcion_larga'] : '';
$nivel = $isEdit ? $curso['nivel'] : '';
$categoria_id = $isEdit ? $curso['categoria_id'] : '';
$imagen = $isEdit ? $curso['imagen'] : '';
?>


<link rel="stylesheet" href="form.css">




<h2><?php echo $actionTitle; ?></h2>

<form action="admin.php?sub=<?php echo $actionTarget; ?>" method="POST" enctype="multipart/form-data"
    class="form-centrado">

    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?php echo $curso['id']; ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required
            class="form-control">
    </div>

    <div class="mb-3">
        <label for="duracion" class="form-label">Duración (horas):</label>
        <input type="number" id="duracion" name="duracion" value="<?php echo htmlspecialchars($duracion); ?>" required
            class="form-control">
    </div>

    <div class="mb-3">
        <label for="precio" class="form-label">Precio (€):</label>
        <input type="number" step="0.01" id="precio" name="precio"
            value="<?php echo htmlspecialchars($precio); ?>" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="nivel" class="form-label">Nivel:</label>
        <input type="text" id="nivel" name="nivel" value="<?php echo htmlspecialchars($nivel); ?>"
            class="form-control">
    </div>

    <div class="mb-3">
        <label for="categoria_id" class="form-label">ID Categoría:</label>
        <input type="number" id="categoria_id" name="categoria_id"
            value="<?php echo htmlspecialchars($categoria_id); ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label for="descripcion_larga" class="form-label">Descripción:</label>
        <textarea id="descripcion_larga" name="descripcion_larga" rows="5"
            class="form-control"><?php echo htmlspecialchars($descripcion_larga); ?></textarea>
    </div>

    <div class="mb-3">
        <label for="imagen" class="form-label">Imagen:</label>
        <?php if ($isEdit && $imagen): ?>
            <p>Actual: <img src="imagenes/<?php echo htmlspecialchars($imagen); ?>" width="100"></p>
        <?php endif; ?>
        <input type="file" id="imagen" name="imagen" class="form-control">
    </div>

    <button type="submit" class="btn btn-success"><?php echo $actionTitle; ?></button>
    <a href="admin.php" class="btn btn-secondary">Cancelar</a>
</form>
