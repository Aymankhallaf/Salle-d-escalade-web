<?php
require_once 'includes/_startSession.php';
include 'includes/_header.php';

var_dump($_GET);
$article = isset($_GET['article']);
var_dump(getArticleById($dbCo,$_GET['id']));