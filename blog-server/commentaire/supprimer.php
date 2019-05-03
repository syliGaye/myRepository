<?php
require_once '../configuration/configuration.php';
require_once '../model/Article.php';
require_once '../model/Commentaire.php';
require_once '../model/Reponse.php';
require_once '../model/AjaxResponse.php';
require_once '../service/BloggueurService.php';
require_once '../service/UtilisateurService.php';
require_once '../service/ArticleService.php';
require_once '../service/CommentaireService.php';
require_once '../service/ReponseService.php';

$ajaxResponse = new AjaxResponse();
$bloggueurService = new BloggueurService($db);
$utilisateurService = new UtilisateurService($db);
$articleService = new ArticleService($db);
$commentaireService = new CommentaireService($db);
$reponseService = new ReponseService($db);

$id = (isset($_GET['commentaire']))? htmlentities($_GET['commentaire']):null ;

if(!is_null($id)){
    $commentaire = $commentaireService->findOneCommentaire($id);

    if(!is_null($commentaire->getId())){
        $reponses = $reponseService->findAllReponseByCommentaire($commentaire->getId());

        if(!is_null($reponses)){
            foreach($reponses as $value){$reponseService->deleteReponse($value->getId());}
        }

        $commentaireService->deleteCommentaire($commentaire->getId());
    }
    else{$ajaxResponse->setMessage("commentaire vide");}
}
else{$ajaxResponse->setMessage("malin");}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);