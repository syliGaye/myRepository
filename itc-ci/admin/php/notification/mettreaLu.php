<?php
include_once '../configuration/configuration.php';
require_once 'Notification.php';

$notif = new Notification();
$message = '';
$donnee = $notif->getAllNotification($db);
$tab = array();
$i = 0;
$j = 0;
foreach($donnee as $valeur){
    if($valeur['etatLecture'] === 'non lu'){
        array_push($tab, $valeur);
    }
    $i++;
}

foreach($tab as $valFerme){
    $notif->mergeNotification($db, $valFerme['id'], $valFerme['titre'], $valFerme['contenu'], $valFerme['etatOuverture'], 'lu', $valFerme['idSession']);
    $j++;
}

$message = 'bien';
echo json_encode(['message' => $message,
    'data' => $tab
]);