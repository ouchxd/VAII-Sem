<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoservis</title>
    <!-- Kniznica s ikonami -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <div class="logo">LOGO</div>
    <div class="contact-info">
        <div class="contact-item">
            <i class="fa-regular fa-envelope"></i>
            <span>xxxxxx@xxxxx.xx</span>
        </div>
        <div class="contact-item">
            <i class="fa-solid fa-phone"></i>
            <span>+421/41 513 4121</span>
        </div>
        <div class="contact-item">
            <i class="fa-regular fa-clock"></i>
            <span>Pon - Pia (8:00 - 16)</span>
        </div>
    </div>
    <div class="user-info">
        <span>Filip Zvonek - technik</span><br>
        <!-- Odkaz na odhlásenie (štandardne auth.logout) -->
        <a href="<?= $link->url('auth.logout') ?>"><button>Odhlásiť sa <i class="fa-solid fa-arrow-right-from-bracket"></i></button></a>
    </div>
</header>

<nav>
    <ul>
        <!-- Hlavná stránka zvyčajne býva home.index -->
        <li><a href="<?= $link->url('home.index') ?>">Domov</a></li>
        <!-- Ukážky odkazov na ďalšie akcie v HomeControlleri -->
        <li><a href="<?= $link->url('home.contact') ?>">Kontakt</a></li>
        <li><a href="<?= $link->url('home.recenzie') ?>">Recenzie</a></li>
        <li><a href="<?= $link->url('home.onas') ?>">O nás</a></li>
        <li><a href="<?= $link->url('home.sluzby') ?>">Služby <i class="fa-solid fa-caret-down"></i></a></li>
        <li><a href="<?= $link->url('home.cennik') ?>">Cenník</a></li>
        <!-- Prepínač jazyka môže zatiaľ ostať prázdny alebo odkazovať na domovskú stránku -->
        <li style="margin-left: auto;"><a href="<?= $link->url('home.index') ?>">SK <i class="fa-solid fa-caret-down"></i></a></li>
    </ul>
</nav>

<!-- Sem sa vloží obsah z pohľadov -->
<?= $contentHTML ?>

<footer>
    &copy; 2026 Autoservis - Všetky práva vyhradené
</footer>

</body>
</html>