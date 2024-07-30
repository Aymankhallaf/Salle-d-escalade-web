<?php
include 'includes/_header.php';
if (!isServerOk()) {
    triggerError('referer');
}

?>
<main class="dashboard-reservation">

    <h1 class="dashboard-ttl" id="reservation">Réservation</h1>
    <nav>
        <ul class="dashboard-menu">
            <li><a class="dashboard-menu__a" href="#">Profil</a></li>
            <li><a class="dashboard-menu__a dashboard-menu__a--current" href="#">Réservation</a></li>
            <li><a class="dashboard-menu__a" href="#">Abonnement</a></li>
        </ul>
    </nav>
    <section class="reservation-details">
        <h2 class="reservation-details-tll" id="reservation-details-tll"><a href="#reservation-details">Réservation détails:</a></h2>


    </section>
    <!-- template reservation -->
    <table id="reservation-details-table" class="reservation-details-table">

        <template id="template-reservation">
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
                <th>Total Prix</th>
                <td id="totalPrix">50€</td>
            </tr>
            <tr class="reservation-details-raw">
                <th>Statut</th>
                <td id="status">modifier</td>
            </tr>
    </table>
    <ul class="reservation-details-raw">
        <li id="reservation-edit"><button class="reservation-edit">modifier</button></li>

        <li><button id="reservation-cancel" class="reservation-cancel">annuler</button></li>
    </ul>

    </template>

    <template>
        <li data-message="" class="messages__itm">Ici vient le message</li>
    </template>
</main>
<script type="module" src="./js/getLocationHash.js"></script>
<?php

include 'includes/_footer.php';

?>
</body>

</html>