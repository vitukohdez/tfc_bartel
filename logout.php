<?php
session_start();
session_unset();    // Limpia las variables de sesión
session_destroy();  // Destruye la sesión por completo

// Te redirige a la portada
header("Location: index.php");
exit;
?>