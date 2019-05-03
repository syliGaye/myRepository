<?php
require_once '../configuration/configuration.php';
require_once '../model/Article.php';
require_once '../model/Commentaire.php';
require_once '../model/Reponse.php';
require_once '../model/AjaxResponse.php';
require_once '../service/ArticleService.php';
require_once '../service/CommentaireService.php';
require_once '../service/ReponseService.php';
require_once '../service/BloggueurService.php';
require_once '../service/UtilisateurService.php';

$ajaxResponse = new AjaxResponse();
$articleService = new ArticleService($db);
$commentaireService = new CommentaireService($db);
$reponseService = new ReponseService($db);
$bloggueurService = new BloggueurService($db);
$utilisateurService = new UtilisateurService($db);
$array = array();

$id = (isset($_GET['bloggueur']))? htmlentities($_GET['bloggueur']):null ;

if(is_null($id)){
    $ajaxResponse->setMessage("mal");
}
else{
    $article = new Article();
    $article = $articleService->findOneArticle($id);

    if(!is_null($article->getId())){
        $arrayCommentaire = array();
        $commentaires = $commentaireService->findAllCommentaireByArticle($article->getId());

        if(!is_null($commentaires)){
            foreach($commentaires as $value){
                $reponses = array();
                $arrayReponse = array();
                $reponses = $reponseService->findAllReponseByCommentaire($value->getId());

                if(!is_null($reponses)){
                    foreach($reponses as $value_1){
                        array_push(
                            $arrayReponse,
                            array('id' => $value_1->getId(),
                                'sujet' => $value_1->getSujet(),
                                'reponse' => $value_1->getMessage(),
                                'date' => $value_1->getDate(),
                                'utilisateur' => $utilisateurService->retourUtilisateur($value_1->getUtilisateur())
                            )
                        );
                    }
                }

                array_push(
                    $arrayCommentaire,
                    array('id' => $value->getId(),
                        'sujet' => $value->getSujet(),
                        'commentaire' => $value->getMessage(),
                        'date' => $value->getDate(),
                        'utilisateur' => $utilisateurService->retourUtilisateur($value->getUtilisateur()),
                        'reponses' => $arrayReponse
                    )
                );
            }
        }
        $bloggueur = $bloggueurService->findOneBloggueur($article->getBloggueur());
        $ajaxResponse->setObjet(
            array('id' => $article->getId(),
                'titre' => $article->getTitre(),
                'libelle' => $article->getLibelle(),
                'datePub' => $article->getDatePub(),
                'dateModif' => $article->getDateModification(),
                'bloggeur' => $bloggueurService->retourBloggueur(
                    $bloggueur->getId(),
                    $utilisateurService->retourUtilisateur($bloggueur->getUtilisateur())
                ),
                'commentaires' => $arrayCommentaire
            )
        );
    }
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);