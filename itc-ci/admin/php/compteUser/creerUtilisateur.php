<?php
require_once '../configuration/configuration.php';
require_once 'CompteUser.php';
require_once '../utilisateur/Utilisateur.php';
require_once '../compteConsultant/CompteConsultant.php';
require_once '../consultant/Consultant.php';
include_once '../MailsFunctions.php';

$cpteUser = new CompteUser();
$cpteConsult = new CompteConsultant();
$utilisateur = new Utilisateur();
$consult = new Consultant();

$username = (isset($_POST['utilisateurUsername'])) ? htmlentities($_POST['utilisateurUsername']):null ;
$pass = (isset($_POST['utilisateurPass'])) ? htmlentities($_POST['utilisateurPass']):null ;
$verifConsult = (isset($_POST['userSelectConsult'])) ? htmlentities($_POST['userSelectConsult']):null ;
$nom = (isset($_POST['utilisateurNom'])) ? htmlentities($_POST['utilisateurNom']):null ;
$prenoms = (isset($_POST['utilisateurPrenom'])) ? htmlentities($_POST['utilisateurPrenom']):null ;
$email = (isset($_POST['utilisateurEmail'])) ? htmlentities($_POST['utilisateurEmail']):null ;
$tel = (isset($_POST['utilisateurPhone'])) ? htmlentities($_POST['utilisateurPhone']):null ;
$selConsultant = (isset($_POST['utilisateurSelectConsultant'])) ? htmlentities($_POST['utilisateurSelectConsultant']):null ;

$message = '';

if($verifConsult){
    $donnee = $cpteUser->getCompteUserByNomUtilisateur($db, $username);

    if(count($donnee) > 0){$message = 'Utilisateur existant.';}
    else{
        $objet = 'CREATION DE COMPTE UTILISATEUR';

        if($verifConsult === 'non'){
            $id = $cpteUser->saveCompteUser($db, $username, $pass, 'gestionnaire');
            $utilisateur->saveUtilisateur($db, $nom, $prenoms, $email, $tel, $id);
            $corps = '<html><head></head><body>Bonjour Mme/Mlle/M '.$nom.' '.$prenoms.'. Votre compte utilisateur vient d\'&ecirc;tre cr&eacute;er.<br/>' ;
            $corps .= 'Username = '.$username.'<br/>' ;
            $corps .= 'Password = '.$pass.'<br/>';
            $corps .= 'Veuillez cliquer sur le <a href="localhost/ITC_Final/admin">lien</a> afin de vous connecter.</body></html>';

            getMailReservation($email, $objet, $corps);

            $message = 'ok' ;
        }
        else{
            $nomConsult = ''; $prenomConsult = ''; $emailConsult = '';
            $dn_0 = $cpteConsult->getCompteConsultantByConsultant($db, $selConsultant);
            $dn_1 = $consult->getConsultantById($db, $selConsultant);

            foreach($dn_1 as $value){$nomConsult = $value['nom']; $prenomConsult = $value['prenoms']; $emailConsult = $value['email'];}

            if(count($dn_0) > 0){$message = 'Consultant deja enresgistré.';}
            else{
                $id = $cpteUser->saveCompteUser($db, $username, $pass, 'consultant');
                $cpteConsult->saveCompteConsultant($db, $username, $pass, $selConsultant, $id);
                $corps = '<html><head></head><body>Bonjour Mme/Mlle/M '.$nomConsult.' '.$prenomConsult.'. Votre compte utilisateur vient d\'&ecirc;tre cr&eacute;er.<br/>' ;
                $corps .= 'Username = '.$username.'<br/>' ;
                $corps .= 'Password = '.$pass.'<br/>';
                $corps .= 'Veuillez cliquer sur le <a href="localhost/ITC_Final/admin">lien</a> afin de vous connecter.</body></html>';

                getMailReservation($email, $objet, $corps);
                $message = 'ok';
            }
        }
    }
}
else{$message = 'Aucune donn&eacute;e';}

echo json_encode(['message' => $message]);