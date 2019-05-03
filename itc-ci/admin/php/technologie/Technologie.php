<?php
require_once '../repositories/Repository_3.php';

class Technologie {
    private $id ;
    private $libelle ;
    private $idDomaine ;

    function __construct()
    {
        $this->id = null;
        $this->libelle = null;
        $this->idDomaine = null ;
    }

    public function getAllTechnologie($db){
        $repository_3 = new Repository_3($db, 'technologie', 'id', 'libelle', 'idDomaine');
        return $repository_3->findAll();
    }

    public function getTechnologieById($db, $id){
        $this->setId($id) ;
        $repository_3 = new Repository_3($db, 'technologie', 'id', 'libelle', 'idDomaine');
        return $repository_3->findById('id', $this->getId());
    }

    public function getTechnologieByDomaine($db, $idDomaine){
        $this->setidDomaine($idDomaine);
        $repository_3 = new Repository_3($db, 'technologie', 'id', 'libelle', 'idDomaine');
        return $repository_3->findByValue_2('idDomaine', $this->getIdDomaine());
    }

    public function getTechnologieByLibelle($db, $libelle){
        $repository_3 = new Repository_3($db, 'technologie', 'id', 'libelle', 'idDomaine');
        $this->setLibelle($libelle);
        return $repository_3->findByValue_1('libelle', $this->getLibelle());
    }

    public function getTechnologieRowCount($db){
        $repository_3 = new Repository_3($db, 'technologie', 'id', 'libelle', 'idDomaine');
        return $repository_3->counts();
    }

    public function saveTechnologie($db, $libelle, $idDomaine){
        $repository_3 = new Repository_3($db, 'technologie', 'id', 'libelle', 'idDomaine');

        $donnee = $this->getAllTechnologie($db);
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

        $this->setLibelle($libelle);  $this->setIdDomaine($idDomaine);
        return $repository_3->save('id', 'libelle', 'idDomaine', $this->getId(), $this->getLibelle(), $this->getIdDomaine()) ;
    }

    public function mergeTechnologie($db, $id, $libelle, $idDomaine){
        $repository_3 = new Repository_3($db, 'technologie', 'id', 'libelle', 'idDomaine');
        $this->setId($id) ;  $this->setLibelle($libelle);  $this->setIdDomaine($idDomaine);
        return $repository_3->merge('id', 'libelle', 'idDomaine', $this->getId(), $this->getLibelle(), $this->getIdDomaine()) ;
    }

    public function removeTechnologie($db, $id){
        $repository_3 = new Repository_3($db, 'technologie', 'id', 'libelle', 'idDomaine');
        $this->setId($id);
        return $repository_3->remove('id', $this->getId());
    }

    public function removeTechnologieThroughDomaine($db, $idDomaine){
        $repository_3 = new Repository_3($db, 'technologie', 'id', 'libelle', 'idDomaine');
        $this->setIdDomaine($idDomaine);
        return $repository_3->remove_2('idDomaine', $this->getIdDomaine());
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdDomaine()
    {
        return $this->idDomaine;
    }

    public function setIdDomaine($idDomaine)
    {
        $this->idDomaine = $idDomaine;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

} 