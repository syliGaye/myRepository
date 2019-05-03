<?php
include_once '../configuration/configuration.php';
require_once 'TypeSession.php';

$typeSession = new TypeSession();

$libelle = (isset($_POST['newLibTypeSession'])? htmlentities($_POST['newLibTypeSession']): null) ;
$nbreHeure = (isset($_POST['nbreHeureCache'])? htmlentities($_POST['nbreHeureCache']): null) ;
$id = (isset($_POST['cacheIdTypeSession'])? htmlentities($_POST['cacheIdTypeSession']): null) ;
$message = '';
$tableJourHeure = array();
$jourHeure = '' ;

if(!$libelle){
    $message = 'Entrer un libellé;';
}
else{
    if($nbreHeure === '0'){
        $message = 'Aucune heure choisie.';
    }
    else{
        $i = 0 ;
        foreach($_POST['checkHeureJour'] as $value){
            array_push($tableJourHeure, $value);
        }

        while($i < count($tableJourHeure)){
            if($i === 0){$jourHeure = $tableJourHeure[$i];}
            else{$jourHeure = $jourHeure.','.$tableJourHeure[$i];}
            $i++;
        }

        $dn = $typeSession->getTypeSessionByLibelle($db, $libelle);
        $dn0 = $typeSession->getTypeSessionByJoursHeures($db, $jourHeure);

        if(count($dn) > 0){
            if(count($dn0) > 0){
                $message = 'Type de Session existant.';
            }
            else{
                $typeSession->mergeTypeSession($db, $id, $libelle, $jourHeure, $nbreHeure);
                $message = 'ok';
            }
        }
        else{
            $typeSession->mergeTypeSession($db, $id, $libelle, $jourHeure, $nbreHeure);
            $message = 'ok';
        }
    }
}

echo json_encode(['message' => $message]) ;