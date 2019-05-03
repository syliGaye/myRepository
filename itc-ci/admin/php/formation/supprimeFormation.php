<?php
include_once '../configuration/configuration.php';
require_once 'Formation.php';
require_once '../session/Session.php';
require_once '../reservation/Reservation.php';
require_once '../placesPrevues/PlacesPrevues.php';
require_once '../competences/Competences.php';
require_once '../participant/Participant.php';
require_once '../souscripteur/Souscripteur.php';
require_once '../notification/Notification.php';

$notif = new Notification();
$formation = new Formation();
$placesPrevues = new PlacesPrevues();
$session = new Session();
$reserv = new Reservation();
$competences = new Competences();
$participant = new Participant();
$souscript = new Souscripteur();


$id = (isset($_GET['supFormation'])) ? htmlentities($_GET['supFormation']) : NULL ;
$message = '' ;

if($id){
    $dn2 = $session->getSessionByFormation($db, $id);

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
    $competences->removeCompetencesThroughFormation($db, $id);
    $formation->removeFormation($db, $id);
    $message = 'ok' ;
}
else{
    $message = 'Suppression impossible';
}

echo json_encode(['message' => $message]) ;