<?php
session_start();

require_once 'includes/_connection.php';

if (!isServerOk()) {
    triggerError('referer');
}

if (!isTokenOk($_REQUEST['token'])) {
    triggerError('token', $_SESSION['token']);
    redirectToHeader("index.php");
}
stripTagsArray($_REQUEST);

//create account
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    triggerError("referer");
    redirectToHeader("index.php");
} else if ($_REQUEST['action'] !== "createAccount") {
    triggerError("referer");
    redirectToHeader("index.php");
}

var_dump($_REQUEST);
isCreateAccountDataValide($inputData);
createAccount($dbCo, $inputData);
