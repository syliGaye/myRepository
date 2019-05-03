<?php
require_once '../repositories/Repository_4.php' ;

class CompteUser {
    private $id ;
    private $nomUtilisateur ;
    private $motDePasse ;
    private $fonction ;

    function __construct()
    {
        $this->fonction = null;
        $this->id = null;
        $this->motDePasse = null;
        $this->nomUtilisateur = null;
    }

    public function getAllCompteUser($db){
        $repository_4 = new Repository_4($db, 'compteuser', 'id', 'nomUtilisateur', 'motDePasse', 'fonction') ;
        return $repository_4->findAll() ;
    }

    public function getCompteUserById($db, $id){
        $repository_4 = new Repository_4($db, 'compteuser', 'id', 'nomUtilisateur', 'motDePasse', 'fonction') ;
        $this->setId($id) ;
        return $repository_4->findById('id', $this->getId()) ;
    }

    public function getCompteUserByNomUtilisateur($db, $nomUtilisateur){
        $repository_4 = new Repository_4($db, 'compteuser', 'id', 'nomUtilisateur', 'motDePasse', 'fonction') ;
        $this->setNomUtilisateur($nomUtilisateur) ;
        return $repository_4->findByValue_1('nomUtilisateur', $this->getNomUtilisateur()) ;
    }

    public function getCompteUserByMotDePasse($db, $motDePasse){
        $repository_4 = new Repository_4($db, 'compteuser', 'id', 'nomUtilisateur', 'motDePasse', 'fonction') ;
        $this->setMotDePasse($motDePasse) ;
        return $repository_4->findByValue_2('motDePasse', $this->getMotDePasse()) ;
    }

    public function getCompteUserByFonction($db, $fonction){
        $repository_4 = new Repository_4($db, 'compteuser', 'id', 'nomUtilisateur', 'motDePasse', 'fonction') ;
        $this->setFonction($fonction) ;
        return $repository_4->findByValue_3('fonction', $this->getFonction()) ;
    }

    public function getCompteUserRowCount($db){
        $repository_4 = new Repository_4($db, 'compteuser', 'id', 'nomUtilisateur', 'motDePasse', 'fonction') ;
        return $repository_4->counts() ;
    }

    public function saveCompteUser($db, $nomUtilisateur, $motDePasse, $fonction){
        $repository_4 = new Repository_4($db, 'compteuser', 'id', 'nomUtilisateur', 'motDePasse', 'fonction') ;
        $donnee = $this->getAllCompteUser($db) ;

        $i = 1;
        if(count($donnee) === 0){$this->setId(0);}
        else{
            foreach($donnee as $valeur){
                if($valeur['id'] != $i){
                    $this->setId($i);
                    break;
                }
                else{$this->setId($i + 1);}
                $i++;
            }
        }

        $this->setNomUtilisateur($nomUtilisateur) ;   $this->setMotDePasse($motDePasse) ;   $this->setFonction($fonction) ;
        $repository_4->save('id', 'nomUtilisateur', 'motDePasse', 'fonction', $this->getId(), $this->getNomUtilisateur(),
            $this->getMotDePasse(), $this->getFonction()) ;
        return $this->getId();
    }

    public function mergeCompteUser($db, $id, $nomUtilisateur, $motDePasse, $fonction){
        $repository_4 = new Repository_4($db, 'compteuser', 'id', 'nomUtilisateur', 'motDePasse', 'fonction') ;
        $this->setId($id) ;   $this->setNomUtilisateur($nomUtilisateur) ;
        $this->setMotDePasse($motDePasse) ;   $this->setFonction($fonction) ;
        return $repository_4->merge('id', 'nomUtilisateur', 'motDePasse', 'fonction', $this->getId(), $this->getNomUtilisateur(),
            $this->getMotDePasse(), $this->getFonction()) ;
    }

    public function removeCompteUser($db, $id){
        $repository_4 = new Repository_4($db, 'compteuser', 'id', 'nomUtilisateur', 'motDePasse', 'fonction') ;
        $this->setId($id) ;
        return $repository_4->remove('id', $this->getId()) ;
    }

    public function removeCompteUserThroughNomUtilisateur($db, $nomUtilisateur){
        $repository_4 = new Repository_4($db, 'compteuser', 'id', 'nomUtilisateur', 'motDePasse', 'fonction') ;
        $this->setNomUtilisateur($nomUtilisateur) ;
        return $repository_4->remove_1('nomUtilisateur', $this->getNomUtilisateur()) ;
    }

    public function removeCompteUserThroughMotDePasse($db, $motDePasse){
        $repository_4 = new Repository_4($db, 'compteuser', 'id', 'nomUtilisateur', 'motDePasse', 'fonction') ;
        $this->setMotDePasse($motDePasse) ;
        return $repository_4->remove_2('motDePasse', $this->getMotDePasse()) ;
    }

    public function removeCompteUserThroughFonction($db, $fonction){
        $repository_4 = new Repository_4($db, 'compteuser', 'id', 'nomUtilisateur', 'motDePasse', 'fonction') ;
        $this->setFonction($fonction) ;
        return $repository_4->remove_3('fonction', $this->getFonction()) ;
    }

    public function getFonction()
    {
        return $this->fonction;
    }

    public function setFonction($fonction)
    {
        $this->fonction = $fonction;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    public function getNomUtilisateur()
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur($nomUtilisateur)
    {
        $this->nomUtilisateur = $nomUtilisateur;
    }
} 