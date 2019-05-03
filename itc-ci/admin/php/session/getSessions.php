<?php
include_once '../configuration/configuration.php';
require_once 'Session.php';
require_once '../typeSession/TypeSession.php';
require_once '../formation/Formation.php';
require_once '../technologie/Technologie.php';
require_once '../placesPrevues/PlacesPrevues.php';
require_once '../reservation/Reservation.php';
require_once '../participant/Participant.php';
require_once '../consultant/Consultant.php';

$consultant = new Consultant();
$partic = new Participant();
$session = new Session();
$placesPrevues = new PlacesPrevues();
$formation = new Formation();
$typeSession = new TypeSession();
$reservation = new Reservation();
$techno = new Technologie();
$message = '';

$donnee = $session->getAllSessions($db);

$tab2 = array();

$placesPrev = 0;
$placesRestantes = 0;
$placesReserv = 0;
$nbreParticipant = 0;
$heureFin = '';
$i = 0;

$donnee = $session->getAllSessions($db);

foreach($donnee as $valeur){

    $dn5 = $placesPrevues->getPlacesPrevuesBySession($db, $valeur['id']);
    $dn1 = $formation->getFormationById($db, $valeur['idFormation']);
    $dn2 = $typeSession->getTypeSessionById($db, $valeur['idTypeSession']);
    $dn3 = $reservation->getReservationBySession($db, $valeur['id']);

    $placesPrev = $dn5[0]['nbrePlaces'];
    $placesReserv = $dn3[0]['nbreReservation'];
    $placesRestantes = $placesPrev - $placesReserv;

    $dn4 = $techno->getTechnologieById($db, $dn1[0]['idTechnologie']);
    $dnPart = $partic->getParticipantBySession($db, $valeur['id']);
    $dnConsult = $consultant->getConsultantById($db, $valeur['idConsultant']);

    $leConsultant = '';

    foreach($dnConsult as $value){$leConsultant = $value['nom'].' '.$value['prenoms'].'  < '.$value['email'].' >';}

    $nbreParticipant = count($dnPart);
    $tab = array('idSession' => $valeur['id'],
        'prix' => $valeur['prix'],
        'dateFin' => $valeur['dateFin'],
        'dateDebut' => $valeur['dateDebut'],
        'dureeSession' => $valeur['dureeSession'],
        'idFormation' => $valeur['idFormation'],
        'titre' => $dn1[0]['titre'],
        'certif' => $dn1[0]['certifDeFormation'],
        'idTechno' => $dn4[0]['id'],
        'techno' => $dn4[0]['libelle'],
        'idTypeSession' => $valeur['idTypeSession'],
        'libTypeSession' => $dn2[0]['libelle'],
        'jrsHrs' => $dn2[0]['joursHeures'],
        'nbreDePlaces' => $placesPrev,
        'reservation' => $placesReserv,
        'placesRestantes' => $placesRestantes,
        'participants' => $nbreParticipant,
        'consultant' => $leConsultant
    );

    array_push($tab2, $tab);
}

echo json_encode(['message' => $message,
    'data' => $tab2
]) ;