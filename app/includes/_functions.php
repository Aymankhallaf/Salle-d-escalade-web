<?php

use LDAP\Result;

include 'includes/_config.php';
/**
 * Get HTML script to load front-end assets defined in the manifest.json file for entry points given.
 *
 * @param array $entries - A list of JS files to load.
 * @return string
 */
function loadAssets(array $entries): string
{
    if (!file_exists('.vite/manifest.json')) return '';

    $html = '';
    $assets = json_decode(file_get_contents('.vite/manifest.json'), true);

    foreach ($entries as $entry) {
        if (!array_key_exists($entry, $assets)) continue;

        $html .= '<script type="module" src="' . $assets[$entry]['file'] . '"></script>';
        if (isset($assets[$entry]['css']) && is_array($assets[$entry]['css'])) {
            $html .= implode(
                array_map(
                    fn ($file) => '<link rel="stylesheet" href="' . $file . '">',
                    $assets[$entry]['css']
                )
            );
        }
    }

    return $html;
}

/**
 * Generate a unique token and add it to the user session. 
 *
 * @return void
 */
function generateToken(): void
{
    if (
        !isset($_SESSION['token'])
        || !isset($_SESSION['tokenExpire'])
        || $_SESSION['tokenExpire'] < time()
    ) {
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        $_SESSION['tokenExpire'] = time() + 60 * 15;
    }
}

/**
 * Check for CSRF token
 *
 * @param string $token token
 * @return boolean Is there a valid token in user session ?
 */
function isTokenOk(string $token): bool
{
    return isset($_SESSION['token'])
        && isset($token)
        && $_SESSION['token'] === $token;
}


/**
 * Check fo referer
 *
 * @return boolean Is the current referer valid ?
 */
function isServerOk(): bool
{
    global $globalUrl;
    return isset($_SERVER['HTTP_REFERER'])
        && str_contains($_SERVER['HTTP_REFERER'], $globalUrl);
}

/**
 * Print an error in json format and stop script.
 *
 * @param string $error Error code from errors array available in _congig.php
 * @return void
 */
function triggerError(string $error, string $flag = ''): void
{
    global $errors;

    echo json_encode([
        'isOk' => false,
        'errorMessage' => $errors[$error],
        'flag' => $flag
    ]);
    exit;
}


/**
 * Add a new error message to display on next page. 
 *
 * @param string $errorMsg - Error message to display
 * @return void
 */
function addError(string $errorMsg): void
{
    if (!isset($_SESSION['errorsList'])) {
        $_SESSION['errorsList'] = [];
    }
    $_SESSION['errorsList'][] = $errorMsg;
}


/**
 * Add a new message to display on next page. 
 *
 * @param string $message - Message to display
 * @return void
 */
function addMessage(string $message): void
{
    $_SESSION['msg'] = $message;
}


/**
 * Get HTML to display errors available in user SESSION
 *
 * @param array $errorsList - Available errors list
 * @return string HTMl to display errors
 */
function getHtmlErrors(array $errorsList): string
{
    if (!empty($_SESSION['errorsList'])) {
        $errors = $_SESSION['errorsList'];
        unset($_SESSION['errorsList']);
        return '<ul class="notif-error">'
            . implode(array_map(fn ($e) => '<li>' . $errorsList[$e] . '</li>', $errors))
            . '</ul>';
    }
    return '';
}


/**
 * Get HTML to display messages available in user SESSION
 *
 * @param array $messagesList - Available Messages list
 * @return string HTML to display messages
 */
function getHtmlMessages(array $messagesList): string
{
    if (isset($_SESSION['msg'])) {
        $m = $_SESSION['msg'];
        unset($_SESSION['msg']);
        return '<p class="notif-success">' . $messagesList[$m] . '</p>';
    }
    return '';
}
/**
 * Removes tags from given array values;.
 *
 * @param array $data - input values
 */
function stripTagsArray(array &$data): void
{
    $data = array_map('strip_tags', $data);
}


/**
 * redirect to url and 
 *
 * @param string $url the target url
 * @param string $flag a flag to differentiate the error.
 * @return void
 */
function redirectToHeader(string $url): void
{
    // var_dump('REDIRECT ' . $url, $flag);
    header('Location: ' . $url);
    exit;
}


/**
 * gets gyms id and name.
 * @param PDO $dbCo
 * @return void
 */
function getGyms(PDO $dbCo)
{
    $query = $dbCo->prepare("SELECT id_gym,name_gym  FROM gym;");
    $isQueryOk = $query->execute();
    $gym = $query->fetchAll();

    if (!$isQueryOk) {
        triggerError("connection");
    }
    echo json_encode([
        'isOk' => $isQueryOk,
        $gym
    ]);
}




//reservation functions
/**
 * gets the capacity and holidays of a gym.
 *
 * @param PDO $dbCo Database connection.
 * @param int $idGym ID of the gym.
 * @return void
 */
function getGymDetails(PDO $dbCo, int $idGym): void
{
    $queryCapacity = $dbCo->prepare("SELECT capacity FROM gym WHERE id_gym = :idGym;");
    $isQueryOk = $queryCapacity->execute(['idGym' => $idGym]);
    if (!$isQueryOk) {
        triggerError("connection", "capacity");
    }
    $capacity = $queryCapacity->fetchColumn();
    $queryHolidays = $dbCo->prepare("SELECT date_start_vacation FROM vacation WHERE id_gym = :idGym;");
    $isQueryOk2 = $queryHolidays->execute(['idGym' => $idGym]);
    if (!$isQueryOk2) {
        triggerError("connection", "vacation date");
    }

    $dates = $queryHolidays->fetchAll();
    $vacationDates = [];
    foreach ($dates as $date) {
        array_push($vacationDates, $date["date_start_vacation"]);
    }
    echo json_encode([
        'isOk' =>  $isQueryOk2,
        'idGym' => $idGym,
        'capacity' => $capacity,
        'vacationDates' => $vacationDates
    ]);
}



/**
 * Get Max capacity.
 * @param PDO $dbCo database connection.
 * @param int $idGym id gym.
 * @return void
 */
function getMaxcapacity(PDO $dbCo, int $idGym): void
{

    $query = $dbCo->prepare("SELECT capacity FROM gym WHERE id_gym =:idGym;");
    $isQueryOk = $query->execute(['idGym' => $idGym]);

    if (!$isQueryOk) {
        triggerError("connection");
    }
    echo json_encode([
        'isOk' => $isQueryOk,
        'capacity' => $query->fetchColumn()
    ]);
}



/**
 * get the vacation date(holidays). 
 * @param PDO $dbCo database connection.
 * @param int $idGym id gym.
 * @return void
 */
function getHolidays(PDO $dbCo, int $idGym): void
{

    $query = $dbCo->prepare("SELECT date_start_vacation FROM vacation WHERE id_gym =:idGym;");
    $isQueryOk = $query->execute(['idGym' => $idGym]);
    $dates = $query->fetchAll();
    $vacationDates = [];
    foreach ($dates as $date) {
        array_push($vacationDates, $date["date_start_vacation"]);
    }
    if (!$isQueryOk) {
        triggerError("connection");
    }
    echo json_encode([
        'isOk' => $isQueryOk,
        'idGym' => $idGym,
        $vacationDates
    ]);
}

/**
 * 
 * is a valide date ?
 * @param string $date a date in string formate
 * @return bool true if the date in this formate 27-03-2024
 */
function isValidDate(string $date): bool
{
    list($day, $month, $year) =  explode('-', $date);
    return checkdate(intval($month), intval($day), intval($year));
}


/**
 * is this day today or in the future?
 * @param string $date a date of this formate "27-05-2024"
 * @return bool true if it today and day in future, false if yesterday.
 */
function isFutureDate($date): bool
{
    return date_create($date) > new DateTime("yesterday");
}

/**
 * get open and close hours.
 * @param PDO $dbCo - Database connection.
 * @param int $idGym - Gym id.
 * @param string $chosenDate a chosen date.
 * @return void
 */
function getOpenHours(PDO $dbCo, int $idGym, string $chosenDate): void
{
    $query = $dbCo->prepare("SELECT open_hour, close_hour FROM open_days 
    WHERE id_days = :idDay AND id_gym = :idGym;");
    $isQueryOk = $query->execute([
        'idGym' => $idGym,
        'idDay' => date('w', strtotime($chosenDate)),
    ]);

    $openClosehoures = $query->fetchAll();
    if (!$isQueryOk) {
        triggerError("connection");
    }
    echo json_encode([
        'isOk' => $isQueryOk,
        'idGym' => $idGym,
        'chosenDate' => $chosenDate,
        'openClosehoures' => $openClosehoures
    ]);
}



/** to do complete
 * check reservation valid.
 * @param array $inputData
 * @return void
 */
function isReservationValid(array $inputData)
{

    if ($inputData['chosenGym'] !== '1' && $inputData['chosenGym'] !== '2') {
        triggerError('chosenGym');
    }
    if (!isValidDate($inputData['chosenDate']) || !isFutureDate($inputData['chosenDate'])) {
        triggerError('chosenDate');
    }
    //To do verify other params

}


/**
 * reserve function by (inserting reservation request)
 * @param PDO $dbCo database connection.
 * @param array $inputData  array of this data [nb_particpation , date_starting,
 *     , "id_gym" , "id_activity", "date_reservation"]
 * @param int $idUser
 * @return void user id
 */
function reserve(PDO $dbCo, array $inputData, int $idUser)
{
    $dateStarting = DateTime::createFromFormat('d-m-Y H:i', $inputData['chosenDate'] . ' ' . $inputData['chosenHour']);
    $formattedDateStarting = $dateStarting->format('Y-m-d H:i:s');
    $query = $dbCo->prepare("INSERT INTO reservation
      (nb_particpation , date_starting,
       id_user, id_gym , id_activity, date_reservation) 
       VALUES (:nb_particpation, :date_starting ,:idUser,:idGym, :idActivity,CURRENT_TIMESTAMP);");
    $isQueryOk = $query->execute([
        'nb_particpation' => $inputData['participants'],
        'date_starting' => $formattedDateStarting,
        'idGym' => $inputData['chosenGym'],
        'idActivity' => $inputData['duration'],
        'idUser' => $idUser
    ]);

    if (!$isQueryOk) {
        triggerError("connection");
    }
    echo json_encode([
        'isOk' => $isQueryOk,
        'idReservation' => $dbCo->lastInsertId(),
        'nbParticpation' => $inputData['participants'],
        'dateStarting' => $formattedDateStarting,
        'idGym' => $inputData['chosenGym'],
        'idActivity' => $inputData['duration'],
        'idUser' => $idUser,
        'token' => $inputData['token']

    ]);
}


function cancelReservation(PDO $dbCo, int $idReservation)
{
    try {
        $query = $dbCo->prepare("DELETE FROM reservation WHERE id_reservation = :idReservation");
        $isQueryOk = $query->execute(["idReservation" => $idReservation]);

        if (!$isQueryOk) {
            triggerError("connection");
        }

        echo json_encode([
            'isOk' => $isQueryOk
        ]);
    } catch (Exception $e) {
        triggerError("Database error: " . $e->getMessage());
    }
}


/**
 * get user reservation history
 * @param PDO $dbCo
 * @param int $idUser
 * @return void
 */
function getUserReservationHistory(PDO $dbCo, int $idUser)
{

    $query = $dbCo->prepare("SELECT id_reservation, date_starting FROM reservation 
    WHERE id_user=:idUser  ORDER BY `date_starting` ASC;");
    $isQueryOk = $query->execute([

        'idUser' => $idUser
    ]);

    $data = $query->fetchAll();
    if (!$isQueryOk) {
        triggerError("connection");
    }
    echo json_encode([
        'isOk' => $isQueryOk,
        $data,
        'idUSer' => $idUser

    ]);
}

/**
 * get a details of reservation.
 * @param PDO $dbCo database connection.
 * @param int $idUser user id.
 * @param int $idReservation user id.
 * @return void
 */
function getAReservationDetailsUser(
    PDO $dbCo,
    int $idReservation,
    int $idUser
) {
    $query = $dbCo->prepare("SELECT id_reservation,nb_particpation,
     date_starting, duration, name_gym,status,(nb_particpation*price) 
     AS totalPrice FROM reservation JOIN gym USING(id_gym) 
     JOIN activity USING (id_activity) WHERE id_user=:idUser
      AND id_reservation = :idReservation;");
    $isQueryOk = $query->execute([

        'idUser' => $idUser,
        'idReservation' => $idReservation,
    ]);

    $data = $query->fetchAll();
    if (!$isQueryOk) {
        triggerError("connection");
    }
    echo json_encode([
        'isOk' => $isQueryOk,
        $data,
        'idUSer' => $idUser

    ]);
}





function editReservationDetails(
    PDO $dbCo,
    array $inputData,
) {
    $dateStarting = DateTime::createFromFormat('d-m-Y H:i', $inputData['chosenDate'] . ' ' . $inputData['chosenHour']);
    $formattedDateStarting = $dateStarting->format('Y-m-d H:i:s');
    try {
        $query = $dbCo->prepare("UPDATE `reservation` SET
         `nb_particpation` = :nb_particpation, `date_starting` = :date_starting,
          `id_gym` = :idGym, `id_activity` = :idActivity
          WHERE `reservation`.`id_reservation` = :idReservation;");
        $isQueryOk = $query->execute([
            'idReservation' => $inputData['idReservation'],
            'nb_particpation' => $inputData['participants'],
            'date_starting' => $formattedDateStarting,
            'idGym' => $inputData['chosenGym'],
            'idActivity' => $inputData['duration'],
        ]);

        if (!$isQueryOk) {
            triggerError("connection");
        }

        echo json_encode([
            'isOk' => $isQueryOk
        ]);
    } catch (Exception $e) {
        triggerError("Database error: " . $e->getMessage());
    }
}


//create account 


/**
 * is a field is empty?
 * @param string $field fild name
 * @return bool true if itnt empty, flase if it is
 */
function isFieldEmpty($field): bool
{
    if (!isset($field) || strlen($field) === 0) {
        addError('empty');
        return false;
    }
    return false;
}



/**
 * is the field pass the maximum length?
 * @param string $field the field
 * @param int $max a maximum value
 * @return bool true if dost pass the maximum, false if it is
 */
function isMax($field, $max): bool
{
    if (strlen($field) > $max) {
        addError('max');
        return false;
    }
    return true;
}




/**
 * is a name valide?
 * @param string $name field name.
 * @param string $value value of field.
 * @param int $maxLength maximum length.
 * @return bool ture if it is valide or false isn't.
 */
function isNameValide($name, $value, $maxLength): bool
{

    if (isFieldEmpty($value) || !isMax($value, $maxLength)  || !preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ .-]*$/', $value)) {
        addError($name);
        return false;
    }
    return true;
}


/**
 * is date valide?
 * @param string $dateInput a date
 * @param int $maxLength maximum length.
 * @return bool ture if it is valide or false isn't.
 */
function isValideDate($dateInput, $maxLength): bool
{
    $timestamp = strtotime($dateInput);
    if (isFieldEmpty($dateInput) || !isMax($dateInput, $maxLength)  || $timestamp === false) {
        addError("birthDate");
        return false;
    }
    return true;
}

/**
 * is telephone valide?
 * @param string $tel telephone number.
 * @param int $maxLength maxLength.
 * @return bool ture if it is valide or false isn't.
 */
function isValideTel($tel, $maxLength): bool
{
    if (isFieldEmpty($tel) || !isMax($tel, $maxLength) || !preg_match('/[0-9]/', $tel)) {
        addError("tele");
        return false;
    }
    return true;
}



/**
 * is zip code is valide?
 * @param mixed $zipCode zip code / postal code.
 * @return bool ture if it is valide or false isn't.
 */
function isZipCodeValide($zipCode): bool
{
    if (isFieldEmpty($zipCode) || !preg_match('/^\d{5}$/', $zipCode)) {
        addError("zipCode");
        return false;
    }

    return true;
}





/**
 * is email valide?
 * @param string $email email
 * @param int $maxLength maxLength.
 * @return bool ture if it is valide or false isn't.
 */
function isValideMail($email): bool
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        addError("email");
        return false;
    }
    return true;
}

/**
 * is password valide?
 * @param string $pw password.
 * @return bool ture if it is valide or false isn't.
 */
function isValidePw($pw): bool
{
    if (!preg_match('/(?=.*?[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}/', $pw)) {
        addError("newpwd");
        return false;
    }
    return true;
}

/**
 * is password = confirm password?
 * @param string $password password
 * @param string $confirmPassword confirm password
 * @return bool ture if it is valide or false isn't.
 */
function isVerifyconfirmPassword($password, $confirmPassword): bool
{
    if ($password !== $confirmPassword) {
        addError("confirmpwd");
        return false;
    }
    return true;
}


/**
 * is the form is valid?
 * @param array $inputData form data.
 * @return bool ture if it is valide or false isn't.
 */
function isCreateAccountDataValide($inputData): bool
{
    return isNameValide("nom", $inputData['lname'], 50) &&
        isNameValide("prénom", $inputData['lname'], 50) &&
        isValideDate($inputData['birthdate'], 10) &&
        isValideMail($inputData['email']) &&
        isValideTel($inputData['tel'], 15) &&
        isNameValide("ville", $inputData['city'], 50) &&
        isZipCodeValide($inputData['zipCode']) &&
        isMax("adresse", 50) &&
        isValidePw($inputData['password']) &&
        isVerifyconfirmPassword(
            $inputData['password'],
            ($inputData['confirmPW'])
        );
}


/**
 * is account exist ? by checking the exisiting of the email and the telephone.
 * @param PDO $dbCo
 * @param array $inputData
 * @return bool
 */
function isAccountExist(PDO $dbCo, array $inputData)
{
    $query = $dbCo->prepare("SELECT * FROM users 
    WHERE email=:email || telephone= :tel");
    $query->execute([
        'email' => $inputData['email'],
        'tel' => $inputData['tel']
    ]);
    $result = $query->rowCount();
    if ($result != 0) {
        return true;
    }
    return false;
}


function createAccount(PDO $dbCo, array $inputData)
{
    try {
        $dbCo->beginTransaction();

        //  Insert the city if it doesn't exist
        $cityQuery = $dbCo->prepare("INSERT INTO `city` (`name_city`, `zip_code`) 
                                     VALUES (:city,:zipCode)
                                     ON DUPLICATE KEY UPDATE `id_city` = LAST_INSERT_ID(`id_city`);");
        $cityQuery->execute(['city' => $inputData['city'],
         'zipCode' => $inputData['zipCode']]);
        $cityId = $dbCo->lastInsertId();

        // Insert the address with zip_code, linking it to the city
        $addressQuery = $dbCo->prepare("INSERT INTO `adresses` (`name_adresse`, `id_city`)
                                        VALUES (:addresse, :idCity)
                                        ON DUPLICATE KEY UPDATE `id_adresses` = LAST_INSERT_ID(`id_adresses`);");
        $addressQuery->execute([
            'addresse' => $inputData['adresse'],

            'idCity' => $cityId
        ]);
        $addressId = $dbCo->lastInsertId();

        //Insert the user, linking them to the address
        $userQuery = $dbCo->prepare("INSERT INTO `users` (`fname`, `lname`, `birthdate`, `telephone`, `email`, `password`, `id_adresses`) 
                                     VALUES (:fname, :lname, :birthdate, :tel, :email, :password, :idAddresses);");
        $isQueryOk = $userQuery->execute([
            'fname' => $inputData['fname'],
            'lname' => $inputData['lname'],
            'birthdate' => date($inputData['birthdate']),
            'tel' => $inputData['tel'],
            'email' => $inputData['email'],
            'password' => password_hash($inputData['password'], PASSWORD_DEFAULT),
            'idAddresses' => $addressId
        ]);

        // Commit the transaction
        if ($isQueryOk) {
            $dbCo->commit();
            addMessage('createAccount_ok');
            redirectToHeader("index.php");

            // return true;
        } else {
            $dbCo->rollBack();
            addError('createAccount_ko');
            redirectToHeader("connectez-vous.php");

            // return false;
        }
    } catch (Exception $e) {
        $dbCo->rollBack();
        error_log("Error in createAccount: " . $e->getMessage());
        addError('createAccount_ko');
    }
}

function findUser(PDO $dbCo, $inputData){

    $query = $dbCo->prepare("SELECT * FROM users 
    WHERE email=:email;");
    $query->execute([
        'email' => $inputData['email'],
    ]);
    // $result = $query->rowCount();
    // if ($result != 0) {
    //     return true;
    // }
    // return false;

    return $query->fetch(PDO::FETCH_ASSOC);
}
