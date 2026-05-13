<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    $id_producto = filter_input(INPUT_POST, 'producto_id', FILTER_VALIDATE_INT);
    $color = isset($_POST['color']) ? htmlspecialchars($_POST['color']) : '';
    $talla = isset($_POST['size']) ? htmlspecialchars($_POST['size']) : '';
    
    if ($id_producto) {
        $cart_key = $id_producto . '_' . $color . '_' . $talla;
        
        if (isset($_SESSION['carrito'][$cart_key])) {
            $_SESSION['carrito'][$cart_key]['qty']++;
        } else {
            $_SESSION['carrito'][$cart_key] = [
                'id' => $id_producto,
                'qty' => 1,
                'color' => $color,
                'talla' => $talla
            ];
        }
        
        header("Location: carrito.php");
        exit;
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    $_SESSION['carrito'] = [];
    header("Location: carrito.php");
    exit;
}

include 'includes/header.php';
?>

<section class="cart-container">
    <h1 class="cart-title">YOUR CART</h1>

    <?php if (empty($_SESSION['carrito'])): ?>
        <p style="text-align: center; margin-bottom: 40px;">Your cart is currently empty.</p>
        <div style="text-align: center;">
            <a href="shop.php" class="btn-shop" style="color: black; border-color: black;">CONTINUE SHOPPING</a>
        </div>
    <?php else: ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>PRODUCT</th>
                    <th>QTY</th>
                    <th>PRICE</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_carrito = 0;
                
                foreach ($_SESSION['carrito'] as $cart_key => $item):
                    if (!is_array($item)) continue; 
                    
                    $id = $item['id'];
                    $cantidad = $item['qty'];
                    $color = $item['color'];
                    $talla = $item['talla'];

                    $stmt = $pdo->prepare("SELECT nombre, precio FROM productos WHERE id = ?");
                    $stmt->execute([$id]);
                    $producto = $stmt->fetch();

                    if ($producto):
                        $subtotal = $producto['precio'] * $cantidad;
                        $total_carrito += $subtotal;

                        $variantes = "";
                        if (!empty($color) || !empty($talla)) {
                            $variantes = "<br><small style='color: #888; font-weight: normal;'>";
                            if (!empty($color)) $variantes .= "Color: " . $color;
                            if (!empty($color) && !empty($talla)) $variantes .= " | ";
                            if (!empty($talla)) $variantes .= "Size: " . $talla;
                            $variantes .= "</small>";
                        }
                ?>
                    <tr>
                        <td style="font-weight: bold;">
                            <?php echo htmlspecialchars($producto['nombre']); ?>
                            <?php echo $variantes; ?>
                        </td>
                        <td><?php echo $cantidad; ?></td>
                        <td><?php echo number_format($producto['precio'], 2); ?> €</td>
                        <td><?php echo number_format($subtotal, 2); ?> €</td>
                    </tr>
                <?php 
                    endif;
                endforeach; 
                ?>
            </tbody>
        </table>

        <div class="cart-total">
            TOTAL: <?php echo number_format($total_carrito, 2); ?> €
        </div>

        <form action="checkout.php" method="POST" style="margin-bottom: 15px;">
            <button type="submit" class="btn-checkout">PROCEED TO CHECKOUT</button>
        </form>
        
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="shop.php" class="btn-shop" style="width: 100%; border-color: #000; color: #000; display: block; padding: 18px; margin-top: 0;">CONTINUE SHOPPING</a>
        </div>
        
        <div style="text-align: center;">
            <a href="carrito.php?action=clear" class="btn-remove">Empty Cart</a>
        </div>
        
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>