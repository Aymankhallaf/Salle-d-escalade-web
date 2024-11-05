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
                    fn($file) => '<link rel="stylesheet" href="' . $file . '">',
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
            . implode(array_map(fn($e) => '<li>' . $errorsList[$e] . '</li>', $errors))
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
 * 
 * is a valide date default ?
 * @param string $date a date in string formate
 * @return bool true if the date in this formate '2024-08-18'
 */
function isValidDateDeafult(string $date): bool
{
    list($year, $month, $day) =  explode('-', $date);
    return checkdate(intval($month), intval($day), intval($year));
}

/**
 * is this day today or in the future?
 * @param string $date a date of this formate "27-05-2024"
 * @return bool true if it today and a day in future, false if yesterday.
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



/**
 * check reservation valid.
 * @param array $inputData
 * @return void
 */
function isReservationValid(array $inputData, $idUser)
{

    //we could improve this by check if the id gym is exist or not
    if ($inputData['chosenGym'] !== '1' && $inputData['chosenGym'] !== '2') {
        triggerError('chosenGym');
    }
    if (!isValidDate($inputData['chosenDate']) || isFieldEmpty($inputData['chosenDate']) || !isFutureDate($inputData['chosenDate'])) {
        triggerError('chosenDate');
    }
    if (isFieldEmpty($idUser) || !isFieldNumber($idUser) || !is_int($idUser)) {
        triggerError('find_user_ko');
    }
    if (isFieldEmpty($inputData['participants']) || !isFieldNumber($inputData['participants'])) {
        triggerError('participants');
    }

    if (isFieldEmpty($inputData['duration']) || !isFieldNumber($inputData['participants'])) {
        triggerError('chosenActivity');
    }
}


/**
 * Gets a price of activity.
 * @param PDO $dbCo database connection.
 * @param int $idActivity id_activity.
 * @return int price.
 */
function getActivityPrice(PDO $dbCo, int $idActivity): int
{
    $query = $dbCo->prepare("SELECT price FROM `activity` WHERE id_activity = :idActivity;");
    $isQueryOk = $query->execute(["idActivity" => intval($idActivity)]);
    $price = $query->fetchColumn();
    if (!$isQueryOk ||  $price === null) {
        triggerError("chosenActivity");
    }
    return $price;
}


/**
 * Calculates date ending session of reservation
 * 
 * @param int $durationId id duration
 * @param DateTime $dateStarting date starting session of reservation
 * @return string
 */
function calculateDateEndReservation(int $durationId, DateTime  $dateStarting)
{

    $dateEnding = clone $dateStarting;
    //use colne bcs it is date class
    switch ($durationId) {
        case 1:
            $dateEnding->modify("+30 minute");
            break;
        case 2:
            $dateEnding->modify("+1 hours");
            break;
        case 3:
            $dateEnding->modify("+1 day");
            break;
        case 4:
            $dateEnding->modify("+1 month");
            break;
        case 5:
            $dateEnding->modify("+1 year");
            break;
    }
    return $dateEnding->format('Y-m-d H:i:s');
}




/**
 * Reserve function by (inserting reservation request)
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
    $formattedDateEnding = calculateDateEndReservation(intval($inputData['duration']), $dateStarting);

    $price = getActivityPrice($dbCo, $inputData['duration']);
    $query = $dbCo->prepare("INSERT INTO reservation
      (nb_particpation , date_starting, date_ending,
       id_user, id_gym , id_activity, date_reservation,total_price) 
       VALUES (:nb_particpation, :date_starting ,:dateEnding ,:idUser,:idGym, :idActivity,CURRENT_TIMESTAMP, :totalPrice);");
    $isQueryOk = $query->execute([
        'nb_particpation' => intval($inputData['participants']),
        'date_starting' => $formattedDateStarting,
        'dateEnding' => $formattedDateEnding,
        'idGym' => intval($inputData['chosenGym']),
        'idActivity' => intval($inputData['duration']),
        'idUser' => intval($idUser),
        "totalPrice" => intval($inputData['participants']) * $price,
    ]);

    if (!$isQueryOk) {
        triggerError("connection");
    }
    echo json_encode([
        'isOk' => $isQueryOk,
        'idReservation' => $dbCo->lastInsertId(),
        'nbParticpation' => $inputData['participants'],
        'dateStarting' => $formattedDateStarting,
        'date_ending' => $formattedDateEnding,
        'idGym' => $inputData['chosenGym'],
        'idActivity' => $inputData['duration'],
        'idUser' => $idUser,
        'token' => $inputData['token']

    ]);
}

/**
 * Delete a reservation from database.
 * @param PDO $dbCo database connection.
 * @param int $idReservation id reservation.
 * @return void
 */
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
 * Gets user reservation history.
 * @param PDO $dbCo database connection
 * @param int $idUser user id.
 * @return array|null array of reservation or null.
 */
function getUserReservationHistory(PDO $dbCo, int $idUser): array|null
{

    $query = $dbCo->prepare("SELECT id_reservation, date_starting FROM reservation 
    WHERE id_user=:idUser AND  id_activity < 4 ORDER BY `date_starting` ASC;");
    $isQueryOk = $query->execute([

        'idUser' => $idUser
    ]);

    if (!$isQueryOk) {
        addError("connection");
        redirectToHeader("index.php");
    }
    return $query->fetchAll() ?: null;
}

/**
 * Gets user subscription history.
 * @param PDO $dbCo database connection
 * @param int $idUser user id.
 * @return array|null array of reservation or null.
 */
function getUserSubscriptionHistory(PDO $dbCo, int $idUser): array|null
{

    $query = $dbCo->prepare("SELECT id_reservation, date_starting FROM reservation 
    WHERE id_user=:idUser AND  id_activity > 3 ORDER BY `date_starting` ASC;");
    $isQueryOk = $query->execute([

        'idUser' => $idUser
    ]);

    if (!$isQueryOk) {
        addError("connection");
        redirectToHeader("index.php");
    }
    return $query->fetchAll() ?: null;
}




/**
 * Gets details of reservation.
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
    $query = $dbCo->prepare("SELECT id_reservation, id_activity, nb_particpation,
     date_starting, duration, unit_name_fr, name_gym,status,(nb_particpation*price) 
     AS totalPrice FROM reservation JOIN gym USING(id_gym) 
     JOIN activity USING (id_activity) JOIN duration_unit USING(id_duration_unit)WHERE id_user=:idUser
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


/**
 * Adds html tags to array of reservation.
 * @param array $defaultKeys keys of reservation array, like "id_reservation"
 * @param array $reservationHistory a reservationhistory.
 * @return string html tag
 */
function addHtmlReservation(array $defaultKeys, array $reservationHistory)
{
    $date = new DateTime($reservationHistory["date_starting"]);
    $dateStarting = $date->format('Y-m-d-H-i-s');
    $html = '';
    $html .= '<tr class="profile-details-raw">';
    foreach ($reservationHistory as $key => $value) {

        if (isset($defaultKeys[$key])) {
            // $html .= '<td>' . $defaultKeys[$key] . '<td>';
            $html .= '<td>' . $value . '</td>';
        }
    }
    $html .= '<td><a href="panier.php#reservation-details?idReservation=' . $reservationHistory["id_reservation"] . '&token=' . $dateStarting . '&token=' . $_SESSION["token"] . '" >Voir</a></td>';
    $html .= '</tr>';

    return $html;
}


/**
 * Edit reservation.
 * @param PDO $dbCo database connection
 * @param array $inputData reservation data
 * @param int $idUser user id.
 * @return void
 */
function editReservationDetails(
    PDO $dbCo,
    array $inputData,
    int $idUser
) {

    $dateStarting = DateTime::createFromFormat('d-m-Y H:i', $inputData['chosenDate'] . ' ' . $inputData['chosenHour']);
    $formattedDateStarting = $dateStarting->format('Y-m-d H:i:s');
    $formattedDateEnding = calculateDateEndReservation(intval($inputData['duration']), $dateStarting);

    try {
        $query = $dbCo->prepare("UPDATE `reservation` SET
         `nb_particpation` = :nb_particpation,
          `date_starting` = :date_starting,
         `date_ending` = :dateEnding,
          `id_gym` = :idGym, `id_activity` = :idActivity
          WHERE `reservation`.`id_reservation` = :idReservation 
          AND id_user =  :idUser;");
        $isQueryOk = $query->execute([
            'idReservation' => intval($inputData['idReservation']),
            'nb_particpation' => intval($inputData['participants']),
            'date_starting' => $formattedDateStarting,
            'dateEnding' => $formattedDateEnding,
            'idGym' => intval($inputData['chosenGym']),
            'idActivity' => intval($inputData['duration']),
            "idUser" => intval($idUser),
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
 * is a field is empty or equal 0?
 * @param string $field fild name.
 * @return bool true if it isnt empty, flase if it is.
 */
function isFieldEmpty($field): bool
{
    if (!isset($field) || strlen($field) === 0 || empty($field)) {
        addError('empty');
        return true;
    }
    return false;
}


/**
 * is this field numeric?
 * @param string $value a value
 * @return bool true if it is numeric, false if it isnot.
 */
function isFieldNumber($field): bool
{
    if (!is_numeric($field)) {
        addError('numeric');
        return false;
    }
    return true;
}





/**
 * is the field pass the maximum length?
 * @param string $field the field
 * @param int $max a maximum value
 * @return bool true if doesnt pass the maximum, false if it is
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
 * verify time formate to be in this formate ex "10:00"
 * @param string $time
 * @return bool
 */
function verifyTimeFormat($time)
{
    return preg_match('/^\d{2}:\d{2}$/', $time);
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
 * @param int $zipCode zip code / postal code.
 * @return bool ture if it is valide or false isn't.
 */
function isZipCodeValide(int $zipCode): bool
{
    if (isFieldEmpty($zipCode) || !preg_match('/^\d{5}$/', $zipCode)) {
        addError("zipCode");
        return false;
    }

    return true;
}




/**
 * Checks if the mail is valid.
 * @param string $email email
 * @return bool ture if it is valid or false if it isn't.
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
 * Checks if the creation account form is valid.
 * @param array $inputData form data.
 * @return bool true if it is valid or false if it isn't..
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
 * @param PDO $dbCo database connection.
 * @param array $inputData array of form
 * @return bool true if exist, false if not.
 */
function isAccountExist(PDO $dbCo, array $inputData): bool
{
    $query = $dbCo->prepare("SELECT * FROM users 
    WHERE email = :email OR telephone = :tel;");

    $isQueryOk = $query->execute([
        'email' => $inputData['email'],
        'tel' => $inputData['tel']
    ]);

    if (!$isQueryOk) {
        addError("userExist");
        redirectToHeader("index.php");
    }

    return $query->rowCount() > 0;
}







/**
 * Creates new account (by saving it in database).
 * @param PDO $dbCo database connection.
 * @param array $inputData data from creation account form. 
 * @return void
 */
function createAccount(PDO $dbCo, array $inputData)
{
    try {
        $dbCo->beginTransaction();

        //  Insert the city if it doesn't exist
        $cityQuery = $dbCo->prepare("INSERT INTO `city` (`name_city`, `zip_code`) 
                                     VALUES (:city,:zipCode)
                                     ON DUPLICATE KEY UPDATE `id_city` = LAST_INSERT_ID(`id_city`);");
        $cityQuery->execute([
            'city' => $inputData['city'],
            'zipCode' => intval($inputData['zipCode'])
        ]);
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
        $userQuery = $dbCo->prepare(query: "INSERT INTO `users` (`fname`, `lname`, `birthdate`, `telephone`, `email`, `password`, `id_adresses`,`id_role_admin`) 
                                     VALUES (:fname, :lname, :birthdate, :tel, :email, :password, :idAddresses, 0);");
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
        if (!$isQueryOk) {

            $dbCo->rollBack();
            addError('createAccount_ko');
            redirectToHeader("connectez-vous.php");
        }
        $dbCo->commit();
        addMessage('createAccount_ok');
        redirectToHeader("index.php");
    } catch (Exception $e) {
        $dbCo->rollBack();
        addError('createAccount_ko');
        redirectToHeader("index.php");
    }
}


/**
 * *
 * Finds user in db.
 * @param PDO $dbCo db connection.
 * @param array $inputData input data ex. $_REQUEST.
 * @return array|false array of user if find user, false if not.
 */
function findUser(PDO $dbCo, array $inputData): array | false
{

    $query = $dbCo->prepare("SELECT * FROM users 
    WHERE email=:email;");
    $isQueryOk = $query->execute([
        'email' => $inputData['email'],
    ]);
    if (!$isQueryOk) {
        addError("find_user_ko");
        redirectToHeader("index.php");
    }
    return $query->fetch(PDO::FETCH_ASSOC);
}


/**
 * login by matching email and password and set session 
 * params ($_SESSION['email'],$_SESSION['idUser'], $_SESSION['authLevel'])
 * @param PDO $dbCo db connection.
 * @param array $inputData input data ex. $_REQUEST.
 * @return void
 */
function login(PDO $dbCo, array $inputData): void
{
    $user = findUser($dbCo, $inputData);

    if ($user && password_verify($inputData['password'], $user['password'])) {


        $_SESSION['email'] = $user['email'];
        $_SESSION['fname'] = $user['fname'];
        $_SESSION['idUser']  = $user['id_user'];
        $_SESSION['authLevel'] = $user['id_role_admin'];

        addMessage("login_ok");
        redirectToHeader('index.php');
    }
    addError("login_ko");
    redirectToHeader('inscrivez-vous.php');
}



/**
 * is user login?
 * @return bool true if user is login , false if user doesnt.
 */
function isUserLoggedin(): bool
{
    return isset($_SESSION['email']) &&
        isset($_SESSION['idUser']) && isset($_SESSION['authLevel']);
}




/**
 * is user login as editor?
 * @return bool true if user is login , false if user doesnt.
 */
function isEditor(): bool
{
    if (isAdmin()) {
        return true;
    }

    return isUserLoggedin() && ($_SESSION['authLevel'] === 1);
}


/**
 * is user login as admin?
 * @return bool true if user is login , false if user doesnt.
 */
function isAdmin(): bool
{
    return isUserLoggedin() && ($_SESSION['authLevel'] === 2);
}

/**
 * Gets first name of the login user or empty string if he doesnt login.
 * @return null|string first name or empty string.
 */
function currentUser(): null|string
{
    if (!isUserLoggedin()) {
        return null;
    }
    return $_SESSION['fname'];
}

/**
 * Inserts html tages (li + a )connectez-vous, inscrivez-vous
 *  if the user not login if the user logs in  html tages (li + a )
 * déconnection, user firstname + "panel"
 * @return string html tags
 */
function connectionHtml()
{
    if (isUserLoggedin()) {
        return  '<ul>
    <li><a class="header-nav__menu-link" href="/dashboard.php">' . currentUser() . ' panel</a></li>
    <li><a class="header-nav__menu-link" href="/logout.php">déconnection</a></li>
</ul>';
    }
    return '<ul>
    <li><a class="header-nav__menu-link" href="/connectez-vous.php">Connectez-vous</a></li>
    <li><a class="header-nav__menu-link" href="/inscrivez-vous.php">inscrivez-vous</a></li>
</ul>';
}

/**
 * Logsthe user out. by destoy session
 * @return void
 */
function logout(): void
{
    if (isUserLoggedin()) {
        unset(
            $_SESSION['email'],
            $_SESSION['fname'],
            $_SESSION['idUser'],
            $_SESSION['authLevel']
        );
        session_destroy();
        addMessage("logout_ok");
        redirectToHeader('index.php');
    }
}



/**
 * Gets account detailsn first name, last name,
 *  birthdate, telephone, addresse.
 * @param PDO $dbCo database connection.
 * @param int $id user id.
 * @return array user details.
 */
function getsAccountDetails(PDO $dbCo, int $id): ?array
{
    $query = $dbCo->prepare("SELECT lname,fname,birthdate,telephone,
    email,name_adresse,name_city
    FROM users JOIN adresses 
    USING(id_adresses) JOIN city USING(id_city)
    WHERE id_user=:userId;");
    $isQueryOk = $query->execute([
        'userId' => $id
    ]);
    if (!$isQueryOk) {
        addError("connection");
        redirectToHeader("index.php");
    }

    $result = $query->rowCount();
    if ($result != 0) {
        return $query->fetchAll()[0];
    }
    addError("connection");
    redirectToHeader("index.php");
}

/**
 * Adds html tags to array of user.
 * @param array $defaultKeys
 * @param array $accountDetails
 * @return string html tag
 */
function accountAddHtml(array $defaultKeys, array $accountDetails): string
{

    $html = '';
    foreach ($accountDetails as $key => $value) {
        if (isset($defaultKeys[$key])) {
            $html .= '<tr class="profile-details-raw">';
            $html .= '<th>' . $defaultKeys[$key] . ':</th>';
            $html .= '<td>' . $value . '</td>';
            $html .= '</tr>';
        }
    }

    return $html;
}


/**
 * Gets categories list.
 * @param PDO $dbCo database connection.
 * @return array categories list.
 */
function getCategories(PDO $dbCo): array
{

    $query = $dbCo->prepare("SELECT id_category , name , description  FROM category;");
    $isQueryOk = $query->execute();

    if (!$isQueryOk) {
        addError("connection");
        redirectToHeader("index.php");
    }
    return  $query->fetchAll();
}

/**
 * Counts categories list.
 * @param PDO $dbCo database connection.
 * @return int categories number.
 */
function countCategories(PDO $dbCo): int
{

    $query = $dbCo->prepare("SELECT COUNT(id_category) FROM category;");
    $isQueryOk = $query->execute();

    if (!$isQueryOk) {
        addError("connection");
        redirectToHeader("index.php");
    }
    return  $query->fetchColumn();
}





/**
 * Gets categories list.
 * @param PDO $dbCo database connection.
 * @return string
 */
function getCategoryById(PDO $dbCo, int $idCategory): string
{

    $query = $dbCo->prepare("SELECT name FROM category WHERE id_category=:idCategory;");
    $isQueryOk = $query->execute(["idCategory" => $idCategory]);

    if (!$isQueryOk) {
        addError("connection");
        redirectToHeader("index.php");
    }
    return  $query->fetchColumn();
}



function addOptionHtmlCategory(array $category, int $currentCategory)
{
    if ($category["id_category"] === $currentCategory) {
        return '<option  value="' . $category["id_category"] . '" required selected>' . $category["name"] . '</option>';
    }
    return '<option class="" value="' . $category["id_category"] . '" required>' . $category["name"] . '</option>';
}




/**
 * Gets articles by categories.
 * @param PDO $dbCo database connection
 * @param int $idCategory  id category.
 * @param int $articlesPerPage  number article per page.
 * @param int $pageNumber page number(represent offset in sql statement)
 * @return array article lists
 */
function getArticlsByCategory(PDO $dbCo, int $idCategory, int $articlesPerPage, int $pageNumber): array
{

    $offset = ($pageNumber - 1) * $articlesPerPage;

    $sqlStatement = "SELECT * FROM `post`
                 WHERE id_category = :idCategory
                 ORDER BY `post`.`date_post` DESC 
                 LIMIT " . intval(htmlspecialchars($articlesPerPage))
        . " OFFSET " . intval(htmlspecialchars($offset));
    $query = $dbCo->prepare($sqlStatement);
    $isQueryOk = $query->execute([
        "idCategory" => intval(htmlspecialchars($idCategory)),
    ]);

    if (!$isQueryOk) {
        addError("connection");
        redirectToHeader("index.php");
    }
    return  $query->fetchAll();
}


function verifyIdCategory(PDO $dbCo, int $idCategory)
{

    if ($idCategory < 0 || $idCategory > countCategories($dbCo)) {

        addError("referer");
        redirectToHeader("index.php");
    }
}


/**
 * 
 * add html tag to article title
 * @param array $article article array has title, href_img, id_post
 * @return string sting "html"
 */
function addHtlmArticleTtl(array $article): string
{

    return '<li class="artcl-item">
    <img class="artcl-item__img" src="' . $article["href_img"] . '" alt="' . htmlspecialchars($article["title"]) . '">
    <h3 class="artcl-item__ttle">' . htmlspecialchars($article["title"]) . '</h3>
    <a target="_blank" href="page.php?article=' . getFirstNWords($article["title"], 3) . '&id=' . $article["id_post"] . '" class="link artcl-item__link">Lire Plus</a>
</li>';
}

/**
 * Counts number of pages for category 
 * by defining number article per page.
 * @param PDO $dbCo database connection.
 * @param int $idCategory id category.
 * @param int $articlesPerPage number article per page.
 * @return int pages number
 */
function countPages(PDO $dbCo, int $idCategory, int $articlesPerPage): int
{
    $query = $dbCo->prepare("SELECT COUNT(id_post) FROM `post` WHERE id_category = :idCategory");
    $query->execute(['idCategory' => intval(htmlspecialchars($idCategory))]);
    $totalArticles = $query->fetchColumn();

    return ceil($totalArticles / intval(htmlspecialchars($articlesPerPage)));
}


/**
 * echo pages number
 * @param int $countPages total number of pages
 * @param int $currentPageNumber current page number
 * @return void
 */
function echoPagesNumbers(int $countPages, int $currentPageNumber, $idCategory)
{
    for ($i = 1; $i <  $countPages; $i++) {
        $active = ($i == $currentPageNumber) ? '--active' : '';
        echo '<li><a href="?id=' . $idCategory . '&page=' . $i . '" class="pages-number-a' . $active . '">' . $i . '</a></li>';
    }
}



/**
 * Gets the first number of words and seprated them by-
 * @param string $sentence a sentense
 * @param int $wordsNumber words number.
 * @return string a string of first number of words seperated by -
 */
function getFirstNWords(string $sentence, int $wordsNumber): string
{
    $words = explode(' ', $sentence);
    if (count($words) < $wordsNumber) {
        $wordsNumber = count($words);
    }
    $firstThree = array_slice($words, 0, $wordsNumber);
    $result = implode('-', $firstThree);

    return $result;
}

/** 
 * is Article Exist?
 * @param PDO $dbCo data base connection.
 * @param int $idPost id post
 * @return bool true if yes, false if no
 */
function isArticleExist(PDO $dbCo, int $idPost): bool
{
    if ($idPost < 0) {
        return false;
    }
    $query = $dbCo->prepare("SELECT id_post FROM `post`
    WHERE id_post=:idPost;");
    $isQueryOk = $query->execute(["idPost" => $idPost]);
    if (!$isQueryOk) {
        addError("article_not_found");
        redirectToHeader("index.php");
    }
    return $query->rowCount() > 0;
}


/**
 * Gets article by id.
 * @param PDO $dbCo database connection.
 * @param int $idPost id post.
 * @return array array of article.
 */
function getArticleById(PDO $dbCo, int $idPost): array
{

    $query = $dbCo->prepare("SELECT * FROM `post`
     WHERE id_post=:idPost;");
    $isQueryOk = $query->execute(["idPost" => $idPost]);
    if (!$isQueryOk) {
        addError("article_not_found");
        redirectToHeader("index.php");
    }
    return $query->fetchAll()[0];
}


/**
 * Deletes article.
 * @param PDO $dbCo database connection.
 * @param int $idPost id post.
 * @return void
 */
function deleteArticle(PDO $dbCo, int $idPost): void
{


    $query = $dbCo->prepare("DELETE FROM `post`
     WHERE id_post=:idPost;");
    $isQueryOk = $query->execute(["idPost" => $idPost]);
    if (!$isQueryOk) {
        addError("connection");
        redirectToHeader("index.php");
    }
    addMessage("delete_ok");
    redirectToHeader("index.php");
}


/**
 * update aricle
 * @param PDO $dbCo database connection
 * @param array $inputData article array
 * @return void
 */
function updateArticle(PDO $dbCo, array $inputData): void
{
    $query = $dbCo->prepare("UPDATE post SET 
        title = :title, 
        href_img = :imgUrl,
        paragraph = :paragraph,
        id_category = :idCategory, 
        id_user = :idUser,
        date_post = :datePost
        WHERE post.id_post = :idPost");

    $isQueryOk = $query->execute([
        "idPost" => intval($inputData["idPost"]),
        "title" => $inputData["title"],
        "imgUrl" => $inputData["imgUrl"],
        "paragraph" => $inputData["paragraph"],
        "idCategory" => $inputData["idCategory"],
        "idUser" => intval($inputData["idUser"]),
        "datePost" => date("Y-m-d H:i:s")
    ]);


    if ($isQueryOk) {
        addMessage("updateArticle_ok");
    } else {
        addError("updateArticle_ko");
    }

    redirectToHeader('page.php?article=' . getFirstNWords($inputData["title"], 3) . '&id=' . $inputData["idPost"]);
}



/**
 * Create a new article
 * @param PDO $dbCo database connection
 * @param array $inputData article data
 * @return void
 */
function createArticle(PDO $dbCo, array $inputData): void
{
    $query = $dbCo->prepare("INSERT INTO post 
        (title, href_img, paragraph, id_category, id_user, date_post) 
        VALUES 
        (:title, :imgUrl, :paragraph, :idCategory, :idUser, :datePost)");

    $isQueryOk = $query->execute([
        "title" => $inputData["title"],
        "imgUrl" => $inputData["imgUrl"],
        "paragraph" => $inputData["paragraph"],
        "idCategory" => $inputData["idCategory"],
        "idUser" => intval($inputData["idUser"]),
        "datePost" => date("Y-m-d H:i:s")
    ]);

    if (!$isQueryOk) {
        addError("insertArticle_ko");
        redirectToHeader('dashboard.php#articles.php');
    }
    addMessage("insertArticle_ok");
    $lastInsertId = $dbCo->lastInsertId();
    redirectToHeader('page.php?article=' . getFirstNWords($inputData["title"], 3) . '&id=' . $lastInsertId);
}

//reservation dashboard admin

/**
 * Gets total paid and total paricpations ib certain period. 
 * @param PDO $dbCo database connection
 * @param string $dateStart starting date.
 * @param string $dateEnd end date
 * @return void
 */
function getPaidStatics(PDO $dbCo, string $dateStart, string $dateEnd)
{
    $query = $dbCo->prepare('SELECT SUM(total_price) AS t_Price, SUM( nb_particpation) AS 
    particpation FROM reservation
     WHERE status = "paid" AND 
     date_starting BETWEEN :dateStart AND :dateEnd;');
    $isQueryOk = $query->execute([
        "dateStart" => $dateStart,
        "dateEnd" => $dateEnd
    ]);
    if (!$isQueryOk) {
        addError("chosenDate");
        redirectToHeader('index.php');
    }

    $_SESSION["paidStatics"] = $query->fetchAll();
    redirectToHeader("dashboardAdmin.php");
}

function getTunPaidPAndParticpantsBetweenDates(PDO $dbCo, string $dateStart, string $dateEnd)
{
    $query = $dbCo->prepare('SELECT SUM(total_price) AS t_Price, SUM( nb_particpation) AS 
    particpation FROM reservation
     WHERE status = "unpaid" AND 
     date_starting BETWEEN :dateStart AND :dateEnd;');
    $isQueryOk = $query->execute([
        "dateStart" => $dateStart,
        "dateEnd" => $dateEnd
    ]);
    if (!$isQueryOk) {
        addError("chosenDate");
    }
    return $query->fetchAll();
}

// to see how many player play at cetain time for 30 min. (10:30 - 11:00)
// 1-callculate the number of particpiants at the chosen time (10:30) 30 min session + 1h session
// 2-calculate the number of particpiants at the session 1 h before this time(10:00)

function nbParticpationsthirtyMin(PDO $dbCo, string $dateStart, string $dateEnd)
{
    $query = $dbCo->prepare('SELECT SUM(total_price) AS t_Price, SUM( nb_particpation) AS 
    particpation FROM reservation
     WHERE status = "unpaid" AND 
     date_starting BETWEEN :dateStart AND :dateEnd;');
    $isQueryOk = $query->execute([
        "dateStart" => $dateStart,
        "dateEnd" => $dateEnd
    ]);
    if (!$isQueryOk) {
        addError("chosenDate");
    }
    return $query->fetchAll();
}



// to see how many player play at cetain time for 1h. (10:30 - 11:30)
// 1-callculate the number of particpiants at the chosen time (10:30) 30 min session + 1h session
// 2-calculate the number of particpiants at the session 1 h before this time(10:00 - 11:00)
// 2-calculate the number of particpiants at the session 30 min after this time(11:00 - 11:30)  


// 1-callculate the number of particpiants at the chosen time (10:30) 30 min session + 1h session
// SELECT SUM(nb_particpation) AS total_participation
// FROM reservation
// JOIN activity USING (id_activity) JOIN duration_unit USING (id_duration_unit)
// WHERE 
//     (date_starting < '2024-08-30 15:30:00' AND date_ending > '2024-08-30 15:00:00')
//     AND (unit_name = 'i' OR unit_name = 'h');


// UPDATE reservation
// SET date_ending = DATE_ADD(date_starting, INTERVAL 1 YEAR)
// WHERE id_activity = 5;