<?php
require_once '../configuration/configuration.php';
require_once '../model/Bloggueur.php';
require_once '../model/AjaxResponse.php';
require_once '../service/BloggueurService.php';
require_once '../service/UtilisateurService.php';

$ajaxResponse = new AjaxResponse();
$bloggueurService = new BloggueurService($db);
$utilisateurService = new UtilisateurService($db);

$id = (isset($_GET['bloggueur']))? htmlentities($_GET['bloggueur']):null ;

if(is_null($id)){$ajaxResponse->setMessage("mal");}
else{
    $bloggueur = new Bloggueur();
    $bloggueur = $bloggueurService->findOneBloggueur($id);

    if(!is_null($bloggueur->getId())){
        $ajaxResponse->setObjet(array('id' => $bloggueur->getId(),
            'nom' => $bloggueur->getNom(),
            'prenoms' => $bloggueur->getPrenoms(),
            'utilisateur' => $utilisateurService->retourUtilisateur($bloggueur->getUtilisateur())
        ));
    }
    else{$ajaxResponse->setMessage("bloggueur vide");}
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);