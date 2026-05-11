<?php 
require_once 'includes/db.php'; 
include 'includes/header.php'; 
?>

<section class="music-container">
    <div class="tracklist">
        <h1>bartel playlist</h1>
        <p>THIS MUSIC HAS BEEN CAREFULLY SELECTED AND HAS ACCOMPANIED ME THROUGHOUT THE ENTIRE CREATIVE PROCESS. I BELIEVE IT DESERVES TO BE SHARED.</p>
        
        <iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/playlist/1HZ2iNnNbk54KBB2AVtRay?utm_source=generator&theme=0" width="100%" height="700" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
    </div>

    <div class="disc-wrapper">
        <div class="sticky-container">
            <img src="assets/images/dvd.png" id="dvd-disc" alt="DVD Disc" onerror="this.style.backgroundColor='#cccccc'; this.style.borderRadius='50%';">
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>