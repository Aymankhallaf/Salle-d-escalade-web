<?php

$accountDetails = getsAccountDetails($dbCo, $_SESSION['idUser']);
?>

<h2 id="profile-details-tll"><a class="profile-details-tll" href="#profile-details">Réservation détails:</a></h2>
<div id="profile-details-div">
    <table id="profile-details-table" class="profile-details-table">
        <?php
        echo accountAddHtml($defaultKeys, $accountDetails);
        ?>
    </table>
</div>