<?php
include_once '../configuration/configuration.php';
require_once 'Session.php';
require_once '../typeSession/TypeSession.php';
require_once '../formation/Formation.php';
require_once '../technologie/Technologie.php';
require_once '../domaine/Domaine.php';
require_once '../placesPrevues/PlacesPrevues.php';
require_once '../reservation/Reservation.php';

$session = new Session();
$placesPrevues = new PlacesPrevues();
$formation = new Formation();
$typeSession = new TypeSession();
$reservation = new Reservation();
$domaine = new Domaine();
$techno = new Technologie();
$message = '';

$idSession = (isset($_GET['envoiId']))? htmlentities($_GET['envoiId']):null;

$donnee = $session->getSessionById($db, $idSession);
$dateDebut = $donnee[0]['dateDebut'];
$tab1 = array();

if($dateDebut){
    $message = 'La Session a deja debuter.';
}
else{
    $dn1 = array();
    $dn2 = array();
    $dn3 = array();
    $dn4 = array();
    $dn5 = array();
    $dn6 = array();
    $tab2 = array();
    $placesPrev = 0;
    $placesRestantes = 0;
    $placesReserv = 0;
    $i = 0;

    foreach($donnee as $valeur){

        $dn5 = $placesPrevues->getPlacesPrevuesBySession($db, $valeur['id']);
        $dn1 = $formation->getFormationById($db, $valeur['idFormation']);
        $dn2 = $typeSession->getTypeSessionById($db, $valeur['idTypeSession']);
        $dn3 = $reservation->getReservationBySession($db, $valeur['id']);

        $placesPrev = $dn5[0]['nbrePlaces'];
        $placesReserv = $dn3[0]['nbreReservation'];
        $placesRestantes = $placesPrev - $placesReserv;

        $j =0 ;

        foreach($dn1 as $valFormation){
            $dn4 = $techno->getTechnologieById($db, $valFormation['idTechnologie']) ;
            $k = 0;
            foreach($dn4 as $valTechno){
                $dn6 = $domaine->getDomaineById($db, $valTechno['idDomaine']) ;
                $l = 0;
                foreach($dn2 as $valType){
                    $tab = array('idSession' => $valeur['id'],
                        'dateFin' => $valeur['dateFin'],
                        'prix' => $valeur['prix'],
                        'dateDebut' => $valeur['dateDebut'],
                        'dureeSession' => $valeur['dureeSession'],
                        'idFormation' => $valFormation['id'],
                        'titre' => $valFormation['titre'],
                        'certif' => $valFormation['certifDeFormation'],
                        'idTechno' => $valTechno['id'],
                        'techno' => $valTechno['libelle'],
                        'idDoma' => $dn6['id'],
                        'domaine' => $dn6['intitule'],
                        'idTypeSession' => $valType['id'],
                        'libTypeSession' => $valType['libelle'],
                        'jrsHrs' => $valType['joursHeures'],
                        'nbreDePlaces' => $placesPrev,
                        'reservation' => $placesReserv,
                        'placesRestantes' => $placesRestantes
                    );
                    array_push($tab1, $tab);
                    $l++;
                }
                $k++;
            }
            $j++;
        }
        $i++;
    }
    $message = 'ok';
}


echo json_encode(['message' => $message,
    'data' => $tab1]) ;