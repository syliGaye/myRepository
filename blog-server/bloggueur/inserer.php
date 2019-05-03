<?php
require_once '../configuration/configuration.php';
require_once '../model/Bloggueur.php';
require_once '../model/Utilisateur.php';
require_once '../model/AjaxResponse.php';
require_once '../service/BloggueurService.php';
require_once '../service/UtilisateurService.php';

$ajaxResponse = new AjaxResponse();
$bloggueurService = new BloggueurService($db);
$utilisateurService = new UtilisateurService($db);

$nom = (isset($_POST['nom']))? htmlentities($_POST['nom']):null ;
$prenoms = (isset($_POST['prenoms']))? htmlentities($_POST['prenoms']):null ;
$pseudo = (isset($_POST['pseudo']))? htmlentities($_POST['pseudo']):null ;
$mail = (isset($_POST['mail']))? htmlentities($_POST['mail']):null ;

if(is_null($nom) || is_null($prenoms) || is_null($mail)){$ajaxResponse->setMessage("case vide");}
else{

    if(is_null($prenoms)){$pseudo = $prenoms.' '.$nom;}

    $user_1 = $utilisateurService->findOneUtilisateurByEmail($mail);
    $user_2 = $utilisateurService->findOneUtilisateurByPseudo($pseudo);

    if(!is_null($user_1->getId()) || !is_null($user_2->getId())){$ajaxResponse->setMessage("utilisateur existe");}
    else{
        $utilisateur = new Utilisateur();
        $bloggueur = new Bloggueur();
        $utilisateur->setDate(date("Y-m-d H:i:s"));
        $utilisateur->setMail($mail);
        $utilisateur->setPseudo($pseudo);
        $utilisateur->setStatut(1);

        $bloggueur->setUtilisateur($utilisateurService->saveUtilisateur($utilisateur));
        $bloggueur->setNom($nom);
        $bloggueur->setPrenoms($prenoms);
        $bloggueurService->saveBloggueur($bloggueur);
    }
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);