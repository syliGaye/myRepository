<?php
require_once '../configuration/configuration.php';
require_once 'CompteUser.php';
require_once '../compteConsultant/CompteConsultant.php';
require_once '../consultant/Consultant.php';
require_once '../utilisateur/Utilisateur.php';

$cpteUser = new CompteUser();
$cpteConsultant = new CompteConsultant();
$consultant = new Consultant();
$utilisateur = new Utilisateur();

$nom = (isset($_POST['profilFirstName'])) ? htmlentities($_POST['profilFirstName']):null ;
$prenom = (isset($_POST['profilLastName'])) ? htmlentities($_POST['profilLastName']):null ;
$tel = (isset($_POST['profilPhone'])) ? htmlentities($_POST['profilPhone']):null ;
$email = (isset($_POST['profilEmail'])) ? htmlentities($_POST['profilEmail']):null ;
$newPass = (isset($_POST['profilNewPassword'])) ? htmlentities($_POST['profilNewPassword']):null ;
$id = (isset($_POST['idDeLaSession'])) ? htmlentities($_POST['idDeLaSession']):null ;
$userName = (isset($_POST['profilUsername'])) ? htmlentities($_POST['profilUsername']):null ;
$message = '';

$dn_0 = $cpteConsultant->getCompteConsultantById($db, $id) ;
$dn_1 = $utilisateur->getUtilisateurById($db, $id) ;

if(count($dn_0) !== 0){
    $idConsult = '';

    foreach($dn_0 as $value){$idConsult = $value['idConsultant'];}

    $dn_2 = $consultant->getConsultantById($db, $idConsult);
    $dateNaissance = '';   $nationalite = '';   $profession = '';   $employeur = '';   $fonction = '';   $lieuHabitation = '';

    foreach($dn_2 as $value){
        $dateNaissance = $value['dateNaissance'];   $nationalite = $value['nationalite'];
        $profession = $value['profession'];   $employeur = $value['employeur'];
        $fonction = $value['fonction'];   $lieuHabitation = $value['lieuHabitation'];
    }

    $consultant->mergeConsultant($db, $idConsult, $nom, $prenom, $dateNaissance, $nationalite, $profession, $employeur, $fonction, $lieuHabitation, $tel, $email);

    if(!$newPass){$message = 'ok';}
    else{
        $cpteConsultant->mergeCompteConsultant($db, $id, $userName, $newPass, $idConsult, $id);
        $cpteUser->mergeCompteUser($db, $id, $userName, $newPass, 'consultant');
        unset($_SESSION['username'], $_SESSION['userid']);
        $message = 'okNew';
    }
}
elseif(count($dn_1) !== 0){
    $utilisateur->mergeUtilisateur($db, $id, $nom, $prenom, $email, $tel, $id) ;

    if(!$newPass){$message = 'ok';}
    else{
        $fonction = '';
        $dn_2 = $cpteUser->getCompteUserById($db, $id);

        foreach($dn_2 as $value){$fonction = $value['fonction'];}

        $cpteUser->mergeCompteUser($db, $id, $userName, $newPass, $fonction) ;
        unset($_SESSION['username'], $_SESSION['userid']);
        $message = 'okNew';
    }
}
else{$message = 'Ce n\'est pas possible.';}

echo json_encode(['message' => $message]);