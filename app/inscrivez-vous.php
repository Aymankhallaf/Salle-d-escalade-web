<?php
include 'includes/_header.php';
?>

<main>
    <h1 class="inscrivez-header" id="inscrivez">Inscrivez vous</h1>
    <p>Veuillez suivre les étapes pour vous inscrire</p>
    <ol class="stepper">
        <li class="stepper-name"><a aria-labelledby="info-personal" for="info-personal" href="" aria-current="step" class="stepper__stepper-name--current">profile</a>
        </li>
        <li class="stepper-coordinate"></li>
        <li class="stepper-account"></li>

    </ol>
    <form id="inscrivez-form" class="inscrivez-form" aria-label="formulaire de connexion" method="get">
        <h2 class="inscrivez-ttl__info" id="info-personal">Les Informations personnelles</h2>
        <ul class="inscrivez-ul inscrivez-ul__first" >
            <li class="inscrivez-form__lname">
                <label class="inscrivez-form__lname-label" for="lname">Nom</label>
                <input class="inscrivez-form__lname-input" type="text" name="lname" id="lname" maxlength="50" required />
            </li>
            <li class="inscrivez-form__fname">
                <label class="inscrivez-form__fname-label" for="fname">Prénom</label>
                <input class="inscrivez-form__fname-input" type="text" name="fname" maxlength="50" id="fname" required />
                <label class="inscrivez-form__birthdate-label" for="birthdate" maxlength="50">Date de naissance</label>
                <input class="inscrivez-form__birthdate-input" id="birthdate" name="birthdate" type="date" required>

            </li>
        </ul>
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
    </form>



</main>

<?php
include 'includes/_footer.php';
?>