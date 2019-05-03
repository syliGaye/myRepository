<?php
require_once '../configuration/configuration.php';
require_once '../model/Bloggueur.php';
require_once '../model/AjaxResponse.php';
require_once '../service/CommentateurService.php';
require_once '../service/UtilisateurService.php';

$ajaxResponse = new AjaxResponse();
$commentateurService = new CommentateurService($db);
$utilisateurService = new UtilisateurService($db);

$id = (isset($_POST['idCommentateur']))? htmlentities($_POST['idCommentateur']):null;
$pseudo = (isset($_POST['pseudo']))? htmlentities($_POST['pseudo']):null ;
$mail = (isset($_POST['mail']))? htmlentities($_POST['mail']):null ;

if(is_null($id) || is_null($mail)|| is_null($pseudo)){$ajaxResponse->setMessage("case vide");}
else{
    $commentateur = $commentateurService->findOneCommentateur($id);

    if(!is_null($commentateur->getId())){
        $utilisateur = $utilisateurService->findOneUtilisateur($commentateur->getUtilisateur());

        if(!is_null($utilisateur->getId())){
            $utilisateur->setMail($mail);
            $utilisateur->setPseudo($pseudo);
            $utilisateurService->mergeUtilisateur($utilisateur);
        }

        $commentateurService->mergecommentateur($commentateur);
    }
    else{$ajaxResponse->setMessage("Commentateur vide");}
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);