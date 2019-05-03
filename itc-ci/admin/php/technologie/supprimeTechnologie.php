<?php
include_once '../configuration/configuration.php';
require_once 'Technologie.php';
require_once '../domaine/Domaine.php';
require_once '../formation/Formation.php';
require_once '../session/Session.php';
require_once '../reservation/Reservation.php';
require_once '../placesPrevues/PlacesPrevues.php';
require_once '../competences/Competences.php';
require_once '../participant/Participant.php';
require_once '../souscripteur/Souscripteur.php';
require_once '../notification/Notification.php';

$notif = new Notification();
$domaine = new Domaine();
$techno = new Technologie();
$formation = new Formation();
$placesPrevues = new PlacesPrevues();
$session = new Session();
$reserv = new Reservation();
$competences = new Competences();
$participant = new Participant();
$souscript = new Souscripteur();


$id = (isset($_GET['supTechnologie'])) ? htmlentities($_GET['supTechnologie']) : NULL ;
$message = '' ;

if($id){
    $dn0 = $techno->getTechnologieById($db, $id);

    if(count($dn0 > 0)){
        $dn1 = $formation->getFormationByTechnologie($db, $id);

        if(count($dn1) > 0){
            $j = 0;
            foreach($dn1 as $valForm){
                $dn2 = $session->getSessionByFormation($db, $valForm['id']);

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
                $competences->removeCompetencesThroughFormation($db, $valForm['id']);
                $formation->removeFormation($db, $valForm['id']);
                $j++;
            }
        }
        $techno->removeTechnologie($db, $id);
        $message = 'ok' ;
    }
    else{$message = 'Suppression impossible';}
}
else{$message = 'Suppression impossible';}

echo json_encode(['message' => $message]) ;