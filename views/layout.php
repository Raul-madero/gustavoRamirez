<?php
if(!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;
if(!isset($inicio)) {
    $inicio = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gustavo Ramírez</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/app.css">
</head>
<body class="darkMode">
    <header class="main-header">
        <a href="/" class="logo">
            <img src="./img/logo.svg" alt="logo">
        </a>
        <div class="nav-container">
            <div class="menu-mobile">
                <img src="./img/menu.png" alt="menu hamburguesa">
            </div>
            <nav class="menu-desktop">
                <ul class="main-nav">
                    <li class="nav-item">
                        <a href="/nosotros">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a href="/servicios">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a href="/blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="/contacto">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a href="/login">Iniciar Sesión</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <aside class="mobile-menu hidden">
        <ul>
            <li class="mobile-item">
                <a href="/nosotros">Nosotros</a>
            </li>
            <li class="mobile-item">
                <a href="/servicios">Servicios</a>
            </li>
            <li class="mobile-item">
                <a href="/blog">Blog</a>
            </li>
            <li class="mobile-item">
                <a href="/contacto">Contacto</a>
            </li>
            <li class="mobile-item">
                <a href="/login">Iniciar Sesión</a>
            </li>
        </ul>
    </aside>
    <main class="contenedor">
        <?php echo $contenido; ?>
    </main>
    
    <footer class="footer">
        <div class="logo__footer">
            <a href="/">
                <img src="./img/logo.svg" alt="logo">
            </a>
        </div>
        <p>Datos de Contacto</p>
    </footer>
    <script src="./js/bundle.min.js"></script>
</body>
</html>