<?php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php?action=home');
    exit;
}
?>
<?php include __DIR__ . '/layouts/header.php'; ?>


  <div class="intro">
    <!-- coge el nombre con el q se ha iniciado sesión  -->
    <h1>Hola, <span style="color:#e6007e"><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span></h1>
    <p>Bienvenido a tu panel principal.</p>
    <a href ="?action=cursos">Ir a listado de cursos</a>
  </div>

</body>
</html>
