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

$bloggueurs = $bloggueurService->findAllBloggueur();

if(!is_null($bloggueurs)){
    foreach($bloggueurs as $value){
        $arrayArticle = array();
        $articles = array();
        $articles = $articleService->findAllArticleByBloggueur($value->getId());

        if(!is_null($articles)){
            foreach($articles as $value_1){
                $arrayCommentaire = array();
                $commentaires = $commentaireService->findAllCommentaireByArticle($value_1->getId());

                if(!is_null($commentaires)){
                    foreach($commentaires as $value_2){
                        $reponses = array();
                        $arrayReponse = array();
                        $reponses = $reponseService->findAllReponseByCommentaire($value_2->getId());

                        if(!is_null($reponses)){
                            foreach($reponses as $value_3){
                                array_push(
                                    $arrayReponse,
                                    array('id' => $value_3->getId(),
                                        'sujet' => $value_3->getSujet(),
                                        'reponse' => $value_3->getMessage(),
                                        'date' => $value_3->getDate(),
                                        'utilisateur' => $utilisateurService->retourUtilisateur($value_3->getUtilisateur())
                                    )
                                );
                            }
                        }

                        array_push(
                            $arrayCommentaire,
                            array('id' => $value_2->getId(),
                                'sujet' => $value_2->getSujet(),
                                'commentaire' => $value_2->getMessage(),
                                'date' => $value_2->getDate(),
                                'utilisateur' => $utilisateurService->retourUtilisateur($value_2->getUtilisateur()),
                                'reponses' => $arrayReponse
                            )
                        );
                    }
                }
                array_push(
                    $arrayArticle,
                    array('id' => $value_1->getId(),
                        'titre' => $value_1->getTitre(),
                        'libelle' => $value_1->getLibelle(),
                        'datePub' => $value_1->getDatePub(),
                        'dateModif' => $value_1->getDateModification(),
                        'commentaires' => $arrayCommentaire
                    )
                );
            }
        }

        array_push(
            $array,
            array('id' => $value->getId(),
                'nom' => $value->getNom(),
                'prenoms' => $value->getPrenoms(),
                'utilisateur' => $utilisateurService->retourUtilisateur($value->getUtilisateur()),
                'articles' => $arrayArticle
            )
        );
    }

    $ajaxResponse->setListe($array);
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);