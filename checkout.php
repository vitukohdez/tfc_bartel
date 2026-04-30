<?php
require_once 'includes/db.php';

// 1. Proteger la página: Solo usuarios logueados pueden comprar
if (!isset($_SESSION['user_id'])) {
    // Si no está logueado, lo mandamos al login
    header("Location: login.php");
    exit;
}

// 2. Comprobar que el carrito no esté vacío
if (empty($_SESSION['carrito'])) {
    header("Location: shop.php");
    exit;
}

$usuario_id = $_SESSION['user_id'];
$total_pedido = 0;

try {
    // 3. Iniciar "Transacción" (Si algo falla abajo, se revierte todo)
    $pdo->beginTransaction();

    // 4. Calcular el total real desde la BD (por seguridad, para que no truquen el precio en el HTML)
    foreach ($_SESSION['carrito'] as $id => $cantidad) {
        $stmt = $pdo->prepare("SELECT precio FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        $producto = $stmt->fetch();
        if ($producto) {
            $total_pedido += $producto['precio'] * $cantidad;
        }
    }

    // 5. Insertar en la tabla 'pedidos'
    $stmtPedido = $pdo->prepare("INSERT INTO pedidos (usuario_id, total) VALUES (?, ?)");
    $stmtPedido->execute([$usuario_id, $total_pedido]);
    
    // Obtenemos el ID del pedido que se acaba de crear automáticamente
    $pedido_id = $pdo->lastInsertId();

    // 6. Insertar en la tabla intermedia 'pedido_productos' (Con la "s" para que coincida con tu base de datos)
    $stmtDetalle = $pdo->prepare("INSERT INTO pedido_productos (pedido_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
    
    foreach ($_SESSION['carrito'] as $id => $cantidad) {
        $stmt = $pdo->prepare("SELECT precio FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        $producto = $stmt->fetch();
        
        if ($producto) {
            $stmtDetalle->execute([$pedido_id, $id, $cantidad, $producto['precio']]);
        }
    }

    // 7. Todo ha ido bien, confirmamos los cambios en la Base de Datos
    $pdo->commit();

    // 8. Vaciamos el carrito porque la compra ya está hecha
    $_SESSION['carrito'] = [];
    $compra_exitosa = true;

} catch (\PDOException $e) {
    // Si hubo un error (ej: la base de datos se cayó un segundo), deshacemos todo
    $pdo->rollBack();
    error_log("Error en checkout: " . $e->getMessage());
    $compra_exitosa = false;
}

include 'includes/header.php';
?>

<section class="cart-container" style="text-align: center; padding-top: 100px;">
    <?php if (isset($compra_exitosa) && $compra_exitosa): ?>
        <h1 style="font-size: 2rem; margin-bottom: 20px; letter-spacing: 4px;">THANK YOU</h1>
        <p style="margin-bottom: 40px; color: var(--accent-color);">
            Your order has been placed successfully.<br>
            <strong>Order #<?php echo str_pad($pedido_id, 5, '0', STR_PAD_LEFT); ?></strong>
        </p>
        <a href="shop.php" class="btn-shop" style="color: black; border-color: black;">BACK TO STORE</a>
    <?php else: ?>
        <h1 style="font-size: 2rem; margin-bottom: 20px; color: #cc0000; letter-spacing: 4px;">ERROR</h1>
        <p style="margin-bottom: 40px;">There was a problem processing your order. Please try again later.</p>
        <a href="carrito.php" class="btn-shop" style="color: black; border-color: black;">BACK TO CART</a>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>