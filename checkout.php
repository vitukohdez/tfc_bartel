<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (empty($_SESSION['carrito'])) {
    header("Location: shop.php");
    exit;
}

$usuario_id = $_SESSION['user_id'];
$total_pedido = 0;

try {
    $pdo->beginTransaction();

    foreach ($_SESSION['carrito'] as $cart_key => $item) {
        $stmt = $pdo->prepare("SELECT precio FROM productos WHERE id = ?");
        $stmt->execute([$item['id']]);
        $producto = $stmt->fetch();
        if ($producto) {
            $total_pedido += $producto['precio'] * $item['qty'];
        }
    }

    $stmtPedido = $pdo->prepare("INSERT INTO pedidos (usuario_id, total) VALUES (?, ?)");
    $stmtPedido->execute([$usuario_id, $total_pedido]);
    
    $pedido_id = $pdo->lastInsertId();

    $stmtDetalle = $pdo->prepare("INSERT INTO pedido_productos (pedido_id, producto_id, cantidad, precio_unitario, color, talla) VALUES (?, ?, ?, ?, ?, ?)");
    
    foreach ($_SESSION['carrito'] as $cart_key => $item) {
        $stmt = $pdo->prepare("SELECT precio FROM productos WHERE id = ?");
        $stmt->execute([$item['id']]);
        $producto = $stmt->fetch();
        
        if ($producto) {
            $stmtDetalle->execute([
                $pedido_id, 
                $item['id'], 
                $item['qty'], 
                $producto['precio'],
                $item['color'],
                $item['talla']
            ]);
        }
    }

    $pdo->commit();

    $_SESSION['carrito'] = [];
    $compra_exitosa = true;

} catch (\PDOException $e) {
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