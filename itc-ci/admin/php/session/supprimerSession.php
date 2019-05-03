<?php
include_once '../configuration/configuration.php';
require_once 'Session.php';
require_once '../placesPrevues/PlacesPrevues.php';
require_once '../reservation/Reservation.php';
require_once '../notification/Notification.php';
require_once '../souscripteur/Souscripteur.php';
require_once '../participant/Participant.php';

$session = new Session();
$pp = new PlacesPrevues();
$reservation = new Reservation();
$notif = new Notification();
$sous = new Souscripteur();
$part = new Participant();
$message = '';

$id = (isset($_GET['supSession']))? htmlentities($_GET['supSession']):null;

if($id){
    $notif->removeNotificationThoughSession($db, $id);
    $part->removeParticipantThroughSession($db, $id);
    $sous->removeSouscripteurThroughSession($db, $id);
    $pp->removePlacesPrevuesThroughSession($db, $id);
    $reservation->removeReservationThroughSession($db, $id);
    $session->removeSession($db, $id);
    $message = 'ok';
}
else{$message = 'Suppression impossible';}

echo json_encode(['message' => $message]);