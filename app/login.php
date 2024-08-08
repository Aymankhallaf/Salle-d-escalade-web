<?php
session_start();
require_once 'includes/_connection.php';

if (!isServerOk()) {
    addError('referer');
    redirectToHeader("index.php");
}

if (!isTokenOk($_REQUEST['token'])) {
    addError('token');
    redirectToHeader("index.php");
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    addError("referer");
    redirectToHeader("index.php");
}
if ($_REQUEST['action'] !== "logIn") {
    addError("referer");
    redirectToHeader("index.php");
}

if (
    !isValideMail($_REQUEST['email']) ||
    !isValidePw($_REQUEST['password'])
) {
    addError("login_error");
    redirectToHeader("connectez-vous.php");
}
login($dbCo, $_REQUEST);
