<?php
include_once '../configuration/configuration.php';
require_once 'Formation.php' ;
require_once '../technologie/Technologie.php';

$i = 0 ;
$formation = new Formation();
$techno = new Technologie();
$tab = array();

$donnees = $formation->getAllFormation($db);

foreach($donnees as $value){
    $dn_0 = $techno->getTechnologieById($db, $value['idTechnologie']);

    $tab_sup = array('id' => $value['id'],
        'titre' => $value['titre'],
        'certifDeFormation' => $value['certifDeFormation'],
        'idTecho' => $dn_0[0]['id'],
        'nomTechnologie' => $dn_0[0]['libelle']
    );
    array_push($tab, $tab_sup);
}

echo json_encode(['data' => $tab]) ;