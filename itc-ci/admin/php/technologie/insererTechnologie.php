<?php
include_once '../configuration/configuration.php';
require_once 'Technologie.php';

$techno = new Technologie();

$libelle = (isset($_POST['inputLibTechnologie'])) ? htmlentities($_POST['inputLibTechnologie']) : NULL ;
$selTechno = (isset($_POST['selectIntituleDomaine'])) ? htmlentities($_POST['selectIntituleDomaine']) : NULL ;
$message = '' ;

if(!$libelle || !$selTechno){
    $message = "erreur" ;
}else{
    $dn = $techno->getTechnologieByLibelle($db, $libelle);

    if(count($dn) > 0){$message = "Technologie existante.";}
    else{
        $techno->saveTechnologie($db, $libelle, $selTechno) ;
        $message = 'ok' ;
    }
}

echo json_encode(['message' => $message]) ;