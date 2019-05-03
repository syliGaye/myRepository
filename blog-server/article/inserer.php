<?php
require_once '../configuration/configuration.php';
require_once '../model/Article.php';
require_once '../model/AjaxResponse.php';
require_once '../service/ArticleService.php';

$article = new Article();
$ajaxResponse = new AjaxResponse();
$articleService = new ArticleService($db);

$titre = (isset($_POST['titre']))? htmlentities($_POST['titre']):null ;
$libelle = (isset($_POST['libelle']))? htmlentities($_POST['libelle']):null ;
$bloggueur = (isset($_POST['bloggueur']))? htmlentities($_POST['bloggueur']):null ;

if(($bloggueur === null) || ($libelle === null) || ($titre === null)){$ajaxResponse->setMessage("case vide");}
else{
    $article->setDateModification(date("Y-m-d H:i:s"));
    $article->setDatePub(date("Y-m-d H:i:s"));
    $article->setBloggueur($bloggueur);
    $article->setLibelle($libelle);
    $article->setTitre($titre);

    $article_1 = $articleService->findOneArticleByTitre($article->getTitre());

    if($article_1->getTitre() === $article->getTitre()){
        $ajaxResponse->setMessage("titre existe");
    }
    else{$articleService->saveArticle($article);}
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);