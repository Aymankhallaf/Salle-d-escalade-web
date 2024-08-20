<?php
require_once 'includes/_startSession.php';

if (!isServerOk()) {
    triggerError('referer');
}

if (!isUserLoggedin()) {
    addError("need_login");
    redirectToHeader("connectez-vous.php");
}
include 'includes/_header.php';

?>

<main>
    <h1 class="abonnement-ttl" id="abonnement">Abonnements</h1>
    <ul id="errorsList" class="errors"></ul>
    <ul id="messagesList" class="messages"></ul>
    <form id="abonnement-form" class="abonnement-form" aria-label="duration-label" method="get">
        <ul>
            <!-- hall -->
            <li class="warp-input hall">
                <label class="hall__ttl" id="hall_ttl" for="hall">Choisissez la salle: </label>
                <select class="hall__select js-select" name="hall" id="hall">
                    <option class="hall__option" value="" required>Veuillez choisir une option</option>

                </select>
            </li>
            <!-- duration -->
            <li class="warp-input duration">
                <label class="duration__ttl" id="duration-label" for="duration">Choisissez le duration: </label>
                <select class="duration__select js-select" name="duration" id="duration">
                    <option class="duration__option" value="" required>Veuillez choisir une option</option>
                    <option class="duration__option" value="30">30 minutes <span class="" data-price="8">/ 8
                            €</span>
                    </option>
                    <option class="duration__option" value="60">60 minutes <span class="" data-price="12">/ 12
                            €</span>
                    </option>
                    <option class="duration__option" value="120">1 jour <span class="" data-price="15">/ 15 €</span>
                    </option>
                </select>
            </li>
            <!-- calender -->
            <li class="warp-input calender-container">
                <p for="calender" class="calender__label" id="calender__label">Choisissez la date: </p>
                <div id="calender" class="calender__display">
                    <header class="calender__header">
                        <button type="button" id="calender__left" class="calender__left"><img src="./img/arrow-left.svg" alt="icône de bouton précédent"></button>
                        <time data-month="" id="calender__ttl" class="calender__ttl"></time>
                        <button type="button" id="calender__right" class="calender__right"><img src="./img/arrow-right.svg" alt="icône de bouton suivant"></button>
                    </header>
                    <ol class="calender__week">
                        <li class="calender__week--day">Lu</li>
                        <li class="calender__week--day">Ma</li>
                        <li class="calender__week--day">Me</li>
                        <li class="calender__week--day">Je</li>
                        <li class="calender__week--day">Ve</li>
                        <li class="calender__week--day">Sa</li>
                        <li class="calender__week--day">Di</li>
                    </ol>
                    <ol id="month-days" class="calender__month">
                        <!--days will be filled here-->
                    </ol>
                    <template id="day-template">

            <li><time datetime="" data-date="" class="calender__month--day js-calender__month--day"></time></li>
            </template>
            <p class="calender__selected-txt"></p>
            </div>
            </li>
            <!-- end calender -->

        </ul>
        <div class="abonnement-form__btn-container">
            <button id="abonnementFormBtn" type="submit" class="btn--blue-petrol abonnement-form__btn">Confirmer</button>
        </div>
    </form>
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
</main>

<script type="module" src="./js/reservation/abonnements.js"></script>

<?php
include 'includes/_footer.php';
?>
</body>

</html>

<template id="templateError">
    <li data-error-message="" class="errors__itm">Ici vient le message d'erreur</li>
</template>

<template id="templateMessage">
    <li data-message="" class="messages__itm">Ici vient le message</li>
</template>

</body>

</html>