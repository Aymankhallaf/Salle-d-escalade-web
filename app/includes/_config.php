<?php
$globalUrl = 'http://localhost:8080';
$errors = [
    'token' => 'Votre session est invalide.',
    'inputData' => "aucune donnée n'a été demandée",
    'referer' => "erreur d'accès à la page",
    'idGym' => "erreur lors du choix de la salle d'escalade",
    'connection' => "erreur de connexion à la base de données",
    'chosenDate' => 'erreur lors du choix le date',
    'chosenActivity' => "erreur lors du choix l'activity",
    'nom' => "Le nom est invalide.",
    'prénom' => "Le prénom est invalide.",
    'ville' => "Le ville est invalide.",
    'birthDate' => "Le date de naissance est invalide.",
    'tele' => "Le numéro de téléphone est invalide.",
    "email" => "Le email est invalide.",
    "newpwd" => "Le mot de passe est invalide. Il doit contenir au moins une lettre minuscule,
     une lettre majuscule et un chiffre.",
    "confirmpwd" => "Les mots de passe ne correspondent pas.",
    "userExist" => "l'utilisateur est déjà enregistré, veuillez vous connecter",
    'empty' => 'Un des champs est vide',
    'numeric' => "n'est pas une valeur numérique",
    'max' => 'la valeur est trop longue',
    'zipCode' => 'le postal code est invalide',
    "createAccount_ko" => "création de compte échouée.",
    'login_error' => "Votre email ou votre mot de passe sont incorrects.",
    "login_ko" => "Votre email ou votre mot de passe sont incorrects ou
      créez un compte si vous n'en avez pas",
    "need_login" => "Vous devez vous connecter pour accéder à la page",
    "right_ko" => "Vous n'avez pas le droit de faire cette action",
    "updateArticle_Ko" => "Error mettre à jour l'article",
    "invalid_title" => "Titre invalide",
    "invalid_urlImg" => "URL Image invalide",
    "invalid_paragraph" => "Paragraph invalide",
    "insertArticle_ko" => "Erreur de création d'un article",
    "invalid_id" => "id invalide",
    "article_not_found" => "l'article n'ai pas été trouvé",
    "find_user_ko" => "Error de utilisateur"
];
$messages = [
    "createAccount_ok" => "Vous avez réussi à créer un compte",
    'logout_ok' => "Déconnexion réussie",
    "login_ok" => "Connexion réussie",
    "delete_ok" => "l'élément a été supprimé avec succès",
    "updateArticle_ok" => "Vous avez réussi à mettre à jour l'article",
    "insertArticle_ok" => "Votre article a été publié."
];

$defaultKeys = [
    'lname' => 'Nom',
    'fname' => 'Prénom',
    'birthdate' => 'Date de naissance',
    'telephone' => 'Téléphone',
    'email' => 'Email',
    'name_adresse' => 'Adresse',
    'name_city' => 'Ville',
    'id_reservation' => 'Numéro de réservation',
    'date_starting' => 'Session Date'

];
