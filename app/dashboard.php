<?php
include 'includes/_header.php';

?>
<main class="dashboard-reservation"  >

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
        <table class="reservation-details-table">
            <tr class="reservation-details-raw">
                <th>Salle</th>
                <td>Salle1</td>
            </tr>
            <tr class="reservation-details-raw">
                <th>Date de réservation</th>
                <td>14/07/2024 8:30</td>
            </tr>
            <tr class="reservation-details-raw">
                <th>Durée</th>
                <td>1h</td>
            </tr>
            <tr class="reservation-details-raw">
                <th>Total Prix</th>
                <td>50€</td>
            </tr>
            <tr class="reservation-details-raw">
                <th>Statut</th>
                <td>Payé</td>
            </tr>
        </table>
    </section>

</main>
<script type="module" src="./js/getLocationHash.js"></script>
<?php

include 'includes/_footer.php';

?>
</body>

</html>