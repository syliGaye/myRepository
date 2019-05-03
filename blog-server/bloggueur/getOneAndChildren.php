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

$id = (isset($_GET['bloggueur']))? htmlentities($_GET['bloggueur']):null ;

if(is_null($id)){$ajaxResponse->setMessage("mal");}
else{
    $bloggueur = new Bloggueur();
    $bloggueur = $bloggueurService->findOneBloggueur($id);

    if(!is_null($bloggueur->getId())){
        $arrayArticle = array();
        $articles = $articleService->findAllArticleByBloggueur($bloggueur->getId());

        if(!is_null($articles)){
            foreach($articles as $value){
                $arrayCommentaire = array();
                $commentaires = $commentaireService->findAllCommentaireByArticle($value->getId());

                if(!is_null($commentaires)){
                    foreach($commentaires as $value_1){
                        $reponses = array();
                        $arrayReponse = array();
                        $reponses = $reponseService->findAllReponseByCommentaire($value_1->getId());

                        if(!is_null($reponses)){
                            foreach($reponses as $value_2){
                                array_push(
                                    $arrayReponse,
                                    array('id' => $value_2->getId(),
                                        'sujet' => $value_2->getSujet(),
                                        'reponse' => $value_2->getMessage(),
                                        'date' => $value_2->getDate(),
                                        'utilisateur' => $utilisateurService->retourUtilisateur($value_2->getUtilisateur())
                                    )
                                );
                            }
                        }

                        array_push(
                            $arrayCommentaire,
                            array('id' => $value_1->getId(),
                                'sujet' => $value_1->getSujet(),
                                'commentaire' => $value_1->getMessage(),
                                'date' => $value_1->getDate(),
                                'utilisateur' => $utilisateurService->retourUtilisateur($value_1->getUtilisateur()),
                                'reponses' => $arrayReponse
                            )
                        );
                    }
                }
                array_push(
                    $arrayArticle,
                    array('id' => $value->getId(),
                        'titre' => $value->getTitre(),
                        'libelle' => $value->getLibelle(),
                        'datePub' => $value->getDatePub(),
                        'dateModif' => $value->getDateModification(),
                        'commentaires' => $arrayCommentaire
                    )
                );
            }
        }

        $ajaxResponse->setObjet(array('id' => $bloggueur->getId(),
            'nom' => $bloggueur->getNom(),
            'prenoms' => $bloggueur->getPrenoms(),
            'utilisateur' => $utilisateurService->retourUtilisateur($bloggueur->getUtilisateur()),
            'articles' => $arrayArticle
        ));
    }
    else{$ajaxResponse->setMessage("bloggueur vide");}
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);