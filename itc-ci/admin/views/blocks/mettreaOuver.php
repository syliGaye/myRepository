<?php
/*include_once '../configuration/configuration.php';
require_once 'Notification.php';

$notif = new Notification();
$message = '';
$donnee = $notif->getAllNotification($db);
$tab = array();
$i = 0;
foreach($donnee as $valeur){
    if($valeur['etatOuverture'] === 'ferme'){
        array_push($tab, $valeur);
    }
    $i++;
}*/

echo json_encode(['data' => 'bien']);