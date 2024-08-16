<?php
require_once 'includes/_startSession.php';
require_once 'includes/_header.php';

var_dump($_SESSION);

?>
<main class="dashboard-admin">
    <?php
    include 'includes/_notification.php';
    ?>
    <h1 class="dashboard-admin__ttl">Tableau de bord d'administration</h1>
    <nav>
        <ul class="dashboard-menu">
            <li><a class="dashboard-menu__a" href="#profil">Aperçu</a></li>
            <li><a class="dashboard-menu__a" href="#reservation">Réservation</a></li>
            <li><a class="dashboard-menu__a" href="#subscription">Abonnement</a></li>
            <li><a class="dashboard-menu__a" href="#articles">Articles</a></li>
            <li><a class="dashboard-menu__a" href="#articles">categories</a></li>
            <li><a class="dashboard-menu__a" href="#users">Utilisers</a></li>
        </ul>
    </nav>
    <h2 class="overview-ttl">Aperçu</h2>
    <section class="static">
        <h3 class="static__ttl">Remarques</h3>
        <form class="static-form" action="">
            <ul class="static-form-ul">
                <li class="static-form__start">
                    <label class="static-form__start-label" for="start-date">Date de début:</label>
                    <input class="static-form__start-input" type="date" id="start-date" name="start-date" value="2018-07-22" />
                </li>
                <li class="static-form__end">
                    <label class="static-form__end-label" for="end-period">Date de fin:</label>
                    <input class="static-form__end-input" type="date" id="start-date" name="end-period" value="2018-07-22" />
                </li>
            </ul>
        </form>
        <ul class="static-result">
            <li class="static-result-paid">
                <h4 class="static-result-paid__ttl">Payé</h4>
                <p class="static-result-paid__amount">€ 100</p>
            </li>
            <li class="static-result-Participants">
                <h4 class="static-result-Participants__ttl">Participants actuels</h4>
                <p class="static-result-Participants__number">15</p>
            </li>
            <li class="static-result-unpaid">
                <h4 class="static-result-unpaid__ttl">Montant impayé </h4>
                <p class="static-result-unpaid__amount">€ 100</p>
            </li>
            <li class="static-result-comming-Participants">
                <h4 class="static-result-comming-Participants__ttl">Participants non payé</h4>
                <p class="static-result-comming-Participants__number">€ 100</p>
            </li>
        </ul>


    </section>

</main>
<?php
include 'includes/_footer.php';
?>
</body>

</html>