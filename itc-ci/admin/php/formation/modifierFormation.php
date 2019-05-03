<?php
include_once '../configuration/configuration.php';
require_once 'Formation.php';

$formation = new Formation();

$titre = (isset($_POST['inputTitre'])) ? htmlentities($_POST['inputTitre']) : NULL ;
$certifDeFormation = (isset($_POST['inputCertif'])) ? htmlentities($_POST['inputCertif']) : NULL ;
$techno = (isset($_POST['selectLibTechno'])) ? htmlentities($_POST['selectLibTechno']) : NULL ;
$id = (isset($_POST['cacheIdFormation'])) ? htmlentities($_POST['cacheIdFormation']) : NULL ;

$message = '' ;

if(!$titre || !$certifDeFormation || !$techno || !$id){
    $message = "erreur" ;
}
else{
    $dn = $formation->getFormationByTitre($db, $titre);
    $dn0 = $formation->getFormationByCertif($db, $certifDeFormation);
    $dn1 = $formation->getFormationById($db, $id);

    if(($dn1[0]['titre'] === $titre) && ($dn1[0]['certifDeFormation'] === $certifDeFormation) && ($dn1[0]['idTechnologie'] === $techno)){$message = 'Formation non modifiée.';}
    elseif((count($dn) > 0) && ($dn[0]['id'] !== $id)){$message = 'Cette Formation existe déjà';}
    elseif((count($dn0) > 0) && ($dn0[0]['id'] !== $id)){$message = 'Certification déjà attribuée';}
    else{
        $formation->mergeFormation($db, $id, $titre, $certifDeFormation, $techno);
        $message = 'ok' ;
    }
}

echo json_encode(['message' => $message]) ;