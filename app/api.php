<?php
session_start();

require_once 'includes/_connection.php';



header('Content-type: application/json');

//prenvent visteurs acess to this page && csfr 
if (!isServerOk()) {
    triggerError('referer');
}

$inputData = json_decode(file_get_contents('php://input'), true);
if (!isTokenOk($inputData['token'])) {
    triggerError('token', $_SESSION['token']);
}

if (!isUserLoggedin()) {
    addError("need_login");
    redirectToHeader("connectez-vous.php");
}

if (!is_array($inputData)) {
    $inputData = $_REQUEST;
}
stripTagsArray($inputData);


//reservation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === 'fetchGym') {

    //fetch gym names
    getGyms($dbCo);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === 'fetchHoliday' && isset($inputData['idGym'])) {

    if (intval($inputData['idGym']) > 5 || intval($inputData['idGym']) < 0) {
        triggerError('idGym', '1');
    }
    //fetch gym details
    getGymDetails($dbCo, intval($inputData['idGym']));
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === 'fetchHours' && isset($inputData['idGym'])) {

    if (intval($inputData['idGym']) > 5 || intval($inputData['idGym']) < 0) {
        triggerError('idGym', '2');
    }
    if (!isValidDate($inputData['chosenDate']) || isFieldEmpty($inputData['chosenDate']) || !isFutureDate($inputData['chosenDate'])) {
        triggerError('chosenDate');
    }
    //get open details
    getOpenHours($dbCo,  intval($inputData['idGym']), $inputData['chosenDate']);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === "reserve") {


    isReservationValid($inputData, $_SESSION['idUser']);
    //reserves
    reserve($dbCo, $inputData, intval($_SESSION['idUser']));
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === "getAReservation") {
    if (!isFieldNumber($inputData['idReservation']) || !isFieldNumber($_SESSION['idUser'])) {
        triggerError("invalid_id");
    }
    getAReservationDetailsUser($dbCo, intval($inputData['idReservation']), intval($_SESSION['idUser']));
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $inputData['action'] === "cancelReservation") {
    if (!isFieldNumber($inputData['idReservation'])) {
        triggerError("invalid_id");
    }
   //cancel reservation
    cancelReservation($dbCo, intval($inputData['idReservation']));
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT' && $inputData['action'] === "editReservation") {
    if (!isFieldNumber($_SESSION['idUser'])) {
        triggerError("invalid_id");
    }
    if (!isFieldNumber($inputData['idReservation'])) {
        triggerError("invalid_id");
    }

    isReservationValid($inputData, $_SESSION['idUser']);
   
    //edit reservation
    editReservationDetails($dbCo, $inputData, intval($_SESSION['idUser']));
}
