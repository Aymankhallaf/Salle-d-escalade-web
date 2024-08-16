<?php
require_once 'includes/_startSession.php';

// var_dump($_SESSION);

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
?>
<main class="dashboard">
    include 'includes/_notification.php';
<h1 class="dashboard-ttl" id="reservation">Tableau de bord</h1>

    <!-- reservation -->
    <section id="reservation" class="tab-dashboard reservation-details">
        <h2 id="reservation-details-tll"><a class="reservation-details-tll" href="#reservation-details">Réservation détails:</a></h2>
        <div id="reservation-details-div">
        </div>
    </section>

<script type="module" src="./js/reservationDetails.js"></script>

<?php
include 'includes/_footer.php';
?>

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
</body>

</html>