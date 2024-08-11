<?php
require_once 'includes/_startSession.php';
include 'includes/_header.php';
stripTagsArray($_GET);

?>
<section class="section artcl">
    <h1 class="sub-heading sub-heading__ttl--red">
        <?= $_GET["name"]?>
    </h1>
    <ol class="artcl-holder">

        <?php
        $currentPageNumber = isset($_GET['page']) ? $_GET['page'] : 1;
        $countPages = countPages($dbCo, $_GET['page'], 10);
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