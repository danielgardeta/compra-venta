<?php include __DIR__ . '/layouts/header.php'; ?>
<link rel="stylesheet" href="public/css/form.css">

<!-- Mensaje de bienvenida -->
<div class="intro">
  <h1>Bienvenido a <span style="color:#e6007e">CodeNest</span></h1>
</div>

<div class="login-box">
  <h2>Login</h2>

  <!-- Mensaje de error si el login falla -->
  <?php if (isset($_GET['error'])): ?>
      <p style="color: red; text-align: center;">
          Usuario o contraseña incorrectos.
      </p>
  <?php endif; ?>

  <!-- Aqui mostramos el formulario de Login para que los clientes regristrados puedan iniciar sesión.
   También es donde los Administradores pueden iniciar sesión -->
  <form action="index.php?action=iniciar_sesion" method="POST" class="form-centrado">

    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" class="form-control" required>
    </div>  

    <!-- Estos dos links sirven para que los usuarios puedan registrase y para los que han olvidado su contraseña puedan recuperarla -->
    <p class="mt-2">
        <a href="index.php?action=contraseña">¿Has olvidado tu contraseña?</a>
    </p>
    <p class="mt-1">
        <a href="index.php?action=registro">Registrarse</a>
    </p>

    <!-- Botón de envío -->
    <button type="submit" class="btn btn-dark">
        Iniciar sesión
    </button>
  </form>
</div>

</body>
</html>
