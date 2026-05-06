<?php 
require_once 'includes/db.php'; 

// Esta es la "magia": le decimos al archivo header.php que no muestre el menú aquí
$hide_header = true; 
include 'includes/header.php'; 
?>

<section class="hero">
    <video autoplay muted loop playsinline class="video-bg">
        <source src="assets/video/hero-bg.mp4" type="video/mp4">
    </video>

    <div class="hero-content">
            <!-- LOGO TEXTO GIGANTE -->
            <h1 class="logo-gigante">bartel</h1>
            
            <p style="letter-spacing: 4px; margin-top: 20px;">SUMMER 2026</p>
            <a href="shop.php" class="btn-shop">ENTER STORE</a>
        </div>
</section>

<?php include 'includes/footer.php'; ?>