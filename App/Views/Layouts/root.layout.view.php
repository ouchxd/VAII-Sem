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
        <a href="<?= $link->url('auth.logout') ?>"><button>Odhlásiť sa <i class="fa-solid fa-arrow-right-from-bracket"></i></button></a>
    </div>
</header>

<nav>
    <ul>
        <li><a href="<?= $link->url('home.index') ?>">Domov</a></li>
        <li><a href="<?= $link->url('home.contact') ?>">Kontakt</a></li>
        <li><a href="<?= $link->url('home.recenzie') ?>">Recenzie</a></li>
        <li><a href="<?= $link->url('home.onas') ?>">O nás</a></li>
        <li class="dropdown">
            <button type="button" class="dropdown-toggle" tabindex="0">
                Služby <i class="fa-solid fa-caret-down"></i>
            </button>
            <ul class="dropdown-menu" tabindex="-1">
                <li><a href="<?= $link->url('zakazka.index') ?>">Zoznam zákaziek</a></li>
            </ul>
            <ul class="dropdown-menu" tabindex="-1">
                <li><a href="<?= $link->url('zakazka.index') ?>">Zoznam zákaziek</a></li>
                <li><a href="<?= $link->url('auto.index') ?>">Zoznam vozidiel</a></li>
            </ul>
        </li>
        <li><a href="<?= $link->url('home.cennik') ?>">Cenník</a></li>
    </ul>
</nav>

<?= $contentHTML ?>

<footer>
    &copy; 2026 Autoservis - Všetky práva vyhradené
</footer>

</body>
</html>