<?php
require_once '../configuration/configuration.php';
require_once '../model/Bloggueur.php';
require_once '../model/Utilisateur.php';
require_once '../model/AjaxResponse.php';
require_once '../service/CommentateurService.php';
require_once '../service/UtilisateurService.php';

$ajaxResponse = new AjaxResponse();
$commentateurService = new CommentateurService($db);
$utilisateurService = new UtilisateurService($db);

$pseudo = (isset($_POST['pseudo']))? htmlentities($_POST['pseudo']):null ;
$mail = (isset($_POST['mail']))? htmlentities($_POST['mail']):null ;

if(is_null($pseudo) || is_null($mail)){$ajaxResponse->setMessage("case vide");}
else{
    $user_1 = $utilisateurService->findOneUtilisateurByEmail($mail);
    $user_2 = $utilisateurService->findOneUtilisateurByPseudo($pseudo);

    if(!is_null($user_1->getId()) || !is_null($user_2->getId())){$ajaxResponse->setMessage("utilisateur existe");}
    else{
        $utilisateur = new Utilisateur();
        $commentateur = new Commentateur();
        $utilisateur->setDate(date("Y-m-d H:i:s"));
        $utilisateur->setMail($mail);
        $utilisateur->setPseudo($pseudo);
        $utilisateur->setStatut(2);

        $commentateur->setUtilisateur($utilisateurService->saveUtilisateur($utilisateur));
        $commentateurService->savecommentateur($commentateur);
    }
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);