<?php
include_once '../configuration/configuration.php';
require_once 'Domaine.php';

$intitule = (isset($_POST['inputIntitule'])) ? htmlentities($_POST['inputIntitule']) : NULL ;
$id = (isset($_POST['cacheIdDomaine'])) ? htmlentities($_POST['cacheIdDomaine']) : NULL ;

$domaine = new Domaine();
$message = '' ;

if(!$intitule){
    $message = "Entrer un domaine." ;
}else{
    $dn = $domaine->getDomaineByIntitule($db, $intitule);

    if(count($dn) > 0){$message = 'Domaine de technologie existant.' ;}
    else{
        $domaine->mergeDomaine($db, $id, $intitule) ;
        $message = 'ok' ;
    }
}

echo json_encode(['message' => $message]) ;