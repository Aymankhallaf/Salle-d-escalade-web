<?php
require_once 'includes/_startSession.php';
include 'includes/_header.php';
?>
<section class="section artcl">
    <h1 class="sub-heading sub-heading__ttl--red">
        les derniers articles
    </h1>
    <ol class="artcl-holder">

        <?php
        $currentPageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $countPages = countPages($dbCo, 1, 10);
        $articles =  getArticlsByCategory($dbCo, 1, 10,$currentPageNumber);
        foreach ($articles as $article) {
            echo $article["id_post"];
            echo addHtlmArticleTtl($article);
        }
        ?>
        <!-- <li class="artcl-item">
            <img class="artcl-item__img" src="img/robe.webp" alt="un cordage">
            <h3 class="artcl-item__ttle">Masterclass : apprendre l’escalade avec des superstars de la discipline
                !</h3>
            <a target="_blank" href="#" class="link artcl-item__link">Lire Plus</a>
        </li>
        <li class="artcl-item">
            <img class="artcl-item__img" src="img/seb-bouin.webp" alt="Seb Bouin grimpe">
            <h3 class="artcl-item__ttle">Seb Bouin grimpe + que Jumbo Love sur la mythique Clark Mountain !</h3>
            <a target="_blank" href="#" class="link artcl-item__link">Lire Plus</a>
        </li>
        <li class="artcl-item">
            <img class="artcl-item__img" src="img/pic-saint-loup.webp" alt="Seb Bouin grimpe Saint Loup">
            <h3 class="artcl-item__ttle">Suivez Seb Bouin sur les parois du Pic Saint Loup !</h3>
            <a target="_blank" href="#" class=" link artcl-item__link">Lire Plus</a>
        </li> -->
    </ol>

</section>

<nav>
    <ul class="pages-number">
          <?php
        echoPagesNumbers($countPages,$currentPageNumber);
        ?>
    </ul>
</nav>