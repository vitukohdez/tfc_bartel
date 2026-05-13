<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bartel | official store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
</head>
<body class="<?php echo isset($hide_header) && $hide_header ? 'no-header' : ''; ?>">

<?php if (!isset($hide_header) || !$hide_header): ?>
<header>
    <nav class="navbar">
        <div class="nav-left">
            <ul>
                <li><a href="shop.php">SHOP</a></li>
                <li><a href="musica.php">MUSIC</a></li>
                <li><a href="inspiration.php">INSPIRATION</a></li>
            </ul>
        </div>

        <div class="nav-center">
            <a href="shop.php" class="logo">bartel</a>
        </div>

        <div class="nav-right">
            <ul>
                <?php 
                if (isset($_SESSION['user_id'])): 
                ?>
                    <li><a href="logout.php">LOG OUT</a></li>
                <?php 
                else: 
                ?>
                    <li><a href="login.php">LOG IN</a></li>
                <?php endif; ?>

                <li><a href="carrito.php">CART (<?php echo isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?>)</a></li>
            </ul>
        </div>
    </nav>
</header>
<?php endif; ?>

<main>