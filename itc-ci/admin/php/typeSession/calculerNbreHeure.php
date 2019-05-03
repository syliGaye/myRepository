<?php
include_once '../configuration/configuration.php';
require_once 'TypeSession.php';

$typSess = new TypeSession();
$message = '';

$valNbreSemaine = (isset($_GET['semaine']))? htmlentities($_GET['semaine']):null;
$idTypeSession = (isset($_GET['typeSession']))? htmlentities($_GET['typeSession']):null;
$nbreHeure = 0;
$donnee = array();
if($idTypeSession){
    $donnee = $typSess->getTypeSessionById($db, $idTypeSession);
    $nbreHeure = $donnee[0]['dureeSession'] * $valNbreSemaine;
}

echo json_encode(['nbreHeure' => $nbreHeure]);