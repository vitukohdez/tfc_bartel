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
        try {
            // Consulta pidiendo 4 productos al azar
            $query_mas = "SELECT * FROM productos ORDER BY RAND() LIMIT 4";
            
            // Ejecutamos la consulta usando tu variable $pdo
            $stmt = $pdo->query($query_mas);
            
            // Obtenemos todos los resultados en un array
            $productos_relacionados = $stmt->fetchAll();
            
            // Comprobamos si hay productos
            if (count($productos_relacionados) == 0) {
                echo "<p style='text-align: center; width: 100%;'>No hay productos extra para mostrar.</p>";
            } else {
                // Bucle para mostrar cada producto
                foreach ($productos_relacionados as $item) {
        ?>
                    <div class="product-card">
                        <a href="producto.php?id=<?php echo $item['id']; ?>">
                            <img src="assets/images/<?php echo $item['imagen']; ?>" alt="<?php echo $item['nombre']; ?>">
                            <h3><?php echo $item['nombre']; ?></h3>
                            <p><?php echo $item['precio']; ?> €</p>
                        </a>
                    </div>
        <?php 
                } // fin del foreach
            } // fin del if
        } catch (PDOException $e) {
            // Si algo falla en la base de datos, te lo chiva en rojo
            echo "<p style='color: red; text-align: center;'>Error SQL: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>