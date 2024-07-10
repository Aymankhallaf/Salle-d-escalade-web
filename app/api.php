<?php
session_start();

include 'includes/_config.php';
include 'includes/_functions.php';
include 'includes/_database.php';

header('Content-type:application/json');

$inputData = json_decode(file_get_contents('php://input'), true);

var_dump($inputData);