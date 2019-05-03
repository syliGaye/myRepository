<?php
require_once '../configuration/configuration.php';
require_once '../model/Article.php';
require_once '../model/AjaxResponse.php';
require_once '../service/ArticleService.php';
require_once '../service/BloggueurService.php';
require_once '../service/UtilisateurService.php';

$article = new Article();
$ajaxResponse = new AjaxResponse();
$articleService = new ArticleService($db);
$bloggueurService = new BloggueurService($db);
$utilisateurService = new UtilisateurService($db);

$id = (isset($_GET['article']))? htmlentities($_GET['article']):null ;

if(is_null($id)){
    $ajaxResponse->setMessage("mal");
}
else{
    $article = $articleService->findOneArticle($id);

    if(!is_null($article->getId())){
        $bloggueur = $bloggueurService->findOneBloggueur($article->getBloggueur());

        $ajaxResponse->setObjet($articleService->retourArticle(
            $id,
            $bloggueurService->retourBloggueur(
                $bloggueur->getId(),
                $utilisateurService->retourUtilisateur($bloggueur->getUtilisateur())
            )
        ));
    }
    else{$ajaxResponse->setMessage("article vide");}
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);