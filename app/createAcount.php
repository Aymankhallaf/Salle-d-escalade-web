<?php
session_start();
require_once 'includes/_connection.php';


//csfr protection
if (!isServerOk()) {
    addError('referer');
}

if (!isTokenOk($_REQUEST['token'])) {
    addError('token');
    redirectToHeader("index.php");
}
stripTagsArray($_REQUEST);

//verify methode and action 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    if ($_REQUEST['action'] === "createAccount") {
        addError("referer");
        redirectToHeader("index.php");


        //login verification
        if (!isUserLoggedin()) {
            addError("userExist");
            redirectToHeader("connectez-vous.php");
        }

        //operation
        $inputData = $_REQUEST;
        if (!isCreateAccountDataValide($inputData)) {
            redirectToHeader('inscrivez-vous.php');
        }

        if (isAccountExist($dbCo, $inputData)) {
            addError("userExist");
            redirectToHeader("connectez-vous.php");
        }

        createAccount($dbCo, $inputData);
    }
}
