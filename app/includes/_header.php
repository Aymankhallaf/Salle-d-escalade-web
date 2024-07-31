<?php
session_start();
include_once 'includes/_connection.php';
 
generateToken();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salle d'escalade</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <?php
    if ($_ENV['ENV_TYPE'] === 'dev') {
        // Developement integration for vite with run dev
    ?>
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/js/script.js"></script>

    <?php
    } else if ($_ENV['ENV_TYPE'] === 'prod') {
        // Production integration for vite with run build
        echo loadAssets(['js/script.js','js/reservation/reservation.js']);
        // Try this way to load assets from manifest.json
        // https://github.com/andrefelipe/vite-php-setup
    }

    ?>
</head>

<body class="container">
    <header class="header">
        <img class="logo" src="img/Escalade-logo-s.svg" alt="escalade">

        <nav aria-label="Menu principal" id="header-nav" class="header-nav">
            <button aria-labelledby="header-nav" type="button" id="header-nav__btn" class="header-nav__btn"></button>
            <ul id="main-menu" class="header-nav__menu">
                <li><a class="header-nav__menu-link current" href="/" aria-current="page">Page
                        d’accueil</a></li>
                <li><a class="header-nav__menu-link" href="/">Abonnements</a></li>
                <li><a class="header-nav__menu-link" href="/reservation.php">Réservation</a></li>
                <li><a class="header-nav__menu-link" href="index.html#propres-a-nos">Propres à Nos </a></li>
                <li><a class="header-nav__menu-link" href="index.html#nous-conactert">Nous Conacter</a></li>
                <li><a class="header-nav__menu-link" href="index.html#nous-conactert">Evènements</a></li>

            </ul>
        </nav>
        <span data-token="<?= $_SESSION['token']; ?>" class="hidden" id="token"></span>
    </header>