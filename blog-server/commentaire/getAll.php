<?php
require_once '../configuration/configuration.php';
require_once '../model/Commentaire.php';
require_once '../model/AjaxResponse.php';
require_once '../service/CommentaireService.php';
require_once '../service/ArticleService.php';
require_once '../service/BloggueurService.php';
require_once '../service/UtilisateurService.php';

$ajaxResponse = new AjaxResponse();
$commentaireService = new CommentaireService($db);
$articleService = new ArticleService($db);
$bloggueurService = new BloggueurService($db);
$utilisateurService = new UtilisateurService($db);
$array = array();

$commentaires = $commentaireService->findAllCommentaire();

if(!is_null($commentaires)){
    foreach($commentaires as $value){
        $article = $articleService->findOneArticle($value->getArticle());
        $bloggueur = $bloggueurService->findOneBloggueur($article->getBloggueur());

        array_push(
            $array,
            $commentaireService->retourCommentaire(
                $value->getId(),
                $articleService->retourArticle(
                    $article->getId(),
                    $bloggueurService->retourBloggueur(
                        $bloggueur->getId(),
                        $utilisateurService->retourUtilisateur($bloggueur->getUtilisateur())
                    )
                ),
                $utilisateurService->retourUtilisateur($value->getUtilisateur())
            )
        );
    }
    $ajaxResponse->setListe($array);
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);