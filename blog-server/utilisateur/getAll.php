<?php
require_once '../configuration/configuration.php';
require_once '../model/Utilisateur.php';
require_once '../model/AjaxResponse.php';
require_once '../service/UtilisateurService.php';

$utilisateurService = new UtilisateurService($db);
$ajaxResponse = new AjaxResponse();
$array = array();

$utilisateurs = $utilisateurService->findAllUtilisateur();

if(!is_null($utilisateurs)){
    foreach($utilisateurs as $value){
        array_push(
            $array,
            $utilisateurService->retourUtilisateur($value->getId())
        );
    }
    $ajaxResponse->setListe($array);
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);