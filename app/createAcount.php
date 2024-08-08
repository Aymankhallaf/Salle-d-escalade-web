<?php
session_start();
require_once 'includes/_connection.php';

if (!isServerOk()) {
    addError('referer');
}

if (!isTokenOk($_REQUEST['token'])) {
    addError('token');
    redirectToHeader("index.php");
}
stripTagsArray($_REQUEST);

//create account
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    addError("referer");
    redirectToHeader("index.php");
} 
if ($_REQUEST['action'] !== "createAccount") {
    addError("referer");
    redirectToHeader("index.php");
}


$inputData = $_REQUEST;
if (!isCreateAccountDataValide($inputData)) {
    redirectToHeader('inscrivez-vous.php');
}

if (isAccountExist($dbCo, $inputData)) {
    addError("userExist");
    redirectToHeader("connectez-vous.php");
}

createAccount($dbCo, $inputData);
