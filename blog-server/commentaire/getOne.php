<?php
require_once '../configuration/configuration.php';
require_once '../model/Bloggueur.php';
require_once '../model/AjaxResponse.php';
require_once '../service/CommentaireService.php';
require_once '../service/ArticleService.php';
require_once '../service/UtilisateurService.php';
require_once '../service/BloggueurService.php';

$ajaxResponse = new AjaxResponse();
$commentaireService = new CommentaireService($db);
$articleService = new ArticleService($db);
$utilisateurService = new UtilisateurService($db);
$bloggueurService = new BloggueurService($db);

$id = (isset($_GET['commentaire']))? htmlentities($_GET['commentaire']):null ;

if(is_null($id)){$ajaxResponse->setMessage("mal");}
else{
    $commentaire = $commentaireService->findOneCommentaire($id);

    if(!is_null($commentaire->getId())){
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