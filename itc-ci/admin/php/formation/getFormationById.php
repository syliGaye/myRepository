<?php
include_once '../configuration/configuration.php';
require_once 'Formation.php' ;
require_once '../technologie/Technologie.php';

$i = 0 ;
$formation = new Formation();
$techno = new Technologie();

$id = (isset($_GET['modifFormation'])) ? htmlentities($_GET['modifFormation']) : NULL ;
$message = '' ;

if($id){
    $dn = $formation->getFormationById($db, $id);

    if(count($dn) > 0){$message = 'ok';}
    else{$message = 'Formation inexistante';}
}
else{$message = 'Extration impossible.';}

echo json_encode([
    'message' => $message,
    'data' => $dn
]) ;