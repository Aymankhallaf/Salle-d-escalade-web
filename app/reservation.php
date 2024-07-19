<?php
include 'includes/_header.php';
?>

<main>
    <h1 class="reservation-ttl" id="reservation">Réservation</h1>
    <ul id="errorsList" class="errors"></ul>
    <ul id="messagesList" class="messages"></ul>
    <form id="reservation-form" class="reservation-form" aria-label="veuillez remplir le formulaire de réservation" method="get">
        <ul aria-labelledby="reservation-form">
            <!-- hall -->
            <li class="warp-input hall">
                <label class="hall__ttl" id="hall_ttl" for="hall">Choisissez la salle: </label>
                <select class="hall__select js-select" name="hall" id="hall">
                    <option class="hall__option" value="" required>Veuillez choisir une option</option>
                </select>
            </li>
            <!-- participant -->
            <li class="warp-input participant">
                <label class="participant__ttl" for="participants">Numéro de participants:</label>
                <div class="participant__container">
                    <button id="decrease-participant" aria-label="bouton moins" class="participant__btn participant__btn--minus" type="button"></button>
                    <input class="participant__input" type="text" id="participants" name="participants" min="1" max="2" value="0">
                    <button id="increase-participant" aria-label="bouton plus" class="participant__btn participant__btn--plus" type="button"></button>
                    <p id="participant__display" class="participant__display"></p>
                </div>
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

                    <p class="calender__selected-txt"></p>
                </div>
            </li>
            <!-- end calender -->
            <!-- duration -->
            <li class="warp-input duration">
                <label class="duration__ttl" id="duration-label" for="duration">Choisissez le duration: </label>
                <select class="duration__select js-select" name="duration" id="duration">
                    <option class="duration__option" value="" required>Veuillez choisir une option</option>
                    <option class="duration__option" value="1">30 minutes <span class="" data-price="8">/ 8
                            €</span>
                    </option>
                    <option class="duration__option" value="2">60 minutes <span class="" data-price="12">/ 12
                            €</span>
                    </option>
                    <option class="duration__option" value="3">1 jour <span class="" data-price="15">/ 15 €</span>
                    </option>
                </select>
            </li>
            <!-- start hour -->
            <li class="warp-input hours">
                <p for="hours__display" class="hours__ttl" id="hours">Choisissez l'heures:</p>
                <div id="hours__display" class="hours__display">
                    <ol id="hours__container" class="hours__container">
                    </ol>
                </div>

            </li>

        </ul>
        <div class="reservation-form__btn-container">
            <button id="reservationFormBtn" type="submit" class="btn--blue-petrol reservation-form__btn">Confirmer</button>
        </div>
    </form>
</main>

<?php
include 'includes/_footer.php';
?>

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


</body>

</html>