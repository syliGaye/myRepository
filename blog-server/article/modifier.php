<?php
require_once '../configuration/configuration.php';
require_once '../model/Article.php';
require_once '../model/Commentaire.php';
require_once '../model/Reponse.php';
require_once '../model/AjaxResponse.php';
require_once '../service/ArticleService.php';
require_once '../service/CommentaireService.php';
require_once '../service/ReponseService.php';

$ajaxResponse = new AjaxResponse();
$articleService = new ArticleService($db);
$commentaireService = new CommentaireService($db);
$reponseService = new ReponseService($db);

$id = (isset($_POST['idArticle']))? htmlentities($_POST['idArticle']):null;
$titre = (isset($_POST['titre']))? htmlentities($_POST['titre']):null ;
$libelle = (isset($_POST['libelle']))? htmlentities($_POST['libelle']):null ;
$bloggueur = (isset($_POST['bloggueur']))? htmlentities($_POST['bloggueur']):null ;

if(is_null($id) || is_null($bloggueur) || is_null($libelle) || is_null($titre)){$ajaxResponse->setMessage("case vide");}
else{
    $article = new Article();
    $article = $articleService->findOneArticle($id);

    if(!is_null($article->getId())){
        $article->setDateModification(date("Y-m-d H:i:s"));
        $article->setBloggueur($bloggueur);
        $article->setLibelle($libelle);
        $article->setTitre($titre);

        $articleService->mergeArticle($article);
    }
    else{$ajaxResponse->setMessage("Article vide");}
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);