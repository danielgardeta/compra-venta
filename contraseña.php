<?php include __DIR__ . '/layouts/header.php'; ?>
<!-- Cargamos el CSS del formulario -->
<link rel="stylesheet" href="public/css/form.css?v=<?php echo time(); ?>">

<div class="login-box">
    <h2>Recuperar Contraseña</h2>

    <!-- Muestra mensaje de error si existe -->
    <?php if (isset($error)): ?>
        <p class="error-msg"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Lo mismo que lo anterior si funciona muestra un mensaje de exito -->
    <?php if (isset($mensaje)): ?>
        <p class="success-msg"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <!-- Aqui pedimos el correo del usuario -->
    <?php if (!isset($step) || $step == 1): ?>
        <form action="index.php?action=procesar_reset" method="POST" class="form-centrado">
            <div class="mb-3">
                <label for="email" class="form-label">Ingresa tu correo electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <button type="submit" name="verificar_email" class="btn btn-dark">Continuar</button>
        </form>

    <!-- Para este punto hacemos que el usuario ponga una pregunta de seguridad y una nueva contraseña -->
    <?php elseif ($step == 2): ?>
        <form action="index.php?action=procesar_reset" method="POST" class="form-centrado">

            <!-- Guardamos el email para no perderlo -->
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">

            <!-- Mostramos la pregunta de seguridad -->
            <p>
                Pregunta de seguridad:
                <strong><?php echo htmlspecialchars($usuario['pregunta_seguridad']); ?></strong>
            </p>

            <div class="mb-3">
                <label for="respuesta_seguridad" class="form-label">Respuesta:</label>
                <input type="text" class="form-control" id="respuesta_seguridad" name="respuesta_seguridad" required>
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label">Nueva Contraseña:</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>

            <button type="submit" name="reset_password" class="btn btn-dark">
                Restablecer Contraseña
            </button>
        </form>

    <?php endif; ?>
</div>

</body>
</html>
