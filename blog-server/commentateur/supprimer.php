<?php
require_once '../configuration/configuration.php';
require_once '../model/Article.php';
require_once '../model/Commentaire.php';
require_once '../model/Reponse.php';
require_once '../model/AjaxResponse.php';
require_once '../service/BloggueurService.php';
require_once '../service/UtilisateurService.php';
require_once '../service/CommentateurService.php';

$ajaxResponse = new AjaxResponse();
$bloggueurService = new BloggueurService($db);
$utilisateurService = new UtilisateurService($db);
$commentateurService = new CommentateurService($db);

$id = (isset($_GET['commentateur']))? htmlentities($_GET['commentateur']):null ;

if(!is_null($id)){
    $commentateur = $commentateurService->findOneCommentateur($id);

    if(!is_null($commentateur->getId())){
        $utiliateur = $utilisateurService->findOneUtilisateur($commentateur->getId());

        if(!is_null($utiliateur->getId())){
            $commentaireList = $commentaireService->findAllCommentaireByUtilisateur($utiliateur->getId());

            if(!is_null($commentaireList)){
                foreach($commentaireList as $value){
                    $reponses = $reponseService->findAllReponseByCommentaire($value->getId());

                    if(!is_null($reponses)){
                        foreach($reponses as $value_1){$reponseService->deleteReponse($value_1->getId());}
                    }

                    $commentaireService->deleteCommentaire($value->getId());
                }
            }

        }

        $utilisateurService->deleteUtilisateur($utiliateur->getId());
        $bloggueurService->deletebloggueur($bloggueur->getId());
    }
    else{$ajaxResponse->setMessage("commentateur vide");}
}
else{$ajaxResponse->setMessage("malin");}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);