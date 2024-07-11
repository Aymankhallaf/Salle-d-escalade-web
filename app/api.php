<?php
session_start();

include 'includes/_connection.php';

header('Content-type:application/json');

$inputData = json_decode(file_get_contents('php://input'), true);
if (!is_array($inputData)) {
    $inputData = $_REQUEST;
}
if (!isTokenOk($inputData['token'])) {
    triggerError('token');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $inputData['action'] === 'fetch' && isset($inputData['idGym'])) {
    if ($inputData['idGym'] !== '1' && $inputData['idGym'] !== '2') {
        var_dump('error');
        exit;
    }
    getHolidays($dbCo, intval($inputData['idGym']));
}
