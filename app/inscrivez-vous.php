<?php
include 'includes/_header.php';
?>

<main>
    <h1 class="inscrivez-header" id="inscrivez">Inscrivez vous</h1>
    <p class="inscrivez-sub-header">Veuillez suivre les étapes pour vous inscrire</p>
    <ol class="stepper">
        <li class="stepper-profile">
            <img src="./img/name-current-icon.svg" alt="photo pour l'etape les informations personnelles">
            <a aria-labelledby="info-personal" for="info-personal" href="#info-personal" aria-current="step" class="stepper__stepper-name--current">les personal informations.</a>
        </li>
        <li class="stepper-coordinate">
            <img src="./img/adresse.svg" alt="photo pour l'etape les coordonnées>
        <a aria-labelledby="coordinate" for="coordinate" href="#coordinate" aria-current="false" class="stepper__stepper-adresse--next">Les coordonnées.</a>
        </li>
        <li class="stepper-account">
            <img src="./img/mail.svg" alt="photo pour l'etape Infomation du compte">
            <a aria-labelledby="account" for="account" href="#account" aria-current="false" class="stepper__stepper-name--current">Infomation du compte</a>
        </li>

    </ol>
    <ul id="errorsList" class="error"></ul>
    <ul id="messagesList" class="messages"></ul>
    <form id="inscrivez-form" class="inscrivez-form" aria-label="formulaire de connexion" method="get">
        <!-- step 1 -->
        <div class="step-1">
            <h2 class="inscrivez-ttl__info" id="info-personal">Les informations personnelles</h2>
            <ul class="inscrivez-ul inscrivez-ul__first">
                <li class="inscrivez-form__lname">
                    <label class="inscrivez-form__lname-label" for="lname">Nom</label>
                    <input pattern="\w{3,50}" placeholder="ex. François" class="inscrivez-form__lname-input" type="text" name="lname" id="lname" maxlength="50" required />
                </li>
                <li class="inscrivez-form__fname">
                    <label class="inscrivez-form__fname-label" for="fname">Prénom</label>
                    <input pattern="\w{3,50}" placeholder="ex. jean" class="inscrivez-form__fname-input" type="text" name="fname" maxlength="50" id="fname" required />
                    <label class="inscrivez-form__birthdate-label" for="birthdate" maxlength="50">Date de naissance</label>
                    <input class="inscrivez-form__birthdate-input" id="birthdate" name="birthdate" type="date" required>

                </li>
            </ul>
            <button id="step-btn-1" type="button" class="stepper-btn__next">Suivant</button>
        </div>
        <!-- step 2 -->
        <div class="step-2 hidden">
            <h2 class="inscrivez-ttl__coordinate" id="coordinate">Les coordonnées</h2>
            <ul class="inscrivez-ul inscrivez-ul__second">
                <li class="inscrivez-form__tel">
                    <label class="inscrivez-form__tel-label" for="tel">Numéro de téléphone</label>
                    <input class="inscrivez-form__tel-input" type="tel" name="tel" id="tel" maxlength="15" required />
                </li>
                <li class="inscrivez-form__adresse">
                    <label class="inscrivez-form__adresse-label" for="adresse">L'adresse</label>
                    <input class="inscrivez-form__adresse-input" type="text" name="adresse" id="adresse" required />
                </li>
                <li class="inscrivez-form__city">
                    <label class="inscrivez-form__city-label" for="city" maxlength="50">Ville</label>
                    <input class="inscrivez-form__city-input" type="text" name="city" id="city" required />
                </li>
            </ul>
            <div class="stepper-btn__container">
                <button type="button" class="stepper-btn__prev">Précédent</button>
                <button type="button" class="stepper-btn__next">Suivant</button>
            </div>
        </div>
        <div class="step-3 hidden">
            <h2 class="inscrivez-ttl__account" id="account">Informations du compte</h2>
            <ul class="inscrivez-ul inscrivez-ul__third">
                <li class="inscrivez-form__email">
                    <label class="inscrivez-form__email-label" for="email">Email</label>
                    <input class="inscrivez-form__email-input" type="email" name="email" id="email" required />
                </li>
                <li class="inscrivez-form__password">
                    <label class="inscrivez-form__password-label" for="password">Password</label>
                    <input class="inscrivez-form__password-input" type="password" name="password" id="password" required />
                </li>
                <li class="inscrivez-form__confirm-psw">
                    <label class="inscrivez-form__confirm-psw-label" for="confirm-psw">Confirmiez le Password</label>
                    <input class="inscrivez-form__confirm-psw-input" type="password" name="confirm-psw" id="confirm-psw" required />
                </li>
            </ul>
            <div class="stepper-btn__container">
                <button type="button" class="stepper-btn__prev">Précédent</button>
                <button type="submit" class="stepper-btn__next">Terminer</button>
            </div>
        </div>

    </form>

<!-- error messages -->
    <template id="templateError">
    <p data-error-message="" class="errors__itm">Ici vient le message d'erreur</p>
</template>

<template id="templateMessage">
    <p data-message="" class="messages__itm">Ici vient le message</p>
</template>


</main>

<?php
include 'includes/_footer.php';
?>