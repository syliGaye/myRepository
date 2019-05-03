<?php
include_once '../configuration/configuration.php';
require_once 'Specialite.php';
require_once '../consultant/Consultant.php';
require_once '../competences/Competences.php';

$special = new Specialite();
$consultant = new Consultant();
$comp = new Competences();

$lastDiplomeObt = (isset($_POST['lastDiplConsultant']))? htmlentities($_POST['lastDiplConsultant']):null;
$certificationObt = (isset($_POST['lastCertifConsultant']))? htmlentities($_POST['lastCertifConsultant']):null;
$idConsultant = (isset($_POST['idForm3']))? htmlentities($_POST['idForm3']):null;
$idSup = (isset($_POST['idForm3Sup']))? htmlentities($_POST['idForm3Sup']):null;
$message = '';
$tableCompetence = array();

if($idSup){
    $consultant->removeConsultant($db, $idSup);
    $message = 'Cocher une formation';
}
elseif($idConsultant && $lastDiplomeObt && $certificationObt){
    $special->saveSpecialite($db, $lastDiplomeObt, $certificationObt, $idConsultant);

    $i = 0 ;
    foreach($_POST['checkFormationConsultant'] as $value){
        array_push($tableCompetence, $value);
    }

    while($i < count($tableCompetence)){
        $comp->saveCompetences($db, null, $idConsultant, $tableCompetence[$i]);
        $i++;
    }
    $message = 'ok';
}
else{$message = 'Enregistrement vide.';}

echo json_encode(['message' => $message]);