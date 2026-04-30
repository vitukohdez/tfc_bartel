<?php 
require_once 'includes/db.php'; 
include 'includes/header.php'; 
?>

<style>
/* CSS exclusivo para la página de música */
.music-container {
    display: flex;
    flex-wrap: wrap;
    padding: 60px var(--padding-std);
    max-width: 1200px;
    margin: 0 auto;
    /* Le damos mucha altura mínima para que haya bastante scroll y se vea el efecto de rotación */
    min-height: 150vh; 
}

.tracklist {
    flex: 1;
    min-width: 300px;
    padding-right: 50px;
}

.tracklist h1 {
    font-size: 2rem;
    letter-spacing: 5px;
    margin-bottom: 50px;
    font-weight: 900;
}

.track {
    padding: 25px 0;
    border-bottom: 1px solid #eeeeee;
    font-size: 1.1rem;
    font-weight: bold;
    letter-spacing: 2px;
    cursor: pointer;
    transition: color 0.3s, padding-left 0.3s;
}

.track:hover {
    color: var(--accent-color);
    padding-left: 10px; /* Pequeño efecto de movimiento al pasar el ratón */
}

.disc-wrapper {
    flex: 1;
    min-width: 300px;
    display: flex;
    justify-content: center;
    /* align-items: flex-start para que el sticky funcione bien desde arriba */
    align-items: flex-start; 
}

.sticky-container {
    /* Esto es lo que hace que el disco te persiga al hacer scroll */
    position: sticky;
    top: 150px; 
}

#dvd-disc {
    width: 350px;
    height: 350px;
    object-fit: contain;
    /* Si la foto del DVD tiene fondo transparente, se verá espectacular */
    filter: drop-shadow(0px 20px 30px rgba(0,0,0,0.3));
}
</style>

<section class="music-container">
    <!-- Mitad Izquierda: Lista de canciones -->
    <div class="tracklist">
        <h1>BARTEL MIXTAPE 01</h1>
        
        <div class="track">01. SUMMER 2026 (INTRO)</div>
        <div class="track">02. MIDNIGHT CITY</div>
        <div class="track">03. PLASTIC LOVE</div>
        <div class="track">04. OBJECT ONE</div>
        <div class="track">05. WHITE NOISE</div>
        <div class="track">06. LOST IN TRANSLATION</div>
        <div class="track">07. TOKYO DRIFT</div>
        <div class="track">08. VAPORWAVE VIBES</div>
        <div class="track">09. THE END (OUTRO)</div>
    </div>

    <!-- Mitad Derecha: El DVD flotante -->
    <div class="disc-wrapper">
        <div class="sticky-container">
            <!-- Mete tu imagen del dvd aquí (assets/img/dvd.png) -->
            <!-- Si no tienes la imagen aún, he puesto un cuadrado gris temporalmente con JS -->
            <img src="assets/img/dvd.png" id="dvd-disc" alt="DVD Disc" onerror="this.style.backgroundColor='#cccccc'; this.style.borderRadius='50%';">
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>