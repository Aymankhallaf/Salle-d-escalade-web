<?php
require_once 'includes/_header.php';
?>
<main class="signup">
    <h1 class="signup-header" id="signup">Inscrivez vous</h1>
    <p class="signup-sub-header">Veuillez suivre les trois étapes pour vous inscrire</p>
    <ol class="stepper" role="tablist">
        <li id="stepper-profile" class="stepper-profile" role="tab" aria-selected="true" aria-current="step">
            <img class="stepper-profile-img" id="stepper-profile-img" src="./img/name-current-icon.svg" alt="photo pour l'etape les informations personnelles">
            <a aria-labelledby="info-personal" for="info-personal" href="#info-personal" class="stepper-profile-a">les personal informations.</a>
        </li>
        <li id="stepper-coordinate" class="stepper-coordinate" role="tab" aria-selected="false">
            <img class="stepper-coordinate-img" id="stepper-coordinate-img" src="./img/adresse.svg" alt="photo pour l'etape les coordonnées">
            <a class="stepper-coordinate-a" aria-labelledby="coordinate" for="coordinate" href="#coordinate" aria-selected="false" aria-current="false" class="stepper-coordinate-a">Les coordonnées.</a>
        </li>
        <li id="stepper-account" class="stepper-account" role="tab" aria-current="false" aria-selected="false">
            <img class="stepper-account-img" id="stepper-account-img" src="./img/mail.svg" alt="photo pour l'etape Infomation du compte">
            <a aria-labelledby="account" for="account" href="#account" class="stepper-account-a">Infomation du compte</a>
        </li>

    </ol>
    <?php

    echo getHtmlMessages($messages);

    echo getHtmlErrors($errors);

    ?>
    <ul id="errorsList" class="error"></ul>
    <ul id="messagesList" class="messages"></ul>
    <form id="signup-form" class="signup-form" aria-label="formulaire d'inscription" method="POST" action="createAcount.php" novalidate>
        <input type="hidden" id="token" name="token" value="<?= $_SESSION['token'] ?>">
        <input type="hidden" name="action" value="createAccount">
        <!-- step 1 -->
        </li>
        <li class="signup-form__city">
            <label class="signup-form__city-label" for="city" maxlength="50">Ville</label>
            <input pattern="[a-zA-ZÀ-ÖØ-öø-ÿ \-]{3,50}" class="signup-form__city-input" type="text" name="city" id="city" required />
        </li>
        </ul>
        <div class="stepper-btn__container">
            <button id="step-btn-prev-1" type="button" class="stepper-btn__prev">Précédent</button>
            <button id="step-btn-2" type="button" class="stepper-btn__next">Suivant</button>
        </div>
        </div>
        <!-- step 3 -->
        <div data-step="3" class="step-3 hidden">
            <h2 class="signup-ttl__account" id="account">Informations du compte</h2>
            <ul class="signup-ul signup-ul__third">
                <li class="signup-form__email">
                    <label class="signup-form__email-label" for="email">Email</label>
                    <input pattern="[^\s@]+@[^\s@]+\.[^\s@]+" class="signup-form__email-input" type="email" name="email" id="email" required />
                </li>
                <li class="signup-form__password">
                    <label class="signup-form__password-label" for="password">Password</label>
                    <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="signup-form__password-input" type="password" name="password" id="password" required />
                </li>
                <li class="signup-form__confirm-psw">
                    <label class="signup-form__confirm-psw-label" for="confirmPW">Confirmiez le Password</label>
                    <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="signup-form__confirm-psw-input" type="password" name="confirmPW" id="confirm-psw" required />
                </li>
            </ul>
            <div class="stepper-btn__container">
                <button id="step-btn-prev-2" type="button" class="stepper-btn__prev">Précédent</button>
                <button id="finish" type="submit" class="stepper-btn__next">Terminer</button>
            </div>
        </div>

    </form>

    <!-- error messages -->
    <template id="templateError">
        <li data-error-message="" class="errors__itm">Ici vient le message d'erreur</li>
    </template>

    <template id="templateMessage">
        <li data-message="" class="messages__itm">Ici vient le message</li>
    </template>

    <script type="module" src="./js/createAccount.js"></script>

</main>

<?php
include 'includes/_footer.php';
?>
</body>

</html>