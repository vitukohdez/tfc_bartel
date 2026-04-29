<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLONDED | Official Store</title>
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <nav class="main-nav">
        <div class="nav-left">
            <a href="index.php" class="logo">BLONDED</a>
        </div>
        <div class="nav-right">
            <ul>
                <li><a href="shop.php">SHOP</a></li>
                <li><a href="login.php">ACCOUNT</a></li>
                <li><a href="#">CART (0)</a></li>
            </ul>
        </div>
    </nav>
</header>

<main> ```

---

### 3. El Estilo General (`assets/css/style.css`)
Aquí aplicamos el diseño **responsivo** (Media Queries) que te exige el TFC.

Copia esto en `assets/css/style.css`:

```css
/* Estilo del Header */
.main-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--padding-std);
    height: var(--nav-height);
    position: fixed;
    top: 0;
    width: 100%;
    background: rgba(255,255,255,0.9);
    z-index: 1000;
}

.logo {
    font-weight: 900;
    letter-spacing: 5px;
    font-size: 1.2rem;
}

.nav-right ul {
    display: flex;
    list-style: none;
    gap: 30px;
}

.nav-right a {
    font-size: 0.75rem;
    font-weight: bold;
    letter-spacing: 1px;
}

/* Página Principal (Index) */
.hero {
    margin-top: var(--nav-height);
    height: 90vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.hero h1 {
    font-size: 3rem;
    letter-spacing: -1px;
    margin-bottom: 20px;
}

/* MEDIA QUERIES (Requisito Obligatorio: Diseño Responsivo) */
@media (max-width: 768px) {
    .hero h1 {
        font-size: 1.8rem;
    }
    .nav-right ul {
        gap: 15px;
    }
    .nav-right a {
        font-size: 0.6rem;
    }
}