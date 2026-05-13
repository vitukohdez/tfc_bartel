<?php 
require_once 'includes/db.php'; 

$id_producto = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id_producto) {
    header("Location: shop.php");
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->execute([$id_producto]);
    $producto = $stmt->fetch();

    if (!$producto) {
        header("Location: shop.php");
        exit;
    }
} catch (\PDOException $e) {
    error_log($e->getMessage());
    die("Hubo un problema al cargar el producto.");
}

include 'includes/header.php'; 
?>

<section class="product-detail-container">
    <?php if ($producto['id'] == 1): ?>
        <div class="product-gallery">
            <img src="assets/images/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="product-detail-image" id="main-product-image">
            
            <div class="thumbnail-slider">
                <img src="assets/images/<?php echo htmlspecialchars($producto['imagen']); ?>" onclick="changeImage(this.src)">
                <img src="assets/images/camisetaVERDE.png" onclick="changeImage(this.src)">
                <img src="assets/images/camisetaMARILLA.png" onclick="changeImage(this.src)">
            </div>
        </div>
    <?php else: ?>
        <img src="assets/images/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="product-detail-image">
    <?php endif; ?>

    <div class="product-detail-info">
        <h1><?php echo htmlspecialchars($producto['nombre']); ?></h1>
        <p class="product-price"><?php echo number_format($producto['precio'], 2); ?> €</p>
        
        <p class="product-desc">
            <?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?>
        </p>

        <form action="carrito.php" method="POST">
            <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
            
            <?php if ($producto['id'] == 1): ?>
                <div class="product-options">
                    <div class="option-group">
                        <label for="color">Color</label>
                        <select name="color" id="color">
                            <option value="Red">Red</option>
                            <option value="Green">Green</option>
                            <option value="Yellow">Yellow</option>
                        </select>
                    </div>
                    
                    <div class="option-group">
                        <label for="size">Size</label>
                        <select name="size" id="size">
                            <option value="S">Small</option>
                            <option value="M">Medium</option>
                            <option value="L">Large</option>
                            <option value="XL">X-Large</option>
                        </select>
                    </div>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn-add-cart">ADD TO CART</button>
        </form>
    </div>
</section>

<section class="recommended-section">
    <h2>you may also like</h2>
    
    <div class="recommended-grid">
        <?php 
        $stmt_rec = $pdo->prepare("SELECT * FROM productos WHERE id != ? LIMIT 3");
        $stmt_rec->execute([$producto['id']]);
        $recomendados = $stmt_rec->fetchAll();
        
        foreach ($recomendados as $rec): 
        ?>
            <a href="producto.php?id=<?php echo $rec['id']; ?>" class="product-card">
                <img src="assets/images/<?php echo htmlspecialchars($rec['imagen']); ?>" alt="<?php echo htmlspecialchars($rec['nombre']); ?>" class="product-image">
                <div class="product-info">
                    <h3><?php echo htmlspecialchars($rec['nombre']); ?></h3>
                    <p><?php echo number_format($rec['precio'], 2); ?> €</p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<script>
    function changeImage(newSrc) {
        var mainImage = document.getElementById('main-product-image');
        if (mainImage) {
            mainImage.src = newSrc;
        }
    }
</script>

<?php include 'includes/footer.php'; ?>