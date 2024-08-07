<?php
session_start();
require_once 'includes/_connection.php';

// if (!isServerOk()) {
//     triggerError('referer');
// }

// if (!isTokenOk($_REQUEST['token'])) {
//     triggerError('token', $_SESSION['token']);
//     redirectToHeader("index.php");
// }
// stripTagsArray($_REQUEST);

// //create account
// if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

//     triggerError("referer");
//     redirectToHeader("index.php");
// } else if ($_REQUEST['action'] !== "createAccount") {
//     triggerError("referer");
//     redirectToHeader("index.php");
// }

// var_dump($_REQUEST);

$inputData = [
    "action" => "createAccount",
    "token" => "91b4fe9574296bca255dd5ac33761bf2",
    "lname" => "LyonprononcéÉcouter",
    "fname" => "ggg",
    "birthdate" => "1990-05-09",
    "tel" => "04524",
    "adresse" => "dsdsfsdf",
    "city" => "fbf",
    "email" => "dddd@gmail.com",
    "password" => "hpjK5V9)Cc=sMQZ",
    "confirmPW" => "hpjK5V9)Cc=sMQZ"
];

var_dump($_SESSION);
var_dump(isCreateAccountDataValide($inputData));

// if (!isCreateAccountDataValide($inputData)) {

//     redirectToHeader('inscrivez-vous.php');
// }

// createAccount($dbCo, $inputData);
