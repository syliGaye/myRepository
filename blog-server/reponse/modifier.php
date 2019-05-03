<?php
require_once '../configuration/configuration.php';
require_once '../model/Reponse.php';
require_once '../model/AjaxResponse.php';
require_once '../service/ReponseService.php';

$ajaxResponse = new AjaxResponse();
$reponseService = new ReponseService($db);

$id = (isset($_POST['idReponse']))? htmlentities($_POST['idReponse']):null ;
$sujet = (isset($_POST['sujet']))? htmlentities($_POST['sujet']):null ;
$message = (isset($_POST['message']))? htmlentities($_POST['message']):null ;
$commentaire = (isset($_POST['commentaire']))? htmlentities($_POST['commentaire']):null ;
$utilisateur = (isset($_POST['utilisateur']))? htmlentities($_POST['utilisateur']):null ;

if(is_null($message) || is_null($utilisateur) || is_null($commentaire) || is_null($id)){$ajaxResponse->setMessage("case vide");}
else{
    $reponse = $reponseService->findOneReponse($id);

    if(!is_null($reponse->getId())){
        $reponse->setDate(date("Y-m-d H:i:s"));
        $reponse->setMessage($message);
        $reponse->setSujet($sujet);
        $reponse->setCommentaire($commentaire);
        $reponse->setUtilisateur($utilisateur);

        $reponseService->mergeReponse($reponse);
    }
    else{$ajaxResponse->setMessage("reponse vide");}
}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);