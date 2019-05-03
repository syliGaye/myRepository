<?php
include_once '../configuration/configuration.php';
require_once 'Consultant.php';
require_once '../specialite/Specialite.php';
require_once '../competences/Competences.php';
require_once '../disponibilite/Disponibilite.php';
require_once '../formation/Formation.php';

$consultant = new Consultant();
$competence = new Competences();
$dispo = new Disponibilite();
$special = new Specialite();
$forma = new Formation();

$idDispo = '';   $dateDebutDispo = '';   $dateFinDispo = '';   $jrsHrsDispo = '';
$idSpecial = '';   $lastDiplomeObt = '';   $certifObt = '';

$dnCompe1 = array() ;
$tab1 = array();
$tab2 = array();

$donnee = $consultant->getAllConsultant($db);
$i = 0;
foreach($donnee as $valeur){
    $dnCompe = $competence->getCompetencesByConsultants($db, $valeur['id']);
    $dnDispo = $dispo->getDisponibiliteByConsultant($db, $valeur['id']);
    $dnSpecial = $special->getSpecialiteByConsultant($db, $valeur['id']);

    foreach($dnDispo as $value_1){
        $idDispo = $value_1['id'];   $dateDebutDispo = $value_1['dateDebut'];
        $dateFinDispo = $value_1['dateFin'];   $jrsHrsDispo = $value_1['jrsHrsDispo'];
    }

    foreach($dnSpecial as $value_1){
        $idSpecial = $value_1['id'];   $lastDiplomeObt = $value_1['lastDiplomeObt'];   $certifObt = $value_1['certificationObt'];
    }

    $tab = array('id' => $valeur['id'],
        'nom' => $valeur['nom'],
        'prenoms' => $valeur['prenoms'],
        'dateNaiss' => $valeur['dateNaissance'],
        'nationalite' => $valeur['nationalite'],
        'telephone' => $valeur['telephone'],
        'email' => $valeur['email'],
        'fonction' => $valeur['fonction'],
        'profession' => $valeur['profession'],
        'employeur' => $valeur['employeur'],
        'lieu' => $valeur['lieuHabitation'],
        'idDispo' => $idDispo,
        'debDispo' => $dateDebutDispo,
        'finDispo' => $dateFinDispo,
        'idSpecial' => $idSpecial,
        'lastDipl' => $lastDiplomeObt,
        'certifObt' => $certifObt
    );
    array_push($tab1, $tab);
    /*foreach($dnDispo as $valDispo){

        foreach($dnSpecial as $valSpecial){
            if(count($dnCompe) > 0){
                $array_1 = array();
                foreach($dnCompe as $valCompe){
                    if($valCompe['idConsultant'] === $valeur['id']){
                        array_push($array_1, $forma->getFormationById($db, $valCompe['idFormation']));
                    }
                    $dnCompe1 = $array_1;
                    $dnCompe1 = $forma->getFormationById($db, $valCompe['idFormation']);
                    foreach($dnCompe1 as $key => $valFormation){
                        $tab = array(
                            'idCompet' => $valCompe['id'],
                            'idForma' => $valCompe['idFormation'],
                            'idConsul' => $valCompe['idConsultant'],
                            'formation' => $valFormation['titre'],
                            'certif' => $valFormation['certifDeFormation']
                        );
                        array_push($tab2, $tab);
                    }
                }
            }

            $tab = array('id' => $valeur['id'],
                'nom' => $valeur['nom'],
                'prenoms' => $valeur['prenoms'],
                'dateNaiss' => $valeur['dateNaissance'],
                'nationalite' => $valeur['nationalite'],
                'telephone' => $valeur['telephone'],
                'email' => $valeur['email'],
                'fonction' => $valeur['fonction'],
                'profession' => $valeur['profession'],
                'employeur' => $valeur['employeur'],
                'lieu' => $valeur['lieuHabitation'],
                'idDispo' => $valDispo['id'],
                'debDispo' => $valDispo['dateDebut'],
                'finDispo' => $valDispo['dateFin'],
                'idSpecial' => $valSpecial['id'],
                'lastDipl' => $valSpecial['lastDiplomeObt'],
                'certifObt' => $valSpecial['certificationObt']
            );
            array_push($tab1, $tab);
        }
    }
    $i++;*/
}

echo json_encode(['data' => $tab1,
    'data_1' => $tab2
]) ;