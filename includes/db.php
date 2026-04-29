<?php
// includes/db.php

$host = 'localhost';
$db   = 'tfc_bartel'; // Nombre exacto de tu base de datos en phpMyAdmin
$user = 'root'; 
$pass = ''; // En XAMPP para Mac suele estar vacío, si no funciona prueba con 'root'
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Esto permite ver errores detallados en el log
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     // Si quieres comprobar que funciona, puedes quitar las dos barras de la línea de abajo:
     // echo "Conexión establecida con éxito"; 
} catch (\PDOException $e) {
     // Guardamos el error real en un archivo para el requisito 2.6
     error_log($e->getMessage());
     
     // Mensaje amigable para el usuario
     exit("Error interno de conexión. Asegúrate de que MySQL esté encendido en XAMPP y que la base de datos se llame " . $db);
}
?>