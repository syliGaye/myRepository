<?php
include_once '../configuration/configuration.php';
require_once 'Notification.php';
require_once '../souscripteur/Souscripteur.php';
include_once '../MailsFunctions.php';

$notification = new Notification();
$message = '';

$objet = (isset($_POST['objetMails']))? htmlentities($_POST['objetMails']):null;
$content = (isset($_POST['summernote']))? htmlentities($_POST['summernote']):null;
$idNotifCache = (isset($_POST['idNotifCache']))? htmlentities($_POST['idNotifCache']):null;
$titre = (isset($_POST['titreNotifCache']))? htmlentities($_POST['titreNotifCache']):null;
$corps = (isset($_POST['contentNotifCache']))? htmlentities($_POST['contentNotifCache']):null;
$ouvert = (isset($_POST['ouvertNotifCache']))? htmlentities($_POST['ouvertNotifCache']):null;
$session = (isset($_POST['sessionNotifCache']))? htmlentities($_POST['sessionNotifCache']):null;

$tab = array();

foreach($_POST['lesRecipients'] as $value){
    getMailInscription($value, $objet, $content);
    //array_push($tab, $value);
}

$notification->mergeNotification($db, $idNotifCache, $titre, $corps, $ouvert, 'lu', $session);
header('Location: index.php') ;