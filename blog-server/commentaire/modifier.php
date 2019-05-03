<?php
require_once '../configuration/configuration.php';
require_once '../model/Commentaire.php';
require_once '../model/AjaxResponse.php';
require_once '../service/CommentaireService.php';

$ajaxResponse = new AjaxResponse();
$commentaireService = new CommentaireService($db);

$id = (isset($_POST['idCommentaire']))? htmlentities($_POST['idCommentaire']):null ;
$sujet = (isset($_POST['sujet']))? htmlentities($_POST['sujet']):null ;
$message = (isset($_POST['message']))? htmlentities($_POST['message']):null ;
$article = (isset($_POST['article']))? htmlentities($_POST['article']):null ;
$utilisateur = (isset($_POST['utilisateur']))? htmlentities($_POST['utilisateur']):null ;

if(is_null($message) || is_null($utilisateur) || is_null($article) || is_null($id)){$ajaxResponse->setMessage("case vide");}
else{
    $commentaire = $commentaireService->findOneCommentaire($id);

    if(!is_null($commentaire->getId())){
        $commentaire->setDate(date("Y-m-d H:i:s"));
        $commentaire->setMessage($message);
        $commentaire->setSujet($sujet);
        $commentaire->setArticle($article);
        $commentaire->setUtilisateur($utilisateur);

        $commentaireService->mergeCommentaire($commentaire);
    }
    else{$ajaxResponse->setMessage("Commentaire vide");}
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);