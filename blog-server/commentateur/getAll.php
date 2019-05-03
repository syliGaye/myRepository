<?php
require_once '../configuration/configuration.php';
require_once '../model/Commentateur.php';
require_once '../model/AjaxResponse.php';
require_once '../service/CommentateurService.php';
require_once '../service/UtilisateurService.php';

$ajaxResponse = new AjaxResponse();
$commentateurService = new CommentateurService($db);
$utilisateurService = new UtilisateurService($db);
$array = array();

$commentateurs = $commentateurService->findAllCommentateur();

if(!is_null($commentateurs)){
    foreach($commentateurs as $value){
        array_push(
            $array,
            $commentateurService->retourCommentaire(
                $value->getId(),
                $utilisateurService->retourUtilisateur($value->getUtilisateur())
            )
        );
    }
    $ajaxResponse->setListe($array);
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);