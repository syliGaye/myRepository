<?php
require_once '../configuration/configuration.php';
require_once '../model/Utilisateur.php';
require_once '../model/AjaxResponse.php';
require_once '../service/UtilisateurService.php';

$utilisateurService = new UtilisateurService($db);
$ajaxResponse = new AjaxResponse();
$array = array();

$id = (isset($_GET['utilisateur']))? htmlentities($_GET['utilisateur']):null ;

if(!is_null($id)){
    $utilisateur = $utilisateurService->findOneUtilisateur($id);

    if(!is_null($utilisateur->getId())){
        $ajaxResponse->setObjet(
            $utilisateurService->retourUtilisateur($utilisateur->getId())
        );
    }
}
else{$ajaxResponse->setMessage("mal");}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);