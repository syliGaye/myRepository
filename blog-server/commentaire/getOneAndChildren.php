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
$array = array();

$id = (isset($_GET['idCommentaire']))? htmlentities($_GET['idCommentaire']):null ;

if(is_null($id)){$ajaxResponse->setMessage("mal");}
else{
    $commentaire = $commentaireService->findOneCommentaire($id);

    if(!is_null($commentaire->getId())){
        $arrayReponse = array();
        $reponses = $reponseService->findAllReponseByCommentaire($commentaire->getId());

        if(!is_null($reponses)){
            foreach($reponses as $value){
                array_push(
                    $arrayReponse,
                    array('id' => $value->getId(),
                        'sujet' => $value->getSujet(),
                        'reponse' => $value->getMessage(),
                        'date' => $value->getDate(),
                        'utilisateur' => $utilisateurService->retourUtilisateur($value->getUtilisateur())
                    )
                );
            }
        }

        $article = $articleService->findOneArticle($commentaire->getArticle());
        $bloggueur = $bloggueurService->findOneBloggueur($article->getBloggueur());

        $ajaxResponse->setObjet($commentaireService->retourCommentaire(
            $commentaire->getId(),
            $articleService->retourArticle(
                $article->getId(),
                $bloggueurService->retourBloggueur(
                    $bloggueur->getId(),
                    $utilisateurService->retourUtilisateur($bloggueur->getUtilisateur())
                )
            ),
            $utilisateurService->retourUtilisateur($commentaire->getUtilisateur())
        ));
    }
    else{$ajaxResponse->setMessage("commentaire vide");}
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);