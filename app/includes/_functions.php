<?php
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
 * Removes tags from given array values;.
 *
 * @param array $data - input values
 */
function stripTagsArray(array &$data): void
{
    $data = array_map('strip_tags', $data);
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



function isReservationValid(array $inputData)
{

    if ($inputData['chosenGym'] !== '1' && $inputData['chosenGym'] !== '2') {
        triggerError('chosenGym', "2");
    }
    if (!isValidDate($inputData['chosenDate']) || !isFutureDate($inputData['chosenDate'])) {
        triggerError('chosenDate');
    }
    //To do verify other params

}

function reserve(PDO $dbCo, array $inputData, int $idUser)
{
    $query = $dbCo->prepare("INSERT INTO reservation
      (nb_particpation , date_starting,
       id_user, id_gym , id_activity, date_reservation) 
       VALUES (:nb_particpation, :date_starting ,:idUser,:idGym, :idActivity,CURRENT_TIMESTAMP);");
    $isQueryOk = $query->execute([
        'nb_particpation' => $inputData['participants'],
        'date_starting' => date('Y-m-d h:i:s',strtotime($inputData['chosenDate'].$inputData['chosenHour'])),
        'idGym' => $inputData['chosenGym'],
        'idActivity' => $inputData['duration'],
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
