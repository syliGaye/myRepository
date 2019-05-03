<?php
include_once '../configuration/configuration.php';
require_once 'TableSupport.php';

$ts = new TableSupport();

$nom = (isset($_POST['nomConsultant']))? htmlentities($_POST['nomConsultant']):null;
$prenoms = (isset($_POST['prenomConsultant']))? htmlentities($_POST['prenomConsultant']):null;
$dateNaissance = (isset($_POST['dateNaissConsultant']))? htmlentities($_POST['dateNaissConsultant']):null;
$nationalite = (isset($_POST['nationConsultant']))? htmlentities($_POST['nationConsultant']):null;
$telephone = (isset($_POST['phoneConsultant']))? htmlentities($_POST['phoneConsultant']):null;
$email = (isset($_POST['emailConsultant']))? htmlentities($_POST['emailConsultant']):null;
$message = '';
$id = 0;

if($nom && $prenoms && $dateNaissance && $nationalite && $telephone && $email){
    $date = DateTime::createFromFormat('m/d/Y', $dateNaissance);
    //echo date_format('Y-m-d', $date);
    $ts->saveTableSupport($db, $nom, $prenoms, $date->format('Y-m-d'), $nationalite, null, null, null, null, $telephone, $email);
    $id = $ts->getTableSupportRowCount($db);
    $message = 'ok';
}
else{
    $message = 'Une entr&eacute;e est rest&eacute;e vide.';
    $id = 0 ;
}

echo json_encode([
    'message' => $message,
    'id' => $id
]);