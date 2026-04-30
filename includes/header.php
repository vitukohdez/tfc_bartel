<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARTEL | Official Store</title>
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="<?php echo isset($hide_header) && $hide_header ? 'no-header' : ''; ?>">

<?php if (!isset($hide_header) || !$hide_header): ?>
<header>
    <nav class="main-nav">
        <div class="nav-left">
            <a href="index.php" class="logo">BARTEL</a>
        </div>
        <div class="nav-right">
            <ul>
                <li><a href="shop.php">SHOP</a></li>
                
                <!-- MAGIA DE LAS SESIONES AQUÍ -->
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php" style="color: var(--accent-color);">LOGOUT (<?php echo strtoupper(htmlspecialchars($_SESSION['username'])); ?>)</a></li>
                <?php else: ?>
                    <li><a href="login.php">ACCOUNT</a></li>
                <?php endif; ?>
                
                <li><a href="#">CART (0)</a></li>
            </ul>
        </div>
    </nav>
</header>
<?php endif; ?>

<main>