<?php
require_once 'includes/_startSession.php';

// var_dump(getUserReservationHistory($dbCo,$_SESSION["idUser"]));

//csfr protection
if (!isServerOk()) {
    addError('referer');
    redirectToHeader("index.php");
}

//login verification
if (!isUserLoggedin()) {
    addError("need_login");
    redirectToHeader("connectez-vous.php");
}
require_once 'includes/_config.php';

include 'includes/_header.php';
include 'includes/_notification.php';
?>
<main class="dashboard">
    <?php include 'includes/_navDashboard.php'; ?>
    <!-- profile -->
    <section id="profil" class="profile-details js-tab-dashboard tab-dashboard--active">
        <?php include 'includes/_profil.php'; ?>
    </section>
    <!-- reservation -->
    <section id="reservation" class="reservation-details js-tab-dashboard hidden ">

        <?php include 'includes/_reservationhistory.php'; ?>


    </section>
    <!-- subscription -->
    <section id="subscription" class="subscription-details js-tab-dashboard hidden ">
    <?php include 'includes/_subsciriptionhistory.php'; ?>

    </section>
    <!-- articles -->
    <section id="articles" class="articles-details js-tab-dashboard hidden">
        <?php include 'includes/_createArticle.php'; ?>
    </section>

</main>


<script type="module" src="./js/reservationDetails.js"></script>
<script type="module" src="./js/dashboard.js"></script>



<!-- template reservation -->

<template id="template-reservation">
    <table id="reservation-details-table" class="reservation-details-table">
        <tr class="reservation-details-raw">
            <th>Salle</th>
            <td id="gym">Salle1</td>
        </tr>
        <tr class="reservation-details-raw">
            <th>Date de réservation</th>
            <td id="dateReservation">14/07/2024 8:30</td>
        </tr>
        <tr class="reservation-details-raw">
            <th>Durée</th>
            <td id="duration">1h</td>
        </tr>
        <tr class="reservation-details-raw">
            <td id="totalPrix">50€</td>
        </tr>
        <tr class="reservation-details-raw">
            <th>Statut</th>
            <td id="status">modifier</td>
        </tr>
    </table>
    <ul class="reservation-details-raw">
        <li id="reservation-edit"><a class="reservation-edit">modifier</a></li>

        <li><a id="reservation-cancel" class="reservation-cancel">annuler</a></li>
    </ul>

</template>

<template id="templateError">
    <li data-error-message="" class="errors__itm">Ici vient le message d'erreur</li>
</template>

<template id="templateMessage">
    <li data-message="" class="messages__itm">Ici vient le message</li>
</template>
<!-- gym template -->
<template id="hallTemplate">
    <option class="hall__option js-hall-option" value="" required>Veuillez choisir une option</option>
</template>

<!-- days template -->
<template id="day-template">
    <li><a><time datetime="" data-date="" class="calender__month--day js-calender__month--day"></time></a></li>
</template>

<!-- hours template -->
<template id="hours-template">
    <li><a><time class="hours__container--element js-hours__element" datetime="" data-hour="" data-minutes=""></time></a></li>
</template>


<template id="templateError">
    <li data-error-message="" class="errors__itm">Ici vient le message d'erreur</li>
</template>

<template id="templateMessage">
    <li data-message="" class="messages__itm">Ici vient le message</li>
</template>
<?php
include 'includes/_footer.php';
?>

</body>

</html>