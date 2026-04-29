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

<?php 
// Solo mostramos el nav si NO hemos pedido esconderlo
if (!isset($hide_header) || !$hide_header): 
?>
<header>
    <nav class="main-nav">
        <div class="nav-left">
            <a href="index.php" class="logo">BARTEL</a>
        </div>
        <div class="nav-right">
            <ul>
                <li><a href="shop.php">SHOP</a></li>
                <li><a href="login.php">ACCOUNT</a></li>
                <li><a href="#">CART (0)</a></li>
            </ul>
        </div>
    </nav>
</header>
<?php endif; ?>

<main>