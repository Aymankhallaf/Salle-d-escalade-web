<?php
session_start();
require 'includes/_functions.php';

//csfr protection
if (!isServerOk()) {
    addError('referer');
    redirectToHeader("index.php");
}



logout();