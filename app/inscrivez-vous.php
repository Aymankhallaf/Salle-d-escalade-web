<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="css/style.css">
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

<body>
    <header class="header">
        <img class="logo" src="img/Escalade-logo-s.svg" alt="escalade">

        <nav aria-label="Menu principal" id="header-nav" class="header-nav">
            <button aria-labelledby="header-nav" type="button" id="header-nav__btn" class="header-nav__btn"></button>
            <ul id="main-menu" class="header-nav__menu">
                <li><a class="header-nav__menu-link" href="index.html" aria-current="page">Page
                        d’accueil</a></li>
                <li><a class="header-nav__menu-link" href="index.html#abonnements">Abonnements</a></li>
                <li><a class="header-nav__menu-link current" href="/reservation.html">Réservation</a></li>
                <li><a class="header-nav__menu-link" href="index.html#propres-a-nos">Propres à Nos </a></li>
                <li><a class="header-nav__menu-link" href="index.html#nous-conactert">Nous Conacter</a></li>
                <li><a class="header-nav__menu-link" href="index.html#nous-conactert">Evènements</a></li>

            </ul>
        </nav>

    </header>
    <main>
        <h1 class="inscrivez-header" id="inscrivez">Inscrivez vous</h1>
        <p>Veuillez suivre les étapes pour vous inscrire</p>
        <ul class="stepper">
            <li class="stepper-name"><a aria-labelledby="info-personal" for="info-personal" href="#" aria-current="step"
                    class="stepper__stepper-name--current"></a>
            </li>
            <li class="stepper-coordinate"></li>
            <li class="stepper-account"></li>

        </ul>
        <form id="inscrivez-form" class="inscrivez-form" aria-label="formulaire de connexion" method="get">
            <h2 class="inscrivez-ttl__info" id="info-personal">Les Informations personnelles</h2>
            <ul>
                <li class="inscrivez-form__lname">
                    <label class="inscrivez-form__lname-label" for="lname">NOM</label>
                    <input class="inscrivez-form__lname-input" type="text" name="lname" id="lname" maxlength="50"
                        required />
                </li>
                <li class="inscrivez-form__fname">
                    <label class="inscrivez-form__fname-label" for="fname">Prénom</label>
                    <input class="inscrivez-form__fname-input" type="text" name="fname" maxlength="50" id="fname"
                        required />
                    <label class="inscrivez-form__birthdate-label" for="birthdate" maxlength="50">Date de naissance</label>
                    <input class="inscrivez-form__birthdate-input" id="birthdate" name="birthdate" type="date" required>

                </li>
            </ul>
            <h2 class="inscrivez-ttl__coordinate" id="coordinate">Les coordonnées</h2>
            <ul>
                <li class="inscrivez-form__tel">
                    <label class="inscrivez-form__tel-label" for="tel">Numéro de téléphone</label>
                    <input class="inscrivez-form__tel-input" type="tel" name="tel" id="tel" maxlength="15" required />
                </li>
                <li class="inscrivez-form__adresse">
                    <label class="inscrivez-form__adresse-label" for="adresse">L'adresse</label>
                    <input class="inscrivez-form__adresse-input" type="text" name="adresse" id="adresse" required />
                </li>
                <li class="inscrivez-form__city">
                    <label class="inscrivez-form__city-label" for="city" maxlength="50">Ville</label>
                    <input class="inscrivez-form__city-input" type="text" name="city" id="city" required />
                </li>
            </ul>
            <h2 class="inscrivez-ttl__account" id="account">Informations du compte</h2>
            <ul>
                <li class="inscrivez-form__email">
                    <label class="inscrivez-form__email-label" for="email">Email</label>
                    <input class="inscrivez-form__email-input" type="email" name="email" id="email" required />
                </li>
                <li class="inscrivez-form__password">
                    <label class="inscrivez-form__password-label" for="password">Password</label>
                    <input class="inscrivez-form__password-input" type="password" name="password" id="password"
                        required />
                </li>
                <li class="inscrivez-form__confirm-psw">
                    <label class="inscrivez-form__confirm-psw-label" for="confirm-psw">Confirmiez le Password</label>
                    <input class="inscrivez-form__confirm-psw-input" type="password" name="confirm-psw" id="confirm-psw"
                        required />
                </li>
            </ul>
        </form>



    </main>

    <footer class="section footer">
        <nav aria-labelledby="#footer-nav">
            <h4 id="#footer-nav" class="footer-nav__ttle">Plus de links</h4>
            <ol class="footer-nav__menu">
                <li class="footer-nav__item"><a class="footer-nav__link" href="#">Les tarifs</a></li>
                <li><a target="_blank" class="footer-nav__link" href="#">Mention légales</a></li>
                <li><a target="_blank" class="footer-nav__link" href="#">Les Horaires</a></li>
                <li><a target="_blank" class="footer-nav__link" href="#">Propre de nos</a></li>
            </ol>

        </nav>
        <nav aria-labelledby="social-media">
            <h4 id="social-media" class="social-media__ttle">Nos Suivre</h4>
            <ul class="social-media__menu">
                <li><a href="" target="_blank"><img src="/img/instagram-svgrepo-com.svg" alt="instagram icon"></a></li>
                <li><a href="" target="_blank"><img src="/img/fb_iconCarrier.svg" alt="facebook icon"></a></li>
                <li><a href="" target="_blank"><img src="/img/xVector.svg" alt="x.com icon"></a></li>
            </ul>
        </nav>
        <h5 class="copywrite">©Ayman KHALLAF 2024. All rights reversed.</h5>
    </footer>

</body>
<script type="module" src="./js/script.js"></script>

</html>