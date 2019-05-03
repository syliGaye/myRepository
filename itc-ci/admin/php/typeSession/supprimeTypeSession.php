<?php
include_once '../configuration/configuration.php';
require_once 'TypeSession.php';
require_once '../session/Session.php';
require_once '../reservation/Reservation.php';
require_once '../placesPrevues/PlacesPrevues.php';
require_once '../participant/Participant.php';
require_once '../souscripteur/Souscripteur.php';
require_once '../notification/Notification.php';

$notif = new Notification();
$typeSession = new TypeSession();
$placesPrevues = new PlacesPrevues();
$session = new Session();
$reserv = new Reservation();
$participant = new Participant();
$souscript = new Souscripteur();


$id = (isset($_GET['supTypeSession'])) ? htmlentities($_GET['supTypeSession']) : NULL ;
$message = '' ;

if($id){
    $dn2 = $session->getSessionByTypeSession($db, $id);

    if(count($dn2) > 0){
        $k = 0;
        foreach($dn2 as $valSession){
            $reserv->removeReservationThroughSession($db, $valSession['id']);
            $placesPrevues->removePlacesPrevuesThroughSession($db, $valSession['id']);
            $notif->removeNotificationThoughSession($db, $valSession['id']);

            if(count($participant->getParticipantBySession($db, $valSession['id'])) > 0){$participant->removeParticipantThroughSession($db, $valSession['id']);}
            
            if(count($souscript->getSouscripteurBySession($db, $valSession['id'])) > 0){$souscript->removeSouscripteurThroughSession($db, $valSession['id']);}

            $session->removeSession($db, $valSession['id']);
            $k++;
        }
    }
    $typeSession->removeTypeSession($db, $id);
    $message = 'ok' ;
}
else{
    $message = 'Suppression impossible';
}

echo json_encode(['message' => $message]) ;