<?php
include_once '../configuration/configuration.php';
require_once '../souscripteur/Souscripteur.php';
require_once 'Notification.php';
require_once '../session/Session.php';

$souscripteur = new Souscripteur();
$notification = new Notification();
$session = new Session();

$sessionNotif = $_SESSION['notif'];
$donnee = array();
$tab = array();
$tab_1 = array();

if($sessionNotif){
    $donnee = $notification->getNotificationById($db, $sessionNotif);

    foreach($donnee as $valeur){
        $dn1 = $souscripteur->getSouscripteurBySession($db, $valeur['idSession']);
        $dn2 = $session->getSessionById($db, $valeur['idSession']);

        foreach($dn1 as $val1){
            foreach($dn2 as $val2){
                $tab_essai = array(
                    'idNotif' => $valeur['id'],
                    'idSouscripteur' => $val1['id'],
                    'nomSouscripteur' => $val1['nom'],
                    'prenomSouscripteur' => $val1['prenoms'],
                    'contactSous' => $val1['telepnone'],
                    'emailSous' => $val1['email'],
                    'idSession' => $val2['id']
                );
                array_push($tab, $tab_essai);
            }
        }
    }
}

echo json_encode(['data' => $tab]);