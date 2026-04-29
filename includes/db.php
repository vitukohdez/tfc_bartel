<?php
// db.php
$host = 'localhost';
$db   = 'tfc_bartel';
$user = 'root'; 
$pass = ''; // En XAMPP para Mac, por defecto la contraseña de root suele estar vacía
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     // echo "Conexión exitosa"; // Descomenta esto para probar
} catch (\PDOException $e) {
     error_log($e->getMessage());
     exit("Error de conexión interno.");
}
?>