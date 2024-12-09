<?php

require __DIR__ . '/../vendor/autoload.php';
include 'includes/_functions.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

try {
    $dbCo = new PDO(
        'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'] . ';charset=utf8',
        $_ENV['DB_USER'],
        $_ENV['DB_PWD']
    );
    $dbCo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e) {
    //anti brute force
    sleep(1);
    die('Impossible de se connecter à la base de données. ' . $e->getMessage());
}
