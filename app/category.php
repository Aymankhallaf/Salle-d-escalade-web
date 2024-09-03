<?php
require_once 'includes/_startSession.php';
//veriy data 
stripTagsArray($_GET);
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    addError("referer");
    redirectToHeader("index.php");
}

$idCategory = intval($_GET["id"]);
if (isset($_GET["page"])) {
    if (!is_numeric($_GET["page"])) {

        addError("referer");
        redirectToHeader("index.php");
    }
    
    $idPage = intval($_GET["page"]);
}
verifyIdCategory($dbCo, $idCategory);

//header
include 'includes/_header.php';

?>
<section class="section artcl">
    <h1 class="sub-heading sub-heading__ttl--red"><?= getCategoryById($dbCo, $idCategory); ?></h1>
    <ol class="artcl-holder">

        <?php
        $currentPageNumber = isset($idPage) ? (int)$idCategory : 1;
        $countPages = countPages($dbCo, $idCategory, 10);
        $articles =  getArticlsByCategory($dbCo, $idCategory, 10, $currentPageNumber);
        foreach ($articles as $article) {
            echo addHtlmArticleTtl($article);
        }
        ?>

    </ol>
</section>
<nav>
    <ul class="pages-number">
        <?php
        echoPagesNumbers($countPages,  $currentPageNumber, $idCategory);
        ?>
    </ul>
</nav>
</body>