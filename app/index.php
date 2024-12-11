<?php
require_once 'includes/_startSession.php';
include 'includes/_header.php';

?>
<main>
    <?php
    echo getHtmlMessages($messages);
    echo getHtmlErrors($errors);
    // var_dump(
    //     value: password_hash("mb8!7FS5szd_99Y", PASSWORD_DEFAULT)
    // );
    ?>
    <ul id="errorsList" class="error"></ul>
    <ul id="messagesList" class="messages"></ul>
    <section class="hero-banner" aria-labelledby="hero-banner">

        <h1 id="hero-banner" class="hero-banner__ttl">Bienvenue chez
            Salle d’escalade</h1>
        <p class="hero-banner__subttl">Nous vous invitons à rejoindre notre club à des tarifs adaptés à tous</p>
        <a target="_blank" class="hero-banner__btn" href="/abonnements.php">Abonnez-vous</a>
        <a class="circle-btn" href="#about-us" aria-labelledby="about-us"></a>
    </section>

    <section class="open-houres section" aria-labelledby="open-heures">
        <div class="sub-heading-container">
            <img class="sub-heading__img " src="img/clock.svg" alt="les horaires icon">
            <h2 id="open-heures" class="sub-heading sub-heading__ttl--black">les horaires</h2>
        </div>
        <ul class="open-houres__txt" aria-label="Voici les horaires d'ouverture de la semaine.">
            <li class="open-houres__txt--black">
                Du <time>Mardi</time> jusqu'à <time>Mercredi</time> <br> De <time>10:00</time> h
                à <time>19:00</time> h
            </li>

            <li class="open-houres__txt--blue-petrol">
                <time>Samedi</time> - <time>Dimanche</time> <br>
                De <time>11:00</time> h - <time>20:00</time> h
            </li>

            <li class="open-houres__txt--red">
                <time>Lundi</time> <br> fermeture
            </li>
        </ul>

    </section>

    <!-- check why there are "subheading-icon sub-heading__img "  -->

    <section class="open-houres section" aria-labelledby="reservation">
        <div class="sub-heading-container">
            <img class="sub-heading__img" src="img/priceticket.svg" alt="le prix icon">
            <h2 id="price" class="sub-heading sub-heading__ttl--black">les Tarifs</h2>
        </div>
        <div class="sub-heading__txt">
            Les tarifs sont adaptés pour nous tous.
        </div>
        <ul class="open-houres__txt" aria-label="Voici la liste des prix">

            <li class="open-houres__txt--black">
                8€ / 30 minutes
            </li>
            <li class="open-houres__txt--blue-petrol">
                12€ / 1 heure </li>

            <li class="open-houres__txt--red">
                15 € toute la journée
            </li>

        </ul>
        <a id="reservation" title="Aller à la page de réservation" target="_blank" href="/reservation.php" class="btn reserve__btn">Réservez</a>

    </section>

    <section aria-labelledby="about-us">
        <div class="card card--padding">
            <h2 id="about-us" class="card__ttl">Propre à Nos</h2>
            <p class="card__txt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                ullamco
                laboris nisi ut aliquip</p>
            <a target="_blank" href="#about-us" class=" btn card__btn">En savoir plus</a>
        </div>

    </section>

    <section class="section salle">
        <ul class="galary" aria-label="">
            <li class="galary__item galary__item-1"><a target="_blank" class="galary__lnk" href="page.php?article=Escalade-aventure&id=244">Escalade aventure 1</a>
            </li>
            <li class="galary__item galary__item-2"><a target="_blank" class="galary__lnk" href="page.php?article=escalade-aventure-2&id=246">Escalade aventure 2</a></li>
        </ul>
    </section>

    <!-- events -->
    <?php include 'includes/_events.php'; ?>

    <!-- contact us -->
    <a href="tel:0123456789" class="sub-heading-container btn contact-us__btn">
        Nos contacter
    </a>

    <!-- last 3 articles from category articles -->
    <section class="section artcl">
        <h2 class="sub-heading sub-heading__ttl--red">
            les derniers articles
        </h2>
        <ol class="artcl-holder">
            <?php
            $articles =  getArticlsByCategory($dbCo, 1, 3, 1);
            foreach ($articles as $article) {
                echo addHtlmArticleTtl($article);
            }
            ?>
        </ol>
        <a target="_blank" href="category.php?id=<?= $categories["0"]['id_category'] ?>" class="btn artcl__btn">Plus d’articles</a>

    </section>

</main>


<?php
include 'includes/_footer.php';
?>
</body>
<script type="module" src="./js/script.js"></script>

</html>