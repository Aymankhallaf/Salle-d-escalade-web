<?php
session_start();

include 'includes/_connection.php';

// header('Content-type:application/json');

$inputData = json_decode(file_get_contents('php://input'), true);
stripTagsArray($inputData);
if (!is_array($inputData)) {
    $inputData = $_REQUEST;
}
if (!isTokenOk($inputData['token'])) {
    triggerError('token');
}
if (!isServerOk()) {
    triggerError('referer');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === 'fetchHoliday' && isset($inputData['idGym'])) {
    if ($inputData['idGym'] !== '1' && $inputData['idGym'] !== '2') {
        triggerError('idGym','1');
    }
    getHolidays($dbCo, intval($inputData['idGym']));
} 
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === 'fetchHours' && isset($inputData['idGym'])) {
    if ($inputData['idGym'] !== '1' && $inputData['idGym'] !== '2') {
        triggerError('idGym',"2");
    }
    if (!isValidDate($inputData['chosenDate']) || !isFutureDate($inputData['chosenDate'])) {
        triggerError('chosenDate');
    }
getOpenHours($dbCo,  $inputData['idGym'] , $inputData['chosenDate']);}
