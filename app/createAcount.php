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

var_dump($_REQUEST);

$inputData = [
    "action" => "createAccount",
    "token" => "91b4fe9574296bca255dd5ac33761bf2",
    "lname" => "gsdfs",
    "fname" => "ggg",
    "birthdate" => "1990-05-09",
    "tel" => "0695820",
    "adresse" => "dsdsfsdf",
    "city" => "fbf",
    'zipCode' => "55455",
    "email" => "qsjjd@gmail.com",
    "password" => "hpjK5V9)Cc=sMQZ",
    "confirmPW" => "hpjK5V9)Cc=sMQZ"
];

if (!isCreateAccountDataValide($inputData)) {

    redirectToHeader('inscrivez-vous.php');
}

if (isAccountExist($dbCo, $inputData)) {
    addError("userExist");
    redirectToHeader("connectez-vous.php");

}


var_dump($_SESSION);
var_dump(isCreateAccountDataValide($inputData));
var_dump(isAccountExist($dbCo, $inputData));
var_dump(createAccount( $dbCo, $inputData));

// createAccount($dbCo, $inputData);
