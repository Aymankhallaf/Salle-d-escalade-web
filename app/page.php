<?php
require_once 'includes/_startSession.php';


stripTagsArray($_REQUEST);
if (!isset($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])) {

    addError("invalid_id");
    redirectToHeader("index.php");
}
$article = getArticleById($dbCo, intval($_REQUEST['id']))[0];
if (!$article) {
    addError("article_not_found");
    redirectToHeader("index.php");
}

//header
include 'includes/_header.php';
?>

<main class="page">
    <?php include 'includes/_notification.php';
    ?>
    <!-- The article -->
    <article>
        <source media="(min-width: 960px)" srcset="<?= $article['href_img']; ?>">
        <img class="page-img" src="<?= $article['href_img']; ?>" alt="<?= $article['title']; ?>">
        <h1 class="page-header"><?= $article['title']; ?></h1>
        <p class="page-date">Publish date: <time datetime="<?= $article['date_post']; ?>"><?= $article['date_post'] ?></time>.</p>
        <p class="page-paragraph"><?= $article['paragraph']; ?></p>
        <?php
        if (isUserLoggedin() && isEditor()) {
            include 'includes/_actionsPage.php';
        }

        ?>
    </article>
</main>
<script type="module" src="./js/page.js"></script>


<!-- <main class="page">
    <source media="(min-width: 960px)" srcset="/img/robe-l.svg">
    <img class="page-img" src="/img/robe.webp" alt="robe">
    <h1 class="page-header">Masterclass : apprendre l’escalade avec des superstars de la discipline !</h1>
    <p class="page-date">Publish date: <time datetime="25 octobre 2021">25 octobre 2021</time>.</p>
    <p class="page-paragraph">Le fameux site américain Masterclass n’y pas avec le dos de la cuillère :
        s’agissant de proposer une offre de formation en escalade, il a choisi deux superstars comme professeurs.
        James Cameron qui vous enseigne la direction de film, Gordon Ramsay la cuisine, Gary Kasparov les échecs ou Natalie Portman le jeu d’acteur. Quoi de plus normal dans ce cas que l’escalade se découvre avec… Alex Honnold et Tommy Caldwell ! Connus pour leurs ascensions en duo mais aussi en solo sur les plus belles parois de la planète, les deux affirment détenir « 60 ans d’expériences combinées en escalade de haut niveau ».</p>

</main> -->
<?php
include 'includes/_footer.php';
?>
</body>

</html>