<?php
require_once '../configuration/configuration.php';
require_once '../model/Commentaire.php';
require_once '../model/AjaxResponse.php';
require_once '../service/CommentaireService.php';
require_once '../service/ArticleService.php';
require_once '../service/BloggueurService.php';
require_once '../service/UtilisateurService.php';
require_once '../service/ReponseService.php';

$ajaxResponse = new AjaxResponse();
$commentaireService = new CommentaireService($db);
$articleService = new ArticleService($db);
$bloggueurService = new BloggueurService($db);
$utilisateurService = new UtilisateurService($db);
$reponseService = new ReponseService($db);
$array = array();

$id = (isset($_GET['reponse']))? htmlentities($_GET['reponse']):null ;

if(!is_null($id)){
    $reponse = $reponseService->findOneReponse($id);

    if($reponse->getId()){
        $commentaire = $commentaireService->findOneCommentaire($reponse->getCommentaire());
        $article = $articleService->findOneArticle($commentaire->getArticle());
        $bloggueur = $bloggueurService->findOneBloggueur($article->getBloggueur());

        $ajaxResponse->setObjet(
            $reponseService->retourReponse(
                $reponse->getId(),
                $commentaireService->retourCommentaire(
                    $commentaire->getId(),
                    $articleService->retourArticle(
                        $article->getId(),
                        $bloggueurService->retourBloggueur(
                            $bloggueur->getId(),
                            $utilisateurService->retourUtilisateur($bloggueur->getUtilisateur())
                        )
                    ),
                    $utilisateurService->retourUtilisateur($commentaire->getUtilisateur())
                ),
                $utilisateurService->retourUtilisateur($reponse->getUtilisateur())
            )
        );
    }
    else{$ajaxResponse->setMessage("reponse vide");}
}
else{$ajaxResponse->setMessage("mal");}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);