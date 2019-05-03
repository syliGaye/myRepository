<?php
require_once '../configuration/configuration.php';
require_once 'Souscripteur.php' ;
require_once '../session/Session.php' ;

$souscripteur = new Souscripteur() ;
$session = new Session();

$idTypSess = (isset($_GET['laSession'])) ? htmlentities($_GET['laSession']) : NULL ;
$idFormation = (isset($_GET['laFormation'])) ? htmlentities($_GET['laFormation']) : NULL ;

$donnee = $session->getAllSessions($db) ;

$message = 'mal' ;
$data = array() ;

foreach($donnee as $value){
    if($value['idTypeSession'] === $idTypSess && $value['idFormation'] === $idFormation){
        $dn_0 = $souscripteur->getSouscripteurBySession($db, $value['id']) ;
        array_push($data, $dn_0) ;
        $message = 'bien' ;
    }
}

echo json_encode(['message' => $message,
    'data' => $data
]) ;