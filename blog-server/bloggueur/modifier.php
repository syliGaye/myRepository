<?php
require_once '../configuration/configuration.php';
require_once '../model/Bloggueur.php';
require_once '../model/AjaxResponse.php';
require_once '../service/BloggueurService.php';
require_once '../service/UtilisateurService.php';

$ajaxResponse = new AjaxResponse();
$bloggueurService = new BloggueurService($db);
$utilisateurService = new UtilisateurService($db);

$id = (isset($_POST['idBloggueur']))? htmlentities($_POST['idBloggueur']):null;
$nom = (isset($_POST['nom']))? htmlentities($_POST['nom']):null ;
$prenoms = (isset($_POST['prenoms']))? htmlentities($_POST['prenoms']):null ;
$pseudo = (isset($_POST['pseudo']))? htmlentities($_POST['pseudo']):null ;
$mail = (isset($_POST['mail']))? htmlentities($_POST['mail']):null ;

if(is_null($id) || is_null($nom) || is_null($prenoms) || is_null($mail) || is_null($pseudo)){$ajaxResponse->setMessage("case vide");}
else{
    $bloggueur = $bloggueurService->findOneBloggueur($id);

    if(!is_null($bloggueur->getId())){
        $utilisateur = $utilisateurService->findOneUtilisateur($bloggueur->getUtilisateur());

        if(!is_null($utilisateur->getId())){
            $utilisateur->setMail($mail);
            $utilisateur->setPseudo($pseudo);
            $utilisateurService->mergeUtilisateur($utilisateur);
        }
        $bloggueur->setNom($nom);
        $bloggueur->setPrenoms($prenoms);

        $bloggueurService->mergebloggueur($bloggueur);
    }
    else{$ajaxResponse->setMessage("Bloggueur vide");}
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);