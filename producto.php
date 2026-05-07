<?php 
require_once 'includes/db.php'; 

// 1. Recoger el ID de la URL (Ej: producto.php?id=2)
// Usamos filter_input para asegurarnos de que es un número (Seguridad extra)
$id_producto = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Si no hay ID o alguien pone letras en la URL (producto.php?id=hola), lo echamos a la tienda
if (!$id_producto) {
    header("Location: shop.php");
    exit;
}

// 2. Buscar el producto en la base de datos (Evitando Inyección SQL con prepare)
try {
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->execute([$id_producto]);
    $producto = $stmt->fetch();

    // Si el producto no existe (ej: producto.php?id=999), lo echamos a la tienda
    if (!$producto) {
        header("Location: shop.php");
        exit;
    }
} catch (\PDOException $e) {
    error_log("Error al cargar producto: " . $e->getMessage());
    die("Hubo un problema al cargar el producto.");
}

// 3. Pintar la página
include 'includes/header.php'; 
?>

<section class="product-detail-container">
    <!-- Mitad izquierda: Imagen -->
    <!-- De momento mostramos el recuadro gris, más adelante pondremos: src="assets/img/<?php echo $producto['imagen']; ?>" -->
    <div class="product-detail-image"></div>

    <!-- Mitad derecha: Información -->
    <div class="product-detail-info">
        <h1><?php echo htmlspecialchars($producto['nombre']); ?></h1>
        <p class="product-price"><?php echo number_format($producto['precio'], 2); ?> €</p>
        
        <p class="product-desc">
            <?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?>
        </p>

        <!-- Formulario para añadir al carrito (lo programaremos después) -->
        <form action="carrito.php" method="POST">
            <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
            <button type="submit" class="btn-add-cart">ADD TO CART</button>
        </form>
    </div>
</section>
<section class="more-products">
            <h2>YOU MAY ALSO LIKE</h2>
            <div class="product-grid">
                <?php
                /* * Hacemos una consulta a la base de datos para sacar 4 productos.
                 * Usamos ORDER BY RAND() para que salgan aleatorios cada vez.
                 * (Asegúrate de que tu variable de conexión se llama $conn o $conexion 
                 * y que tu tabla se llama 'productos')
                 */
                $query_mas = "SELECT * FROM productos ORDER BY RAND() LIMIT 4";
                
                // Si usas mysqli:
                $resultado_mas = mysqli_query($conexion, $query_mas);
                
                // Bucle para mostrar los productos
                while($item = mysqli_fetch_assoc($resultado_mas)) {
                ?>
                    <div class="product-card">
                        <a href="producto.php?id=<?php echo $item['id']; ?>">
                            <img src="assets/images/<?php echo $item['imagen']; ?>" alt="<?php echo $item['nombre']; ?>">
                            <h3><?php echo $item['nombre']; ?></h3>
                            <p><?php echo $item['precio']; ?> €</p>
                        </a>
                    </div>
                <?php 
                } 
                ?>
            </div>
        </section>
<?php include 'includes/footer.php'; ?>