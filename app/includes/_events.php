<?php
// require_once 'includes/_startSession.php';

$categories =  getCategories($dbCo);
?>

<section aria-labelledby="events">
    <h2 id="events" class="sub-heading sub-heading__ttl--red">Evènements</h2>
    <ul class="card-holder">
        <li class="card card-events">
            <img class="card__img" src="img/birthday-25.webp" alt="fille célébrant son anniversaire">
            <h3 class="card__ttl card__ttl--h3"><?= $categories["1"]["name"] ?></h3>
            <p class="card__txt"><?= $categories["1"]["description"] ?>
            </p>
            <a target="_blank" href="category.php?id=<?= $category["1"]['id']; ?>" class="btn card__btn">En savoir plus</a>
        </li>
        <li class="card card-events">
            <img class="card__img" src="img/competatiopn-s.webp" alt="Un homme participe à une compétition.">
            <h3 class="card__ttl card__ttl--h3"><?= $categories["2"]["name"] ?></h3>
            <p class="card__txt"><?= $categories["2"]["description"] ?>
            </p>
            <a target="_blank" href="#" class="btn card__btn">En savoir plus</a>
        </li>

        <li class="card card-events">
            <img class="card__img" src="img/events-s.webp" alt="Un groupe participe à un événement.">
            <h3 class="card__ttl card__ttl--h3"><?= $categories["3"]["name"] ?></h3>
            <p class="card__txt"><?= $categories["3"]["description"] ?>
            </p>
            <a target="_blank" href="#" class="btn card__btn">En savoir plus</a>
        </li>
    </ul>
</section>