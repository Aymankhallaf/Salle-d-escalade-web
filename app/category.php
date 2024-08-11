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
        $articles =  getArticlsByCategory($dbCo, 1, 10, $currentPageNumber);
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