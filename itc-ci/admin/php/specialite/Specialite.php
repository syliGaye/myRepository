<?php
require_once '../repositories/Repository_4.php';

class Specialite {
    private $id ;
    private $lastDiplomeObt ;
    private $certifObt ;
    private $idConsultant ;

    function __construct()
    {
        $this->id = null ;
        $this->lastDiplomeObt = null ;
        $this->certifObt = null ;
        $this->idConsultant = null ;
    }

    public function getAllSpecialite($db){
        $repository = new Repository_4($db, 'specialite', 'id', 'lastDiplomeObt', 'certificationObt', 'idConsultant') ;
        return $repository->findAll() ;
    }

    public function getSpecialiteById($db, $id){
        $repository = new Repository_4($db, 'specialite', 'id', 'lastDiplomeObt', 'certificationObt', 'idConsultant') ;
        $this->setId($id) ;
        return $repository->findById('id', $this->getId()) ;
    }

    public function getSpecialiteByConsultant($db, $idConsultant){
        $repository = new Repository_4($db, 'specialite', 'id', 'lastDiplomeObt', 'certificationObt', 'idConsultant') ;
        $this->setIdConsultant($idConsultant);
        return $repository->findByValue_3('idConsultant', $this->getIdConsultant());
    }

    public function saveSpecialite($db, $lastDiplomeObt, $certifObt, $idConsultant){
        $repository = new Repository_4($db, 'specialite', 'id', 'lastDiplomeObt', 'certificationObt', 'idConsultant') ;
        $donnee = $this->getAllSpecialite($db);
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

        $this->setLastDiplomeObt($lastDiplomeObt);
        $this->setCertifObt($certifObt);  $this->setIdConsultant($idConsultant) ;

        return $repository->save('id', 'lastDiplomeObt', 'certificationObt', 'idConsultant',
            $this->getId(), $this->getLastDiplomeObt(), $this->getCertifObt(), $this->getIdConsultant());
    }

    public function mergeSpecialite($db, $id, $lastDiplomeObt, $certifObt, $idConsultant){
        $repository = new Repository_4($db, 'specialite', 'id', 'lastDiplomeObt', 'certificationObt', 'idConsultant') ;
        $this->setId($id);  $this->setLastDiplomeObt($lastDiplomeObt);
        $this->setCertifObt($certifObt);  $this->setIdConsultant($idConsultant) ;

        return $repository->merge('id', 'lastDiplomeObt', 'certificationObt', 'idConsultant',
            $this->getId(), $this->getLastDiplomeObt(), $this->getCertifObt(), $this->getIdConsultant());
    }

    public function getSpecialiteRowCount($db){
        $repository = new Repository_4($db, 'specialite', 'id', 'lastDiplomeObt', 'certificationObt', 'idConsultant') ;
        return $repository->counts() ;
    }

    public function removeSpecialite($db, $id){
        $repository = new Repository_4($db, 'specialite', 'id', 'lastDiplomeObt', 'certificationObt', 'idConsultant') ;
        $this->setId($id);
        return $repository->remove('id', $this->getId());
    }

    public function removeSpecialiteThroughConsultant($db, $idConsultant){
        $repository = new Repository_4($db, 'specialite', 'id', 'lastDiplomeObt', 'certificationObt', 'idConsultant') ;
        $this->setIdConsultant($idConsultant);
        return $repository->remove_3('idConsultant', $this->getIdConsultant());
    }

    public function getCertifObt()
    {
        return $this->certifObt;
    }

    public function setCertifObt($certifObt)
    {
        $this->certifObt = $certifObt;
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

    public function getLastDiplomeObt()
    {
        return $this->lastDiplomeObt;
    }

    public function setLastDiplomeObt($lastDiplomeObt)
    {
        $this->lastDiplomeObt = $lastDiplomeObt;
    }
} 