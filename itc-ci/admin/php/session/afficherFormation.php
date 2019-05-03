<?php
include_once '../configuration/configuration.php';
require_once 'Session.php';
require_once '../typeSession/TypeSession.php';
require_once '../formation/Formation.php';
require_once '../technologie/Technologie.php';
//require_once 'Domaine.php';
require_once '../placesPrevues/PlacesPrevues.php';
require_once '../reservation/Reservation.php';
require_once '../participant/Participant.php';

$partic = new Participant();
$session = new Session();
$placesPrevues = new PlacesPrevues();
$formation = new Formation();
$typeSession = new TypeSession();
$reservation = new Reservation();
//$domaine = new Domaine();
$techno = new Technologie();
$message = '';

$donnee = $session->getAllSessions($db);
$dn1 = array();
$dn2 = array();
$dn3 = array();
$dn4 = array();
$dn5 = array();
//$dn6 = array();
$tab2 = array();
$tab1 = array();
$tab = array();
$jour = '';
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

    /*array_push($tab1, $dn3);
    array_push($tab2, $dn5);*/

    $placesPrev = $dn5[0]['nbrePlaces'];
    $placesReserv = $dn3[0]['nbreReservation'];
    $placesRestantes = $placesPrev - $placesReserv;

    $dn4 = $techno->getTechnologieById($db, $dn1[0]['idTechnologie']);

    //$dn6 = $domaine->getDomaineById($db, $dn4[0]['idDomaine']);

    if($valeur['dateDebut'] !== null){
        $dnPart = $partic->getParticipantBySession($db, $valeur['id']);
        $nbreParticipant = count($dnPart);

        $tab = array('idSession' => $valeur['id'],
            'dateFin' => $valeur['dateFin'],
            'prix' => $valeur['prix'],
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
            'participants' => $nbreParticipant
        );

        array_push($tab1, $tab);
    }
    else{
        $tab = array('idSession' => $valeur['id'],
            'prix' => $valeur['prix'],
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
            'placesRestantes' => $placesRestantes
        );

        array_push($tab2, $tab);
    }
}

/*print_r($tab1)  ;

echo '<br/><br/>';
print_r($tab2)  ;*/

echo json_encode(['message' => $message,
    'data_1' => $tab1,
    'data' => $tab2
]) ;