<?php

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
function generateToken()
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
 * @param array|null $data Input data
 * @return boolean Is there a valid toekn in user session ?
 */
function isTokenOk(?array $data = null): bool
{
    if (!is_array($data)) $data = $_REQUEST;

    return isset($_SESSION['token'])
        && isset($data['token'])
        && $_SESSION['token'] === $data['token'];
}

// /**
//  * Check fo referer
//  *
//  * @return boolean Is the current referer valid ?
//  */
// function isServerOk(): bool
// {
//     global $globalUrl;
//     return isset($_SERVER['HTTP_REFERER'])
//         && str_contains($_SERVER['HTTP_REFERER'], $globalUrl);
// }

function getGymName(PDO $dbCo, int $idGym)
{

    $query = $dbCo->prepare("SELECT date_start_vacation FROM vacation WHERE id_gym =:idGym");
    $isQueryOk = $query->execute(['idGym' => $idGym]);
    $dates = $query->fetchAll();
    $vacationDates = [];
    foreach ($dates as $date) {
        array_push($vacationDates, $date["date_start_vacation"]);
    }
    if (!$isQueryOk) {
        var_dump("go");
        exit;
    }
    echo json_encode([
        'isOk' => $isQueryOk,
        'idGym' => $idGym,
        $vacationDates
    ]);
}
