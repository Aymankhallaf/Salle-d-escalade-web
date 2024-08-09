<?php
$globalUrl = 'http://localhost:8080';
$errors = [
    'token' => 'Votre session est invalide.',
    'inputData' => "aucune donnée n'a été demandée",
    'referer' => "erreur d'accès à la page",
    'idGym' => "erreur lors du choix de la salle d'escalade",
    'connection' => "erreur de connexion à la base de données",
    'chosenDate' => 'erreur lors du choix le date',
    'nom' => "Le nom est invalide.",
    'prénom' => "Le prénom est invalide.",
    'ville' => "Le ville est invalide.",
    'birthDate' => "Le date de naissance est invalide.",
    'tele' => "Le numéro de téléphone est invalide.",
    "email"=>"Le email est invalide.",
    "newpwd"=>"Le mot de passe est invalide. Il doit contenir au moins une lettre minuscule,
     une lettre majuscule et un chiffre.",
     "confirmpwd"=>"Les mots de passe ne correspondent pas.",
     "userExist"=> "l'utilisateur est déjà enregistré, veuillez vous connecter",
     'empty'=> 'Un des champs est vide',
     'max'=> 'la valeur est trop longue',
     'zipCode'=> 'le postal code est invalide',
     "createAccount_ko" => "création de compte échouée.",
     'login_error'=> "Votre email ou votre mot de passe sont incorrects.",
     "login_ko" => "Votre email ou votre mot de passe sont incorrects ou
      créez un compte si vous n'en avez pas",
      "need_login" => "Vous devez vous connecter pour accéder à la page"
     

];
$messages = [
    "createAccount_ok" => "Vous avez réussi à créer un compte",
    'logout_ok' => "Déconnexion réussie",
    "login_ok" => "Connexion réussie"
];

$defaultKeys = [
    'lname' => 'nom',
    'fname' => 'prenom',
    'birthdate' => 'date de naissance',
    'telephone' => 'téléphone',
    'email' => 'email',
    'name_adresse' => 'adresse',
    'name_city' => 'ville'

];