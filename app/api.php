<?php
session_start();

require_once 'includes/_connection.php';


header('Content-type: application/json');
//prenvent visteurs acess to this page
if (!isServerOk()) {
    triggerError('referer');
}

if (!isUserLoggedin()) {
    addError("need_login");
    redirectToHeader("connectez-vous.php");
}

$inputData = json_decode(file_get_contents('php://input'), true);
if (!is_array($inputData)) {
    $inputData = $_REQUEST;
}
stripTagsArray($inputData);
if (!isTokenOk($inputData['token'])) {
    triggerError('token', $_SESSION['token']);
}

//reservation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === 'fetchGym') {
    getGyms($dbCo);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === 'fetchHoliday' && isset($inputData['idGym'])) {
    if ($inputData['idGym'] !== '1' && $inputData['idGym'] !== '2') {
        triggerError('idGym', '1');
    }
    getGymDetails($dbCo, intval($inputData['idGym']));
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === 'fetchHours' && isset($inputData['idGym'])) {
    if ($inputData['idGym'] !== '1' && $inputData['idGym'] !== '2') {
        triggerError('idGym', "2");
    }
    if (!isValidDate($inputData['chosenDate']) || !isFutureDate($inputData['chosenDate'])) {
        triggerError('chosenDate');
    }
    getOpenHours($dbCo,  $inputData['idGym'], $inputData['chosenDate']);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === "reserve") {

    isReservationValid($inputData);
    reserve($dbCo, $inputData, 1);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === "getAReservation") {
    //to do user authotcation

    getAReservationDetailsUser($dbCo, $inputData['idReservation'], intval($_SESSION['idUser']));
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $inputData['action'] === "cancelReservation") {

    cancelReservation($dbCo, $inputData['idReservation']);
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT' && $inputData['action'] === "editReservation") {
    //to do user authotcation
    editReservationDetails($dbCo, $inputData);
}
