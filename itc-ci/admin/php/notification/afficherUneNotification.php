<?php
include_once '../configuration/configuration.php';

$id = (isset($_GET['idNotif'])) ? htmlentities($_GET['idNotif']): null;
$id_1 = (isset($_GET['idUneNotif'])) ? htmlentities($_GET['idUneNotif']): null;
$blabla = (isset($_GET['dataRetour'])) ? htmlentities($_GET['dataRetour']): null;
$titre_1 = (isset($_GET['continue1'])) ? htmlentities($_GET['continue1']): null;
$titre_2 = (isset($_GET['continue2'])) ? htmlentities($_GET['continue2']): null;


//$id_1 = 1;

$leId = 0;
$message = '';
$table = array();

if($id){
    $_SESSION['notif'] = $id;
    $leId = $_SESSION['notif'];
}
elseif($id_1){
    require_once 'Notification.php';

    $notif = new Notification();
    $donnee = $notif->getNotificationById($db, $id_1);

    foreach($donnee as $valeur){
        $tab = array('id' => $id_1,
            'titre' => $valeur['titre'],
            'corps' => $valeur['contenu'],
            'ouverture' => $valeur['etatOuverture'],
            'lecture' => $valeur['etatLecture'],
            'session' => $valeur['idSession']
        );

        array_push($table, $tab);
        //$notif->mergeNotification($db, $id_1, $valeur['titre'], $valeur['contenu'], $valeur['etatOuverture'], 'lu', $valeur['idSession']);
        $message = 'ok';
    }
}
elseif($blabla){
    $_SESSION['notif'] = null;
    $message = 'annuler';
}
elseif($titre_1){
    require_once 'Notification.php';

    $notif = new Notification();
    $donnee = $notif->getNotificationById($db, $_SESSION['notif']);

    foreach($donnee as $valeur){
        $notif->mergeNotification($db, $id_1, $valeur['titre'], $valeur['contenu'], $valeur['etatOuverture'], 'lu', $valeur['idSession']);
    }

    $_SESSION['notif'] = null;
    $message = 'continuer';
}
elseif($titre_2){}

echo json_encode(['leId' => $leId,
    'message' => $message,
    'data' => $table
]);