<?php 
require_once 'includes/db.php'; 
include 'includes/header.php'; 

// Consulta para sacar todos los productos de la BD
try {
    $stmt = $pdo->query("SELECT * FROM productos");
    $productos = $stmt->fetchAll();
} catch (\PDOException $e) {
    error_log("Error cargando productos: " . $e->getMessage());
    $productos = []; // Si hay error, dejamos un array vacío para que no explote la web
}
?>

<section class="shop-container">
    <h1 class="shop-title">COLLECTION 01</h1>
    
    <div class="product-grid">
        <?php if (count($productos) > 0): ?>
            <!-- Iniciamos el bucle: por cada producto en la BD, creamos una tarjeta HTML -->
            <?php foreach ($productos as $producto): ?>
                
                <!-- Envolvemos todo en un <a> para que al hacer clic nos lleve al detalle del producto -->
                <a href="producto.php?id=<?php echo $producto['id']; ?>" class="product-card">
                    
                    <!-- Por ahora dejamos el fondo gris, luego conectaremos las imágenes reales -->
                    <div class="product-image"></div>
                    
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                        <p><?php echo number_format($producto['precio'], 2); ?> €</p>
                    </div>
                </a>
                
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; grid-column: 1 / -1;">No hay productos disponibles en este momento.</p>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>