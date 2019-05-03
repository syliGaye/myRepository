<?php
include_once '../configuration/configuration.php';
require_once 'Technologie.php';

$techno = new Technologie() ;

$id = (isset($_GET['idTechnologieModif'])) ? htmlentities($_GET['idTechnologieModif']) : NULL ;
$message = '' ;

if($id){
    $dn = $techno->getTechnologieById($db, $id);

    if(count($dn) > 0){$message = 'ok';}
    else{$message = 'Technologie inexistante.';}
}
else{$message = 'Technologie inexistante.';}

echo json_encode([
    'data' => $dn,
    'message' => $message
]) ;
