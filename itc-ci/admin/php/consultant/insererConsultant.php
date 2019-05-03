<?php
include_once '../configuration/configuration.php';
require_once 'Consultant.php';
require_once '../tablesupport/TableSupport.php';

$consultant = new Consultant();
$tableSup = new TableSupport();
$tab = array();
$i = 0;

$idForm2 = (isset($_POST['idForm2']))? htmlentities($_POST['idForm2']):null;
$profession = (isset($_POST['profConsultant']))? htmlentities($_POST['profConsultant']):null;
$employeur = (isset($_POST['empConsultant']))? htmlentities($_POST['empConsultant']):null;
$fonction = (isset($_POST['fonctionConsultant']))? htmlentities($_POST['fonctionConsultant']):null;
$lieuHabitation = (isset($_POST['lieuHabitation']))? htmlentities($_POST['lieuHabitation']):null;

$message = '';
$id = 0;
$nom = null;
$prenoms = null;
$dateNaissance = null;
$nationalite = null;
$telephone = null;
$email = null;

if($profession && $employeur && $fonction && $lieuHabitation){
    foreach($tableSup->getAllTableSupport($db) as $valeur){
        $id = $valeur['id'];
        $nom = $valeur['nom'];
        $prenoms = $valeur['prenoms'];
        $dateNaissance = $valeur['dateNaissance'];
        $nationalite = $valeur['nationalite'];
        $telephone = $valeur['telephone'];
        $email = $valeur['email'];
    }

    $tableSup->removeTableSupport($db, $id);
    $consultant->saveConsultant($db, $nom, $prenoms, $dateNaissance, $nationalite, $profession, $employeur, $fonction, $lieuHabitation, $telephone, $email);
    $id = $consultant->getConsultantRowCount($db);
    $message = 'ok';
}
elseif($idForm2){
    $tableSup->removeTableSupport($db, $idForm2);
    $message = 'Lieu d\'habitation rest&eacute; vide.';
}
else{
    $message = 'Enregistrement imposible';
    $id = 0;
}

echo json_encode([
    'message' => $message,
    'id' => $id
]);