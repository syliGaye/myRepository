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
$emailSouscrip = '';
$titre = '';

$nom = (isset($_GET['nom']))? htmlentities($_GET['nom']):null;
$prenom = (isset($_GET['prenom']))? htmlentities($_GET['prenom']):null;
$email = (isset($_GET['email']))? htmlentities($_GET['email']):null;
$tel = (isset($_GET['phone']))? htmlentities($_GET['phone']):null;
$idSession = (isset($_GET['Session']))? htmlentities($_GET['Session']):null;
$formation = (isset($_GET['formation']))? htmlentities($_GET['formation']):null;
$nbreDeReserv = (isset($_GET['reservation']))? htmlentities($_GET['reservation']):null;

$tabReserv = $reserv->getReservationBySession($db, $idSession);
//$tabSession = $session->getSessionById($db, $idSession);
$tabPlaces = $places->getPlacesPrevuesBySession($db, $idSession);
$tabSouscripteur = $souscrip->getSouscripteurBySession($db, $idSession);

if($nbreDeReserv === $tabPlaces[0]['nbrePlaces']){
    $titre = 'LANCER SESSION';
    $contenu = 'Une reservation pour la formation '.$formation.' vient d\'&ecirc;tre effectu&eacute;e.';
    $contenu .= 'Le nombre total des reservations est atteint, lancer la session.';
}
else{
    $titre = 'RESERVATION';
    $contenu = 'Une reservation pour la formation '.$formation.' vient d\'&ecirc;tre effectu&eacute;e.';
}

foreach($tabSouscripteur as $valSous){
    if($valSous['email'] === $email) $emailSouscrip = $valSous['email'] ;
}

if($emailSouscrip === ''){
    $objet = 'Confirmation Reservation' ;

    $corps = '<html><head></head><body>Nous vous remercions de votre reservation &agrave; la formation <strong>'.$formation.'</strong>. <br/>Nous vous tiendrons informer de la date à partir de laquelle <br/>' ;
    $corps .= 'vous pouvez venir proceder à votre inscription au cours.<br/><br/> <strong>Votre &eacute;quipe de formation IT Consulting</strong><br/><br/> Retrouvez toutes nos offres de formations et nos actualités sur ce <a href="itc-ci.com">lien</a>.<img src="itc-ci.com/assets/images/avatars/random-avatar2.jpg"/></body></html>';

    if(envoyerMail($email, $nom, $prenom, $objet, $corps) === true){
        $souscrip->saveSouscripteur($db, $nom, $prenom, $email, $tel, $idSession);
        $notif->saveNotification($db, $titre, $contenu, 'ferme', 'non lu', $idSession) ;
        $reserv->mergeReservation($db, $tabReserv[0]['id'], $nbreDeReserv, $idSession);
        header('Location: ../../../sessions.html');
    }
    else{header('Location: ../../../rejet.html');}
}
else{header('Location: ../../../sessions.html');}

print_r($emailSouscrip);
echo '<br/>Cool '.$nom;
echo '<br/>'.$titre ;