<?php
include_once '../configuration/configuration.php';
require_once 'TypeSession.php';

$typeSession = new TypeSession();

$id = (isset($_GET['editerTypeSession'])) ? htmlentities($_GET['editerTypeSession']) : NULL ;
$message = '' ;

if($id){
    $dn = $typeSession->getTypeSessionById($db, $id);

    if(count($dn) > 0){$message = 'ok';}
    else{$message = 'Type Session introuvable';}
}
else{$message = 'Extration Type Session impossible';}

echo json_encode([
    'message' => $message,
    'data' => $dn
]) ;