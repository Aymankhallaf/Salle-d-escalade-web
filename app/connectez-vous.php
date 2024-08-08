<?php
require_once 'includes/_header.php';
?>

<?php
echo getHtmlMessages($messages);
echo getHtmlErrors($errors);
?>
<ul id="errorsList" class="error"></ul>
<ul id="messagesList" class="messages"></ul>

<main class="connection">
        <h1 class="connection-ttl" id="connection">Connectez-vous à votre compte</h1>
        <form id="connection-form" class="connection-form" aria-label="formulaire de connexion" method="post">
            <h2 class="connection-form__ttl">Vous êtes déjà client</h2>
            <ul>
                <li class="connection-form__email">
                    <label class="connection-form__email-label" for="email">Votre email</label>
                    <input class="connection-form__email-input" type="email" name="email" id="connection-email" required />
                </li>
                <li class="connection-form__password">
                    <label class="connection-form__password-label" for="password">password</label>
                    <input class="connection-form__password-input" type="password" name="password" id="connection-password" required />
                </li>
            </ul>
            <a href="connection-form__lnk">cliquez ici si vous avez oublié votre mot de passe</a>
            <button id="connexion" type="submit" class="connection-form__password">connexion</button>

        </form>
        <h2 class="connection-form__ttl">Vous n'êtes pas encore client</h2>
        <a href=""> Inscrivez vous</a>

    </main>


<?php
include 'includes/_footer.php';
?>
</body>

</html>