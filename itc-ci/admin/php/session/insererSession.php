<?php
include_once '../configuration/configuration.php';
require_once 'Session.php';
require_once '../placesPrevues/PlacesPrevues.php';
require_once '../reservation/Reservation.php';

$session = new Session();
$pp = new PlacesPrevues();
$reservation = new Reservation();

$selectFormation = (isset($_POST['selectFormationSession']))? htmlentities($_POST['selectFormationSession']):null;
$selectConsultant = (isset($_POST['selectConsultantSession']))? htmlentities($_POST['selectConsultantSession']):null;
$selectTypeSession = (isset($_POST['selectTypeSessionSession']))? htmlentities($_POST['selectTypeSessionSession']):null;
$nbreHeureCache = (isset($_POST['nbreHeureSessionCache']))? htmlentities($_POST['nbreHeureSessionCache']):null;
$prixSession = (isset($_POST['prixSession']))? htmlentities($_POST['prixSession']):null;
$placesPrevue = (isset($_POST['placesPrevueSession']))? htmlentities($_POST['placesPrevueSession']):null;

$message = '';

if(!$selectConsultant || !$selectFormation || !$selectTypeSession || !$nbreHeureCache || !$prixSession || !$placesPrevue){$message = 'erreur';}
else{
    $dn = $session->getSessionByConsultant($db, $selectConsultant);

    if(($dn[0]['idFormation'] === $selectFormation) && ($dn[0]['idTypeSession'] === $selectTypeSession) && ($dn[0]['dureeSession'] === $nbreHeureCache) && ($dn[0]['dateDebut'] === null) && ($dn[0]['dateFin'] === null)){$message = 'Session existante';}
    else{
        $id = $session->saveSession($db, null, $prixSession, null, $nbreHeureCache, $selectFormation, $selectConsultant, $selectTypeSession);
        $pp->savePlacesPrevues($db, $placesPrevue, $id);
        $reservation->saveReservation($db, 0, $id);
        $message = 'ok';
    }
}

echo json_encode(['message' => $message]);