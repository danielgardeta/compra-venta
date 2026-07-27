<?php
// admin.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario es administrador
if (!isset($_SESSION['usuario_rol']) || ($_SESSION['usuario_rol'] !== 'Administrador' && $_SESSION['usuario_rol'] !== 'admin')) {
    // Si no es admin, redirigir a home o mostrar error
    header('Location: ?action=home');
    exit;
}
?>
<?php include __DIR__ . '/layouts/header.php'; ?>

    <h1 class="page-title">Panel de Administración</h1>

    <div class="courses-container">
        
        <div class="admin-welcome">
             <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>.</p>
        </div>

        <?php include __DIR__ . '/controller/admin_controller.php'; ?>
    </div>
</body>
</html>
