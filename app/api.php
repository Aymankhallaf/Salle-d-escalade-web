<?php
session_start();

require_once 'includes/_connection.php';

// header('Content-type:application/json');
//prenvent visteurs acess to this page
if (!isServerOk()) {
    triggerError('referer');
}
$inputData = json_decode(file_get_contents('php://input'), true);
if (!is_array($inputData)) {
    $inputData = $_REQUEST;
}
stripTagsArray($inputData);
if (!isTokenOk($inputData['token'])) {
    triggerError('token', $_SESSION['token']);
}

//create account
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === "createaccount") {

    isCreateAccountDataValide($inputData);
    createAccount($dbCo, $inputData);
}


//reservation
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === 'fetchGym') {
    getGyms($dbCo);
}
 else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === 'fetchHoliday' && isset($inputData['idGym'])) {
    if ($inputData['idGym'] !== '1' && $inputData['idGym'] !== '2') {
        triggerError('idGym', '1');
    }
    getGymDetails($dbCo, intval($inputData['idGym']));
} 
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === 'fetchHours' && isset($inputData['idGym'])) {
    if ($inputData['idGym'] !== '1' && $inputData['idGym'] !== '2') {
        triggerError('idGym', "2");
    }
    if (!isValidDate($inputData['chosenDate']) || !isFutureDate($inputData['chosenDate'])) {
        triggerError('chosenDate');
    }
    getOpenHours($dbCo,  $inputData['idGym'], $inputData['chosenDate']);
}
 else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === "reserve") {

    isReservationValid($inputData);
    reserve($dbCo, $inputData, 1);
}
