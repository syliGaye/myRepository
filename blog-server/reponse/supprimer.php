<?php
require_once '../configuration/configuration.php';
require_once '../model/Reponse.php';
require_once '../model/AjaxResponse.php';
require_once '../service/ReponseService.php';

$ajaxResponse = new AjaxResponse();
$reponseService = new ReponseService($db);

$id = (isset($_GET['reponse']))? htmlentities($_GET['reponse']):null ;

if(!is_null($id)){
    $reponse = $reponseService->findOneReponse($id);

    if(!is_null($reponse->getId())){$reponseService->deleteReponse($reponse->getId());}
    else{$ajaxResponse->setMessage("commentaire vide");}
}
else{$ajaxResponse->setMessage("malin");}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);