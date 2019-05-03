<?php
include_once '../configuration/configuration.php';
require_once 'Session.php';
require_once '../placesPrevues/PlacesPrevues.php';
require_once '../reservation/Reservation.php';

$session = new Session();
$pp = new PlacesPrevues();
$reservation = new Reservation();

$idSession = (isset($_POST['idSessionCache']))? htmlentities($_POST['idSessionCache']):null;
$idPP = (isset($_POST['idPP']))? htmlentities($_POST['idPP']):null;
$selectFormation = (isset($_POST['selectFormationSession']))? htmlentities($_POST['selectFormationSession']):null;
$selectConsultant = (isset($_POST['selectConsultantSession']))? htmlentities($_POST['selectConsultantSession']):null;
$selectTypeSession = (isset($_POST['selectTypeSessionSession']))? htmlentities($_POST['selectTypeSessionSession']):null;
$nbreHeureCache = (isset($_POST['nbreHeureSessionCache']))? htmlentities($_POST['nbreHeureSessionCache']):null;
$prixSession = (isset($_POST['prixSession']))? htmlentities($_POST['prixSession']):null;
$placesPrevue = (isset($_POST['placesPrevueSession']))? htmlentities($_POST['placesPrevueSession']):null;

$message = '';

if(!$selectConsultant || !$selectFormation || !$selectTypeSession || !$nbreHeureCache || !$prixSession || !$placesPrevue || !$idSession || !$idPP){$message = 'erreur';}
else{
    $dn = $session->getSessionById($db, $idSession);

    if(($dn[0]['idConsultant'] === $selectConsultant) && ($dn[0]['idFormation'] === $selectFormation) && ($dn[0]['idTypeSession'] === $selectTypeSession) && ($dn[0]['dureeSession'] === $nbreHeureCache) && ($dn[0]['dateDebut'] === null) && ($dn[0]['dateFin'] === null)){$message = 'Session existante';}
    else{
        $dn0 = $pp->getPlacesPrevuesById($db, $idPP);

        if(($dn[0]['idConsultant'] === $selectConsultant) && ($dn[0]['idFormation'] === $selectFormation) && ($dn[0]['idTypeSession'] === $selectTypeSession) && ($dn[0]['dureeSession'] === $nbreHeureCache) && ($dn[0]['dateDebut'] === null) && ($dn[0]['dateFin'] === null) && ($dn0[0]['nbrePlaces'] === $placesPrevue)){$message = 'Session non modifiee';}
        else{
            $dn1 = $reservation->getReservationBySession($db, $idSession);

            if($dn1[0]['nbreReservation'] > $dn0[0]['nbrePlaces']){$message = 'Augmenter le nombre de Places Prevues';}
            else{
                $pp->mergePlacesPrevues($db, $idPP, $placesPrevue, $idSession);
                $session->mergeSession($db, $idSession, null, $prixSession, null, $nbreHeureCache, $selectFormation, $selectConsultant, $selectTypeSession);
                $message = 'ok';
            }
        }
    }
}

echo json_encode(['message' => $message]);