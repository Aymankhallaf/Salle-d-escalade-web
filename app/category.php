<?php
require_once 'includes/_startSession.php';
//veriy data 
stripTagsArray($_GET);
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    addError("referer");
    redirectToHeader("index.php");
}
verifyIdCategory($dbCo, $_GET["id"]);
//header
include 'includes/_header.php';

?>
<section class="section artcl">
    <h1 class="sub-heading sub-heading__ttl--red"><?=getCategoryById($dbCo, $_GET["id"]);?></h1>
    <ol class="artcl-holder">

        <?php
        $currentPageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $countPages = countPages($dbCo, $_GET['id'], 10);
        $articles =  getArticlsByCategory($dbCo, $_GET["id"], 10, $currentPageNumber);
        foreach ($articles as $article) {
            echo addHtlmArticleTtl($article);
        }
        ?>

    </ol>
</section>
<nav>
    <ul class="pages-number">
        <?php
        echoPagesNumbers($countPages, $currentPageNumber);
        ?>
    </ul>
</nav>
</body>