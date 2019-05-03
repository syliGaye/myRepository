<?php
include_once '../configuration/configuration.php';
require_once 'Technologie.php';
require_once '../domaine/Domaine.php';

$techno = new Technologie() ;
$domaine = new Domaine();
$tab = array();
$donnee = $techno->getAllTechnologie($db) ;

foreach($donnee as $value){
    $dn_1 = $domaine->getDomaineById($db, $value['idDomaine']);

    $tab_sup = array('id' => $value['id'],
        'libelle' => $value['libelle'],
        'idDom' => $dn_1['id'],
        'nomDomaine' => $dn_1['intitule']
    );

    array_push($tab, $tab_sup);
}

echo json_encode(['data' => $tab]) ;
