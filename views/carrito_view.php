<?php include __DIR__ . '/../layouts/header.php'; ?>
<div class="container mt-5">
    <h2>Tu Carrito de Compras</h2>
    <?php if (empty($_SESSION['carrito'])): ?>
        <p class="mt-3">
            Tu carrito está vacío. <a href="index.php?action=cursos">Ver Cursos</a>
        </p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Curso</th>
                    <th>Precio</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach ($_SESSION['carrito'] as $curso): 
                    $total += $curso['precio'];
                ?>
                <tr>
                    <td>
                        <?php if(!empty($curso['imagen'])): ?>
                            <img src="imagenes/<?php echo htmlspecialchars($curso['imagen']); ?>" alt="<?php echo htmlspecialchars($curso['nombre']); ?>" style="width: 50px; height: auto;">
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($curso['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($curso['precio']); ?> €</td>
                    <td>
                        <a href="index.php?action=remove_from_cart&id=<?php echo $curso['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-end">Total</th>
                    <th><?php echo $total; ?> €</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        <div class="d-flex justify-content-between">
            <a href="index.php?action=cursos" class="btn btn-secondary">Seguir comprando</a>
            <button class="btn btn-primary">Pagar</button>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
