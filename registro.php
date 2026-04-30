<?php
// 1. Iniciar sesión obligatoriamente para el CSRF y el Login
session_start();
require_once 'includes/db.php';

// 2. Generar Token CSRF si no existe (Requisito Seguridad)
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$error = '';
$success = '';

// 3. Procesar el formulario cuando el usuario le da a "Enviar"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 3.1. Verificar el Token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Error de validación de seguridad (CSRF).");
    }

    // 3.2. Recoger datos y limpiar espacios
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 3.3. Validación en el Servidor (Requisito Obligatorio)
    if (empty($username) || empty($email) || empty($password)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El formato del correo no es válido.";
    } elseif (strlen($password) < 6) {
        $error = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        // 3.4. Comprobar si el email o usuario ya existen (Prevención inyección SQL con PDO)
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ? OR username = ?");
        $stmt->execute([$email, $username]);
        
        if ($stmt->fetch()) {
            $error = "El nombre de usuario o el correo ya están registrados.";
        } else {
            // 3.5. Hashing de contraseña (Requisito Obligatorio)
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            // 3.6. Insertar en la base de datos
            try {
                $stmt = $pdo->prepare("INSERT INTO usuarios (username, email, password_hash) VALUES (?, ?, ?)");
                $stmt->execute([$username, $email, $hash]);
                $success = "Cuenta creada con éxito. Ya puedes iniciar sesión.";
            } catch (\PDOException $e) {
                // Loguear error de servidor de forma segura (Requisito Obligatorio)
                error_log("Error en registro: " . $e->getMessage());
                $error = "Hubo un error al crear la cuenta. Inténtalo más tarde.";
            }
        }
    }
}

// 4. Incluir el Header (aquí sí se mostrará porque no hemos puesto $hide_header)
include 'includes/header.php';
?>

<section class="auth-container">
    <div class="auth-box">
        <h2>CREATE ACCOUNT</h2>
        
        <!-- Mensajes de feedback -->
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php else: ?>
        
        <!-- Formulario (Validación en cliente con 'required' y 'type=email') -->
        <form action="registro.php" method="POST">
            <!-- Campo oculto con el Token CSRF -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            
            <div class="form-group">
                <label for="username">USERNAME</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="email">EMAIL</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">PASSWORD</label>
                <input type="password" id="password" name="password" class="form-control" minlength="6" required>
            </div>
            
            <button type="submit" class="btn-submit">REGISTER</button>
        </form>
        <?php endif; ?>

        <div class="auth-links">
            <p>Already have an account? <a href="login.php">Sign In</a></p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>