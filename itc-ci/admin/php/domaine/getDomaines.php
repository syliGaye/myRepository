<?php
include_once '../configuration/configuration.php';
require_once 'Domaine.php' ;

$i = 0 ;
$domaine = new Domaine() ;
$donnees = $domaine->getAllDomaine($db);

echo json_encode(['data' => $donnees]) ;