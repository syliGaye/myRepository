<?php
require_once '../configuration/configuration.php';
require_once '../model/Commentaire.php';
require_once '../model/AjaxResponse.php';
require_once '../service/CommentaireService.php';

$ajaxResponse = new AjaxResponse();
$commentaireService = new CommentaireService($db);

$sujet = (isset($_POST['sujet']))? htmlentities($_POST['sujet']):null ;
$message = (isset($_POST['message']))? htmlentities($_POST['message']):null ;
$article = (isset($_POST['article']))? htmlentities($_POST['article']):null ;
$utilisateur = (isset($_POST['utilisateur']))? htmlentities($_POST['utilisateur']):null ;

if(is_null($message) || is_null($utilisateur) || is_null($article)){$ajaxResponse->setMessage("case vide");}
else{
    $commentaire = new Commentaire();
    $commentaire->setDate(date("Y-m-d H:i:s"));
    $commentaire->setMessage($message);
    $commentaire->setSujet($sujet);
    $commentaire->setArticle($article);
    $commentaire->setUtilisateur($utilisateur);

    $commentaireService->saveCommentaire($commentaire);
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);