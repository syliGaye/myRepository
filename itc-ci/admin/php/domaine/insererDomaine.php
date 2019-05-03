<?php
include_once '../configuration/configuration.php';
require_once 'Domaine.php';

$intitule = (isset($_POST['inputIntitule'])) ? htmlentities($_POST['inputIntitule']) : NULL ;

$domaine = new Domaine();
$message = '' ;

if(!$intitule){
    $message = "erreur" ;
}else{
    $dn = $domaine->getDomaineByIntitule($db, $intitule);

    if(count($dn) > 0){$message = 'Domaine de technologie existant.' ;}
    else{
        $domaine->saveDomaine($db, $intitule) ;
        $message = 'ok' ;
    }
}

echo json_encode(['message' => $message]) ;