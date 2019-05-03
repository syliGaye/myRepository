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

$id = (isset($_GET['bloggueur']))? htmlentities($_GET['bloggueur']):null ;

if(!is_null($id)){
    $bloggueur = new Bloggueur();
    $bloggueur = $bloggueurService->findOneBloggueur($id);

    if(!is_null($bloggueurl->getId())){
        $articles = $articleService->findAllArticleByBloggueur($bloggueur->getId());
        $utiliateur = $utilisateurService->findOneUtilisateur($bloggueur->getId());

        if(!is_null($articles)){
            foreach($articles as $value){
                $commentaires = $commentaireService->findAllCommentaireByArticle($value->getId());

                if(!is_null($commentaires)){
                    foreach($commentaires as $value_1){
                        $reponses = $reponseService->findAllReponseByCommentaire($value_1->getId());

                        if(!is_null($reponses)){
                            foreach($reponses as $value_2){$reponseService->deleteReponse($value_2->getId());}
                        }

                        $commentaireService->deleteCommentaire($value_1->getId());
                    }
                }

                $articleService->deleteArticle($value->getId());
            }
        }

        if(!is_null($utiliateur->getId())){
            $commentaireList = $commentaireService->findAllCommentaireByUtilisateur($utiliateur->getId());

            if(!is_null($commentaireList)){
                foreach($commentaireList as $value_3){
                    $reponses = $reponseService->findAllReponseByCommentaire($value_3->getId());

                    if(!is_null($reponses)){
                        foreach($reponses as $value_4){$reponseService->deleteReponse($value_4->getId());}
                    }

                    $commentaireService->deleteCommentaire($value->getId());
                }
            }

        }

        $bloggueurService->deletebloggueur($bloggueur->getId());
        $utilisateurService->deleteUtilisateur($utiliateur->getId());
    }
    else{$ajaxResponse->setMessage("Article vide");}
}
else{$ajaxResponse->setMessage("malin");}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);