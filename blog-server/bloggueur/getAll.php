<?php
require_once '../configuration/configuration.php';
require_once '../model/Bloggueur.php';
require_once '../model/AjaxResponse.php';
require_once '../service/BloggueurService.php';
require_once '../service/UtilisateurService.php';

$ajaxResponse = new AjaxResponse();
$bloggueurService = new BloggueurService($db);
$utilisateurService = new UtilisateurService($db);
$array = array();

$bloggueurs = $bloggueurService->findAllBloggueur();

if(!is_null($bloggueurs)){
    foreach($bloggueurs as $value){
        array_push(
            $array,
            $bloggueurService->retourBloggueur(
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