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


 function getGymName(PDO $dbCo, int $idGym){

    $query = $dbCo->prepare("SELECT date_start_vacation FROM vacation WHERE id_gym =:idGym");
    $isQueryOk = $query->execute(['idGym' => $idGym]); 
    $dates = $query->fetchAll();

    if(!$isQueryOk){
        var_dump("go");
        exit;
    }
    echo json_encode([
        'isOk' => $isQueryOk,
        'idGym' => $idGym,
        'dates' => $dates
    ]);   
}