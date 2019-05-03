<?php
include_once '../configuration/configuration.php';
require_once 'Technologie.php';

$techno = new Technologie();

$libelle = (isset($_POST['inputLibTechnologie'])) ? htmlentities($_POST['inputLibTechnologie']) : NULL ;
$selTechno = (isset($_POST['selectIntituleDomaine'])) ? htmlentities($_POST['selectIntituleDomaine']) : NULL ;
$id = (isset($_POST['cacheIdTechnologie'])) ? htmlentities($_POST['cacheIdTechnologie']) : NULL ;
$message = '' ;

if(!$libelle || !$selTechno){
    $message = "erreur" ;
}else{
    $dn = $techno->getTechnologieById($db, $id);
    $dn0 = $techno->getTechnologieByLibelle($db, $libelle);

    if(($dn[0]['libelle'] === $libelle) && ($dn[0]['idDomaine'] === $selTechno)){$message = "Technologie non modifiée.";}
    elseif((count($dn0) > 0) && ($dn0[0]['id'] !== $id)){$message = 'Technologie existante';}
    else{
        $techno->mergeTechnologie($db, $id, $libelle, $selTechno) ;
        $message = 'ok' ;
    }
}

echo json_encode(['message' => $message]) ;