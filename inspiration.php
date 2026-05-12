<?php 
session_start();
require_once 'includes/db.php'; 
include 'includes/header.php'; 
?>

<section class="inspiration-container">
    <div class="inspiration-header">
        <h1>inspiration</h1>
        <p>Creative Process / References / Mood</p>
    </div>

    <div class="moodboard">
        <div class="mood-item">
            <img src="https://images.unsplash.com/photo-1515405299443-f71bb798f14e?q=80&w=800" alt="Sketch">
            <div class="mood-caption">
                <span>001 / sketching process</span>
                <span class="mood-tag">#concept</span>
            </div>
        </div>

        <div class="mood-item">
            <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?q=80&w=800" alt="90s tech">
            <div class="mood-caption">
                <span>002 / retro hardware</span>
                <span class="mood-tag">#references</span>
            </div>
        </div>

        <div class="mood-item">
            <img src="https://images.unsplash.com/photo-1493397212122-2b85def82820?q=80&w=800" alt="Architecture">
            <div class="mood-caption">
                <span>003 / concrete lines</span>
                <span class="mood-tag">#architecture</span>
            </div>
        </div>

        <div class="mood-item">
            <img src="https://images.unsplash.com/photo-1558591710-4b4a1ae0f04d?q=80&w=800" alt="Texture">
            <div class="mood-caption">
                <span>004 / industrial textures</span>
                <span class="mood-tag">#mood</span>
            </div>
        </div>

        <div class="mood-item">
            <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?q=80&w=800" alt="Typography">
            <div class="mood-caption">
                <span>005 / bold type studies</span>
                <span class="mood-tag">#design</span>
            </div>
        </div>

        <div class="mood-item">
            <img src="https://images.unsplash.com/photo-1541701494587-cb58502866ab?q=80&w=800" alt="Abstract">
            <div class="mood-caption">
                <span>006 / color palette #01</span>
                <span class="mood-tag">#color</span>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>