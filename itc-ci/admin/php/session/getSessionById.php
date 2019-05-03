<?php
include_once '../configuration/configuration.php';
require_once 'Session.php';
require_once '../placesPrevues/PlacesPrevues.php';

$session = new Session();
$pp = new PlacesPrevues();
$message = '';
$dn5 = array();
$tab1 = array();

$id = (isset($_GET['idModifier']))? htmlentities($_GET['idModifier']):null;

if($id){
    $valeur = $session->getSessionById($db, $id);
    $dn5 = $pp->getPlacesPrevuesBySession($db, $valeur[0]['id']);

    $tab1 = array('id' => $valeur[0]['id'],
        'dateFin' => $valeur[0]['dateFin'],
        'prix' => $valeur[0]['prix'],
        'dateDebut' => $valeur[0]['dateDebut'],
        'dureeSession' => $valeur[0]['dureeSession'],
        'idFormation' => $valeur[0]['idFormation'],
        'consultant' => $valeur[0]['idConsultant'],
        'typeSession' => $valeur[0]['idTypeSession'],
        'idPlaces' => $dn5[0]['id'],
        'nbrePlaces' => $dn5[0]['nbrePlaces']
    );

    $message = 'ok';
}
else{
    $tab1 = null;
    $message = 'erreur';
}

echo json_encode(['message' => $message,
    'data' => $tab1
]);