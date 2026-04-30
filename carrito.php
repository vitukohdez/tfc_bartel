<?php
require_once 'includes/db.php';

// 1. Inicializar el carrito si no existe en la sesión
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// 2. Añadir producto al carrito (Viene del POST de producto.php)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    // Filtramos el ID por seguridad
    $id_producto = filter_input(INPUT_POST, 'producto_id', FILTER_VALIDATE_INT);
    
    if ($id_producto) {
        // Si el producto ya está en el carrito, le sumamos 1 a la cantidad
        if (isset($_SESSION['carrito'][$id_producto])) {
            $_SESSION['carrito'][$id_producto]++;
        } else {
            // Si no está, lo añadimos con cantidad 1
            $_SESSION['carrito'][$id_producto] = 1;
        }
        
        // Redirigimos a la misma página por método GET (Evita que al recargar la página se vuelva a comprar)
        header("Location: carrito.php");
        exit;
    }
}

// 3. Vaciar el carrito (Si el usuario hace clic en el enlace de vaciar)
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
                
                // Recorremos el carrito. La clave ($id) es el ID del producto, el valor ($cantidad) es cuántos hay
                foreach ($_SESSION['carrito'] as $id => $cantidad):
                    // Buscamos el nombre y precio real en la base de datos (seguridad: así el usuario no puede trucar el precio)
                    $stmt = $pdo->prepare("SELECT nombre, precio FROM productos WHERE id = ?");
                    $stmt->execute([$id]);
                    $producto = $stmt->fetch();

                    if ($producto):
                        $subtotal = $producto['precio'] * $cantidad;
                        $total_carrito += $subtotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
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

        <!-- Botón para procesar la compra final -->
        <form action="checkout.php" method="POST" style="margin-bottom: 15px;">
            <button type="submit" class="btn-checkout">PROCEED TO CHECKOUT</button>
        </form>
        
        <!-- NUEVO: Botón para seguir comprando -->
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="shop.php" class="btn-shop" style="width: 100%; border-color: #000; color: #000; display: block; padding: 18px; margin-top: 0;">CONTINUE SHOPPING</a>
        </div>
        
        <!-- Enlace para vaciar el carrito -->
        <div style="text-align: center;">
            <a href="carrito.php?action=clear" class="btn-remove">Empty Cart</a>
        </div>
        
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>