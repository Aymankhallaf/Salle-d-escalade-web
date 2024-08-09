<?php
require_once 'includes/_startSession.php';

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

include 'includes/_header.php';
include 'includes/_notification.php';
?>
<main class="dashboard-reservation">
    <?php
    include 'includes/_navDashboard.php';
    
    include 'includes/_profile.php';

    include 'includes/_reservationDetails.php';
    ?>
</main>
<script type="module" src="./js/reservationDetails.js"></script>
<?php

include 'includes/_footer.php';

?>
</body>

</html>