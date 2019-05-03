<?php
require_once '../configuration/configuration.php';
require_once 'CompteUser.php';
require_once '../utilisateur/Utilisateur.php';
require_once '../compteConsultant/CompteConsultant.php';
require_once '../consultant/Consultant.php';

$cpteUser = new CompteUser();
$cpteConsult = new CompteConsultant();
$utilisateur = new Utilisateur();
$consult = new Consultant();

$tab = array();
$message = '';

$donnee = $cpteUser->getAllCompteUser($db);

foreach($donnee as $value){
    $nom = '';   $prenoms = '';   $email = '';   $tel = '';
    if($value['fonction'] !== 'Administrateur'){
        $dn_0 = $cpteConsult->getCompteConsultantByCompteUser($db, $value['id']) ;
        $dn_1 = $utilisateur->getUtilisateurByUser($db, $value['id']);

        if(count($dn_0) > 0){
            if(count($dn_0) > 1){$message = 'erreur 12';}
            else{
                $idConsult = '' ;
                foreach($dn_0 as $value_1){
                    $idConsult = $value_1['idConsultant'];
                }

                $dn_2 = $consult->getConsultantById($db, $idConsult);

                foreach($dn_2 as $value_1){
                    $nom = $value_1['nom'];   $prenoms = $value_1['prenoms'];
                    $email = $value_1['email'];   $tel = $value_1['telephone'];
                }
            }
        }
        elseif(count($dn_1) > 0){
            if(count($dn_1) > 1){$message = 'erreur 22';}
            else{
                foreach($dn_1 as $value_1){
                    $nom = $value_1['nom'];   $prenoms = $value_1['prenom'];
                    $email = $value_1['email'];   $tel = $value_1['telephone'];
                }
            }
        }
        else{$message = 'erreur 1';}

        $tab_0 = array('id' => $value['id'],
            'nomUtilisateur' => $value['nomUtilisateur'],
            'motDePasse' => $value['motDePasse'],
            'nom' => $nom,
            'prenoms' => $prenoms,
            'mail' => $email,
            'phone' => $tel,
            'fonction' => $value['fonction']
        );

        array_push($tab, $tab_0);
    }
}

echo json_encode(['message' => $message,
    'data' => $tab
]);