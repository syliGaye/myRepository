<?php
require_once '../configuration/configuration.php' ;
require_once 'Participant.php';
require_once '../souscripteur/Souscripteur.php' ;
require_once '../placesPrevues/PlacesPrevues.php' ;
require_once '../session/Session.php' ;

$participant = new Participant() ;
$souscrip = new Souscripteur() ;
$placePrevue = new PlacesPrevues() ;
$session = new Session() ;

$selSous = (isset($_POST['selectPartSouscrip']))? htmlentities($_POST['selectPartSouscrip']):null;
$sesCache = (isset($_POST['sessionPartSouscriptCache']))? htmlentities($_POST['sessionPartSouscriptCache']):null;
$nomSous = (isset($_POST['nomPartNonSous']))? htmlentities($_POST['nomPartNonSous']):null;
$prenomSous = (isset($_POST['prenomsPartNonSous']))? htmlentities($_POST['prenomsPartNonSous']):null;
$emailSous = (isset($_POST['emailPartNonSous']))? htmlentities($_POST['emailPartNonSous']):null;
$telSous = (isset($_POST['telPartNonSous']))? htmlentities($_POST['telPartNonSous']):null;
$selFormation = (isset($_POST['selectPartFormationNonSous']))? htmlentities($_POST['selectPartFormationNonSous']):null;
$selTypeSess = (isset($_POST['selectPartSessionNonSous']))? htmlentities($_POST['selectPartSessionNonSous']):null;

$message = '' ;
$dateDebut = null ;
$nbrePlaces = 0 ;

if($selSous){
    $dn_0 = $participant->getParticipantBySession($db, $sesCache) ;
    $dn_1 = $placePrevue->getPlacesPrevuesBySession($db, $sesCache) ;
    $donnee = $session->getSessionById($db, $sesCache) ;

    foreach($donnee as $value){$dateDebut = $value['dateDebut'] ;}
    foreach($dn_1 as $value){$nbrePlaces = $value['nbrePlaces'];}

    if($dateDebut === null){$message = 'La session de formation n\'est pas encore lanc&eacute;e.' ;}
    elseif(count($dn_0) >= $nbrePlaces){$message = 'Nombre de places atteint.';}
    else{
        $dn_2 = $souscrip->getSouscripteurById($db, $selSous) ;
        $nom = '' ;  $prenoms = '';  $email = '';  $tel = '';

        foreach($dn_2 as $value){
            $nom = $value['nom'];  $prenoms = $value['prenoms'];
            $email = $value['email'];  $tel = $value['telepnone'] ;
        }

        $participant->saveParticipant($db, $nom, $prenoms, $email, $tel, $sesCache) ;
        $souscrip->removeSouscripteur($db, $sesCache) ;

        $message = 'ok' ;
    }
}
elseif($nomSous){
    $donnee = $session->getAllSessions($db) ;
    $idSession = '' ;

    foreach($donnee as $value){if($value['idTypeSession'] === $selTypeSess && $value['idFormation'] === $selFormation){$idSession = $value['id'];   $dateDebut = $value['dateDebut'] ;}}

    $dn_0 = $participant->getParticipantBySession($db, $idSession) ;
    $dn_1 = $placePrevue->getPlacesPrevuesBySession($db, $idSession) ;
    $tab_Email = array() ;

    foreach($dn_1 as $value){$nbrePlaces = $value['nbrePlaces'];}
    foreach($dn_0 as $value){array_push($tab_Email, $value['email']);}

    if($dateDebut === null){$message = 'La session de formation n\'est pas encore lanc&eacute;e.' ;}
    elseif(count($dn_0) >= $nbrePlaces){$message = 'Nombre de places atteint.';}
    elseif(in_array($tab_Email, $email)){$message = 'Le participant est d&eacute;j&agrave; enregistr&eacute;.' ;}
    else{
        $participant->saveParticipant($db, $nomSous, $prenomSous, $emailSous, $telSous, $idSession) ;
        $message = 'ok' ;
    }
}
else{$message = 'C\'est impossible, mais bon...';}

echo json_encode(['message' => $message]) ;