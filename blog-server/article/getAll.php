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
$array = array();

$articles = $articleService->findAllArticle();

if(!is_null($articles)){
    foreach($articles as $value){
        $bloggueur = $bloggueurService->findOneBloggueur($value->getBloggueur());
        array_push(
            $array,
            $articleService->retourArticle(
                $value->getId(),
                $bloggueurService->retourBloggueur(
                    $bloggueur->getId(),
                    $utilisateurService->retourUtilisateur($bloggueur->getUtilisateur())
                )
            )
        );
    }
    $ajaxResponse->setListe($array);
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);