<?php
include_once '../configuration/configuration.php';
require_once 'CompteUser.php' ;
require_once '../compteConsultant/CompteConsultant.php' ;
require_once '../utilisateur/Utilisateur.php' ;

$cpteUser = new CompteUser() ;
$cpteConsultant = new CompteConsultant() ;
$utilisateur = new Utilisateur() ;

$nomUtilisateur = (isset($_POST['username'])) ? htmlentities($_POST['username']):null ;
$motDePass = (isset($_POST['password'])) ? htmlentities($_POST['password']):null ;
//$sessionEnCours = (isset($_POST['idSession'])) ? htmlentities($_POST['idSession']):null ;
$sessionEnCours = 0 ;

$message = '' ;
$laFonction = '' ;
$tab = array() ;

if($nomUtilisateur && $motDePass){
    $donnee = $cpteUser->getCompteUserByNomUtilisateur($db, $nomUtilisateur) ;

    if(count($donnee) === 0){$message = 'Utilisateur inexistant.' ;}
    elseif(count($donnee) > 1){$message = 'Impossible de se connecter.' ;}
    else{
        $id = '' ;

        foreach($donnee as $value){$leMotPass = $value['motDePasse'];  $laFonction = $value['fonction'];  $id = $value['id'] ;}

        if($motDePass === $leMotPass){
            session_regenerate_id(true);

            if($nomUtilisateur === 'admin'){$_SESSION['username'] = $laFonction ;}
            else{$_SESSION['username'] = $nomUtilisateur ;}

            $_SESSION['id'] = $id ;
            $_SESSION['fonction'] = $laFonction ;
            $_SESSION['notif'] = null;
            session_commit();
            $message = 'ok' ;
        }
        else{$message = 'Mot de Passe incorrect.' ;}
    }
}
elseif($sessionEnCours){
    echo '1<br/><br/>' ;
    $dn_0 = $cpteConsultant->getCompteConsultantByCompteUser($db, $sessionEnCours) ;
    $dn_1 = $utilisateur->getUtilisateurByUser($db, $sessionEnCours) ;

    if(count($dn_0) > 0){
        echo '11<br/><br/>' ;
        if(count($dn_0 >1)){$message = '111' ;}
        else{
            echo '111<br/><br/>' ;
            $tab_0 = array() ;
            foreach($dn_0 as $value){
                $tab_1 = array('username' => $value['nomUtilisateur'],
                    'password' => $value['motDePasse'] ,
                    'idConsult' => $value['idConsultant']
                ) ;
                array_push($tab_0, $tab_1) ;
            }
        }
    }
    elseif(count($dn_1) > 0){
        if(count($dn_1 >1)){$message = '' ;}
        else{
            $tab_0 = array() ;
            foreach($dn_1 as $value){
                $tab_1 = array('nom' => $value['nom'],
                    'prenom' => $value['prenom'] ,
                    'email' => $value['email']
                ) ;
                //array_push($tab_0, $tab_1) ;
                print_r($tab_1) ;  echo 'lala<br/><br/>' ;
            }
        }
        array_push($tab, $tab_0) ;
    }
    else{$message = '' ;}
}
else{$message = 'Nom utilisateur et/ou mot de passe vide' ;}

echo json_encode(['message' => $message,
    'fonction' => $laFonction,
    'table' => $tab
]) ;