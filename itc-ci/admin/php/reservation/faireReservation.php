<?php
include_once '../configuration/configuration.php';
include_once '../fonctions.php';
require_once '../souscripteur/Souscripteur.php';
require_once 'Reservation.php';
require_once '../formation/Formation.php';
require_once '../session/Session.php';
require_once '../notification/Notification.php';
require_once '../placesPrevues/PlacesPrevues.php';

$session = new Session();
$formation = new Formation();
$souscrip = new Souscripteur();
$notif = new Notification();
$reserv = new Reservation();
$places = new PlacesPrevues();

$message = '';
$nbreReserva = 0;
$placesPrevu = 0;
$idReserv = 0;
$laFormation = '';
$titre = '';

$nom = (isset($_GET['nom']))? htmlentities($_GET['nom']):null;
$prenom = (isset($_GET['prenoms']))? htmlentities($_GET['prenoms']):null;
$email = (isset($_GET['mail']))? htmlentities($_GET['mail']):null;
$tel = (isset($_GET['phone']))? htmlentities($_GET['phone']):null;
$idSession = (isset($_GET['idSession']))? htmlentities($_GET['idSession']):null;

$tabReserv = $reserv->getReservationBySession($db, $idSession);
$tabSession = $session->getSessionById($db, $idSession);
$tabPlaces = $places->getPlacesPrevuesBySession($db, $idSession);

$tabForm = array();
$i = 0;
$verifDomaine = verifDomaine($email);

if($verifDomaine){

    foreach($tabReserv as $valReserv){
        $idReserv = $valReserv['id'];
        $nbreReserva = $valReserv['nbreReservation'] + 1;
        $i++;
    }

    $m = 0;
    foreach($tabPlaces as $valPlaces){
        $placesPrevu = $valPlaces['nbrePlaces'];
        $m++;
    }

    if($nbreReserva > $placesPrevu){
        $message = 'Le quota d\'inscription pour la formation est atteint.';
    }
    else{

        $i = 0;
        foreach($tabSession as $valSession){
            $tabForm = $formation->getFormationById($db, $valSession['idFormation']);
            $k = 0;
            foreach($tabForm as $valForm){
                $laFormation = $valForm['titre'];
                $k++;
            }
            $i++;
        }
        $objet = 'Reservation Formation' ;

        $corps = '<html><head></head><body>Bonjour '.$prenom.' '.$nom.',<br/><br/>Nous vous remercions de votre reservation &agrave; la formation <strong>'.$laFormation.'</strong>. <br/>Pour valider votre inscription, <a href="itc-ci.com/admin/php/reservation/confirmerReservation.php?';
        $corps .= 'nom='.$nom.'&prenom='.$prenom.'&email='.$email.'&phone='.$tel.'&Session='.$idSession.'&formation='.$laFormation.'&reservation='.$nbreReserva.'">veuillez cliquer sur ce lien</a> <br/>' ;

        if(envoyerMail($email, $nom, $prenom, $objet, $corps) === true){$message = 'ok';}
        else{$message = 'Echec de la Reservation !';}
    }
}
else{
    $message = 'Adresse email incorrecte.';
}


echo json_encode([
    'message' => $message
]);

