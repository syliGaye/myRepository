<?php
include_once '../configuration/configuration.php';
require_once 'Disponibilite.php';

$dispo = new Disponibilite();

$dateDebut = (isset($_POST['debutDispoConsultant']))? htmlentities($_POST['debutDispoConsultant']):null;
$dateFin = (isset($_POST['finDispoConsultant']))? htmlentities($_POST['finDispoConsultant']):null;
$indexDispo = (isset($_POST['consultJrsHrsCpte']))? htmlentities($_POST['consultJrsHrsCpte']):null;
$dateDispo = date('Y-m-d');
$tableJourHeure = array();
$jourHeure = '' ;
$idConsultant = (isset($_POST['idForm4']))? htmlentities($_POST['idForm4']):null;
$message = '';

if($dateDebut && $dateFin && $idConsultant){
    if($indexDispo === '0'){
        $jourHeure = null;
    }
    else{
        $i = 0 ;
        foreach($_POST['consultantHeureJour'] as $value){
            array_push($tableJourHeure, $value);
        }

        while($i < count($tableJourHeure)){
            if($i === 0){$jourHeure = $tableJourHeure[$i];}
            else{$jourHeure = $jourHeure.','.$tableJourHeure[$i];}
            $i++;
        }
    }
    $date_1 = DateTime::createFromFormat('m/d/Y', $dateDebut);
    $date_2 = DateTime::createFromFormat('m/d/Y', $dateFin);
    $dispo->saveDisponibilite($db, $date_1->format('Y-m-d'), $date_2->format('Y-m-d'), $jourHeure, $idConsultant);
    $message = 'ok';
}
else{
    $message = 'Enregistrement impossible';
}

echo json_encode(['message' => $message]);