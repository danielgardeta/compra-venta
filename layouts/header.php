<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CodeNest DA</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- <link rel="stylesheet" href="/public/css/home.css"> -->
</head>

<body>

  <!-- NAVBAR Menú-->
  <nav class="navbar navbar-dark bg-dark">
    <div class="container">

      <!-- SI LA SESION NO ESTA INICIADA Q MUESTRE UN MENÚ  -->
       <!-- Navbar hecha con boostrap, CodeNest como "titulo" navbar-brand, y lo demás son los items del menú (nav-item) -->
        <?php if (!isset($_SESSION['usuario_id'])): ?>
          <a class="navbar-brand" href="index.php">CodeNest</a>
          <ul class="navbar-nav d-flex flex-row">
            <li class="nav-item me-3">
              <a class="nav-link text-white" href="index.php">Inicio</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link text-white" href="index.php?action=conocenos">Conócenos</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link text-white" href="index.php?action=registro">Registrarse</a>
            </li>
          <?php endif; ?>



        <!-- Si esta la sesión iniciada, muestra otro menu -->
        <?php if (isset($_SESSION['usuario_id'])): ?>
          <a class="navbar-brand" href="index.php?action=login">CodeNest</a>
          <ul class="navbar-nav d-flex flex-row">
            <li class="nav-item me-3">
              <a class="nav-link text-white" href="index.php?action=login">Panel</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link text-white" href="index.php?action=carrito">Carrito</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link text-white" href="index.php?action=conocenos">Conócenos</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link text-white" href="index.php?action=cerrar">Cerrar Sesión</a>
            </li>
          <?php endif; ?>


          


        </ul>
    </div>
  </nav>