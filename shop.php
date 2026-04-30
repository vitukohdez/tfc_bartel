<?php 
require_once 'includes/db.php'; 
// Aquí NO ponemos la variable $hide_header, así que el menú se verá normal
include 'includes/header.php'; 
?>

<section class="shop-container">
    <h1 class="shop-title">COLLECTION 01</h1>
    
    <div class="product-grid">
        <!-- Producto de prueba 1 -->
        <article class="product-card">
            <div class="product-image"></div>
            <div class="product-info">
                <h3>BARTEL LOGO TEE</h3>
                <p>45.00 €</p>
            </div>
        </article>

        <!-- Producto de prueba 2 -->
        <article class="product-card">
            <div class="product-image"></div>
            <div class="product-info">
                <h3>SUMMER CAP</h3>
                <p>30.00 €</p>
            </div>
        </article>
        
        <!-- Producto de prueba 3 -->
        <article class="product-card">
            <div class="product-image"></div>
            <div class="product-info">
                <h3>OBJECT 01 VINYL</h3>
                <p>35.00 €</p>
            </div>
        </article>
        
        <!-- Producto de prueba 4 -->
        <article class="product-card">
            <div class="product-image"></div>
            <div class="product-info">
                <h3>HEAVY HOODIE</h3>
                <p>90.00 €</p>
            </div>
        </article>
    </div>
</section>

<?php include 'includes/footer.php'; ?>