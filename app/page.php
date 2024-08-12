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
    <source media="(min-width: 960px)" srcset="<?= $article['href_img']; ?>">
    <img class="page-img" src="<?= $article['href_img']; ?>" alt="<?= $article['title']; ?>">
    <h1 class="page-header"><?= $article['title']; ?></h1>
    <p class="page-date">Publish date: <time datetime="<?= $article['date_post']; ?>"><?= $article['date_post'] ?></time>.</p>
    <p class="page-paragraph"><?= $article['paragraph']; ?></p>

    <div class="articl-actions">
        <button id="articl-actions-delete" type="submit" class="articl-actions-delete-btn">Supprimer</button>
        <button id="articl-actions-edit" type="submit" class="articl-actions-edit-btn">Editer</button>
    </div>

    <form id="articl-delete-form" class="articl-delete-form hidden" method="POST" action="actions.php">
        <input type="hidden" id="token" name="token" value="<?= $_SESSION['token']; ?>">
        <label for="idPost">Vous voulez supprimer cette article !!</label>
        <input type="hidden" name="idPost" value="<?= $article['id_post']; ?>">
        <input type="hidden" name="action" value="deleteArticle">
        <div class="articl-delete-form-btn">
            <button id="articl-delete-form-btn__cancel" type="button" class="articl-delete-form-btn__cancel">Annuler</button>
            <button id="articl-delete-form-btn__delete" type="submit" class="articl-delete-form-btn__delete">Supprimer</button>
        </div>

    </form>
    <!-- <form id="edit-form" class="signup-form" method="POST" action="actions.php">
        <input type="hidden" id="token" name="token" value="<?= $_SESSION['token'] ?>">
        <input type="hidden" id="token" name="token" value="<?= $_SESSION['token'] ?>">
        <input type="hidden" name="action" value="editArticle">
        <button id="edit" type="submit" class="stepper-btn__next">edit</button>
    </form> -->
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