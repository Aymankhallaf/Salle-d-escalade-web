<?php
session_start();
require_once 'includes/_connection.php';
// $inputdata =["email"=>"visggter@creative.com", "tel"=>"06695"];

// var_dump(isAccountExist($dbCo,$inputdata));

//csfr protection
if (!isServerOk()) {
    addError('referer');
    redirectToHeader("index.php");
}

if (!isTokenOk($_REQUEST['token'])) {
    addError('token');
    redirectToHeader("index.php");
}
stripTagsArray($_REQUEST);

//verify methode 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //verify action create account
    if ($_REQUEST['action'] === "createAccount") {

        //login verification
        if (isUserLoggedin()) {
            addError("userExist");
            redirectToHeader("connectez-vous.php");
        }

        //operation
        $inputData = $_REQUEST;
        if (!isCreateAccountDataValide($inputData)) {
            redirectToHeader('inscrivez-vous.php');
        }

        if (isAccountExist($dbCo, $inputData)) {
            addError("userExist");
            redirectToHeader("connectez-vous.php");
        }

        createAccount($dbCo, $inputData);
    }


    //verify action delete articles
    elseif ($_REQUEST['action'] === "deleteArticle") {

        //login verification
        if (!isUserLoggedin()) {
            addError("right_ko");
            redirectToHeader("index.php");
        }

        //admin verification
        if (!isAdmin()) {
            addError("right_ko");
            redirectToHeader("index.php");
        }

        //operation
        deleteArticle($dbCo, intval($_REQUEST["idPost"]));
    }
    //verify action edit articles
    elseif ($_REQUEST['action'] === "editArticle") {

        //login verification
        if (!isUserLoggedin()) {
            addError("right_ko");
            redirectToHeader("index.php");
        }

        //admin and editor verification
        if (!isAdmin() || !isEditor()) {
            addError("right_ko");
            redirectToHeader("index.php");
        }
        //verify article
        if (!isArticleExist($dbCo,  $_REQUEST["idPost"])) {
            addError("refer");
            redirectToHeader("index.php");
        }
        if (isFieldEmpty($_REQUEST["title"]) && isMax($_REQUEST["title"], 100)) {
            addError("invalid_title");
        }
        if (isFieldEmpty($_REQUEST["imgUrl"]) && isMax($_REQUEST["imgUrl"], 255)) {
            addError("invalid_urlImg");
        }
        if (isFieldEmpty($_REQUEST["paragraph"])) {
            addError("invalid_paragraph");
        }
        //verify category 
        verifyIdCategory($dbCo, $inputData["idCategory"]);
        //operation
        updateArticle($dbCo, $_REQUEST);
    }

    //verify action create articles
    elseif ($_REQUEST['action'] === "createArticle") {

        //login verification
        if (!isUserLoggedin()) {
            addError("right_ko");
            redirectToHeader("index.php");
        }

        //admin and editor verification
        if (!isAdmin() || !isEditor()) {
            addError("right_ko");
            redirectToHeader("index.php");
        }
        if (isFieldEmpty($_REQUEST["title"]) && isMax($inputData["title"], 100)) {
            addError("invalid_title");
        }
        if (isFieldEmpty($_REQUEST["imgUrl"]) && isMax($inputData["imgUrl"], 255)) {
            addError("invalid_urlImg");
        }
        if (isFieldEmpty($_REQUEST["paragraph"])) {
            addError("invalid_paragraph");
        }
        //verify category 
        verifyIdCategory($dbCo, $_REQUEST["idCategory"]);
        //operation
        createArticle($dbCo, $_REQUEST);
    }
}
