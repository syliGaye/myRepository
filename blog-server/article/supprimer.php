<?php
require_once '../configuration/configuration.php';
require_once '../model/Article.php';
require_once '../model/Commentaire.php';
require_once '../model/Reponse.php';
require_once '../model/AjaxResponse.php';
require_once '../service/ArticleService.php';
require_once '../service/CommentaireService.php';
require_once '../service/ReponseService.php';

$ajaxResponse = new AjaxResponse();
$articleService = new ArticleService($db);
$commentaireService = new CommentaireService($db);
$reponseService = new ReponseService($db);

$id = (isset($_GET['article']))? htmlentities($_GET['article']):null ;

if(!is_null($id)){
    $article = new Article();
    $article = $articleService->findOneArticle($id);

    if(!is_null($article->getId())){
        $commentaires = $commentaireService->findAllCommentaireByArticle($article->getId());

        if(!is_null($commentaires)){
            foreach($commentaires as $value){
                $reponses = $reponseService->findAllReponseByCommentaire($value->getId());

                if(!is_null($reponses)){
                    foreach($reponses as $value_1){$reponseService->deleteReponse($value_1->getId());}
                }

                $commentaireService->deleteCommentaire($value->getId());
            }
        }

        $articleService->deleteArticle($article->getId());
    }
    else{$ajaxResponse->setMessage("Article vide");}
}
else{$ajaxResponse->setMessage("malin");}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);