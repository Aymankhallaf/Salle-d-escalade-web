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
    "lname" => "gsdfs",
    "fname" => "ggg",
    "birthdate" => "1990-05-09",
    "tel" => "64460",
    "adresse" => "dsdsfsdf",
    "city" => "fbf",
    'zipCode' => "55455",
    "email" => "dddd@gmail.com",
    "password" => "hpjK5V9)Cc=sMQZ",
    "confirmPW" => "hpjK5V9)Cc=sMQZ"
];

if (!isCreateAccountDataValide($inputData)) {
    
    redirectToHeader('inscrivez-vous.php');
}

var_dump($_SESSION);
var_dump(isCreateAccountDataValide($inputData));
 

// createAccount($dbCo, $inputData);
