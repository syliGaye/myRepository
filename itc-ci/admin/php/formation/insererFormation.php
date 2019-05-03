<?php
include_once '../configuration/configuration.php';
require_once 'Formation.php';

$formation = new Formation();

$titre = (isset($_POST['inputTitre'])) ? htmlentities($_POST['inputTitre']) : NULL ;
$certifDeFormation = (isset($_POST['inputCertif'])) ? htmlentities($_POST['inputCertif']) : NULL ;
$techno = (isset($_POST['selectLibTechno'])) ? htmlentities($_POST['selectLibTechno']) : NULL ;

$message = '' ;

if(!$titre || !$certifDeFormation || !$domaine){
    $message = "erreur" ;
}else{
    $dn = $formation->getFormationByTitre($db, $titre);
    $dn0 = $formation->getFormationByCertif($db, $certifDeFormation);
    if(count($dn) > 0){$message = 'la Formation '.$titre.' exite';}
    elseif(count($dn0) > 0){$message = 'Une certification deja attribuee';}
    else{
        $formation->saveFormation($db, $titre, $certifDeFormation, $techno);
        $message = 'ok' ;
    }
}

echo json_encode(['message' => $message]) ;