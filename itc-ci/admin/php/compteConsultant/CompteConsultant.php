<?php
require_once '../repositories/Repository_5.php' ;

class CompteConsultant {
    private $id;
    private $nomUtilisateur;
    private $motDePasse;
    private $idConsultant;
    private $idCompteUser ;

    function __construct(){
        $this->id = null;
        $this->idConsultant = null;
        $this->motDePasse = null;
        $this->nomUtilisateur = null;
        $this->idCompteUser = null ;
    }

    public function getAllCompteConsultant($db){
        $repository_5 = new Repository_5($db, 'compteconsultant', 'id', 'nomUtilisateur', 'motDePasse', 'idConsultant', 'idCompteUser') ;
        return $repository_5->findAll();
    }

    public function getCompteConsultantById($db, $id){
        $repository_5 = new Repository_5($db, 'compteconsultant', 'id', 'nomUtilisateur', 'motDePasse', 'idConsultant', 'idCompteUser') ;
        $this->setId($id) ;
        return $repository_5->findById('id', $this->getId());
    }

    public function getCompteConsultantRowCount($db){
        $repository_5 = new Repository_5($db, 'compteconsultant', 'id', 'nomUtilisateur', 'motDePasse', 'idConsultant', 'idCompteUser') ;
        return $repository_5->counts();
    }

    public function getCompteConsultantByUsername($db, $nomUtilisateur){
        $repository_5 = new Repository_5($db, 'compteconsultant', 'id', 'nomUtilisateur', 'motDePasse', 'idConsultant', 'idCompteUser') ;
        $this->setNomUtilisateur($nomUtilisateur) ;
        return $repository_5->findByValue_1('nomUtilisateur', $this->getNomUtilisateur());
    }

    public function getCompteConsultantByConsultant($db, $idConsultant){
        $repository_5 = new Repository_5($db, 'compteconsultant', 'id', 'nomUtilisateur', 'motDePasse', 'idConsultant', 'idCompteUser') ;
        $this->setIdConsultant($idConsultant);
        return $repository_5->findByValue_3('idConsultant', $this->getIdConsultant());
    }

    public function getCompteConsultantByCompteUser($db, $idCompteUser){}

    public function saveCompteConsultant($db, $nomUtilisateur, $motDePasse, $idConsultant, $idCompteUser){
        $repository_5 = new Repository_5($db, 'compteconsultant', 'id', 'nomUtilisateur', 'motDePasse', 'idConsultant', 'idCompteUser') ;
        $donnee = $this->getAllCompteConsultant($db);
        $i = 1;
        if(count($donnee) === 0){$this->setId(1);}
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

        $this->setNomUtilisateur($nomUtilisateur);  $this->setIdCompteUser($idCompteUser) ;
        $this->setMotDePasse($motDePasse);  $this->setIdConsultant($idConsultant);

        return $repository_5->save('id', 'nomUtilisateur', 'motDePasse', 'idConsultant', 'idCompteUser',
            $this->getId(), $this->getNomUtilisateur(), $this->getMotDePasse(), $this->getIdConsultant(), $this->getIdCompteUser());
    }

    public function mergeCompteConsultant($db, $id, $nomUtilisateur, $motDePasse, $idConsultant, $idCompteUser){
        $repository_5 = new Repository_5($db, 'compteconsultant', 'id', 'nomUtilisateur', 'motDePasse', 'idConsultant', 'idCompteUser') ;
        $this->setId($id);  $this->setNomUtilisateur($nomUtilisateur);  $this->setIdCompteUser($idCompteUser) ;
        $this->setMotDePasse($motDePasse);  $this->setIdConsultant($idConsultant);

        return $repository_5->merge('id', 'nomUtilisateur', 'motDePasse', 'idConsultant', 'idCompteUser',
            $this->getId(), $this->getNomUtilisateur(), $this->getMotDePasse(), $this->getIdConsultant(), $this->getIdCompteUser());
    }

    public function removeCompteConsultant($db, $id){
        $repository_5 = new Repository_5($db, 'compteconsultant', 'id', 'nomUtilisateur', 'motDePasse', 'idConsultant', 'idCompteUser') ;
        $this->setId($id);
        return $repository_5->remove('id', $this->getId());
    }

    public function removeCompteConsultantThroughUsername($db, $nomUtilisateur){
        $repository_5 = new Repository_5($db, 'compteconsultant', 'id', 'nomUtilisateur', 'motDePasse', 'idConsultant', 'idCompteUser') ;
        $this->setNomUtilisateur($nomUtilisateur);
        return $repository_5->remove_1('nomUtilisateur', $this->getNomUtilisateur());
    }

    public function removeCompteConsultantThroughConsultant($db, $idConsultant){
        $repository_5 = new Repository_5($db, 'compteconsultant', 'id', 'nomUtilisateur', 'motDePasse', 'idConsultant', 'idCompteUser') ;
        $this->setIdConsultant($idConsultant);
        return $repository_5->remove_3('idConsultant', $this->getIdConsultant());
    }

    public function removeCompteConsultantThroughUser($db, $idCompteUser){
        $repository_5 = new Repository_5($db, 'compteconsultant', 'id', 'nomUtilisateur', 'motDePasse', 'idConsultant', 'idCompteUser') ;
        $this->setIdCompteUser($idCompteUser) ;
        return $repository_5->remove_4('idCompteUser', $this->getIdCompteUser()) ;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdConsultant()
    {
        return $this->idConsultant;
    }

    public function setIdConsultant($idConsultant)
    {
        $this->idConsultant = $idConsultant;
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

    public function getIdCompteUser()
    {
        return $this->idCompteUser;
    }

    public function setIdCompteUser($idCompteUser)
    {
        $this->idCompteUser = $idCompteUser;
    }
} 