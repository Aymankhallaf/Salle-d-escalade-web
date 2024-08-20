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

    getGyms($dbCo);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === 'fetchHoliday' && isset($inputData['idGym'])) {
  
    if (intval($inputData['idGym']) > 5 || intval($inputData['idGym']) < 0) {
        triggerError('idGym', '1');
    }
    getGymDetails($dbCo, intval($inputData['idGym']));
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === 'fetchHours' && isset($inputData['idGym'])) {
    
    if (intval($inputData['idGym']) > 5 || intval($inputData['idGym']) < 0) {
        triggerError('idGym', '1');
    }
    if (!isValidDate($inputData['chosenDate']) || isFieldEmpty($inputData['chosenDate']) || !isFutureDate($inputData['chosenDate'])) {
        triggerError('chosenDate');
    }
    getOpenHours($dbCo,  intval($inputData['idGym']), $inputData['chosenDate']);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === "reserve") {

    isReservationValid($inputData, $_SESSION['idUser']);
    reserve($dbCo, $inputData, intval($_SESSION['idUser']));
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === "getAReservation") {

    getAReservationDetailsUser($dbCo, $inputData['idReservation'], intval($_SESSION['idUser']));
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $inputData['action'] === "cancelReservation") {

    cancelReservation($dbCo, $inputData['idReservation']);
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT' && $inputData['action'] === "editReservation") {
    editReservationDetails($dbCo, $inputData, intval($_SESSION['idUser']));
}
