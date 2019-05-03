<?php
include_once 'fonctions.php';

$nom = (isset($_GET['nom']))? htmlentities($_GET['nom']):null;
$email = (isset($_GET['email']))? htmlentities($_GET['email']):null;
$msg = (isset($_GET['msg']))? htmlentities($_GET['msg']):null;

$message = '';
$tabMsg = array();

if($msg){
$objet = 'SUGGESTIONS';
$contenu = '<html><head></head><body>';
$tabMsg = explode('\n', $msg);

foreach($tabMsg as $value){$contenu .= $value.'<br/>';}

$contenu .= '</body></html>';

if(envoyerMail2($email, $nom, $objet, $contenu) === true){$message = 'ok';}
else $message = 'Echec dans l\'envoi du message !';
}
else $message = 'Message non pris en charge !';

echo json_encode([
    'message' => $message,
    'data' => $msg
]);