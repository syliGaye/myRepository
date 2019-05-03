<?php
include_once '../configuration/configuration.php';
require_once 'CompteUser.php' ;
require_once '../compteConsultant/CompteConsultant.php' ;
require_once '../utilisateur/Utilisateur.php' ;
require_once '../consultant/Consultant.php' ;

$cpteUser = new CompteUser() ;
$cpteConsultant = new CompteConsultant() ;
$utilisateur = new Utilisateur() ;
$consult = new Consultant() ;

$sessionEnCours = (isset($_GET['idSession'])) ? htmlentities($_GET['idSession']):null ;

$message = '' ;
$tab = array() ;

if($sessionEnCours){
    $dn_0 = $cpteConsultant->getCompteConsultantByCompteUser($db, $sessionEnCours) ;
    $dn_1 = $utilisateur->getUtilisateurByUser($db, $sessionEnCours) ;

    if(count($dn_0) > 0){
        if(count($dn_0) > 1){$message = 'Utilisateur multiple.' ;}
        else{
            $idConsultant = '';   $nom = '';   $prenom = '';
            $tel = '';   $email = '';

            foreach($dn_0 as $value){$idConsultant = $value['idConsultant'];}

            $dn_2 = $consult->getConsultantById($db, $idConsultant) ;

            foreach($dn_2 as $value){
                $nom = $value['nom'];   $prenom = $value['prenoms'];
                $tel = $value['telephone'];   $email = $value['email'];
            }

            foreach($dn_0 as $value){
                $tab = array('nom' => $nom,
                    'prenom' => $prenom ,
                    'email' => $email,
                    'tel' => $tel,
                    'user' => $value['nomUtilisateur'],
                    'fonction' => $value['fonction']
                ) ;
            }
            $message = 'ok' ;
        }
    }
    elseif(count($dn_1) > 0){
        if(count($dn_1) > 1){$message = 'Utilisateur multiple.' ;}
        else{
            $user = '' ;   $fonction = '';
            $dn_2 = $cpteUser->getCompteUserById($db, $sessionEnCours) ;

            foreach($dn_2 as $value){$user = $value['nomUtilisateur'];   $fonction = $value['fonction'];}

            foreach($dn_1 as $value){
                $tab = array('nom' => $value['nom'],
                    'prenom' => $value['prenom'] ,
                    'email' => $value['email'],
                    'tel' => $value['telephone'],
                    'user' => $user,
                    'fonction' => $fonction
                ) ;
            }
            $message = 'ok' ;
        }
    }
    else{$message = 'Utilisateur introuvable.' ;}
}
else{$message = 'Nom utilisateur et/ou mot de passe vide' ;}

echo json_encode(['message' => $message,
    'data' => $tab
]) ;