<?php
session_start();

require_once 'includes/_connection.php';

// header('Content-type: application/json');
//prenvent visteurs acess to this page
if (!isServerOk()) {
    triggerError('referer');
}

var_dump($_REQUEST);

// stripTagsArray($inputData);

// if (!isTokenOk($inputData['token'])) {
//     triggerError('token', $_SESSION['token']);
// }

// //create account
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === "createaccount") {

//     isCreateAccountDataValide($inputData);
//     createAccount($dbCo, $inputData);
// }
