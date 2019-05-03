<?php
require_once '../configuration/configuration.php';
require_once '../model/Commentateur.php';
require_once '../model/AjaxResponse.php';
require_once '../service/CommentateurService.php';
require_once '../service/UtilisateurService.php';

$ajaxResponse = new AjaxResponse();
$commentateurService = new CommentateurService($db);
$utilisateurService = new UtilisateurService($db);
$array = array();

$id = (isset($_GET['commentaire']))? htmlentities($_GET['commentaire']):null ;

if(!is_null($id)){
    $commentateur = $commentateurService->findOneCommentateur($id);

    if(!is_null($commentateur->getId())){
        $ajaxResponse->setObjet(
            $commentateurService->retourCommentaire(
                $commentateur->getId(),
                $utilisateurService->retourUtilisateur($commentateur->getUtilisateur())
            )
        );
    }
}
else{$ajaxResponse->setMessage("mal");}

echo json_encode(['message' => $ajaxResponse->getMessage(),
    'objet' => $ajaxResponse->getObjet(),
    'liste' => $ajaxResponse->getListe()
]);