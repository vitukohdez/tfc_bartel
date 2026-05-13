<?php 
require_once 'includes/db.php'; 
include 'includes/header.php'; 

try {
    $stmt = $pdo->query("SELECT * FROM productos");
    $productos = $stmt->fetchAll();
} catch (\PDOException $e) {
    error_log($e->getMessage());
    $productos = [];
}
?>

<section class="shop-container">
    <h1 class="shop-title">collection 01</h1>
    
    <div class="product-grid">
        <?php if (count($productos) > 0): ?>
            <?php foreach ($productos as $producto): ?>
                
                <a href="producto.php?id=<?php echo $producto['id']; ?>" class="product-card">
                    <!-- Aquí está el cambio: hemos puesto la etiqueta img para que lea la base de datos -->
                    <img src="assets/images/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="product-image">
                    
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