<?php include __DIR__ . '/layouts/header.php'; ?>
<link rel="stylesheet" href="public/css/form.css">

<div class="intro">
    <h1>Únete a Cursos DA</h1>
    <p>Regístrate para acceder a los mejores cursos online.</p>
</div>

<div class="login-box">
    <h2>Registro</h2>

    <!-- Mostrar errores del servidor si existen -->
    <?php
    if (!empty($_SESSION['errores_registro'])) {
        foreach ($_SESSION['errores_registro'] as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        // Limpiamos los errores para que no se repitan
        unset($_SESSION['errores_registro']);
    }
    ?>

    <!-- Esto es el formulario de registro para que los usuarios puedan registrarse -->
    <form action="index.php?action=registrarse" method="post" class="form-centrado">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <!-- Mensaje de validación del email -->
                <span id="email-status"></span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <!-- Mensaje de validación de contraseña -->
                <span id="password-status"></span>
            </div>

            <div class="form-group">
                <label for="pregunta_seguridad">Pregunta de Seguridad</label>
                <input type="text" class="form-control" id="pregunta_seguridad" name="pregunta_seguridad" required>
            </div>
        </div>

        <div class="form-group">
            <label for="respuesta_seguridad">Respuesta de Seguridad</label>
            <input type="text" class="form-control" id="respuesta_seguridad" name="respuesta_seguridad" required>
        </div>

        <button type="submit" class="btn btn-dark">Registrarse</button>

        <!-- Este link sirve para que los usuarios que ya tienen cuenta puedan iniciar sesión, te llevara a la pagina principal -->
        <p class="mt-2">
            <a href="index.php?action=home">¿Ya tienes cuenta? Inicia sesión</a>
        </p>
    </form>
</div>

<script>
    // VALIDAR EMAIL (AJAX)
    document.getElementById('email').addEventListener('blur', function () {
        var email = this.value;
        var status = document.getElementById('email-status');
        var submitBtn = document.querySelector('button[type="submit"]');

        if (email) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'controller/check_email.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (this.status == 200) {
                    var response = JSON.parse(this.responseText);

                    // Email ya usado
                    if (response.existe) {
                        status.innerHTML = 'Este correo ya está en uso.';
                        status.style.color = 'red';
                        submitBtn.disabled = true;
                    }
                    // Email disponible
                    else {
                        status.innerHTML = 'Correo disponible.';
                        status.style.color = 'green';
                        submitBtn.disabled = false;
                    }
                }
            };

            xhr.send('email=' + encodeURIComponent(email));
        } else {
            status.innerHTML = '';
        }
    });

    // VALIDAR CONTRASEÑA (AJAX)
    document.getElementById('password').addEventListener('keyup', function () {
        var password = this.value;
        var status = document.getElementById('password-status');
        var submitBtn = document.querySelector('button[type="submit"]');

        if (password) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'controller/check_password.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (this.status == 200) {
                    var response = JSON.parse(this.responseText);

                    // Contraseña válida
                    if (response.valid) {
                        status.innerHTML = 'Contraseña válida.';
                        status.style.color = 'green';
                        submitBtn.disabled = false;
                    }
                    // Contraseña inválida
                    else {
                        status.innerHTML = response.message;
                        status.style.color = 'red';
                        submitBtn.disabled = true;
                    }
                }
            };

            xhr.send('password=' + encodeURIComponent(password));
        } else {
            status.innerHTML = '';
        }
    });
</script>

</body>
</html>
