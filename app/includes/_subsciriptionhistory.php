<?php
$resrvationHistory = getUserSubscriptionHistory($dbCo, $_SESSION['idUser']);
?>

<h2 id="reservation-details-tll"><a class="reservation-details-tll" href="#reservation-details">Réservation détails:</a></h2>
<div id="reservation-details-div">
    <table id="reservation-details-table" class="reservation-details-table">
        <tr class="profile-details-raw">
            <th>Numéro</th>
            <th>Date de abonnement</th>
            <th>Action</th>
        </tr>
        <?php
        if (!empty($resrvationHistory)) {

            foreach ($resrvationHistory as $resrvation) {
                echo addHtmlReservation($defaultKeys, $resrvation);
            }
        }

        ?>
    </table>
</div>