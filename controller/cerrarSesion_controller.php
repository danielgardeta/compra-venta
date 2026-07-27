<?php
session_start();

// Vaciar todas las variables de sesión
$_SESSION = [];

// Destruir la sesión
session_destroy();

// Redirigir al home
header("Location: index.php?action=home");
exit;
