<?php
session_start();
require_once 'includes/db.php';

// Si el usuario ya ha iniciado sesión antes, lo redirigimos a la tienda para que no vea el login
if (isset($_SESSION['user_id'])) {
    header("Location: shop.php");
    exit;
}

// Generar Token CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$error = '';

// Procesar el formulario de Login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Verificar Token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Error de validación de seguridad (CSRF).");
    }

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Por favor, rellena todos los campos.";
    } else {
        // 2. Buscar al usuario por su email (Evitando Inyección SQL)
        $stmt = $pdo->prepare("SELECT id, username, password_hash FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // 3. Verificar la contraseña hasheada (Requisito Obligatorio)
        if ($user && password_verify($password, $user['password_hash'])) {
            
            // Buenas prácticas de seguridad: regenerar el ID de la sesión
            session_regenerate_id(true);
            
            // Guardamos los datos del usuario en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            // Lo mandamos a la portada (o a la tienda)
            header("Location: shop.php");
            exit;
        } else {
            // Requisito de seguridad: NUNCA digas si falló el email o la contraseña, da un mensaje genérico.
            $error = "Correo electrónico o contraseña incorrectos.";
        }
    }
}

// Mostrar el diseño
include 'includes/header.php';
?>

<section class="auth-container">
    <div class="auth-box">
        <h2>SIGN IN</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="login.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            
            <div class="form-group">
                <label for="email">EMAIL</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">PASSWORD</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            
            <button type="submit" class="btn-submit">LOGIN</button>
        </form>

        <div class="auth-links">
            <p>Don't have an account? <a href="registro.php">Create one</a></p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>