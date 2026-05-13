</main>
<div class="footer-marquee">
    <div class="marquee-content">
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
        <span>bartel</span>
    </div>
</div>
<footer>
    <p>&copy; <?php echo date('Y'); ?> BARTEL OFFICIAL. ALL RIGHTS RESERVED.</p>
</footer>

<!-- Logo rotativo global (La animación la hace el CSS que acabamos de meter) -->
<img src="assets/images/logo_rotativo.png" id="logo-rotativo" alt="Bartel Logo">

<!-- MAGIA JAVASCRIPT EXCLUSIVA PARA EL SCROLL DEL DVD DE MÚSICA -->
<script>
    window.addEventListener('scroll', function() {
        let scrollY = window.scrollY;
        
        // ROTAR EL DVD (Solo actuará si estamos en la página de música y el DVD existe)
        let dvd = document.getElementById('dvd-disc');
        if (dvd) {
            dvd.style.transform = 'rotate(' + (scrollY * 1.2) + 'deg)';
        }
    });
</script>

</body>
</html>