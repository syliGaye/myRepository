<?php
require_once '../configuration/configuration.php' ;
require_once 'Souscripteur.php';
require_once '../session/Session.php' ;
require_once '../formation/Formation.php' ;
require_once '../typeSession/TypeSession.php' ;

$souscrip = new Souscripteur() ;
$session = new Session() ;
$formation = new Formation() ;
$typSession = new TypeSession() ;

$donnee = $souscrip->getAllSouscripteur($db) ;
$tab = array() ;

foreach($donnee as $value){
    $dn_0 = $session->getSessionById($db, $value['idSession']) ;
    $idFormation = '' ;  $idTypeSession = '' ;
    $titreForm = '' ;   $libTypeSession = '' ;
    $tab_0 = array() ;

    foreach($dn_0 as $valSession){
        $dn_1 = $formation->getFormationById($db, $valSession['idFormation']) ;
        $dn_2 = $typSession->getTypeSessionById($db, $valSession['idTypeSession']) ;

        foreach($dn_1 as $valFormation){$titreForm = $valFormation['titre'];}
        foreach($dn_2 as $valTypSession){$libTypeSession = $valTypSession['libelle'];}
        $idFormation = $valSession['idFormation'] ;
        $idTypeSession = $valSession['idTypeSession'] ;
    }

    $tab_0 = array('id' => $value['id'],
        'nom' => $value['nom'],
        'prenoms' => $value['prenoms'],
        'email' => $value['email'],
        'tel' => $value['telepnone'],
        'idSession' => $value['idSession'],
        'idFormation' => $idFormation,
        'idTypSess' => $idTypeSession,
        'formation' => $titreForm,
        'typeSession' => $libTypeSession
    );
    array_push($tab, $tab_0) ;
}

echo json_encode(['data' => $tab]);