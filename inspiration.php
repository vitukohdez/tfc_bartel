<?php 
session_start();
require_once 'includes/db.php'; 
include 'includes/header.php'; 
?>

<section class="inspiration-container">
    <div class="inspiration-header">
        <h1>moodboard</h1>
        <p>Creative Process / References / Mood</p>
    </div>

    <div class="moodboard">
        <div class="mood-item">
            <img src="assets/images/BARTELgirarlogo.png" alt="Sketch">
            <div class="mood-caption">
                <span>001 / sketching process</span>
                <span class="mood-tag">#concept</span>
            </div>
        </div>

        <div class="mood-item">
            <img src="assets/images/IMG_1662.jpg" alt="90s tech">
            <div class="mood-caption">
                <span>002 / satenier</span>
                <span class="mood-tag">#inspiration</span>
            </div>
        </div>

        <div class="mood-item">
            <img src="assets/images/IMG_1661.jpg" alt="Architecture">
            <div class="mood-caption">
                <span>003 / cbum</span>
                <span class="mood-tag">#architecture</span>
            </div>
        </div>

        <div class="mood-item">
            <img src="assets/images/IMG_1664.jpg" alt="Texture">
            <div class="mood-caption">
                <span>004 / concept</span>
                <span class="mood-tag">#concept</span>
            </div>
        </div>

        <div class="mood-item">
            <img src="assets/images/IMG_1663.jpg" alt="Typography">
            <div class="mood-caption">
                <span>005 / lancia delta INTEGRALE</span>
                <span class="mood-tag">#cars</span>
            </div>
        </div>

        <div class="mood-item">
            <img src="assets/video/bartelpsp.mp4" alt="Abstract">
            <div class="mood-caption">
                <span>006 / BARTEL PSP</span>
                <span class="mood-tag">#design</span>
            </div>
        </div>

        <div class="mood-item">
            <img src="assets/images/logoSHEITO.png" alt="Abstract">
            <div class="mood-caption">
                <span>007 / SHEITO PAISÓN</span>
                <span class="mood-tag">#inspiration</span>
            </div>
        </div>

        
    </div>
</section>

<?php include 'includes/footer.php'; ?>