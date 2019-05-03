<?php
include_once '../configuration/configuration.php';
require_once 'Domaine.php';

$domaine = new Domaine();

$id = (isset($_GET['idPourModifDomaine'])) ? htmlentities($_GET['idPourModifDomaine']) : NULL ;
$message = '' ;
$tab = array();
if($id){
    $dn0 = $domaine->getDomaineById($db, $id);

    if(count($dn0 > 0)){
        array_push($tab, $dn0);
        $message = 'ok' ;
    }
    else{$message = 'Domaine introuvable';}
}
else{$message = 'Extration Domaine impossible';}

echo json_encode([
    'message' => $message,
    'data' => $tab
]) ;