<?php
require_once 'includes/_startSession.php';
stripTagsArray($_GET);
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    
    addError("referer");
    redirectToHeader("index.php");
}    
$article = getArticleById($dbCo, intval($_GET['id']))[0];
include 'includes/_header.php';
?>

<main class="page">
    <source media="(min-width: 960px)" srcset="<?= $article['href_img'] ?>">
    <img class="page-img" src="<?= $article['href_img'] ?>" alt="<?= $article['title'] ?>">
    <h1 class="page-header"><?= $article['title'] ?></h1>
    <p class="page-date">Publish date: <time datetime="<?= $article['date_post'] ?>"><?= $article['date_post'] ?></time>.</p>
    <p class="page-paragraph"><?= $article['paragraph'] ?></p>
</main>



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